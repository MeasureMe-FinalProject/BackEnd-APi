<?php  
require_once 'db_functions.php';
$db = new DB_Functions();

/*
* Endpoint : https://measureme.mutijayasejahtera.com/register_user.php
* Method : POST
* Params : name, email, password
* Result : JSON
*/



$response = array();
if (isset($_POST['name']) && 
    isset($_POST['email']) &&
	isset($_POST['password'])) 
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	if ($db->checkExitsUser($email)) {
		$response["error_msg"] = "User already exsted with".$email;
		echo json_encode($response);
	}
	else
	{
		// Create new user
		$user = $db->registerNewUser($name,$email,$password);
		if ($user) 
		{
			$response["name"] = $user["name"];
			$response["email"] = $user["email"];
			$response["password"] = $user["password"];
			$response["age"] = $user["age"];
			$response["gender"] = $user["gender"];
			$response["height"] = $user["height"];
			$response["weight"] = $user["weight"];
			echo json_encode($response);
		}
		else
		{
			$response["error_msg"] = "Unknown error occurred in registration!";
			echo json_encode($response);
		}
	}
}
else {
	$response["error_msg"] = "Required parameter (name,email,password) is missing";
	echo json_encode($response);
	
}
?>