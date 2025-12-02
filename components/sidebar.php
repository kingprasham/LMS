<?php
function renderSidebar($activePage = '') {
?>
    <aside class="dashboard-sidebar" id="dashboardSidebar">
        <div class="sidebar-header">
            <i class="bi bi-grid-3x3-gap-fill sidebar-icon"></i>
            <span class="sidebar-text">Menu</span>
        </div>

        <nav class="sidebar-nav">
            <a href="<?php echo url('pages/dashboard.php'); ?>" class="sidebar-link <?php echo $activePage === 'dashboard' ? 'active' : ''; ?>">
                <i class="bi bi-house-door-fill"></i>
                <span class="link-text">Dashboard</span>
            </a>
            <a href="<?php echo url('pages/my-courses.php'); ?>" class="sidebar-link <?php echo $activePage === 'my-courses' ? 'active' : ''; ?>">
                <i class="bi bi-book-fill"></i>
                <span class="link-text">My Courses</span>
            </a>

            <a href="<?php echo url('pages/quizzes.php'); ?>" class="sidebar-link <?php echo $activePage === 'quizzes' ? 'active' : ''; ?>">
                <i class="bi bi-file-text-fill"></i>
                <span class="link-text">Quizzes</span>
            </a>
            <a href="<?php echo url('pages/assignments.php'); ?>" class="sidebar-link <?php echo $activePage === 'assignments' ? 'active' : ''; ?>">
                <i class="bi bi-file-earmark-code-fill"></i>
                <span class="link-text">Assignments</span>
            </a>

            <a href="<?php echo url('pages/wishlist.php'); ?>" class="sidebar-link <?php echo $activePage === 'wishlist' ? 'active' : ''; ?>">
                <i class="bi bi-heart-fill"></i>
                <span class="link-text">Wishlist</span>
            </a>
            <a href="<?php echo url('pages/calendar.php'); ?>" class="sidebar-link <?php echo $activePage === 'calendar' ? 'active' : ''; ?>">
                <i class="bi bi-calendar-event-fill"></i>
                <span class="link-text">Calendar</span>
            </a>
            <a href="<?php echo url('pages/messages.php'); ?>" class="sidebar-link <?php echo $activePage === 'messages' ? 'active' : ''; ?>">
                <i class="bi bi-chat-left-dots-fill"></i>
                <span class="link-text">Messages</span>
                <span class="badge">3</span>
            </a>
            <a href="<?php echo url('pages/achievements.php'); ?>" class="sidebar-link <?php echo $activePage === 'achievements' ? 'active' : ''; ?>">
                <i class="bi bi-trophy-fill"></i>
                <span class="link-text">Achievements</span>
            </a>
            <a href="<?php echo url('pages/settings.php'); ?>" class="sidebar-link <?php echo $activePage === 'settings' ? 'active' : ''; ?>">
                <i class="bi bi-gear-fill"></i>
                <span class="link-text">Settings</span>
            </a>
            <a href="<?php echo url('pages/support.php'); ?>" class="sidebar-link <?php echo $activePage === 'support' ? 'active' : ''; ?>">
                <i class="bi bi-question-circle-fill"></i>
                <span class="link-text">Support</span>
            </a>
        </nav>
    </aside>
<?php
}
?>
