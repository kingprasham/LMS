<?php
require_once('includes/db_connect.php');

echo "=== CURRENT TABLE STRUCTURE ===\n";
$result = $conn->query("DESCRIBE user_courses");
while ($row = $result->fetch_assoc()) {
    echo "{$row['Field']}: {$row['Type']} {$row['Null']} {$row['Default']}\n";
}

echo "\n=== DROPPING AND RECREATING TABLE ===\n";
$conn->query("DROP TABLE IF EXISTS user_courses");

$createSQL = "CREATE TABLE user_courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    course_title VARCHAR(255) NOT NULL,
    course_image VARCHAR(500) DEFAULT NULL,
    course_instructor VARCHAR(100) DEFAULT NULL,
    progress INT DEFAULT 0,
    last_accessed TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    order_id INT NOT NULL,
    UNIQUE KEY unique_user_course (user_id, course_id),
    INDEX (user_id),
    INDEX (course_id)
)";

if ($conn->query($createSQL)) {
    echo "Table recreated successfully!\n";
} else {
    echo "Error: " . $conn->error . "\n";
}

echo "\n=== RESTORING DATA FROM BACKUP ===\n";
// Get data from order_items and orders to restore user_courses
$result = $conn->query("
    SELECT DISTINCT
        o.user_id,
        oi.course_id,
        oi.course_title,
        oi.course_image,
        oi.course_instructor,
        o.created_at as purchase_date,
        o.id as order_id
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    WHERE o.status = 'completed'
    ORDER BY o.created_at DESC
");

$inserted = 0;
while ($row = $result->fetch_assoc()) {
    $stmt = $conn->prepare("INSERT IGNORE INTO user_courses 
        (user_id, course_id, course_title, course_image, course_instructor, purchase_date, order_id, progress) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("iissssi", 
        $row['user_id'], 
        $row['course_id'], 
        $row['course_title'], 
        $row['course_image'], 
        $row['course_instructor'], 
        $row['purchase_date'], 
        $row['order_id']
    );
    if ($stmt->execute()) {
        $inserted++;
    }
}

echo "Restored $inserted course enrollments\n";

echo "\n=== VERIFICATION ===\n";
$result = $conn->query("SELECT user_id, course_id, course_title, progress FROM user_courses");
while ($row = $result->fetch_assoc()) {
    echo "User {$row['user_id']}: Course {$row['course_id']} - {$row['course_title']} (Progress: {$row['progress']}%)\n";
}

echo "\nDone!\n";
