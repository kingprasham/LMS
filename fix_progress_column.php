<?php
require_once('includes/db_connect.php');

echo "Checking user_courses table structure...\n";

// Check if progress column exists
$result = $conn->query("SHOW COLUMNS FROM user_courses LIKE 'progress'");

if ($result->num_rows == 0) {
    echo "Progress column does NOT exist. Adding it...\n";
    $conn->query("ALTER TABLE user_courses ADD COLUMN progress INT DEFAULT 0 AFTER course_instructor");
    echo "Progress column added!\n";
} else {
    echo "Progress column already exists.\n";
}

// Verify the column now exists
$result = $conn->query("SHOW COLUMNS FROM user_courses");
echo "\nCurrent columns in user_courses:\n";
while ($row = $result->fetch_assoc()) {
    echo "- {$row['Field']} ({$row['Type']})\n";
}

echo "\nDone!\n";
