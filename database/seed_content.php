<?php
/**
 * Seed Course Content
 * Adds sections and videos to all existing courses
 */

require_once('../includes/db_connect.php');

echo "<h2>Seeding Course Content (Sections & Videos)</h2>";
echo "<pre>";

// Define generic learning content for pharma AI courses
$sectionTemplates = [
    [
        'title' => 'Getting Started',
        'videos' => [
            ['title' => 'Course Introduction & Overview', 'duration' => 480],
            ['title' => 'Setting Up Your Learning Environment', 'duration' => 720],
            ['title' => 'How to Get the Most Out of This Course', 'duration' => 360],
            ['title' => 'Course Resources & Downloads', 'duration' => 240]
        ]
    ],
    [
        'title' => 'Fundamentals',
        'videos' => [
            ['title' => 'Core Concepts & Terminology', 'duration' => 900],
            ['title' => 'Understanding the Domain', 'duration' => 840],
            ['title' => 'Key Principles & Best Practices', 'duration' => 780],
            ['title' => 'Hands-on Exercise: First Steps', 'duration' => 1200],
            ['title' => 'Quiz: Testing Your Understanding', 'duration' => 300]
        ]
    ],
    [
        'title' => 'Intermediate Techniques',
        'videos' => [
            ['title' => 'Building on the Basics', 'duration' => 1080],
            ['title' => 'Working with Real Data', 'duration' => 1440],
            ['title' => 'Practical Application Methods', 'duration' => 1320],
            ['title' => 'Case Study Analysis', 'duration' => 1500],
            ['title' => 'Troubleshooting Common Issues', 'duration' => 720]
        ]
    ],
    [
        'title' => 'Advanced Topics',
        'videos' => [
            ['title' => 'Deep Dive: Advanced Concepts', 'duration' => 1800],
            ['title' => 'Industry Applications & Examples', 'duration' => 1560],
            ['title' => 'Optimization Techniques', 'duration' => 1320],
            ['title' => 'Cutting-Edge Research & Trends', 'duration' => 960]
        ]
    ],
    [
        'title' => 'Project Work',
        'videos' => [
            ['title' => 'Capstone Project Introduction', 'duration' => 600],
            ['title' => 'Project Planning & Setup', 'duration' => 900],
            ['title' => 'Implementation Walkthrough', 'duration' => 2400],
            ['title' => 'Project Review & Feedback', 'duration' => 720],
            ['title' => 'Final Assessment & Certification', 'duration' => 480]
        ]
    ]
];

// Get all courses
$courses = [];
$result = $conn->query("SELECT course_id, title FROM courses ORDER BY course_id");
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

echo "Found " . count($courses) . " courses to populate with content\n\n";

// Clear existing sections and videos
$conn->query("DELETE FROM videos");
$conn->query("DELETE FROM course_sections");
echo "✓ Cleared existing sections and videos\n\n";

$totalSections = 0;
$totalVideos = 0;

foreach ($courses as $course) {
    echo "Course: " . $course['title'] . "\n";
    
    $position = 0;
    foreach ($sectionTemplates as $sectionTpl) {
        $position++;
        
        // Insert section
        $stmt = $conn->prepare("INSERT INTO course_sections (course_id, title, position) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $course['course_id'], $sectionTpl['title'], $position);
        $stmt->execute();
        $section_id = $conn->insert_id;
        $totalSections++;
        
        echo "  + Section $position: " . $sectionTpl['title'] . "\n";
        
        // Insert videos for this section
        $videoPos = 0;
        foreach ($sectionTpl['videos'] as $videoTpl) {
            $videoPos++;
            
            // Create a YouTube-style video URL (placeholder)
            $video_url = "https://www.youtube.com/embed/dQw4w9WgXcQ";
            $is_preview = ($position == 1 && $videoPos <= 2) ? 1 : 0; // First 2 videos of first section are previews
            $duration_minutes = ceil($videoTpl['duration'] / 60);
            
            $stmt = $conn->prepare("INSERT INTO videos (section_id, course_id, title, video_url, duration_minutes, position, is_preview) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissiii", $section_id, $course['course_id'], $videoTpl['title'], $video_url, $duration_minutes, $videoPos, $is_preview);
            $stmt->execute();
            $totalVideos++;
            
            echo "    - " . $videoTpl['title'] . " (" . $duration_minutes . " min)" . ($is_preview ? " [PREVIEW]" : "") . "\n";
        }
    }
    echo "\n";
}

echo "===========================================\n";
echo "✓ Created $totalSections sections\n";
echo "✓ Created $totalVideos videos\n";
echo "===========================================\n";

echo "</pre>";
echo "<p><a href='../pages/admin/courses.php'>→ View Courses</a></p>";
echo "<p><a href='../pages/course-detail.php?id=1'>→ View Course Detail</a></p>";

$conn->close();
?>
