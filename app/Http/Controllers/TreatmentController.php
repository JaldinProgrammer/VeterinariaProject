<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('veterinarian');
    }
    
}
