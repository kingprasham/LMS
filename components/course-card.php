<?php
function renderCourseCard($course, $enrolled = true) {
    // Default values to prevent errors if keys are missing
    $courseId = $course['id'] ?? 1;
    $title = $course['title'] ?? 'Untitled Course';
    $image = $course['image'] ?? 'https://via.placeholder.com/600x400';
    $category = $course['category'] ?? 'General';
    $categoryColor = $course['category_color'] ?? 'blue';
    $instructor = $course['instructor'] ?? 'Unknown Instructor';
    $progress = $course['progress'] ?? 0;
    $timeLeft = $course['time_left'] ?? '0m left';
    $videoId = $course['video_id'] ?? '';

    // Calculate progress bar width
    $progressStyle = "width: {$progress}%";

    // Determine which page to link to based on enrollment status
    $courseLink = $enrolled
        ? url('pages/course-view.php?id=' . $courseId)
        : url('pages/course-detail.php?id=' . $courseId);
?>
    <div class="course-card-modern">
        <div class="course-thumbnail">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>" class="course-img">
            <a href="<?php echo $courseLink; ?>" class="play-overlay">
                <i class="bi bi-play-circle-fill"></i>
            </a>
        </div>
        <div class="course-body">
            <span class="course-category-tag <?php echo htmlspecialchars($categoryColor); ?>"><?php echo htmlspecialchars($category); ?></span>
            <h3 class="course-title">
                <a href="<?php echo $courseLink; ?>" class="text-decoration-none text-dark">
                    <?php echo htmlspecialchars($title); ?>
                </a>
            </h3>
            <div class="course-instructor">
                <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($instructor); ?>
            </div>

            <?php if ($enrolled): ?>
            <div class="progress-section">
                <div class="progress-info">
                    <span><?php echo $progress; ?>%</span>
                    <span><?php echo htmlspecialchars($timeLeft); ?></span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="<?php echo $progressStyle; ?>"></div>
                </div>
            </div>
            <?php endif; ?>

            <div class="course-footer">
                <a href="<?php echo $courseLink; ?>" class="btn-continue text-decoration-none text-center">
                    <?php echo $enrolled ? 'Continue' : 'View Details'; ?> <i class="bi bi-<?php echo $enrolled ? 'play-fill' : 'arrow-right'; ?>"></i>
                </a>
            </div>
        </div>
    </div>
<?php
}
?>
