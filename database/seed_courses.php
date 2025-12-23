<?php
/**
 * Seed Pharma AI Courses
 * Seeds the 10 pharma AI courses as specified
 */

require_once('../includes/db_connect.php');

echo "<h2>Seeding Pharma AI Courses</h2>";
echo "<pre>";

// First, ensure categories exist
$categories = [
    ['Machine Learning', 'machine-learning', 'Master ML algorithms for pharma', 'bi-cpu', '#667eea'],
    ['Generative AI', 'generative-ai', 'AI-driven molecule generation', 'bi-robot', '#ff9a9e'],
    ['NLP & Text Mining', 'nlp-text-mining', 'Natural language processing for pharma', 'bi-file-text', '#4facfe'],
    ['LLM Applications', 'llm-applications', 'Large Language Models in pharma', 'bi-chat-dots', '#fa709a'],
    ['Data Engineering', 'data-engineering', 'Data pipelines for drug discovery', 'bi-database', '#30cfd0'],
    ['Clinical Trials', 'clinical-trials', 'AI in clinical research', 'bi-clipboard2-pulse', '#a8edea'],
    ['Pharmacovigilance', 'pharmacovigilance', 'AI for drug safety', 'bi-shield-check', '#f093fb'],
    ['Drug Discovery', 'drug-discovery', 'End-to-end AI in pharma', 'bi-capsule', '#ffecd2']
];

// Clear existing categories and add new ones
$conn->query("DELETE FROM categories");
$stmt = $conn->prepare("INSERT INTO categories (name, slug, description, icon, color) VALUES (?, ?, ?, ?, ?)");
foreach ($categories as $cat) {
    $stmt->bind_param("sssss", $cat[0], $cat[1], $cat[2], $cat[3], $cat[4]);
    $stmt->execute();
}
echo "✓ " . count($categories) . " categories created\n";

// Get admin user ID
$result = $conn->query("SELECT user_id FROM users WHERE role = 'admin' LIMIT 1");
$admin = $result->fetch_assoc();
$instructor_id = $admin ? $admin['user_id'] : 1;
echo "✓ Using instructor ID: $instructor_id\n\n";

// Get category IDs
$cat_ids = [];
$result = $conn->query("SELECT category_id, slug FROM categories");
while ($row = $result->fetch_assoc()) {
    $cat_ids[$row['slug']] = $row['category_id'];
}

// Define the 10 pharma AI courses
$courses = [
    [
        'title' => 'AI-Ready Pharma Scientist: Foundations of ML for Drug Discovery',
        'subtitle' => 'Turn raw data into scientific intelligence.',
        'description' => 'A comprehensive course for fresh Pharma graduates (B.Pharm, M.Pharm, Pharm.D), entry-level R&D trainees, QC/QA beginners looking to build foundations in machine learning for pharmaceutical applications.',
        'category' => 'machine-learning',
        'level' => 'beginner',
        'price' => 4999,
        'original_price' => 7999
    ],
    [
        'title' => 'Machine Learning for Molecules: Practical ML for Medicinal Chemistry',
        'subtitle' => 'Where chemistry meets computation.',
        'description' => 'Designed for medicinal chemists, formulation scientists, preclinical researchers, and chemistry graduates who want to apply machine learning to molecular analysis and drug design.',
        'category' => 'machine-learning',
        'level' => 'intermediate',
        'price' => 5999,
        'original_price' => 9999
    ],
    [
        'title' => 'Generative AI for Drug Discovery: Molecule Creation to Optimization',
        'subtitle' => 'Create molecules like an AI research scientist.',
        'description' => 'Learn to use generative AI for molecule creation and optimization. Perfect for computational chemists, medicinal chemists, and fresh graduates eager to enter AI-driven discovery.',
        'category' => 'generative-ai',
        'level' => 'advanced',
        'price' => 7999,
        'original_price' => 12999
    ],
    [
        'title' => 'NLP & Text Intelligence in Pharma: From Literature Mining to Regulatory Insights',
        'subtitle' => 'Understand the science hidden in text.',
        'description' => 'Master natural language processing for pharmaceutical applications. Ideal for PV professionals, medical writers, regulatory writers, and clinical documentation teams.',
        'category' => 'nlp-text-mining',
        'level' => 'intermediate',
        'price' => 5499,
        'original_price' => 8999
    ],
    [
        'title' => 'LLM-Driven Pharma Analytics: ChatGPT, BioGPT & Domain-Specific LLMs',
        'subtitle' => 'Transform complex scientific data into decisions.',
        'description' => 'Learn to leverage large language models like ChatGPT and BioGPT for pharmaceutical analytics. For clinical data managers, medical writers, regulatory affairs teams, and R&D analysts.',
        'category' => 'llm-applications',
        'level' => 'intermediate',
        'price' => 6499,
        'original_price' => 10999
    ],
    [
        'title' => 'Agentic AI for Pharma R&D: Autonomous Scientific Workflows',
        'subtitle' => 'Build AI agents that think like junior scientists.',
        'description' => 'Explore cutting-edge agentic AI systems for pharmaceutical research. Designed for AI/ML enthusiasts in pharma, automation engineers, and R&D innovation teams.',
        'category' => 'generative-ai',
        'level' => 'advanced',
        'price' => 8999,
        'original_price' => 14999
    ],
    [
        'title' => 'Data Engineering for Drug Discovery: Pipelines, ETL & Scientific Databases',
        'subtitle' => 'Make scientific data usable, clean and actionable.',
        'description' => 'Build robust data pipelines for drug discovery. Perfect for data analysts, CDM professionals, bioinformatics beginners, and IT teams supporting R&D.',
        'category' => 'data-engineering',
        'level' => 'intermediate',
        'price' => 5999,
        'original_price' => 9499
    ],
    [
        'title' => 'AI in Clinical Trials: Predictive Models, NLP & GenAI for Study Operations',
        'subtitle' => 'Modernize trials with AI-driven insights.',
        'description' => 'Apply AI to clinical trial operations. Ideal for CRAs, clinical operations teams, medical monitors, and project managers in clinical research.',
        'category' => 'clinical-trials',
        'level' => 'intermediate',
        'price' => 6999,
        'original_price' => 11999
    ],
    [
        'title' => 'AI for Pharmacovigilance: From Signal Detection to Automated Case Processing',
        'subtitle' => 'Build the future of safety intelligence.',
        'description' => 'Master AI applications in pharmacovigilance and drug safety. For PV associates, medical reviewers, drug safety teams, and Pharm.D graduates.',
        'category' => 'pharmacovigilance',
        'level' => 'intermediate',
        'price' => 5999,
        'original_price' => 9999
    ],
    [
        'title' => 'End-to-End AI in Pharma: From Discovery to Pharmacovigilance',
        'subtitle' => 'See the entire pharmaceutical pipeline through an AI lens.',
        'description' => 'A comprehensive overview of AI across the pharmaceutical pipeline. Perfect for fresh graduates entering pharma, cross-functional professionals, and leadership teams exploring digital transformation.',
        'category' => 'drug-discovery',
        'level' => 'beginner',
        'price' => 9999,
        'original_price' => 15999
    ]
];

// Thumbnail URLs (pharma/AI themed)
$thumbnails = [
    'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&h=450&fit=crop', // Lab/science
    'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=800&h=450&fit=crop', // Chemistry
    'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=450&fit=crop', // AI
    'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=450&fit=crop', // Documents
    'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=800&h=450&fit=crop', // AI Brain
    'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800&h=450&fit=crop', // Robot
    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=450&fit=crop', // Data
    'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800&h=450&fit=crop', // Medical
    'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=800&h=450&fit=crop', // Pharma
    'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=800&h=450&fit=crop'  // Pills/Pharma
];

// Clear existing courses
$conn->query("DELETE FROM courses");

// Insert courses
$stmt = $conn->prepare("INSERT INTO courses (title, subtitle, slug, description, category_id, instructor_id, thumbnail, price, original_price, level, status, is_featured, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'published', ?, NOW())");

echo "Creating courses:\n";
foreach ($courses as $i => $course) {
    $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $course['title']));
    $slug = trim($slug, '-');
    $cat_id = $cat_ids[$course['category']] ?? null;
    $thumbnail = $thumbnails[$i];
    $is_featured = ($i < 3) ? 1 : 0; // First 3 are featured
    
    $stmt->bind_param(
        "ssssiisdisi",
        $course['title'],
        $course['subtitle'],
        $slug,
        $course['description'],
        $cat_id,
        $instructor_id,
        $thumbnail,
        $course['price'],
        $course['original_price'],
        $course['level'],
        $is_featured
    );
    
    if ($stmt->execute()) {
        echo "  ✓ " . ($i + 1) . ". " . $course['title'] . "\n";
    } else {
        echo "  ✗ Failed: " . $course['title'] . " - " . $conn->error . "\n";
    }
}

echo "\n</pre>";
echo "<h3 style='color: green;'>✓ Courses seeded successfully!</h3>";
echo "<p><a href='../pages/admin/courses.php'>→ View Courses</a></p>";
echo "<p><a href='../pages/admin/dashboard.php'>→ Go to Dashboard</a></p>";
echo "<p><a href='../index.php'>→ View Public Site</a></p>";

$conn->close();
?>
