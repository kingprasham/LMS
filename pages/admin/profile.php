<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('My Profile', ['css/dashboard.css', 'css/admin-users.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('profile'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">My Profile</h1>
                <p class="dashboard-subtitle">Manage your account settings and preferences</p>
            </div>
        </div>

        <!-- Profile Container -->
        <div class="profile-container fade-in-up" style="animation-delay: 0.1s">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-avatar-section">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff&size=120" alt="Profile" class="profile-avatar-large">
                    <button class="btn-outline-primary btn-sm" style="margin-top: 1rem;">Change Photo</button>
                </div>
                <div class="profile-info-section">
                    <h2 class="profile-name">Admin User</h2>
                    <p class="profile-role">System Administrator</p>
                    <div class="profile-stats">
                        <div class="profile-stat-item">
                            <span class="stat-value">156</span>
                            <span class="stat-label">Total Users</span>
                        </div>
                        <div class="profile-stat-item">
                            <span class="stat-value">42</span>
                            <span class="stat-label">Active Courses</span>
                        </div>
                        <div class="profile-stat-item">
                            <span class="stat-value">2.5k</span>
                            <span class="stat-label">Enrollments</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="profile-tabs">
                <button class="profile-tab active" data-tab="personal">Personal Information</button>
                <button class="profile-tab" data-tab="account">Account Settings</button>
                <button class="profile-tab" data-tab="security">Security</button>
                <button class="profile-tab" data-tab="notifications">Notifications</button>
            </div>

            <!-- Tab Content -->
            <div class="profile-tab-content">
                <!-- Personal Information -->
                <div class="tab-pane active" id="personal">
                    <div class="settings-card">
                        <h3 class="settings-card-title">Personal Information</h3>
                        <form class="settings-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="Admin" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="User" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" value="admin@lms.com" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" value="+1 234 567 8900" placeholder="Phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" rows="4" placeholder="Tell us about yourself...">System Administrator with 5+ years of experience in managing educational platforms.</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="tab-pane" id="account">
                    <div class="settings-card">
                        <h3 class="settings-card-title">Account Settings</h3>
                        <form class="settings-form">
                            <div class="form-group">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" value="admin_user" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Language</label>
                                <select class="form-select">
                                    <option selected>English</option>
                                    <option>Spanish</option>
                                    <option>French</option>
                                    <option>German</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Timezone</label>
                                <select class="form-select">
                                    <option selected>UTC-5 (Eastern Time)</option>
                                    <option>UTC-8 (Pacific Time)</option>
                                    <option>UTC+0 (GMT)</option>
                                    <option>UTC+1 (Central European Time)</option>
                                </select>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security -->
                <div class="tab-pane" id="security">
                    <div class="settings-card">
                        <h3 class="settings-card-title">Change Password</h3>
                        <form class="settings-form">
                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" placeholder="Enter current password">
                            </div>
                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" placeholder="Confirm new password">
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Update Password</button>
                            </div>
                        </form>
                    </div>

                    <div class="settings-card" style="margin-top: 1.5rem;">
                        <h3 class="settings-card-title">Two-Factor Authentication</h3>
                        <p style="color: var(--text-secondary); margin-bottom: 1rem;">Add an extra layer of security to your account</p>
                        <button class="btn-outline-primary">Enable 2FA</button>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="tab-pane" id="notifications">
                    <div class="settings-card">
                        <h3 class="settings-card-title">Email Notifications</h3>
                        <div class="notification-settings">
                            <div class="notification-item">
                                <div>
                                    <h4 class="notification-title">New User Registration</h4>
                                    <p class="notification-desc">Get notified when a new user registers</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="notification-item">
                                <div>
                                    <h4 class="notification-title">Course Submissions</h4>
                                    <p class="notification-desc">Get notified about new course submissions</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="notification-item">
                                <div>
                                    <h4 class="notification-title">System Updates</h4>
                                    <p class="notification-desc">Receive updates about system maintenance</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
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

<style>
.profile-container {
    max-width: 1000px;
    margin: 0 auto;
}

.profile-card {
    background: var(--bg-card);
    border-radius: 1rem;
    padding: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
}

.profile-avatar-section {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.profile-avatar-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid var(--primary);
}

.profile-info-section {
    flex: 1;
}

.profile-name {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-main);
    margin: 0 0 0.5rem 0;
}

.profile-role {
    color: var(--text-secondary);
    margin: 0 0 1.5rem 0;
}

.profile-stats {
    display: flex;
    gap: 2rem;
}

.profile-stat-item {
    display: flex;
    flex-direction: column;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.profile-tabs {
    display: flex;
    gap: 0.5rem;
    border-bottom: 2px solid rgba(255, 255, 255, 0.05);
    margin-bottom: 2rem;
}

.profile-tab {
    padding: 1rem 1.5rem;
    background: transparent;
    border: none;
    color: var(--text-secondary);
    font-weight: 600;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    transition: all 0.2s;
}

.profile-tab:hover {
    color: var(--text-main);
}

.profile-tab.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.settings-card {
    background: var(--bg-card);
    border-radius: 1rem;
    padding: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.settings-card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-main);
    margin: 0 0 1.5rem 0;
}

.settings-form .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.settings-form .form-group {
    margin-bottom: 1.5rem;
}

.settings-form .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.notification-settings {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.notification-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 0.5rem;
}

.notification-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-main);
    margin: 0 0 0.25rem 0;
}

.notification-desc {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
}

.toggle-switch {
    position: relative;
    width: 52px;
    height: 28px;
    cursor: pointer;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 28px;
    transition: all 0.2s;
}

.toggle-slider:before {
    content: '';
    position: absolute;
    height: 22px;
    width: 22px;
    left: 3px;
    bottom: 3px;
    background: white;
    border-radius: 50%;
    transition: all 0.2s;
}

.toggle-switch input:checked + .toggle-slider {
    background: var(--primary);
}

.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(24px);
}

@media (max-width: 768px) {
    .profile-card {
        flex-direction: column;
        text-align: center;
    }

    .profile-stats {
        justify-content: center;
    }

    .settings-form .form-row {
        grid-template-columns: 1fr;
    }

    .profile-tabs {
        overflow-x: auto;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabs = document.querySelectorAll('.profile-tab');
    const panes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.dataset.tab;

            tabs.forEach(t => t.classList.remove('active'));
            panes.forEach(p => p.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });

    // Form submissions (demo)
    document.querySelectorAll('.settings-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Settings saved successfully! (Static demo)');
        });
    });
});
</script>
