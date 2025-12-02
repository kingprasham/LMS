<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Forgot Password - SAS-AI', ['css/auth.css']);
renderNavbar();
?>

    <div class="auth-container">
        <div class="auth-box">
            <button class="close-btn" onclick="window.location.href='../index.php'"><i class="bi bi-x"></i></button>

            <div class="auth-logo">
                <span class="logo-text">SAS<span class="logo-ai">-AI</span></span>
            </div>

            <h1>Reset your password</h1>
            <p class="auth-subtitle">Enter your email address and we'll send you a link to reset your password.</p>

            <!-- Step 1: Email Input (default view) -->
            <div id="email-step">
                <form id="forgot-password-form" class="auth-form">
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email address" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                </form>

                <p class="text-center mt-4">
                    Remember your password? <a href="login.php">Log in</a>
                </p>
            </div>

            <!-- Step 2: Success Message (hidden by default) -->
            <div id="success-step" style="display: none;">
                <div class="success-icon-wrapper">
                    <div class="success-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <h2 style="text-align: center; color: #1c1d1f; margin-top: 20px;">Check your email</h2>
                <p style="text-align: center; color: #6a6f73; margin-bottom: 30px;">
                    We've sent a password reset link to <strong id="sent-email"></strong>
                </p>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    <div>
                        <strong>Didn't receive the email?</strong>
                        <p style="margin: 5px 0 0 0;">Check your spam folder or <a href="#" id="resend-link">resend the link</a></p>
                    </div>
                </div>
                <button class="btn btn-outline-secondary w-100 mt-3" onclick="window.location.href='login.php'">
                    Back to Login
                </button>
            </div>
        </div>
    </div>

<?php renderFooter(); ?>
<?php renderScripts(['js/forgot-password.js']); ?>
