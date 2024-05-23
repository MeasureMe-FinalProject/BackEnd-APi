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
    // Ensure required parameter (email) is provided
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Get the user data based on the provided email
        $user = $db->forgotPassword($email);

        if ($user) {
            // If a user with the given email is found
            send_json_response(200, "success", "Password retrieved successfully", [
                "password" => $user["password"],
            ]);
        } else {
            // If no user is found with the given email
            send_json_response(404, "error", "Email not found"); // 404 Not Found
        }
    } else {
        // If the required parameter (email) is missing
        send_json_response(400, "error", "Required parameter (email) is missing"); // 400 Bad Request
    }
} catch (Exception $e) {
    // If there is an unexpected error
    send_json_response(500, "error", "An unexpected error occurred: " . $e->getMessage()); // 500 Internal Server Error
}


?>