<?php
// Start session with centralized configuration
require_once('../includes/session.php');
require_once('../includes/db_connect.php');

include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

// Fetch categories from database
$categories = [];
$catResult = $conn->query("SELECT c.*, (SELECT COUNT(*) FROM courses WHERE category_id = c.category_id AND status = 'published') as course_count FROM categories c ORDER BY name");
if ($catResult) {
    while ($row = $catResult->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch courses from database
$courses = [];
$sql = "SELECT 
    c.*,
    cat.name as category_name,
    cat.slug as category_slug,
    u.full_name as instructor_name,
    (SELECT COUNT(*) FROM enrollments WHERE course_id = c.course_id) as student_count,
    (SELECT AVG(rating) FROM course_reviews WHERE course_id = c.course_id) as avg_rating,
    (SELECT COUNT(*) FROM course_reviews WHERE course_id = c.course_id) as review_count
FROM courses c
LEFT JOIN categories cat ON c.category_id = cat.category_id
LEFT JOIN users u ON c.instructor_id = u.user_id
WHERE c.status = 'published'
ORDER BY c.is_featured DESC, c.created_at DESC";

$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Calculate per-user progress for each course (only if user is logged in)
$userProgress = [];
$currentUserId = $_SESSION['user_id'] ?? null;
if ($currentUserId && !empty($courses)) {
    foreach ($courses as $course) {
        $courseId = $course['course_id'];
        // Get total lessons and completed lessons for this user
        $progressSql = "
            SELECT 
                COUNT(DISTINCT v.video_id) as total_lessons,
                COUNT(DISTINCT CASE WHEN up.completed = 1 THEN up.video_id END) as completed_lessons
            FROM videos v
            INNER JOIN course_sections cs ON v.section_id = cs.section_id
            LEFT JOIN user_progress up ON v.video_id = up.video_id AND up.user_id = ?
            WHERE cs.course_id = ?";
        $progressStmt = $conn->prepare($progressSql);
        $progressStmt->bind_param("ii", $currentUserId, $courseId);
        $progressStmt->execute();
        $progressResult = $progressStmt->get_result();
        $progressRow = $progressResult->fetch_assoc();
        
        $total = $progressRow['total_lessons'] ?? 0;
        $completed = $progressRow['completed_lessons'] ?? 0;
        $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
        
        $userProgress[$courseId] = [
            'total' => $total,
            'completed' => $completed,
            'percent' => $percent
        ];
    }
}

renderHead('Course Catalog - Discover Medical AI Courses - AiCureAcademy', ['css/courses.css']);
renderNavbar();
?>

<!-- Pass login status to JavaScript -->
<script>
window.isLoggedIn = <?php echo (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) ? 'true' : 'false'; ?>;
</script>

    <!-- Course Catalog Header -->
    <section class="catalog-header-section">
        <div class="catalog-header-container fade-in-up">
            <h1 class="catalog-main-title">Explore Pharma AI Courses</h1>
            <p class="catalog-subtitle">Discover cutting-edge courses in pharmaceutical AI, drug discovery, and computational biology from industry experts</p>
        </div>
    </section>

    <!-- Main Catalog Section -->
    <section class="catalog-main-section">
        <div class="catalog-wrapper">
            <!-- Sidebar Filters -->
            <aside class="filters-sidebar fade-in-up">
                <div class="filters-header">
                    <h3>Filters</h3>
                    <button class="btn-clear-filters">Clear All</button>
                </div>

                <!-- Categories Filter -->
                <div class="filter-group">
                    <h4 class="filter-title">
                        Categories
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </h4>
                    <div class="filter-content">
                        <?php foreach ($categories as $cat): ?>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="category" value="<?php echo htmlspecialchars($cat['slug']); ?>">
                            <span><?php echo htmlspecialchars($cat['name']); ?></span>
                            <span class="count">(<?php echo $cat['course_count']; ?>)</span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Level Filter -->
                <div class="filter-group">
                    <h4 class="filter-title">
                        Level
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </h4>
                    <div class="filter-content">
                        <label class="filter-checkbox">
                            <input type="checkbox" name="level" value="beginner">
                            <span>Beginner</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="level" value="intermediate">
                            <span>Intermediate</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="level" value="advanced">
                            <span>Advanced</span>
                        </label>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="filter-group">
                    <h4 class="filter-title">
                        Price
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </h4>
                    <div class="filter-content">
                        <label class="filter-checkbox">
                            <input type="checkbox" name="price" value="free">
                            <span>Free</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="price" value="paid">
                            <span>Paid</span>
                        </label>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="catalog-content-area">
                <!-- Top Bar -->
                <div class="catalog-top-bar fade-in-up">
                    <div class="results-info">
                        <h2>Showing <span id="results-count"><?php echo count($courses); ?></span> results</h2>
                    </div>
                    <div class="sort-controls">
                        <select class="sort-select" id="sort-by">
                            <option value="relevance">Most Relevant</option>
                            <option value="newest">Newest</option>
                            <option value="price-low-high">Price: Low to High</option>
                            <option value="price-high-low">Price: High to Low</option>
                            <option value="highest-rated">Highest Rated</option>
                            <option value="most-popular">Most Popular</option>
                        </select>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="courses-grid">
                    <?php if (empty($courses)): ?>
                    <div class="empty-courses" style="grid-column: 1/-1; text-align: center; padding: 4rem 2rem;">
                        <i class="bi bi-collection-play" style="font-size: 4rem; color: #94a3b8;"></i>
                        <h3 style="color: #64748b; margin-top: 1rem;">No courses available yet</h3>
                        <p style="color: #94a3b8;">Check back soon for new courses!</p>
                    </div>
                    <?php else: ?>
                        <?php foreach ($courses as $index => $course): 
                            $rating = $course['avg_rating'] ? number_format($course['avg_rating'], 1) : '0.0';
                            $price = $course['price'] ? '₹' . number_format($course['price']) : 'Free';
                            $originalPrice = $course['original_price'] ? '₹' . number_format($course['original_price']) : '';
                            $discount = '';
                            if ($course['original_price'] && $course['price'] && $course['original_price'] > $course['price']) {
                                $discountPercent = round((($course['original_price'] - $course['price']) / $course['original_price']) * 100);
                                $discount = $discountPercent . '% off';
                            }
                        ?>
                    <article class="course-card fade-in-up" style="animation-delay: <?php echo ($index * 0.1); ?>s" 
                             data-category="<?php echo htmlspecialchars($course['category_slug'] ?? ''); ?>" 
                             data-price="<?php echo $course['price'] ?? 0; ?>" 
                             data-rating="<?php echo $rating; ?>" 
                             data-level="<?php echo htmlspecialchars($course['level']); ?>">
                        <a href="<?php echo url('pages/course-detail.php?id=' . $course['course_id']); ?>" class="course-card-link">
                            <div class="course-image">
                                <?php 
                                    $thumbRaw = $course['thumbnail'] ?? '';
                                    $thumbUrl = (strpos($thumbRaw, 'http') === 0) ? $thumbRaw : url($thumbRaw);
                                    if (empty($thumbRaw)) $thumbUrl = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&auto=format&fit=crop&q=60';
                                ?>
                                <img src="<?php echo htmlspecialchars($thumbUrl); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>">
                                <?php if ($course['is_featured']): ?>
                                <div class="bestseller-badge">FEATURED</div>
                                <?php endif; ?>
                                <?php if (!$course['price']): ?>
                                <div class="free-badge">FREE</div>
                                <?php endif; ?>
                            </div>
                            <div class="course-content">
                                <div class="course-category-badge"><?php echo htmlspecialchars($course['category_name'] ?? 'General'); ?></div>
                                <h3 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                                <p class="course-instructor"><?php echo htmlspecialchars($course['instructor_name'] ?? 'Instructor'); ?></p>
                                <div class="course-rating">
                                    <span class="rating-score"><?php echo $rating; ?></span>
                                    <div class="stars">
                                        <?php 
                                        $fullStars = floor($course['avg_rating'] ?? 0);
                                        $halfStar = ($course['avg_rating'] ?? 0) - $fullStars >= 0.5;
                                        for ($i = 0; $i < 5; $i++) {
                                            if ($i < $fullStars) {
                                                echo '<i class="bi bi-star-fill"></i>';
                                            } elseif ($i == $fullStars && $halfStar) {
                                                echo '<i class="bi bi-star-half"></i>';
                                            } else {
                                                echo '<i class="bi bi-star"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <span class="rating-count">(<?php echo number_format($course['review_count']); ?>)</span>
                                </div>
                                <div class="course-meta">
                                    <span><i class="bi bi-bar-chart"></i> <?php echo ucfirst($course['level']); ?></span>
                                    <span><i class="bi bi-people"></i> <?php echo number_format($course['student_count']); ?> students</span>
                                </div>
                                <?php 
                                // Show progress bar if user is logged in and has started the course
                                $courseProgress = $userProgress[$course['course_id']] ?? null;
                                if ($courseProgress && $courseProgress['completed'] > 0): 
                                ?>
                                <div class="course-progress">
                                    <div class="progress-track">
                                        <div class="progress-fill" style="width: <?php echo $courseProgress['percent']; ?>%"></div>
                                    </div>
                                    <span class="progress-text"><?php echo $courseProgress['percent']; ?>% Complete</span>
                                </div>
                                <?php endif; ?>
                                <div class="course-footer">
                                    <div class="course-price">
                                        <span class="current-price <?php echo !$course['price'] ? 'free' : ''; ?>"><?php echo $price; ?></span>
                                        <?php if ($originalPrice): ?>
                                        <span class="original-price"><?php echo $originalPrice; ?></span>
                                        <?php endif; ?>
                                        <?php if ($discount): ?>
                                        <span class="discount-badge"><?php echo $discount; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/courses.js']); ?>

<style>
/* Make course cards clickable */
.course-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}
.course-card-link:hover .course-title {
    color: #4f46e5;
}
/* Hide overlay buttons since card is clickable */
.course-card .course-overlay {
    display: none;
}
.course-card .btn-wishlist-course {
    z-index: 10;
}

/* Course Progress Bar */
.course-progress {
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid #e2e8f0;
}
.course-progress .progress-track {
    background: #e2e8f0;
    border-radius: 1rem;
    height: 6px;
    overflow: hidden;
}
.course-progress .progress-fill {
    background: linear-gradient(90deg, #4f46e5, #7c3aed);
    height: 100%;
    border-radius: 1rem;
    transition: width 0.5s ease;
}
.course-progress .progress-text {
    display: block;
    font-size: 0.75rem;
    color: #64748b;
    margin-top: 0.375rem;
    font-weight: 500;
}
</style>
