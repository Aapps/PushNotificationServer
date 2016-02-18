<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_POST["regId"])) {
	$gcm_regid = $_POST["regId"];
	// GCM Registration ID
	// Store user details in db
	include_once 'db_functions.php';

	$db = new DB_Functions_GCM();

	if ($db -> checkUserById($gcm_regid) == true) {
		$res = $db -> deleteUserById($gcm_regid);

	}
} else {
	// user details missing
}
?>
