<?php  
require_once 'db_functions.php';
$db = new DB_Functions();

/*
* Endpoint : https://measureme.mutijayasejahtera.com/login_user.php
* Method : POST
* Params : email, password
* Result : JSON
*/

$response = array();
if (isset($_POST['email']) && 
	isset($_POST['password'])) 
{
	$adminEmail = $_POST['email'];
	$adminPassword = $_POST['password'];
	$user = $db->loginAdmin($adminEmail,$adminPassword);

	if ($user) {
			$response["id"] = $user["id"];
			$response["name"] = $user["name"];
			$response["email"] = $user["email"];			
			$response["password"] = $user["password"];

			echo json_encode($response);
	}
	else
	{
		$response["error_msg"] = "Email atau password salah!";
		echo json_encode($response);	
	}
	
}
else {
	$response["error_msg"] = "Required parameter (email, password) is missing";
	echo json_encode($response);

}
?>