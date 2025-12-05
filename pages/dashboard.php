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

renderHead('Student Dashboard', ['css/dashboard.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Animated Sidebar -->
    <?php renderSidebar('dashboard'); ?>

    <!-- Main Content -->
    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Welcome back, <span class="user-name"><?php echo htmlspecialchars($user_name); ?></span>! 👋</h1>
                <p class="dashboard-subtitle">Continue your learning journey and achieve your goals</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Stats Row -->
        <div class="stats-grid fade-in-up" style="animation-delay: 0.1s">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-play-circle-fill"></i>
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" id="stat-active">0</h3>
                    <p class="stat-label">Active Courses</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" id="stat-completed">0</h3>
                    <p class="stat-label">Completed Courses</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" id="stat-certificates">0</h3>
                    <p class="stat-label">Certificates</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-book-fill"></i>
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" id="stat-total">0</h3>
                    <p class="stat-label">Total Courses</p>
                </div>
            </div>
        </div>

        <!-- Continue Learning -->
        <div class="section-header fade-in-up" style="animation-delay: 0.2s">
            <div>
                <h2 class="section-title">Continue Learning</h2>
                <p class="section-desc">Pick up where you left off</p>
            </div>
            <a href="<?php echo url('pages/my-courses.php'); ?>" class="view-all-link">View All <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="course-cards-grid fade-in-up" style="animation-delay: 0.3s" id="dashboard-courses-container">
            <!-- Courses will be loaded dynamically -->
            <div class="loading-state" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                <i class="bi bi-hourglass-split" style="font-size: 2rem; color: #667eea;"></i>
                <p style="margin-top: 1rem; color: #5a5f73;">Loading your courses...</p>
            </div>
        </div>

        <!-- Empty State (hidden by default) -->
        <div class="empty-courses-state fade-in-up" id="empty-state" style="display: none; text-align: center; padding: 4rem 2rem; background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
            <i class="bi bi-book" style="font-size: 4rem; color: #d1d7dc; margin-bottom: 1.5rem;"></i>
            <h3 style="font-size: 1.5rem; color: #1a1d35; margin-bottom: 0.75rem;">No Courses Yet</h3>
            <p style="color: #5a5f73; margin-bottom: 1.5rem;">Start your learning journey by enrolling in a course</p>
            <a href="<?php echo url('pages/courses.php'); ?>" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.875rem 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 10px; font-weight: 600;">
                <i class="bi bi-search"></i> Browse Courses
            </a>
        </div>

        <div class="dashboard-two-col fade-in-up" style="animation-delay: 0.4s">
            <!-- Recent Activity -->
            <div class="activity-section">
                <div class="section-header">
                    <h2 class="section-title">Recent Activity</h2>
                </div>
                <div id="activity-container">
                    <div class="activity-item">
                        <div class="activity-icon purple">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Welcome to AI Cure Academy!</h4>
                            <p>Start learning with our courses</p>
                            <span class="activity-time">Just now</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Learning Tips -->
            <div class="deadlines-section">
                <div class="section-header">
                    <h2 class="section-title">Learning Tips</h2>
                </div>
                <div class="deadline-card normal">
                    <div class="deadline-header"><i class="bi bi-lightbulb"></i> Tip</div>
                    <h4>Set Daily Goals</h4>
                    <p>Dedicate 30 mins daily for consistent progress</p>
                </div>
                <div class="deadline-card normal">
                    <div class="deadline-header"><i class="bi bi-lightbulb"></i> Tip</div>
                    <h4>Take Notes</h4>
                    <p>Writing helps retain information better</p>
                </div>
            </div>
        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');
    const mainContent = document.getElementById('dashboardMain');

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

    // Load dashboard data
    loadDashboardData();
});

async function loadDashboardData() {
    try {
        // Load stats
        const statsResponse = await fetch('dashboard_api.php?action=stats');
        
        if (!statsResponse.ok) {
            console.error('Stats API error:', statsResponse.status);
        } else {
            const statsData = await statsResponse.json();
            
            if (statsData.success) {
                document.getElementById('stat-active').textContent = statsData.stats.activeCourses;
                document.getElementById('stat-completed').textContent = statsData.stats.completedCourses;
                document.getElementById('stat-certificates').textContent = statsData.stats.certificates;
                document.getElementById('stat-total').textContent = statsData.stats.totalCourses;
            } else {
                console.error('Stats not successful:', statsData);
            }
        }
        
        // Load courses
        const coursesResponse = await fetch('dashboard_api.php?action=my_courses');
        
        // Check if response is OK
        if (!coursesResponse.ok) {
            throw new Error(`HTTP error! status: ${coursesResponse.status}`);
        }
        
        const coursesData = await coursesResponse.json();
        
        const container = document.getElementById('dashboard-courses-container');
        const emptyState = document.getElementById('empty-state');
        
        if (coursesData.success && coursesData.courses.length > 0) {
            container.innerHTML = '';
            
            // Show only first 3 courses on dashboard
            const displayCourses = coursesData.courses.slice(0, 3);
            
            displayCourses.forEach(course => {
                container.innerHTML += renderCourseCard(course);
            });
        } else {
            container.style.display = 'none';
            emptyState.style.display = 'block';
        }
        
    } catch (error) {
        console.error('Error loading dashboard:', error);
        document.getElementById('dashboard-courses-container').innerHTML = `
            <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #dc3545;">
                <i class="bi bi-exclamation-circle" style="font-size: 2rem;"></i>
                <p style="margin-top: 1rem;">Failed to load courses: ${error.message}</p>
                <button onclick="location.reload()" class="btn-primary" style="margin-top: 1rem; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">Retry</button>
            </div>
        `;
    }
}

function renderCourseCard(course) {
    const progress = course.progress || 0;
    const isCompleted = progress >= 100;
    const statusClass = isCompleted ? 'completed' : 'active';
    const statusText = isCompleted ? 'Completed' : 'In Progress';
    
    return `
        <div class="course-card-dashboard">
            <div class="course-thumbnail">
                <img src="${course.image}" alt="${course.title}">
                <div class="course-overlay">
                    <a href="course-view.php?id=${course.id}" class="play-btn">
                        <i class="bi bi-play-fill"></i>
                    </a>
                </div>
                <span class="course-status ${statusClass}">${statusText}</span>
            </div>
            <div class="course-info">
                <h3 class="course-title">${course.title}</h3>
                <p class="course-instructor"><i class="bi bi-person-circle"></i> ${course.instructor}</p>
                <div class="progress-container">
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: ${progress}%"></div>
                    </div>
                    <span class="progress-text">${progress}% Complete</span>
                </div>
                <a href="course-view.php?id=${course.id}" class="btn-continue">
                    ${isCompleted ? '<i class="bi bi-arrow-repeat"></i> Review' : '<i class="bi bi-play-fill"></i> Continue'}
                </a>
            </div>
        </div>
    `;
}
</script>

<style>
/* Dashboard Course Card Styles */
.course-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
}

.course-card-dashboard {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}

.course-card-dashboard:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.course-card-dashboard .course-thumbnail {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.course-card-dashboard .course-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.course-card-dashboard .course-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.course-card-dashboard:hover .course-overlay {
    opacity: 1;
}

.course-card-dashboard .play-btn {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #667eea;
    font-size: 1.5rem;
    text-decoration: none;
    transition: transform 0.3s;
}

.course-card-dashboard .play-btn:hover {
    transform: scale(1.1);
}

.course-card-dashboard .course-status {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.course-card-dashboard .course-status.active {
    background: #e8f5e9;
    color: #2e7d32;
}

.course-card-dashboard .course-status.completed {
    background: #e3f2fd;
    color: #1565c0;
}

.course-card-dashboard .course-info {
    padding: 1.25rem;
}

.course-card-dashboard .course-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a1d35;
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.course-card-dashboard .course-instructor {
    font-size: 0.9rem;
    color: #5a5f73;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.course-card-dashboard .progress-container {
    margin-bottom: 1rem;
}

.course-card-dashboard .progress-bar-bg {
    height: 8px;
    background: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.course-card-dashboard .progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border-radius: 4px;
    transition: width 0.3s;
}

.course-card-dashboard .progress-text {
    font-size: 0.8rem;
    color: #667eea;
    font-weight: 600;
}

.course-card-dashboard .btn-continue {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.75rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    transition: opacity 0.3s;
}

.course-card-dashboard .btn-continue:hover {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .course-cards-grid {
        grid-template-columns: 1fr;
    }
}
</style>
