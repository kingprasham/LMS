<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('Account Settings', ['css/dashboard.css', 'css/settings.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Global Sidebar -->
    <?php renderSidebar('settings'); ?>

    <!-- Main Content -->
    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Account Settings</h1>
                <p class="dashboard-subtitle">Manage your profile and preferences</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Settings Layout -->
        <div class="settings-layout fade-in-up" style="animation-delay: 0.1s">
            <!-- Settings Navigation (Inner Sidebar) -->
            <div class="settings-nav-card">
                <div class="settings-nav-item active" onclick="switchTab('profile', this)">
                    <i class="bi bi-person-circle"></i>
                    <span>Edit Profile</span>
                </div>
                <div class="settings-nav-item" onclick="switchTab('password', this)">
                    <i class="bi bi-shield-lock"></i>
                    <span>Password</span>
                </div>
                <div class="settings-nav-item" onclick="switchTab('billing', this)">
                    <i class="bi bi-credit-card"></i>
                    <span>Payment History</span>
                </div>
                <div class="settings-nav-item" onclick="switchTab('notifications', this)">
                    <i class="bi bi-bell"></i>
                    <span>Notifications</span>
                </div>
            </div>

            <!-- Settings Content Area -->
            <div class="settings-content-container">
                
                <!-- Edit Profile Tab -->
                <div id="profile" class="settings-tab-content active">
                    <div class="settings-card">
                        <div class="card-header-custom">
                            <h3 class="card-title">Public Profile</h3>
                            <p class="card-subtitle">This information will be displayed publicly.</p>
                        </div>
                        
                        <div class="card-body-custom">
                            <div class="profile-header-row">
                                <div class="avatar-section">
                                    <div class="avatar-wrapper">
                                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff" class="avatar-img" alt="Profile">
                                        <button class="avatar-edit-btn" title="Change Avatar">
                                            <i class="bi bi-camera-fill"></i>
                                        </button>
                                    </div>
                                    <div class="avatar-info">
                                        <h4 class="user-fullname">John Doe</h4>
                                        <p class="user-role">Student</p>
                                    </div>
                                </div>
                            </div>

                            <form class="settings-form">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-input" value="John">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-input" value="Doe">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Headline</label>
                                    <input type="text" class="form-input" value="Web Developer & Designer">
                                    <span class="form-hint">Add a professional headline like, "Instructor at Udemy" or "Architect."</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Biography</label>
                                    <textarea class="form-input" rows="4">I am a passionate web developer with 5 years of experience...</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input type="url" class="form-input" placeholder="https://">
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn-save">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Password Tab -->
                <div id="password" class="settings-tab-content">
                    <div class="settings-card">
                        <div class="card-header-custom">
                            <h3 class="card-title">Change Password</h3>
                            <p class="card-subtitle">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        <div class="card-body-custom">
                            <form class="settings-form" style="max-width: 500px;">
                                <div class="form-group">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-input">
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-save">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Payment History Tab -->
                <div id="billing" class="settings-tab-content">
                    <div class="settings-card">
                        <div class="card-header-custom">
                            <h3 class="card-title">Payment History</h3>
                            <p class="card-subtitle">View your past transactions and download invoices.</p>
                        </div>
                        <div class="card-body-custom p-0">
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Course</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nov 20, 2025</td>
                                            <td>Complete Web Development Bootcamp</td>
                                            <td>$49.99</td>
                                            <td><span class="status-badge success">Paid</span></td>
                                            <td><button class="btn-icon"><i class="bi bi-download"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Oct 15, 2025</td>
                                            <td>Advanced React Patterns</td>
                                            <td>$29.99</td>
                                            <td><span class="status-badge success">Paid</span></td>
                                            <td><button class="btn-icon"><i class="bi bi-download"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Sep 01, 2025</td>
                                            <td>UI/UX Design Masterclass</td>
                                            <td>$39.99</td>
                                            <td><span class="status-badge success">Paid</span></td>
                                            <td><button class="btn-icon"><i class="bi bi-download"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications Tab -->
                <div id="notifications" class="settings-tab-content">
                    <div class="settings-card">
                        <div class="card-header-custom">
                            <h3 class="card-title">Email Notifications</h3>
                            <p class="card-subtitle">Choose what emails you want to receive.</p>
                        </div>
                        <div class="card-body-custom">
                            <div class="notification-item">
                                <div class="notification-info">
                                    <h4>Promotions and course recommendations</h4>
                                    <p>Receive emails about new courses and special offers.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="notification-item">
                                <div class="notification-info">
                                    <h4>Announcements from instructors</h4>
                                    <p>Receive emails about updates to your courses.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-actions mt-4">
                                <button class="btn-save">Save Preferences</button>
                            </div>
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
    // Mobile Sidebar Toggle
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

    // Tab Switching Logic
    function switchTab(tabId, navItem) {
        // Hide all contents
        document.querySelectorAll('.settings-tab-content').forEach(el => {
            el.classList.remove('active');
        });
        // Show target content
        document.getElementById(tabId).classList.add('active');

        // Update nav active state
        document.querySelectorAll('.settings-nav-item').forEach(el => {
            el.classList.remove('active');
        });
        navItem.classList.add('active');
    }
</script>
