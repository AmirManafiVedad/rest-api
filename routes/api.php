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

Route::get('/login',[
   'as' => 'login',
   'uses' => 'AuthController@login'
]);

Route::group(['prefix' => 'articles'] , function (){

    Route::get('/',[
        'as' => 'articles',
        'uses' => 'ArticleController@index',]);
    Route::get('/{id}',[
        'as' => 'articles.show',
        'uses' => 'ArticleController@show',]);
    Route::post('/',[
        'as' => 'articles.create',
        'uses' => 'ArticleController@create',]);
    Route::put('/{id}', [
        'as' => 'articles.update',
        'uses' => 'ArticleController@update',]);
    Route::delete('/{id}', [
        'as' => 'articles.delete',
        'uses' => 'ArticleController@delete',]);
});

// User Group Route

Route::group(['prefix' => 'users'] , function (){

Route::get('/', [
    'as' => 'users',
    'uses' => 'UserController@index',]);
Route::get('/{id}', [
    'as' => 'users.show',
    'uses' => 'UserController@show',]);
Route::post('/',[
    'as' => 'users.create',
    'uses' => 'UserController@create',]);
Route::put('/{id}', [
    'as' => 'users.update',
    'uses' => 'UserController@update',]);
Route::delete('/{id}', [
    'as' => 'users.delete',
    'uses' => 'UserController@delete',]);
});

