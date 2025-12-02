<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

// In production, validate the token from URL parameter
// $token = $_GET['token'] ?? '';

renderHead('Reset Password - SAS-AI', ['css/auth.css']);
renderNavbar();
?>

    <div class="auth-container">
        <div class="auth-box">
            <button class="close-btn" onclick="window.location.href='../index.php'"><i class="bi bi-x"></i></button>

            <div class="auth-logo">
                <span class="logo-text">SAS<span class="logo-ai">-AI</span></span>
            </div>

            <!-- Step 1: Reset Password Form (default view) -->
            <div id="reset-step">
                <h1>Create new password</h1>
                <p class="auth-subtitle">Your new password must be different from previously used passwords.</p>

                <form id="reset-password-form" class="auth-form">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="form-control" id="new-password" placeholder="Enter new password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('new-password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <small class="form-text text-muted">Must be at least 8 characters</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="form-control" id="confirm-password" placeholder="Re-enter password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirm-password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Password Strength Indicator -->
                    <div id="password-strength" class="password-strength" style="display: none;">
                        <div class="strength-meter">
                            <div class="strength-meter-fill"></div>
                        </div>
                        <small class="strength-text"></small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">Reset Password</button>
                </form>
            </div>

            <!-- Step 2: Success Message (hidden by default) -->
            <div id="success-step" style="display: none;">
                <div class="success-icon-wrapper">
                    <div class="success-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <h2 style="text-align: center; color: #1c1d1f; margin-top: 20px;">Password reset successful</h2>
                <p style="text-align: center; color: #6a6f73; margin-bottom: 30px;">
                    Your password has been successfully reset. You can now log in with your new password.
                </p>
                <button class="btn btn-primary w-100" onclick="window.location.href='login.php'">
                    Go to Login
                </button>
            </div>
        </div>
    </div>

<?php renderFooter(); ?>
<?php renderScripts(['js/reset-password.js']); ?>
