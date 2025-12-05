<?php
// MINIMAL TEST - Find the exact failure point
ob_start();
header('Content-Type: application/json');

try {
    echo "1. Start\n";
    
    require_once('../includes/session.php');
    echo "2. Session loaded\n";
    
    require_once('../includes/db_connect.php');
    echo "3. DB loaded\n";
    
    require_once('../includes/auth_functions.php');
    echo "4. Auth loaded\n";
    
    echo "5. isLoggedIn: " . (function_exists('isLoggedIn') ? (isLoggedIn() ? 'yes' : 'no') : 'function not found') . "\n";
    
    if (isLoggedIn()) {
        echo "6. User ID: " . $_SESSION['user_id'] . "\n";
        
        // Test DB query
        $user_id = $_SESSION['user_id'];
        $result = $conn->query("SELECT COUNT(*) as cnt FROM user_courses WHERE user_id = $user_id");
        
        if ($result) {
            $row = $result->fetch_assoc();
            echo "7. Courses count: " . $row['cnt'] . "\n";
        } else {
            echo "7. Query error: " . $conn->error . "\n";
        }
    }
    
    echo "8. Done\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

// Output as text for debugging
$output = ob_get_clean();
header('Content-Type: text/plain');
echo $output;
