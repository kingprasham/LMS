<?php
/**
 * Progress API
 * Handles lesson completion and course progress tracking
 * 
 * POST: Mark lesson as complete
 * GET: Get progress for a course
 */

require_once('../includes/session.php');
require_once('../config.php');
require_once('../includes/db_connect.php');

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id <= 0) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Please login']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Mark lesson as complete
    $input = json_decode(file_get_contents('php://input'), true);
    
    $lesson_id = $input['lesson_id'] ?? 0;
    $course_id = $input['course_id'] ?? 0;
    
    if ($lesson_id <= 0 || $course_id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Lesson ID and Course ID are required']);
        exit;
    }
    
    // Check if already completed
    $checkStmt = $conn->prepare("SELECT id FROM user_progress WHERE user_id = ? AND video_id = ?");
    $checkStmt->bind_param("ii", $user_id, $lesson_id);
    $checkStmt->execute();
    $exists = $checkStmt->get_result()->num_rows > 0;
    
    if (!$exists) {
        // Insert completion record
        $stmt = $conn->prepare("INSERT INTO user_progress (user_id, course_id, video_id, completed, completed_at) VALUES (?, ?, ?, 1, NOW())");
        $stmt->bind_param("iii", $user_id, $course_id, $lesson_id);
        $stmt->execute();
    }
    
    // Get updated progress
    $progressStmt = $conn->prepare("
        SELECT 
            (SELECT COUNT(*) FROM user_progress WHERE user_id = ? AND course_id = ? AND completed = 1) as completed_count,
            (SELECT COUNT(*) FROM videos WHERE section_id IN (SELECT section_id FROM course_sections WHERE course_id = ?)) as total_count
    ");
    $progressStmt->bind_param("iii", $user_id, $course_id, $course_id);
    $progressStmt->execute();
    $result = $progressStmt->get_result()->fetch_assoc();
    
    $completed = (int)$result['completed_count'];
    $total = (int)$result['total_count'];
    $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
    
    echo json_encode([
        'success' => true,
        'message' => 'Lesson marked as complete',
        'progress' => [
            'completed' => $completed,
            'total' => $total,
            'percentage' => $percentage
        ]
    ]);
    
} elseif ($method === 'GET') {
    // Get course progress
    $course_id = $_GET['course_id'] ?? 0;
    
    if ($course_id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Course ID is required']);
        exit;
    }
    
    // Get completed lessons
    $completedStmt = $conn->prepare("SELECT video_id FROM user_progress WHERE user_id = ? AND course_id = ? AND completed = 1");
    $completedStmt->bind_param("ii", $user_id, $course_id);
    $completedStmt->execute();
    $completedResult = $completedStmt->get_result();
    
    $completedLessons = [];
    while ($row = $completedResult->fetch_assoc()) {
        $completedLessons[] = (int)$row['video_id'];
    }
    
    // Get total lessons
    $totalStmt = $conn->prepare("SELECT COUNT(*) as total FROM videos WHERE section_id IN (SELECT section_id FROM course_sections WHERE course_id = ?)");
    $totalStmt->bind_param("i", $course_id);
    $totalStmt->execute();
    $total = (int)$totalStmt->get_result()->fetch_assoc()['total'];
    
    $completed = count($completedLessons);
    $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
    
    echo json_encode([
        'success' => true,
        'progress' => [
            'completed' => $completed,
            'total' => $total,
            'percentage' => $percentage,
            'completedLessons' => $completedLessons
        ]
    ]);
    
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

$conn->close();
?>
