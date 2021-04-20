<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Api Group Access User
Route::group([],function (){
    Route::get('/login',[
        'as' => 'login',
        'uses' => 'AuthController@login']);
    Route::post('/logout' , [
        'as' => 'logout' ,
        'uses' => 'AuthController@logout',
        'middleware' => 'auth:api']);
    Route::get('/user' , [
        'as' => 'user' ,
        'uses' => 'AuthController@user',
        'middleware' => 'auth:api']);
});

// Api Group Manager Post
Route::group(['prefix' => 'articles'] , function (){

    Route::get('/',[
        'as' => 'articles',
        'uses' => 'ArticleController@index',
        'middleware' => 'auth:api']);
    Route::get('/{id}',[
        'as' => 'articles.show',
        'uses' => 'ArticleController@show',
        'middleware' => 'auth:api']);
    Route::post('/',[
        'as' => 'articles.create',
        'uses' => 'ArticleController@create',
        'middleware' => 'auth:api']);
    Route::put('/{id}', [
        'as' => 'articles.update',
        'uses' => 'ArticleController@update',
        'middleware' => 'auth:api']);
    Route::delete('/{id}', [
        'as' => 'articles.delete',
        'uses' => 'ArticleController@delete',
        'middleware' => 'auth:api']);
});

// Api Group Manager Users
Route::group(['prefix' => 'users'] , function (){
Route::get('/', [
    'as' => 'users',
    'uses' => 'UserController@index',
    'middleware' => 'auth:api']);
Route::get('/{id}', [
    'as' => 'users.show',
    'uses' => 'UserController@show',
    'middleware' => 'auth:api']);
Route::post('/',[
    'as' => 'users.create',
    'uses' => 'UserController@create',
    'middleware' => 'auth:api']);
Route::put('/{id}', [
    'as' => 'users.update',
    'uses' => 'UserController@update',
    'middleware' => 'auth:api']);
Route::delete('/{id}', [
    'as' => 'users.delete',
    'uses' => 'UserController@delete',
    'middleware' => 'auth:api']);
});

