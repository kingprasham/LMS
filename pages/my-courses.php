<?php
require_once('../includes/session.php');

// Redirect if not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php?return_url=' . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

$user_name = $_SESSION['user_name'] ?? 'Student';
$user_id = $_SESSION['user_id'] ?? 0;

include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('My Courses', ['css/my-courses.css']);
renderNavbar();
?>

<div class="my-courses-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('my-courses'); ?>

    <!-- Main Content -->
    <main class="my-courses-main" id="myCoursesMain">
        <!-- Header -->
        <div class="courses-header fade-in-up">
            <div>
                <h1 class="page-title">My Courses</h1>
                <p class="page-subtitle">Manage and continue your learning</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Filters -->
        <div class="courses-filters fade-in-up" style="animation-delay: 0.1s">
            <div class="tabs-container">
                <button class="tab-btn active" data-filter="all">
                    <i class="bi bi-grid-fill"></i> All Courses
                    <span class="tab-count" id="count-all">0</span>
                </button>
                <button class="tab-btn" data-filter="active">
                    <i class="bi bi-play-circle-fill"></i> Active
                    <span class="tab-count" id="count-active">0</span>
                </button>
                <button class="tab-btn" data-filter="completed">
                    <i class="bi bi-check-circle-fill"></i> Completed
                    <span class="tab-count" id="count-completed">0</span>
                </button>
            </div>
            
            <div class="search-sort-container">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="search-input" placeholder="Search your courses...">
                </div>
                <select class="sort-select" id="sort-select">
                    <option value="recent">Last Accessed</option>
                    <option value="progress-high">Progress (High to Low)</option>
                    <option value="progress-low">Progress (Low to High)</option>
                    <option value="enrolled">Recently Enrolled</option>
                </select>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="courses-grid fade-in-up" style="animation-delay: 0.2s" id="my-courses-grid-container">
            <!-- Loading state -->
            <div class="loading-state" style="grid-column: 1 / -1; text-align: center; padding: 4rem;">
                <i class="bi bi-hourglass-split" style="font-size: 3rem; color: #667eea;"></i>
                <p style="margin-top: 1rem; color: #5a5f73; font-size: 1.1rem;">Loading your courses...</p>
            </div>
        </div>

        <!-- Empty State -->
        <div class="empty-state" id="empty-state" style="display: none;">
            <div class="empty-state-content">
                <i class="bi bi-book"></i>
                <h3>No Courses Found</h3>
                <p>You haven't enrolled in any courses yet.</p>
                <a href="<?php echo url('pages/courses.php'); ?>" class="btn-browse">
                    <i class="bi bi-search"></i> Browse Courses
                </a>
            </div>
        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
// Store all courses for filtering
let allCourses = [];
let currentFilter = 'all';

document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        }
    });

    // Setup filters
    setupFilters();
    
    // Setup search
    setupSearch();
    
    // Setup sort
    setupSort();
    
    // Load courses
    loadMyCourses();
});

function setupFilters() {
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentFilter = this.dataset.filter;
            renderCourses();
        });
    });
}

function setupSearch() {
    const searchInput = document.getElementById('search-input');
    let debounceTimer;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            renderCourses();
        }, 300);
    });
}

function setupSort() {
    document.getElementById('sort-select').addEventListener('change', function() {
        renderCourses();
    });
}

async function loadMyCourses() {
    try {
        const response = await fetch('dashboard_api.php?action=my_courses');
        
        // Check if response is OK
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.success) {
            allCourses = data.courses;
            updateCounts();
            renderCourses();
        } else {
            showEmptyState();
        }
    } catch (error) {
        console.error('Error loading courses:', error);
        document.getElementById('my-courses-grid-container').innerHTML = `
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #dc3545;">
                <i class="bi bi-exclamation-circle" style="font-size: 2rem;"></i>
                <p style="margin-top: 1rem;">Failed to load courses: ${error.message}</p>
                <button onclick="location.reload()" class="btn-primary" style="margin-top: 1rem; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">Retry</button>
            </div>
        `;
    }
}

function updateCounts() {
    const active = allCourses.filter(c => c.progress < 100).length;
    const completed = allCourses.filter(c => c.progress >= 100).length;
    
    document.getElementById('count-all').textContent = allCourses.length;
    document.getElementById('count-active').textContent = active;
    document.getElementById('count-completed').textContent = completed;
}

function renderCourses() {
    const container = document.getElementById('my-courses-grid-container');
    const emptyState = document.getElementById('empty-state');
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const sortBy = document.getElementById('sort-select').value;
    
    // Filter courses
    let filtered = allCourses.filter(course => {
        // Filter by tab
        if (currentFilter === 'active' && course.progress >= 100) return false;
        if (currentFilter === 'completed' && course.progress < 100) return false;
        
        // Filter by search
        if (searchTerm && !course.title.toLowerCase().includes(searchTerm)) return false;
        
        return true;
    });
    
    // Sort courses
    filtered.sort((a, b) => {
        switch (sortBy) {
            case 'progress-high':
                return b.progress - a.progress;
            case 'progress-low':
                return a.progress - b.progress;
            case 'enrolled':
                return new Date(b.purchaseDate) - new Date(a.purchaseDate);
            default: // recent
                return new Date(b.lastAccessed) - new Date(a.lastAccessed);
        }
    });
    
    // Render
    if (filtered.length === 0) {
        container.style.display = 'none';
        emptyState.style.display = 'block';
        
        if (allCourses.length === 0) {
            emptyState.querySelector('h3').textContent = 'No Courses Yet';
            emptyState.querySelector('p').textContent = "You haven't enrolled in any courses yet.";
        } else {
            emptyState.querySelector('h3').textContent = 'No Matching Courses';
            emptyState.querySelector('p').textContent = 'Try adjusting your search or filters.';
        }
    } else {
        container.style.display = 'grid';
        emptyState.style.display = 'none';
        container.innerHTML = filtered.map(course => renderCourseCard(course)).join('');
    }
}

function renderCourseCard(course) {
    const progress = course.progress || 0;
    const isCompleted = progress >= 100;
    const statusClass = isCompleted ? 'completed' : 'active';
    const statusText = isCompleted ? 'Completed' : 'Active';
    const timeLeft = isCompleted ? 'Completed' : `${progress}% done`;
    
    return `
        <div class="course-card">
            <div class="course-thumbnail">
                <img src="${course.image}" alt="${course.title}">
                <div class="course-overlay">
                    <a href="course-view.php?id=${course.id}" class="btn-play"><i class="bi bi-play-fill"></i></a>
                </div>
                <div class="course-status-badge ${statusClass}">
                    ${isCompleted ? '<i class="bi bi-check-circle-fill"></i>' : '<span class="status-dot"></span>'} ${statusText}
                </div>
            </div>
            <div class="course-content">
                <div class="course-meta">
                    <span class="course-category">Course</span>
                    <div class="course-actions">
                        <button class="action-btn"><i class="bi bi-heart"></i></button>
                        <button class="action-btn"><i class="bi bi-three-dots-vertical"></i></button>
                    </div>
                </div>
                <h3 class="course-title">${course.title}</h3>
                <div class="course-instructor">
                    <i class="bi bi-person-circle"></i> ${course.instructor}
                </div>
                
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <span class="progress-label">${progress}% Complete</span>
                        <span class="progress-percentage">${progress}%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar ${isCompleted ? 'completed' : ''}" style="width: ${progress}%"></div>
                    </div>
                </div>
                
                <div class="course-footer">
                    <div class="course-time">
                        <i class="bi bi-${isCompleted ? 'check-circle' : 'clock'}"></i> ${timeLeft}
                    </div>
                    ${isCompleted ? 
                        `<div class="completion-badge">
                            <i class="bi bi-award-fill"></i> Certified
                        </div>` :
                        `<a href="course-view.php?id=${course.id}" class="btn-continue-small">Continue</a>`
                    }
                </div>
            </div>
        </div>
    `;
}

function showEmptyState() {
    document.getElementById('courses-container').style.display = 'none';
    document.getElementById('empty-state').style.display = 'block';
}
</script>

<style>
/* Empty State Styles */
.empty-state {
    display: none;
    padding: 4rem 2rem;
}

.empty-state-content {
    text-align: center;
    background: white;
    border-radius: 20px;
    padding: 4rem 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}

.empty-state-content i.bi-book {
    font-size: 5rem;
    color: #d1d7dc;
    margin-bottom: 1.5rem;
}

.empty-state-content h3 {
    font-size: 1.8rem;
    color: #1a1d35;
    margin-bottom: 0.75rem;
}

.empty-state-content p {
    color: #5a5f73;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.btn-browse {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: transform 0.3s, box-shadow 0.3s;
}

.btn-browse:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

/* Loading State */
.loading-state {
    animation: pulse 1.5s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
</style>
