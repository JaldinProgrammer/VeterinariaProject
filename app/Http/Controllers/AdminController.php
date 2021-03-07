<?php

namespace App\Http\Controllers;

use App\Models\Binnacle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use App\Models\Pet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

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

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['string'],
            'photo' => ['image','max:2048'],
            'rol' => ['required']
        ]);
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
        $photo = fopen($request->file('photo'),'r');
        $file = $request->file('photo');
        $file_name = time() . $file->getClientOriginalName();
        $response = Http::attach(
            'file',
            $photo,
            $file_name
        )->post('https://fileapp.quokasoft.com/api/store');
            $url = $response;
            $url = substr($url, 1, strlen($url)-2); // quitando las comillas
        }
        $User->name = $request->get('name');
        $User->photo = $url;
        $User->email = $request->get('email');
        $User->phone = $request->get('phone');
        $User->customer =  $cliente;
        $User->veterinarian =  $veterinario;
        $User->admin =  $administrador;

        $affected = $User; 
        $User->update();
        
        Binnacle::create([
            'entity' => $affected->name,
            'action' => "Actualizó en",
            'table' => "Usuarios",
            'user_id'=>  Auth::user()->id
        ]);
        
        return redirect()->route('see_users');
    }

    public function disable_User($id){ // deshabilitar usuario
        $User = User::findOrFail($id);
        $User->available = 0;
        $User->update();
        Binnacle::create([
            'entity' => $User->name,
            'action' => "Eliminó en",
            'table' => "Usuarios",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('see_users');
    }

    public function able_User($id){ // habilitar usuario
        $User = User::findOrFail($id);
        $User->available = 1;
        $User->update();
        Binnacle::create([
            'entity' => $User->name,
            'action' => "Restauró en",
            'table' => "Usuarios",
            'user_id'=> Auth::user()->id
        ]);
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
        Binnacle::create([
            'entity' => $request['name'],
            'action' => "Insertó en",
            'table' => "Servicios",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('show_Services');
    }

    public function show_Services(){ // mostrar todos los servicios
        $services = Service::orderby('id','desc')->paginate(6);
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
        Binnacle::create([
            'entity' => $request['name'],
            'action' => "Actualizó en",
            'table' => "Servicios",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('show_Services');
    }

    public function delete_service($id){  // borrar servicio
        $servicio = $service = Service::findOrFail($id);
        if(($service->visits()->count()+ $service->reservations()->count() ) > 0){
            return back()->withErrors(['error' => 'Usted no puede borrar a este servicio 
            porque existen visitas ocupando este servicio, borre las visitas que involucran a este servicio
            si desea borrarlo']);
        }
        else{
        $service->delete();
        Binnacle::create([
            'entity' => $servicio->name,
            'action' => "Actualizó en",
            'table' => "Servicios",
            'user_id'=> Auth::user()->id
        ]);
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
        $pets =  Pet::orderby('id','desc')->paginate(10);
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
