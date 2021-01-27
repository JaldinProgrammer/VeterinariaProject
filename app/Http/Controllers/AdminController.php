<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function see_Searched_Users(Request $request){
        if($request){
            $query = trim($request->get('search'));
            $usuarios = User::where('name','LIKE','%'.$query.'%')
            ->orderBy('id','asc')->paginate(6);
            return view('datos_usuario')->with('usuarios',$usuarios);
        }
    }
    public function see_users()
    {
        $usuarios = User::where('available','=','1')->orderby('id','DESC')->paginate(6);

        return view('datos_usuario')
                ->with('usuarios',$usuarios);
    }
    
    public function see_Deleted_Users()
    {
        $usuarios = User::where('available','=','0')->orderby('id','DESC')->paginate(6);

        return view('datos_usuarios_borrados')
                ->with('usuarios',$usuarios);
    }

    public function see_Customers()
    {
        $usuarios = User::where('customer','=','1')->where('available','=','1')
                            ->orderby('id','DESC')->paginate(6);

        return view('datos_usuario')
                ->with('usuarios',$usuarios);
    }

    public function edit_Users($id)
    {
        return view('editar_Usuarios', ['user' => User::findOrfail($id)]);
    }
    public function update_Users(Request $request, $id)
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
        //dd($request->file('photo'));
         $perfil =$request->file('photo')->store('public/Images');
         $url = Storage::url($perfil);
         
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

    public function disable_User($id){
        $User = User::findOrFail($id);
        $User->available = 0;
        $User->update();
        return redirect()->route('see_users');
    }

    public function able_User($id){
        $User = User::findOrFail($id);
        $User->available = 1;
        $User->update();
        return redirect()->route('see_Deleted_Users');
    }
}
