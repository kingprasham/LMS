<?php
require_once('../includes/session.php');
header('Content-Type: application/json');

require_once('../includes/db_connect.php');
require_once('../includes/auth_functions.php');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $input = json_decode(file_get_contents('php://input'), true);
    
    $email = isset($input['email']) ? sanitizeInput($input['email']) : '';
    $password = isset($input['password']) ? $input['password'] : '';
    
    // Validation
    if (empty($email) || empty($password)) {
        $response['message'] = 'Email and password are required.';
        echo json_encode($response);
        exit;
    }
    
    // Verify user
    $user = verifyUser($conn, $email, $password);
    
    if ($user) {
        // Start session
        startSecureSession($user);
        
        $response['success'] = true;
        $response['message'] = 'Login successful!';
        
        // Redirect based on role
        switch ($user['role']) {
            case 'admin':
                $response['redirect'] = '../pages/admin/dashboard.php';
                break;
            case 'instructor':
                $response['redirect'] = '../pages/instructor/dashboard.php';
                break;
            case 'student':
            default:
                $response['redirect'] = '../index.php';
                break;
        }
    } else {
        $response['message'] = 'Invalid email or password.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
