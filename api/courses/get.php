<?php
/**
 * Get Single Course API
 * Retrieves comprehensive course details by ID or slug
 */

require_once('../../includes/db_connect.php');
require_once('../config.php');

header('Content-Type: application/json');

// Get course identifier (ID or slug)
$course_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

if (!$course_id && !$slug) {
    sendError('Course ID or slug is required');
}

// Build query
$where = $course_id ? "c.course_id = ?" : "c.slug = ?";
$param = $course_id ? $course_id : $slug;
$type = $course_id ? "i" : "s";

$sql = "SELECT 
    c.*,
    cat.name as category_name,
    cat.slug as category_slug,
    u.full_name as instructor_name,
    u.bio as instructor_bio,
    u.avatar as instructor_avatar,
    (SELECT COUNT(*) FROM enrollments WHERE course_id = c.course_id) as student_count,
    (SELECT AVG(rating) FROM course_reviews WHERE course_id = c.course_id) as avg_rating,
    (SELECT COUNT(*) FROM course_reviews WHERE course_id = c.course_id) as review_count
FROM courses c
LEFT JOIN categories cat ON c.category_id = cat.category_id
LEFT JOIN users u ON c.instructor_id = u.user_id
WHERE $where";

$stmt = $conn->prepare($sql);
$stmt->bind_param($type, $param);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    sendError('Course not found', 404);
}

$course = $result->fetch_assoc();

// Get course sections and videos
$sections = [];
$stmt = $conn->prepare("SELECT * FROM course_sections WHERE course_id = ? ORDER BY section_id");
$stmt->bind_param("i", $course['course_id']);
$stmt->execute();
$sectionsResult = $stmt->get_result();

while ($section = $sectionsResult->fetch_assoc()) {
    // Get videos for this section
    $videoStmt = $conn->prepare("SELECT * FROM videos WHERE section_id = ? ORDER BY video_id");
    $videoStmt->bind_param("i", $section['section_id']);
    $videoStmt->execute();
    $videosResult = $videoStmt->get_result();
    
    $videos = [];
    $sectionDuration = 0;
    while ($video = $videosResult->fetch_assoc()) {
        $videos[] = $video;
        $sectionDuration += $video['duration'] ?? 0;
    }
    
    $section['videos'] = $videos;
    $section['duration'] = $sectionDuration;
    $section['lecture_count'] = count($videos);
    $sections[] = $section;
}

$course['sections'] = $sections;

// Learning objectives (table doesn't exist yet)
$course['learning_objectives'] = [];

// Requirements (table doesn't exist yet)
$course['requirements'] = [];

// Calculate totals
$totalLectures = 0;
$totalDuration = 0;
foreach ($sections as $section) {
    $totalLectures += count($section['videos']);
    $totalDuration += $section['duration'];
}
$course['total_lectures'] = $totalLectures;
$course['total_duration'] = $totalDuration;
$course['total_sections'] = count($sections);

// Format duration as hours and minutes
$hours = floor($totalDuration / 3600);
$minutes = floor(($totalDuration % 3600) / 60);
$course['duration_formatted'] = $hours > 0 ? "{$hours}h {$minutes}m" : "{$minutes}m";

sendSuccess($course);
?>
