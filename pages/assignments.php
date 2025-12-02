<?php
include('../config.php');
include('../includes/data-functions.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('My Assignments', ['css/dashboard.css', 'css/my-courses.css']);
renderNavbar();

// Get courses with assignment statistics using centralized function
$courses = getCoursesWithAssignmentStats();
?>

<div class="my-courses-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('assignments'); ?>

    <!-- Main Content -->
    <main class="my-courses-main" id="myCoursesMain">
        <!-- Header -->
        <div class="courses-header fade-in-up">
            <div>
                <h1 class="page-title">My Assignments</h1>
                <p class="page-subtitle">View and submit assignments from your enrolled courses</p>
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
                    <i class="bi bi-check-circle-fill"></i> Submitted
                    <span class="tab-count">10</span>
                </button>
                <button class="tab-btn">
                    <i class="bi bi-exclamation-triangle-fill"></i> Due Soon
                    <span class="tab-count">2</span>
                </button>
            </div>

            <div class="search-sort-container">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search courses...">
                </div>
                <select class="sort-select">
                    <option>All Courses</option>
                    <option>Due Date (Earliest)</option>
                    <option>Due Date (Latest)</option>
                    <option>Highest Grade</option>
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
                        <a href="<?php echo url('pages/assignment.php?course=' . $course['id']); ?>" class="btn-play"><i class="bi bi-file-earmark-code-fill"></i></a>
                    </div>
                    <?php if ($course['due_soon'] > 0): ?>
                    <div class="course-status-badge" style="background: #ef4444">
                        <span class="status-dot"></span> <?php echo $course['due_soon']; ?> Due Soon
                    </div>
                    <?php elseif ($course['pending'] > 0): ?>
                    <div class="course-status-badge" style="background: #f59e0b">
                        <span class="status-dot"></span> <?php echo $course['pending']; ?> Pending
                    </div>
                    <?php else: ?>
                    <div class="course-status-badge" style="background: #10b981">
                        <span class="status-dot"></span> All Submitted
                    </div>
                    <?php endif; ?>
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

                    <div class="assignment-stats">
                        <div class="stat-item">
                            <div class="stat-value"><?php echo $course['total_assignments']; ?></div>
                            <div class="stat-label">Total</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo $course['submitted']; ?></div>
                            <div class="stat-label">Submitted</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo $course['pending']; ?></div>
                            <div class="stat-label">Pending</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo $course['average_grade']; ?>%</div>
                            <div class="stat-label">Avg Grade</div>
                        </div>
                    </div>

                    <div class="course-footer">
                        <div class="course-time">
                            <i class="bi bi-<?php echo $course['due_soon'] > 0 ? 'exclamation-triangle' : 'clock'; ?>"></i>
                            <?php echo $course['pending']; ?> assignment<?php echo $course['pending'] != 1 ? 's' : ''; ?> pending
                        </div>
                        <a href="<?php echo url('pages/assignment.php?course=' . $course['id']); ?>" class="btn-continue-small">View All</a>
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
.assignment-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
    padding: 1rem 0;
    border-top: 1px solid var(--border-color);
    border-bottom: 1px solid var(--border-color);
    margin: 1rem 0;
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
</style>
