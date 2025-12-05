<?php
require_once('includes/db_connect.php');

// Check cart table
$result = $conn->query("SELECT cart_id, user_id, course_id, course_title FROM cart ORDER BY added_at DESC LIMIT 10");

echo "Cart items in database:\n";
echo "======================\n";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Cart ID: " . $row['cart_id'] . " | User ID: " . $row['user_id'] . " | Course: " . $row['course_title'] . "\n";
    }
} else {
    echo "No items in cart table\n";
}

$conn->close();
?>
