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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/gifts', [
	'as' => 'gifts.index',
	'uses' => 'GiftsController@index'
	]);

Route::post('/gifts', [
	'as' => 'gifts.store',
	'uses' => 'GiftsController@store'
	]);

Route::get('/api', [
	'as' => 'gifts.api',
	'uses' => 'HomeController@api'
	]);
