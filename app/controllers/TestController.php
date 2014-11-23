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
		$test = new TestController;
		// var_dump($test->authenticateRequestBody);
		// var_dump($test->jointUATAPI);
		// var_dump(asset('cert/file.crt.pem'));
		var_dump($test->cert_file);
		var_dump(URL::asset('img/icon.png') );
		var_dump(URL::asset('cert/file.crt.pem') );
		var_dump(URL::asset($test->cert_file));

		$ch = curl_init(); // $ch is curl_handle, http://stackoverflow.com/questions/3062324/what-is-curl-in-php
		curl_setopt($ch, CURLOPT_URL, $test->jointUATAPI['authenticate'] );
		curl_setopt($ch, CURLOPT_SSLCERT, URL::asset($test->cert_file) );
		curl_setopt($ch, CURLOPT_SSLKEY, URL::asset($test->key_file) );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
		curl_setopt($ch, CURLOPT_POST, True);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $test->authenticateRequestBody);
		$result = curl_exec($ch);
		// Cannot curl_close() the ch before the curl_error() or curl_errno(), see: http://stackoverflow.com/questions/19442999/getting-curl-error-2-is-not-a-valid-curl-handle-resource-while-fetching-all-u 
		// otherwise, encounter an error: curl_error(): 4 is not a valid cURL handle resource.
		//, from Google: laravel curl curl_error(): 4 is not a valid cURL handle resource. 
		// curl_close($ch); 
		echo "Testing Authentication...";
		if(!$result)
		{
		    echo "Curl Error : " . curl_error($ch);
		}
		else
		{
		    // echo htmlentities($result);
		    echo "Authentication success: ". $result;
		}
		curl_close($ch);
	}

// RESTful
}