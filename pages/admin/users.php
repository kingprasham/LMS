<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('User Management', ['css/dashboard.css', 'css/admin-users.css']);
renderNavbar();

// Static data for students
$students = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com', 'status' => 'active', 'joined' => '2024-01-15', 'courses' => 5],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'status' => 'active', 'joined' => '2024-02-20', 'courses' => 3],
    ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike.j@example.com', 'status' => 'active', 'joined' => '2024-03-10', 'courses' => 7],
    ['id' => 4, 'name' => 'Sarah Williams', 'email' => 'sarah.w@example.com', 'status' => 'inactive', 'joined' => '2024-01-25', 'courses' => 2],
    ['id' => 5, 'name' => 'Tom Brown', 'email' => 'tom.brown@example.com', 'status' => 'active', 'joined' => '2024-04-05', 'courses' => 4],
    ['id' => 6, 'name' => 'Emily Davis', 'email' => 'emily.d@example.com', 'status' => 'active', 'joined' => '2024-05-12', 'courses' => 6],
    ['id' => 7, 'name' => 'David Wilson', 'email' => 'david.w@example.com', 'status' => 'pending', 'joined' => '2024-11-28', 'courses' => 0],
    ['id' => 8, 'name' => 'Lisa Anderson', 'email' => 'lisa.a@example.com', 'status' => 'active', 'joined' => '2024-06-18', 'courses' => 8],
];

// Static data for employees
$employees = [
    ['id' => 1, 'name' => 'Robert Martinez', 'email' => 'robert.m@example.com', 'status' => 'active', 'joined' => '2023-01-10', 'department' => 'Support'],
    ['id' => 2, 'name' => 'Jennifer Garcia', 'email' => 'jennifer.g@example.com', 'status' => 'active', 'joined' => '2023-03-15', 'department' => 'Content'],
    ['id' => 3, 'name' => 'William Rodriguez', 'email' => 'william.r@example.com', 'status' => 'active', 'joined' => '2023-05-20', 'department' => 'Support'],
    ['id' => 4, 'name' => 'Mary Lopez', 'email' => 'mary.l@example.com', 'status' => 'inactive', 'joined' => '2023-02-08', 'department' => 'Quality'],
    ['id' => 5, 'name' => 'James Lee', 'email' => 'james.l@example.com', 'status' => 'active', 'joined' => '2023-07-12', 'department' => 'Operations'],
];
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('users'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">User Management</h1>
                <p class="dashboard-subtitle">Manage students and employees</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar fade-in-up" style="animation-delay: 0.1s">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Search users by name or email...">
            </div>
            <div class="filter-btn-group">
                <button class="filter-btn active" data-filter="all">All Users</button>
                <button class="filter-btn" data-filter="active">Active</button>
                <button class="filter-btn" data-filter="inactive">Inactive</button>
                <button class="filter-btn" data-filter="pending">Pending</button>
            </div>
            <a href="<?php echo url('pages/admin/add-user.php'); ?>" class="add-user-btn">
                <i class="bi bi-person-plus-fill"></i>
                Add New User
            </a>
        </div>

        <!-- Tab Navigation -->
        <div class="tab-navigation fade-in-up" style="animation-delay: 0.2s">
            <button class="tab-btn active" data-tab="students">
                <i class="bi bi-person-fill"></i> Students (<?php echo count($students); ?>)
            </button>
            <button class="tab-btn" data-tab="employees">
                <i class="bi bi-people-fill"></i> Employees (<?php echo count($employees); ?>)
            </button>
        </div>

        <!-- Students Tab -->
        <div class="tab-content active" id="students-tab">
            <div class="user-table-container fade-in-up" style="animation-delay: 0.3s">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Courses Enrolled</th>
                            <th>Join Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                        <tr data-status="<?php echo $student['status']; ?>">
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($student['name']); ?>&background=4f46e5&color=fff" 
                                         alt="<?php echo htmlspecialchars($student['name']); ?>" 
                                         class="user-avatar">
                                    <span class="user-name"><?php echo htmlspecialchars($student['name']); ?></span>
                                </div>
                            </td>
                            <td><span class="user-email"><?php echo htmlspecialchars($student['email']); ?></span></td>
                            <td>
                                <span class="status-badge status-<?php echo $student['status']; ?>">
                                    <?php echo ucfirst($student['status']); ?>
                                </span>
                            </td>
                            <td><?php echo $student['courses']; ?> courses</td>
                            <td><?php echo date('M d, Y', strtotime($student['joined'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?php echo url('pages/admin/user-detail.php?id='.$student['id'].'&type=student'); ?>" 
                                       class="action-icon-btn" title="View Details">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="<?php echo url('pages/admin/edit-user.php?id='.$student['id'].'&type=student'); ?>" 
                                       class="action-icon-btn" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button class="action-icon-btn delete" title="Delete" onclick="confirmDelete('<?php echo htmlspecialchars($student['name'], ENT_QUOTES); ?>')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="page-btn" disabled>
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Employees Tab -->
        <div class="tab-content" id="employees-tab">
            <div class="user-table-container fade-in-up" style="animation-delay: 0.3s">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>Join Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee): ?>
                        <tr data-status="<?php echo $employee['status']; ?>">
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($employee['name']); ?>&background=a855f7&color=fff" 
                                         alt="<?php echo htmlspecialchars($employee['name']); ?>" 
                                         class="user-avatar">
                                    <span class="user-name"><?php echo htmlspecialchars($employee['name']); ?></span>
                                </div>
                            </td>
                            <td><span class="user-email"><?php echo htmlspecialchars($employee['email']); ?></span></td>
                            <td>
                                <span class="status-badge status-<?php echo $employee['status']; ?>">
                                    <?php echo ucfirst($employee['status']); ?>
                                </span>
                            </td>
                            <td><span class="badge-role badge-employee"><?php echo htmlspecialchars($employee['department']); ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($employee['joined'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?php echo url('pages/admin/user-detail.php?id='.$employee['id'].'&type=employee'); ?>" 
                                       class="action-icon-btn" title="View Details">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="<?php echo url('pages/admin/edit-user.php?id='.$employee['id'].'&type=employee'); ?>" 
                                       class="action-icon-btn" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button class="action-icon-btn delete" title="Delete" onclick="confirmDelete('<?php echo htmlspecialchars($employee['name'], ENT_QUOTES); ?>')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="page-btn" disabled>
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all tabs and contents
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked tab
            btn.classList.add('active');
            const tabId = btn.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Filter buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const filter = btn.getAttribute('data-filter');
            const activeTab = document.querySelector('.tab-content.active');
            const rows = activeTab.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = 'table-row';
                } else {
                    const status = row.getAttribute('data-status');
                    row.style.display = status === filter ? 'table-row' : 'none';
                }
            });
        });
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const activeTab = document.querySelector('.tab-content.active');
        const rows = activeTab.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const name = row.querySelector('.user-name')?.textContent.toLowerCase() || '';
            const email = row.querySelector('.user-email')?.textContent.toLowerCase() || '';
            
            if (name.includes(searchTerm) || email.includes(searchTerm)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });

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

// Delete confirmation
function confirmDelete(userName) {
    if (confirm(`Are you sure you want to delete user "${userName}"? This action cannot be undone.`)) {
        alert('User deleted successfully! (This is a static demo)');
    }
}
</script>
