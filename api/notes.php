<?php
/**
 * Notes API
 * Handles CRUD operations for user notes
 * 
 * POST: Create a new note or update existing
 * DELETE: Delete a note by note_id
 */

require_once('../includes/session.php');
require_once('../config.php');
require_once('../includes/db_connect.php');

header('Content-Type: application/json');

// Check if user is logged in
$user_id = $_SESSION['user_id'] ?? 0;
if ($user_id <= 0) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Please login to save notes']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Create a new note
    $input = json_decode(file_get_contents('php://input'), true);
    
    $video_id = $input['video_id'] ?? 0;
    $course_id = $input['course_id'] ?? 0;
    $note_text = trim($input['note_text'] ?? '');
    $video_timestamp = $input['video_timestamp'] ?? 0;
    
    if (empty($note_text)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Note text is required']);
        exit;
    }
    
    if ($video_id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Video ID is required']);
        exit;
    }
    
    $stmt = $conn->prepare("INSERT INTO user_notes (user_id, video_id, course_id, note_text, video_timestamp) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisi", $user_id, $video_id, $course_id, $note_text, $video_timestamp);
    
    if ($stmt->execute()) {
        $note_id = $conn->insert_id;
        echo json_encode([
            'success' => true, 
            'message' => 'Note saved successfully',
            'note_id' => $note_id,
            'note' => [
                'note_id' => $note_id,
                'note_text' => $note_text,
                'video_timestamp' => $video_timestamp,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to save note: ' . $conn->error]);
    }
    
} elseif ($method === 'DELETE') {
    // Delete a note
    $input = json_decode(file_get_contents('php://input'), true);
    $note_id = $input['note_id'] ?? 0;
    
    if ($note_id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Note ID is required']);
        exit;
    }
    
    // Only allow users to delete their own notes
    $stmt = $conn->prepare("DELETE FROM user_notes WHERE note_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $note_id, $user_id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Note deleted successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Note not found or you do not have permission to delete it']);
        }
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to delete note']);
    }
    
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

$conn->close();
?>
