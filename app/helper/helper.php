<?php

//use App\Models\Country;
use Illuminate\Http\Response as Response;

/**
 *type array convert into array messages to string messages
 *
 */
function messageCreator($messages) {
	$err = '';
	$msgCount = count($messages->all());
	foreach ($messages->all() as $error) {
		if ($msgCount > 1) {
			$err = $err . ' ' . $error . ',';
		} else {
			$err = $error;
		}
	}
	return $err;
}
//-----type array convert into array messages to string messages-------//
function pingenrator(){
  return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,2).''.rand(1111111111,9999999999);
}
/**
 * get time zone by using ip address
 *
 * @return \Illuminate\Http\Response
 */
function getTimeZoneByIP($ip_address = null) {

	$url = "https://timezoneapi.io/api/ip/$ip_address";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$getdata = curl_exec($ch);
	$data = json_decode($getdata, true);
	if ($data['meta']['code'] == '200') {
		//echo "City: " . $data['data']['city'] . "<br>";
		$date = $data['data']['datetime']['date_time'];
		$old_date_timestamp = strtotime($date);
		return $new_date = date('Y-m-d H:i:s', $old_date_timestamp);

	} else {
		return false;
	}
}

/*
 *get all columns from table
 */
function getTableColumns($table) {
	return DB::getSchemaBuilder()->getColumnListing(trim($table));
}

/*
 *send json response after each request
 */
function sendresponse($code, $status, $message, $arrData) {

	$output['code'] = $code;
	$output['status'] = $status;
	$output['message'] = $message;
	if (empty($arrData)) {
		$arrData = (object) array();
	}
	$output['data'] = $arrData;
	return response()->json($output);
}

/*
 *Check validation after each request
 */
function checkvalidation($request, $rules, $messsages) {

	$validator = Validator::make($request, $rules);
	if ($validator->fails()) {
		$message = $validator->errors();
		$err = '';
		foreach ($message->all() as $error) {
			if (count($message->all()) > 1) {
				$err = $err . ' ' . $error;
			} else {
				$err = $error;
			}
		}
	} else {
		$err = '';
	}
	return $err;
}

/*
 *Send mail
 */
function sendMail($data, $to_mail, $getsubject) {
	$succss = false;
	try {
		$displaypage = $data['pagename'];
		$succss = Mail::send($displaypage, $data, function ($message) use ($to_mail, $getsubject) {
			$from_mail = Config::get('constants.settings.from_email');
			$to_email = $to_mail;
			$project_name = Config::get('constants.settings.projectname');
			$message->from($from_mail, $project_name);
			$message->to($to_email)->subject($project_name . " | " . $getsubject);
		});
	} catch (\Exception $e) {
		return $succss;
	}
	return $succss;
}

/*
 *Send enquiry mail
 */
function sendEnquiryMail($data, $to_mail, $getsubject, $imageName) {

	try {
		$displaypage = $data['pagename'];
		$succss = Mail::send($displaypage, $data, function ($message) use ($to_mail, $getsubject, $imageName) {
			$from_mail = Config::get('constants.settings.from_email');
			$to_email = $to_mail;
			$project_name = Config::get('constants.settings.projectname');
			$message->from($from_mail, $project_name);
			$message->to($to_mail)->subject($project_name . " | " . $getsubject);

			if (!empty($imageName)) {
				$sample = public_path() . '/attachment/' . $imageName;
				$message->attach($sample);
			}
		});
	} catch (\Exception $e) {

		return $succss;
	}
	return $succss;
}

/*
 * Mask mobile numbetr
 */

function maskmobilenumber($number) {

	$masked = substr($number, 0, 2) . str_repeat("*", strlen($number) - 4) . substr($number, -2);
	return $masked;
}

/*
 * Mask email address
 */

function maskEmail($email) {

	$masked = preg_replace('/(?:^|.@).\K|.\.[^@]*$(*SKIP)(*F)|.(?=.*?\.)/', '*', $email);
	return $masked;
}


/*
 *print data
 */
function printData($arrData) {
	echo '<pre>';
	print_r($arrData);
	die();
}

/**
 * [setPaginate description]
 * @param [type] $query  [description]
 * @param [type] $start  [description]
 * @param [type] $length [description]
 */
function setPaginate($query, $start, $length) {

	$totalRecord = $query->get()->count();
	$arrEnquiry = $query->skip($start)->take($length)->get();

	$data['totalRecord'] = 0;
	$data['filterRecord'] = 0;
	$data['record'] = $arrEnquiry;

	if ($totalRecord > 0) {
		$data['totalRecord'] = $totalRecord;
		$data['filterRecord'] = $totalRecord;
		$data['record'] = $arrEnquiry;
	}
	return $data;
}

/**
 * [setPaginate description]
 * @param [type] $query  [description]
 * @param [type] $start  [description]
 * @param [type] $length [description]
 */
function setPaginate1($query, $start, $length) {

	$totalRecord = $query->count();
	$arrEnquiry = $query->skip($start)->take($length)->get();

	$data['totalRecord'] = 0;
	$data['filterRecord'] = 0;
	$data['record'] = $arrEnquiry;

	if ($totalRecord > 0) {
		$data['totalRecord'] = $totalRecord;
		$data['filterRecord'] = $totalRecord;
		$data['record'] = $arrEnquiry;
	}
	return $data;
}

/*
 *convertCurrency
 */
function convertCurrency($amount, $from, $to) {
	$url = file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=' . $from . '_' . $to . '&compact=ultra');
	$json = json_decode($url, true);
	$rate = implode(" ", $json);
	$total = $rate * $amount;
	$rounded = round($total); //optional, rounds to a whole number
	return $total; //or return $rounded if you kept the rounding bit from above
}

function getCountryCode($country) {
	$countryData = Country::where('iso_code', $country)->first();
	return $countryData->code;
}

/*************Send sms ********************/
function sendSMS($mobile, $message) {
	try {
		
		$username = urlencode(Config::get('constants.settings.sms_username'));
		$pass = urlencode(Config::get('constants.settings.sms_pwd'));
		$route = urlencode(Config::get('constants.settings.sms_route'));
		$senderid = urlencode(Config::get('constants.settings.senderId'));
		$numbers = urlencode($mobile);
		$message = urlencode($message);

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://173.45.76.227/send.aspx?username=" . $username . "&pass=" . $pass . "&route=" . $route . "&senderid=" . $senderid . "&numbers=" . $numbers . "&message=" . $message,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		return true;
	} catch (\Exception $e) {
		return true;
	}
}
