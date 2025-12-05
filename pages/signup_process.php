<?php
require_once('../includes/session.php');
header('Content-Type: application/json');

require_once('../includes/db_connect.php');
require_once('../includes/auth_functions.php');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $input = json_decode(file_get_contents('php://input'), true);
    
    $full_name = isset($input['fullname']) ? sanitizeInput($input['fullname']) : '';
    $email = isset($input['email']) ? sanitizeInput($input['email']) : '';
    $password = isset($input['password']) ? $input['password'] : '';
    
    // Validation
    if (empty($full_name) || empty($email) || empty($password)) {
        $response['message'] = 'All fields are required.';
        echo json_encode($response);
        exit;
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid email format.';
        echo json_encode($response);
        exit;
    }
    
    // Validate password strength (minimum 6 characters)
    if (strlen($password) < 6) {
        $response['message'] = 'Password must be at least 6 characters long.';
        echo json_encode($response);
        exit;
    }
    
    // Check if email already exists
    if (checkEmailExists($conn, $email)) {
        $response['message'] = 'Email already registered. Please login instead.';
        echo json_encode($response);
        exit;
    }
    
    // Create user
    $user_id = createUser($conn, $full_name, $email, $password);
    
    if ($user_id) {
        // Get user data
        $user = verifyUser($conn, $email, $password);
        
        // Start session
        startSecureSession($user);
        
        $response['success'] = true;
        $response['message'] = 'Account created successfully!';
        $response['redirect'] = '../index.php';
    } else {
        $response['message'] = 'Registration failed. Please try again.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
