<?php
include('../../config.php');
include('../../includes/db_connect.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Admin Dashboard', ['css/dashboard.css', 'css/admin-dashboard.css']);
renderNavbar();

// ============================================
// FETCH REAL DATA FROM DATABASE
// ============================================

// Helper function for time ago
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;
    
    if ($diff < 60) return 'Just now';
    if ($diff < 3600) return floor($diff / 60) . ' min ago';
    if ($diff < 86400) return floor($diff / 3600) . ' hours ago';
    if ($diff < 604800) return floor($diff / 86400) . ' days ago';
    
    return date('M d, Y', $time);
}

// Stats
$stats = [];

// Total Students
$result = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'student'");
$stats['total_students'] = $result ? $result->fetch_assoc()['count'] : 0;

// Total Employees
$result = $conn->query("SELECT COUNT(*) as count FROM users WHERE role IN ('instructor', 'admin')");
$stats['total_employees'] = $result ? $result->fetch_assoc()['count'] : 0;

// Total Courses
$result = $conn->query("SELECT COUNT(*) as count FROM courses WHERE status = 'published'");
$stats['total_courses'] = $result ? $result->fetch_assoc()['count'] : 0;

// Active Users Today (from activity log)
$result = $conn->query("SELECT COUNT(DISTINCT user_id) as count FROM activity_log WHERE DATE(created_at) = CURDATE()");
$stats['active_users_today'] = $result ? $result->fetch_assoc()['count'] : 0;

// Recent Users
$recent_users = [];
$result = $conn->query("SELECT user_id, full_name, email, role, created_at FROM users ORDER BY created_at DESC LIMIT 5");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $recent_users[] = [
            'name' => $row['full_name'],
            'email' => $row['email'],
            'role' => ucfirst($row['role']),
            'date' => timeAgo($row['created_at'])
        ];
    }
}

// Recent Activity
$recent_activity = [];
$result = $conn->query("
    SELECT a.*, u.full_name 
    FROM activity_log a
    LEFT JOIN users u ON a.user_id = u.user_id
    ORDER BY a.created_at DESC 
    LIMIT 5
");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $details = json_decode($row['details'], true);
        $recent_activity[] = [
            'action' => ucwords(str_replace('_', ' ', $row['action'])),
            'user' => $row['full_name'] ?? 'System',
            'entity' => $row['entity_type'] ?? '-',
            'time' => timeAgo($row['created_at'])
        ];
    }
}

// Chart Data - Last 7 days enrollments
$enrollment_chart = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $result = $conn->query("SELECT COUNT(*) as count FROM enrollments WHERE DATE(enrolled_at) = '$date'");
    $count = $result ? $result->fetch_assoc()['count'] : 0;
    $enrollment_chart[] = [
        'date' => date('M d', strtotime($date)),
        'count' => (int)$count
    ];
}

// Chart Data - Last 7 days user registrations
$user_chart = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE DATE(created_at) = '$date'");
    $count = $result ? $result->fetch_assoc()['count'] : 0;
    $user_chart[] = [
        'date' => date('M d', strtotime($date)),
        'count' => (int)$count
    ];
}

// Get admin name from session
$admin_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Admin';
?>

<div class="dashboard-wrapper">
    <!-- Admin Sidebar -->
    <?php renderAdminSidebar('dashboard'); ?>

    <!-- Main Content -->
    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Welcome back, <span class="user-name"><?php echo htmlspecialchars($admin_name); ?></span>! 👋</h1>
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
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> Live
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
                        <i class="bi bi-arrow-up-short"></i> Live
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
                        <i class="bi bi-play-circle-fill"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> Live
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="<?php echo $stats['total_courses']; ?>">0</h3>
                    <p class="stat-label">Published Courses</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-activity"></i>
                    </div>
                    <span class="stat-trend neutral">
                        <i class="bi bi-clock"></i> Today
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="<?php echo $stats['active_users_today']; ?>">0</h3>
                    <p class="stat-label">Active Today</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="section-header fade-in-up" style="animation-delay: 0.2s">
            <div>
                <h2 class="section-title">Platform Analytics</h2>
                <p class="section-desc">User growth and enrollment trends (Last 7 days)</p>
            </div>
        </div>

        <div class="charts-grid fade-in-up" style="animation-delay: 0.3s">
            <div class="chart-container">
                <h3 class="chart-title">User Registrations</h3>
                <p class="chart-subtitle">New users per day</p>
                <div class="chart-wrapper">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <h3 class="chart-title">Course Enrollments</h3>
                <p class="chart-subtitle">Enrollments per day</p>
                <div class="chart-wrapper">
                    <canvas id="courseEnrollmentChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tables Section -->
        <div class="section-header fade-in-up" style="animation-delay: 0.4s">
            <div>
                <h2 class="section-title">Recent Activity</h2>
                <p class="section-desc">Latest user registrations and platform activity</p>
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
                        <?php if (empty($recent_users)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: #94a3b8;">No users yet</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($recent_users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <span class="badge-role badge-<?php echo strtolower($user['role']); ?>">
                                    <?php echo $user['role']; ?>
                                </span>
                            </td>
                            <td><?php echo $user['date']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Recent Activity -->
            <div class="admin-table-container">
                <h3 class="chart-title" style="margin-bottom: 1rem;">Recent Platform Activity</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent_activity)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: #94a3b8;">No activity yet</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($recent_activity as $activity): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($activity['action']); ?></td>
                            <td><?php echo htmlspecialchars($activity['user']); ?></td>
                            <td><span class="badge-type"><?php echo ucfirst($activity['entity']); ?></span></td>
                            <td><?php echo $activity['time']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
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

<script>
// Chart data from PHP
const userChartData = <?php echo json_encode($user_chart); ?>;
const enrollmentChartData = <?php echo json_encode($enrollment_chart); ?>;

document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        }
    });

    // Animate stat numbers
    document.querySelectorAll('.stat-value[data-target]').forEach(el => {
        const target = parseInt(el.dataset.target);
        animateValue(el, 0, target, 1500);
    });

    // User Growth Chart
    const userCtx = document.getElementById('userGrowthChart');
    if (userCtx) {
        new Chart(userCtx, {
            type: 'line',
            data: {
                labels: userChartData.map(d => d.date),
                datasets: [{
                    label: 'New Users',
                    data: userChartData.map(d => d.count),
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#4f46e5'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    }

    // Enrollment Chart
    const enrollCtx = document.getElementById('courseEnrollmentChart');
    if (enrollCtx) {
        new Chart(enrollCtx, {
            type: 'bar',
            data: {
                labels: enrollmentChartData.map(d => d.date),
                datasets: [{
                    label: 'Enrollments',
                    data: enrollmentChartData.map(d => d.count),
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: '#10b981',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    }
});

// Number animation function
function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const easeOutQuad = 1 - (1 - progress) * (1 - progress);
        element.textContent = Math.floor(easeOutQuad * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}
</script>
