<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestLogin;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function Login(RequestLogin $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::with('role')->where('email',$request->email)->first();
            $user->token = $user->createToken('app')->accessToken;
            return $user;
        }
        return response()->json(['messeage'=>'Login fail'],401);
    }
}
