<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Order Successful - Thank You!', ['css/order-success.css']);
renderNavbar();
?>

    <!-- Order Success Section -->
    <section class="order-success-section">
        <div class="order-success-container">
            <!-- Success Animation -->
            <div class="success-animation fade-in-up">
                <div class="success-checkmark">
                    <div class="check-icon">
                        <span class="icon-line line-tip"></span>
                        <span class="icon-line line-long"></span>
                        <div class="icon-circle"></div>
                        <div class="icon-fix"></div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <div class="success-content fade-in-up" style="animation-delay: 0.3s">
                <h1 class="success-title">Payment Successful!</h1>
                <p class="success-subtitle">Thank you for your purchase. Your order has been confirmed.</p>

                <div class="order-number">
                    <span class="order-label">Order Number:</span>
                    <span class="order-value" id="order-number">#ORD-2024-XXXXX</span>
                </div>

                <p class="success-description">
                    A confirmation email has been sent to your registered email address with order details and access instructions.
                </p>
            </div>

            <!-- Order Details Card -->
            <div class="order-details-card fade-in-up" style="animation-delay: 0.5s">
                <h2 class="card-title">
                    <i class="bi bi-receipt"></i>
                    Order Details
                </h2>

                <div class="order-items-list" id="order-items-list">
                    <!-- Items will be loaded dynamically -->
                </div>

                <div class="order-summary">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span id="order-subtotal">₹0</span>
                    </div>
                    <div class="summary-row discount-row">
                        <span>Discount:</span>
                        <span id="order-discount">-₹0</span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row total-row">
                        <span><strong>Total Paid:</strong></span>
                        <span><strong id="order-total">₹0</strong></span>
                    </div>
                </div>
            </div>

            <!-- What's Next Section -->
            <div class="whats-next-card fade-in-up" style="animation-delay: 0.7s">
                <h2 class="card-title">
                    <i class="bi bi-lightbulb-fill"></i>
                    What's Next?
                </h2>

                <div class="next-steps">
                    <div class="next-step">
                        <div class="step-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="step-content">
                            <h3>Check Your Email</h3>
                            <p>You'll receive a confirmation email with your order details and access instructions within 5 minutes.</p>
                        </div>
                    </div>

                    <div class="next-step">
                        <div class="step-icon">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <div class="step-content">
                            <h3>Access Your Courses</h3>
                            <p>Visit your dashboard to start learning immediately. All your purchased courses are now available.</p>
                        </div>
                    </div>

                    <div class="next-step">
                        <div class="step-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <div class="step-content">
                            <h3>Start Learning</h3>
                            <p>Begin your learning journey and earn certificates upon completion of each course.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons fade-in-up" style="animation-delay: 0.9s">
                <a href="<?php echo url('pages/dashboard.php'); ?>" class="btn-primary-action">
                    <i class="bi bi-grid-fill"></i>
                    Go to Dashboard
                </a>
                <a href="<?php echo url('index.php'); ?>" class="btn-secondary-action">
                    <i class="bi bi-house-fill"></i>
                    Back to Home
                </a>
            </div>

            <!-- Support Section -->
            <div class="support-section fade-in-up" style="animation-delay: 1.1s">
                <div class="support-content">
                    <i class="bi bi-headset"></i>
                    <div class="support-text">
                        <strong>Need Help?</strong>
                        <p>Our support team is available 24/7 to assist you.</p>
                    </div>
                    <a href="<?php echo url('pages/contact.php'); ?>" class="btn-support">Contact Support</a>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/order-success.js']); ?>
