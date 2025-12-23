<?php
/**
 * Seed Categories Only
 * Quick script to add categories without other data
 */

require_once('../includes/db_connect.php');

echo "<h2>Seeding Categories</h2>";
echo "<pre>";

$categories = [
    ['Generative AI', 'generative-ai', 'Learn about generative AI models', 'bi-robot', '#667eea'],
    ['Machine Learning', 'machine-learning', 'Master ML algorithms', 'bi-cpu', '#ff9a9e'],
    ['Data Science', 'data-science', 'Data analysis and visualization', 'bi-bar-chart', '#4facfe'],
    ['Web Development', 'web-development', 'Build modern web applications', 'bi-code-slash', '#fa709a'],
    ['Deep Learning', 'deep-learning', 'Neural networks and deep learning', 'bi-diagram-3', '#30cfd0'],
    ['Cloud Computing', 'cloud-computing', 'AWS, Azure, and GCP', 'bi-cloud', '#a8edea'],
    ['Mobile Development', 'mobile-development', 'iOS and Android apps', 'bi-phone', '#f093fb'],
    ['Cybersecurity', 'cybersecurity', 'Security and ethical hacking', 'bi-shield-lock', '#ffecd2']
];

$stmt = $conn->prepare("INSERT IGNORE INTO categories (name, slug, description, icon, color) VALUES (?, ?, ?, ?, ?)");
foreach ($categories as $cat) {
    $stmt->bind_param("sssss", $cat[0], $cat[1], $cat[2], $cat[3], $cat[4]);
    $stmt->execute();
}

echo "✓ " . count($categories) . " categories seeded\n";

// Show current categories
$result = $conn->query("SELECT * FROM categories ORDER BY name");
echo "\nCategories in database:\n";
while ($row = $result->fetch_assoc()) {
    echo "  - " . $row['name'] . " (" . $row['slug'] . ")\n";
}

echo "</pre>";
echo "<p><a href='../pages/admin/add-course.php'>→ Add a Course</a></p>";
echo "<p><a href='../pages/admin/courses.php'>→ View Courses</a></p>";

$conn->close();
?>
