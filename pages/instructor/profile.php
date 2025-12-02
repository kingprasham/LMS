<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('My Profile', ['css/dashboard.css', 'css/admin-users.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('profile'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">My Profile</h1>
                <p class="dashboard-subtitle">Manage your instructor profile and settings</p>
            </div>
        </div>

        <!-- Profile Container -->
        <div class="profile-container fade-in-up" style="animation-delay: 0.1s">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-avatar-section">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=10b981&color=fff&size=120" alt="Profile" class="profile-avatar-large">
                    <button class="btn-outline-primary btn-sm" style="margin-top: 1rem;">Change Photo</button>
                </div>
                <div class="profile-info-section">
                    <h2 class="profile-name">John Doe</h2>
                    <p class="profile-role">Instructor - Web Development</p>
                    <div class="profile-stats">
                        <div class="profile-stat-item">
                            <span class="stat-value">8</span>
                            <span class="stat-label">Courses</span>
                        </div>
                        <div class="profile-stat-item">
                            <span class="stat-value">1,234</span>
                            <span class="stat-label">Students</span>
                        </div>
                        <div class="profile-stat-item">
                            <span class="stat-value">4.8</span>
                            <span class="stat-label">Rating</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="profile-tabs">
                <button class="profile-tab active" data-tab="personal">Personal Information</button>
                <button class="profile-tab" data-tab="professional">Professional Info</button>
                <button class="profile-tab" data-tab="account">Account Settings</button>
                <button class="profile-tab" data-tab="security">Security</button>
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
                                    <input type="text" class="form-control" value="John" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="Doe" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" value="john.doe@lms.com" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" value="+1 234 567 8900" placeholder="Phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" rows="4" placeholder="Tell students about yourself...">Passionate web developer with 10+ years of experience teaching modern web technologies. Specialized in React, Node.js, and full-stack development.</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Professional Info -->
                <div class="tab-pane" id="professional">
                    <div class="settings-card">
                        <h3 class="settings-card-title">Professional Information</h3>
                        <form class="settings-form">
                            <div class="form-group">
                                <label class="form-label">Job Title</label>
                                <input type="text" class="form-control" value="Senior Web Developer" placeholder="Job Title">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Expertise Areas</label>
                                <input type="text" class="form-control" value="Web Development, React, Node.js, JavaScript" placeholder="Comma-separated expertise">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Years of Experience</label>
                                <select class="form-select">
                                    <option>1-2 years</option>
                                    <option>3-5 years</option>
                                    <option>5-10 years</option>
                                    <option selected>10+ years</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">LinkedIn Profile</label>
                                <input type="url" class="form-control" value="https://linkedin.com/in/johndoe" placeholder="LinkedIn URL">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Website/Portfolio</label>
                                <input type="url" class="form-control" value="https://johndoe.dev" placeholder="Website URL">
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
                                <input type="text" class="form-control" value="john_doe" placeholder="Username">
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
                            <div class="form-group">
                                <label class="form-label">Email Visibility</label>
                                <select class="form-select">
                                    <option>Public</option>
                                    <option selected>Students Only</option>
                                    <option>Private</option>
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
    border: 4px solid #10b981;
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
