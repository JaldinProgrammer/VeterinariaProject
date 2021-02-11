<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Period;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Service;
Use \Carbon\Carbon;
use App\Http\Controllers\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('es');
        $this->middleware('auth');
    }

    public function show(Request $request, $id){
        $dateUsed = ["date" => Carbon::now(), "error" => "No es posible
        realizar una reserva para una fecha pasada a la actual, se mostrara los periodos disponibles para 
        el dia de hoy", "now" => Carbon::now()];
        if(Carbon::parse($request['date']) > Carbon::yesterday()){ // si la fecha seleccionada es correcta no hay error
            $dateUsed['date'] = Carbon::parse($request['date']);
            $dateUsed['error'] = null;
        }
        $pet = Pet::findOrFail($id);
        $reserved = Reservation::select('period_id')
        ->where('date',  $dateUsed['date'])
        ->where('active','1')->get();
        $periods = Period::whereNotin('id',$reserved)->get();
        return view('mostrar_periodos', compact('periods'), compact('pet'))->with('dateUsed',$dateUsed);
    }

    public function register($pet , $period , $date){
       $services = Service::where('available','1')->get();
       return view('registrar_reserva', ["services" => $services,
       "date"=> $date, "period" => $period, "pet" => $pet]);
    }

    public function create(Request $request){
        $request->validate([
            'service' => ['required'],
        ]);
        Reservation::create([
            'description' => $request['description'],
            'date' => $request['date'],
            'pet_id' => $request['pet_id'],
            'user_id' => $request['user_id'],
            'period_id' => $request['period_id'],
            'service_id' => $request['service'],
        ]);
        return redirect()->route('show_treatment',$request['pet_id']);
    }

    public function show_all(){
        $reservations = Reservation::orderby('date','DESC')->paginate(10);
        $reservations->load('user');
        $reservations->load('pet');
        $reservations->load('period');
        $reservations->load('service');
        return view('mostrar_reservaciones', compact('reservations'));
    }
    public function inactive($id){
        $reservation = Reservation::findOrFail($id);
        $user =    Pet::select('user_id')->where('id',$reservation->pet_id)->first();
        $reservation->active = 0;
        $reservation->update();
        return redirect()->route('see_reservations',$user->user_id);
    }
}
