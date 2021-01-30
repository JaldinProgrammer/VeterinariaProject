<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function see_pets()
    {
        return view('datos_mascota');
    }
    public function reservation_users()
    {
        return view('reservacion_by_usuario');
    }
    public function show_pets($id){
        $usuario = User::find($id);
        $pets = $usuario->pets->load('breed'); 
        foreach ($pets as $pet)
        {
            $pet->breed->load('specie')->orderby('specie_id','DESC');
        }
        return view('mascotas_Usuario', compact('pets'),compact('usuario'));
    }
}
