<?php
/**
 * LMS Database Seed Script
 * Populates database with sample data
 */

require_once('../includes/db_connect.php');

echo "<h2>LMS Database Seeder</h2>";
echo "<pre>";

// ============================================
// SEED CATEGORIES
// ============================================
echo "Seeding categories...\n";

$categories = [
    ['Generative AI', 'generative-ai', 'Learn about generative AI models', 'bi-robot', '#667eea'],
    ['Machine Learning', 'machine-learning', 'Master ML algorithms', 'bi-cpu', '#ff9a9e'],
    ['Data Science', 'data-science', 'Data analysis and visualization', 'bi-bar-chart', '#4facfe'],
    ['Web Development', 'web-development', 'Build modern web applications', 'bi-code-slash', '#fa709a'],
    ['Deep Learning', 'deep-learning', 'Neural networks and deep learning', 'bi-diagram-3', '#30cfd0'],
    ['Cloud Computing', 'cloud-computing', 'AWS, Azure, and GCP', 'bi-cloud', '#a8edea'],
    ['Mobile Development', 'mobile-development', 'iOS and Android apps', 'bi-phone', '#f093fb'],
    ['Cybersecurity', 'cybersecurity', 'Security and ethical hacking', 'bi-shield-lock', '#ffecd2']
];

$stmt = $conn->prepare("INSERT IGNORE INTO categories (name, slug, description, icon, color) VALUES (?, ?, ?, ?, ?)");
foreach ($categories as $cat) {
    $stmt->bind_param("sssss", $cat[0], $cat[1], $cat[2], $cat[3], $cat[4]);
    $stmt->execute();
}
echo "✓ Categories seeded (" . count($categories) . " categories)\n\n";

// ============================================
// SEED INSTRUCTORS (if not exist)
// ============================================
echo "Checking/creating instructors...\n";

$instructors = [
    ['Dr. Sarah Johnson', 'sarah.johnson@example.com', 'instructor', 'Expert in AI and Drug Discovery with 15+ years of research experience.'],
    ['Prof. Michael Chen', 'michael.chen@example.com', 'instructor', 'Machine Learning specialist from Stanford University.'],
    ['Dr. Emily Rodriguez', 'emily.rodriguez@example.com', 'instructor', 'Deep Learning researcher and medical imaging expert.'],
    ['Dr. Angela Yu', 'angela.yu@example.com', 'instructor', 'Full-stack developer and educator with millions of students worldwide.']
];

$password_hash = password_hash('instructor123', PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT IGNORE INTO users (full_name, email, password_hash, role, bio, status) VALUES (?, ?, ?, ?, ?, 'active')");
foreach ($instructors as $inst) {
    $stmt->bind_param("sssss", $inst[0], $inst[1], $password_hash, $inst[2], $inst[3]);
    $stmt->execute();
}
echo "✓ Instructors created\n\n";

// Get instructor IDs
$instructor_ids = [];
$result = $conn->query("SELECT user_id, full_name FROM users WHERE role = 'instructor'");
while ($row = $result->fetch_assoc()) {
    $instructor_ids[$row['full_name']] = $row['user_id'];
}

// ============================================
// SEED SAMPLE STUDENTS
// ============================================
echo "Seeding sample students...\n";

$students = [
    ['John Doe', 'john.doe@example.com'],
    ['Jane Smith', 'jane.smith@example.com'],
    ['Mike Johnson', 'mike.johnson@example.com'],
    ['Emily Davis', 'emily.davis@example.com'],
    ['Chris Wilson', 'chris.wilson@example.com'],
    ['Sarah Brown', 'sarah.brown@example.com'],
    ['Tom Anderson', 'tom.anderson@example.com'],
    ['Lisa Garcia', 'lisa.garcia@example.com']
];

$password_hash = password_hash('student123', PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT IGNORE INTO users (full_name, email, password_hash, role, status) VALUES (?, ?, ?, 'student', 'active')");
foreach ($students as $student) {
    $stmt->bind_param("sss", $student[0], $student[1], $password_hash);
    $stmt->execute();
}
echo "✓ Students seeded (" . count($students) . " students)\n\n";

// ============================================
// SEED SAMPLE COURSES
// ============================================
echo "Seeding sample courses...\n";

// Get category IDs
$category_ids = [];
$result = $conn->query("SELECT category_id, slug FROM categories");
while ($row = $result->fetch_assoc()) {
    $category_ids[$row['slug']] = $row['category_id'];
}

// Get first instructor ID for sample courses
$first_instructor = reset($instructor_ids) ?: 1;

$courses = [
    [
        'AI in Drug Discovery',
        'ai-drug-discovery',
        'Learn how AI is revolutionizing drug discovery and development',
        'Master the fundamentals of AI-driven drug discovery. This comprehensive course covers molecular modeling, target identification, and AI applications in pharmaceutical research.',
        'generative-ai',
        'Dr. Sarah Johnson',
        'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop',
        199.00, 299.00, 'intermediate', 'published', 1
    ],
    [
        'Machine Learning for Healthcare',
        'ml-healthcare',
        'Advanced machine learning techniques for healthcare applications',
        'Apply machine learning to solve real healthcare challenges. Learn predictive modeling, patient outcome analysis, and clinical decision support systems.',
        'machine-learning',
        'Prof. Michael Chen',
        'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&h=400&fit=crop',
        249.00, 399.00, 'advanced', 'published', 1
    ],
    [
        'Deep Learning in Medical Imaging',
        'deep-learning-medical-imaging',
        'Master deep learning techniques for medical image analysis',
        'Comprehensive coverage of CNNs, image segmentation, and object detection for medical imaging. Includes hands-on projects with real medical datasets.',
        'deep-learning',
        'Dr. Emily Rodriguez',
        'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
        179.00, 279.00, 'intermediate', 'published', 0
    ],
    [
        'Complete Python Bootcamp',
        'complete-python-bootcamp',
        'From zero to hero in Python programming',
        'The most comprehensive Python course on the platform. Learn Python from scratch and become job-ready with real-world projects.',
        'web-development',
        'Dr. Angela Yu',
        'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=600&h=400&fit=crop',
        89.00, 199.00, 'beginner', 'published', 1
    ],
    [
        'Data Science Fundamentals',
        'data-science-fundamentals',
        'Your complete guide to data science',
        'Learn statistics, Python, pandas, and visualization. Perfect for beginners wanting to break into data science.',
        'data-science',
        'Prof. Michael Chen',
        'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
        129.00, 249.00, 'beginner', 'draft', 0
    ],
    [
        'AWS Cloud Practitioner',
        'aws-cloud-practitioner',
        'Prepare for AWS certification',
        'Complete preparation for the AWS Cloud Practitioner exam. Covers all exam objectives with hands-on labs.',
        'cloud-computing',
        'Dr. Sarah Johnson',
        'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&h=400&fit=crop',
        149.00, 299.00, 'beginner', 'published', 0
    ]
];

$stmt = $conn->prepare("INSERT IGNORE INTO courses (title, slug, subtitle, description, category_id, instructor_id, thumbnail, price, original_price, level, status, is_featured, enrollment_count, rating, rating_count) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, FLOOR(RAND() * 5000) + 100, ROUND(4 + RAND(), 1), FLOOR(RAND() * 10000) + 100)");

foreach ($courses as $course) {
    $cat_id = $category_ids[$course[4]] ?? 1;
    $inst_id = $instructor_ids[$course[5]] ?? $first_instructor;
    $stmt->bind_param(
        "ssssiisddssi",
        $course[0], $course[1], $course[2], $course[3],
        $cat_id, $inst_id, $course[6],
        $course[7], $course[8], $course[9], $course[10], $course[11]
    );
    $stmt->execute();
}
echo "✓ Courses seeded (" . count($courses) . " courses)\n\n";

// ============================================
// SEED COURSE SECTIONS AND VIDEOS
// ============================================
echo "Seeding sections and videos...\n";

// Get course IDs
$course_ids = [];
$result = $conn->query("SELECT course_id, slug FROM courses");
while ($row = $result->fetch_assoc()) {
    $course_ids[$row['slug']] = $row['course_id'];
}

// Sample sections for first course
$first_course_id = $course_ids['ai-drug-discovery'] ?? 1;

$sections = [
    ['Introduction to AI in Drug Discovery', 0],
    ['Fundamentals of Machine Learning', 1],
    ['Deep Learning for Drug Discovery', 2],
    ['Advanced Topics and Final Project', 3]
];

$stmt = $conn->prepare("INSERT INTO course_sections (course_id, title, position) VALUES (?, ?, ?)");
foreach ($sections as $section) {
    $stmt->bind_param("isi", $first_course_id, $section[0], $section[1]);
    $stmt->execute();
}

// Get section IDs
$section_ids = [];
$result = $conn->query("SELECT section_id, title FROM course_sections WHERE course_id = $first_course_id ORDER BY position");
while ($row = $result->fetch_assoc()) {
    $section_ids[] = $row['section_id'];
}

// Sample videos
$videos = [
    // Section 1
    [$section_ids[0] ?? 1, 'Welcome to the Course', 'dQw4w9WgXcQ', 5, 1],
    [$section_ids[0] ?? 1, 'Introduction to Generative Models', 'aircAruvnKk', 10, 0],
    [$section_ids[0] ?? 1, 'AI in Healthcare Overview', 'R9OHn5ZF4Uo', 15, 0],
    // Section 2
    [$section_ids[1] ?? 2, 'Supervised Learning Basics', 'ujBiM9stPHU', 12, 0],
    [$section_ids[1] ?? 2, 'Unsupervised Learning Methods', 'IHZwWFHWa-w', 18, 0],
    [$section_ids[1] ?? 2, 'Neural Networks Introduction', 'CqOfi41LfDw', 25, 0],
    // Section 3
    [$section_ids[2] ?? 3, 'Molecular Representation', 'FfPvn3OCB5M', 20, 0],
    [$section_ids[2] ?? 3, 'Graph Neural Networks', 'zCEYiCxrL_0', 30, 0],
    // Section 4
    [$section_ids[3] ?? 4, 'Project Guidelines', 'wnHW6o8WMas', 10, 0],
    [$section_ids[3] ?? 4, 'Final Project Submission', '', 120, 0]
];

$stmt = $conn->prepare("INSERT INTO videos (section_id, course_id, title, video_url, duration_minutes, is_preview, position) VALUES (?, ?, ?, ?, ?, ?, ?)");
$pos = 0;
foreach ($videos as $video) {
    $stmt->bind_param("iissiii", $video[0], $first_course_id, $video[1], $video[2], $video[3], $video[4], $pos);
    $stmt->execute();
    $pos++;
}
echo "✓ Sections and videos seeded\n\n";

// ============================================
// SEED SAMPLE ENROLLMENTS
// ============================================
echo "Seeding sample enrollments...\n";

$student_ids = [];
$result = $conn->query("SELECT user_id FROM users WHERE role = 'student' LIMIT 5");
while ($row = $result->fetch_assoc()) {
    $student_ids[] = $row['user_id'];
}

$published_courses = [];
$result = $conn->query("SELECT course_id FROM courses WHERE status = 'published'");
while ($row = $result->fetch_assoc()) {
    $published_courses[] = $row['course_id'];
}

$stmt = $conn->prepare("INSERT IGNORE INTO enrollments (user_id, course_id, progress) VALUES (?, ?, FLOOR(RAND() * 100))");
foreach ($student_ids as $student_id) {
    foreach ($published_courses as $course_id) {
        if (rand(0, 1)) { // 50% chance of enrollment
            $stmt->bind_param("ii", $student_id, $course_id);
            $stmt->execute();
        }
    }
}
echo "✓ Sample enrollments created\n\n";

// ============================================
// SEED ACTIVITY LOG
// ============================================
echo "Seeding activity log...\n";

$activities = [
    ['user_registered', 'user', 'New user registration'],
    ['course_enrolled', 'course', 'User enrolled in course'],
    ['video_completed', 'video', 'User completed video'],
    ['quiz_submitted', 'quiz', 'User submitted quiz'],
    ['login', 'user', 'User logged in']
];

$stmt = $conn->prepare("INSERT INTO activity_log (user_id, action, entity_type, details, created_at) VALUES (?, ?, ?, ?, DATE_SUB(NOW(), INTERVAL FLOOR(RAND() * 168) HOUR))");
for ($i = 0; $i < 50; $i++) {
    $user_id = $student_ids[array_rand($student_ids)] ?? 1;
    $activity = $activities[array_rand($activities)];
    $details = json_encode(['description' => $activity[2]]);
    $stmt->bind_param("isss", $user_id, $activity[0], $activity[1], $details);
    $stmt->execute();
}
echo "✓ Activity log seeded (50 entries)\n\n";

// ============================================
// SEED DEFAULT SETTINGS
// ============================================
echo "Seeding default settings...\n";

$settings = [
    ['platform_name', 'AI Cure Academy', 'general'],
    ['platform_tagline', 'Smart AI-Powered Learning Platform', 'general'],
    ['support_email', 'support@aicureacademy.com', 'general'],
    ['support_phone', '+91 9876543210', 'general'],
    ['currency', 'INR', 'general'],
    ['timezone', 'Asia/Kolkata', 'general'],
    ['session_timeout', '30', 'security'],
    ['max_login_attempts', '5', 'security'],
    ['primary_color', '#4f46e5', 'appearance'],
    ['secondary_color', '#7c3aed', 'appearance']
];

$stmt = $conn->prepare("INSERT IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES (?, ?, ?)");
foreach ($settings as $setting) {
    $stmt->bind_param("sss", $setting[0], $setting[1], $setting[2]);
    $stmt->execute();
}
echo "✓ Settings seeded\n\n";

echo "</pre>";
echo "<h3 style='color: green;'>✓ Database seeding completed!</h3>";
echo "<p><strong>Test Credentials:</strong></p>";
echo "<ul>";
echo "<li>Admin: admin@example.com / admin123</li>";
echo "<li>Instructor: sarah.johnson@example.com / instructor123</li>";
echo "<li>Student: john.doe@example.com / student123</li>";
echo "</ul>";
echo "<p><a href='../pages/admin/dashboard.php'>→ Go to Admin Dashboard</a></p>";

$conn->close();
?>
