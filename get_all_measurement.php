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
        $response = array_merge($response, $additional_data); // Add additional data if provided
    }

    echo json_encode($response); // Output the JSON response
}

try {
    // Check if required parameter is provided
    if (isset($_POST['id_user'])) {
        $id_user = $_POST['id_user'];

        // Get all measurements for the given user
        $measurements = $db->getAllMeasurement($id_user);

        if ($measurements && count($measurements) > 0) {
            // If measurements are found, return them
            send_json_response(200, "success", "Measurements retrieved successfully", [
                "measurement_result" => $measurements,
            ]);
        } else {
            // If no measurements are found
            send_json_response(404, "error", "No measurements found for the given user");
        }
    } else {
        // If the required parameter is missing
        send_json_response(400, "error", "Required parameter (id_user) is missing");
    }
} catch (Exception $e) {
    // If there is an unexpected error
    send_json_response(500, "error", "An unexpected error occurred: " . $e->getMessage());
}
?>
