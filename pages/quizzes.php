<?php
include('../config.php');
include('../includes/data-functions.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('My Quizzes', ['css/dashboard.css', 'css/my-courses.css']);
renderNavbar();

// Get courses with quiz statistics using centralized function
$courses = getCoursesWithQuizStats();
?>

<div class="my-courses-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('quizzes'); ?>

    <!-- Main Content -->
    <main class="my-courses-main" id="myCoursesMain">
        <!-- Header -->
        <div class="courses-header fade-in-up">
            <div>
                <h1 class="page-title">My Quizzes</h1>
                <p class="page-subtitle">View and take quizzes from your enrolled courses</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Filters -->
        <div class="courses-filters fade-in-up" style="animation-delay: 0.1s">
            <div class="tabs-container">
                <button class="tab-btn active">
                    <i class="bi bi-grid-fill"></i> All Courses
                    <span class="tab-count"><?php echo count($courses); ?></span>
                </button>
                <button class="tab-btn">
                    <i class="bi bi-clock-fill"></i> Pending
                    <span class="tab-count">5</span>
                </button>
                <button class="tab-btn">
                    <i class="bi bi-check-circle-fill"></i> Completed
                    <span class="tab-count">10</span>
                </button>
            </div>

            <div class="search-sort-container">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search courses...">
                </div>
                <select class="sort-select">
                    <option>All Courses</option>
                    <option>Highest Score</option>
                    <option>Lowest Score</option>
                    <option>Most Pending</option>
                </select>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="courses-grid fade-in-up" style="animation-delay: 0.2s">
            <?php foreach ($courses as $course): ?>
            <!-- Course Card -->
            <div class="course-card">
                <div class="course-thumbnail">
                    <img src="<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/quiz.php?course=' . $course['id']); ?>" class="btn-play"><i class="bi bi-file-text-fill"></i></a>
                    </div>
                    <div class="course-status-badge" style="background: <?php echo $course['pending_quizzes'] > 0 ? '#f59e0b' : '#10b981'; ?>">
                        <span class="status-dot"></span> <?php echo $course['pending_quizzes'] > 0 ? $course['pending_quizzes'] . ' Pending' : 'All Complete'; ?>
                    </div>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span class="course-category"><?php echo $course['category']; ?></span>
                        <div class="course-actions">
                            <button class="action-btn"><i class="bi bi-three-dots-vertical"></i></button>
                        </div>
                    </div>
                    <h3 class="course-title"><?php echo $course['title']; ?></h3>
                    <div class="course-instructor">
                        <i class="bi bi-person-circle"></i> <?php echo $course['instructor']; ?>
                    </div>

                    <div class="quiz-stats">
                        <div class="stat-item">
                            <div class="stat-value"><?php echo $course['total_quizzes']; ?></div>
                            <div class="stat-label">Total Quizzes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo $course['completed_quizzes']; ?></div>
                            <div class="stat-label">Completed</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo $course['average_score']; ?>%</div>
                            <div class="stat-label">Avg Score</div>
                        </div>
                    </div>

                    <div class="course-footer">
                        <div class="course-time">
                            <i class="bi bi-clock"></i> <?php echo $course['pending_quizzes']; ?> quiz<?php echo $course['pending_quizzes'] != 1 ? 'zes' : ''; ?> pending
                        </div>
                        <a href="<?php echo url('pages/quiz.php?course=' . $course['id']); ?>" class="btn-continue-small">View Quizzes</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
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
.quiz-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    padding: 1rem 0;
    border-top: 1px solid var(--border-color);
    border-bottom: 1px solid var(--border-color);
    margin: 1rem 0;
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
</style>
