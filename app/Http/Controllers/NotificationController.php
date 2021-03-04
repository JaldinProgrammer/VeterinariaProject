<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\treatment;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Binnacle;
class NotificationController extends Controller
{
    public function index($id){
        $tratamiento = treatment::findOrFail($id);
        return view('registrar_notificacion',compact('tratamiento'));
    }
    public function create(Request $request){
        $request->validate([
            'message' => ['required'],
            'eventDate' => ['required'],
        ]);
        Notification::create([
            'message' => $request['message'],
            'eventDate' => $request['eventDate'],
            'treatment_id' => $request['treatment_id'],        
        ]);
        $notifi = $request['message'];
        Binnacle::create([
            'entity' => (strlen($notifi) >= 15)? substr($notifi,0,13)."...": $notifi,
            'action' => "Insertó en",
            'table' => "Notificacion",
            'user_id'=> Auth::user()->id
        ]);
        $tratamiento = treatment::findOrFail($request['treatment_id']);
        return redirect()->route('show_treatment', $tratamiento->pet_id);   
    }
    public function see_all($id){
       // $notifications = Notification::where('treatment_id', $id)->get();
        $treatment = treatment::findOrFail($id);
        $treatment->load('notifications');
        return view('mostrar_notificaciones', compact('treatment'));
    }
    public function edit($id){
        $notification = Notification::findOrFail($id);
        return view('editar_notificacion',compact('notification'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'message' => ['required'],
            'eventDate' => ['required'],
        ]);
        $notification = Notification::findOrFail($id);
        $notification->message = $request->get('message');
        $notification->eventDate = $request->get('eventDate');
        $notification->update();
        $notifi =  $request->get('message');
        Binnacle::create([
            'entity' => (strlen($notifi) >= 15)? substr($notifi,0,13)."...": $notifi,
            'action' => "Actualizó en",
            'table' => "Notificacion",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('see_all_notification', $notification->treatment_id);
    }
    public function delete($id){
        $notification = Notification::findOrFail($id);
        $notifi =  $notification->message;
        $treatment = $notification->treatment_id;
        $notification->delete();  
        Binnacle::create([
            'entity' => (strlen($notifi) >= 15)? substr($notifi,0,13)."...": $notifi,
            'action' => "Eliminó en",
            'table' => "Notificacion",
            'user_id'=> Auth::user()->id
        ]);
         return redirect()->route('see_all_notification', $treatment);
    }
    
}
