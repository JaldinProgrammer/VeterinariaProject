<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('veterinarian');
    }
    public function index($id){
        $pet = Pet::findOrFail($id);
        return view('registrar_tratamiento')->with('pet',$pet);
    }
    public function create(Request $request){
        $request->validate([
            'diagnostic' => ['required'],
            'initdate' => ['required'],
        ]);
        $pet = $request['pet_id'];
        Treatment::create([
            'diagnostic' => $request['diagnostic'],
            'initdate' => $request['initdate'],
            'enddate' => $request['enddate'],
            'pet_id' => $request['pet_id'],
        ]);
        return redirect()->route('show_treatment',compact('pet'));
    }

    public function show_treatment($pet){
       $pet = Pet::findOrFail($pet);
       //$treatments = $pet->treatments->load('pet');
       $treatments = Treatment::where('pet_id','=',$pet->id)->orderby('initdate','DESC')->paginate(3);
       return view('Historial_Tratamiento',compact('treatments'),compact('pet'));
    }

    public function edit_treatment($id){
        $treatments = Treatment::findOrFail($id)->load('pet');
        return view('Editar_Tratamiento',compact('treatments'));
    }

    public function update_treatment(Request $request, $id){
        $request->validate([
            'diagnostic' => ['required'],
            'initdate' => ['required'],
        ]);
        $tratamiento = Treatment::findOrFail($id);
        $pet = Pet::findOrFail($tratamiento->pet_id);
        $tratamiento->diagnostic = $request->get('diagnostic');
        $tratamiento->initdate = $request->get('initdate');
        $tratamiento->enddate = $request->get('enddate');
        $tratamiento->update();
        $treatments = Treatment::where('pet_id','=',$tratamiento->pet_id)->get();
        return view('Historial_Tratamiento',compact('treatments'),compact('pet'));
    }

    public function destroy($id){
        $tratamiento = Treatment::findOrFail($id);
        $pet = $tratamiento->pet_id;
        $tratamiento->delete();
        return redirect()->route('show_treatment',$pet);
    }
}

