<?php
function renderAdminSidebar($activePage = '') {
?>
    <aside class="dashboard-sidebar" id="dashboardSidebar">
        <div class="sidebar-header">
            <i class="bi bi-shield-fill-check sidebar-icon"></i>
            <span class="sidebar-text">Admin Panel</span>
        </div>

        <nav class="sidebar-nav">
            <a href="<?php echo url('pages/admin/dashboard.php'); ?>" class="sidebar-link <?php echo $activePage === 'dashboard' ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i>
                <span class="link-text">Dashboard</span>
            </a>
            
            <a href="<?php echo url('pages/admin/users.php'); ?>" class="sidebar-link <?php echo $activePage === 'users' ? 'active' : ''; ?>">
                <i class="bi bi-people-fill"></i>
                <span class="link-text">User Management</span>
            </a>

            <a href="<?php echo url('pages/admin/courses.php'); ?>" class="sidebar-link <?php echo $activePage === 'courses' ? 'active' : ''; ?>">
                <i class="bi bi-camera-video-fill"></i>
                <span class="link-text">Courses & Videos</span>
            </a>

            <a href="<?php echo url('pages/admin/analytics.php'); ?>" class="sidebar-link <?php echo $activePage === 'analytics' ? 'active' : ''; ?>">
                <i class="bi bi-graph-up-arrow"></i>
                <span class="link-text">Analytics</span>
            </a>

            <a href="<?php echo url('pages/admin/reports.php'); ?>" class="sidebar-link <?php echo $activePage === 'reports' ? 'active' : ''; ?>">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span class="link-text">Reports</span>
            </a>

            <a href="<?php echo url('pages/admin/messages.php'); ?>" class="sidebar-link <?php echo $activePage === 'messages' ? 'active' : ''; ?>">
                <i class="bi bi-chat-dots-fill"></i>
                <span class="link-text">Messages</span>
            </a>

            <a href="<?php echo url('pages/admin/support.php'); ?>" class="sidebar-link <?php echo $activePage === 'support' ? 'active' : ''; ?>">
                <i class="bi bi-life-preserver"></i>
                <span class="link-text">Support Tickets</span>
            </a>

            <a href="<?php echo url('pages/admin/settings.php'); ?>" class="sidebar-link <?php echo $activePage === 'settings' ? 'active' : ''; ?>">
                <i class="bi bi-gear-fill"></i>
                <span class="link-text">Platform Settings</span>
            </a>

            <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
                <a href="<?php echo url('pages/settings.php'); ?>" class="sidebar-link">
                    <i class="bi bi-person-circle"></i>
                    <span class="link-text">My Account</span>
                </a>
                <a href="<?php echo url('index.php'); ?>" class="sidebar-link">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="link-text">Logout</span>
                </a>
            </div>
        </nav>
    </aside>
<?php
}
?>
