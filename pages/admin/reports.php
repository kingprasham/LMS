<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Reports & Analytics', ['css/dashboard.css', 'css/admin-settings.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('reports'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Reports & Analytics</h1>
                <p class="dashboard-subtitle">Generate insights and download detailed reports</p>
            </div>
            <div class="header-actions">
                <button class="btn-primary-header" onclick="exportReport()">
                    <i class="bi bi-download"></i>
                    Export Report
                </button>
                <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid fade-in-up" style="animation-delay: 0.1s">
            <div class="stat-card gradient-purple">
                <div class="stat-header">
                    <div class="stat-icon-modern">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-trend positive">
                        <i class="bi bi-arrow-up"></i>
                        +12.5%
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value">1,247</h3>
                    <p class="stat-label">Total Users</p>
                </div>
            </div>

            <div class="stat-card gradient-green">
                <div class="stat-header">
                    <div class="stat-icon-modern green">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div class="stat-trend positive">
                        <i class="bi bi-arrow-up"></i>
                        +8.3%
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value">892</h3>
                    <p class="stat-label">Active Users</p>
                </div>
            </div>

            <div class="stat-card gradient-blue">
                <div class="stat-header">
                    <div class="stat-icon-modern blue">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div class="stat-trend positive">
                        <i class="bi bi-arrow-up"></i>
                        +15.2%
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value">12,450</h3>
                    <p class="stat-label">Learning Hours</p>
                </div>
            </div>

            <div class="stat-card gradient-orange">
                <div class="stat-header">
                    <div class="stat-icon-modern orange">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <div class="stat-trend positive">
                        <i class="bi bi-arrow-up"></i>
                        +22.1%
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value">426</h3>
                    <p class="stat-label">Certificates Issued</p>
                </div>
            </div>
        </div>

        <!-- Report Configuration -->
        <div class="settings-card fade-in-up" style="animation-delay: 0.2s">
            <div class="settings-card-header">
                <div class="settings-card-icon">
                    <i class="bi bi-sliders2"></i>
                </div>
                <div class="settings-card-title">
                    <h3>Report Configuration</h3>
                    <p>Customize your report parameters and filters</p>
                </div>
            </div>
            <div class="settings-card-body">
                <div class="settings-form-grid">
                    <div class="settings-form-group">
                        <label class="settings-label">
                            <i class="bi bi-file-text me-2"></i>Report Type
                        </label>
                        <select class="settings-select" id="reportType">
                            <option value="user-activity">User Activity Report</option>
                            <option value="revenue">Revenue Report</option>
                            <option value="course-performance">Course Performance</option>
                            <option value="enrollment">Enrollment Statistics</option>
                            <option value="completion">Completion Rates</option>
                        </select>
                    </div>
                    
                    <div class="settings-form-group">
                        <label class="settings-label">
                            <i class="bi bi-calendar-range me-2"></i>Date Range
                        </label>
                        <select class="settings-select" id="dateRange">
                            <option>Last 7 days</option>
                            <option selected>Last 30 days</option>
                            <option>Last 90 days</option>
                            <option>This Quarter</option>
                            <option>This Year</option>
                            <option>Custom Range</option>
                        </select>
                    </div>

                    <div class="settings-form-group">
                        <label class="settings-label">
                            <i class="bi bi-people me-2"></i>User Filter
                        </label>
                        <select class="settings-select">
                            <option selected>All Users</option>
                            <option>Students Only</option>
                            <option>Employees Only</option>
                            <option>Active Users</option>
                            <option>Inactive Users</option>
                        </select>
                    </div>

                    <div class="settings-form-group">
                        <label class="settings-label">
                            <i class="bi bi-download me-2"></i>Export Format
                        </label>
                        <select class="settings-select">
                            <option>PDF Document</option>
                            <option>Excel (XLSX)</option>
                            <option>CSV File</option>
                            <option>JSON Data</option>
                        </select>
                    </div>
                </div>

                <div class="report-actions">
                    <button class="btn-settings-secondary" onclick="resetFilters()">
                        <i class="bi bi-arrow-clockwise"></i>
                        Reset Filters
                    </button>
                    <button class="btn-settings-primary" onclick="generateReport()">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                        Generate Preview
                    </button>
                </div>
            </div>
        </div>

        <!-- Activity Chart -->
        <div class="chart-card fade-in-up" style="animation-delay: 0.3s">
            <div class="chart-card-header">
                <div>
                    <h3 class="chart-title">Activity Trends</h3>
                    <p class="chart-subtitle">User engagement over the selected period</p>
                </div>
                <div class="chart-legend">
                    <span class="legend-item">
                        <span class="legend-dot purple"></span>
                        Active Users
                    </span>
                    <span class="legend-item">
                        <span class="legend-dot green"></span>
                        New Registrations
                    </span>
                </div>
            </div>
            <div class="chart-body">
                <canvas id="activityChart" height="300"></canvas>
            </div>
        </div>

        <!-- Detailed Stats Table -->
        <div class="settings-card fade-in-up" style="animation-delay: 0.4s">
            <div class="settings-card-header">
                <div class="settings-card-icon blue">
                    <i class="bi bi-table"></i>
                </div>
                <div class="settings-card-title">
                    <h3>Detailed Breakdown</h3>
                    <p>Compare metrics across periods</p>
                </div>
            </div>
            <div class="settings-card-body" style="padding: 0;">
                <div class="report-table-container">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Metric</th>
                                <th>This Period</th>
                                <th>Previous Period</th>
                                <th>Change</th>
                                <th>Trend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="metric-cell">
                                        <span class="metric-icon purple">
                                            <i class="bi bi-person-plus-fill"></i>
                                        </span>
                                        New Registrations
                                    </div>
                                </td>
                                <td><strong>156</strong></td>
                                <td>132</td>
                                <td class="positive">+24</td>
                                <td>
                                    <span class="trend-badge positive">
                                        <i class="bi bi-arrow-up"></i>
                                        +18.2%
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="metric-cell">
                                        <span class="metric-icon blue">
                                            <i class="bi bi-journal-check"></i>
                                        </span>
                                        Course Enrollments
                                    </div>
                                </td>
                                <td><strong>445</strong></td>
                                <td>398</td>
                                <td class="positive">+47</td>
                                <td>
                                    <span class="trend-badge positive">
                                        <i class="bi bi-arrow-up"></i>
                                        +11.8%
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="metric-cell">
                                        <span class="metric-icon green">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </span>
                                        Course Completions
                                    </div>
                                </td>
                                <td><strong>892</strong></td>
                                <td>798</td>
                                <td class="positive">+94</td>
                                <td>
                                    <span class="trend-badge positive">
                                        <i class="bi bi-arrow-up"></i>
                                        +11.8%
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="metric-cell">
                                        <span class="metric-icon orange">
                                            <i class="bi bi-clock-history"></i>
                                        </span>
                                        Avg. Session Duration
                                    </div>
                                </td>
                                <td><strong>2.5 hrs</strong></td>
                                <td>2.3 hrs</td>
                                <td class="positive">+0.2 hrs</td>
                                <td>
                                    <span class="trend-badge positive">
                                        <i class="bi bi-arrow-up"></i>
                                        +8.7%
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="metric-cell">
                                        <span class="metric-icon cyan">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </span>
                                        User Retention Rate
                                    </div>
                                </td>
                                <td><strong>78%</strong></td>
                                <td>75%</td>
                                <td class="positive">+3%</td>
                                <td>
                                    <span class="trend-badge positive">
                                        <i class="bi bi-arrow-up"></i>
                                        +4.0%
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Reports -->
        <div class="section-header fade-in-up" style="animation-delay: 0.5s">
            <div>
                <h2 class="section-title">Quick Reports</h2>
                <p class="section-desc">Download frequently used reports with one click</p>
            </div>
        </div>

        <div class="quick-reports-grid fade-in-up" style="animation-delay: 0.6s">
            <div class="quick-report-card">
                <div class="quick-report-icon purple">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="quick-report-info">
                    <h4>User Summary</h4>
                    <p>Complete user analytics</p>
                </div>
                <button class="quick-report-btn" onclick="downloadQuickReport('users')">
                    <i class="bi bi-download"></i>
                </button>
            </div>

            <div class="quick-report-card">
                <div class="quick-report-icon green">
                    <i class="bi bi-currency-rupee"></i>
                </div>
                <div class="quick-report-info">
                    <h4>Revenue Report</h4>
                    <p>Sales and transactions</p>
                </div>
                <button class="quick-report-btn" onclick="downloadQuickReport('revenue')">
                    <i class="bi bi-download"></i>
                </button>
            </div>

            <div class="quick-report-card">
                <div class="quick-report-icon blue">
                    <i class="bi bi-book-fill"></i>
                </div>
                <div class="quick-report-info">
                    <h4>Course Analytics</h4>
                    <p>Performance metrics</p>
                </div>
                <button class="quick-report-btn" onclick="downloadQuickReport('courses')">
                    <i class="bi bi-download"></i>
                </button>
            </div>

            <div class="quick-report-card">
                <div class="quick-report-icon orange">
                    <i class="bi bi-award-fill"></i>
                </div>
                <div class="quick-report-info">
                    <h4>Certificates</h4>
                    <p>Issued certificates log</p>
                </div>
                <button class="quick-report-btn" onclick="downloadQuickReport('certificates')">
                    <i class="bi bi-download"></i>
                </button>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<style>
/* Additional Report Page Styles */
.stat-icon-modern {
    width: 3rem;
    height: 3rem;
    border-radius: 0.875rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    color: white;
}

.stat-icon-modern.green {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.stat-icon-modern.blue {
    background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
}

.stat-icon-modern.orange {
    background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
}

.report-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #f1f5f9;
    justify-content: flex-end;
}

/* Chart Card */
.chart-card {
    background: #ffffff;
    border-radius: 1.25rem;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.chart-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 1px solid #e2e8f0;
}

.chart-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.25rem;
}

.chart-subtitle {
    font-size: 0.875rem;
    color: #64748b;
}

.chart-legend {
    display: flex;
    gap: 1.5rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #64748b;
}

.legend-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.legend-dot.purple {
    background: #4f46e5;
}

.legend-dot.green {
    background: #10b981;
}

.chart-body {
    padding: 1.5rem 2rem;
}

/* Report Table */
.report-table-container {
    overflow-x: auto;
}

.report-table {
    width: 100%;
    border-collapse: collapse;
}

.report-table th,
.report-table td {
    padding: 1.25rem 2rem;
    text-align: left;
}

.report-table th {
    background: #f8fafc;
    font-size: 0.75rem;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #e2e8f0;
}

.report-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s;
}

.report-table tbody tr:hover {
    background: #f8fafc;
}

.report-table tbody tr:last-child {
    border-bottom: none;
}

.metric-cell {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    font-weight: 600;
    color: #0f172a;
}

.metric-icon {
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.metric-icon.purple {
    background: #e0e7ff;
    color: #4f46e5;
}

.metric-icon.blue {
    background: #e0f2fe;
    color: #0ea5e9;
}

.metric-icon.green {
    background: #dcfce7;
    color: #16a34a;
}

.metric-icon.orange {
    background: #fef3c7;
    color: #f59e0b;
}

.metric-icon.cyan {
    background: #cffafe;
    color: #06b6d4;
}

.report-table td.positive {
    color: #16a34a;
    font-weight: 600;
}

.report-table td.negative {
    color: #ef4444;
    font-weight: 600;
}

.trend-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.35rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.8rem;
    font-weight: 700;
}

.trend-badge.positive {
    background: #dcfce7;
    color: #16a34a;
}

.trend-badge.negative {
    background: #fee2e2;
    color: #ef4444;
}

/* Quick Reports Grid */
.quick-reports-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.quick-report-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: #ffffff;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.quick-report-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border-color: #e0e7ff;
    transform: translateY(-2px);
}

.quick-report-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.quick-report-icon.purple {
    background: #e0e7ff;
    color: #4f46e5;
}

.quick-report-icon.green {
    background: #dcfce7;
    color: #16a34a;
}

.quick-report-icon.blue {
    background: #e0f2fe;
    color: #0ea5e9;
}

.quick-report-icon.orange {
    background: #fef3c7;
    color: #f59e0b;
}

.quick-report-info {
    flex: 1;
}

.quick-report-info h4 {
    font-size: 0.95rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.125rem;
}

.quick-report-info p {
    font-size: 0.8rem;
    color: #64748b;
}

.quick-report-btn {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.625rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quick-report-btn:hover {
    background: #4f46e5;
    border-color: #4f46e5;
    color: white;
}

@media (max-width: 768px) {
    .chart-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .report-actions {
        flex-direction: column;
    }
    
    .report-actions button {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function generateReport() {
    const reportType = document.getElementById('reportType').value;
    const dateRange = document.getElementById('dateRange').value;
    alert(`Generating ${reportType} report for ${dateRange}...\n\n(This is a static demo)`);
}

function exportReport() {
    alert('Exporting report...\n\nIn production, this would download the selected report format.');
}

function resetFilters() {
    document.getElementById('reportType').selectedIndex = 0;
    document.getElementById('dateRange').selectedIndex = 1;
    alert('Filters reset to defaults');
}

function downloadQuickReport(type) {
    alert(`Downloading ${type} report...\n\n(This is a static demo)`);
}

// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Activity Chart
    const ctx = document.getElementById('activityChart');
    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Active Users',
                    data: [650, 720, 810, 892],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: '#4f46e5',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }, {
                    label: 'New Registrations',
                    data: [120, 145, 130, 156],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }
});
</script>
