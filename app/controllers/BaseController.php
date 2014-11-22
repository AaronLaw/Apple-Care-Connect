<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Class variable used for API connection
	 */
	// the json format information, http://php.net/manual/zh/book.json.php
	public $hello = "hello from BaseController";
	public function getHello() {return "hello function from BaseController";}
	public $authenticateRequestBody = '{ 
	    "userId": "acc_test+newvision1@apple.com",
	    "password": "Apple1234", 
	    "shipTo": "0000863349", 
	    "langCode": "en", 
	    "timeZone": "-480"
	}';

	public $sandboxService = [
	    "authenticate"=>"https://grxuat-nwk.apple.com/sandbox/authentication-service/1.0/authenticate/",
	    "verifyOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/verify-order/",
	    "createOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/create-order/",
	    "cancelOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/cancel-order/",
	];

	// the use of API is @see ACC Implementation Manual V2.0.pdf:: page 45
	public $jointUATAPI = [
	    "apiDoc"=>"https://gsxwsut.apple.com/apidocs/acc/uat/html/WSReference.html?user=reseller", // UAT API doc
	    "authenticate"=>"https://api-acc-ept.apple.com/authentication-service/1.0/authenticate/",
	    "verifyOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/verify-order/",
	    "createOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/create-order/",
	    "cancelOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/cancel-order/",
	    "360Lookup"=>"https://api-acc-ept.apple.com/order-service/1.0/get-order/",
	];

	// $url = "https://api-acc-ept.apple.com/authentication-service/1.0/authenticate/";
	public $cert_file = "./file.crt.pem";
	public $key_file = "./file.key.pem";
	public $cert_password = "newvision12345a";
	public $key_password = "newvision12345a";
}
