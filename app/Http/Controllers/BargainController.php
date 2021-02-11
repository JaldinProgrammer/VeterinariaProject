<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Bargain;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
    public function create(Request $request){
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
            $url = Storage::url($request->file('photo')->store('public/Images'));
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
            $url = Storage::url($request->file('photo')->store('public/Images'));
        }
        $bargain->title = $request->get('title');
        $bargain->body = $request->get('body');
        $bargain->start = $request->get('start');
        $bargain->expiration = $request->get('expiration');
        $bargain->note = $request->get('note');
        $bargain->user_id =   $request->get('user_id');  
        $bargain->photo = $url;
        $bargain->update();
        return redirect()->route('all_bargains');
    }
    public function destroy($id){
        $bargain = Bargain::findOrFail($id);
        $bargain->delete();
        return redirect()->route('all_bargains');
    }

    public function showAvailable(){
        $bargains = Bargain::where('expiration','>=' , Carbon::now() )->orderby('expiration','DESC')->paginate(10);
        $bargains->load('user');
        return view('ofertas_disponibles',compact('bargains'));
    }
    
}
