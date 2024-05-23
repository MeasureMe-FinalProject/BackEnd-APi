<?php

require_once 'db_functions.php';
$db = new DB_Functions();

// Function to send JSON response with status code
function send_json_response($status_code, $status, $message) {
    http_response_code($status_code); // Set HTTP status code
    header('Content-Type: application/json'); // Set content type to JSON
    echo json_encode([
        'status' => $status,
        'message' => $message,
    ]);
}

try {
    if (isset($_FILES["uploaded_file"]["name"])) {
        // Check if all required parameters are set
        $required_params = array("email", "user_name", "birthday", "gender", "height");
        $missing_params = array();
        foreach ($required_params as $param) {
            if (!isset($_POST[$param]) || empty($_POST[$param])) {
                $missing_params[] = $param;
            }
        }

        if (!empty($missing_params)) {
            send_json_response(400, "error", "One or more required parameters are empty");
            exit;
        }

        // All required parameters are present, proceed with processing
        $email = $_POST["email"];

        if ($db->checkExitsUser($email)) {
            $userName = $_POST["user_name"];
            $birthday = $_POST["birthday"];
            $gender = $_POST["gender"];
            $height = $_POST["height"];

            // Rest of your code here...
        } else {
            send_json_response(404, "error", "Email not found");
        }
    } else {
        send_json_response(400, "error", "No file uploaded");
    }
} catch (Exception $e) {
    send_json_response(500, "error", "An unexpected error occurred: " . $e->getMessage());
}
?>
