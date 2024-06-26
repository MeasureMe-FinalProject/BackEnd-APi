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
    // Ensure required parameters are provided
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Get the user data based on the provided email
        $user = $db->loginUser($email, $password);

        if ($user) {
            // If login is successful, return user info
            send_json_response(200, "success", "Login successful", [
                "user" => [
                    "id" => $user["id"],
                    "name" => $user["name"],
                    "email" => $user["email"],
                ],
            ]);
        } else {
            // If login fails due to incorrect email or password
            send_json_response(401, "error", "Incorrect email or password"); // 401 Unauthorized
        }
    } else {
        // If required parameter (email, password) is missing
        send_json_response(400, "error", "Required parameters (email, password) are missing"); // 400 Bad Request
    }
} catch (Exception $e) {
    // If there is an unexpected error
    send_json_response(500, "error", "An unexpected error occurred: " . $e->getMessage()); // 500 Internal Server Error
}
?>
