<?php
// Database Setup Script
// WARNING: This will drop existing tables!

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'lms_db';

// Create connection without DB first
$conn = new mysqli($db_host, $db_user, $db_pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select Database
$conn->select_db($db_name);

// Disable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Get all tables
$result = $conn->query("SHOW TABLES");
if ($result) {
    while ($row = $result->fetch_array()) {
        $table = $row[0];
        $sql = "DROP TABLE IF EXISTS `$table`";
        if ($conn->query($sql) === TRUE) {
            echo "Table $table dropped successfully.<br>";
        } else {
            echo "Error dropping table $table: " . $conn->error . "<br>";
        }
    }
}

// Re-enable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

// Create Users Table
$sql = "CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('student', 'instructor', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully.<br>";
} else {
    die("Error creating table users: " . $conn->error);
}

// Seed Admin User
$admin_email = 'admin@example.com';
$admin_pass = password_hash('admin123', PASSWORD_DEFAULT);
$admin_name = 'Super Admin';
$admin_role = 'admin';

$stmt = $conn->prepare("INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $admin_name, $admin_email, $admin_pass, $admin_role);

if ($stmt->execute()) {
    echo "Admin user created successfully (Email: $admin_email, Pass: admin123).<br>";
} else {
    echo "Error creating admin user: " . $stmt->error . "<br>";
}

// Seed Test Student
$student_email = 'student@example.com';
$student_pass = password_hash('password123', PASSWORD_DEFAULT);
$student_name = 'Test Student';
$student_role = 'student';

$stmt->bind_param("ssss", $student_name, $student_email, $student_pass, $student_role);

if ($stmt->execute()) {
    echo "Test student created successfully (Email: $student_email, Pass: password123).<br>";
} else {
    echo "Error creating test student: " . $stmt->error . "<br>";
}

$stmt->close();

echo "<br><strong>User Seeding Complete!</strong><br>";

// Create Cart Table
echo "<br><br><h3>Creating Cart Table...</h3>";
$sql = "CREATE TABLE cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    course_title VARCHAR(255),
    course_price DECIMAL(10, 2),
    course_original_price DECIMAL(10, 2),
    course_image VARCHAR(500),
    course_instructor VARCHAR(255),
    course_rating DECIMAL(2, 1),
    course_duration VARCHAR(50),
    course_lectures VARCHAR(50),
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_course (user_id, course_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table cart created successfully.<br>";
} else {
    echo "Error creating table cart: " . $conn->error . "<br>";
}

// Create indexes for better performance
echo "<br><h3>Creating Indexes...</h3>";
$indexes = [
    "CREATE INDEX idx_user_cart ON cart(user_id)",
    "CREATE INDEX idx_course_cart ON cart(course_id)",
    "CREATE INDEX idx_user_course ON cart(user_id, course_id)"
];

foreach ($indexes as $index_sql) {
    if ($conn->query($index_sql) === TRUE) {
        echo "Index created successfully.<br>";
    } else {
        echo "Error creating index: " . $conn->error . "<br>";
    }
}

$conn->close();

echo "<br><strong>Complete Setup Finished!</strong><br>";
echo "Database, tables, indexes, and users created successfully.<br>";
echo "<strong>You can now delete this file for security.</strong>";
?>
