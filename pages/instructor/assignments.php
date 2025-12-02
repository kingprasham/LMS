<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('Assignments', ['css/dashboard.css', 'css/instructor-dashboard.css', 'css/instructor-pages.css']);
renderNavbar();

// Static data for assignments
$assignments = [
    [
        'id' => 1,
        'title' => 'Build a Portfolio Website',
        'course' => 'Complete Web Development Bootcamp 2024',
        'student' => 'Sarah Johnson',
        'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Johnson&background=random',
        'submitted_date' => '2024-04-10 14:30',
        'status' => 'pending',
        'grade' => null
    ],
    [
        'id' => 2,
        'title' => 'React Component Library',
        'course' => 'Advanced React Patterns',
        'student' => 'Michael Chen',
        'avatar' => 'https://ui-avatars.com/api/?name=Michael+Chen&background=random',
        'submitted_date' => '2024-04-09 09:15',
        'status' => 'graded',
        'grade' => 95
    ],
    [
        'id' => 3,
        'title' => 'API Integration Project',
        'course' => 'Node.js Microservices',
        'student' => 'James Wilson',
        'avatar' => 'https://ui-avatars.com/api/?name=James+Wilson&background=random',
        'submitted_date' => '2024-04-11 11:45',
        'status' => 'pending',
        'grade' => null
    ],
    [
        'id' => 4,
        'title' => 'Build a Portfolio Website',
        'course' => 'Complete Web Development Bootcamp 2024',
        'student' => 'Emily Davis',
        'avatar' => 'https://ui-avatars.com/api/?name=Emily+Davis&background=random',
        'submitted_date' => '2024-04-08 16:20',
        'status' => 'graded',
        'grade' => 88
    ]
];
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('assignments'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Assignments</h1>
                <p class="dashboard-subtitle">Review and grade student submissions</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-bar fade-in-up" style="animation-delay: 0.1s">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" placeholder="Search assignments...">
            </div>
            <div class="filter-btn-group">
                <button class="filter-btn active">All</button>
                <button class="filter-btn">Pending</button>
                <button class="filter-btn">Graded</button>
            </div>
        </div>

        <!-- Assignments Table -->
        <div class="table-container fade-in-up" style="animation-delay: 0.2s">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Assignment</th>
                        <th>Student</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assignments as $a): ?>
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: #1e293b; margin-bottom: 0.125rem;"><?php echo $a['title']; ?></div>
                            <div style="font-size: 0.85rem; color: #64748b;"><?php echo $a['course']; ?></div>
                        </td>
                        <td>
                            <div class="user-info">
                                <img src="<?php echo $a['avatar']; ?>" class="user-avatar" alt="Avatar">
                                <div class="user-name"><?php echo $a['student']; ?></div>
                            </div>
                        </td>
                        <td style="color: #64748b; font-size: 0.9rem;"><?php echo date('M d, H:i', strtotime($a['submitted_date'])); ?></td>
                        <td>
                            <span class="status-badge status-<?php echo $a['status'] == 'graded' ? 'graded' : 'pending'; ?>">
                                <?php echo ucfirst($a['status']); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($a['grade']): ?>
                                <span style="font-weight: 700; color: #1e293b;"><?php echo $a['grade']; ?>/100</span>
                            <?php else: ?>
                                <span style="color: #94a3b8;">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <?php if ($a['status'] == 'pending'): ?>
                                    <a href="<?php echo url('pages/instructor/grade-assignment.php?id=' . $a['id']); ?>" class="grade-btn">
                                        <i class="bi bi-check2-circle"></i> Grade
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo url('pages/instructor/grade-assignment.php?id=' . $a['id']); ?>" class="action-btn btn-purple" title="Edit Grade">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
