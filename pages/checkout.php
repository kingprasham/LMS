<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Checkout - Complete Your Purchase', ['css/checkout.css']);
renderNavbar();
?>

    <!-- Checkout Header Section -->
    <section class="checkout-header-section">
        <div class="checkout-header-container fade-in-up">
            <h1 class="checkout-main-title">Checkout</h1>
            <p class="checkout-subtitle">Complete your purchase securely</p>
        </div>
    </section>

    <!-- Main Checkout Content -->
    <section class="checkout-main-section">
        <div class="checkout-wrapper">
            <!-- Left Column - Billing & Payment -->
            <div class="checkout-left-column">
                <!-- Billing Details -->
                <div class="checkout-card billing-details-card fade-in-up">
                    <h2 class="card-title">
                        <i class="bi bi-person-fill"></i>
                        Billing Details
                    </h2>

                    <form id="billing-form" class="billing-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first-name">First Name <span class="required">*</span></label>
                                <input type="text" id="first-name" name="first_name" class="form-control" placeholder="Enter your first name" required>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name <span class="required">*</span></label>
                                <input type="text" id="last-name" name="last_name" class="form-control" placeholder="Enter your last name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="your.email@example.com" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number <span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="+91 98765 43210" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Street Address <span class="required">*</span></label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="House number and street name" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City <span class="required">*</span></label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="City" required>
                            </div>
                            <div class="form-group">
                                <label for="state">State <span class="required">*</span></label>
                                <input type="text" id="state" name="state" class="form-control" placeholder="State" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="pincode">PIN Code <span class="required">*</span></label>
                                <input type="text" id="pincode" name="pincode" class="form-control" placeholder="000000" required>
                            </div>
                            <div class="form-group">
                                <label for="country">Country <span class="required">*</span></label>
                                <select id="country" name="country" class="form-control" required>
                                    <option value="">Select Country</option>
                                    <option value="IN" selected>India</option>
                                    <option value="US">United States</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="CA">Canada</option>
                                    <option value="AU">Australia</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Payment Method -->
                <div class="checkout-card payment-method-card fade-in-up" style="animation-delay: 0.1s">
                    <h2 class="card-title">
                        <i class="bi bi-credit-card-fill"></i>
                        Payment Method
                    </h2>

                    <div class="payment-methods">
                        <!-- Credit/Debit Card -->
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="card" checked>
                            <div class="payment-option-content">
                                <div class="payment-option-header">
                                    <div class="payment-option-icons">
                                        <i class="bi bi-credit-card-fill"></i>
                                    </div>
                                    <span class="payment-option-title">Credit / Debit Card</span>
                                </div>
                                <div class="payment-card-icons">
                                    <i class="bi bi-credit-card" title="Visa"></i>
                                    <i class="bi bi-credit-card-2-front" title="Mastercard"></i>
                                    <i class="bi bi-credit-card-2-back" title="Amex"></i>
                                </div>
                            </div>
                        </label>

                        <!-- Card Details Form (shown when card is selected) -->
                        <div id="card-details" class="card-details-form">
                            <div class="form-group">
                                <label for="card-number">Card Number <span class="required">*</span></label>
                                <input type="text" id="card-number" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="expiry-date">Expiry Date <span class="required">*</span></label>
                                    <input type="text" id="expiry-date" class="form-control" placeholder="MM/YY" maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV <span class="required">*</span></label>
                                    <input type="text" id="cvv" class="form-control" placeholder="123" maxlength="3">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="card-name">Name on Card <span class="required">*</span></label>
                                <input type="text" id="card-name" class="form-control" placeholder="Full name as on card">
                            </div>
                        </div>

                        <!-- PayPal -->
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="paypal">
                            <div class="payment-option-content">
                                <div class="payment-option-header">
                                    <div class="payment-option-icons paypal-icon">
                                        <i class="bi bi-paypal"></i>
                                    </div>
                                    <span class="payment-option-title">PayPal</span>
                                </div>
                                <p class="payment-option-description">You will be redirected to PayPal to complete your purchase</p>
                            </div>
                        </label>

                        <!-- UPI -->
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="upi">
                            <div class="payment-option-content">
                                <div class="payment-option-header">
                                    <div class="payment-option-icons upi-icon">
                                        <i class="bi bi-phone-fill"></i>
                                    </div>
                                    <span class="payment-option-title">UPI Payment</span>
                                </div>
                                <p class="payment-option-description">Google Pay, PhonePe, Paytm & more</p>
                            </div>
                        </label>

                        <!-- UPI Details Form (shown when UPI is selected) -->
                        <div id="upi-details" class="upi-details-form" style="display: none;">
                            <div class="form-group">
                                <label for="upi-id">UPI ID <span class="required">*</span></label>
                                <input type="text" id="upi-id" class="form-control" placeholder="yourname@upi">
                            </div>
                            <div class="upi-apps">
                                <button type="button" class="upi-app-btn">
                                    <i class="bi bi-google"></i>
                                    Google Pay
                                </button>
                                <button type="button" class="upi-app-btn">
                                    <i class="bi bi-phone-fill"></i>
                                    PhonePe
                                </button>
                                <button type="button" class="upi-app-btn">
                                    <i class="bi bi-wallet2"></i>
                                    Paytm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="terms-section fade-in-up" style="animation-delay: 0.2s">
                    <label class="terms-checkbox">
                        <input type="checkbox" id="terms-agree" required>
                        <span>I agree to the <a href="<?php echo url('pages/terms.php'); ?>">Terms & Conditions</a> and <a href="<?php echo url('pages/privacy-policy.php'); ?>">Privacy Policy</a></span>
                    </label>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="checkout-right-column">
                <div class="order-summary-sticky fade-in-up" style="animation-delay: 0.1s">
                    <h2 class="summary-title">Order Summary</h2>

                    <!-- Order Items List -->
                    <div class="order-items-list" id="order-items-list">
                        <!-- Items will be loaded dynamically -->
                    </div>

                    <div class="summary-divider"></div>

                    <!-- Pricing Summary -->
                    <div class="pricing-summary">
                        <div class="summary-row">
                            <span>Original Price:</span>
                            <span id="summary-original-price">₹0</span>
                        </div>
                        <div class="summary-row discount-row">
                            <span>Discount:</span>
                            <span id="summary-discount">-₹0</span>
                        </div>
                        <div class="summary-row coupon-row" id="summary-coupon-row" style="display: none;">
                            <span>Coupon Discount:</span>
                            <span id="summary-coupon-discount">-₹0</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total-row">
                            <span><strong>Total:</strong></span>
                            <span><strong id="summary-total">₹0</strong></span>
                        </div>
                    </div>

                    <!-- Complete Payment Button -->
                    <button type="submit" class="btn-complete-payment" id="complete-payment-btn">
                        <i class="bi bi-lock-fill"></i>
                        Complete Payment
                    </button>

                    <!-- Security Badge -->
                    <div class="security-badge">
                        <i class="bi bi-shield-fill-check"></i>
                        <div class="security-text">
                            <strong>Secure Payment</strong>
                            <p>Your information is protected with 256-bit SSL encryption</p>
                        </div>
                    </div>

                    <!-- Money-Back Guarantee -->
                    <div class="guarantee-badge">
                        <i class="bi bi-clock-history"></i>
                        <span>30-Day Money-Back Guarantee</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/checkout.js']); ?>
