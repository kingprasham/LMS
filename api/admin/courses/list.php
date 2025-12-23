<?php
/**
 * Admin Course List API
 * Returns all courses for the admin courses page
 */

require_once(__DIR__ . '/../../api/config.php');

// Optional: requireAdmin();

$status = isset($_GET['status']) ? sanitize($_GET['status']) : null;
$search = isset($_GET['search']) ? sanitize($_GET['search']) : null;
$category = isset($_GET['category']) ? (int)$_GET['category'] : null;

// Build query
$sql = "SELECT 
    c.course_id as id,
    c.title,
    c.slug,
    c.thumbnail,
    c.status,
    c.price,
    c.rating,
    c.enrollment_count as enrollments,
    c.created_at,
    cat.name as category,
    u.full_name as instructor
FROM courses c
LEFT JOIN categories cat ON c.category_id = cat.category_id
LEFT JOIN users u ON c.instructor_id = u.user_id
WHERE 1=1";

$params = [];
$types = "";

if ($status && $status !== 'all') {
    $sql .= " AND c.status = ?";
    $params[] = $status;
    $types .= "s";
}

if ($category) {
    $sql .= " AND c.category_id = ?";
    $params[] = $category;
    $types .= "i";
}

if ($search) {
    $sql .= " AND (c.title LIKE ? OR c.description LIKE ?)";
    $searchTerm = "%$search%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= "ss";
}

$sql .= " ORDER BY c.created_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$courses = [];
while ($row = $result->fetch_assoc()) {
    // Use placeholder image if no thumbnail
    if (empty($row['thumbnail'])) {
        $row['thumbnail'] = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=250&fit=crop';
    }
    $courses[] = $row;
}

sendSuccess($courses, 'Courses retrieved successfully');
?>
