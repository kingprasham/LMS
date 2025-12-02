<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Admin Dashboard', ['css/dashboard.css', 'css/admin-dashboard.css']);
renderNavbar();

// Simulated static data for admin dashboard
$stats = [
    'total_students' => 1247,
    'total_employees' => 45,
    'total_courses' => 89,
    'active_users_today' => 342
];

$recent_users = [
    ['name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'Student', 'date' => '2 hours ago'],
    ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'Student', 'date' => '5 hours ago'],
    ['name' => 'Mike Johnson', 'email' => 'mike@example.com', 'role' => 'Employee', 'date' => '1 day ago'],
    ['name' => 'Sarah Williams', 'email' => 'sarah@example.com', 'role' => 'Student', 'date' => '1 day ago'],
    ['name' => 'Tom Brown', 'email' => 'tom@example.com', 'role' => 'Student', 'date' => '2 days ago']
];

$recent_activity = [
    ['course' => 'AI Fundamentals', 'action' => 'New Enrollment', 'count' => 12, 'time' => '1 hour ago'],
    ['course' => 'Web Development', 'action' => 'Course Completed', 'count' => 5, 'time' => '3 hours ago'],
    ['course' => 'Data Science', 'action' => 'New Enrollment', 'count' => 8, 'time' => '5 hours ago'],
    ['course' => 'Machine Learning', 'action' => 'Quiz Submitted', 'count' => 15, 'time' => '6 hours ago'],
    ['course' => 'Cloud Computing', 'action' => 'New Enrollment', 'count' => 6, 'time' => '1 day ago']
];
?>

<div class="dashboard-wrapper">
    <!-- Admin Sidebar -->
    <?php renderAdminSidebar('dashboard'); ?>

    <!-- Main Content -->
    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Welcome back, <span class="user-name">Admin</span>! 👋</h1>
                <p class="dashboard-subtitle">Here's what's happening with your platform today</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Stats Row -->
        <div class="stats-grid fade-in-up" style="animation-delay: 0.1s">
            <div class="stat-card admin-highlight">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> 18%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="<?php echo $stats['total_students']; ?>">0</h3>
                    <p class="stat-label">Total Students</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> 5%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="<?php echo $stats['total_employees']; ?>">0</h3>
                    <p class="stat-label">Total Employees</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-camera-video-fill"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> 12%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="<?php echo $stats['total_courses']; ?>">0</h3>
                    <p class="stat-label">Total Courses</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <span class="stat-trend neutral">
                        <i class="bi bi-dash"></i> Today
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="<?php echo $stats['active_users_today']; ?>">0</h3>
                    <p class="stat-label">Active Users</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="section-header fade-in-up" style="animation-delay: 0.2s">
            <div>
                <h2 class="section-title">Platform Analytics</h2>
                <p class="section-desc">User growth and course enrollment trends</p>
            </div>
        </div>

        <div class="charts-grid fade-in-up" style="animation-delay: 0.3s">
            <div class="chart-container">
                <h3 class="chart-title">User Growth</h3>
                <p class="chart-subtitle">Monthly registration trends</p>
                <div class="chart-wrapper">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <h3 class="chart-title">Course Enrollments</h3>
                <p class="chart-subtitle">Top performing courses</p>
                <div class="chart-wrapper">
                    <canvas id="courseEnrollmentChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tables Section -->
        <div class="section-header fade-in-up" style="animation-delay: 0.4s">
            <div>
                <h2 class="section-title">Recent Activity</h2>
                <p class="section-desc">Latest user registrations and course activity</p>
            </div>
        </div>

        <div class="tables-grid fade-in-up" style="animation-delay: 0.5s">
            <!-- Recent Users -->
            <div class="admin-table-container">
                <h3 class="chart-title" style="margin-bottom: 1rem;">Recent User Registrations</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_users as $user): ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <span class="badge-role badge-<?php echo strtolower($user['role']); ?>">
                                    <?php echo $user['role']; ?>
                                </span>
                            </td>
                            <td><?php echo $user['date']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Recent Course Activity -->
            <div class="admin-table-container">
                <h3 class="chart-title" style="margin-bottom: 1rem;">Recent Course Activity</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Action</th>
                            <th>Count</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_activity as $activity): ?>
                        <tr>
                            <td><?php echo $activity['course']; ?></td>
                            <td><?php echo $activity['action']; ?></td>
                            <td><strong><?php echo $activity['count']; ?></strong></td>
                            <td><?php echo $activity['time']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="fade-in-up" style="animation-delay: 0.6s">
            <div class="quick-actions-card">
                <h3 class="quick-actions-title">Quick Actions</h3>
                <div class="quick-actions-grid">
                    <a href="<?php echo url('pages/admin/add-user.php?role=student'); ?>" class="quick-action-btn">
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Add Student</span>
                    </a>
                    <a href="<?php echo url('pages/admin/add-user.php?role=employee'); ?>" class="quick-action-btn">
                        <i class="bi bi-people-fill"></i>
                        <span>Add Employee</span>
                    </a>
                    <a href="<?php echo url('pages/admin/add-course.php'); ?>" class="quick-action-btn">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Add Course</span>
                    </a>
                    <a href="<?php echo url('pages/admin/reports.php'); ?>" class="quick-action-btn">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        <span>Generate Report</span>
                    </a>
                </div>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="<?php echo asset('js/admin-charts.js'); ?>"></script>

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
