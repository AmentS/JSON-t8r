<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

//    Route::get('/projects/{project}/users', 'ProjectController@users');

    // TODO: nested routes
    Route::get('/projects/{project}/translations', 'TranslationController@index');

    Route::get('/translations', 'TranslationController@show');
    Route::post('/translations', 'TranslationController@storeOrUpdate');
//    Route::post('/projects/{project}/translations', 'TranslationController@update');
    Route::delete('/translations', 'TranslationController@destroy');


    Route::apiResource('projects', 'ProjectController');

    Route::get('/language', 'LanguageController@index');

    Route::get('/projects/{project}/users', 'ProjectUserController@index');
    Route::post('/projects/{project}/users', 'ProjectUserController@store');
    Route::post('/contact', 'ContactController@store');
    Route::get('/contact', 'ContactController@index');
    Route::get('/contact/{contact}', 'ContactController@show');

    Route::get('/users', 'ContactUserController@index');
    Route::get('/users/{user}', 'ContactUserController@show');

    Route::get('/user', 'UserController@index');





});












