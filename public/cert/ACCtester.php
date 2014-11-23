<?php
/*
* Apple Care Connection tester
*
* @see the ACC Implementation Manual V2.0.pdf
* Page 45, 48
* 
* I test it with a min set of JSON data provide to the API
*/
?>

<?php 
// the json format information, http://php.net/manual/zh/book.json.php
$authenticateRequestBody = '{ 
    "userId": "acc_test+newvision1@apple.com",
    "password": "Apple1234", 
    "shipTo": "0000863349", 
    "langCode": "en", 
    "timeZone": "-480"
}';

$sandboxService = [
    "authenticate"=>"https://grxuat-nwk.apple.com/sandbox/authentication-service/1.0/authenticate/",
    "verifyOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/verify-order/",
    "createOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/create-order/",
    "cancelOrder"=>"https://grxuat-nwk.apple.com/sandbox/order-service/1.0/cancel-order/",
];

// the use of API is @see ACC Implementation Manual V2.0.pdf:: page 45
$jointUATAPI = [
    "apiDoc"=>"https://gsxwsut.apple.com/apidocs/acc/uat/html/WSReference.html?user=reseller", // UAT API doc
    "authenticate"=>"https://api-acc-ept.apple.com/authentication-service/1.0/authenticate/",
    "verifyOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/verify-order/",
    "createOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/create-order/",
    "cancelOrder"=>"https://api-acc-ept.apple.com/order-service/1.0/cancel-order/",
    "360Lookup"=>"https://api-acc-ept.apple.com/order-service/1.0/get-order/",
];

// $url = "https://api-acc-ept.apple.com/authentication-service/1.0/authenticate/";
$cert_file = "./file.crt.pem";
$key_file = "./file.key.pem";
$cert_password = "newvision12345a";
$key_password = "newvision12345a";



/**
 * Section: Testing authentication
*/
$ch = curl_init(); // $ch is curl_handle, http://stackoverflow.com/questions/3062324/what-is-curl-in-php
curl_setopt($ch, CURLOPT_URL, $jointUATAPI['authenticate'] );
curl_setopt($ch, CURLOPT_SSLCERT, $cert_file);
curl_setopt($ch, CURLOPT_SSLKEY, $key_file);
// curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $key_password);
// curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $cert_password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
curl_setopt($ch, CURLOPT_POST, True);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $authenticateRequestBody);
$result = curl_exec($ch);
curl_close($ch);

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

?>
<?php
// @see ACC Implementation Manual V2.0.pdf::page 59

// the response token is used to perform and invoked in other API: verify, create, cancel
// a successful response will contain the “accessToken” . This token needs to be passed in all subsequent requests (e.g. create, verify, cancel) as part of the http header
// change $accessToken every 30 min, after each auth session
$responseToken = json_decode($result); // convert the  responsed JSON info into PHP array

// $accessToken example: = "5125582c5fba8f931e8bb5e73607421aa8d51dd654b2f2f7b29772d3475cac2f62888e4f3f046d3ba7bcf5408b971bed3ff29de0c82b365793882a10578b8c";
// easily cast an stdClass object to array, since it is just a container, http://stackoverflow.com/questions/18654425/php-fatal-error-cannot-use-object-of-type-stdclass-as-array-in-mongo-db-and-cod
$responseToken = (array) $responseToken;
$accessToken = $responseToken["accessToken"];
?>

<?php
/**
 * Section: Testing Create order



$CreateBody = '{
    "requestContext": {
        "shipTo": "0000863349", 
        "langCode": "en", 
        "timeZone": "-480"
    },
    "appleCareSalesDate": "09/11/13",
    "pocLanguage": "EN",
    "pocDeliveryPreference": "E",
    "purchaseOrderNumber": "12345",
    "MRC": "Y",
    "marketID": "",
    "overridePocFlag": "",
    "emailFlag": "1",
    "customerRequest": {
        "customerFirstName": "Nicholas",
        "customerLastName": "doe",
        "companyName": "",
        "customerEmailId": "nicholasdoe@nobody.com",
        "addressLine1": "No:454,NewCity",
        "addressLine2": "",
        "city": "",
        "stateCode": "",
        "countryCode": "",
        "primaryPhoneNumber": "6754657654",
        "zipCode": ""
    },
    "deviceRequest": [
        {
            "deviceId": "DNPL1008DTTP",
            "secondarySerialNumber": "",
            "hardwareDateOfPurchase": "09/11/13"
        }
    ]
}';
*/

/*
$CreateBody='{
"requestContext": {"shipTo": "0000863349",
"timeZone": "-480","langCode" : "en" },
"appleCareSalesDate": "14/11/14",
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
"deviceId": "C02M2268FFT0",
"secondarySerialNumber": "",
"hardwareDateOfPurchase": "14/11/14"}]
}';



echo $CreateBody;

$ch_create = curl_init(); 
// $ch is curl_handle, http://stackoverflow.com/questions/3062324/what-is-curl-in-php
curl_setopt($ch_create, CURLOPT_URL, $jointUATAPI['createOrder'] );
curl_setopt($ch_create, CURLOPT_SSLCERT, $cert_file);
curl_setopt($ch_create, CURLOPT_SSLKEY, $key_file);
curl_setopt($ch_create, CURLOPT_SSLKEYPASSWD, $key_password);
curl_setopt($ch_create, CURLOPT_SSLCERTPASSWD, $cert_password);
curl_setopt($ch_create, CURLOPT_RETURNTRANSFER, True);
curl_setopt($ch_create, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
curl_setopt($ch_create, CURLOPT_POST, True);
curl_setopt($ch_create, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch_create, CURLOPT_POSTFIELDS, $CreateBody);
$result3 = curl_exec($ch_create);


echo "\nTesting create order...";
if(!$result3)
{
    echo "Curl Error : " . curl_error($ch_create);
}
else
{
    // echo htmlentities($result);
    echo "Create success: ". $result3;
}

curl_close($ch_create);
*/



/**
 * Section: Testing verify order
*/
$verifyOrderBody = '{
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

//echo $verifyOrderBody;

$ch_verify = curl_init(); // $ch is curl_handle, http://stackoverflow.com/questions/3062324/what-is-curl-in-php
curl_setopt($ch_verify, CURLOPT_URL, $jointUATAPI['verifyOrder'] );
curl_setopt($ch_verify, CURLOPT_SSLCERT, $cert_file);
curl_setopt($ch_verify, CURLOPT_SSLKEY, $key_file);
curl_setopt($ch_verify, CURLOPT_SSLKEYPASSWD, $key_password);
curl_setopt($ch_verify, CURLOPT_SSLCERTPASSWD, $cert_password);
curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, True);
curl_setopt($ch_verify, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
curl_setopt($ch_verify, CURLOPT_POST, True);
curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch_verify, CURLOPT_POSTFIELDS, $verifyOrderBody);
$result1 = curl_exec($ch_verify);


echo "\nTesting verify order...";
if(!$result1)
{
    echo "Curl Error : " . curl_error($ch_verify);
}
else
{
    // echo htmlentities($result);
    echo "Verify success: ". $result1;
}

curl_close($ch_verify);
?>

<?php
/**
 * Section: Testing cancel order
*/
$cancelOrderBody = '{
    "deviceId": "C02M2268FFT0",
    "purchaseOrderNumber": "",
    "cancellationDate": "14/11/14",
    "cancelReasonCode": "01",
    "requestContext": {
        "langCode": "en",
        "shipTo": "0000863349",
        "timeZone": -480
    }
}';

$ch_cancel = curl_init(); // $ch is curl_handle, http://stackoverflow.com/questions/3062324/what-is-curl-in-php
curl_setopt($ch_cancel, CURLOPT_URL, $jointUATAPI['cancelOrder'] );
curl_setopt($ch_cancel, CURLOPT_SSLCERT, $cert_file);
curl_setopt($ch_cancel, CURLOPT_SSLKEY, $key_file);
curl_setopt($ch_cancel, CURLOPT_SSLKEYPASSWD, $key_password);
curl_setopt($ch_cancel, CURLOPT_SSLCERTPASSWD, $cert_password);
curl_setopt($ch_cancel, CURLOPT_RETURNTRANSFER, True);
curl_setopt($ch_cancel, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
curl_setopt($ch_cancel, CURLOPT_POST, True);
curl_setopt($ch_cancel, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch_cancel, CURLOPT_POSTFIELDS, $cancelOrderBody);
$result2 = curl_exec($ch_cancel);


echo "\nTesting cancel order...";
if(!$result2)
{
    echo "Curl Error : " . curl_error($ch_cancel);
}
else
{
    // echo htmlentities($result);
    echo "Cancel Ordel success: ". $result2;
}

curl_close($ch_cancel);
?>