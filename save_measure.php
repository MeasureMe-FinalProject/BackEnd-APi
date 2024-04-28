<?php
require_once 'db_functions.php';
$db = new DB_Functions();

/*
* Endpoint : https://measureme.mutijayasejahtera.com/save_measure.php
* Method : POST
* Params : id_user, height, size_recommendation, bust_circumference, waist_circumference, hip_circumference, shoulder_width, sleeve_length, pants_length
* Result : JSON
*/

$response = array();
if (
    isset($_POST['id_user']) &&
    isset($_POST['height']) &&
    isset($_POST['size_recommendation']) &&
    isset($_POST['bust_circumference']) &&
    isset($_POST['waist_circumference']) &&
    isset($_POST['hip_circumference']) &&
    isset($_POST['shoulder_width']) &&
    isset($_POST['sleeve_length']) &&
    isset($_POST['pants_length'])
) {
    $id_user = $_POST['id_user'];
    $height = $_POST['height'];
    $size_recommendation = $_POST['size_recommendation'];
    $bust_circumference = $_POST['bust_circumference'];
    $waist_circumference = $_POST['waist_circumference'];
    $hip_circumference = $_POST['hip_circumference'];
    $shoulder_width = $_POST['shoulder_width'];
    $sleeve_length = $_POST['sleeve_length'];
    $pants_length = $_POST['pants_length'];

    $user = $db->saveResultMeasurement($id_user, $height, $size_recommendation, $bust_circumference, $waist_circumference, $hip_circumference, $shoulder_width, $sleeve_length, $pants_length);
    if ($user !== false) {
        $response["success"] = "Success add Measurement Result";
        echo json_encode($response);
    } else {
        $response["error_msg"] = "Failed to save measurement!";
        echo json_encode($response);
    }
} else {
    $response["error_msg"] = "Required parameter (id_user, height, size_recommendation, bust_circumference, waist_circumference, hip_circumference, shoulder_width, sleeve_length, pants_length) is missing";
    echo json_encode($response);
}
?>