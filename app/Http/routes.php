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

Route::get('/api', 'ServerGameController@api');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/gifts', [
	'as' => 'gifts.index',
	'uses' => 'GiftsController@index'
	]);

Route::post('/gifts', [
	'as' => 'giftdetail.store',
	'uses' => 'GiftDetailsController@store'
	]);




Route::group(['middleware' => 'cors', 'prefix' => 'api/'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('login', 'AuthenticateController@authenticate');
    Route::get('login', 'AuthenticateController@getAuthenticatedUser');


	Route::get('gifts', [
		'as' => 'gifts.api.index',
		'uses' => 'ServerGameController@getGifts'
		]);

	Route::post('gifts', [
		'as' => 'giftdetail.api.store',
		'uses' => 'ServerGameController@store'
		]);
});
