<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

        auth()->attempt([
            'email' => $request->username,
            'password' => $request->password,
        ]);

        if (auth()->check()){
            return response([
                'token' => auth()->user()->generateToken(),
            ]);
        }
        return response([
            'massage' => 'اطلاعات کاربر نادرست است'
        ],401);
    }

//
    public function logout(){
        $user = auth()->guard('api')->user();
        $user->logout();
        return $user;
    }

//
    public function user(){
        return auth('api')->user();
    }
}
