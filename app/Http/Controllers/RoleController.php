<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class RoleController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = User::where('email',$request->email)->first();
            if($user->is_veterinarian())
            {
                if($user->is_admin())
                {
                    return redirect()->route('registro.usuarios');
                }
                return redirect()->route('reservaciones');
            }
            return redirect()->route('recomendaciones');
        }
        return redirect()->back();
    }
}
