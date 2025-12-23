<?php
/**
 * Reset Database Script
 * Clears all data but keeps the admin user
 */

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'lms_db';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

echo "<h2>Database Reset</h2>";
echo "<pre>";

// Tables to clear (order matters - children first)
$tables_to_clear = [
    'ticket_responses', 'support_tickets', 'contact_submissions', 'messages',
    'activity_log', 'user_notes', 'question_replies', 'course_questions',
    'course_reviews', 'video_resources', 'course_requirements', 'course_learning_objectives',
    'video_progress', 'enrollments', 'videos', 'course_sections', 'courses', 'categories'
];

echo "Clearing data from tables...\n";
foreach ($tables_to_clear as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows > 0) {
        $conn->query("DELETE FROM `$table`");
        $conn->query("ALTER TABLE `$table` AUTO_INCREMENT = 1");
        echo "✓ Cleared: $table\n";
    }
}

// Delete all users except admin
echo "\nRemoving all users except admin...\n";
$conn->query("DELETE FROM users WHERE role != 'admin'");
$result = $conn->query("SELECT COUNT(*) as cnt FROM users WHERE role = 'admin'");
$admin_count = $result->fetch_assoc()['cnt'];
echo "✓ Kept $admin_count admin user(s)\n";

// Show admin user info
$result = $conn->query("SELECT user_id, full_name, email FROM users WHERE role = 'admin'");
if ($row = $result->fetch_assoc()) {
    echo "\nAdmin User:\n";
    echo "  ID: " . $row['user_id'] . "\n";
    echo "  Name: " . $row['full_name'] . "\n";
    echo "  Email: " . $row['email'] . "\n";
    echo "  Password: admin123\n";
}

echo "</pre>";
echo "<h3 style='color: green;'>✓ Database reset complete!</h3>";
echo "<p><a href='../pages/admin/dashboard.php'>→ Go to Admin Dashboard</a></p>";

$conn->close();
?>
