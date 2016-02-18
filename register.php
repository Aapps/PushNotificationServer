<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_POST["regId"])) {
	//set default values
	$name = 'Anonymous';
	$email = 'anonymous@anonymous.com';
	$instanceId = '';
	$gcm_regid = $_POST["regId"];
	if(isset($_POST["name"])){$name=$_POST["name"];}
	if(isset($_POST["email"])){$email=$_POST["email"];}
	if(isset($_POST["instanceId"])){$instanceId=$_POST["instanceId"];}
	// GCM Registration ID
	// Store user details in db
	include_once 'db_functions.php';

	$db = new DB_Functions_GCM();
	if ($db -> checkUserById($gcm_regid) == false && $gcm_regid != "" && $gcm_regid != null) {
		
			$res = $db -> storeUser($gcm_regid,$instanceId,$name,$email);
			if(!$res){echo 'Failed to write to database';}



	} else {
	 echo 'Invalid regId';
	}
} else {
 echo 'regId not given';
}
?>
