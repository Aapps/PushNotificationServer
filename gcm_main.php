
<?php

require_once 'db_functions.php';
$db = new DB_Functions_GCM();
require_once 'commonutils.php';

//////////////Do some validation First//////////////
$error = 0;
if (isset($_POST['message'])) {
	$pushMessage = $_POST['message'];
	if ($pushMessage == "" || $pushMessage == null) {echo "<br>Error: message can not be empty<br>";
		$error++;
	}
} else {echo "<br>Are you somehow trying to hack me?<br>Forget it buddy...<br>Close your computer and go to sleep...<br>";
	$error++;
}

$nottype = (isset($_REQUEST['dropdown']) ? $_REQUEST['dropdown'] : "select");
if ($nottype == "select") {echo "<br>Error: Notification type must be selected.<br>";
	$error++;
}

//////exit if error/////
if ($error != 0) {echo "<br><a href=\"" . constant("PWD") . "\">Go Back</a><br>";
	exit ;
}

function sendPushNotification($registration_ids, $message) {

	$url = GOOGLE_API_URL;

	$fields = array('registration_ids' => $registration_ids, 'data' => $message, );

	$headers = array('Authorization:key=' . GOOGLE_API_KEY, 'Content-Type: application/json');
	echo json_encode($fields);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	$result = curl_exec($ch);
	if ($result === false)
		die('Curl failed ' . curl_error());

	curl_close($ch);
	return $result;

}

$pushStatus = '';

$query = "SELECT gcm_regid FROM gcm_users";
if ($query_run = mysqli_query($GLOBALS['mysqli_connection'], $query)) {

	$gcmRegIds = array();
	while ($query_row = mysqli_fetch_assoc($query_run)) {

		array_push($gcmRegIds, $query_row['gcm_regid']);

	}

}

if (isset($gcmRegIds) && isset($pushMessage)) {
	$pushMessage = html_entity_decode($pushMessage);
	$message = array($nottype => $pushMessage);
	$regIdChunk = array_chunk($gcmRegIds, 1000);
	foreach ($regIdChunk as $RegId) {
		$pushStatus = sendPushNotification($RegId, $message);
	}
	//redirect(PWD); //Comment this out if you want to redirected to previous page
} else {
	echo "Unknown error occured, contact your Push Notification Service Provider";

	exit ;
}
?>

