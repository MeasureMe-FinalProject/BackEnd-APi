<?php
require_once 'db_functions.php';
$db = new DB_Functions();

// Function to send JSON response with HTTP status code
function send_json_response($status_code, $status, $message, $additional_data = null) {
    http_response_code($status_code); // Set HTTP status code
    header('Content-Type: application/json'); // Set content type to JSON
    $response = [
        'status' => $status,
        'message' => $message,
    ];

    if ($additional_data) {
        $response = array_merge($response, $additional_data); // Add additional data if needed
    }

    echo json_encode($response); // Output the JSON response
}

try {
    // Check if both 'id_user' and 'id_measurement' are set
    if (isset($_POST['id_user']) && isset($_POST['id_measurement'])) {
        $id_user = $_POST['id_user'];
        $id_measurement = $_POST['id_measurement'];

        // Validate 'id_user' parameter
        if (empty($id_user)) {
            send_json_response(400, "error", "The id_user parameter is empty");
            exit(); // Stop further execution
        }

        // Validate 'id_measurement' parameter
        if (empty($id_measurement)) {
            send_json_response(400, "error", "The id_measurement parameter is empty");
            exit(); // Stop further execution
        }

        // Attempt to delete the measurement with the given user ID and measurement ID
        $result = $db->deleteMeasurement($id_user, $id_measurement);

        if ($result === "user_not_found") {
            send_json_response(404, "error", "User with ID $id_user not found"); // 404 Not Found
        } elseif ($result === "measurement_not_found") {
            send_json_response(404, "error", "Measurement with ID $id_measurement not found for user $id_user"); // 404 Not Found
        } elseif ($result === "success") {
            send_json_response(200, "success", "Measurement deleted successfully");
        } else {
            send_json_response(500, "error", "Failed to delete measurement"); // 500 Internal Server Error
        }
    } else {
        // Separate error messages for missing parameters
        if (!isset($_POST['id_user'])) {
            send_json_response(400, "error", "Required parameter (id_user) is missing"); // 400 Bad Request
        }
        if (!isset($_POST['id_measurement'])) {
            send_json_response(400, "error", "Required parameter (id_measurement) is missing"); // 400 Bad Request
        }
    }
} catch (Exception $e) {
    send_json_response(500, "error", "An unexpected error occurred: " . $e->getMessage()); // 500 Internal Server Error
}
?>
