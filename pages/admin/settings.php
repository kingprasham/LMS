<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Platform Settings', ['css/dashboard.css', 'css/admin-users.css', 'css/admin-analytics.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('settings'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Platform Settings</h1>
                <p class="dashboard-subtitle">Configure system-wide settings</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Settings Tabs -->
        <div class="settings-tabs fade-in-up" style="animation-delay: 0.1s">
            <button class="settings-tab active" data-tab="general">
                <i class="bi bi-gear-fill" style="margin-right: 0.5rem;"></i>
                General
            </button>
            <button class="settings-tab" data-tab="email">
                <i class="bi bi-envelope-fill" style="margin-right: 0.5rem;"></i>
                Email
            </button>
            <button class="settings-tab" data-tab="payment">
                <i class="bi bi-credit-card-fill" style="margin-right: 0.5rem;"></i>
                Payment
            </button>
            <button class="settings-tab" data-tab="security">
                <i class="bi bi-shield-lock-fill" style="margin-right: 0.5rem;"></i>
                Security
            </button>
            <button class="settings-tab" data-tab="appearance">
                <i class="bi bi-palette-fill" style="margin-right: 0.5rem;"></i>
                Appearance
            </button>
        </div>

        <!-- General Tab -->
        <div class="settings-tab-content active" id="general-tab">
            <div class="settings-section">
                <div class="settings-section-header">
                    <h3 class="settings-section-title">General Settings</h3>
                </div>
                <p class="settings-section-desc">Basic platform configuration</p>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Site Name</label>
                        <input type="text" class="form-input" value="SAS-AI Learning Management System" placeholder="Enter site name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contact Email</label>
                        <input type="email" class="form-input" value="admin@sas-ai.in" placeholder="Enter contact email">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Time Zone</label>
                        <select class="form-select">
                            <option>UTC</option>
                            <option selected>Asia/Kolkata (IST)</option>
                            <option>America/New_York (EST)</option>
                            <option>Europe/London (GMT)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Language</label>
                        <select class="form-select">
                            <option selected>English</option>
                            <option>Hindi</option>
                            <option>Spanish</option>
                        </select>
                    </div>
                </div>

                <div class="sticky-save-bar">
                    <span class="save-status">Last saved: 2 minutes ago</span>
                    <div class="save-actions">
                        <button class="btn-secondary">Reset</button>
                        <button class="btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Tab -->
        <div class="settings-tab-content" id="email-tab">
            <div class="settings-section">
                <div class="settings-section-header">
                    <h3 class="settings-section-title">Email Configuration</h3>
                </div>
                <p class="settings-section-desc">Configure SMTP and email settings</p>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">SMTP Host</label>
                        <input type="text" class="form-input" value="smtp.gmail.com" placeholder="smtp.example.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">SMTP Port</label>
                        <input type="number" class="form-input" value="587" placeholder="587">
                    </div>
                    <div class="form-group">
                        <label class="form-label">SMTP Username</label>
                        <input type="text" class="form-input" value="noreply@sas-ai.in">
                    </div>
                    <div class="form-group">
                        <label class="form-label">SMTP Password</label>
                        <div class="masked-input-group">
                            <input type="password" class="form-input masked-input" value="secretpassword123" id="smtpPassword">
                            <button type="button" class="toggle-mask-btn" onclick="togglePassword('smtpPassword')">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="toggle-switch">
                    <div class="toggle-switch-label">
                        <div class="toggle-switch-title">Enable Email Notifications</div>
                        <div class="toggle-switch-desc">Send automated emails for course updates and announcements</div>
                    </div>
                    <label class="toggle-switch-input">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="sticky-save-bar">
                    <span class="save-status">Last saved: 5 minutes ago</span>
                    <div class="save-actions">
                        <button class="btn-secondary">Test Connection</button>
                        <button class="btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Tab -->
        <div class="settings-tab-content" id="payment-tab">
            <div class="settings-section">
                <div class="settings-section-header">
                    <h3 class="settings-section-title">Payment Gateway</h3>
                </div>
                <p class="settings-section-desc">Configure payment processing</p>
                
                <div class="form-group" style="margin-bottom: 2rem;">
                    <label class="form-label">Payment Provider</label>
                    <select class="form-select">
                        <option>Stripe</option>
                        <option>PayPal</option>
                        <option selected>Razorpay</option>
                    </select>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">API Key</label>
                        <div class="masked-input-group">
                            <input type="password" class="form-input masked-input" value="rzp_test_1234567890" id="apiKey">
                            <button type="button" class="toggle-mask-btn" onclick="togglePassword('apiKey')">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">API Secret</label>
                        <div class="masked-input-group">
                            <input type="password" class="form-input masked-input" value="secret_1234567890abcdef" id="apiSecret">
                            <button type="button" class="toggle-mask-btn" onclick="togglePassword('apiSecret')">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="toggle-switch">
                    <div class="toggle-switch-label">
                        <div class="toggle-switch-title">Test Mode</div>
                        <div class="toggle-switch-desc">Use test credentials for payment processing</div>
                    </div>
                    <label class="toggle-switch-input">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="sticky-save-bar">
                    <span class="save-status">Last saved: 10 minutes ago</span>
                    <div class="save-actions">
                        <button class="btn-secondary">Reset</button>
                        <button class="btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Tab -->
        <div class="settings-tab-content" id="security-tab">
            <div class="settings-section">
                <div class="settings-section-header">
                    <h3 class="settings-section-title">Security Settings</h3>
                </div>
                <p class="settings-section-desc">Configure security and access control</p>
                
                <div class="form-group" style="margin-bottom: 2rem;">
                    <label class="form-label">Session Timeout (minutes)</label>
                    <input type="number" class="form-input" value="30" style="max-width: 200px;">
                </div>

                <div class="toggle-switch">
                    <div class="toggle-switch-label">
                        <div class="toggle-switch-title">Require 2FA for Admins</div>
                        <div class="toggle-switch-desc">Enforce two-factor authentication for admin accounts</div>
                    </div>
                    <label class="toggle-switch-input">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="toggle-switch">
                    <div class="toggle-switch-label">
                        <div class="toggle-switch-title">Strong Password Policy</div>
                        <div class="toggle-switch-desc">Require minimum 8 characters with special characters</div>
                    </div>
                    <label class="toggle-switch-input">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="toggle-switch">
                    <div class="toggle-switch-label">
                        <div class="toggle-switch-title">Login Attempt Limit</div>
                        <div class="toggle-switch-desc">Lock account after 5 failed login attempts</div>
                    </div>
                    <label class="toggle-switch-input">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="sticky-save-bar">
                    <span class="save-status">Last saved: Just now</span>
                    <div class="save-actions">
                        <button class="btn-secondary">Reset</button>
                        <button class="btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appearance Tab -->
        <div class="settings-tab-content" id="appearance-tab">
            <div class="settings-section">
                <div class="settings-section-header">
                    <h3 class="settings-section-title">Appearance Settings</h3>
                </div>
                <p class="settings-section-desc">Customize the look and feel of your platform</p>
                
                <div class="form-group" style="margin-bottom: 2rem;">
                    <label class="form-label">Platform Logo</label>
                    <div class="logo-upload-container">
                        <div class="logo-preview">
                            <div class="logo-preview-placeholder">
                                <i class="bi bi-image"></i>
                                <div>No logo uploaded</div>
                            </div>
                        </div>
                        <div class="logo-upload-actions">
                            <button class="upload-btn">
                                <i class="bi bi-upload" style="margin-right: 0.5rem;"></i>
                                Upload Logo
                            </button>
                            <button class="remove-btn">
                                <i class="bi bi-trash" style="margin-right: 0.5rem;"></i>
                                Remove
                            </button>
                            <small style="color: var(--text-secondary); margin-top: 0.5rem;">
                                Recommended: 200x60px, PNG or SVG
                            </small>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 2rem;">
                    <label class="form-label">Primary Brand Color</label>
                    <div class="color-picker-group">
                        <label class="color-picker-wrapper">
                            <input type="color" class="color-picker-input" value="#4f46e5" id="primaryColor">
                            <div class="color-picker-display" style="background-color: #4f46e5;"></div>
                        </label>
                        <span class="color-value">#4f46e5</span>
                    </div>
                </div>

                <div class="sticky-save-bar">
                    <span class="save-status">Unsaved changes</span>
                    <div class="save-actions">
                        <button class="btn-secondary">Reset to Default</button>
                        <button class="btn-primary">Save Changes</button>
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
    // Tab switching
    document.querySelectorAll('.settings-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.settings-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.settings-tab-content').forEach(c => c.classList.remove('active'));
            
            tab.classList.add('active');
            const tabId = tab.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Color picker update
    const primaryColor = document.getElementById('primaryColor');
    if (primaryColor) {
        primaryColor.addEventListener('input', (e) => {
            e.target.nextElementSibling.style.backgroundColor = e.target.value;
            e.target.closest('.color-picker-group').querySelector('.color-value').textContent = e.target.value;
        });
    }

    // Mobile sidebar toggle
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            }
        });
    }
});

//Toggle password visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    const btn = input.nextElementSibling;
    const icon = btn.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye-fill');
        icon.classList.add('bi-eye-slash-fill');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash-fill');
        icon.classList.add('bi-eye-fill');
    }
}
</script>
