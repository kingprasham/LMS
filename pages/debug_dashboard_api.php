<?php
// Debug script for dashboard API

// Buffer all output
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Starting...\n";

// 1. Test session
require_once('../includes/session.php');
echo "Session started. Session ID: " . session_id() . "\n";
echo "Session data: " . json_encode($_SESSION) . "\n";

// 2. Test DB
require_once('../includes/db_connect.php');
echo "DB connected: " . ($conn ? "yes" : "no") . "\n";

// 3. Test auth
require_once('../includes/auth_functions.php');
echo "isLoggedIn: " . (isLoggedIn() ? "yes" : "no") . "\n";

// 4. Test query
if (isLoggedIn()) {
    $user_id = $_SESSION['user_id'];
    echo "User ID: $user_id\n";
    
    // Check if user_courses table exists
    $result = $conn->query("SHOW TABLES LIKE 'user_courses'");
    echo "user_courses table exists: " . ($result->num_rows > 0 ? "yes" : "no") . "\n";
    
    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM user_courses WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $count = $stmt->get_result()->fetch_assoc()['cnt'];
        echo "Courses count for user $user_id: $count\n";
    }
}

echo "\nOutput buffer contents:\n";
echo ob_get_clean();
