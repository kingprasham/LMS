<?php
/**
 * Cart API - Unified endpoint for all cart operations
 * Handles: add, remove, get, count
 * Security: CSRF protection, rate limiting, input validation
 */

// Start session with centralized configuration
require_once('../includes/session.php');

// Set JSON header
header('Content-Type: application/json');

// Include dependencies
require_once('../includes/db_connect.php');
require_once('../includes/auth_functions.php');

// Response array
$response = ['success' => false, 'message' => ''];

// Generate CSRF token if not exists
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle CSRF token request WITHOUT login requirement (must be accessible to get token)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'csrf_token') {
    $response['success'] = true;
    $response['csrf_token'] = $_SESSION['csrf_token'];
    echo json_encode($response);
    exit;
}

// Check if user is logged in (required for all other operations)
if (!isLoggedIn()) {
    http_response_code(401);
    $response['message'] = 'Please login to manage your cart';
    $response['redirect'] = 'login.php';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle GET requests (get cart items or count)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? 'get';
    
    if ($action === 'count') {
        // Get cart count
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        
        $response['success'] = true;
        $response['count'] = (int)$result['count'];
        echo json_encode($response);
        exit;
    }
    
    if ($action === 'get') {
        // Get all cart items
        $stmt = $conn->prepare("
            SELECT cart_id, course_id, course_title, course_price, course_original_price,
                   course_image, course_instructor, course_rating, course_duration, 
                   course_lectures, added_at
            FROM cart 
            WHERE user_id = ? 
            ORDER BY added_at DESC
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = [
                'id' => $row['course_id'],
                'cart_id' => $row['cart_id'],
                'title' => $row['course_title'],
                'price' => (float)$row['course_price'],
                'originalPrice' => (float)$row['course_original_price'],
                'image' => $row['course_image'],
                'instructor' => $row['course_instructor'],
                'rating' => (float)$row['course_rating'],
                'duration' => $row['course_duration'],
                'lectures' => $row['course_lectures']
            ];
        }
        $stmt->close();
        
        $response['success'] = true;
        $response['items'] = $items;
        echo json_encode($response);
        exit;
    }
}

// Handle POST requests (add, remove)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    // CSRF Protection
    $token = $input['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        $response['message'] = 'Invalid security token. Please refresh the page.';
        echo json_encode($response);
        exit;
    }
    
    // Rate Limiting (10 requests per minute)
    if (!isset($_SESSION['cart_attempts'])) {
        $_SESSION['cart_attempts'] = ['count' => 0, 'reset_time' => time() + 60];
    }
    
    if (time() > $_SESSION['cart_attempts']['reset_time']) {
        $_SESSION['cart_attempts'] = ['count' => 0, 'reset_time' => time() + 60];
    }
    
    if ($_SESSION['cart_attempts']['count'] >= 10) {
        http_response_code(429);
        $response['message'] = 'Too many requests. Please wait a moment.';
        echo json_encode($response);
        exit;
    }
    
    $_SESSION['cart_attempts']['count']++;
    
    $action = $input['action'] ?? '';
    
    // ADD TO CART
    if ($action === 'add') {
        // Validate course_id
        $course_id = filter_var($input['course_id'] ?? 0, FILTER_VALIDATE_INT);
        if ($course_id === false || $course_id <= 0) {
            $response['message'] = 'Invalid course ID';
            echo json_encode($response);
            exit;
        }
        
        // Sanitize inputs
        $course_title = htmlspecialchars(strip_tags($input['course_title'] ?? ''), ENT_QUOTES, 'UTF-8');
        $course_price = filter_var($input['course_price'] ?? 0, FILTER_VALIDATE_FLOAT);
        $course_original_price = filter_var($input['course_original_price'] ?? 0, FILTER_VALIDATE_FLOAT);
        $course_image = htmlspecialchars(strip_tags($input['course_image'] ?? ''), ENT_QUOTES, 'UTF-8');
        $course_instructor = htmlspecialchars(strip_tags($input['course_instructor'] ?? ''), ENT_QUOTES, 'UTF-8');
        $course_rating = filter_var($input['course_rating'] ?? 0, FILTER_VALIDATE_FLOAT);
        $course_duration = htmlspecialchars(strip_tags($input['course_duration'] ?? ''), ENT_QUOTES, 'UTF-8');
        $course_lectures = htmlspecialchars(strip_tags($input['course_lectures'] ?? ''), ENT_QUOTES, 'UTF-8');
        
        // Check if already in cart
        $stmt = $conn->prepare("SELECT cart_id FROM cart WHERE user_id = ? AND course_id = ?");
        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $stmt->close();
            $response['message'] = 'Course is already in your cart';
            $response['already_in_cart'] = true;
            echo json_encode($response);
            exit;
        }
        $stmt->close();
        
        // Insert into cart
        $stmt = $conn->prepare("
            INSERT INTO cart (user_id, course_id, course_title, course_price, course_original_price,
                            course_image, course_instructor, course_rating, course_duration, course_lectures)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("iisddssiss", 
            $user_id, $course_id, $course_title, $course_price, $course_original_price,
            $course_image, $course_instructor, $course_rating, $course_duration, $course_lectures
        );
        
        if ($stmt->execute()) {
            $stmt->close();
            
            // Get updated count
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $count_result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            
            $response['success'] = true;
            $response['message'] = 'Course added to cart successfully';
            $response['count'] = (int)$count_result['count'];
        } else {
            $response['message'] = 'Failed to add course to cart';
        }
        
        echo json_encode($response);
        exit;
    }
    
    // REMOVE FROM CART
    if ($action === 'remove') {
        $cart_id = filter_var($input['cart_id'] ?? 0, FILTER_VALIDATE_INT);
        
        if ($cart_id === false || $cart_id <= 0) {
            $response['message'] = 'Invalid cart item';
            echo json_encode($response);
            exit;
        }
        
        // Ensure user can only remove their own cart items
        $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $cart_id, $user_id);
        
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $stmt->close();
            
            // Get updated count
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $count_result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            
            $response['success'] = true;
            $response['message'] = 'Course removed from cart';
            $response['count'] = (int)$count_result['count'];
        } else {
            $stmt->close();
            $response['message'] = 'Failed to remove course from cart';
        }
        
        echo json_encode($response);
        exit;
    }
    
    // CLEAR CART
    if ($action === 'clear') {
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        
        if ($stmt->execute()) {
            $stmt->close();
            $response['success'] = true;
            $response['message'] = 'Cart cleared successfully';
            $response['count'] = 0;
        } else {
            $stmt->close();
            $response['message'] = 'Failed to clear cart';
        }
        
        echo json_encode($response);
        exit;
    }
}

// Invalid request
http_response_code(400);
$response['message'] = 'Invalid request';
echo json_encode($response);
?>
