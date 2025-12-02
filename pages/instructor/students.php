<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('My Students', ['css/dashboard.css', 'css/instructor-dashboard.css', 'css/instructor-pages.css']);
renderNavbar();

// Static data for students
$students = [
    [
        'id' => 1,
        'name' => 'Sarah Johnson',
        'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Johnson&background=random',
        'course' => 'Complete Web Development Bootcamp 2024',
        'progress' => 75,
        'enrolled_date' => '2024-03-01',
        'last_active' => '2 hours ago'
    ],
    [
        'id' => 2,
        'name' => 'Michael Chen',
        'avatar' => 'https://ui-avatars.com/api/?name=Michael+Chen&background=random',
        'course' => 'Advanced React Patterns',
        'progress' => 32,
        'enrolled_date' => '2024-03-10',
        'last_active' => '1 day ago'
    ],
    [
        'id' => 3,
        'name' => 'Emily Davis',
        'avatar' => 'https://ui-avatars.com/api/?name=Emily+Davis&background=random',
        'course' => 'Complete Web Development Bootcamp 2024',
        'progress' => 100,
        'enrolled_date' => '2024-02-15',
        'last_active' => '3 days ago'
    ],
    [
        'id' => 4,
        'name' => 'James Wilson',
        'avatar' => 'https://ui-avatars.com/api/?name=James+Wilson&background=random',
        'course' => 'Node.js Microservices',
        'progress' => 12,
        'enrolled_date' => '2024-04-01',
        'last_active' => '5 mins ago'
    ],
    [
        'id' => 5,
        'name' => 'Lisa Anderson',
        'avatar' => 'https://ui-avatars.com/api/?name=Lisa+Anderson&background=random',
        'course' => 'Advanced React Patterns',
        'progress' => 55,
        'enrolled_date' => '2024-03-20',
        'last_active' => '1 week ago'
    ]
];
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('students'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">My Students</h1>
                <p class="dashboard-subtitle">Track student progress and engagement</p>
            </div>
            <div class="header-actions">
                <button class="btn-secondary">
                    <i class="bi bi-download"></i> Export CSV
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-bar fade-in-up" style="animation-delay: 0.1s">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" placeholder="Search students...">
            </div>
            <div class="filter-group">
                <select class="form-select form-select-sm" style="width: 200px;">
                    <option value="">All Courses</option>
                    <option value="web-dev">Web Development Bootcamp</option>
                    <option value="react">Advanced React</option>
                    <option value="node">Node.js Microservices</option>
                </select>
            </div>
        </div>

        <!-- Students Table -->
        <div class="table-container fade-in-up" style="animation-delay: 0.2s">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Enrolled Course</th>
                        <th>Progress</th>
                        <th>Enrolled Date</th>
                        <th>Last Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="<?php echo $student['avatar']; ?>" class="user-avatar" alt="Avatar">
                                <div>
                                    <div class="user-name"><?php echo $student['name']; ?></div>
                                    <div class="user-email">ID: #<?php echo 1000 + $student['id']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-secondary" style="font-size: 0.9rem; font-weight: 500;"><?php echo $student['course']; ?></span>
                        </td>
                        <td style="width: 20%;">
                            <div class="progress-wrapper">
                                <div class="progress" style="height: 6px; background: #e2e8f0; border-radius: 10px; flex: 1;">
                                    <div class="progress-bar <?php echo $student['progress'] == 100 ? 'bg-success' : 'bg-primary'; ?>" 
                                         role="progressbar" 
                                         style="width: <?php echo $student['progress']; ?>%; border-radius: 10px;">
                                    </div>
                                </div>
                                <span class="progress-text" style="font-weight: 600; font-size: 0.85rem; color: #64748b;"><?php echo $student['progress']; ?>%</span>
                            </div>
                        </td>
                        <td style="color: #64748b; font-size: 0.9rem;"><?php echo date('M d, Y', strtotime($student['enrolled_date'])); ?></td>
                        <td style="color: #64748b; font-size: 0.9rem;"><?php echo $student['last_active']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn btn-purple" title="Message">
                                    <i class="bi bi-envelope"></i>
                                </button>
                                <button class="action-btn btn-blue" title="View Profile">
                                    <i class="bi bi-person"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container fade-in-up" style="animation-delay: 0.3s">
            <span class="pagination-info">Showing 1-5 of 1,245 students</span>
            <div class="pagination">
                <button class="page-btn disabled"><i class="bi bi-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span class="page-dots">...</span>
                <button class="page-btn">25</button>
                <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle logic
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('active'));
    }
});
</script>
