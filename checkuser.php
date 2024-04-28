<?php  
require_once 'db_functions.php';
$db = new DB_Functions();

/*
* Endpoint : https://measureme.mutijayasejahtera.com/checkuser.php
* Method : POST
* Params : email
* Result : JSON
*/

$response = array();
if (isset($_POST['email'])) 
{
	$phone = $_POST['email'];

	if ($db->checkExitsUser($email)) {
		$response["exists"] = "User already exists with".$email;
		echo json_encode($response);
	}
	else
	{
		$response["error_msg"] = "User not exists";
		echo json_encode($response);	
	}
	
}
else {
	$response["error_msg"] = "Required parameter (email) is missing";
	echo json_encode($response);

}
?>