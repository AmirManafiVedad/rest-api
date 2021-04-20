<?php

namespace App\Http\Controllers;
use App\Article;
use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Resources\ArticleResource;
use App\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    function index(Request $request){
//        //////////////////
//        Error Statues 500
//        /////////////////
        $article = Article::paginate(2);
        dd($article = ArticleResource::collection($article)) ;
    }

    function show(Request $request , $id){
        $articles = Article::findorfail($id);
        return new ArticleResource($articles);

    }

    public function create(CreateRequest $request)
    {
        $data = $request->only('title' , 'body');
        $user = User::find(auth()->user()->id);
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
