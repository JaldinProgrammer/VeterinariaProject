<?php

namespace App\Http\Controllers;

use App\Models\Binnacle;
use Illuminate\Http\Request;

class BinnacleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $binnacles = Binnacle::orderby('id','desc')->paginate(16);
        $binnacles->load('user');
        return view('mostrar_bitacora', compact('binnacles'));
    }
}
