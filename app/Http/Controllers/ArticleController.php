<?php

namespace App\Http\Controllers;
use App\Article;
use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    function index(){
            return Article::all();
    }

    function show(Request $request , $id){
        $user = Article::findorfail($id);
        return $user;
    }

    public function create(CreateRequest $request)
    {
        $data = $request->only('title' , 'body');
        $user = User::find(1);
        $articles = $user->articles()->create($data);
        return response($articles , 201);
    }

    public function update(UpdateRequest $request,$id){
        $data = $request->only('title' , 'body');
        $article = Article::findOrFail($id);
        $article->update($data);

        return response($article , 202);
    }

    public function delete(Request $request ,$id){
        $article =  Article::findOrFail($id);
        $article->delete();
        return response( null , 204);
    }
}
