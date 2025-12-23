<?php
/**
 * Delete Course API
 */

require_once(__DIR__ . '/../../config.php');

// requireAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    sendError('Method not allowed', 405);
}

$input = getJsonInput();
$course_id = isset($input['course_id']) ? (int)$input['course_id'] : (isset($_GET['id']) ? (int)$_GET['id'] : 0);

if (!$course_id) {
    sendError('Course ID is required');
}

// Check if course exists
$stmt = $conn->prepare("SELECT course_id, title FROM courses WHERE course_id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    sendError('Course not found', 404);
}

$course = $result->fetch_assoc();

// Delete course (cascades to sections, videos, etc.)
$stmt = $conn->prepare("DELETE FROM courses WHERE course_id = ?");
$stmt->bind_param("i", $course_id);

if ($stmt->execute()) {
    logActivity($conn, 'course_deleted', 'course', $course_id, ['title' => $course['title']]);
    sendSuccess(null, 'Course deleted successfully');
} else {
    sendError('Failed to delete course');
}
?>
