<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Checkout - AiCureAcademy', ['css/payment.css']);
renderNavbar();
?>

    <!-- Checkout Header Section -->
    <section class="checkout-header-section">
        <div class="checkout-header-container fade-in-up">
            <h1 class="checkout-main-title">Secure Checkout</h1>
            <p class="checkout-subtitle">Complete your purchase and start learning immediately</p>
            <div class="progress-steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <span>Billing</span>
                </div>
                <div class="step-line active"></div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <span>Payment</span>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-number">3</div>
                    <span>Complete</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Checkout Content -->
    <section class="checkout-main-section">
        <div class="checkout-wrapper">
            <!-- Left Column - Forms -->
            <div class="checkout-left-column">
                <!-- Billing Address -->
                <div class="checkout-card fade-in-up">
                    <h2 class="section-title"><i class="bi bi-geo-alt-fill"></i> Billing Address</h2>
                    <form id="billing-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Country *</label>
                                <select class="form-control" required>
                                    <option value="">Select a country</option>
                                    <option value="IN">India</option>
                                    <option value="US">United States</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="CA">Canada</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">State / Union Territory *</label>
                                <input type="text" class="form-control" required placeholder="Enter your state">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Payment Method -->
                <div class="checkout-card fade-in-up" style="animation-delay: 0.1s">
                    <h2 class="section-title"><i class="bi bi-credit-card-fill"></i> Payment Method</h2>

                    <!-- Payment Tabs -->
                    <div class="payment-tabs">
                        <button class="payment-tab active" data-target="card">
                            <i class="bi bi-credit-card"></i>
                            <span>Credit/Debit Card</span>
                        </button>
                        <button class="payment-tab" data-target="upi">
                            <i class="bi bi-phone"></i>
                            <span>UPI</span>
                        </button>
                        <button class="payment-tab" data-target="netbanking">
                            <i class="bi bi-bank"></i>
                            <span>Net Banking</span>
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div class="payment-content">
                        <!-- Card Payment -->
                        <div class="payment-panel active" id="card">
                            <form id="card-form">
                                <div class="form-group">
                                    <label class="form-label">Name on Card *</label>
                                    <input type="text" class="form-control" required placeholder="Enter cardholder name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Card Number *</label>
                                    <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19" required>
                                    <div class="card-logos">
                                        <i class="bi bi-credit-card-2-front"></i>
                                        <span>Visa</span>
                                        <span>Mastercard</span>
                                        <span>Amex</span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Expiration Date *</label>
                                        <input type="text" class="form-control" placeholder="MM/YY" maxlength="5" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Security Code *</label>
                                        <input type="text" class="form-control" placeholder="CVV" maxlength="4" required>
                                    </div>
                                </div>
                                <div class="form-check-custom">
                                    <input type="checkbox" id="save-card">
                                    <label for="save-card">
                                        <i class="bi bi-shield-check"></i>
                                        Securely save this card for faster checkout next time
                                    </label>
                                </div>
                            </form>
                        </div>

                        <!-- UPI Payment -->
                        <div class="payment-panel" id="upi">
                            <form id="upi-form">
                                <div class="form-group">
                                    <label class="form-label">UPI ID *</label>
                                    <input type="text" class="form-control" placeholder="yourname@upi" required>
                                </div>
                                <div class="payment-info-note">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>You will be redirected to your UPI app to complete the payment</span>
                                </div>
                            </form>
                        </div>

                        <!-- Net Banking -->
                        <div class="payment-panel" id="netbanking">
                            <form id="netbanking-form">
                                <div class="form-group">
                                    <label class="form-label">Select Your Bank *</label>
                                    <select class="form-control" required>
                                        <option value="">Choose a bank</option>
                                        <option value="SBI">State Bank of India</option>
                                        <option value="HDFC">HDFC Bank</option>
                                        <option value="ICICI">ICICI Bank</option>
                                        <option value="AXIS">Axis Bank</option>
                                        <option value="KOTAK">Kotak Mahindra Bank</option>
                                    </select>
                                </div>
                                <div class="payment-info-note">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>You will be redirected to your bank's website to complete the payment</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="checkout-card fade-in-up" style="animation-delay: 0.2s">
                    <h2 class="section-title"><i class="bi bi-bag-check-fill"></i> Order Details</h2>
                    <div class="order-items-list">
                        <div class="order-item">
                            <img src="https://img-c.udemycdn.com/course/240x135/567828_67d0.jpg" alt="Course" class="order-item-image">
                            <div class="order-item-details">
                                <h5 class="order-item-title">Learning Python for Data Analysis</h5>
                                <p class="order-item-author">By Jose Portilla</p>
                            </div>
                            <span class="order-item-price">₹455</span>
                        </div>
                        <div class="order-item">
                            <img src="https://img-c.udemycdn.com/course/240x135/764164_de03_2.jpg" alt="Course" class="order-item-image">
                            <div class="order-item-details">
                                <h5 class="order-item-title">The Complete Web Developer Course</h5>
                                <p class="order-item-author">By Rob Percival</p>
                            </div>
                            <span class="order-item-price">₹455</span>
                        </div>
                        <div class="order-item">
                            <img src="https://img-c.udemycdn.com/course/240x135/851712_fc61_6.jpg" alt="Course" class="order-item-image">
                            <div class="order-item-details">
                                <h5 class="order-item-title">Machine Learning A-Z™</h5>
                                <p class="order-item-author">By Kirill Eremenko</p>
                            </div>
                            <span class="order-item-price">₹455</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Summary -->
            <div class="checkout-right-column">
                <div class="summary-sticky-box fade-in-up" style="animation-delay: 0.2s">
                    <h3 class="summary-title">Order Summary</h3>

                    <div class="summary-details">
                        <div class="summary-row">
                            <span>Original Price:</span>
                            <span>₹9,597</span>
                        </div>
                        <div class="summary-row discount">
                            <span>Discount:</span>
                            <span>-₹8,232</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total">
                            <span><strong>Total:</strong></span>
                            <span><strong>₹1,365</strong></span>
                        </div>
                    </div>

                    <button class="btn-complete-payment complete-payment-btn">
                        <i class="bi bi-lock-fill"></i>
                        Complete Payment
                    </button>

                    <div class="guarantee-badge">
                        <i class="bi bi-shield-check-fill"></i>
                        <div class="guarantee-text">
                            <strong>30-Day Money-Back Guarantee</strong>
                            <p>Full Refund if you're not satisfied</p>
                        </div>
                    </div>

                    <p class="terms-note">
                        By completing your purchase you agree to these <a href="#">Terms of Service</a>.
                    </p>

                    <div class="secure-badges">
                        <div class="secure-badge">
                            <i class="bi bi-shield-fill-check"></i>
                            <span>SSL Secure</span>
                        </div>
                        <div class="secure-badge">
                            <i class="bi bi-lock-fill"></i>
                            <span>Encrypted</span>
                        </div>
                        <div class="secure-badge">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Verified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/payment.js']); ?>
