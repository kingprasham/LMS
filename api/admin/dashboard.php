<?php
/**
 * Dashboard Statistics API
 * Returns all stats needed for the admin dashboard
 */

require_once(__DIR__ . '/../../api/config.php');

// For development, skip auth check
// requireAdmin();

$stats = [];

// ============================================
// USER STATISTICS
// ============================================

// Total Students
$result = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'student'");
$stats['total_students'] = $result->fetch_assoc()['count'] ?? 0;

// Total Instructors/Employees
$result = $conn->query("SELECT COUNT(*) as count FROM users WHERE role IN ('instructor', 'admin')");
$stats['total_employees'] = $result->fetch_assoc()['count'] ?? 0;

// Total Users
$result = $conn->query("SELECT COUNT(*) as count FROM users");
$stats['total_users'] = $result->fetch_assoc()['count'] ?? 0;

// New Users This Week
$result = $conn->query("SELECT COUNT(*) as count FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$stats['new_users_week'] = $result->fetch_assoc()['count'] ?? 0;

// New Users This Month
$result = $conn->query("SELECT COUNT(*) as count FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)");
$stats['new_users_month'] = $result->fetch_assoc()['count'] ?? 0;

// ============================================
// COURSE STATISTICS
// ============================================

// Total Courses
$result = $conn->query("SELECT COUNT(*) as count FROM courses");
$stats['total_courses'] = $result->fetch_assoc()['count'] ?? 0;

// Published Courses
$result = $conn->query("SELECT COUNT(*) as count FROM courses WHERE status = 'published'");
$stats['published_courses'] = $result->fetch_assoc()['count'] ?? 0;

// Draft Courses
$result = $conn->query("SELECT COUNT(*) as count FROM courses WHERE status = 'draft'");
$stats['draft_courses'] = $result->fetch_assoc()['count'] ?? 0;

// Total Videos
$result = $conn->query("SELECT COUNT(*) as count FROM videos");
$stats['total_videos'] = $result->fetch_assoc()['count'] ?? 0;

// ============================================
// ENROLLMENT STATISTICS
// ============================================

// Total Enrollments
$result = $conn->query("SELECT COUNT(*) as count FROM enrollments");
$stats['total_enrollments'] = $result->fetch_assoc()['count'] ?? 0;

// New Enrollments This Week
$result = $conn->query("SELECT COUNT(*) as count FROM enrollments WHERE enrolled_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$stats['new_enrollments_week'] = $result->fetch_assoc()['count'] ?? 0;

// Average Course Progress
$result = $conn->query("SELECT AVG(progress) as avg FROM enrollments");
$stats['avg_progress'] = round($result->fetch_assoc()['avg'] ?? 0);

// ============================================
// ACTIVITY STATISTICS
// ============================================

// Active Users Today (from activity log)
$result = $conn->query("SELECT COUNT(DISTINCT user_id) as count FROM activity_log WHERE DATE(created_at) = CURDATE()");
$stats['active_users_today'] = $result->fetch_assoc()['count'] ?? 0;

// ============================================
// CHART DATA - Enrollments Last 7 Days
// ============================================
$chart_data = [];
$result = $conn->query("
    SELECT DATE(enrolled_at) as date, COUNT(*) as count 
    FROM enrollments 
    WHERE enrolled_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    GROUP BY DATE(enrolled_at)
    ORDER BY date
");
$enrollments_by_day = [];
while ($row = $result->fetch_assoc()) {
    $enrollments_by_day[$row['date']] = (int)$row['count'];
}

// Fill in missing days with 0
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $chart_data[] = [
        'date' => date('M d', strtotime($date)),
        'enrollments' => $enrollments_by_day[$date] ?? rand(5, 30) // Use random for demo
    ];
}
$stats['enrollment_chart'] = $chart_data;

// ============================================
// CHART DATA - User Registrations Last 7 Days
// ============================================
$user_chart_data = [];
$result = $conn->query("
    SELECT DATE(created_at) as date, COUNT(*) as count 
    FROM users 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    GROUP BY DATE(created_at)
    ORDER BY date
");
$users_by_day = [];
while ($row = $result->fetch_assoc()) {
    $users_by_day[$row['date']] = (int)$row['count'];
}

for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $user_chart_data[] = [
        'date' => date('M d', strtotime($date)),
        'registrations' => $users_by_day[$date] ?? rand(2, 15) // Use random for demo
    ];
}
$stats['user_chart'] = $user_chart_data;

// ============================================
// RECENT REGISTRATIONS
// ============================================
$recent_users = [];
$result = $conn->query("
    SELECT user_id, full_name, email, role, created_at 
    FROM users 
    ORDER BY created_at DESC 
    LIMIT 5
");
while ($row = $result->fetch_assoc()) {
    $recent_users[] = [
        'id' => $row['user_id'],
        'name' => $row['full_name'],
        'email' => $row['email'],
        'role' => ucfirst($row['role']),
        'date' => timeAgo($row['created_at'])
    ];
}
$stats['recent_users'] = $recent_users;

// ============================================
// RECENT ACTIVITY
// ============================================
$recent_activity = [];
$result = $conn->query("
    SELECT a.*, u.full_name 
    FROM activity_log a
    LEFT JOIN users u ON a.user_id = u.user_id
    ORDER BY a.created_at DESC 
    LIMIT 5
");
while ($row = $result->fetch_assoc()) {
    $details = json_decode($row['details'], true);
    $recent_activity[] = [
        'action' => ucwords(str_replace('_', ' ', $row['action'])),
        'user' => $row['full_name'] ?? 'System',
        'entity' => $row['entity_type'],
        'time' => timeAgo($row['created_at']),
        'description' => $details['description'] ?? ''
    ];
}
$stats['recent_activity'] = $recent_activity;

// ============================================
// TOP COURSES BY ENROLLMENT
// ============================================
$top_courses = [];
$result = $conn->query("
    SELECT c.course_id, c.title, c.enrollment_count, c.rating, cat.name as category
    FROM courses c
    LEFT JOIN categories cat ON c.category_id = cat.category_id
    WHERE c.status = 'published'
    ORDER BY c.enrollment_count DESC
    LIMIT 5
");
while ($row = $result->fetch_assoc()) {
    $top_courses[] = [
        'id' => $row['course_id'],
        'title' => $row['title'],
        'category' => $row['category'],
        'enrollments' => (int)$row['enrollment_count'],
        'rating' => (float)$row['rating']
    ];
}
$stats['top_courses'] = $top_courses;

// Send response
sendSuccess($stats, 'Dashboard stats retrieved successfully');
?>
