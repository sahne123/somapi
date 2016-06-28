<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
	Route::resource('groups',            'Api\v1\GroupsController',           ['except' => ['create', 'edit']]);
	Route::resource('characters',        'Api\v1\CharactersController',       ['except' => ['create', 'edit']]);
	Route::resource('groups.characters', 'Api\v1\GroupsCharactersController', ['only'   => ['index', 'store', 'destroy']]);
});
