<?php
require_once('includes/db_connect.php');

echo "=== USER_COURSES TABLE ===\n";
$result = $conn->query("SELECT user_id, course_id, course_title, order_id FROM user_courses ORDER BY user_id, course_id");
while($row = $result->fetch_assoc()) {
    echo "User: {$row['user_id']}, Course: {$row['course_id']}, Title: {$row['course_title']}, Order: {$row['order_id']}\n";
}

echo "\n=== ORDER_ITEMS TABLE ===\n";
$result = $conn->query("SELECT order_id, course_id, course_title FROM order_items ORDER BY order_id, course_id");
while($row = $result->fetch_assoc()) {
    echo "Order: {$row['order_id']}, Course: {$row['course_id']}, Title: {$row['course_title']}\n";
}

echo "\n=== CHECKING FOR DUPLICATES ===\n";
$result = $conn->query("SELECT user_id, course_id, COUNT(*) as cnt FROM user_courses GROUP BY user_id, course_id HAVING cnt > 1");
if ($result->num_rows > 0) {
    echo "DUPLICATES FOUND:\n";
    while($row = $result->fetch_assoc()) {
        echo "User: {$row['user_id']}, Course: {$row['course_id']}, Count: {$row['cnt']}\n";
    }
} else {
    echo "No duplicates in user_courses table\n";
}
