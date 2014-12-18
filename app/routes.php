<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return "aaaaaa";//View::make('hello');
});

Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);
Route::get('users/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
Route::post('users/store', ['as' => 'users.store', 'uses' => 'UserController@store']);
