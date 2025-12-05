<?php
include('../config.php');
require_once('../includes/session.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Shopping Cart - AiCureAcademy', ['css/cart.css']);
renderNavbar();
?>
<script>
window.isLoggedIn = <?php echo (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) ? 'true' : 'false'; ?>;
</script>

    <!-- Cart Header Section -->
    <section class="cart-header-section">
        <div class="cart-header-container fade-in-up">
            <h1 class="cart-main-title">Shopping Cart</h1>
            <p class="cart-subtitle">3 courses ready for checkout</p>
        </div>
    </section>

    <!-- Main Cart Content -->
    <section class="cart-main-section">
        <div class="cart-wrapper">
            <!-- Left Column - Cart Items -->
            <div class="cart-left-column">
                <!-- Cart Items List -->
                <div class="cart-items-container fade-in-up">
                    <!-- Cart items will be loaded dynamically by cart.js from the database -->
                </div>
            </div>


            <!-- Right Column - Summary -->
            <div class="cart-right-column">
                <div class="cart-summary-sticky fade-in-up" style="animation-delay: 0.1s">
                    <h3 class="summary-title">Order Summary</h3>

                    <div class="summary-pricing">
                        <div class="summary-row">
                            <span>Original Price:</span>
                            <span>₹9,597</span>
                        </div>
                        <div class="summary-row discount-row">
                            <span>Discount (86%):</span>
                            <span>-₹8,232</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total-row">
                            <span><strong>Total:</strong></span>
                            <span><strong>₹1,365</strong></span>
                        </div>
                    </div>

                    <button class="btn-checkout" onclick="window.location.href='payment.php'">
                        <i class="bi bi-lock-fill"></i>
                        Proceed to Checkout
                    </button>

                    <div class="promo-section">
                        <h4 class="promo-title">Have a coupon?</h4>
                        <div class="promo-input-wrapper">
                            <input type="text" class="promo-input" placeholder="Enter coupon code">
                            <button class="btn-apply-promo">Apply</button>
                        </div>
                        <div class="promo-applied" style="display:none;">
                            <i class="bi bi-check-circle-fill"></i>
                            <span><strong>SAVE20</strong> applied!</span>
                            <button class="btn-remove-promo"><i class="bi bi-x"></i></button>
                        </div>
                    </div>

                    <div class="guarantee-section">
                        <i class="bi bi-shield-check-fill"></i>
                        <div class="guarantee-text">
                            <strong>30-Day Money-Back Guarantee</strong>
                            <p>Full refund, no questions asked</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/cart.js']); ?>
