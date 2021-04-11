<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
            return User::all();
    }

    public function show(Request $request , $id){
            $user = User::findorfail($id);
            return $user;

    }
    public function create(CreateRequest $request){
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $request->password,
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
