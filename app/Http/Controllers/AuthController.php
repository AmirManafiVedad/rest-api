<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

//        $user = User::where([
//            'email' => $request->username,
//            'password' => $request->password,
//        ])->first();
//        dd($user);
//        if (!empty($user)){
//            $check = Hash::check($request->password , $user->password);
//            dd($check);
//        }
        auth()->attempt([
           'email' => $request->email,
        ]);

    }
}
