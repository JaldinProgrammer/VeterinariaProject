<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use App\Models\Visit;
use App\Models\reservation;
use App\Models\Treatment;
use \Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Carbon::setLocale('es');
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

    public function see_reservations($id)
    {
        $pets = Pet::select('id')->where('user_id', $id)->get();
        $reservations = Reservation::whereIn('pet_id', $pets)->where('active','1')
            ->where('date', '>=', Carbon::now())->orderby('date', 'desc')->get();
        $reservations->load('user');
        $reservations->load('pet');
        $reservations->load('period');
        $reservations->load('service');
        return view('home', compact('reservations'));
    }

    public function see_notifications($id){
        $pets = Pet::select('id')->where('user_id', $id)->get();
        $treatments = Treatment::select('id')->whereIn('pet_id',$pets)->get();
        $notifications = Notification::whereIn('treatment_id', $treatments)->where('eventDate','>=', Carbon::now())
        ->orderby('eventDate', 'desc')->get();
        $notifications->load('treatment');

        foreach ($notifications as $notification){
            $notification->treatment->load('pet');
        }
        return view('home', compact('notifications'));
    }
    public function show_pets($id)
    {
        $usuario = User::find($id);
        $pets = $usuario->pets->load('breed');
        foreach ($pets as $pet) {
            $pet->breed->load('specie')->orderby('specie_id', 'DESC');
        }
        return view('mascotas_Usuario', compact('pets'), compact('usuario'));
    }
    public function vaccines($pet){
        $treatments = Treatment::where('pet_id',$pet)
        ->whereIn('id', Visit::select('treatment_id')->where('service_id','10')->get())->paginate(6);
        return view('vacunas', compact('treatments'));
    }
}
