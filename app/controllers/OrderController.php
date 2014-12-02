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
 //	protected $verifyOrderBody = '{
 //            	"requestContext": {
 //			"shipTo": "0000863349",
 //            		"timeZone": "-480",
 //			"langCode" : "en" },
 //            	"appleCareSalesDate": "15/11/14",
 //            	"pocLanguage" : "ENG",
 //            	"pocDeliveryPreference":"E",
 //            	"purchaseOrderNumber": "TZ0001",
 //            	"marketID":"","overridePocFlag": "",
 //            	"emailFlag": "1",
 //            	"customerRequest": {
 //			"customerFirstName": "Jin",
 //            		"customerLastName": "Yang",
 //            		"companyName": "",
 //			"customerEmailId": "123@qq.com",
 //			"addressLine1": "",
 //            		"addressLine2": "",
 //			"city": "",
 //			"stateCode": "",
 //            		"countryCode": "",
 //			"primaryPhoneNumber": "",
 //            		"zipCode": ""},
 //            	"deviceRequest": [{
 //	            	"deviceId": "DLXM2417DFJ3",
 //        	    	"secondarySerialNumber": "",
 //            		"hardwareDateOfPurchase": "15/11/14"}]
 //	 }';
// Non-RESTful route

	public function showWelcome()
	{
		return View::make('hello');
	}
	// private function connect() {}
	private function arrayToJSON($array) 
	{
		// serialize($array);
		$array = $this->intendArrayStructure($array);
		return json_encode($array);
		// return $json;
	}
	private function JSONToArray($json) {}
	private function intendArrayStructure($array)
	{
		 //            	"requestContext": {
		 //			"shipTo": "0000863349",
		 //            		"timeZone": "-480",
		 //			"langCode" : "en" },
		 //            	"appleCareSalesDate": "15/11/14",
		 //            	"pocLanguage" : "ENG",
		 //            	"pocDeliveryPreference":"E",
		 //            	"purchaseOrderNumber": "TZ0001",
		 //            	"marketID":"",
		 //		"overridePocFlag": "",
		 //            	"emailFlag": "1",
		 //            	"customerRequest": {
		 //			"customerFirstName": "Jin",
		 //            		"customerLastName": "Yang",
		 //            		"companyName": "",
		 //			"customerEmailId": "123@qq.com",
		 //			"addressLine1": "",
		 //            		"addressLine2": "",
		 //			"city": "",
		 //			"stateCode": "",
		 //            		"countryCode": "",
		 //			"primaryPhoneNumber": "",
		 //            		"zipCode": ""},
		 //            	"deviceRequest": [{
		 //	            	"deviceId": "DLXM2417DFJ3",
		 //        	    	"secondarySerialNumber": "",
		 //            		"hardwareDateOfPurchase": "15/11/14"}]


	 			// var_dump($array);
		$intendedArray = array( // create an multi-dimension array preparing for the intended JSON
	            	"requestContext" => array(
	 			// "shipTo"			=> $array['shipTo'],
	 			// "timeZone"			=> $array['timeZone'],
	 			// "langCode"			=> $array['langCode'],
	 			"shipTo"			=> "0000863349",
	            		"timeZone"			=> "-480",
	 			"langCode"			=> "en",
	            		),
	            	// "appleCareSalesDate"		=> $array['appleCareSalesDate'],
	            	"appleCareSalesDate"		=> "15/11/14",
			"pocLanguage"			=> $array["pocLanguage"],
			"pocDeliveryPreference"		=> $array["pocDeliveryPreference"],
			"purchaseOrderNumber"		=> $array["purchaseOrderNumber"],
	            	"marketID" 				=> $array["marketID"],
		 	"overridePocFlag"			=> $array["overridePocFlag"],
	            	"emailFlag" 				=> $array["emailFlag"],

			"customerRequest" => array(
	 			"customerFirstName" 	=> $array["customerFirstName"],
	            		"customerLastName"		=> $array["customerLastName"],
	            		"companyName" 		=> $array["companyName"],
	 			"customerEmailId"		=> $array["customerEmailId"],
	 			// "addressLine1" 		=> $array["addressLine1"],
	            		//  "addressLine2"		=> $array["addressLine2"],
	 			// "city"			=> $array["city"], 
	 			//  "stateCode"		=> $array["stateCode"], 
	            		//  "countryCode"		=> $array["countryCode"],
	 			//  "primaryPhoneNumber"	=> $array["primaryPhoneNumber"], 
				//  "zipCode"			=> $array["zipCode"],
				),
	 	 	"deviceRequest" => array(
	 		 	"deviceId"			=> $array["deviceId"],
				"secondarySerialNumber"	=> $array["secondarySerialNumber"],
	            		"hardwareDateOfPurchase" => $array["hardwareDateOfPurchase"],
	            		),
			);

	            	// var_dump($intendedArray);
	            	return $intendedArray;
	}
	private function verifyOrder($json) { var_dump($json); }

// RESTful route
	public function getIndex() 
	{
		// return "The index.";
		return View::make('orders.index');
	}


	// Route::(order/verify)
	public function getVerify()
	{
		// show the FORM to user
		// collect the user input data, then submit in POST
		return View::make('orders.verify');
	}
	public function postVerify()
	{
		// $order = new Order;
		// $customerFirstName = Input::get('customerFirstName');
		// var_dump($customerFirstName);
		// return "postVerify()";
		
		// get the input from FORM
		// if the data is ok
			// convert the POST array to JSON
			// send to API to verify
		// else
			// ask user to re-submit
		// get the response data from API
		// if the reponse is ok
			// tell user
		// else
			// show the error msg 
		$post = Input::all();

		if ($post)
		{
			$json = $this->arrayToJSON($post);
			// print_r($json);
			// echo "var_dump($json)";
			try
			{
				$conn = $this->connect(); 
				if (!$conn)
				{
					throw new Exception('Cannot connect to API server');
				}
			}
			catch (Exception $e)
			{
				echo $e->getMessage();
			}
		//	$this->verifyOrder($json);
		}
		else 
		{
			// return "You should fill in the form again.";
			return Redirect::to('order/verify')->with('message', 'You should fill in the form again');
		}
	}


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