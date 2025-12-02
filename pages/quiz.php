<?php
include('../config.php');
include('../includes/data-functions.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

// Get course ID from URL, default to 1
$course_id = isset($_GET['course']) ? (int)$_GET['course'] : 1;
$quiz_id = isset($_GET['quiz']) ? (int)$_GET['quiz'] : null;

// Get course data and quizzes using centralized functions
$current_course = getCourseById($course_id);
$quizzes = getCourseQuizzes($course_id);

// Fallback if course not found
if (!$current_course) {
    $current_course = getCourseById(1);
    $course_id = 1;
    $quizzes = getCourseQuizzes(1);
}

renderHead($current_course['title'] . ' - Quizzes', ['css/dashboard.css', 'css/my-courses.css']);
renderNavbar();
?>

<div class="my-courses-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('quizzes'); ?>

    <!-- Main Content -->
    <main class="my-courses-main" id="myCoursesMain">
        <!-- Header -->
        <div class="courses-header fade-in-up">
            <div>
                <h1 class="page-title"><?php echo $current_course['title']; ?></h1>
                <p class="page-subtitle">
                    <a href="<?php echo url('pages/quizzes.php'); ?>" class="text-decoration-none" style="color: var(--primary);"><i class="bi bi-arrow-left"></i> Back to All Courses</a>
                    &nbsp;&nbsp;•&nbsp;&nbsp; Instructor: <?php echo $current_course['instructor']; ?>
                </p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Quizzes List -->
        <div class="courses-grid fade-in-up" style="animation-delay: 0.1s">
            <?php foreach ($quizzes as $quiz): ?>
            <!-- Quiz Card -->
            <div class="course-card <?php echo $quiz['status'] === 'locked' ? 'locked' : ''; ?>">
                <div class="course-content" style="padding: 2rem;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div style="flex: 1;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <?php if ($quiz['status'] === 'completed'): ?>
                                    <span class="badge" style="background: var(--success); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                        <i class="bi bi-check-circle-fill"></i> Completed
                                    </span>
                                    <span class="badge" style="background: var(--primary); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                        Score: <?php echo $quiz['score']; ?>%
                                    </span>
                                <?php elseif ($quiz['status'] === 'pending'): ?>
                                    <span class="badge" style="background: var(--warning); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                        <i class="bi bi-clock-fill"></i> Available
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background: var(--text-muted); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                        <i class="bi bi-lock-fill"></i> Locked
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h3 class="course-title mb-2"><?php echo $quiz['title']; ?></h3>
                        </div>
                        <div style="font-size: 2.5rem; color: var(--primary); opacity: 0.2;">
                            <i class="bi bi-file-text-fill"></i>
                        </div>
                    </div>

                    <div class="quiz-meta" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; padding: 1rem 0; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); margin: 1rem 0;">
                        <div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em;">Questions</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--text-main);"><?php echo $quiz['questions']; ?></div>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em;">Duration</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--text-main);"><?php echo $quiz['duration']; ?> min</div>
                        </div>
                    </div>

                    <div class="course-footer" style="margin-top: 1.5rem;">
                        <?php if ($quiz['status'] === 'completed'): ?>
                            <a href="<?php echo url('pages/quiz.php?course=' . $course_id . '&quiz=' . $quiz['id']); ?>" class="btn-continue-small" style="width: 100%;">
                                <i class="bi bi-eye-fill"></i> Review Quiz
                            </a>
                        <?php elseif ($quiz['status'] === 'pending'): ?>
                            <a href="<?php echo url('pages/quiz.php?course=' . $course_id . '&quiz=' . $quiz['id']); ?>" class="btn-continue-small" style="width: 100%; background: var(--warning);">
                                <i class="bi bi-play-fill"></i> Start Quiz
                            </a>
                        <?php else: ?>
                            <button class="btn-continue-small" style="width: 100%; background: var(--text-muted); cursor: not-allowed;" disabled>
                                <i class="bi bi-lock-fill"></i> Complete Previous Quizzes
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($quizzes)): ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 4rem; color: var(--text-muted);"></i>
            <h3 class="mt-3">No Quizzes Available</h3>
            <p class="text-secondary">There are no quizzes for this course yet.</p>
        </div>
        <?php endif; ?>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        }
    });
});
</script>

<style>
.course-card.locked {
    opacity: 0.6;
    pointer-events: none;
}
</style>
