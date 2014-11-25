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
		// $test = new TestController;
		// var_dump($this->authenticateRequestBody);
		// var_dump($this->jointUATAPI);
		// var_dump(asset('cert/file.crt.pem'));
		var_dump($this->cert_file);
		var_dump(URL::asset('img/icon.png') );
		var_dump(URL::asset('cert/file.crt.pem') );
		var_dump(URL::asset($this->cert_file));

		$ch = curl_init(); // $ch is curl_handle, http://stackoverflow.com/questions/3062324/what-is-curl-in-php
		curl_setopt($ch, CURLOPT_URL, $this->jointUATAPI['verifyOrder'] );
		// curl_setopt($ch, CURLOPT_SSLCERT, URL::asset($this->cert_file) );
		// curl_setopt($ch, CURLOPT_SSLKEY, URL::asset($this->key_file) );
		curl_setopt($ch, CURLOPT_SSLCERT, "http://davidleung.idv.hk/ACC_function_test/file.crt.pem" );
		curl_setopt($ch, CURLOPT_SSLKEY, "http://davidleung.idv.hk/ACC_function_test/file.key.pem" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
		curl_setopt($ch, CURLOPT_POST, True);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->verifyOrderBody);
		$result = curl_exec($ch);
		// Cannot curl_close() the ch before the curl_error() or curl_errno(), see: http://stackoverflow.com/questions/19442999/getting-curl-error-2-is-not-a-valid-curl-handle-resource-while-fetching-all-u 
		// otherwise, encounter an error: curl_error(): 4 is not a valid cURL handle resource.
		//, from Google: laravel curl curl_error(): 4 is not a valid cURL handle resource. 
		// curl_close($ch); 
		echo "Testing verify order...";
		if(!$result)
		{
		    echo "Curl Error : " . curl_error($ch);
		}
		else
		{
		    // echo htmlentities($result);
		    echo "Verify order success: ". $result;
		}
		curl_close($ch);
	}

// RESTful
}