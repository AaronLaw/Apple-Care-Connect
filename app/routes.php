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

/*
* test
*/
Route::get('/', function()
{
	return View::make('hello');
});

/*
* root
*/
// Route::get('/', [
// 	'as' => 'home',
// 	'uses' => 'HomeController@index'
// 	]);
Route::get('test/connect', [
	'as' => 'testConnect',
	'uses' => 'TestController@connect'
	]);


Route::get('/test', function() {
	$user = new User;
	$user->email = "test@test.com";
	$user->real_name = "Test account";
	$user->password = "test";

	$user->save();

	return "The test user has been saved to database";
});

// Route::get('cert/file.crt.pem', function() {

// });
