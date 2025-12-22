<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Platform Settings', ['css/dashboard.css', 'css/admin-settings.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('settings'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Platform Settings</h1>
                <p class="dashboard-subtitle">Configure system-wide settings and preferences</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Settings Navigation -->
        <div class="settings-nav fade-in-up" style="animation-delay: 0.1s">
            <button class="settings-nav-btn active" data-tab="general">
                <i class="bi bi-gear-fill"></i>
                <span>General</span>
            </button>
            <button class="settings-nav-btn" data-tab="email">
                <i class="bi bi-envelope-fill"></i>
                <span>Email</span>
            </button>
            <button class="settings-nav-btn" data-tab="payment">
                <i class="bi bi-credit-card-fill"></i>
                <span>Payment</span>
            </button>
            <button class="settings-nav-btn" data-tab="security">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Security</span>
            </button>
            <button class="settings-nav-btn" data-tab="appearance">
                <i class="bi bi-palette-fill"></i>
                <span>Appearance</span>
            </button>
        </div>

        <!-- General Tab -->
        <div class="settings-panel active" id="general-panel">
            <div class="settings-card fade-in-up" style="animation-delay: 0.2s">
                <div class="settings-card-header">
                    <div class="settings-card-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>Platform Information</h3>
                        <p>Basic information about your learning platform</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-form-grid">
                        <div class="settings-form-group">
                            <label class="settings-label">Platform Name</label>
                            <input type="text" class="settings-input" value="AICure Academy" placeholder="Enter platform name">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Support Email</label>
                            <input type="email" class="settings-input" value="support@aicureacademy.com" placeholder="Enter support email">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Contact Phone</label>
                            <input type="tel" class="settings-input" value="+91 9876543210" placeholder="Enter contact phone">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Website URL</label>
                            <input type="url" class="settings-input" value="https://aicureacademy.com" placeholder="Enter website URL">
                        </div>
                    </div>
                    <div class="settings-form-group full-width">
                        <label class="settings-label">Platform Description</label>
                        <textarea class="settings-textarea" rows="3" placeholder="Enter platform description">AICure Academy is a premier online learning platform specializing in AI, Machine Learning, and cutting-edge technology courses.</textarea>
                    </div>
                </div>
            </div>

            <div class="settings-card fade-in-up" style="animation-delay: 0.3s">
                <div class="settings-card-header">
                    <div class="settings-card-icon blue">
                        <i class="bi bi-globe2"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>Regional Settings</h3>
                        <p>Configure timezone and language preferences</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-form-grid">
                        <div class="settings-form-group">
                            <label class="settings-label">Timezone</label>
                            <select class="settings-select">
                                <option>UTC</option>
                                <option selected>Asia/Kolkata (IST)</option>
                                <option>America/New_York (EST)</option>
                                <option>Europe/London (GMT)</option>
                                <option>Asia/Singapore (SGT)</option>
                            </select>
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Default Language</label>
                            <select class="settings-select">
                                <option selected>English</option>
                                <option>Hindi</option>
                                <option>Spanish</option>
                                <option>French</option>
                            </select>
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Date Format</label>
                            <select class="settings-select">
                                <option selected>DD/MM/YYYY</option>
                                <option>MM/DD/YYYY</option>
                                <option>YYYY-MM-DD</option>
                            </select>
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Currency</label>
                            <select class="settings-select">
                                <option selected>INR (₹)</option>
                                <option>USD ($)</option>
                                <option>EUR (€)</option>
                                <option>GBP (£)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="settings-save-bar">
                <div class="save-status">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>All changes saved</span>
                </div>
                <div class="save-actions">
                    <button class="btn-settings-secondary">Reset to Default</button>
                    <button class="btn-settings-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Email Tab -->
        <div class="settings-panel" id="email-panel">
            <div class="settings-card fade-in-up">
                <div class="settings-card-header">
                    <div class="settings-card-icon green">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>SMTP Configuration</h3>
                        <p>Configure your email server settings</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-form-grid">
                        <div class="settings-form-group">
                            <label class="settings-label">SMTP Host</label>
                            <input type="text" class="settings-input" value="smtp.gmail.com" placeholder="smtp.example.com">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">SMTP Port</label>
                            <input type="number" class="settings-input" value="587" placeholder="587">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">SMTP Username</label>
                            <input type="text" class="settings-input" value="noreply@aicureacademy.com" placeholder="your-email@example.com">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">SMTP Password</label>
                            <div class="settings-input-group">
                                <input type="password" class="settings-input" value="secretpassword123" id="smtpPassword">
                                <button type="button" class="input-toggle-btn" onclick="togglePassword('smtpPassword')">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="settings-form-group">
                        <label class="settings-label">Encryption</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="encryption" value="tls" checked>
                                <span class="radio-label">TLS</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="encryption" value="ssl">
                                <span class="radio-label">SSL</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="encryption" value="none">
                                <span class="radio-label">None</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="settings-card fade-in-up">
                <div class="settings-card-header">
                    <div class="settings-card-icon orange">
                        <i class="bi bi-bell-fill"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>Email Notifications</h3>
                        <p>Configure automated email notifications</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Welcome Emails</h4>
                            <p>Send welcome email to new users upon registration</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Course Enrollment</h4>
                            <p>Notify users when they enroll in a new course</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Course Completion</h4>
                            <p>Send certificate email upon course completion</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Marketing Emails</h4>
                            <p>Send promotional emails and course recommendations</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-save-bar">
                <div class="save-status">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>All changes saved</span>
                </div>
                <div class="save-actions">
                    <button class="btn-settings-secondary">Test Connection</button>
                    <button class="btn-settings-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Payment Tab -->
        <div class="settings-panel" id="payment-panel">
            <div class="settings-card fade-in-up">
                <div class="settings-card-header">
                    <div class="settings-card-icon purple">
                        <i class="bi bi-credit-card-2-front-fill"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>Payment Gateway</h3>
                        <p>Configure your payment processing settings</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-form-group">
                        <label class="settings-label">Payment Provider</label>
                        <div class="payment-providers">
                            <label class="payment-provider-option active">
                                <input type="radio" name="provider" value="razorpay" checked>
                                <div class="provider-card">
                                    <img src="https://razorpay.com/assets/razorpay-glyph.svg" alt="Razorpay">
                                    <span>Razorpay</span>
                                </div>
                            </label>
                            <label class="payment-provider-option">
                                <input type="radio" name="provider" value="stripe">
                                <div class="provider-card">
                                    <i class="bi bi-stripe"></i>
                                    <span>Stripe</span>
                                </div>
                            </label>
                            <label class="payment-provider-option">
                                <input type="radio" name="provider" value="paypal">
                                <div class="provider-card">
                                    <i class="bi bi-paypal"></i>
                                    <span>PayPal</span>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="settings-form-grid">
                        <div class="settings-form-group">
                            <label class="settings-label">API Key</label>
                            <div class="settings-input-group">
                                <input type="password" class="settings-input" value="rzp_test_1234567890" id="apiKey">
                                <button type="button" class="input-toggle-btn" onclick="togglePassword('apiKey')">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">API Secret</label>
                            <div class="settings-input-group">
                                <input type="password" class="settings-input" value="secret_1234567890abcdef" id="apiSecret">
                                <button type="button" class="input-toggle-btn" onclick="togglePassword('apiSecret')">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Test Mode</h4>
                            <p>Use sandbox/test credentials for development</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-card fade-in-up">
                <div class="settings-card-header">
                    <div class="settings-card-icon cyan">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>Pricing & Tax</h3>
                        <p>Configure tax and pricing settings</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-form-grid">
                        <div class="settings-form-group">
                            <label class="settings-label">Tax Rate (%)</label>
                            <input type="number" class="settings-input" value="18" placeholder="18">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Tax Name</label>
                            <input type="text" class="settings-input" value="GST" placeholder="GST">
                        </div>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Include Tax in Price</h4>
                            <p>Display prices with tax included</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-save-bar">
                <div class="save-status">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>All changes saved</span>
                </div>
                <div class="save-actions">
                    <button class="btn-settings-secondary">Reset</button>
                    <button class="btn-settings-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Security Tab -->
        <div class="settings-panel" id="security-panel">
            <div class="settings-card fade-in-up">
                <div class="settings-card-header">
                    <div class="settings-card-icon red">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>Authentication Settings</h3>
                        <p>Configure login and authentication options</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-form-grid">
                        <div class="settings-form-group">
                            <label class="settings-label">Session Timeout (minutes)</label>
                            <input type="number" class="settings-input" value="30" placeholder="30">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Max Login Attempts</label>
                            <input type="number" class="settings-input" value="5" placeholder="5">
                        </div>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Two-Factor Authentication</h4>
                            <p>Require 2FA for admin accounts</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Strong Password Policy</h4>
                            <p>Require minimum 8 characters with special characters</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Account Lockout</h4>
                            <p>Lock accounts after failed login attempts</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-card fade-in-up">
                <div class="settings-card-header">
                    <div class="settings-card-icon indigo">
                        <i class="bi bi-key-fill"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>API Security</h3>
                        <p>Manage API access and rate limiting</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-form-grid">
                        <div class="settings-form-group">
                            <label class="settings-label">Rate Limit (requests/minute)</label>
                            <input type="number" class="settings-input" value="60" placeholder="60">
                        </div>
                        <div class="settings-form-group">
                            <label class="settings-label">Token Expiry (hours)</label>
                            <input type="number" class="settings-input" value="24" placeholder="24">
                        </div>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Enable API Access</h4>
                            <p>Allow external API access to platform data</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-save-bar">
                <div class="save-status">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>All changes saved</span>
                </div>
                <div class="save-actions">
                    <button class="btn-settings-secondary">Reset</button>
                    <button class="btn-settings-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Appearance Tab -->
        <div class="settings-panel" id="appearance-panel">
            <div class="settings-card fade-in-up">
                <div class="settings-card-header">
                    <div class="settings-card-icon pink">
                        <i class="bi bi-image"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>Branding</h3>
                        <p>Customize your platform's visual identity</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="logo-upload-section">
                        <div class="logo-preview-box">
                            <div class="logo-placeholder">
                                <i class="bi bi-image"></i>
                                <span>No logo uploaded</span>
                            </div>
                        </div>
                        <div class="logo-upload-info">
                            <h4>Platform Logo</h4>
                            <p>Upload your logo. Recommended size: 200x60px</p>
                            <div class="logo-actions">
                                <button class="btn-settings-primary small">
                                    <i class="bi bi-upload"></i>
                                    Upload Logo
                                </button>
                                <button class="btn-settings-danger small">
                                    <i class="bi bi-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="settings-card fade-in-up">
                <div class="settings-card-header">
                    <div class="settings-card-icon gradient">
                        <i class="bi bi-palette2"></i>
                    </div>
                    <div class="settings-card-title">
                        <h3>Theme Colors</h3>
                        <p>Customize your platform's color scheme</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="color-picker-grid">
                        <div class="color-picker-item">
                            <label class="settings-label">Primary Color</label>
                            <div class="color-picker-wrapper">
                                <input type="color" value="#4f46e5" id="primaryColor">
                                <span class="color-value">#4f46e5</span>
                            </div>
                        </div>
                        <div class="color-picker-item">
                            <label class="settings-label">Secondary Color</label>
                            <div class="color-picker-wrapper">
                                <input type="color" value="#64748b" id="secondaryColor">
                                <span class="color-value">#64748b</span>
                            </div>
                        </div>
                        <div class="color-picker-item">
                            <label class="settings-label">Accent Color</label>
                            <div class="color-picker-wrapper">
                                <input type="color" value="#10b981" id="accentColor">
                                <span class="color-value">#10b981</span>
                            </div>
                        </div>
                    </div>
                    <div class="toggle-setting">
                        <div class="toggle-info">
                            <h4>Dark Mode</h4>
                            <p>Enable dark mode for the admin dashboard</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-save-bar">
                <div class="save-status unsaved">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>Unsaved changes</span>
                </div>
                <div class="save-actions">
                    <button class="btn-settings-secondary">Reset to Default</button>
                    <button class="btn-settings-primary">Save Changes</button>
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
    const navBtns = document.querySelectorAll('.settings-nav-btn');
    const panels = document.querySelectorAll('.settings-panel');
    
    navBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active from all buttons and panels
            navBtns.forEach(b => b.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));
            
            // Add active to clicked button
            btn.classList.add('active');
            
            // Show corresponding panel
            const tabId = btn.getAttribute('data-tab') + '-panel';
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Color picker updates
    document.querySelectorAll('input[type="color"]').forEach(picker => {
        picker.addEventListener('input', (e) => {
            const wrapper = e.target.closest('.color-picker-wrapper');
            if (wrapper) {
                wrapper.querySelector('.color-value').textContent = e.target.value;
            }
        });
    });

    // Payment provider selection
    document.querySelectorAll('.payment-provider-option input').forEach(radio => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('.payment-provider-option').forEach(opt => {
                opt.classList.remove('active');
            });
            radio.closest('.payment-provider-option').classList.add('active');
        });
    });

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

// Toggle password visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    const btn = input.parentElement.querySelector('.input-toggle-btn');
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
