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
    // Ensure required parameters are provided
    if (isset($_POST["email"], $_POST["old_password"], $_POST["new_password"])) {
        $email = $_POST["email"];
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];

        // Check if the user exists
        if ($db->checkExitsUser($email)) {
            // Verify the old password
            if ($db->verifyPlaintextPassword($email, $old_password)) {
                // Update the password with the new one
                if ($db->updatePlaintextPassword($email, $new_password)) {
                    send_json_response(200, "success", "Password updated successfully");
                } else {
                    send_json_response(500, "error", "Failed to update password"); // 500 Internal Server Error
                }
            } else {
                send_json_response(401, "error", "Old password is incorrect"); // 401 Unauthorized
            }
        } else {
            send_json_response(404, "error", "User not found"); // 404 Not Found
        }
    } else {
        send_json_response(400, "error", "Required parameters (email, old_password, new_password) are missing"); // 400 Bad Request
    }
} catch (Exception $e) {
    send_json_response(500, "error", "An unexpected error occurred: " . $e->getMessage()); // 500 Internal Server Error
}

?>