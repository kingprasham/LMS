<?php
/**
 * Upload API
 * Handles file uploads for courses, resources, etc.
 */

// Get the project root directory (where config.php lives)
// __DIR__ is /api, so parent is the LMS root
$project_root = dirname(__DIR__);

require_once($project_root . '/includes/db_connect.php');
require_once(__DIR__ . '/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendError('Method not allowed', 405);
}

if (!isset($_FILES['file'])) {
    sendError('No file uploaded');
}

$file = $_FILES['file'];
$type = $_POST['type'] ?? 'misc'; // image, video, document, misc

// Validate file
if ($file['error'] !== UPLOAD_ERR_OK) {
    $upload_errors = [
        UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize',
        UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
    ];
    $error_msg = $upload_errors[$file['error']] ?? 'Unknown upload error';
    sendError('File upload error: ' . $error_msg);
}

// Validation settings
$allowed_extensions = [
    'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
    'video' => ['mp4', 'webm', 'ogg'],
    'document' => ['pdf', 'doc', 'docx', 'zip', 'rar', 'ppt', 'pptx', 'xls', 'xlsx', 'txt', 'md'],
    'misc' => ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'pdf', 'doc', 'docx', 'zip', 'txt']
];

$file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if ($type === 'auto') {
    // Detect type
    if (in_array($file_ext, $allowed_extensions['image'])) $type = 'image';
    elseif (in_array($file_ext, $allowed_extensions['video'])) $type = 'video';
    elseif (in_array($file_ext, $allowed_extensions['document'])) $type = 'document';
    else $type = 'misc';
}

if (!isset($allowed_extensions[$type])) $type = 'misc';

if (!in_array($file_ext, $allowed_extensions[$type]) && !in_array($file_ext, $allowed_extensions['misc'])) {
    sendError('Invalid file type: ' . $file_ext);
}

// directory structure: uploads/{type}/{year}/{month}/
$upload_base = $project_root . '/uploads/';
$relative_base = 'uploads/';
$path_suffix = $type . '/' . date('Y') . '/' . date('m') . '/';

$target_dir = $upload_base . $path_suffix;

// Create directory if it doesn't exist
if (!file_exists($target_dir)) {
    if (!mkdir($target_dir, 0777, true)) {
        sendError('Failed to create upload directory: ' . $target_dir);
    }
}

// Generate unique filename
$filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
$target_file = $target_dir . $filename;
$relative_path = $relative_base . $path_suffix . $filename;

if (move_uploaded_file($file['tmp_name'], $target_file)) {
    sendSuccess([
        'path' => $relative_path,
        'url' => $relative_path, // Store relative path, frontend will handle base URL
        'name' => $file['name'],
        'size' => $file['size'],
        'type' => $type
    ]);
} else {
    sendError('Failed to move uploaded file. Target: ' . $target_file);
}
?>
