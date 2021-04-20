<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index(Request $request){
        $user = User::all();
        $user = new UserResourceCollection($user);
        return $user;
    }

    public function show(Request $request , $id){
            $user = User::findorfail($id);
            return $user = new UserResource($user);

    }
    public function create(CreateRequest $request){

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ]);
        return response($users , 201);
    }

    public function update(UpdateRequest $request , $id){
        $user = User::findOrFail($id);
        $data = $request->only('name' , 'password');
        $user->update($data);
        return response($user , 202);
    }
    public function delete(Request $request ,$id){
        $article =  User::findOrFail($id);
        $article->delete();
        return response( null , 204);
    }
}
