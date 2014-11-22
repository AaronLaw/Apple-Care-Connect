<?php
use BaseController; // ref: Laravel Code Bright::Controller, P.86

class TestController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
// Non-RESTful
	public function connect()
	{
		// return "test/connect";
		$test = new BaseController;
		var_dump($test->hello.'\n');
		var_dump($test->getHello());
	}

// RESTful
}