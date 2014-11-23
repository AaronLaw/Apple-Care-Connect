<?php

class OrderController extends BaseController {

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
	// protected $verifyOrderBody = '{
 //            	"requestContext": {"shipTo": "0000863349",
 //            	"timeZone": "-480","langCode" : "en" },
 //            	"appleCareSalesDate": "15/11/14",
 //            	"pocLanguage" : "ENG",
 //            	"pocDeliveryPreference":"E",
 //            	"purchaseOrderNumber": "TZ0001",
 //            	"marketID":"","overridePocFlag": "",
 //            	"emailFlag": "1",
 //            	"customerRequest": {"customerFirstName": "Jin",
 //            	"customerLastName": "Yang",
 //            	"companyName": "","customerEmailId": "123@qq.com","addressLine1": "",
 //            	"addressLine2": "","city": "","stateCode": "",
 //            	"countryCode": "","primaryPhoneNumber": "",
 //            	"zipCode": ""},
 //            	"deviceRequest": [{
 //            	"deviceId": "DLXM2417DFJ3",
 //            	"secondarySerialNumber": "",
 //            	"hardwareDateOfPurchase": "15/11/14"}]
	// }';
// Non-RESTful route

	public function showWelcome()
	{
		return View::make('hello');
	}
	// private function connect() {}
	private function arrayToJSON() {}
	private function JSONToArray() {}

// RESTful route
	public function getIndex() 
	{
		// return "The index.";
		return View::make('orders.index');
	}


	// Route::(order/verify)
	public function getVerify()
	{
		return View::make('orders.verify');
	}
	public function postVerify(){}


	// Route::(order/create)
	public function getCreate()
	{
		return View::make('orders.create');
	}
	public function postCreate(){}

	
	// Route::(order/cancell)
	public function getCancell($order_id)
	{
		return View::make('orders.create');
	}
	public function postCancell(){}
}
