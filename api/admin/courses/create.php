<?php
/**
 * Create Course API
 * Handles complete course creation with sections, lectures, learning objectives, and requirements
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
if (empty($input['title'])) {
    sendError('Course title is required');
}

$title = $input['title'];
$subtitle = $input['subtitle'] ?? '';
$description = $input['description'] ?? '';
$category_id = isset($input['category_id']) && $input['category_id'] !== '' ? (int)$input['category_id'] : null;
$instructor_id = isset($input['instructor_id']) ? (int)$input['instructor_id'] : 1;
$thumbnail = $input['thumbnail'] ?? '';
$promo_video = $input['promo_video_url'] ?? ($input['promo_video'] ?? '');
$price = isset($input['price']) ? (float)$input['price'] : 0;
$original_price = isset($input['original_price']) && $input['original_price'] !== '' ? (float)$input['original_price'] : null;
$level = $input['level'] ?? 'beginner';
$language = $input['language'] ?? 'English';
$status = $input['status'] ?? 'draft';
$is_featured = isset($input['is_featured']) ? (int)$input['is_featured'] : 0;

// Learning objectives and requirements
$outcomes = $input['outcomes'] ?? '';
$requirements = $input['requirements'] ?? '';

// Generate unique slug
$slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title));
$slug = trim($slug, '-');
$base_slug = $slug;
$counter = 1;

// Make slug unique
while (true) {
    $stmt = $conn->prepare("SELECT course_id FROM courses WHERE slug = ?");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) break;
    $slug = $base_slug . '-' . $counter++;
}

// Calculate total duration from sections
$totalDurationMinutes = 0;
if (!empty($input['sections']) && is_array($input['sections'])) {
    foreach ($input['sections'] as $section) {
        if (!empty($section['lectures']) && is_array($section['lectures'])) {
            foreach ($section['lectures'] as $lecture) {
                $durationStr = $lecture['duration'] ?? '0';
                if (strpos($durationStr, ':') !== false) {
                    $parts = explode(':', $durationStr);
                    if (count($parts) == 2) {
                        $totalDurationMinutes += (int)$parts[0] + ((int)$parts[1] / 60);
                    } else if (count($parts) == 3) {
                        $totalDurationMinutes += ((int)$parts[0] * 60) + (int)$parts[1];
                    }
                } else {
                    $totalDurationMinutes += (int)$durationStr;
                }
            }
        }
    }
}
$duration_hours = round($totalDurationMinutes / 60, 2);

// Insert course with all fields including promo_video, language, and duration_hours
$sql = "INSERT INTO courses (title, subtitle, slug, description, category_id, instructor_id, thumbnail, promo_video, price, original_price, level, language, duration_hours, status, is_featured, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    sendError('Database prepare error: ' . $conn->error);
}

$stmt->bind_param(
    "ssssiissddssdsi",
    $title,
    $subtitle,
    $slug,
    $description,
    $category_id,
    $instructor_id,
    $thumbnail,
    $promo_video,
    $price,
    $original_price,
    $level,
    $language,
    $duration_hours,
    $status,
    $is_featured
);

if ($stmt->execute()) {
    $course_id = $conn->insert_id;

    // Update published_at if status is published
    if ($status === 'published') {
        $conn->query("UPDATE courses SET published_at = NOW() WHERE course_id = $course_id");
    }

    // Insert learning objectives
    if (!empty($outcomes)) {
        $objectiveLines = array_filter(array_map('trim', explode("\n", $outcomes)));
        $position = 1;
        foreach ($objectiveLines as $objective) {
            if (!empty($objective)) {
                $objStmt = $conn->prepare("INSERT INTO course_learning_objectives (course_id, objective_text, position) VALUES (?, ?, ?)");
                $objStmt->bind_param("isi", $course_id, $objective, $position);
                $objStmt->execute();
                $position++;
            }
        }
    }

    // Insert requirements
    if (!empty($requirements)) {
        $requirementLines = array_filter(array_map('trim', explode("\n", $requirements)));
        $position = 1;
        foreach ($requirementLines as $requirement) {
            if (!empty($requirement)) {
                $reqStmt = $conn->prepare("INSERT INTO course_requirements (course_id, requirement_text, position) VALUES (?, ?, ?)");
                $reqStmt->bind_param("isi", $course_id, $requirement, $position);
                $reqStmt->execute();
                $position++;
            }
        }
    }

    // Insert sections and lectures if available
    if (!empty($input['sections']) && is_array($input['sections'])) {
        $sectionPosition = 0;
        foreach ($input['sections'] as $sectionIndex => $sectionData) {
            // Skip sections without a title
            $sectionTitle = isset($sectionData['title']) ? trim($sectionData['title']) : '';
            if (empty($sectionTitle)) continue;
            
            $sectionPosition++;

            $sectStmt = $conn->prepare("INSERT INTO course_sections (course_id, title, position) VALUES (?, ?, ?)");
            $sectStmt->bind_param("isi", $course_id, $sectionTitle, $sectionPosition);

            if ($sectStmt->execute()) {
                $section_id = $conn->insert_id;

                if (!empty($sectionData['lectures']) && is_array($sectionData['lectures'])) {
                    foreach ($sectionData['lectures'] as $lectureIndex => $lectureData) {
                        $lectureTitle = $lectureData['title'] ?? 'Lecture ' . ($lectureIndex + 1);
                        $videoUrl = $lectureData['video_url'] ?? '';
                        $durationStr = $lectureData['duration'] ?? '0';
                        $isPreview = !empty($lectureData['is_preview']) ? 1 : 0;
                        $lecturePos = $lectureIndex + 1;

                        // Parse duration to minutes
                        $durationMinutes = 0;
                        if (strpos($durationStr, ':') !== false) {
                            $parts = explode(':', $durationStr);
                            if (count($parts) == 2) {
                                // MM:SS format
                                $durationMinutes = (int)$parts[0] + round((int)$parts[1] / 60, 2);
                            } else if (count($parts) == 3) {
                                // HH:MM:SS format
                                $durationMinutes = ((int)$parts[0] * 60) + (int)$parts[1] + round((int)$parts[2] / 60, 2);
                            }
                        } else {
                            $durationMinutes = (int)$durationStr;
                        }

                        // Lecture description (may contain article, notes, or quiz JSON)
                        $lectureDescription = $lectureData['description'] ?? '';

                        // Determine video type from URL
                        $videoType = 'external';
                        if (strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false) {
                            $videoType = 'youtube';
                        } elseif (strpos($videoUrl, 'vimeo.com') !== false) {
                            $videoType = 'vimeo';
                        } elseif (strpos($videoUrl, 'uploads/') !== false) {
                            $videoType = 'upload';
                        }

                        $vidStmt = $conn->prepare("INSERT INTO videos (section_id, course_id, title, video_url, video_type, description, duration_minutes, position, is_preview) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $vidStmt->bind_param("iissssiii", $section_id, $course_id, $lectureTitle, $videoUrl, $videoType, $lectureDescription, $durationMinutes, $lecturePos, $isPreview);

                        if ($vidStmt->execute()) {
                            $video_id = $conn->insert_id;

                            // Insert Resources
                            if (!empty($lectureData['resources']) && is_array($lectureData['resources'])) {
                                foreach ($lectureData['resources'] as $resource) {
                                    $resName = $resource['name'] ?? 'Resource';
                                    $resPath = $resource['path'] ?? '';
                                    $resType = $resource['type'] ?? 'file';
                                    $resSize = $resource['size'] ?? 0;

                                    if ($resPath) {
                                        $resStmt = $conn->prepare("INSERT INTO video_resources (video_id, course_id, name, file_path, file_type, file_size) VALUES (?, ?, ?, ?, ?, ?)");
                                        $resStmt->bind_param("iisssi", $video_id, $course_id, $resName, $resPath, $resType, $resSize);
                                        $resStmt->execute();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    // Update course with calculated total duration
    $totalLectures = 0;
    $result = $conn->query("SELECT COUNT(*) as count FROM videos WHERE course_id = $course_id");
    if ($result) {
        $row = $result->fetch_assoc();
        $totalLectures = $row['count'];
    }

    sendSuccess([
        'course_id' => $course_id,
        'slug' => $slug,
        'total_lectures' => $totalLectures,
        'duration_hours' => $duration_hours,
        'message' => 'Course created successfully'
    ]);
} else {
    sendError('Failed to create course: ' . $stmt->error);
}

$conn->close();
?>
