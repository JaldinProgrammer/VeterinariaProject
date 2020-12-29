<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
