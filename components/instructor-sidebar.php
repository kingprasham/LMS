<?php
function renderInstructorSidebar($activePage = 'dashboard') {
    $menuItems = [
        'dashboard' => ['icon' => 'bi-speedometer2', 'label' => 'Dashboard', 'link' => 'pages/instructor/dashboard.php'],
        'courses' => ['icon' => 'bi-journal-richtext', 'label' => 'My Courses', 'link' => 'pages/instructor/my-courses.php'],
        'students' => ['icon' => 'bi-people', 'label' => 'Students', 'link' => 'pages/instructor/students.php'],
        'assignments' => ['icon' => 'bi-clipboard-check', 'label' => 'Assignments', 'link' => 'pages/instructor/assignments.php'],
        'qna' => ['icon' => 'bi-chat-dots', 'label' => 'Q&A', 'link' => 'pages/instructor/qna.php'],
        'messages' => ['icon' => 'bi-chat-dots-fill', 'label' => 'Messages', 'link' => 'pages/instructor/messages.php'],
        'payouts' => ['icon' => 'bi-wallet2', 'label' => 'Payouts', 'link' => 'pages/instructor/payouts.php'],
        'profile' => ['icon' => 'bi-person-circle', 'label' => 'My Profile', 'link' => 'pages/instructor/profile.php'],
    ];
?>
<aside class="dashboard-sidebar" id="dashboardSidebar">
    <div class="sidebar-header">
        <div class="sidebar-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        <span class="sidebar-text">Instructor</span>
    </div>

    <nav class="sidebar-nav">
        <?php foreach ($menuItems as $key => $item): ?>
            <a href="<?php echo url($item['link']); ?>" class="sidebar-link <?php echo $activePage === $key ? 'active' : ''; ?>">
                <i class="bi <?php echo $item['icon']; ?>"></i>
                <span class="link-text"><?php echo $item['label']; ?></span>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="sidebar-footer">
        <a href="<?php echo url('logout.php'); ?>" class="sidebar-link">
            <i class="bi bi-box-arrow-right"></i>
            <span class="link-text">Logout</span>
        </a>
    </div>
</aside>
<?php
}
?>
