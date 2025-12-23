<?php
/**
 * Update Course API
 * Updates an existing course's details (supports partial updates)
 */

require_once('../../../includes/db_connect.php');
require_once('../../config.php');

header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendError('Method not allowed', 405);
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    sendError('Invalid JSON input');
}

// Validate required fields
if (empty($input['course_id'])) {
    sendError('Course ID is required');
}

$course_id = intval($input['course_id']);

// Check if course exists and get current data
$stmt = $conn->prepare("SELECT * FROM courses WHERE course_id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    sendError('Course not found', 404);
}

$current = $result->fetch_assoc();

// Build dynamic update query based on provided fields
$updates = [];
$params = [];
$types = "";

// Check each possible field and add to update if provided
if (isset($input['title'])) {
    $updates[] = "title = ?";
    $params[] = $input['title'];
    $types .= "s";
    
    // Also update slug when title changes
    $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $input['title']));
    $slug = trim($slug, '-');
    $updates[] = "slug = ?";
    $params[] = $slug;
    $types .= "s";
}

if (array_key_exists('subtitle', $input)) {
    $updates[] = "subtitle = ?";
    $params[] = $input['subtitle'] ?? '';
    $types .= "s";
}

if (array_key_exists('description', $input)) {
    $updates[] = "description = ?";
    $params[] = $input['description'] ?? '';
    $types .= "s";
}

if (array_key_exists('category_id', $input)) {
    $updates[] = "category_id = ?";
    $params[] = !empty($input['category_id']) ? intval($input['category_id']) : null;
    $types .= "i";
}

if (array_key_exists('instructor_id', $input)) {
    $updates[] = "instructor_id = ?";
    $params[] = !empty($input['instructor_id']) ? intval($input['instructor_id']) : null;
    $types .= "i";
}

if (array_key_exists('level', $input)) {
    $updates[] = "level = ?";
    $params[] = $input['level'] ?? 'beginner';
    $types .= "s";
}

if (array_key_exists('price', $input)) {
    $updates[] = "price = ?";
    $params[] = floatval($input['price']);
    $types .= "d";
}

if (array_key_exists('original_price', $input)) {
    $updates[] = "original_price = ?";
    $params[] = !empty($input['original_price']) ? floatval($input['original_price']) : null;
    $types .= "d";
}

if (array_key_exists('thumbnail', $input)) {
    $updates[] = "thumbnail = ?";
    $params[] = $input['thumbnail'] ?? '';
    $types .= "s";
}

if (array_key_exists('promo_video', $input)) {
    $updates[] = "promo_video = ?";
    $params[] = $input['promo_video'] ?? '';
    $types .= "s";
}

if (array_key_exists('status', $input)) {
    $updates[] = "status = ?";
    $params[] = $input['status'] ?? 'draft';
    $types .= "s";
}

if (array_key_exists('is_featured', $input)) {
    $updates[] = "is_featured = ?";
    $params[] = intval($input['is_featured']);
    $types .= "i";
}

// If no fields to update, return success (nothing to do)
if (empty($updates)) {
    sendSuccess(['course_id' => $course_id, 'message' => 'No changes to update']);
}

// Always update the timestamp
$updates[] = "updated_at = NOW()";

// Build and execute query
$sql = "UPDATE courses SET " . implode(", ", $updates) . " WHERE course_id = ?";
$params[] = $course_id;
$types .= "i";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    sendSuccess([
        'course_id' => $course_id,
        'message' => 'Course updated successfully'
    ]);
} else {
    sendError('Failed to update course: ' . $conn->error);
}

$conn->close();
?>
