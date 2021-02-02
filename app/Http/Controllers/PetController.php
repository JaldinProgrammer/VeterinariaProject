<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;

use App\Models\Breed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $usuario = User::find($id);
        $breeds = Breed::orderby('specie_id','DESC')->get();
        $breeds = $breeds->load('specie');
        return view('registrar_mascota',compact('breeds'),compact('usuario'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'photo' => ['image','max:2048'],
            'birthdate' => ['required'],
            'color' => ['required'],
        ]);

        if($request->file()==null){
            $url = null;
        }
        else{
            $url = Storage::url($request->file('photo')->store('public/Images'));
        }
        $sex = ($request['gender']=='macho')? 1:0;
        Pet::create([
            'nombre' => $request['name'],
            'color' => $request['color'],
            'gender' => $sex,
            'birthdate' => $request['birthdate'],
            'deathdate' => $request['deathdate'],
            'photo' => $url,
            'breed_id' => $request['breed'],
            'user_id' => $request['user_id'],         
        ]);
        return redirect()->route('show_pets',$request['user_id']);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'photo' => ['image','max:2048'],
            'color' => ['required'],
        ]);
        $pet = Pet::findOrFail($id);

        if($request->file()==null){
            $url = null;
        }
        else{
            $url = Storage::url($request->file('photo')->store('public/Images'));
        }
        $sex = ($request['gender']=='macho')? 1:0;

        $pet->nombre = $request->get('name');
        $pet->photo = $url;
        $pet->color = $request->get('color');
        $pet->breed_id = $request->get('breed');
        $pet->gender = $sex;
        $pet->birthdate = $request->get('birthdate');
        $pet->deathdate = $request->get('deathdate');

        $pet->update();

        return redirect()->route('show_pets',$pet->user_id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $owner = $pet->user_id;
        $pet->delete();
        return redirect()->route('show_pets',$owner);
    }
}
