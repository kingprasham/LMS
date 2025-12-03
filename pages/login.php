<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Log In - AiCureAcademy', ['css/auth.css']);
renderNavbar();
?>

    <div class="auth-container">
        <div class="auth-box">
            <button class="close-btn" onclick="window.location.href='../index.php'"><i class="bi bi-x"></i></button>

            <div class="auth-logo">
                <span class="logo-text">AiCure<span class="logo-ai">Academy</span></span>
            </div>

            <h1>Log in to your AiCureAcademy account</h1>

            <form id="login-form" class="auth-form">
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </form>

            <div class="divider">
                <span>or</span>
            </div>

            <button class="btn btn-outline-dark w-100 mb-2 social-btn">
                <i class="bi bi-google"></i> Continue with Google
            </button>
            <button class="btn btn-outline-dark w-100 mb-2 social-btn">
                <i class="bi bi-facebook"></i> Continue with Facebook
            </button>
            <button class="btn btn-outline-dark w-100 social-btn">
                <i class="bi bi-apple"></i> Continue with Apple
            </button>

            <p class="text-center mt-4">
                Don't have an account? <a href="signup.php">Sign up</a>
            </p>
            <p class="text-center">
                <a href="forgot-password.php" class="text-decoration-none">Forgot Password</a>
            </p>
        </div>
    </div>

<?php renderFooter(); ?>
<?php renderScripts(['js/auth.js']); ?>
