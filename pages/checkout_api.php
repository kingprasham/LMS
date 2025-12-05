<?php
/**
 * Checkout API - Handles order processing
 * Processes purchases, validates coupons, stores orders in database
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

// Check if user is logged in
if (!isLoggedIn()) {
    http_response_code(401);
    $response['message'] = 'Please login to complete your purchase';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];

// Valid coupon codes
$validCoupons = [
    'SAVE10' => ['discount' => 10, 'description' => '10% off'],
    'SAVE20' => ['discount' => 20, 'description' => '20% off'],
    'WELCOME' => ['discount' => 15, 'description' => '15% off for new users'],
    'STUDENT50' => ['discount' => 50, 'description' => '50% student discount'],
    'TEST100' => ['discount' => 100, 'description' => '100% off - FREE course!']
];

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    // CSRF Protection
    $token = $input['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        $response['message'] = 'Invalid security token. Please refresh the page.';
        echo json_encode($response);
        exit;
    }
    
    $action = $input['action'] ?? '';
    
    // Process order
    if ($action === 'process_order') {
        $orderData = $input['order_data'] ?? [];
        
        if (empty($orderData['items'])) {
            $response['message'] = 'No items to process';
            echo json_encode($response);
            exit;
        }
        
        // Calculate totals
        $items = $orderData['items'];
        $originalTotal = 0;
        $currentTotal = 0;
        
        foreach ($items as $item) {
            $originalTotal += $item['originalPrice'] ?? 3199;
            $currentTotal += $item['price'] ?? 455;
        }
        
        // Apply coupon discount if valid
        $couponCode = $orderData['coupon'] ?? null;
        $couponDiscount = 0;
        
        if ($couponCode && isset($validCoupons[strtoupper($couponCode)])) {
            $couponDiscount = ($currentTotal * $validCoupons[strtoupper($couponCode)]['discount']) / 100;
        }
        
        $finalTotal = $currentTotal - $couponDiscount;
        
        // Create the orders table if it doesn't exist
        $conn->query("CREATE TABLE IF NOT EXISTS orders (
            order_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            total_amount DECIMAL(10,2) NOT NULL,
            original_amount DECIMAL(10,2) NOT NULL,
            coupon_code VARCHAR(50) DEFAULT NULL,
            coupon_discount DECIMAL(10,2) DEFAULT 0,
            payment_method VARCHAR(50) DEFAULT NULL,
            billing_details TEXT,
            status ENUM('pending', 'completed', 'cancelled', 'refunded') DEFAULT 'completed',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX (user_id)
        )");
        
        // Create the order_items table if it doesn't exist
        $conn->query("CREATE TABLE IF NOT EXISTS order_items (
            item_id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            course_id INT NOT NULL,
            course_title VARCHAR(255) NOT NULL,
            course_price DECIMAL(10,2) NOT NULL,
            course_original_price DECIMAL(10,2) NOT NULL,
            course_image VARCHAR(255) DEFAULT NULL,
            course_instructor VARCHAR(100) DEFAULT NULL,
            INDEX (order_id),
            FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
        )");
        
        // Create user_courses table if it doesn't exist
        $conn->query("CREATE TABLE IF NOT EXISTS user_courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            course_id INT NOT NULL,
            course_title VARCHAR(255) NOT NULL,
            purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            order_id INT NOT NULL,
            UNIQUE KEY unique_user_course (user_id, course_id),
            INDEX (user_id),
            INDEX (course_id)
        )");
        
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // Insert order
            $billingDetails = json_encode($orderData['billingDetails'] ?? []);
            $paymentMethod = $orderData['paymentMethod'] ?? 'card';
            
            $stmt = $conn->prepare("
                INSERT INTO orders (user_id, total_amount, original_amount, coupon_code, coupon_discount, payment_method, billing_details)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("iddsdss", $user_id, $finalTotal, $originalTotal, $couponCode, $couponDiscount, $paymentMethod, $billingDetails);
            $stmt->execute();
            $orderId = $conn->insert_id;
            $stmt->close();
            
            // Insert order items and user_courses
            foreach ($items as $item) {
                $courseId = $item['id'] ?? 0;
                $courseTitle = $item['title'] ?? '';
                $coursePrice = $item['price'] ?? 455;
                $courseOriginalPrice = $item['originalPrice'] ?? 3199;
                $courseImage = $item['image'] ?? '';
                $courseInstructor = $item['instructor'] ?? '';
                
                // Insert into order_items
                $stmt = $conn->prepare("
                    INSERT INTO order_items (order_id, course_id, course_title, course_price, course_original_price, course_image, course_instructor)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->bind_param("iisddss", $orderId, $courseId, $courseTitle, $coursePrice, $courseOriginalPrice, $courseImage, $courseInstructor);
                $stmt->execute();
                $stmt->close();
                
                // Insert into user_courses (ignore duplicate)
                $stmt = $conn->prepare("
                    INSERT IGNORE INTO user_courses (user_id, course_id, course_title, order_id)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->bind_param("iisi", $user_id, $courseId, $courseTitle, $orderId);
                $stmt->execute();
                $stmt->close();
            }
            
            // Clear the user's cart
            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->close();
            
            // Commit transaction
            $conn->commit();
            
            $response['success'] = true;
            $response['message'] = 'Order processed successfully';
            $response['order_id'] = $orderId;
            $response['total'] = $finalTotal;
            
        } catch (Exception $e) {
            // Rollback on error
            $conn->rollback();
            $response['message'] = 'Failed to process order: ' . $e->getMessage();
        }
        
        echo json_encode($response);
        exit;
    }
    
    // Validate coupon
    if ($action === 'validate_coupon') {
        $code = strtoupper($input['code'] ?? '');
        
        if (isset($validCoupons[$code])) {
            $response['success'] = true;
            $response['coupon'] = [
                'code' => $code,
                'discount' => $validCoupons[$code]['discount'],
                'description' => $validCoupons[$code]['description']
            ];
        } else {
            $response['message'] = 'Invalid coupon code';
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
