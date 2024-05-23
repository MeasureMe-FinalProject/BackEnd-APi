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
    if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if any of the parameters are empty
        if (empty($name) || empty($email) || empty($password)) {
            send_json_response(400, "error", "One or more required parameters are empty");
            exit(); // Stop further execution
        }

        // Check if user already exists with this email
        if ($db->checkExistsUser($email)) {
            send_json_response(409, "error", "User already exists with email: " . $email); // 409 Conflict
        } else {
            // Create new user with plaintext password (not recommended)
            $user = $db->registerUser($name, $email, $password);

            if ($user) {
                send_json_response(201, "success", "Registration successful");
            } else {
                send_json_response(500, "error", "Unknown error occurred during registration"); // 500 Internal Server Error
            }
        }
    } else {
        // If required parameters are missing
        send_json_response(400, "error", "Required parameters (name, email, password) are missing"); // 400 Bad Request
    }
} catch (Exception $e) {
    send_json_response(500, "error", "An unexpected error occurred: " . $e->getMessage()); // 500 Internal Server Error
}
?>
