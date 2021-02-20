<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\Visit;
use App\Models\Service;
use \Carbon\Carbon;
use App\Models\Binnacle;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('veterinarian');
        Carbon::setLocale('es');
    }
    public function show_visits($id){
        $treatment = Treatment::findOrFail($id);
        $visits = Visit::where('treatment_id','=',$id)
        ->orderby('date','ASC')->get()->load('user')->load('treatment');
        return view('mostrar_visitas',compact('visits'), compact('treatment'));
    }

    public function index($id){ //registrar visita
        $treatment = Treatment::findOrFail($id);
        $services = Service::all();
        return view('registrar_visitas',compact('treatment'),compact('services'));
    }
    public function create(Request $request){
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'time' => ['required'],
            'service_id' => ['required'],
        ]);
        $id = $request['treatment_id'];
        Visit::create([
            'description' => $request['description'],
            'date' => $request['date'],
            'time' => $request['time'],
            'treatment_id' => $request['treatment_id'],
            'user_id' => $request['user_id'],
            'service_id' => $request['service_id'],
        ]);
        $visita = $request['description'];
        Binnacle::create([
            'entity' => (strlen($visita) >= 9)? substr($visita,0,8)."...": $visita,
            'action' => "Insertó en",
            'table' => "Visitas",
            'user_id'=> Auth::user()->id
            ]);   
        return redirect()->route('show_visits', $id);
    }
    public function edit($id){
        $visit = Visit::findOrFail($id);
        $services = Service::all();
        return view('Editar_Visita',compact('visit'), compact('services'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'time' => ['required'],
            'service_id' => ['required'],
        ]);
        $visit = Visit::findOrFail($id);
        $visit->description = $request->get('description');
        $visit->date = $request->get('date');
        $visit->time = $request->get('time');
        $visit->service_id = $request->get('service_id');

        $visit->update();
        $visita = $request->get('description');
        Binnacle::create([
            'entity' => (strlen($visita) >= 9)? substr($visita,0,8)."...": $visita,
            'action' => "Actualizó en",
            'table' => "Visitas",
            'user_id'=> Auth::user()->id
            ]);     
        return redirect()->route('show_visits',$visit->treatment_id);
    }
    public function destroy($id){
        $visit = Visit::findOrFail($id);
        $treatment = $visit->treatment_id;
        $visit->delete();
        $visita = $visit->description;
        Binnacle::create([
            'entity' => (strlen($visita) >= 9)? substr($visita,0,8)."...": $visita,
            'action' => "Eliminó en",
            'table' => "Visitas",
            'user_id'=> Auth::user()->id
            ]);
        return redirect()->route('show_visits',$treatment);
    }

}
