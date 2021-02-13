<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use App\Models\Breed;

use Illuminate\Support\Carbon;

class VeterinarianController extends Controller
{
    public function __construct()
    {
        $this->middleware('veterinarian');
    }
    public function reservation(){
        return view('reservaciones');
    }
    public function pets_register()
    {
        return view('registro_mascotas');
    }

    public function edit_pets($id){ // formulario para editar mascotas
        //dd($id);
        $breeds = Breed::orderby('specie_id','DESC')->get();
        $breeds = $breeds->load('specie');
        
        return view('editar_mascotas', ['pet' => Pet::findOrfail($id)],compact('breeds'));
    }

    public function see_Customers() // ver clientes
    {
        $usuarios = User::where('customer','=','1')->where('available','=','1')
                            ->orderby('id','DESC')->paginate(6);

        return view('datos_usuario')
                ->with('usuarios',$usuarios);
    }

    public function see_Veterinarians() // ver clientes
    {
        $usuarios = User::where('veterinarian','=','1')->where('available','=','1')
                            ->orderby('id','DESC')->paginate(6);
        return view('datos_usuario')
                ->with('usuarios',$usuarios);
    }

    public function see_Searched_Users(Request $request){ // buscador de usuarios
        if($request){
            $query = trim($request->get('search'));
            $usuarios = User::where('name','LIKE','%'.$query.'%')
            ->orderBy('id','asc')->paginate(6);
            return view('datos_usuario')->with('usuarios',$usuarios);
        }
    }
    
}
