<?php
/**
 * Q&A API
 * Handles questions and answers for courses/lessons
 * 
 * POST: Create a new question
 * DELETE: Delete a question by question_id (owner only)
 */

require_once('../includes/session.php');
require_once('../config.php');
require_once('../includes/db_connect.php');

header('Content-Type: application/json');

// Check if user is logged in
$user_id = $_SESSION['user_id'] ?? 0;

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Create a new question
    if ($user_id <= 0) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Please login to ask a question']);
        exit;
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    $video_id = isset($input['video_id']) ? (int)$input['video_id'] : null;
    $course_id = $input['course_id'] ?? 0;
    $question_text = trim($input['question_text'] ?? '');
    
    if (empty($question_text)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Question text is required']);
        exit;
    }
    
    if ($course_id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Course ID is required']);
        exit;
    }
    
    $stmt = $conn->prepare("INSERT INTO course_questions (course_id, video_id, user_id, question_text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $course_id, $video_id, $user_id, $question_text);
    
    if ($stmt->execute()) {
        $question_id = $conn->insert_id;
        
        // Get user name for response
        $userStmt = $conn->prepare("SELECT full_name FROM users WHERE user_id = ?");
        $userStmt->bind_param("i", $user_id);
        $userStmt->execute();
        $userResult = $userStmt->get_result();
        $user = $userResult->fetch_assoc();
        $userName = $user['full_name'] ?? 'Anonymous';
        
        echo json_encode([
            'success' => true, 
            'message' => 'Question submitted successfully',
            'question' => [
                'question_id' => $question_id,
                'question_text' => $question_text,
                'user_name' => $userName,
                'reply_count' => 0,
                'helpful_count' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to submit question: ' . $conn->error]);
    }
    
} elseif ($method === 'DELETE') {
    // Delete a question (owner only)
    if ($user_id <= 0) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Please login to delete a question']);
        exit;
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    $question_id = $input['question_id'] ?? 0;
    
    if ($question_id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Question ID is required']);
        exit;
    }
    
    // Only allow users to delete their own questions
    $stmt = $conn->prepare("DELETE FROM course_questions WHERE question_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $question_id, $user_id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Question deleted successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Question not found or you do not have permission to delete it']);
        }
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to delete question']);
    }
    
} elseif ($method === 'GET') {
    // Get questions for a course/video
    $course_id = $_GET['course_id'] ?? 0;
    $video_id = $_GET['video_id'] ?? 0;
    
    $questions = [];
    $sql = "SELECT q.*, u.full_name as user_name, 
            (SELECT COUNT(*) FROM question_replies WHERE question_id = q.question_id) as reply_count
            FROM course_questions q 
            LEFT JOIN users u ON q.user_id = u.user_id
            WHERE q.course_id = ?";
    
    if ($video_id > 0) {
        $sql .= " OR q.video_id = ?";
        $stmt = $conn->prepare($sql . " ORDER BY q.created_at DESC LIMIT 50");
        $stmt->bind_param("ii", $course_id, $video_id);
    } else {
        $stmt = $conn->prepare($sql . " ORDER BY q.created_at DESC LIMIT 50");
        $stmt->bind_param("i", $course_id);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
    
    echo json_encode(['success' => true, 'questions' => $questions]);
    
} elseif ($method === 'PUT') {
    // Handle replies and helpful
    if ($user_id <= 0) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Please login']);
        exit;
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    $question_id = $input['question_id'] ?? 0;
    
    if ($question_id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Question ID is required']);
        exit;
    }
    
    if ($action === 'helpful') {
        // Increment helpful count
        $stmt = $conn->prepare("UPDATE course_questions SET helpful_count = helpful_count + 1 WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        
        if ($stmt->execute()) {
            // Get new count
            $countStmt = $conn->prepare("SELECT helpful_count FROM course_questions WHERE question_id = ?");
            $countStmt->bind_param("i", $question_id);
            $countStmt->execute();
            $result = $countStmt->get_result();
            $row = $result->fetch_assoc();
            
            echo json_encode([
                'success' => true,
                'message' => 'Marked as helpful',
                'helpful_count' => $row['helpful_count'] ?? 0
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update']);
        }
        
    } elseif ($action === 'reply') {
        // Add a reply
        $reply_text = trim($input['reply_text'] ?? '');
        
        if (empty($reply_text)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Reply text is required']);
            exit;
        }
        
        // Check if user is instructor (for is_instructor_reply flag)
        $isInstructor = 0; // Default to false, would need to check user role
        
        $stmt = $conn->prepare("INSERT INTO question_replies (question_id, user_id, reply_text, is_instructor_reply) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $question_id, $user_id, $reply_text, $isInstructor);
        
        if ($stmt->execute()) {
            $reply_id = $conn->insert_id;
            
            // Get user name
            $userStmt = $conn->prepare("SELECT full_name FROM users WHERE user_id = ?");
            $userStmt->bind_param("i", $user_id);
            $userStmt->execute();
            $userResult = $userStmt->get_result();
            $user = $userResult->fetch_assoc();
            $userName = $user['full_name'] ?? 'Anonymous';
            
            echo json_encode([
                'success' => true,
                'message' => 'Reply added successfully',
                'reply' => [
                    'reply_id' => $reply_id,
                    'reply_text' => $reply_text,
                    'user_name' => $userName,
                    'created_at' => date('Y-m-d H:i:s')
                ]
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to add reply']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }

} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

$conn->close();
?>
