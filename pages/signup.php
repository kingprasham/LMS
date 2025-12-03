<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Sign Up - AiCureAcademy', ['css/auth.css']);
renderNavbar();
?>

    <div class="auth-container">
        <div class="auth-box">
            <button class="close-btn" onclick="window.location.href='../index.php'"><i class="bi bi-x"></i></button>

            <div class="auth-logo">
                <span class="logo-text">AiCure<span class="logo-ai">Academy</span></span>
            </div>

            <h1>Sign up and start learning</h1>

            <form id="signup-form" class="auth-form">
                <div class="mb-3">
                    <input type="text" class="form-control" id="fullname" placeholder="Full Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="newsletter">
                    <label class="form-check-label" for="newsletter">
                        Send me special offers, personalized recommendations, and learning tips.
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            </form>

            <p class="terms-text">
                By signing up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
            </p>

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
                Already have an account? <a href="login.php">Log in</a>
            </p>
        </div>
    </div>

<?php renderFooter(); ?>
<?php renderScripts(['js/auth.js']); ?>
