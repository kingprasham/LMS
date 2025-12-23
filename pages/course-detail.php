<?php
require_once('../includes/session.php');
require_once('../config.php');
require_once('../includes/db_connect.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

// Get course ID from URL
$course_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$course_id) {
    header('Location: ' . url('pages/courses.php'));
    exit;
}

// Fetch course from database
$sql = "SELECT 
    c.*,
    cat.name as category_name,
    cat.slug as category_slug,
    u.full_name as instructor_name,
    u.bio as instructor_bio,
    u.avatar as instructor_avatar,
    (SELECT COUNT(*) FROM enrollments WHERE course_id = c.course_id) as student_count,
    (SELECT AVG(rating) FROM course_reviews WHERE course_id = c.course_id) as avg_rating,
    (SELECT COUNT(*) FROM course_reviews WHERE course_id = c.course_id) as review_count
FROM courses c
LEFT JOIN categories cat ON c.category_id = cat.category_id
LEFT JOIN users u ON c.instructor_id = u.user_id
WHERE c.course_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: ' . url('pages/courses.php'));
    exit;
}

$course = $result->fetch_assoc();

// Get course sections and videos
$sections = [];
$stmt = $conn->prepare("SELECT * FROM course_sections WHERE course_id = ? ORDER BY position, section_id");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$sectionsResult = $stmt->get_result();

$totalLectures = 0;
$totalDurationMinutes = 0;

while ($section = $sectionsResult->fetch_assoc()) {
    $videoStmt = $conn->prepare("SELECT * FROM videos WHERE section_id = ? ORDER BY position, video_id");
    $videoStmt->bind_param("i", $section['section_id']);
    $videoStmt->execute();
    $videosResult = $videoStmt->get_result();

    $videos = [];
    $sectionDurationMinutes = 0;
    while ($video = $videosResult->fetch_assoc()) {
        $videos[] = $video;
        $sectionDurationMinutes += $video['duration_minutes'] ?? 0;
    }

    $section['videos'] = $videos;
    $section['duration_minutes'] = $sectionDurationMinutes;
    $section['lecture_count'] = count($videos);
    $sections[] = $section;

    $totalLectures += count($videos);
    $totalDurationMinutes += $sectionDurationMinutes;
}

// Learning objectives from database
$objectives = [];
$objStmt = $conn->prepare("SELECT objective_text FROM course_learning_objectives WHERE course_id = ? ORDER BY position");
$objStmt->bind_param("i", $course_id);
$objStmt->execute();
$objResult = $objStmt->get_result();
while ($obj = $objResult->fetch_assoc()) {
    $objectives[] = $obj['objective_text'];
}

// Requirements from database
$requirements = [];
$reqStmt = $conn->prepare("SELECT requirement_text FROM course_requirements WHERE course_id = ? ORDER BY position");
$reqStmt->bind_param("i", $course_id);
$reqStmt->execute();
$reqResult = $reqStmt->get_result();
while ($req = $reqResult->fetch_assoc()) {
    $requirements[] = $req['requirement_text'];
}

// Format values
$rating = $course['avg_rating'] ? number_format($course['avg_rating'], 1) : '0.0';
$studentCount = $course['student_count'] ?? 0;
$reviewCount = $course['review_count'] ?? 0;

// Duration is in minutes, convert to hours and minutes
$hours = floor($totalDurationMinutes / 60);
$minutes = $totalDurationMinutes % 60;
$durationFormatted = $hours > 0 ? "{$hours}h {$minutes}m" : "{$minutes}m total length";

// Format price
$price = $course['price'] ? '₹' . number_format($course['price']) : 'Free';
$originalPrice = $course['original_price'] ? '₹' . number_format($course['original_price']) : '';
$discount = '';
if ($course['original_price'] && $course['price'] && $course['original_price'] > $course['price']) {
    $discountPercent = round((($course['original_price'] - $course['price']) / $course['original_price']) * 100);
    $discount = $discountPercent . '% off';
}

renderHead(htmlspecialchars($course['title']) . ' - AI Cure Academy', ['css/course-detail.css?v=' . time()]);
renderNavbar();
?>
<script>
window.isLoggedIn = <?php echo (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) ? 'true' : 'false'; ?>;
window.courseId = <?php echo $course_id; ?>;
</script>

    <!-- Modern Course Hero Section -->
    <section class="course-hero-modern">
        <div class="course-hero-container">
            <div class="hero-content-area fade-in-up">
                <nav aria-label="breadcrumb">
                    <ol class="course-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo url('index.php'); ?>"><i class="bi bi-house-door"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo url('pages/courses.php'); ?>">Courses</a></li>
                        <?php if ($course['category_name']): ?>
                        <li class="breadcrumb-item"><a href="<?php echo url('pages/courses.php?category=' . $course['category_slug']); ?>"><?php echo htmlspecialchars($course['category_name']); ?></a></li>
                        <?php endif; ?>
                        <li class="breadcrumb-item active"><?php echo htmlspecialchars($course['title']); ?></li>
                    </ol>
                </nav>

                <h1 class="hero-title-modern"><?php echo htmlspecialchars($course['title']); ?></h1>
                <p class="hero-description"><?php echo htmlspecialchars($course['subtitle'] ?? $course['description']); ?></p>

                <div class="hero-meta-badges">
                    <?php if ($course['is_featured']): ?>
                    <div class="meta-badge bestseller">
                        <i class="bi bi-award-fill"></i>
                        <span>Featured</span>
                    </div>
                    <?php endif; ?>
                    <div class="meta-badge rating">
                        <i class="bi bi-star-fill"></i>
                        <span><?php echo $rating; ?> (<?php echo number_format($reviewCount); ?>)</span>
                    </div>
                    <div class="meta-badge students">
                        <i class="bi bi-people-fill"></i>
                        <span><?php echo number_format($studentCount); ?> students</span>
                    </div>
                </div>

                <div class="hero-instructor-info">
                    <img src="<?php echo $course['instructor_avatar'] ?: 'https://ui-avatars.com/api/?name=' . urlencode($course['instructor_name'] ?? 'Instructor') . '&size=60'; ?>" alt="<?php echo htmlspecialchars($course['instructor_name']); ?>" class="instructor-avatar-small">
                    <div class="instructor-text">
                        <span class="instructor-label">Created by</span>
                        <a href="#instructor" class="instructor-link"><?php echo htmlspecialchars($course['instructor_name'] ?? 'Unknown Instructor'); ?></a>
                    </div>
                    <div class="hero-meta-extra">
                        <span class="meta-text"><i class="bi bi-clock-history"></i> Updated <?php echo date('m/Y', strtotime($course['updated_at'] ?? $course['created_at'])); ?></span>
                    </div>
                </div>

                <!-- Preview Video Card -->
                <div class="preview-video-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="video-thumbnail-wrapper">
                        <?php
                            $thumbRaw = $course['thumbnail'] ?? '';
                            $thumbUrl = (strpos($thumbRaw, 'http') === 0) ? $thumbRaw : url($thumbRaw);
                            if (empty($thumbRaw)) $thumbUrl = 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=1200&h=800&fit=crop';

                            $promoVideo = $course['promo_video'] ?? '';
                            // Convert relative video paths to full URLs (like we do for thumbnail)
                            if (!empty($promoVideo) && strpos($promoVideo, 'http') !== 0) {
                                $promoVideo = url($promoVideo);
                            }
                            $hasPromoVideo = !empty($promoVideo);
                        ?>
                        <img src="<?php echo htmlspecialchars($thumbUrl); ?>" alt="Course Preview" class="video-thumbnail" id="courseThumbnail">
                        <?php if ($hasPromoVideo): ?>
                        <div class="video-play-overlay" id="videoPlayOverlay">
                            <button class="video-play-btn" id="previewVideoBtn" data-promo-video="<?php echo htmlspecialchars($promoVideo); ?>">
                                <i class="bi bi-play-circle-fill"></i>
                            </button>
                            <span class="preview-label">Preview this course</span>
                        </div>
                        <div class="promo-video-container" id="promoVideoContainer" style="display: none;">
                            <!-- Video will be embedded here -->
                        </div>
                        <?php else: ?>
                        <div class="video-play-overlay">
                            <span class="preview-label" style="font-size: 1rem;">Course Thumbnail</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="course-main-content">
        <div class="content-container">
            <!-- Left Column: Main Content -->
            <div class="content-left-column">

                <!-- What You'll Learn -->
                <div class="what-learn-section fade-in-up" style="animation-delay: 0.1s">
                    <h2 class="content-section-title">What you'll learn</h2>
                    <div class="learn-outcomes-grid">
                        <?php if (!empty($objectives)): ?>
                            <?php foreach ($objectives as $objective): ?>
                            <div class="outcome-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span><?php echo htmlspecialchars($objective); ?></span>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default objectives if none in DB -->
                            <div class="outcome-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Comprehensive understanding of the subject matter</span>
                            </div>
                            <div class="outcome-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Practical skills you can apply immediately</span>
                            </div>
                            <div class="outcome-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Industry-relevant knowledge and best practices</span>
                            </div>
                            <div class="outcome-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Certificate of completion</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Course Content (Accordion) -->
                <div class="course-content-section fade-in-up" style="animation-delay: 0.2s">
                    <div class="content-header-row">
                        <h2 class="content-section-title">Course content</h2>
                        <?php if (count($sections) > 0): ?>
                        <button class="btn-expand-all" id="expandAllBtn">
                            <i class="bi bi-arrows-angle-expand"></i>
                            Expand all sections
                        </button>
                        <?php endif; ?>
                    </div>
                    <p class="content-summary"><?php echo count($sections); ?> sections • <?php echo $totalLectures; ?> lectures • <?php echo $durationFormatted; ?></p>

                    <div class="course-accordion" id="courseContentAccordion">
                        <?php if (!empty($sections)): ?>
                            <?php foreach ($sections as $index => $section): ?>
                            <div class="accordion-section">
                                <button class="accordion-section-header <?php echo $index > 0 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#section<?php echo $section['section_id']; ?>">
                                    <div class="section-left">
                                        <i class="bi bi-chevron-<?php echo $index === 0 ? 'down' : 'right'; ?> section-chevron"></i>
                                        <span class="section-title"><?php echo htmlspecialchars($section['title']); ?></span>
                                    </div>
                                    <div class="section-right">
                                        <span class="section-meta"><?php echo $section['lecture_count']; ?> lectures</span>
                                    </div>
                                </button>
                                <div id="section<?php echo $section['section_id']; ?>" class="accordion-section-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" data-bs-parent="#courseContentAccordion">
                                    <div class="accordion-section-body">
                                        <?php foreach ($section['videos'] as $video): ?>
                                        <div class="lecture-item">
                                            <div class="lecture-left">
                                                <i class="bi bi-play-circle lecture-icon"></i>
                                                <span class="lecture-title"><?php echo htmlspecialchars($video['title']); ?></span>
                                            </div>
                                            <div class="lecture-right">
                                                <?php if ($video['is_preview']): ?>
                                                <button class="btn-preview" data-video-url="<?php echo htmlspecialchars($video['video_url']); ?>">Preview</button>
                                                <?php endif; ?>
                                                <?php
                                                    $videoDuration = $video['duration_minutes'] ?? 0;
                                                    $vidMins = floor($videoDuration);
                                                    $vidSecs = round(($videoDuration - $vidMins) * 60);
                                                    $durationDisplay = sprintf("%02d:%02d", $vidMins, $vidSecs);
                                                ?>
                                                <span class="lecture-duration"><?php echo $durationDisplay; ?></span>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php if (empty($section['videos'])): ?>
                                        <div class="lecture-item">
                                            <div class="lecture-left">
                                                <i class="bi bi-hourglass lecture-icon"></i>
                                                <span class="lecture-title">Content coming soon</span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-curriculum">
                                <i class="bi bi-collection-play" style="font-size: 3rem; color: #94a3b8;"></i>
                                <p style="color: #64748b; margin-top: 1rem;">Curriculum is being prepared. Check back soon!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Requirements -->
                <div class="requirements-section fade-in-up" style="animation-delay: 0.3s">
                    <h2 class="content-section-title">Requirements</h2>
                    <ul class="requirements-list">
                        <?php if (!empty($requirements)): ?>
                            <?php foreach ($requirements as $req): ?>
                            <li><?php echo htmlspecialchars($req); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No prior experience required - we'll teach you everything you need to know</li>
                            <li>A computer with internet access</li>
                            <li>Enthusiasm and willingness to learn</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Description -->
                <div class="description-section fade-in-up" style="animation-delay: 0.4s">
                    <h2 class="content-section-title">Description</h2>
                    <div class="description-content" id="descriptionContent">
                        <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
                    </div>
                    
                    <div class="target-audience">
                        <h3 class="subsection-title">Who this course is for:</h3>
                        <ul class="audience-list">
                            <li>Professionals looking to upskill in this domain</li>
                            <li>Students and fresh graduates entering the field</li>
                            <li>Anyone interested in learning <?php echo htmlspecialchars($course['category_name'] ?? 'this subject'); ?></li>
                        </ul>
                    </div>
                </div>

                <!-- Instructor Section -->
                <div class="instructor-section fade-in-up" style="animation-delay: 0.5s" id="instructor">
                    <h2 class="content-section-title">Instructor</h2>
                    <div class="instructor-card">
                        <div class="instructor-header">
                            <img src="<?php echo $course['instructor_avatar'] ?: 'https://ui-avatars.com/api/?name=' . urlencode($course['instructor_name'] ?? 'Instructor') . '&size=100'; ?>" alt="<?php echo htmlspecialchars($course['instructor_name']); ?>" class="instructor-photo">
                            <div class="instructor-info">
                                <h3 class="instructor-name"><?php echo htmlspecialchars($course['instructor_name'] ?? 'Course Instructor'); ?></h3>
                                <p class="instructor-title">Expert in <?php echo htmlspecialchars($course['category_name'] ?? 'this field'); ?></p>
                            </div>
                        </div>

                        <div class="instructor-stats">
                            <div class="stat-item">
                                <i class="bi bi-star-fill"></i>
                                <span><?php echo $rating; ?> Instructor Rating</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-award-fill"></i>
                                <span><?php echo number_format($reviewCount); ?> Reviews</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-people-fill"></i>
                                <span><?php echo number_format($studentCount); ?> Students</span>
                            </div>
                        </div>

                        <?php if ($course['instructor_bio']): ?>
                        <div class="instructor-bio">
                            <p><?php echo nl2br(htmlspecialchars($course['instructor_bio'])); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sticky Purchase Box -->
            <div class="content-right-column">
                <div class="purchase-box-sticky" id="purchaseBox">
                    <!-- Pricing Header -->
                    <div class="purchase-header-gradient">
                        <span class="offer-badge">Special Offer</span>
                    </div>

                    <!-- Pricing -->
                    <div class="purchase-box-content">
                        <div class="price-section">
                            <div class="price-row">
                                <span class="price-current"><?php echo $price; ?></span>
                                <?php if ($originalPrice): ?>
                                <span class="price-original"><?php echo $originalPrice; ?></span>
                                <?php endif; ?>
                                <?php if ($discount): ?>
                                <span class="price-discount"><?php echo $discount; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="purchase-buttons">
                            <button class="btn-add-to-cart-purchase" onclick="addToCart(<?php echo $course_id; ?>)">
                                <i class="bi bi-cart-plus-fill"></i>
                                Add to cart
                            </button>
                            <a href="<?php echo url('pages/course-view.php?id=' . $course_id); ?>" class="btn-buy-now-purchase">
                                <i class="bi bi-play-fill"></i>
                                Start Learning
                            </a>
                        </div>

                        <!-- Money Back Guarantee -->
                        <div class="guarantee-banner">
                            <i class="bi bi-shield-fill-check"></i>
                            <span>30-Day Money-Back Guarantee</span>
                        </div>

                        <!-- Course Includes -->
                        <div class="course-includes-section">
                            <h4 class="includes-title">This course includes:</h4>
                            <ul class="includes-list">
                                <li>
                                    <i class="bi bi-play-btn-fill"></i>
                                    <span><?php echo $durationFormatted; ?> on-demand video</span>
                                </li>
                                <li>
                                    <i class="bi bi-collection-play-fill"></i>
                                    <span><?php echo $totalLectures; ?> lectures</span>
                                </li>
                                <li>
                                    <i class="bi bi-phone-fill"></i>
                                    <span>Access on mobile and desktop</span>
                                </li>
                                <li>
                                    <i class="bi bi-infinity"></i>
                                    <span>Full lifetime access</span>
                                </li>
                                <li>
                                    <i class="bi bi-trophy-fill"></i>
                                    <span>Certificate of completion</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Share and Wishlist -->
                        <div class="purchase-actions">
                            <button class="btn-share-purchase">
                                <i class="bi bi-share-fill"></i>
                                Share
                            </button>
                            <button class="btn-wishlist-purchase" onclick="addToWishlist(<?php echo $course_id; ?>)">
                                <i class="bi bi-heart"></i>
                                Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/course-detail.js']); ?>
