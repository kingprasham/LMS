<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Platform Analytics', ['css/dashboard.css', 'css/admin-dashboard.css', 'css/admin-analytics.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('analytics'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Platform Analytics</h1>
                <p class="dashboard-subtitle">Comprehensive insights and metrics</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Date Range Selector -->
        <div class="date-range-selector fade-in-up" style="animation-delay: 0.1s">
            <span class="date-range-label">Time Period:</span>
            <select class="date-range-select">
                <option>Last 7 days</option>
                <option selected>Last 30 days</option>
                <option>Last 90 days</option>
                <option>This Year</option>
                <option>All Time</option>
            </select>
            <button class="export-btn">
                <i class="bi bi-download"></i>
                Export Report
            </button>
        </div>

        <!-- KPI Overview -->
        <div class="stats-grid fade-in-up" style="animation-delay: 0.2s">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> 24%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value">$45,680</h3>
                    <p class="stat-label">Total Revenue</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> 18%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value">156</h3>
                    <p class="stat-label">New Signups</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> 12%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value">892</h3>
                    <p class="stat-label">Completions</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <span class="stat-trend neutral">
                        <i class="bi bi-dash"></i> 2%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value">12,450</h3>
                    <p class="stat-label">Learning Hours</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="section-header fade-in-up" style="animation-delay: 0.3s">
            <h2 class="section-title">Performance Trends</h2>
        </div>

        <div class="large-chart-container fade-in-up" style="animation-delay: 0.4s">
            <h3 class="chart-title">Daily Active Users</h3>
            <p class="chart-subtitle">User activity over the selected period</p>
            <div class="large-chart-wrapper">
                <canvas id="userActivityChart"></canvas>
            </div>
        </div>

        <div class="charts-grid fade-in-up" style="animation-delay: 0.5s">
            <div class="chart-container">
                <h3 class="chart-title">Revenue Trends</h3>
                <p class="chart-subtitle">Monthly revenue breakdown</p>
                <div class="chart-wrapper">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <h3 class="chart-title">Course Performance</h3>
                <p class="chart-subtitle">Top courses by enrollment</p>
                <div class="chart-wrapper">
                    <canvas id="coursePerformanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Detailed Tables -->
        <div class="section-header fade-in-up" style="animation-delay: 0.6s">
            <h2 class="section-title">Detailed Metrics</h2>
        </div>

        <div class="tables-grid fade-in-up" style="animation-delay: 0.7s">
            <div class="admin-table-container">
                <h3 class="chart-title" style="margin-bottom: 1rem;">Top Performing Courses</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Enrollments</th>
                            <th>Completion</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>AI Fundamentals</td>
                            <td>245</td>
                            <td>78%</td>
                            <td>$12,250</td>
                        </tr>
                        <tr>
                            <td>Web Development</td>
                            <td>189</td>
                            <td>65%</td>
                            <td>$9,450</td>
                        </tr>
                        <tr>
                            <td>Data Science</td>
                            <td>156</td>
                            <td>82%</td>
                            <td>$7,800</td>
                        </tr>
                        <tr>
                            <td>Machine Learning</td>
                            <td>203</td>
                            <td>71%</td>
                            <td>$10,150</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="admin-table-container">
                <h3 class="chart-title" style="margin-bottom: 1rem;">User Engagement</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Segment</th>
                            <th>Users</th>
                            <th>Avg. Time</th>
                            <th>Courses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Active Students</td>
                            <td>892</td>
                            <td>2.5 hrs/day</td>
                            <td>3.2 avg</td>
                        </tr>
                        <tr>
                            <td>New Students</td>
                            <td>156</td>
                            <td>1.8 hrs/day</td>
                            <td>1.5 avg</td>
                        </tr>
                        <tr>
                            <td>Inactive</td>
                            <td>124</td>
                            <td>0.3 hrs/day</td>
                            <td>0.8 avg</td>
                        </tr>
                        <tr>
                            <td>Employees</td>
                            <td>45</td>
                            <td>4.2 hrs/day</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Initialize charts
function initAnalyticsCharts() {
    // User Activity Chart
    const activityCtx = document.getElementById('userActivityChart');
    if (activityCtx) {
        new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Daily Active Users',
                    data: [320, 385, 420, 450],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 35, 0.9)',
                        titleColor: '#f8f9fa',
                        bodyColor: '#f8f9fa',
                        borderColor: '#4f46e5',
                        borderWidth: 1,
                        padding: 12
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.05)', drawBorder: false },
                        ticks: { color: '#6c757d', font: { family: 'Roboto' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6c757d', font: { family: 'Roboto' } }
                    }
                }
            }
        });
    }

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart');
    if (revenueCtx) {
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue',
                    data: [8500, 9200, 10500, 11200, 12800, 14500],
                    backgroundColor: 'rgba(79, 70, 229, 0.8)',
                    borderColor: '#4f46e5',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 35, 0.9)',
                        titleColor: '#f8f9fa',
                        bodyColor: '#f8f9fa',
                        borderColor: '#4f46e5',
                        borderWidth: 1,
                        padding: 12
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.05)', drawBorder: false },
                        ticks: { color: '#6c757d', font: { family: 'Roboto' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6c757d', font: { family: 'Roboto' } }
                    }
                }
            }
        });
    }

    // Course Performance Chart
    const performanceCtx = document.getElementById('coursePerformanceChart');
    if (performanceCtx) {
        new Chart(performanceCtx, {
            type: 'doughnut',
            data: {
                labels: ['AI Fundamentals', 'Web Development', 'Data Science', 'Machine Learning', 'Others'],
                datasets: [{
                    data: [245, 189, 156, 203, 298],
                    backgroundColor: [
                        'rgba(79, 70, 229, 0.9)',
                        'rgba(99, 102, 241, 0.9)',
                        'rgba(139, 92, 246, 0.9)',
                        'rgba(168, 85, 247, 0.9)',
                        'rgba(192, 132, 252, 0.9)'
                    ],
                    borderColor: '#0a0a23',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#f8f9fa',
                            font: { family: 'Roboto', size: 11 },
                            padding: 12
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 35, 0.9)',
                        titleColor: '#f8f9fa',
                        bodyColor: '#f8f9fa',
                        borderColor: '#4f46e5',
                        borderWidth: 1,
                        padding: 12
                    }
                }
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initAnalyticsCharts();

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
});
</script>
