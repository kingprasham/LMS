<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('My Courses', ['css/dashboard.css', 'css/admin-courses.css', 'css/instructor-dashboard.css']);
renderNavbar();

// Static data for instructor's courses
$myCourses = [
    [
        'id' => 1,
        'title' => 'Complete Web Development Bootcamp 2024',
        'thumbnail' => 'https://img.youtube.com/vi/zJSY8tbf_ys/maxresdefault.jpg',
        'status' => 'published',
        'students' => 1245,
        'rating' => 4.8,
        'revenue' => 12450,
        'price' => 49.99,
        'last_updated' => '2024-03-15'
    ],
    [
        'id' => 2,
        'title' => 'Advanced React Patterns & Best Practices',
        'thumbnail' => 'https://img.youtube.com/vi/w7ejDZ8SWv8/maxresdefault.jpg',
        'status' => 'published',
        'students' => 850,
        'rating' => 4.9,
        'revenue' => 8500,
        'price' => 59.99,
        'last_updated' => '2024-02-20'
    ],
    [
        'id' => 3,
        'title' => 'Node.js Microservices Architecture',
        'thumbnail' => 'https://img.youtube.com/vi/l27t1j2h-9s/maxresdefault.jpg',
        'status' => 'draft',
        'students' => 0,
        'rating' => 0,
        'revenue' => 0,
        'price' => 69.99,
        'last_updated' => '2024-04-10'
    ],
    [
        'id' => 4,
        'title' => 'Python for Data Science and Machine Learning',
        'thumbnail' => 'https://img.youtube.com/vi/LHBE6Q9XlzI/maxresdefault.jpg',
        'status' => 'pending',
        'students' => 0,
        'rating' => 0,
        'revenue' => 0,
        'price' => 89.99,
        'last_updated' => '2024-04-12'
    ]
];
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('courses'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">My Courses</h1>
                <p class="dashboard-subtitle">Manage your courses, content, and students</p>
            </div>
            <div class="header-actions">
                <a href="<?php echo url('pages/admin/add-course.php'); ?>" class="btn-primary">
                    <i class="bi bi-plus-lg"></i> Create New Course
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-bar fade-in-up" style="animation-delay: 0.1s">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" placeholder="Search your courses...">
            </div>
            <div class="filter-btn-group">
                <button class="filter-btn active">All Courses</button>
                <button class="filter-btn">Published</button>
                <button class="filter-btn">Drafts</button>
                <button class="filter-btn">Pending</button>
            </div>
        </div>

        <!-- Course List -->
        <div class="course-table-container fade-in-up" style="animation-delay: 0.2s">
            <table class="course-table">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Students</th>
                        <th>Rating</th>
                        <th>Revenue</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($myCourses as $course): ?>
                    <tr>
                        <td style="width: 40%;">
                            <div style="display: flex; gap: 1rem; align-items: center;">
                                <img src="<?php echo $course['thumbnail']; ?>" class="course-table-thumbnail" alt="Thumbnail">
                                <div>
                                    <div class="course-list-title"><?php echo $course['title']; ?></div>
                                    <div style="font-size: 0.85rem; color: var(--text-secondary);">$<?php echo $course['price']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-<?php echo $course['status']; ?>">
                                <?php echo ucfirst($course['status']); ?>
                            </span>
                        </td>
                        <td><?php echo number_format($course['students']); ?></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.25rem;">
                                <i class="bi bi-star-fill text-warning" style="font-size: 0.8rem;"></i>
                                <span><?php echo $course['rating'] > 0 ? $course['rating'] : '-'; ?></span>
                            </div>
                        </td>
                        <td>$<?php echo number_format($course['revenue']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($course['last_updated'])); ?></td>
                        <td>
                            <div class="action-buttons" style="display: flex; gap: 0.5rem;">
                                <a href="#" class="action-icon-btn" title="Edit Course" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5; padding: 0.5rem; border-radius: 0.375rem; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s; width: 32px; height: 32px;" onmouseover="this.style.background='#4f46e5'; this.style.color='white';" onmouseout="this.style.background='rgba(79, 70, 229, 0.1)'; this.style.color='#4f46e5';">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="action-icon-btn" title="Analytics" style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.5rem; border-radius: 0.375rem; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s; width: 32px; height: 32px;" onmouseover="this.style.background='#10b981'; this.style.color='white';" onmouseout="this.style.background='rgba(16, 185, 129, 0.1)'; this.style.color='#10b981';">
                                    <i class="bi bi-graph-up"></i>
                                </a>
                                <a href="#" class="action-icon-btn" title="Manage Students" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 0.5rem; border-radius: 0.375rem; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s; width: 32px; height: 32px;" onmouseover="this.style.background='#3b82f6'; this.style.color='white';" onmouseout="this.style.background='rgba(59, 130, 246, 0.1)'; this.style.color='#3b82f6';">
                                    <i class="bi bi-people-fill"></i>
                                </a>
                                <button class="action-icon-btn delete" title="Delete" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.5rem; border-radius: 0.375rem; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: all 0.2s; width: 32px; height: 32px;" onmouseover="this.style.background='#ef4444'; this.style.color='white';" onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='#ef4444';">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
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
