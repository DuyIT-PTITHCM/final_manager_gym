<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestRegister;
use App\User;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function Register(RequestRegister $requestRegister){
       User::create([
           'name'=> $requestRegister->name,
           'email'=>$requestRegister->email,
           'password'=>Hash::make($requestRegister->password),
           'role_id'=>$requestRegister->role_id,
           'phone'=>$requestRegister->phone
       ]);
        return true;
    }
}
