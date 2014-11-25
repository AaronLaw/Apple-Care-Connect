// protected $verifyOrderBody = '{
 //            	"requestContext": {"shipTo": "0000863349",
 //            	"timeZone": "-480","langCode" : "en" },
 //            	"appleCareSalesDate": "15/11/14",
 //            	"pocLanguage" : "ENG",
 //            	"pocDeliveryPreference":"E",
 //            	"purchaseOrderNumber": "TZ0001",
 //            	"marketID":"","overridePocFlag": "",
 //            	"emailFlag": "1",
 //            	"customerRequest": 
 			{"customerFirstName": "Jin",
	 //            	"customerLastName": "Yang",
	 //            	"companyName": "","customerEmailId": "123@qq.com","addressLine1": "",
	 //            	"addressLine2": "","city": "","stateCode": "",
	 //            	"countryCode": "","primaryPhoneNumber": "",
	 //            	"zipCode": ""},
 //            	"deviceRequest": [{
	 //            	"deviceId": "DLXM2417DFJ3",
	 //            	"secondarySerialNumber": "",
	 //            	"hardwareDateOfPurchase": "15/11/14"
	 //}]
// }';


<h1>Verify an order</h1>
{{ Form::open(['url'=> 'order/verify']) }} <br />

{ { Form::model($order)}}

{{ Form::label('pocLanguage', 'POC Language: ')}} {{ Form::text('pocLanguage', 'ENG') }} <br />
{{ Form::label('pocDeliveryPreference', 'POC delivery preference: ')}} {{ Form::text('pocDeliveryPreference', 'E') }} <br />
{{ Form::label('purchaseOrderNumber', 'Purchase Order Number: ')}} {{ Form::text('purchaseOrderNumber') }} <br />
{{ Form::label('marketID', 'Market ID: ')}} {{ Form::text('marketID') }} <br />
{{ Form::label('overridePocFlag', 'POC Language: ')}} {{ Form::text('overridePocFlag') }} <br />
{{ Form::label('emailFlag', 'Email Flag: ')}} {{ Form::select('emailFlag', array(
	0 => 'N',
	1 => 'Y',
	), 1) }} <br />
{{ Form::label('customerRequest', 'Customer Request: ')}} <br />
<ul>
	<li>{{ Form::label('customerFirstName', 'First Name: ')}} {{ Form::text('customerFirstName') }} </li>
	<li>{{ Form::label('customerLastName', 'Last Name: ')}} {{ Form::text('customerLastName') }} </li>
	<li>{{ Form::label('customerEmailId', 'Customer Email: ')}} {{ Form::email('customerEmailId') }} </li>
	<li>{{ Form::label('companyName', 'company Name: ')}} {{ Form::text('companyName') }} </li>
</ul>
{{ Form::label('deviceRequest', 'POC Language: ')}}<br />
<ul>
	<li>{{ Form::label('deviceId', 'Device ID: ')}} {{ Form::text('deviceId') }} </li>
	<li>{{ Form::label('secondarySerialNumber', '2nd Serial Number: ')}} {{ Form::text('secondarySerialNumber') }} </li>
	<li>{{ Form::label('hardwareDateOfPurchase', 'Date of Purchase: ')}} {{ Form::input('date','hardwareDateOfPurchase', $value=null) }} </li>
	<!-- https://blog.smalldo.gs/2014/04/laravel-4-html5-input-elements/ -->
</ul>
{{ Form::submit('verify order') }} <br />
{{ Form::close() }} <br />