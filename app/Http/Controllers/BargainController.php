<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Bargain;
use App\Models\User;
use App\Models\Binnacle;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BargainController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('es');
    }
    public function showAll(){
        $bargains = Bargain::orderby('expiration','DESC')->paginate(10);
        $bargains->load('user');
        return view('mostrar_ofertas',compact('bargains'));
    }
    public function bargainForm(){
        return view('registrar_oferta');
    }
    public function create(Request $request){ //crear oferta
         $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
            'start' => ['required'],
            'photo' => ['image','max:2048'],
        ]);
        
        if($request->file('photo')==null){
            $url = null;
        }
        else{
            //$url = Storage::url($request->file('photo')->store('public/Images'));
        $photo = fopen($request->file('photo'),'r');
        $file = $request->file('photo');
        $file_name = time() . $file->getClientOriginalName();
        $response = Http::attach(
            'file',
            $photo,
            $file_name
        )->post('https://fileapp.quokasoft.com/api/store');
            $url = $response;
            $url = substr($url, 1, strlen($url)-2); // quitando las comillas
        }
        Bargain::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'start' => $request['start'],
            'expiration' => $request['expiration'],
            'note' => $request['note'],
            'user_id' => $request['user_id'],
            'photo' =>$url,            
        ]);
        Binnacle::create([
            'entity' => $request['title'],
            'action' => "Insertó en",
            'table' => "Ofertas",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('all_bargains');
    }
    public function edit($id){
        $bargain = Bargain::findOrFail($id);
        return view('editar_ofertas',compact('bargain'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
            'start' => ['required'],
            'photo' => ['image','max:2048'],
        ]);
        $bargain = Bargain::findOrFail($id);

        if($request->file('photo')==null){
            $url = null;
        }
        else{
            //$url = Storage::url($request->file('photo')->store('public/Images'));
        $photo = fopen($request->file('photo'),'r');
        $file = $request->file('photo');
        $file_name = time() . $file->getClientOriginalName();
        $response = Http::attach(
            'file',
            $photo,
            $file_name
        )->post('https://fileapp.quokasoft.com/api/store');
            $url = $response;
            $url = substr($url, 1, strlen($url)-2); // quitando las comillas
        }
        $bargain->title = $request->get('title');
        $bargain->body = $request->get('body');
        $bargain->start = $request->get('start');
        $bargain->expiration = $request->get('expiration');
        $bargain->note = $request->get('note');
        $bargain->user_id =   $request->get('user_id');  
        $bargain->photo = $url;
        $bargain->update();
        Binnacle::create([
            'entity' => $request->get('title'),
            'action' => "Actualizó en",
            'table' => "Ofertas",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('all_bargains');
    }
    public function destroy($id){
        $bargain = Bargain::findOrFail($id);
        $oferta = $bargain;
        $bargain->delete();
        Binnacle::create([
            'entity' => $oferta->title,
            'action' => "Actualizó en",
            'table' => "Ofertas",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('all_bargains');
    }

    public function showAvailable(){
        $bargains = Bargain::where('expiration','>=' , Carbon::now() )->orderby('expiration','DESC')->paginate(10);
        $bargains->load('user');
        return view('ofertas_disponibles',compact('bargains'));
    }
    
}
