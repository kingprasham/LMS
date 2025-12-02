<?php
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
                <button class="tab-btn active">
                    <i class="bi bi-grid-fill"></i> All Courses
                    <span class="tab-count">12</span>
                </button>
                <button class="tab-btn">
                    <i class="bi bi-play-circle-fill"></i> Active
                    <span class="tab-count">5</span>
                </button>
                <button class="tab-btn">
                    <i class="bi bi-check-circle-fill"></i> Completed
                    <span class="tab-count">7</span>
                </button>
            </div>
            
            <div class="search-sort-container">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search your courses...">
                </div>
                <select class="sort-select">
                    <option>Last Accessed</option>
                    <option>Progress (High to Low)</option>
                    <option>Progress (Low to High)</option>
                    <option>Recently Enrolled</option>
                </select>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="courses-grid fade-in-up" style="animation-delay: 0.2s">
            <!-- Course 1 -->
            <div class="course-card">
                <div class="course-thumbnail">
                    <img src="https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop" alt="AI Course">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-view.php?id=1'); ?>" class="btn-play"><i class="bi bi-play-fill"></i></a>
                    </div>
                    <div class="course-status-badge active">
                        <span class="status-dot"></span> Active
                    </div>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span class="course-category">Generative AI</span>
                        <div class="course-actions">
                            <button class="action-btn"><i class="bi bi-heart"></i></button>
                            <button class="action-btn"><i class="bi bi-three-dots-vertical"></i></button>
                        </div>
                    </div>
                    <h3 class="course-title">AI in Drug Discovery</h3>
                    <div class="course-instructor">
                        <i class="bi bi-person-circle"></i> Dr. Sarah Johnson
                    </div>
                    
                    <div class="progress-wrapper">
                        <div class="progress-info">
                            <span class="progress-label">65% Complete</span>
                            <span class="progress-percentage">65%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 65%"></div>
                        </div>
                    </div>
                    
                    <div class="course-footer">
                        <div class="course-time">
                            <i class="bi bi-clock"></i> 3h 25m left
                        </div>
                        <a href="<?php echo url('pages/course-view.php?id=1'); ?>" class="btn-continue-small">Continue</a>
                    </div>
                </div>
            </div>

            <!-- Course 2 -->
            <div class="course-card">
                <div class="course-thumbnail">
                    <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&h=400&fit=crop" alt="ML Course">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-view.php?id=1'); ?>" class="btn-play"><i class="bi bi-play-fill"></i></a>
                    </div>
                    <div class="course-status-badge active">
                        <span class="status-dot"></span> Active
                    </div>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span class="course-category">Machine Learning</span>
                        <div class="course-actions">
                            <button class="action-btn"><i class="bi bi-heart"></i></button>
                            <button class="action-btn"><i class="bi bi-three-dots-vertical"></i></button>
                        </div>
                    </div>
                    <h3 class="course-title">Machine Learning for Healthcare</h3>
                    <div class="course-instructor">
                        <i class="bi bi-person-circle"></i> Prof. Michael Chen
                    </div>
                    
                    <div class="progress-wrapper">
                        <div class="progress-info">
                            <span class="progress-label">40% Complete</span>
                            <span class="progress-percentage">40%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 40%"></div>
                        </div>
                    </div>
                    
                    <div class="course-footer">
                        <div class="course-time">
                            <i class="bi bi-clock"></i> 5h 15m left
                        </div>
                        <a href="<?php echo url('pages/course-view.php?id=1'); ?>" class="btn-continue-small">Continue</a>
                    </div>
                </div>
            </div>

            <!-- Course 3 -->
            <div class="course-card">
                <div class="course-thumbnail">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop" alt="Medical Imaging">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-view.php?id=1'); ?>" class="btn-play"><i class="bi bi-play-fill"></i></a>
                    </div>
                    <div class="course-status-badge active">
                        <span class="status-dot"></span> Active
                    </div>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span class="course-category">Deep Learning</span>
                        <div class="course-actions">
                            <button class="action-btn"><i class="bi bi-heart"></i></button>
                            <button class="action-btn"><i class="bi bi-three-dots-vertical"></i></button>
                        </div>
                    </div>
                    <h3 class="course-title">Deep Learning in Medical Imaging</h3>
                    <div class="course-instructor">
                        <i class="bi bi-person-circle"></i> Dr. Emily Rodriguez
                    </div>
                    
                    <div class="progress-wrapper">
                        <div class="progress-info">
                            <span class="progress-label">85% Complete</span>
                            <span class="progress-percentage">85%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <div class="course-footer">
                        <div class="course-time">
                            <i class="bi bi-clock"></i> 1h 10m left
                        </div>
                        <a href="<?php echo url('pages/course-view.php?id=1'); ?>" class="btn-continue-small">Continue</a>
                    </div>
                </div>
            </div>
            
            <!-- Course 4 -->
             <div class="course-card">
                <div class="course-thumbnail">
                    <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=600&h=400&fit=crop" alt="Cyber Security">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-view.php?id=1'); ?>" class="btn-play"><i class="bi bi-play-fill"></i></a>
                    </div>
                    <div class="course-status-badge completed">
                        <i class="bi bi-check-circle-fill"></i> Completed
                    </div>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span class="course-category">Security</span>
                        <div class="course-actions">
                            <button class="action-btn"><i class="bi bi-heart"></i></button>
                            <button class="action-btn"><i class="bi bi-three-dots-vertical"></i></button>
                        </div>
                    </div>
                    <h3 class="course-title">Ethical Hacking Basics</h3>
                    <div class="course-instructor">
                        <i class="bi bi-person-circle"></i> Alex Turner
                    </div>
                    
                    <div class="progress-wrapper">
                        <div class="progress-info">
                            <span class="progress-label">100% Complete</span>
                            <span class="progress-percentage">100%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar completed" style="width: 100%"></div>
                        </div>
                    </div>
                    
                    <div class="course-footer">
                        <div class="course-time">
                            <i class="bi bi-clock"></i> 12h 30m
                        </div>
                        <div class="completion-badge">
                            <i class="bi bi-award-fill"></i> Certified
                        </div>
                    </div>
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
