<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use \Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::once($request->except('_token'))) {
            if(Auth::user()->validation_token == null) {
                Auth::user()->updateToken()->save();
                return response()->json(['token' => Auth::user()->api_token]);
            }
            return response()->json(['email' => ['Email no validado']], 422);
        }
        return response()->json(['email' => ['Credenciales no validas']], 422);
    }
}
