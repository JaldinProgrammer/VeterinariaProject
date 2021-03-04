<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Binnacle;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\BinaryOp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        //$this->guard()->login($user); //CARLOS NOTA: comente esto para que despues de registrarse el nuevo usuario no se loggee directamente
        return redirect()->route('see_users'); // refirijo a la ruta see users
        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect($this->redirectPath());
        //             //:redirect()
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest');
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['string'],
            'photo' => ['image','max:2048'],
            'rol' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $veterinario = 0;
        $administrador = 0;
        $cliente = 0;
        if ($_REQUEST['rol'] == "admin") {
           $veterinario = 1;
           $administrador = 1;   
        }  
        if ($_REQUEST['rol'] == "veter") {
           $veterinario = 1;
        }   
        if ($_REQUEST['rol'] == "clien") {
           $cliente = 1;
        } 
        if (count($data)>=9){ // si es que el usuario puso su photo seran 8 espacios
         $perfil = $data['photo']->store('public/Images');
         $url = Storage::url($perfil);
        }
        else{ // si es que photo esta vacias seran menos de 8s
            $url = null;
        }
        $affected = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'veterinarian' => $veterinario,
            'admin' => $administrador,
            'customer' => $cliente,
            'photo' => $url,
            'password' => Hash::make($data['password']),
        ]);
        Binnacle::create([
            'entity' => $affected->name,
            'action' => "Insertó en",
            'table' => "Usuarios",
            'user_id'=> Auth::user()->id
        ]);
    }
}
