<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Models\Binnacle;
use Illuminate\Support\Facades\Auth;
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
        $reserv = $request['diagnostic'];
        Binnacle::create([
            'entity' => (strlen($reserv) >= 9)? substr($reserv,0,8)."...": $reserv,
            'action' => "Insertó en",
            'table' => "Tratamientos",
            'user_id'=> Auth::user()->id
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
        $reserv = $request->get('diagnostic');
        Binnacle::create([
            'entity' => (strlen($reserv) >= 9)? substr($reserv,0,8)."...": $reserv,
            'action' => "Actualizó en",
            'table' => "Tratamientos",
            'user_id'=> Auth::user()->id
            ]);   
           return redirect()->route('show_treatment',$pet->id); 
    }

    public function destroy($id){ //borrar tratamiento
        $tratamiento = Treatment::findOrFail($id);
        if(($tratamiento->visits()->count() + $tratamiento->notifications()->count()) > 0){
            return back()->withErrors(['error' => 'Usted no puede borrar este tratamiento 
            porque cuenta con visitas o notificaciones dentro, porfavor primero borre las visitas y notificaciones']);
        }
        else{
        $pet = $tratamiento->pet_id;
        $tratamiento->delete();
        $reserv =$tratamiento->diagnostic;
        Binnacle::create([
            'entity' => (strlen($reserv) >= 9)? substr($reserv,0,8)."...": $reserv,
            'action' => "Eliminó en",
            'table' => "Tratamientos",
            'user_id'=> Auth::user()->id
            ]);
        return redirect()->route('show_treatment',$pet);
        }
    }
}

