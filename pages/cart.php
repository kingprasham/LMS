<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Shopping Cart - SAS-AI', ['css/cart.css']);
renderNavbar();
?>

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
                    <!-- Cart Item 1 -->
                    <div class="cart-item-modern">
                        <div class="cart-item-image-wrapper">
                            <img src="https://img-c.udemycdn.com/course/240x135/567828_67d0.jpg" alt="Course" class="cart-item-image">
                        </div>
                        <div class="cart-item-details">
                            <h4 class="cart-item-title">Learning Python for Data Analysis and Visualization</h4>
                            <p class="cart-item-author">By Jose Portilla</p>
                            <div class="cart-item-meta">
                                <span class="badge-bestseller-cart"><i class="bi bi-award-fill"></i> Bestseller</span>
                                <div class="cart-rating">
                                    <span class="rating-number">4.4</span>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span class="rating-count">(17,379)</span>
                                </div>
                            </div>
                            <div class="cart-item-info">
                                <span><i class="bi bi-clock-fill"></i> 9 hours</span>
                                <span><i class="bi bi-play-circle-fill"></i> 74 lectures</span>
                                <span><i class="bi bi-graph-up"></i> All Levels</span>
                            </div>
                            <div class="cart-item-actions">
                                <button class="action-btn remove-btn">
                                    <i class="bi bi-trash3-fill"></i> Remove
                                </button>
                                <button class="action-btn">
                                    <i class="bi bi-bookmark-fill"></i> Save for Later
                                </button>
                                <button class="action-btn">
                                    <i class="bi bi-heart-fill"></i> Move to Wishlist
                                </button>
                            </div>
                        </div>
                        <div class="cart-item-price">
                            <h3>₹455</h3>
                            <p class="original-price">₹3,199</p>
                        </div>
                    </div>

                    <!-- Cart Item 2 -->
                    <div class="cart-item-modern">
                        <div class="cart-item-image-wrapper">
                            <img src="https://img-c.udemycdn.com/course/240x135/764164_de03_2.jpg" alt="Course" class="cart-item-image">
                        </div>
                        <div class="cart-item-details">
                            <h4 class="cart-item-title">The Complete Web Developer Course 2.0</h4>
                            <p class="cart-item-author">By Rob Percival</p>
                            <div class="cart-item-meta">
                                <span class="badge-bestseller-cart"><i class="bi bi-award-fill"></i> Bestseller</span>
                                <div class="cart-rating">
                                    <span class="rating-number">4.5</span>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span class="rating-count">(8,924)</span>
                                </div>
                            </div>
                            <div class="cart-item-info">
                                <span><i class="bi bi-clock-fill"></i> 30 hours</span>
                                <span><i class="bi bi-play-circle-fill"></i> 274 lectures</span>
                                <span><i class="bi bi-graph-up"></i> All Levels</span>
                            </div>
                            <div class="cart-item-actions">
                                <button class="action-btn remove-btn">
                                    <i class="bi bi-trash3-fill"></i> Remove
                                </button>
                                <button class="action-btn">
                                    <i class="bi bi-bookmark-fill"></i> Save for Later
                                </button>
                                <button class="action-btn">
                                    <i class="bi bi-heart-fill"></i> Move to Wishlist
                                </button>
                            </div>
                        </div>
                        <div class="cart-item-price">
                            <h3>₹455</h3>
                            <p class="original-price">₹3,199</p>
                        </div>
                    </div>

                    <!-- Cart Item 3 -->
                    <div class="cart-item-modern">
                        <div class="cart-item-image-wrapper">
                            <img src="https://img-c.udemycdn.com/course/240x135/851712_fc61_6.jpg" alt="Course" class="cart-item-image">
                        </div>
                        <div class="cart-item-details">
                            <h4 class="cart-item-title">Machine Learning A-Z™: Hands-On Python & R In Data Science</h4>
                            <p class="cart-item-author">By Kirill Eremenko, Hadelin de Ponteves</p>
                            <div class="cart-item-meta">
                                <span class="badge-bestseller-cart"><i class="bi bi-award-fill"></i> Bestseller</span>
                                <div class="cart-rating">
                                    <span class="rating-number">4.5</span>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span class="rating-count">(15,342)</span>
                                </div>
                            </div>
                            <div class="cart-item-info">
                                <span><i class="bi bi-clock-fill"></i> 44 hours</span>
                                <span><i class="bi bi-play-circle-fill"></i> 321 lectures</span>
                                <span><i class="bi bi-graph-up"></i> All Levels</span>
                            </div>
                            <div class="cart-item-actions">
                                <button class="action-btn remove-btn">
                                    <i class="bi bi-trash3-fill"></i> Remove
                                </button>
                                <button class="action-btn">
                                    <i class="bi bi-bookmark-fill"></i> Save for Later
                                </button>
                                <button class="action-btn">
                                    <i class="bi bi-heart-fill"></i> Move to Wishlist
                                </button>
                            </div>
                        </div>
                        <div class="cart-item-price">
                            <h3>₹455</h3>
                            <p class="original-price">₹3,199</p>
                        </div>
                    </div>
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
