<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Course & Video Management', ['css/dashboard.css', 'css/admin-courses.css']);
renderNavbar();

// Static course data
$courses = [
    [
        'id' => 1,
        'title' => 'AI Fundamentals',
        'category' => 'Artificial Intelligence',
        'instructor' => 'Dr. Sarah Johnson',
        'status' => 'published',
        'enrollments' => 245,
        'rating' => 4.8,
        'thumbnail' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=400&h=250&fit=crop'
    ],
    [
        'id' => 2,
        'title' => 'Web Development Bootcamp',
        'category' => 'Web Development',
        'instructor' => 'Prof. Michael Chen',
        'status' => 'published',
        'enrollments' => 189,
        'rating' => 4.6,
        'thumbnail' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400&h=250&fit=crop'
    ],
    [
        'id' => 3,
        'title' => 'Data Science Masterclass',
        'category' => 'Data Science',
        'instructor' => 'Dr. Emily Rodriguez',
        'status' => 'published',
        'enrollments' => 156,
        'rating' => 4.9,
        'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=250&fit=crop'
    ],
    [
        'id' => 4,
        'title' => 'Machine Learning Advanced',
        'category' => 'Machine Learning',
        'instructor' => 'Prof. Robert Kim',
        'status' => 'draft',
        'enrollments' => 0,
        'rating' => 0,
        'thumbnail' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=400&h=250&fit=crop'
    ],
    [
        'id' => 5,
        'title' => 'Cloud Computing Essentials',
        'category' => 'Cloud Computing',
        'instructor' => 'Jennifer Lopez',
        'status' => 'published',
        'enrollments' => 134,
        'rating' => 4.7,
        'thumbnail' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&h=250&fit=crop'
    ],
    [
        'id' => 6,
        'title' => 'Cybersecurity Basics',
        'category' => 'Cybersecurity',
        'instructor' => 'Tom Anderson',
        'status' => 'archived',
        'enrollments' => 95,
        'rating' => 4.5,
        'thumbnail' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=400&h=250&fit=crop'
    ],
];
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('courses'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Course & Video Management</h1>
                <p class="dashboard-subtitle">Manage all courses and video content</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar fade-in-up" style="animation-delay: 0.1s">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Search courses...">
            </div>
            <div class="filter-btn-group">
                <button class="filter-btn active" data-filter="all">All Courses</button>
                <button class="filter-btn" data-filter="published">Published</button>
                <button class="filter-btn" data-filter="draft">Draft</button>
                <button class="filter-btn" data-filter="archived">Archived</button>
            </div>
            <div class="view-toggle">
                <button class="view-toggle-btn active" data-view="grid">
                    <i class="bi bi-grid-3x3"></i>
                </button>
                <button class="view-toggle-btn" data-view="table">
                    <i class="bi bi-list-ul"></i>
                </button>
            </div>
            <a href="<?php echo url('pages/admin/add-course.php'); ?>" class="add-user-btn">
                <i class="bi bi-plus-circle-fill"></i>
                Add Course
            </a>
        </div>

        <!-- Grid View -->
        <div class="course-grid-view active fade-in-up" style="animation-delay: 0.2s">
            <div class="course-grid">
                <?php foreach ($courses as $course): ?>
                <div class="course-admin-card" data-status="<?php echo $course['status']; ?>">
                    <div class="course-admin-thumbnail">
                        <img src="<?php echo $course['thumbnail']; ?>" alt="<?php echo $course['title']; ?>">
                        <span class="course-status-badge status-<?php echo $course['status']; ?>">
                            <?php echo ucfirst($course['status']); ?>
                        </span>
                    </div>
                    <div class="course-admin-body">
                        <span class="course-admin-category"><?php echo $course['category']; ?></span>
                        <h3 class="course-admin-title"><?php echo $course['title']; ?></h3>
                        <div class="course-admin-instructor">
                            <i class="bi bi-person-fill"></i>
                            <span><?php echo $course['instructor']; ?></span>
                        </div>
                        <div class="course-admin-stats">
                            <div class="course-stat-item">
                                <div class="course-stat-value"><?php echo $course['enrollments']; ?></div>
                                <div class="course-stat-label">Students</div>
                            </div>
                            <?php if ($course['rating'] > 0): ?>
                            <div class="course-stat-item">
                                <div class="course-stat-value">
                                    <?php echo $course['rating']; ?> <i class="bi bi-star-fill" style="color: #fbbf24; font-size: 0.875rem;"></i>
                                </div>
                                <div class="course-stat-label">Rating</div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="course-admin-actions">
                            <a href="<?php echo url('pages/admin/course-detail.php?id='.$course['id']); ?>" class="course-action-btn">
                                <i class="bi bi-pencil-fill"></i>
                                Edit
                            </a>
                            <a href="<?php echo url('pages/admin/analytics.php?course='.$course['id']); ?>" class="course-action-btn">
                                <i class="bi bi-graph-up"></i>
                                Stats
                            </a>
                            <button class="course-action-btn danger" onclick="deleteCourse(<?php echo $course['id']; ?>, '<?php echo $course['title']; ?>')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Table View -->
        <div class="course-table-view fade-in-up" style="animation-delay: 0.2s">
            <div class="user-table-container">
                <table class="course-table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Instructor</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Students</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                        <tr data-status="<?php echo $course['status']; ?>">
                            <td>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <img src="<?php echo $course['thumbnail']; ?>" alt="<?php echo $course['title']; ?>" class="course-table-thumbnail">
                                    <span class="course-list-title"><?php echo $course['title']; ?></span>
                                </div>
                            </td>
                            <td><?php echo $course['instructor']; ?></td>
                            <td><span class="course-admin-category"><?php echo $course['category']; ?></span></td>
                            <td><span class="status-badge status-<?php echo $course['status']; ?>"><?php echo ucfirst($course['status']); ?></span></td>
                            <td><?php echo $course['enrollments']; ?></td>
                            <td>
                                <?php if ($course['rating'] > 0): ?>
                                    <?php echo $course['rating']; ?> <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?php echo url('pages/admin/course-detail.php?id='.$course['id']); ?>" class="action-icon-btn" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="<?php echo url('pages/admin/analytics.php?course='.$course['id']); ?>" class="action-icon-btn" title="Analytics">
                                        <i class="bi bi-graph-up-arrow"></i>
                                    </a>
                                    <button class="action-icon-btn delete" title="Delete" onclick="deleteCourse(<?php echo $course['id']; ?>, '<?php echo $course['title']; ?>')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
// View toggle
document.querySelectorAll('.view-toggle-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.view-toggle-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        const view = btn.getAttribute('data-view');
        if (view === 'grid') {
            document.querySelector('.course-grid-view').classList.add('active');
            document.querySelector('.course-table-view').classList.remove('active');
        } else {
            document.querySelector('.course-grid-view').classList.remove('active');
            document.querySelector('.course-table-view').classList.add('active');
        }
    });
});

// Filter buttons
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        const filter = btn.getAttribute('data-filter');
        
        // Filter grid view
        document.querySelectorAll('.course-admin-card').forEach(card => {
            if (filter === 'all') {
                card.style.display = '';
            } else {
                const status = card.getAttribute('data-status');
                card.style.display = status === filter ? '' : 'none';
            }
        });
        
        // Filter table view
        document.querySelectorAll('.course-table tbody tr').forEach(row => {
            if (filter === 'all') {
                row.style.display = '';
            } else {
                const status = row.getAttribute('data-status');
                row.style.display = status === filter ? '' : 'none';
            }
        });
    });
});

// Search functionality
document.getElementById('searchInput').addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    
    // Search in grid view
    document.querySelectorAll('.course-admin-card').forEach(card => {
        const title = card.querySelector('.course-admin-title').textContent.toLowerCase();
        const category = card.querySelector('.course-admin-category').textContent.toLowerCase();
        const instructor = card.querySelector('.course-admin-instructor span').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || category.includes(searchTerm) || instructor.includes(searchTerm)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
    
    // Search in table view
    document.querySelectorAll('.course-table tbody tr').forEach(row => {
        const title = row.querySelector('.course-list-title').textContent.toLowerCase();
        const text = row.textContent.toLowerCase();
        
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Delete function
function deleteCourse(id, title) {
    if (confirm(`Are you sure you want to delete "${title}"? This action cannot be undone.`)) {
        alert('Course deleted successfully! (This is a static demo)');
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
});
</script>
