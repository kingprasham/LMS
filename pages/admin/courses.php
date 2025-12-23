<?php
include('../../config.php');
include('../../includes/db_connect.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Course & Video Management', ['css/dashboard.css', 'css/admin-courses.css']);
renderNavbar();

// Fetch courses from database
$courses = [];
$result = $conn->query("
    SELECT 
        c.course_id as id,
        c.title,
        c.slug,
        c.thumbnail,
        c.status,
        c.price,
        c.rating,
        c.enrollment_count as enrollments,
        c.created_at,
        cat.name as category,
        u.full_name as instructor
    FROM courses c
    LEFT JOIN categories cat ON c.category_id = cat.category_id
    LEFT JOIN users u ON c.instructor_id = u.user_id
    ORDER BY c.created_at DESC
");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Handle thumbnail URL
        if (empty($row['thumbnail'])) {
            $row['thumbnail'] = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=250&fit=crop';
        } elseif (strpos($row['thumbnail'], 'http') !== 0) {
            // Convert relative path to full URL
            $row['thumbnail'] = url($row['thumbnail']);
        }
        $courses[] = $row;
    }
}

// Get counts for stats
$total_courses = count($courses);
$published_count = 0;
$draft_count = 0;
$archived_count = 0;

foreach ($courses as $course) {
    if ($course['status'] === 'published') $published_count++;
    elseif ($course['status'] === 'draft') $draft_count++;
    elseif ($course['status'] === 'archived') $archived_count++;
}
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('courses'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Course & Video Management</h1>
                <p class="dashboard-subtitle">Manage all courses and video content (<?php echo $total_courses; ?> courses)</p>
            </div>
            <div class="header-actions">
                <a href="<?php echo url('pages/admin/add-course.php'); ?>" class="btn-primary-header">
                    <i class="bi bi-plus-lg"></i>
                    Add New Course
                </a>
                <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar fade-in-up" style="animation-delay: 0.1s">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Search courses...">
            </div>
            <div class="filter-actions">
                <div class="filter-btn-group">
                    <button class="filter-btn active" data-filter="all">All (<?php echo $total_courses; ?>)</button>
                    <button class="filter-btn" data-filter="published">Published (<?php echo $published_count; ?>)</button>
                    <button class="filter-btn" data-filter="draft">Draft (<?php echo $draft_count; ?>)</button>
                    <button class="filter-btn" data-filter="archived">Archived (<?php echo $archived_count; ?>)</button>
                </div>
                <div class="view-toggle">
                    <button class="view-toggle-btn active" data-view="grid">
                        <i class="bi bi-grid-3x3"></i>
                    </button>
                    <button class="view-toggle-btn" data-view="table">
                        <i class="bi bi-list-ul"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <?php if (empty($courses)): ?>
        <div class="empty-state fade-in-up" style="animation-delay: 0.2s">
            <div class="empty-state-content">
                <i class="bi bi-collection-play"></i>
                <h3>No Courses Yet</h3>
                <p>Get started by creating your first course</p>
                <a href="<?php echo url('pages/admin/add-course.php'); ?>" class="btn-primary-header">
                    <i class="bi bi-plus-lg"></i>
                    Add New Course
                </a>
            </div>
        </div>
        <?php else: ?>

        <!-- Grid View -->
        <div class="course-grid-view active fade-in-up" style="animation-delay: 0.2s">
            <div class="course-grid">
                <?php foreach ($courses as $course): ?>
                <div class="course-admin-card" data-status="<?php echo $course['status']; ?>" data-id="<?php echo $course['id']; ?>">
                    <div class="course-admin-thumbnail">
                        <img src="<?php echo htmlspecialchars($course['thumbnail']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>">
                        <span class="course-status-badge status-<?php echo $course['status']; ?>">
                            <?php echo ucfirst($course['status']); ?>
                        </span>
                        <a href="<?php echo url('pages/course-view.php?id='.$course['id']); ?>" class="course-play-btn" title="Play Course">
                            <i class="bi bi-play-fill"></i>
                        </a>
                    </div>
                    <div class="course-admin-body">
                        <span class="course-admin-category"><?php echo htmlspecialchars($course['category'] ?? 'Uncategorized'); ?></span>
                        <h3 class="course-admin-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                        <div class="course-admin-instructor">
                            <i class="bi bi-person-fill"></i>
                            <span><?php echo htmlspecialchars($course['instructor'] ?? 'No instructor'); ?></span>
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
                            <a href="<?php echo url('pages/course-detail.php?id='.$course['id']); ?>" class="course-action-btn" target="_blank">
                                <i class="bi bi-eye-fill"></i>
                                View
                            </a>
                            <a href="<?php echo url('pages/admin/edit-course.php?id='.$course['id']); ?>" class="course-action-btn">
                                <i class="bi bi-pencil-fill"></i>
                                Edit
                            </a>
                            <button class="course-action-btn danger" onclick="deleteCourse(<?php echo $course['id']; ?>, '<?php echo htmlspecialchars(addslashes($course['title'])); ?>')">
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
                        <tr data-status="<?php echo $course['status']; ?>" data-id="<?php echo $course['id']; ?>">
                            <td>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <img src="<?php echo htmlspecialchars($course['thumbnail']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>" class="course-table-thumbnail">
                                    <span class="course-list-title"><?php echo htmlspecialchars($course['title']); ?></span>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($course['instructor'] ?? '-'); ?></td>
                            <td><span class="course-admin-category"><?php echo htmlspecialchars($course['category'] ?? 'Uncategorized'); ?></span></td>
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
                                    <a href="<?php echo url('pages/admin/edit-course.php?id='.$course['id']); ?>" class="action-icon-btn" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="<?php echo url('pages/admin/analytics.php?course='.$course['id']); ?>" class="action-icon-btn" title="Analytics">
                                        <i class="bi bi-graph-up-arrow"></i>
                                    </a>
                                    <button class="action-icon-btn delete" title="Delete" onclick="deleteCourse(<?php echo $course['id']; ?>, '<?php echo htmlspecialchars(addslashes($course['title'])); ?>')">
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
        <?php endif; ?>

    </main>
</div>

<!-- Toast notification -->
<div id="toast" class="toast"></div>

<style>
.empty-state {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 400px;
}
.empty-state-content {
    text-align: center;
    padding: 3rem;
}
.empty-state-content i {
    font-size: 4rem;
    color: #64748b;
    margin-bottom: 1rem;
}
.empty-state-content h3 {
    color: #f1f5f9;
    margin-bottom: 0.5rem;
}
.empty-state-content p {
    color: #94a3b8;
    margin-bottom: 1.5rem;
}
.toast {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    background: #10b981;
    color: white;
    font-weight: 500;
    transform: translateX(200%);
    transition: transform 0.3s ease;
    z-index: 9999;
}
.toast.show {
    transform: translateX(0);
}
.toast.error {
    background: #ef4444;
}
/* Play button on course thumbnail */
.course-admin-thumbnail {
    position: relative;
}
.course-play-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4f46e5;
    font-size: 1.5rem;
    text-decoration: none;
    opacity: 0;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}
.course-play-btn i {
    margin-left: 3px; /* Visual centering for play icon */
}
.course-admin-thumbnail:hover .course-play-btn {
    opacity: 1;
}
.course-play-btn:hover {
    background: #4f46e5;
    color: white;
    transform: translate(-50%, -50%) scale(1.1);
}
</style>

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
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Delete function with API call
function deleteCourse(id, title) {
    if (confirm(`Are you sure you want to delete "${title}"? This action cannot be undone.`)) {
        fetch('<?php echo url('api/admin/courses/delete.php'); ?>?id=' + id, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Course deleted successfully!');
                // Remove from DOM
                document.querySelectorAll(`[data-id="${id}"]`).forEach(el => el.remove());
            } else {
                showToast(data.error || 'Failed to delete course', 'error');
            }
        })
        .catch(err => {
            showToast('Error deleting course', 'error');
        });
    }
}

function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className = 'toast ' + type + ' show';
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
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
