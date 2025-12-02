<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');
include('../components/course-card.php');

renderHead('Student Dashboard', ['css/dashboard.css']);
renderNavbar();

// Simulated Database Data for Courses
$courses = [
    [
        'id' => 1,
        'title' => 'AI in Drug Discovery',
        'image' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop',
        'category' => 'Generative AI',
        'category_color' => 'purple',
        'instructor' => 'Dr. Sarah Johnson',
        'progress' => 65,
        'time_left' => '3h 25m left',
        'video_id' => 'dQw4w9WgXcQ'
    ],
    [
        'id' => 2,
        'title' => 'Machine Learning for Healthcare',
        'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&h=400&fit=crop',
        'category' => 'Machine Learning',
        'category_color' => 'blue',
        'instructor' => 'Prof. Michael Chen',
        'progress' => 40,
        'time_left' => '5h 15m left',
        'video_id' => 'aircAruvnKk'
    ],
    [
        'id' => 3,
        'title' => 'Deep Learning in Medical Imaging',
        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
        'category' => 'Deep Learning',
        'category_color' => 'green',
        'instructor' => 'Dr. Emily Rodriguez',
        'progress' => 85,
        'time_left' => '1h 10m left',
        'video_id' => 'KNAWp2S3w94'
    ]
];
?>

<div class="dashboard-wrapper">
    <!-- Animated Sidebar -->
    <?php renderSidebar('dashboard'); ?>

    <!-- Main Content -->
    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Welcome back, <span class="user-name">Student</span>! 👋</h1>
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
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> 12%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="5">5</h3>
                    <p class="stat-label">Active Courses</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span class="stat-trend positive">
                        <i class="bi bi-arrow-up-short"></i> 8%
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="12">12</h3>
                    <p class="stat-label">Completed Courses</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <span class="stat-trend neutral">
                        <i class="bi bi-dash"></i> 2
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="8">8</h3>
                    <p class="stat-label">Certificates Earned</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-fire"></i>
                    </div>
                    <span class="stat-trend neutral">
                        <i class="bi bi-dash"></i> Same
                    </span>
                </div>
                <div class="stat-body">
                    <h3 class="stat-value" data-target="24">24</h3>
                    <p class="stat-label">Day Streak</p>
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

        <div class="course-cards-grid fade-in-up" style="animation-delay: 0.3s">
            <?php
            foreach ($courses as $course) {
                renderCourseCard($course);
            }
            ?>
        </div>

        <div class="dashboard-two-col fade-in-up" style="animation-delay: 0.4s">
            <!-- Recent Activity -->
            <div class="activity-section">
                <div class="section-header">
                    <h2 class="section-title">Recent Activity</h2>
                </div>
                <div class="activity-item">
                    <div class="activity-icon purple">
                        <i class="bi bi-play-fill"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Completed Lesson: Neural Networks</h4>
                        <p>AI in Drug Discovery</p>
                        <span class="activity-time">2 hours ago</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon blue">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Submitted Assignment: Lab Report</h4>
                        <p>Machine Learning for Healthcare</p>
                        <span class="activity-time">Yesterday</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon green">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Earned Certificate</h4>
                        <p>Python for Data Science</p>
                        <span class="activity-time">3 days ago</span>
                    </div>
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="deadlines-section">
                <div class="section-header">
                    <h2 class="section-title">Deadlines</h2>
                </div>
                <div class="deadline-card urgent">
                    <div class="deadline-header">Today</div>
                    <h4>Final Project Submission</h4>
                    <p>AI in Drug Discovery</p>
                </div>
                <div class="deadline-card warning">
                    <div class="deadline-header">Tomorrow</div>
                    <h4>Quiz: Supervised Learning</h4>
                    <p>Machine Learning for Healthcare</p>
                </div>
                <div class="deadline-card normal">
                    <div class="deadline-header">Nov 25</div>
                    <h4>Peer Review Due</h4>
                    <p>Deep Learning in Medical Imaging</p>
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
});
</script>
