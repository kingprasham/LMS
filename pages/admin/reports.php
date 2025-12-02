<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Reports', ['css/dashboard.css', 'css/admin-users.css', 'css/admin-analytics.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('reports'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Generate Reports</h1>
                <p class="dashboard-subtitle">Create custom reports and export data</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Report Filter Panel -->
        <div class="report-filter-panel fade-in-up" style="animation-delay: 0.1s">
            <div class="config-header">
                <h3 class="form-section-title">Report Configuration</h3>
                <p class="config-subtitle">Customize your report parameters</p>
            </div>
            
            <div class="filter-grid">
                <div class="form-group">
                    <label class="form-label"><i class="bi bi-file-text me-2"></i>Report Type</label>
                    <select class="form-select" id="reportType">
                        <option value="user-activity">User Activity Report</option>
                        <option value="revenue">Revenue Report</option>
                        <option value="course-performance">Course Performance</option>
                        <option value="enrollment">Enrollment Statistics</option>
                        <option value="completion">Completion Rates</option>
                        <option value="custom">Custom Report</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label"><i class="bi bi-calendar-range me-2"></i>Date Range</label>
                    <select class="form-select">
                        <option>Last 7 days</option>
                        <option selected>Last 30 days</option>
                        <option>Last 90 days</option>
                        <option>This Quarter</option>
                        <option>This Year</option>
                        <option>Custom Range</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="bi bi-people me-2"></i>User Role Filter</label>
                    <select class="form-select">
                        <option selected>All Users</option>
                        <option>Students Only</option>
                        <option>Employees Only</option>
                        <option>Active Users</option>
                        <option>Inactive Users</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="bi bi-grid me-2"></i>Course Category</label>
                    <select class="form-select">
                        <option selected>All Categories</option>
                        <option>Artificial Intelligence</option>
                        <option>Web Development</option>
                        <option>Data Science</option>
                        <option>Machine Learning</option>
                        <option>Cloud Computing</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="bi bi-download me-2"></i>Export Format</label>
                    <select class="form-select">
                        <option>PDF Document</option>
                        <option>Excel (XLSX)</option>
                        <option>CSV File</option>
                        <option>JSON Data</option>
                    </select>
                </div>
            </div>

            <div class="form-actions" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.05);">
                <button class="btn-secondary">
                    <i class="bi bi-arrow-clockwise" style="margin-right: 0.5rem;"></i>
                    Reset Filters
                </button>
                <button class="btn-primary" onclick="generateReport()">
                    <i class="bi bi-file-earmark-bar-graph" style="margin-right: 0.5rem;"></i>
                    Generate Preview
                </button>
            </div>
        </div>

        <!-- Report Preview -->
        <div class="section-header fade-in-up" style="animation-delay: 0.2s">
            <h2 class="section-title">Report Preview</h2>
        </div>

        <div class="report-preview fade-in-up" style="animation-delay: 0.3s">
            <div class="report-preview-header">
                <h2 class="report-preview-title">User Activity Report</h2>
                <div class="report-preview-meta">
                    Generated on: <?php echo date('F d, Y'); ?> | Period: Last 30 days
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="stats-grid" style="margin-bottom: 2rem;">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-value">1,247</h3>
                        <p class="stat-label">Total Users</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-value">892</h3>
                        <p class="stat-label">Active Users</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-value">12,450</h3>
                        <p class="stat-label">Total Learning Hours</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-value">426</h3>
                        <p class="stat-label">Certificates Issued</p>
                    </div>
                </div>
            </div>

            <!-- Activity Chart -->
            <div class="chart-container mb-4 p-4 bg-white rounded-3 border border-light">
                <h3 class="chart-title mb-3">Activity Trends</h3>
                <canvas id="activityChart" height="300"></canvas>
            </div>

            <!-- Detailed Data Table -->
            <div class="admin-table-container">
                <h3 class="chart-title" style="margin-bottom: 1rem;">Detailed Activity Breakdown</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Metric</th>
                            <th>This Period</th>
                            <th>Previous Period</th>
                            <th>Change</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>New Registrations</strong></td>
                            <td>156</td>
                            <td>132</td>
                            <td style="color: #22c55e;">+24</td>
                            <td style="color: #22c55e;">+18.2%</td>
                        </tr>
                        <tr>
                            <td><strong>Course Enrollments</strong></td>
                            <td>445</td>
                            <td>398</td>
                            <td style="color: #22c55e;">+47</td>
                            <td style="color: #22c55e;">+11.8%</td>
                        </tr>
                        <tr>
                            <td><strong>Course Completions</strong></td>
                            <td>892</td>
                            <td>798</td>
                            <td style="color: #22c55e;">+94</td>
                            <td style="color: #22c55e;">+11.8%</td>
                        </tr>
                        <tr>
                            <td><strong>Avg. Session Duration</strong></td>
                            <td>2.5 hrs</td>
                            <td>2.3 hrs</td>
                            <td style="color: #22c55e;">+0.2 hrs</td>
                            <td style="color: #22c55e;">+8.7%</td>
                        </tr>
                        <tr>
                            <td><strong>User Retention Rate</strong></td>
                            <td>78%</td>
                            <td>75%</td>
                            <td style="color: #22c55e;">+3%</td>
                            <td style="color: #22c55e;">+4.0%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Export Actions -->
            <div style="margin-top: 2rem; text-align: center;">
                <button class="btn-primary" onclick="exportReport()">
                    <i class="bi bi-download" style="margin-right: 0.5rem;"></i>
                    Download Report
                </button>
                <button class="btn-secondary" style="margin-left: 1rem;" onclick="scheduleReport()">
                    <i class="bi bi-calendar-check" style="margin-right: 0.5rem;"></i>
                    Schedule Report
                </button>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
function generateReport() {
    const reportType = document.getElementById('reportType').value;
    alert(`Generating ${reportType} report... (This is a static demo)`);
}

function exportReport() {
    alert('Report exported successfully! (This is a static demo)\n\nIn production, this would download the selected report format.');
}

function scheduleReport() {
    const confirmed = confirm('Schedule this report to be generated automatically?\n\nFrequency: Weekly\nDelivery: Email\n\nProceed?');
    if (confirmed) {
        alert('Report scheduled successfully!');
    }
}

// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
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

    // Activity Chart
    const ctx = document.getElementById('activityChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Active Users',
                data: [650, 720, 810, 892],
                borderColor: '#4f46e5',
                tension: 0.4,
                fill: false
            }, {
                label: 'New Registrations',
                data: [120, 145, 130, 156],
                borderColor: '#10b981',
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
