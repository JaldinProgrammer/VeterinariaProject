<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\treatment;
use Illuminate\Http\Request;
use App\Models\Binnacle;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class TreatmentController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('es');
        $this->middleware('veterinarian');
    }

    public function print($id){
        $pet = Pet::findOrFail($id);
        $pet = $pet->load('breed');
        $pet = $pet->load('user');
        $treatments = treatment::where('pet_id','=',$pet->id)->orderby('initdate','DESC')->get();
        $pdf = \PDF::loadView('printHistorialClinico', compact('treatments'), compact('pet'));
        $pdfName = $pet->nombre. Carbon::now().'Historial.pdf';
        return $pdf->stream($pdfName);
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
        treatment::create([
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

    public function show_treatment($pet){ // mostrar tratamiento
       $pet = Pet::findOrFail($pet);
       //$treatments = $pet->treatments->load('pet');
       $treatments = treatment::where('pet_id','=',$pet->id)->orderby('initdate','DESC')->paginate(3);
       return view('Historial_Tratamiento',compact('treatments'),compact('pet'));
    }

    public function edit_treatment($id){ //editar tratamiento
        $treatments = treatment::findOrFail($id)->load('pet');
        return view('Editar_Tratamiento',compact('treatments'));
    }

    public function update_treatment(Request $request, $id){ // actualizar tratamiento
        $request->validate([
            'diagnostic' => ['required'],
            'initdate' => ['required'],
        ]);
        $tratamiento = treatment::findOrFail($id);
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
        $tratamiento = treatment::findOrFail($id);
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

