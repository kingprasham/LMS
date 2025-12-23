<?php
/**
 * Videos API - CRUD for course videos
 * Supports: list, create, update, delete
 */

require_once('../../../includes/db_connect.php');
require_once('../../config.php');

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'list':
        // Get all videos for a section
        $section_id = isset($_GET['section_id']) ? intval($_GET['section_id']) : null;
        if (!$section_id) {
            sendError('Section ID is required');
        }
        
        $stmt = $conn->prepare("SELECT * FROM videos WHERE section_id = ? ORDER BY position");
        $stmt->bind_param("i", $section_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $videos = [];
        while ($row = $result->fetch_assoc()) {
            $videos[] = $row;
        }
        
        sendSuccess($videos);
        break;
        
    case 'create':
        if ($method !== 'POST') sendError('Method not allowed', 405);
        
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || empty($input['section_id']) || empty($input['title'])) {
            sendError('Section ID and title are required');
        }
        
        // Get course_id from section
        $stmt = $conn->prepare("SELECT course_id FROM course_sections WHERE section_id = ?");
        $stmt->bind_param("i", $input['section_id']);
        $stmt->execute();
        $section = $stmt->get_result()->fetch_assoc();
        if (!$section) sendError('Section not found');
        
        // Get max position
        $stmt = $conn->prepare("SELECT COALESCE(MAX(position), 0) + 1 as next_pos FROM videos WHERE section_id = ?");
        $stmt->bind_param("i", $input['section_id']);
        $stmt->execute();
        $position = $stmt->get_result()->fetch_assoc()['next_pos'];
        
        $stmt = $conn->prepare("INSERT INTO videos (section_id, course_id, title, description, video_url, duration_minutes, position, is_preview) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $description = $input['description'] ?? '';
        $video_url = $input['video_url'] ?? '';
        $duration = intval($input['duration_minutes'] ?? 0);
        $is_preview = isset($input['is_preview']) ? 1 : 0;
        
        $stmt->bind_param("iisssiis", 
            $input['section_id'], 
            $section['course_id'], 
            $input['title'], 
            $description, 
            $video_url, 
            $duration, 
            $position, 
            $is_preview
        );
        
        if ($stmt->execute()) {
            sendSuccess(['video_id' => $conn->insert_id, 'message' => 'Video created']);
        } else {
            sendError('Failed to create video: ' . $conn->error);
        }
        break;
        
    case 'update':
        if ($method !== 'POST') sendError('Method not allowed', 405);
        
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || empty($input['video_id'])) {
            sendError('Video ID is required');
        }
        
        // Build dynamic update query - only update fields that are provided
        $fields = [];
        $values = [];
        $types = '';
        
        if (isset($input['title'])) {
            $fields[] = 'title = ?';
            $values[] = $input['title'];
            $types .= 's';
        }
        if (isset($input['description'])) {
            $fields[] = 'description = ?';
            $values[] = $input['description'];
            $types .= 's';
        }
        if (isset($input['video_url'])) {
            $fields[] = 'video_url = ?';
            $values[] = $input['video_url'];
            $types .= 's';
        }
        if (isset($input['duration_minutes'])) {
            $fields[] = 'duration_minutes = ?';
            $values[] = intval($input['duration_minutes']);
            $types .= 'i';
        }
        if (isset($input['is_preview'])) {
            $fields[] = 'is_preview = ?';
            $values[] = $input['is_preview'] ? 1 : 0;
            $types .= 'i';
        }
        
        if (empty($fields)) {
            sendError('No fields to update');
        }
        
        $values[] = intval($input['video_id']);
        $types .= 'i';
        
        $sql = "UPDATE videos SET " . implode(', ', $fields) . " WHERE video_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            sendSuccess(['message' => 'Video updated']);
        } else {
            sendError('Failed to update video');
        }
        break;
        
    case 'delete':
        if ($method !== 'POST') sendError('Method not allowed', 405);
        
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || empty($input['video_id'])) {
            sendError('Video ID is required');
        }
        
        $stmt = $conn->prepare("DELETE FROM videos WHERE video_id = ?");
        $stmt->bind_param("i", $input['video_id']);
        
        if ($stmt->execute()) {
            sendSuccess(['message' => 'Video deleted']);
        } else {
            sendError('Failed to delete video');
        }
        break;
        
    default:
        sendError('Unknown action');
}

$conn->close();
?>
