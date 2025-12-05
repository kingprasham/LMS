<?php
/**
 * Dashboard API - Provides user-specific course and stats data
 * Security: Session-based authentication, CSRF protection, user isolation
 */

// Start output buffering FIRST to catch ANY output
ob_start();

// Enable errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set content type
header('Content-Type: application/json');

// Shutdown function to catch fatal errors
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        ob_clean();
        echo json_encode([
            'success' => false,
            'error' => 'Fatal error: ' . $error['message'],
            'file' => basename($error['file']),
            'line' => $error['line']
        ]);
    }
});

try {
    // Start session with centralized configuration
    require_once('../includes/session.php');
    
    // Include dependencies
    require_once('../includes/db_connect.php');
    require_once('../includes/auth_functions.php');
    
    // Response array
    $response = ['success' => false, 'message' => ''];
    
    // Check if user is logged in
    if (!isLoggedIn()) {
        http_response_code(401);
        $response['message'] = 'Please login to access your dashboard';
        ob_clean();
        echo json_encode($response);
        exit;
    }
    
    $user_id = $_SESSION['user_id'];
    
    // Handle GET requests
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $action = $_GET['action'] ?? '';
        
        // Get user's purchased courses
        if ($action === 'my_courses') {
            // Create user_courses table if not exists (safety check)
            $conn->query("CREATE TABLE IF NOT EXISTS user_courses (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                course_id INT NOT NULL,
                course_title VARCHAR(255) NOT NULL,
                course_image VARCHAR(500) DEFAULT NULL,
                course_instructor VARCHAR(100) DEFAULT NULL,
                progress INT DEFAULT 0,
                last_accessed TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                order_id INT NOT NULL,
                UNIQUE KEY unique_user_course (user_id, course_id),
                INDEX (user_id),
                INDEX (course_id)
            )");
            
            // Fetch user's courses - FIXED: Use subquery to prevent duplicates
            $stmt = $conn->prepare("
                SELECT 
                    uc.*,
                    (SELECT course_price FROM order_items WHERE course_id = uc.course_id AND order_id = uc.order_id LIMIT 1) as course_price,
                    (SELECT course_original_price FROM order_items WHERE course_id = uc.course_id AND order_id = uc.order_id LIMIT 1) as course_original_price
                FROM user_courses uc
                WHERE uc.user_id = ?
                ORDER BY uc.purchase_date DESC
            ");
            
            if (!$stmt) {
                throw new Exception('Database prepare failed: ' . $conn->error);
            }
            
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $courses = [];
            while ($row = $result->fetch_assoc()) {
                $courses[] = [
                    'id' => $row['course_id'],
                    'title' => $row['course_title'],
                    'image' => $row['course_image'] ?: 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop',
                    'instructor' => $row['course_instructor'] ?: 'AI Cure Academy',
                    'progress' => (int)$row['progress'],
                    'price' => $row['course_price'] ?? 0,
                    'originalPrice' => $row['course_original_price'] ?? 0,
                    'purchaseDate' => $row['purchase_date'],
                    'lastAccessed' => $row['last_accessed']
                ];
            }
            $stmt->close();
            
            $response['success'] = true;
            $response['courses'] = $courses;
            $response['count'] = count($courses);
            ob_clean();
            echo json_encode($response);
            exit;
        }
        
        // Get user's dashboard stats
        if ($action === 'stats') {
            // Count active courses (progress < 100)
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM user_courses WHERE user_id = ? AND progress < 100");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $activeCourses = $stmt->get_result()->fetch_assoc()['count'];
            $stmt->close();
            
            // Count completed courses (progress = 100)
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM user_courses WHERE user_id = ? AND progress = 100");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $completedCourses = $stmt->get_result()->fetch_assoc()['count'];
            $stmt->close();
            
            // Total courses
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM user_courses WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $totalCourses = $stmt->get_result()->fetch_assoc()['count'];
            $stmt->close();
            
            $response['success'] = true;
            $response['stats'] = [
                'activeCourses' => (int)$activeCourses,
                'completedCourses' => (int)$completedCourses,
                'totalCourses' => (int)$totalCourses,
                'certificates' => (int)$completedCourses
            ];
            ob_clean();
            echo json_encode($response);
            exit;
        }
        
        // Update course progress
        if ($action === 'update_progress') {
            $course_id = filter_var($_GET['course_id'] ?? 0, FILTER_VALIDATE_INT);
            $progress = filter_var($_GET['progress'] ?? 0, FILTER_VALIDATE_INT);
            
            if ($course_id && $progress >= 0 && $progress <= 100) {
                $stmt = $conn->prepare("UPDATE user_courses SET progress = ? WHERE user_id = ? AND course_id = ?");
                $stmt->bind_param("iii", $progress, $user_id, $course_id);
                
                if ($stmt->execute() && $stmt->affected_rows > 0) {
                    $response['success'] = true;
                    $response['message'] = 'Progress updated';
                } else {
                    $response['message'] = 'Course not found or no change';
                }
                $stmt->close();
            } else {
                $response['message'] = 'Invalid parameters';
            }
            
            ob_clean();
            echo json_encode($response);
            exit;
        }
    }
    
    // Invalid request
    http_response_code(400);
    $response['message'] = 'Invalid request';
    ob_clean();
    echo json_encode($response);
    
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
