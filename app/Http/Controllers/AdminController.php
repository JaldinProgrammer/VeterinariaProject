<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use App\Models\Pet;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function see_users() // ver todos los usuarios disponibles
    {
        $usuarios = User::where('available','=','1')->orderby('id','DESC')->paginate(6);

        return view('datos_usuario')
                ->with('usuarios',$usuarios);
    }
    
    public function see_Deleted_Users() // ver usuarios borrados
    {
        $usuarios = User::where('available','=','0')->orderby('id','DESC')->paginate(6);

        return view('datos_usuarios_borrados')
                ->with('usuarios',$usuarios);
    }

    public function edit_Users($id) // formulario de edicion usuarios
    {
        return view('editar_Usuarios', ['user' => User::findOrfail($id)]);
    }
    public function update_Users(Request $request, $id) // actualizar usuarios 
    {
        $User = User::findOrFail($id);

        $veterinario = 0;
        $administrador = 0;
        $cliente = 0;
        $rolsito = $request->get('rol');
        if ($rolsito == "admin") {
           $veterinario = 1;
           $administrador = 1;   
        }  
        if ($rolsito == "veter") {
           $veterinario = 1;
        }   
        if ($rolsito == "clien") {
           $cliente = 1;;
        } 
        if($request->file('photo')==null){
            $url = null;
        }
        else{
         $perfil =$request->file('photo')->store('public/Images');
         $url = Storage::url($perfil);
        }
        $User->name = $request->get('name');
        $User->photo = $url;
        $User->email = $request->get('email');
        $User->phone = $request->get('phone');
        $User->customer =  $cliente;
        $User->veterinarian =  $veterinario;
        $User->admin =  $administrador;


        $User->update();

        return redirect()->route('see_users');
    }

    public function disable_User($id){ // deshabilitar usuario
        $User = User::findOrFail($id);
        $User->available = 0;
        $User->update();
        return redirect()->route('see_users');
    }

    public function able_User($id){ // habilitar usuario
        $User = User::findOrFail($id);
        $User->available = 1;
        $User->update();
        return redirect()->route('see_Deleted_Users');
    }

    public function register_Services(){ // formulario de registro de servicio
        return view('register_Services');
    }

    public function create_Service(Request $request){ // crear servicio
        $reservable = ($request['reservable'])? 1:0;
        $available = ($request['available'])? 1:0;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        Service::create([
            'name' => $request['name'],
            'reservable' => $reservable,
            'available' => $available,
        ]);
        return redirect()->route('show_Services');
    }

    public function show_Services(){ // mostrar todos los servicios
        $services = Service::paginate(5);
        return view('mostrar_servicios',compact('services'));
    }

    public function edit_service($id){ // formulario de edicion servicio
        $service = Service::findOrFail($id);  
        return view('editar_Servicios',compact('service'));
    }

    public function update_Service(Request $request, $id){ //actualizar servicio
        $reservable = ($request['reservable'])? 1:0;
        $available = ($request['available'])? 1:0;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $services = Service::findOrFail($id);
        $services->name = $request->get('name');
        $services->reservable = $reservable; 
        $services->available = $available;
        $services->update();
        return redirect()->route('show_Services');
    }

    public function delete_service($id){  // borrar servicio
        $service = Service::findOrFail($id);
        if(($service->visits()->count()+ $service->reservations()->count() ) > 0){
            return back()->withErrors(['error' => 'Usted no puede borrar a este servicio 
            porque existen visitas ocupando este servicio, borre las visitas que involucran a este servicio
            si desea borrarlo']);
        }
        else{
        $service->delete();
        return redirect()->route('show_Services');
        }
    }

    public function search_per_rol(Request $request){
        if($request){
            $veterinario = 0;
            $administrador = 0;
            $cliente = 0;
            $rolsito = $request->get('rol');
            if ($rolsito == "admin") {
            $veterinario = 1;
            $administrador = 1;   
            }  
            if ($rolsito == "veterinarian") {
            $veterinario = 1;
            }   
            if ($rolsito == "customer") {
            $cliente = 1;;
            } 

            $usuarios = User::where('available','=','1')->where('veterinarian',$veterinario)
            ->where('customer',$cliente)->where('admin',$administrador)->paginate(15);
            return view('datos_usuario')->with('usuarios',$usuarios);
        }
    }

    public function all_Pets(){
        $pets =  Pet::all();
        return view('mostrar_todas_mascotas',compact('pets'));
    }

    public function see_Searched_Pets(Request $request){ // buscador de mascotas
        if($request){
            $query = trim($request->get('search'));
            $pets = Pet::where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id','asc')->paginate(6);
            $pets->load('user');
            return view('mostrar_todas_mascotas',compact('pets'));
        }
    }
}
