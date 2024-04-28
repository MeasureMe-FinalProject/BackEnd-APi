<?php  
require_once 'db_functions.php';
$db = new DB_Functions();

/*
* Endpoint : https://measureme.mutijayasejahtera.com/get_all_measurement.php
* Method : POST
* Params : id_user
* Result : JSON
*/

$response = array();
if (isset($_POST['id_user'])) 
{
	$id_user = $_POST['id_user'];
	$measurements = $db->getAllMeasurement($id_user);
    if ($measurements) {
    // Menambahkan hasil pengukuran ke respons
    $response["measurement_result"] = $measurements;
    
} else {
    // Jika tidak ada pengukuran yang ditemukan, atur nilai null
    $response["measurement_result"] = 'Failed to get measurement';
   
}
	echo json_encode($response);
}
else {
	$response["error_msg"] = "Required parameter (id_user) is missing";
	echo json_encode($response);
	
}
?>
