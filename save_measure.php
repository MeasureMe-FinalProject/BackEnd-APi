<?php
require_once 'db_functions.php';
$db = new DB_Functions();

// Function to send JSON response with HTTP status code
function send_json_response($status_code, $status, $message) {
    http_response_code($status_code); // Set HTTP status code
    header('Content-Type: application/json'); // Set content type to JSON
    echo json_encode([
        'status' => $status,
        'message' => $message,
    ]);
}

try {
    // Check if all required parameters are set and not empty
    if (
        isset($_POST['id_user']) && !empty($_POST['id_user']) &&
        isset($_POST['height']) && !empty($_POST['height']) &&
        isset($_POST['size_recommendation']) && !empty($_POST['size_recommendation']) &&
        isset($_POST['bust_circumference']) && !empty($_POST['bust_circumference']) &&
        isset($_POST['waist_circumference']) && !empty($_POST['waist_circumference']) &&
        isset($_POST['hip_circumference']) && !empty($_POST['hip_circumference']) &&
        isset($_POST['shoulder_width']) && !empty($_POST['shoulder_width']) &&
        isset($_POST['sleeve_length']) && !empty($_POST['sleeve_length']) &&
        isset($_POST['pants_length']) && !empty($_POST['pants_length']) &&
        isset($_POST['date']) && !empty($_POST['date']) &&
        isset($_POST['type_clothes']) && !empty($_POST['type_clothes'])
    ) {
        // Extract parameters
        $id_user = $_POST['id_user'];
        $height = $_POST['height'];
        $size_recommendation = $_POST['size_recommendation'];
        $bust_circumference = $_POST['bust_circumference'];
        $waist_circumference = $_POST['waist_circumference'];
        $hip_circumference = $_POST['hip_circumference'];
        $shoulder_width = $_POST['shoulder_width'];
        $sleeve_length = $_POST['sleeve_length'];
        $pants_length = $_POST['pants_length'];
        $date = $_POST['date'];
        $type_clothes = $_POST['type_clothes'];

        // Save the measurement
        $result = $db->saveResultMeasurement(
            $id_user,
            $height,
            $size_recommendation,
            $bust_circumference,
            $waist_circumference,
            $hip_circumference,
            $shoulder_width,
            $sleeve_length,
            $pants_length,
            $date,
            $type_clothes
        );

        if ($result) {
            // If the insertion was successful
            send_json_response(201, "success", "Measurement saved successfully"); // 201 Created
        } else {
            // If the insertion failed
            send_json_response(500, "error", "Failed to save measurement"); // 500 Internal Server Error
        }
    } else {
        // If any required parameter is missing or empty
        send_json_response(400, "error", "One or more required parameters are empty"); // 400 Bad Request
    }
} catch (Exception $e) {
    // If there is an unexpected error
    send_json_response(500, "error", "An unexpected error occurred: " . $e->getMessage()); // 500 Internal Server Error
}
?>

