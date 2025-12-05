<?php
require_once('includes/db_connect.php');

echo "Adding missing columns to user_courses table...\n\n";

$columns = [
    "course_image VARCHAR(500) DEFAULT NULL",
    "course_instructor VARCHAR(100) DEFAULT NULL", 
    "progress INT DEFAULT 0",
    "last_accessed TIMESTAMP NULL DEFAULT NULL",
    "order_id INT DEFAULT 0"
];

foreach ($columns as $column) {
    $columnName = explode(' ', $column)[0];
    
    // Check if column exists
    $result = $conn->query("SHOW COLUMNS FROM user_courses LIKE '$columnName'");
    
    if ($result->num_rows == 0) {
        echo "Adding column: $columnName... ";
        $sql = "ALTER TABLE user_courses ADD COLUMN $column";
        if ($conn->query($sql)) {
            echo "✓ Added\n";
        } else {
            echo "✗ Error: " . $conn->error . "\n";
        }
    } else {
        echo "Column $columnName already exists ✓\n";
    }
}

echo "\n=== FINAL TABLE STRUCTURE ===\n";
$result = $conn->query("DESCRIBE user_courses");
while ($row = $result->fetch_assoc()) {
    echo "{$row['Field']}: {$row['Type']}\n";
}

echo "\nDone!\n";
