<?php
require_once 'config.php';

class DB_Functions_GCM {

	//put your code here
	// constructor
	function __construct() {
		// connecting to database
		$GLOBALS['mysqli_connection'] = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die("Mysqli Error " . mysqli_error($GLOBALS['mysqli_connection']));

	}

	// destructor
	function __destruct() {

	}

	public function connectDefaultDatabase() {

		$GLOBALS['mysqli_connection'] = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die("Mysqli Error " . mysqli_error($GLOBALS['mysqli_connection']));
		return $GLOBALS['mysqli_connection'];
	}

	public function selectDatabase($db) {
		mysqli_select_db($GLOBALS['mysqli_connection'], $db);
	}

	public function closeDatabase() {
		mysqli_close($GLOBALS['mysqli_connection']);
	}

	public function connectNewDatabase($host, $user, $password, $dbname = "") {
		closeDatabase();

		if ($dbname != "" && $dbname != null) {
			$GLOBALS['mysqli_connection'] = mysqli_connect($host, $user, $password, $dbname) or die("Mysqli Error " . mysqli_error($GLOBALS['mysqli_connection']));
		} else {$GLOBALS['mysqli_connection'] = mysqli_connect($host, $user, $password) or die("Mysqli Error " . mysqli_error($GLOBALS['mysqli_connection']));
		}

		return $GLOBALS['mysqli_connection'];
	}

	/**
	 * Storing new user
	 * returns user details
	 */

	/**
	 * Get user by email and password
	 */
	public function getUserByEmail($email) {
		$result = mysqli_query($GLOBALS['mysqli_connection'], "SELECT * FROM gcm_users WHERE email = '$email' LIMIT 1");
		return $result;
	}

	public function getUserByName($username) {
		$result = mysqli_query($GLOBALS['mysqli_connection'], "SELECT * FROM gcm_users WHERE name = '$username' LIMIT 1");
		return $result;
	}

	public function getUserById($id) {
		$result = mysqli_query($GLOBALS['mysqli_connection'], "SELECT * FROM gcm_users WHERE id = '$id' LIMIT 1");
		return $result;
	}

	/**
	 * Getting all users
	 */
	public function getAllUsers() {
		$result = mysqli_query($GLOBALS['mysqli_connection'], "select * FROM gcm_users");
		return $result;
	}

	/**
	 * Check user exists or not
	 */
	public function checkUserById($id) {
		$result = mysqli_query($GLOBALS['mysqli_connection'], "SELECT gcm_regid from gcm_users WHERE gcm_regid = '$id'");
		$no_of_rows = mysqli_num_rows($result);
		if ($no_of_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteUserById($id) {
		$result = mysqli_query($GLOBALS['mysqli_connection'], "DELETE FROM gcm_users WHERE gcm_regid = '$id'");
		if ($result) {
			return true;
		} else {
			return false;
		}

	}

	public function storeUser($gcm_regid, $instanceId, $name, $email) {
	echo "$gcm_regid";
		// insert user into database
		$result = mysqli_query($GLOBALS['mysqli_connection'], "INSERT INTO gcm_users(name, email, gcm_instance_id, gcm_regid, created_at) VALUES('$name', '$email', '$instanceId', '$gcm_regid', NOW())");
		
		// check for successful store
		if ($result) {
			// get user details
			$id = mysqli_insert_id($GLOBALS['mysqli_connection']);
			// last inserted id
			$result = mysqli_query($GLOBALS['mysqli_connection'], "SELECT * FROM gcm_users WHERE id = $id") or die("Error " . mysqli_error($GLOBALS['mysqli_connection']));
			// return user details
			if (mysqli_num_rows($result) > 0) {
				return mysqli_fetch_array($result);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}
?>