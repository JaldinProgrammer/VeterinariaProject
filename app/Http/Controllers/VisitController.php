<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\Visit;


class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('veterinarian');
    }
    public function show_visits($id){
        $treatment = Treatment::findOrFail($id);
        $visits = Visit::where('treatment_id','=',$id)
        ->orderby('date','ASC')->get()->load('user')->load('treatment');
        //dd($visits);
        return view('mostrar_visitas',compact('visits'), compact('treatment'));
    }

    public function index($id){ //registrar visita
        $treatment = Treatment::findOrFail($id);
       // dd($treatment);
        return view('registrar_visitas',compact('treatment'));
    }
    public function create(Request $request){
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'time' => ['required'],
        ]);
        $id = $request['treatment_id'];
        Visit::create([
            'description' => $request['description'],
            'date' => $request['date'],
            'time' => $request['time'],
            'treatment_id' => $request['treatment_id'],
            'user_id' => $request['user_id'],
        ]);
        return redirect()->route('show_visits', $id);
    }
    public function edit($id){
        $visit = Visit::findOrFail($id);
        //dd($visit);
        return view('Editar_Visita',compact('visit'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'time' => ['required'],
        ]);
        $visit = Visit::findOrFail($id);
        $visit->description = $request->get('description');
        $visit->date = $request->get('date');
        $visit->time = $request->get('time');
        $visit->update();

        return redirect()->route('show_visits',$visit->treatment_id);
    }
    public function destroy($id){
        $visit = Visit::findOrFail($id);
        $treatment = $visit->treatment_id;
        $visit->delete();
        return redirect()->route('show_visits',$treatment);
    }

}
