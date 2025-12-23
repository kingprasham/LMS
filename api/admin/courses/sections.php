<?php
/**
 * Sections API - CRUD for course sections
 * Supports: list, create, update, delete
 */

require_once('../../../includes/db_connect.php');
require_once('../../config.php');

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'list':
        // Get all sections for a course
        $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : null;
        if (!$course_id) {
            sendError('Course ID is required');
        }
        
        $stmt = $conn->prepare("SELECT * FROM course_sections WHERE course_id = ? ORDER BY position");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $sections = [];
        while ($row = $result->fetch_assoc()) {
            // Get videos for this section
            $videoStmt = $conn->prepare("SELECT * FROM videos WHERE section_id = ? ORDER BY position");
            $videoStmt->bind_param("i", $row['section_id']);
            $videoStmt->execute();
            $videosResult = $videoStmt->get_result();
            
            $videos = [];
            while ($video = $videosResult->fetch_assoc()) {
                $videos[] = $video;
            }
            $row['videos'] = $videos;
            $sections[] = $row;
        }
        
        sendSuccess($sections);
        break;
        
    case 'create':
        if ($method !== 'POST') sendError('Method not allowed', 405);
        
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || empty($input['course_id']) || empty($input['title'])) {
            sendError('Course ID and title are required');
        }
        
        // Get max position
        $stmt = $conn->prepare("SELECT COALESCE(MAX(position), 0) + 1 as next_pos FROM course_sections WHERE course_id = ?");
        $stmt->bind_param("i", $input['course_id']);
        $stmt->execute();
        $position = $stmt->get_result()->fetch_assoc()['next_pos'];
        
        $stmt = $conn->prepare("INSERT INTO course_sections (course_id, title, description, position) VALUES (?, ?, ?, ?)");
        $description = $input['description'] ?? '';
        $stmt->bind_param("issi", $input['course_id'], $input['title'], $description, $position);
        
        if ($stmt->execute()) {
            sendSuccess(['section_id' => $conn->insert_id, 'message' => 'Section created']);
        } else {
            sendError('Failed to create section');
        }
        break;
        
    case 'update':
        if ($method !== 'POST') sendError('Method not allowed', 405);
        
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || empty($input['section_id'])) {
            sendError('Section ID is required');
        }
        
        $stmt = $conn->prepare("UPDATE course_sections SET title = ?, description = ? WHERE section_id = ?");
        $title = $input['title'] ?? '';
        $description = $input['description'] ?? '';
        $stmt->bind_param("ssi", $title, $description, $input['section_id']);
        
        if ($stmt->execute()) {
            sendSuccess(['message' => 'Section updated']);
        } else {
            sendError('Failed to update section');
        }
        break;
        
    case 'delete':
        if ($method !== 'POST') sendError('Method not allowed', 405);
        
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || empty($input['section_id'])) {
            sendError('Section ID is required');
        }
        
        // Delete videos first
        $conn->query("DELETE FROM videos WHERE section_id = " . intval($input['section_id']));
        
        $stmt = $conn->prepare("DELETE FROM course_sections WHERE section_id = ?");
        $stmt->bind_param("i", $input['section_id']);
        
        if ($stmt->execute()) {
            sendSuccess(['message' => 'Section deleted']);
        } else {
            sendError('Failed to delete section');
        }
        break;
        
    default:
        sendError('Unknown action');
}

$conn->close();
?>
