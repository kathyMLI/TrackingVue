<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Notifications\UserWelcomeNotification;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        return response()->json([
            'message' => 'Usuario creado con exito'
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'rut' => 'required|max:15|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'rut' => $data['rut'],
            'password' => $data['password'],
            'validation_token' => str_random(60),
        ]);
        $user->notify(new UserWelcomeNotification($user));
        return $user;
    }

    public function validation(User $user, Request $request)
    {
        if($user->validation_token == $request->validation_token) {
            $user->validation_token = null;
            $user->save();
            return response()->json([
                'state' => true
            ]);
        }
        return response()->json([
            'state' => false
        ]);
    }
}
