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
	// protected $hello = "hello from BaseController";
	// protected function getHello() {return "hello function from BaseController";}

	/**
	 *@return string in JSON format
	 */
	protected $authenticateRequestBody = '{ 
	    "userId": "acc_test+newvision1@apple.com",
	    "password": "Apple1234", 
	    "shipTo": "0000863349", 
	    "langCode": "en", 
	    "timeZone": "-480"
	}';

	protected $verifyOrderBody = '{
            	"requestContext": {"shipTo": "0000863349",
            	"timeZone": "-480","langCode" : "en" },
            	"appleCareSalesDate": "15/11/14",
            	"pocLanguage" : "ENG",
            	"pocDeliveryPreference":"E",
            	"purchaseOrderNumber": "TZ0001",
            	"marketID":"","overridePocFlag": "",
            	"emailFlag": "1",
            	"customerRequest": {"customerFirstName": "Jin",
            	"customerLastName": "Yang",
            	"companyName": "","customerEmailId": "123@qq.com","addressLine1": "",
            	"addressLine2": "","city": "","stateCode": "",
            	"countryCode": "","primaryPhoneNumber": "",
            	"zipCode": ""},
            	"deviceRequest": [{
            	"deviceId": "DLXM2417DFJ3",
            	"secondarySerialNumber": "",
            	"hardwareDateOfPurchase": "15/11/14"}]
	}';


	/**
	 *@return array
	 */
	protected $sandboxService = [
	    "authenticate"=>"https://grxuat-nwk.apple.com/sandbox/authentication-service/1.0/authenticate/",
	    "verifyOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/verify-order/",
	    "createOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/create-order/",
	    "cancelOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/cancel-order/",
	];

	// the use of API is @see ACC Implementation Manual V2.0.pdf:: page 45
	/**
	 *@return array
	 */
	protected $jointUATAPI = [
	    "apiDoc"=>"https://gsxwsut.apple.com/apidocs/acc/uat/html/WSReference.html?user=reseller", // UAT API doc
	    "authenticate"=>"https://api-acc-ept.apple.com/authentication-service/1.0/authenticate/",
	    "verifyOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/verify-order/",
	    "createOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/create-order/",
	    "cancelOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/cancel-order/",
	    "360Lookup"=>"https://api-acc-ept.apple.com/order-service/1.0/get-order/",
	];

	// $url = "https://api-acc-ept.apple.com/authentication-service/1.0/authenticate/";
	/**
	 *@return array
	 */
	protected $cert_file = "cert/file.crt.pem"; // The location of the file related to /public/,  I put it as an asset - URL::asset('cert/file.crt.pem'); to use it in controller
	protected $key_file = "cert/file.key.pem"; // I put it as an asset
	protected $cert_password = "newvision12345a";
	protected $key_password = "newvision12345a";
}
