<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Specie;
use App\Models\Breed;
use Facade\Ignition\DumpRecorder\DumpHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Binnacle;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index($id) // formulario de registro de mascota
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
    public function create(Request $request) // crear mascota
    {
       
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'photo' => ['image','max:2048'],
            'color' => ['required'],
            'breed' => ['required'],
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
        Binnacle::create([
            'entity' => $request['name'],
            'action' => "Insertó en",
            'table' => "Mascotas",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('show_pets',$request['user_id']);
    }
    public function update(Request $request, $id) // actialozar mascota
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'photo' => ['image','max:2048'],
            'color' => ['required'],
        ]);
        $pet = Pet::findOrFail($id);

        if($request->file('photo')==null){
            $url = null;
        }
        else{
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
        $sex = ($request['gender']=='macho')? 1:0;

        $pet->nombre = $request->get('name');
        $pet->photo = $url;
        $pet->color = $request->get('color');
        $pet->breed_id = $request->get('breed');
        $pet->gender = $sex;
        $pet->birthdate = $request->get('birthdate');
        $pet->deathdate = $request->get('deathdate');

        $pet->update();
        Binnacle::create([
            'entity' => $request->get('name'),
            'action' => "Actualizó en",
            'table' => "Mascotas",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('show_pets',$pet->user_id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //eliminar mascota
    {
        $pet = Pet::findOrFail($id);
        $mascota = $pet->nombre;
        if(($pet->treatments()->count() + $pet->reservations()->count()) > 0){
            return back()->withErrors(['error' => 'Usted no puede borrar a esta mascota 
            porque cuenta con tratamientos dentro, porfavor primero borre todos los tratamientos']);
        }
        else{
        $owner = $pet->user_id;
        $pet->delete();
        Binnacle::create([
            'entity' => $mascota,
            'action' => "Eliminó en",
            'table' => "Mascotas",
            'user_id'=> Auth::user()->id
        ]);
        return redirect()->route('show_pets',$owner);
        }
    }

    public function showBreeds(){ // mostrar razas
        $breeds = Breed::orderby('id','desc')->paginate(10);
        $breeds->load("specie");
       return view('mostrar_razas', compact('breeds'));
    }

    public function register_Breed(){ // registrar una raza
        $species = Specie::all();
        return view('registrar_raza',compact('species'));
    }

    public function create_Breed(Request $request){ // crear raza
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required'],
        ]);
        
        Breed::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'specie_id' => $request['species'],
        ]);
        Binnacle::create([
            'entity' => $request['name'],
            'action' => "Insertó en",
            'table' => "Razas",
            'user_id'=> Auth::user()->id
        ]);
        
        return redirect()->route('showBreeds');
    }

    public function edit_Breed($id){ // formulario para editar raza
        $breed = Breed::findOrFail($id);
        $species = Specie::all();
        return view('editar_raza', compact('breed'), compact('species'));
    }

    public function update_Breed(Request $request, $id){ //actualizar raza
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required'],
        ]);
        $breed = Breed::findOrFail($id);
        $breed->name = $request['name'];
        $breed->description = $request['description'];
        $breed->specie_id = $request['species'];

        $breed->update();
        Binnacle::create([
            'entity' => $request['name'],
            'action' => "Insertó en",
            'table' => "Razas",
            'user_id'=> Auth::user()->id
        ]);    
        return redirect()->route('showBreeds');
    }

    public function delete_breed($id){ // borrar raza
        $breed = Breed::findOrFail($id);
        $raza = $breed->name;
        if($breed->pets()->count() > 0){
            return back()->withErrors(['error' => 'Usted no puede borrar este raza 
            porque cuenta con mascotas registradas']);
        }
        else{
            $breed->delete();
            Binnacle::create([
            'entity' => $raza,
            'action' => "Eliminó en",
            'table' => "Razas",
            'user_id'=> Auth::user()->id
            ]);
            return redirect()->route('showBreeds');
        }
    }

    public function show_species(){ // mostrar especie
        $species = Specie::orderby('id','desc')->paginate(5);
        return view('mostrar_especies', compact('species'));
    }

    public function register_specie(){ // registrar especie
        return view('registrar_especie');
    }

    public function create_specie(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        Specie::create([
            'name' => $request['name'],
        ]);
        Binnacle::create([
            'entity' => $request['name'],
            'action' => "Creó en",
            'table' => "Especies",
            'user_id'=> Auth::user()->id
            ]);
        return redirect()->route('show_species');
    }
    
    public function edit_specie($id){
        $specie = Specie::findOrFail($id);
        return view('editar_especie', compact('specie'));
    }

    public function update_specie(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $specie = Specie::findOrFail($id);
        $specie->name = $request['name'];
        $specie->update();
        Binnacle::create([
            'entity' => $request['name'],
            'action' => "Actualizó en",
            'table' => "Especies",
            'user_id'=> Auth::user()->id
            ]);    
        return redirect()->route('show_species');
    }

    public function delete_specie($id){
        $specie = Specie::findOrFail($id);
        if($specie->breeds()->count() > 0){
            return back()->withErrors(['error' => 'Usted no puede borrar esta especie 
            porque cuenta con razas registradas']);
        }
        else{
            $specie->delete();
            Binnacle::create([
            'entity' => $specie->name,
            'action' => "Eliminó en",
            'table' => "Especies",
            'user_id'=> Auth::user()->id
            ]);   
            return redirect()->route('show_species');
        }
    }
}
