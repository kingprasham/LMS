<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('Instructor Dashboard', ['css/dashboard.css', 'css/instructor-dashboard.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('dashboard'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Welcome back, John!</h1>
                <p class="dashboard-subtitle">Here's what's happening with your courses today.</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Stats Grid -->
        <div class="instructor-stats-grid fade-in-up" style="animation-delay: 0.1s">
            <div class="instructor-stat-card">
                <div class="stat-icon-wrapper revenue">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stat-content">
                    <p>Total Revenue</p>
                    <h3>$12,450</h3>
                    <div class="stat-trend trend-up">
                        <i class="bi bi-arrow-up-short"></i> 12% vs last month
                    </div>
                </div>
            </div>

            <div class="instructor-stat-card">
                <div class="stat-icon-wrapper students">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-content">
                    <p>Total Students</p>
                    <h3>1,245</h3>
                    <div class="stat-trend trend-up">
                        <i class="bi bi-arrow-up-short"></i> 5% vs last month
                    </div>
                </div>
            </div>

            <div class="instructor-stat-card">
                <div class="stat-icon-wrapper rating">
                    <i class="bi bi-star"></i>
                </div>
                <div class="stat-content">
                    <p>Average Rating</p>
                    <h3>4.8</h3>
                    <div class="stat-trend trend-up">
                        <i class="bi bi-arrow-up-short"></i> 0.2 vs last month
                    </div>
                </div>
            </div>

            <div class="instructor-stat-card">
                <div class="stat-icon-wrapper courses">
                    <i class="bi bi-journal-richtext"></i>
                </div>
                <div class="stat-content">
                    <p>Active Courses</p>
                    <h3>8</h3>
                    <div class="stat-trend trend-up">
                        <i class="bi bi-plus"></i> 1 new this month
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Activity -->
        <div class="charts-grid fade-in-up" style="animation-delay: 0.2s">
            <!-- Revenue Chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Revenue Analytics</h3>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>This Year</option>
                        <option>Last Year</option>
                    </select>
                </div>
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Recent Activity</h3>
                    <a href="<?php echo url('pages/instructor/students.php'); ?>" class="btn-link">View All</a>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <img src="https://ui-avatars.com/api/?name=Sarah+J&background=random" class="activity-avatar" alt="User">
                        <div class="activity-info">
                            <h4>Sarah J. enrolled in Web Dev</h4>
                            <p>New student enrollment</p>
                            <span class="activity-time">2 mins ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <img src="https://ui-avatars.com/api/?name=Mike+T&background=random" class="activity-avatar" alt="User">
                        <div class="activity-info">
                            <h4>Mike T. left a review</h4>
                            <p>5 stars on "React Masterclass"</p>
                            <span class="activity-time">1 hour ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <img src="https://ui-avatars.com/api/?name=Emily+R&background=random" class="activity-avatar" alt="User">
                        <div class="activity-info">
                            <h4>Emily R. asked a question</h4>
                            <p>In "Advanced CSS Layouts"</p>
                            <span class="activity-time">3 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <img src="https://ui-avatars.com/api/?name=David+L&background=random" class="activity-avatar" alt="User">
                        <div class="activity-info">
                            <h4>David L. submitted assignment</h4>
                            <p>Project: Portfolio Website</p>
                            <span class="activity-time">5 hours ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="fade-in-up" style="animation-delay: 0.3s">
            <h3 class="section-title mb-3">Quick Actions</h3>
            <div class="quick-actions-grid">
                <a href="<?php echo url('pages/admin/add-course.php'); ?>" class="quick-action-card">
                    <div class="action-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <span class="action-label">Create New Course</span>
                </a>
                <a href="<?php echo url('pages/instructor/students.php'); ?>" class="quick-action-card">
                    <div class="action-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <span class="action-label">Send Announcement</span>
                </a>
                <a href="<?php echo url('pages/instructor/qna.php'); ?>" class="quick-action-card">
                    <div class="action-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <span class="action-label">Reply to Q&A</span>
                </a>
                <a href="<?php echo url('pages/instructor/assignments.php'); ?>" class="quick-action-card">
                    <div class="action-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <span class="action-label">Grade Assignments</span>
                </a>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo url('js/instructor-charts.js'); ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            }
        });
    }
});
</script>
