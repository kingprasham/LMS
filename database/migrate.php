<?php
/**
 * LMS Database Migration Script
 * Creates all required tables for the admin backend
 * 
 * SIMPLIFIED VERSION - No Foreign Keys (for compatibility)
 */

// Disable mysqli exception mode - use traditional error reporting
mysqli_report(MYSQLI_REPORT_ERROR);

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'lms_db';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS $db_name");
$conn->select_db($db_name);
$conn->set_charset("utf8mb4");

echo "<h2>LMS Database Migration</h2>";
echo "<pre>";

// Check if users table exists
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows == 0) {
    echo "<span style='color:red'>ERROR: Users table does not exist!</span>\n";
    echo "Please run setup_database.php first.\n";
    echo "<a href='../setup_database.php'>→ Run Setup Database</a>\n";
    exit;
}
echo "✓ Users table exists\n\n";

// Drop tables in reverse dependency order
echo "Dropping existing tables...\n";
$tables = [
    'ticket_responses', 'support_tickets', 'contact_submissions', 'messages',
    'activity_log', 'settings', 'user_notes', 'question_replies', 'course_questions',
    'course_reviews', 'video_resources', 'course_requirements', 'course_learning_objectives',
    'video_progress', 'enrollments', 'videos', 'course_sections', 'courses', 'categories'
];
foreach ($tables as $t) {
    $conn->query("DROP TABLE IF EXISTS `$t`");
}
echo "✓ Existing tables dropped\n\n";

// Update users table
echo "Updating users table...\n";
$cols = ['bio' => 'TEXT', 'avatar' => 'VARCHAR(500)', 'phone' => 'VARCHAR(20)', 'status' => "ENUM('active','inactive','suspended') DEFAULT 'active'"];
foreach ($cols as $col => $type) {
    $r = $conn->query("SHOW COLUMNS FROM users LIKE '$col'");
    if ($r->num_rows == 0) {
        $conn->query("ALTER TABLE users ADD COLUMN `$col` $type");
    }
}
echo "✓ Users table updated\n\n";

// Create all tables WITHOUT foreign keys
$tables_sql = [
    'categories' => "CREATE TABLE categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(100) NOT NULL,
        description TEXT,
        icon VARCHAR(50),
        color VARCHAR(7),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY slug_unique (slug)
    ) ENGINE=InnoDB",
    
    'courses' => "CREATE TABLE courses (
        course_id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        subtitle VARCHAR(500),
        slug VARCHAR(255) NOT NULL,
        description TEXT,
        category_id INT,
        instructor_id INT NOT NULL,
        thumbnail VARCHAR(500),
        promo_video VARCHAR(500),
        price DECIMAL(10,2) DEFAULT 0,
        original_price DECIMAL(10,2),
        level ENUM('beginner','intermediate','advanced') DEFAULT 'beginner',
        language VARCHAR(50) DEFAULT 'English',
        duration_hours DECIMAL(5,2) DEFAULT 0,
        status ENUM('draft','published','archived') DEFAULT 'draft',
        is_featured TINYINT(1) DEFAULT 0,
        rating DECIMAL(2,1) DEFAULT 0,
        rating_count INT DEFAULT 0,
        enrollment_count INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        published_at TIMESTAMP NULL,
        UNIQUE KEY slug_unique (slug),
        KEY idx_category (category_id),
        KEY idx_instructor (instructor_id),
        KEY idx_status (status)
    ) ENGINE=InnoDB",
    
    'course_sections' => "CREATE TABLE course_sections (
        section_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        position INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY idx_course (course_id)
    ) ENGINE=InnoDB",
    
    'videos' => "CREATE TABLE videos (
        video_id INT AUTO_INCREMENT PRIMARY KEY,
        section_id INT NOT NULL,
        course_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        video_url VARCHAR(500),
        video_type ENUM('youtube','vimeo','upload','external') DEFAULT 'youtube',
        duration_minutes INT DEFAULT 0,
        position INT DEFAULT 0,
        is_preview TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY idx_section (section_id),
        KEY idx_course (course_id)
    ) ENGINE=InnoDB",
    
    'enrollments' => "CREATE TABLE enrollments (
        enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        course_id INT NOT NULL,
        enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        progress INT DEFAULT 0,
        completed_at TIMESTAMP NULL,
        payment_id VARCHAR(100),
        KEY idx_user (user_id),
        KEY idx_course (course_id),
        UNIQUE KEY unique_enrollment (user_id, course_id)
    ) ENGINE=InnoDB",
    
    'video_progress' => "CREATE TABLE video_progress (
        progress_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        video_id INT NOT NULL,
        watched_seconds INT DEFAULT 0,
        is_completed TINYINT(1) DEFAULT 0,
        completed_at TIMESTAMP NULL,
        UNIQUE KEY unique_progress (user_id, video_id)
    ) ENGINE=InnoDB",
    
    'course_learning_objectives' => "CREATE TABLE course_learning_objectives (
        objective_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        objective_text VARCHAR(255) NOT NULL,
        position INT DEFAULT 0,
        KEY idx_course (course_id)
    ) ENGINE=InnoDB",
    
    'course_requirements' => "CREATE TABLE course_requirements (
        requirement_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        requirement_text VARCHAR(255) NOT NULL,
        position INT DEFAULT 0,
        KEY idx_course (course_id)
    ) ENGINE=InnoDB",
    
    'video_resources' => "CREATE TABLE video_resources (
        resource_id INT AUTO_INCREMENT PRIMARY KEY,
        video_id INT NOT NULL,
        course_id INT NOT NULL,
        name VARCHAR(255) NOT NULL,
        file_path VARCHAR(500) NOT NULL,
        file_type VARCHAR(50),
        file_size INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY idx_video (video_id),
        KEY idx_course (course_id)
    ) ENGINE=InnoDB",
    
    'course_reviews' => "CREATE TABLE course_reviews (
        review_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        user_id INT NOT NULL,
        rating INT NOT NULL,
        review_text TEXT,
        helpful_count INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY idx_course (course_id)
    ) ENGINE=InnoDB",
    
    'course_questions' => "CREATE TABLE course_questions (
        question_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        video_id INT,
        user_id INT NOT NULL,
        question_text TEXT NOT NULL,
        helpful_count INT DEFAULT 0,
        is_answered TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY idx_course (course_id),
        KEY idx_video (video_id)
    ) ENGINE=InnoDB",
    
    'question_replies' => "CREATE TABLE question_replies (
        reply_id INT AUTO_INCREMENT PRIMARY KEY,
        question_id INT NOT NULL,
        user_id INT NOT NULL,
        reply_text TEXT NOT NULL,
        is_instructor_reply TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY idx_question (question_id)
    ) ENGINE=InnoDB",
    
    'user_notes' => "CREATE TABLE user_notes (
        note_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        video_id INT NOT NULL,
        course_id INT NOT NULL,
        note_text TEXT NOT NULL,
        video_timestamp INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        KEY idx_user (user_id),
        KEY idx_video (video_id)
    ) ENGINE=InnoDB",
    
    'settings' => "CREATE TABLE settings (
        setting_id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(100) NOT NULL,
        setting_value TEXT,
        setting_group VARCHAR(50) DEFAULT 'general',
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY key_unique (setting_key)
    ) ENGINE=InnoDB",
    
    'activity_log' => "CREATE TABLE activity_log (
        log_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        action VARCHAR(100) NOT NULL,
        entity_type VARCHAR(50),
        entity_id INT,
        details TEXT,
        ip_address VARCHAR(45),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY idx_user (user_id),
        KEY idx_date (created_at)
    ) ENGINE=InnoDB",
    
    'messages' => "CREATE TABLE messages (
        message_id INT AUTO_INCREMENT PRIMARY KEY,
        from_user_id INT,
        to_user_id INT,
        subject VARCHAR(255),
        body TEXT,
        is_read TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB",
    
    'contact_submissions' => "CREATE TABLE contact_submissions (
        submission_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(100),
        subject VARCHAR(255),
        message TEXT,
        status ENUM('new','read','replied') DEFAULT 'new',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB",
    
    'support_tickets' => "CREATE TABLE support_tickets (
        ticket_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        subject VARCHAR(255),
        description TEXT,
        priority ENUM('low','medium','high') DEFAULT 'medium',
        status ENUM('open','in_progress','resolved','closed') DEFAULT 'open',
        assigned_to INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB",
    
    'ticket_responses' => "CREATE TABLE ticket_responses (
        response_id INT AUTO_INCREMENT PRIMARY KEY,
        ticket_id INT NOT NULL,
        user_id INT,
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY idx_ticket (ticket_id)
    ) ENGINE=InnoDB"
];

$success = 0;
$failed = 0;

foreach ($tables_sql as $name => $sql) {
    echo "Creating $name table... ";
    if ($conn->query($sql)) {
        echo "✓\n";
        $success++;
    } else {
        echo "✗ Error: " . $conn->error . "\n";
        $failed++;
    }
}

echo "\n";
echo "</pre>";

if ($failed == 0) {
    echo "<h3 style='color: green;'>✓ Database migration completed successfully!</h3>";
    echo "<p><strong>$success tables created.</strong></p>";
} else {
    echo "<h3 style='color: orange;'>Migration completed with errors</h3>";
    echo "<p>$success tables created, $failed failed.</p>";
}

echo "<p><a href='seed_data.php'>→ Run Seed Data Script</a></p>";
echo "<p><a href='../pages/admin/dashboard.php'>→ Go to Admin Dashboard</a></p>";

$conn->close();
?>
