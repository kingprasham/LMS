// Cart Page JavaScript - Complete Shopping Cart Functionality

document.addEventListener('DOMContentLoaded', function() {
    initializeCart();
    setupCouponSystem();
    setupCartActions();
});

// Initialize cart and load items from localStorage
function initializeCart() {
    loadCartFromLocalStorage();
    updateCartDisplay();
    updateOrderSummary();
}

// Load cart items from localStorage
function loadCartFromLocalStorage() {
    const cartData = localStorage.getItem('cart');
    window.cartItems = cartData ? JSON.parse(cartData) : [];
}

// Save cart to localStorage
function saveCartToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(window.cartItems));
}

// Update cart display with items
function updateCartDisplay() {
    const container = document.querySelector('.cart-items-container');
    const subtitle = document.querySelector('.cart-subtitle');

    if (!container) return;

    // Update subtitle with item count
    if (subtitle) {
        const itemCount = window.cartItems.length;
        subtitle.textContent = itemCount === 0 ? 'Your cart is empty' :
                              itemCount === 1 ? '1 course ready for checkout' :
                              `${itemCount} courses ready for checkout`;
    }

    // Show empty state if no items
    if (window.cartItems.length === 0) {
        showEmptyCart(container);
        hideOrderSummary();
        return;
    }

    // Clear container
    container.innerHTML = '';

    // Render each cart item
    window.cartItems.forEach((item, index) => {
        const cartItemHTML = createCartItemHTML(item, index);
        container.innerHTML += cartItemHTML;
    });

    // Reattach event listeners after rendering
    attachCartItemListeners();
}

// Create HTML for a cart item
function createCartItemHTML(item, index) {
    return `
        <div class="cart-item-modern fade-in-up" data-item-index="${index}">
            <div class="cart-item-image-wrapper">
                <img src="${item.image || 'https://via.placeholder.com/240x135'}" alt="${item.title}" class="cart-item-image">
            </div>
            <div class="cart-item-details">
                <h4 class="cart-item-title">${item.title}</h4>
                <p class="cart-item-author">By ${item.instructor || 'Anonymous'}</p>
                <div class="cart-item-meta">
                    ${item.bestseller ? '<span class="badge-bestseller-cart"><i class="bi bi-award-fill"></i> Bestseller</span>' : ''}
                    <div class="cart-rating">
                        <span class="rating-number">${item.rating || '4.5'}</span>
                        <div class="stars">
                            ${generateStars(item.rating || 4.5)}
                        </div>
                        <span class="rating-count">(${item.reviews || '1,234'})</span>
                    </div>
                </div>
                <div class="cart-item-info">
                    <span><i class="bi bi-clock-fill"></i> ${item.duration || '10 hours'}</span>
                    <span><i class="bi bi-play-circle-fill"></i> ${item.lectures || '50 lectures'}</span>
                    <span><i class="bi bi-graph-up"></i> ${item.level || 'All Levels'}</span>
                </div>
                <div class="cart-item-actions">
                    <button class="action-btn remove-btn" data-action="remove" data-index="${index}">
                        <i class="bi bi-trash3-fill"></i> Remove
                    </button>
                    <button class="action-btn" data-action="save" data-index="${index}">
                        <i class="bi bi-bookmark-fill"></i> Save for Later
                    </button>
                    <button class="action-btn" data-action="wishlist" data-index="${index}">
                        <i class="bi bi-heart-fill"></i> Move to Wishlist
                    </button>
                </div>
            </div>
            <div class="cart-item-price">
                <h3>₹${item.price || 455}</h3>
                <p class="original-price">₹${item.originalPrice || 3199}</p>
            </div>
        </div>
    `;
}

// Generate star rating HTML
function generateStars(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 >= 0.5;
    let starsHTML = '';

    for (let i = 0; i < fullStars; i++) {
        starsHTML += '<i class="bi bi-star-fill"></i>';
    }

    if (hasHalfStar) {
        starsHTML += '<i class="bi bi-star-half"></i>';
    }

    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    for (let i = 0; i < emptyStars; i++) {
        starsHTML += '<i class="bi bi-star"></i>';
    }

    return starsHTML;
}

// Show empty cart state
function showEmptyCart(container) {
    container.innerHTML = `
        <div class="empty-cart-state" style="text-align: center; padding: 4rem 2rem; background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(102, 126, 234, 0.08);">
            <i class="bi bi-cart-x" style="font-size: 5rem; color: #d1d7dc; margin-bottom: 1.5rem;"></i>
            <h3 style="font-size: 1.8rem; color: #1a1d35; margin-bottom: 1rem;">Your cart is empty</h3>
            <p style="font-size: 1.1rem; color: #5a5f73; margin-bottom: 2rem;">Explore our courses and add something you like!</p>
            <a href="${getBasePath()}index.php" class="btn-checkout" style="display: inline-flex; text-decoration: none; width: auto;">
                <i class="bi bi-arrow-left"></i>
                Keep Shopping
            </a>
        </div>
    `;
}

// Hide order summary when cart is empty
function hideOrderSummary() {
    const summary = document.querySelector('.cart-summary-sticky');
    if (summary) {
        summary.style.display = 'none';
    }
}

// Update order summary with totals
function updateOrderSummary() {
    if (window.cartItems.length === 0) return;

    const originalPriceTotal = window.cartItems.reduce((sum, item) => sum + (item.originalPrice || 3199), 0);
    const currentPriceTotal = window.cartItems.reduce((sum, item) => sum + (item.price || 455), 0);
    const discountAmount = originalPriceTotal - currentPriceTotal;
    const discountPercentage = Math.round((discountAmount / originalPriceTotal) * 100);

    // Apply coupon discount if active
    let finalTotal = currentPriceTotal;
    const appliedCoupon = window.appliedCoupon;

    if (appliedCoupon) {
        finalTotal = currentPriceTotal - (currentPriceTotal * appliedCoupon.discount / 100);
    }

    // Update summary elements
    const originalPriceEl = document.querySelector('.summary-row:nth-child(1) span:last-child');
    const discountEl = document.querySelector('.discount-row span:last-child');
    const totalEl = document.querySelector('.total-row span:last-child strong');

    if (originalPriceEl) originalPriceEl.textContent = `₹${originalPriceTotal.toLocaleString()}`;
    if (discountEl) discountEl.textContent = `-₹${discountAmount.toLocaleString()}`;
    if (totalEl) totalEl.textContent = `₹${Math.round(finalTotal).toLocaleString()}`;

    // Update discount percentage
    const discountRow = document.querySelector('.discount-row span:first-child');
    if (discountRow) discountRow.textContent = `Discount (${discountPercentage}%):`;
}

// Attach event listeners to cart item actions
function attachCartItemListeners() {
    const actionButtons = document.querySelectorAll('.action-btn');

    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.action;
            const index = parseInt(this.dataset.index);

            switch(action) {
                case 'remove':
                    removeFromCart(index);
                    break;
                case 'save':
                    saveForLater(index);
                    break;
                case 'wishlist':
                    moveToWishlist(index);
                    break;
            }
        });
    });
}

// Remove item from cart
function removeFromCart(index) {
    if (confirm('Remove this course from your cart?')) {
        const removedItem = window.cartItems[index];
        window.cartItems.splice(index, 1);
        saveCartToLocalStorage();
        updateCartDisplay();
        updateOrderSummary();
        updateCartBadge();
        showNotification(`"${removedItem.title}" removed from cart`, 'info');
    }
}

// Save item for later
function saveForLater(index) {
    const item = window.cartItems[index];

    // Get saved items from localStorage
    let savedItems = localStorage.getItem('savedForLater');
    savedItems = savedItems ? JSON.parse(savedItems) : [];

    // Add to saved items
    savedItems.push(item);
    localStorage.setItem('savedForLater', JSON.stringify(savedItems));

    // Remove from cart
    window.cartItems.splice(index, 1);
    saveCartToLocalStorage();
    updateCartDisplay();
    updateOrderSummary();
    updateCartBadge();
    showNotification(`"${item.title}" saved for later`, 'success');
}

// Move item to wishlist
function moveToWishlist(index) {
    const item = window.cartItems[index];

    // Get wishlist from localStorage
    let wishlist = localStorage.getItem('wishlist');
    wishlist = wishlist ? JSON.parse(wishlist) : [];

    // Check if already in wishlist
    const alreadyInWishlist = wishlist.some(w => w.id === item.id);

    if (!alreadyInWishlist) {
        wishlist.push(item);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        showNotification(`"${item.title}" moved to wishlist`, 'success');
    } else {
        showNotification(`"${item.title}" is already in your wishlist`, 'info');
    }

    // Remove from cart
    window.cartItems.splice(index, 1);
    saveCartToLocalStorage();
    updateCartDisplay();
    updateOrderSummary();
    updateCartBadge();
}

// Setup coupon system
function setupCouponSystem() {
    const applyBtn = document.querySelector('.btn-apply-promo');
    const couponInput = document.querySelector('.promo-input');

    if (applyBtn && couponInput) {
        applyBtn.addEventListener('click', function() {
            const code = couponInput.value.trim().toUpperCase();
            applyCoupon(code);
        });

        // Allow enter key to apply coupon
        couponInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const code = couponInput.value.trim().toUpperCase();
                applyCoupon(code);
            }
        });
    }
}

// Apply coupon code
function applyCoupon(code) {
    const couponInput = document.querySelector('.promo-input');
    const promoWrapper = document.querySelector('.promo-input-wrapper');
    const promoApplied = document.querySelector('.promo-applied');

    // Valid coupon codes (in production, this would be validated on the server)
    const validCoupons = {
        'SAVE10': { discount: 10, description: '10% off' },
        'SAVE20': { discount: 20, description: '20% off' },
        'WELCOME': { discount: 15, description: '15% off for new users' },
        'STUDENT50': { discount: 50, description: '50% student discount' }
    };

    if (!code) {
        showNotification('Please enter a coupon code', 'error');
        return;
    }

    if (validCoupons[code]) {
        // Store applied coupon
        window.appliedCoupon = {
            code: code,
            discount: validCoupons[code].discount
        };

        // Hide input, show applied state
        if (promoWrapper) promoWrapper.style.display = 'none';
        if (promoApplied) {
            promoApplied.style.display = 'flex';
            promoApplied.querySelector('strong').textContent = code;
        }

        // Update totals
        updateOrderSummary();
        showNotification(`Coupon "${code}" applied! ${validCoupons[code].description}`, 'success');

        // Setup remove coupon button
        const removeBtn = document.querySelector('.btn-remove-promo');
        if (removeBtn) {
            removeBtn.addEventListener('click', removeCoupon);
        }
    } else {
        showNotification('Invalid coupon code', 'error');
        couponInput.value = '';
    }
}

// Remove applied coupon
function removeCoupon() {
    window.appliedCoupon = null;

    const promoWrapper = document.querySelector('.promo-input-wrapper');
    const promoApplied = document.querySelector('.promo-applied');
    const couponInput = document.querySelector('.promo-input');

    if (promoWrapper) promoWrapper.style.display = 'flex';
    if (promoApplied) promoApplied.style.display = 'none';
    if (couponInput) couponInput.value = '';

    updateOrderSummary();
    showNotification('Coupon removed', 'info');
}

// Setup cart actions
function setupCartActions() {
    // Checkout button
    const checkoutBtn = document.querySelector('.btn-checkout');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function(e) {
            if (window.cartItems.length === 0) {
                e.preventDefault();
                showNotification('Your cart is empty', 'error');
                return;
            }
            // Redirect to checkout page
            window.location.href = getBasePath() + 'pages/checkout.php';
        });
    }
}

// Update cart badge in navbar
function updateCartBadge() {
    const badge = document.querySelector('.cart-count');
    if (badge) {
        badge.textContent = window.cartItems.length;
        if (window.cartItems.length === 0) {
            badge.style.display = 'none';
        } else {
            badge.style.display = 'flex';
        }
    }
}

// Show notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `cart-notification notification-${type}`;

    const icons = {
        success: 'bi-check-circle-fill',
        error: 'bi-x-circle-fill',
        info: 'bi-info-circle-fill'
    };

    const colors = {
        success: '#00D4AA',
        error: '#ff4444',
        info: '#0066FF'
    };

    notification.innerHTML = `
        <i class="bi ${icons[type]}"></i>
        <span>${message}</span>
    `;

    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 0.8rem;
        z-index: 10000;
        animation: slideInRight 0.3s ease-out;
        border-left: 4px solid ${colors[type]};
    `;

    notification.querySelector('i').style.cssText = `
        font-size: 1.5rem;
        color: ${colors[type]};
    `;

    notification.querySelector('span').style.cssText = `
        font-size: 0.95rem;
        color: #2d2f31;
    `;

    // Add animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
    if (!document.getElementById('cart-notification-styles')) {
        style.id = 'cart-notification-styles';
        document.head.appendChild(style);
    }

    document.body.appendChild(notification);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideInRight 0.3s ease-out reverse';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Get base path helper
function getBasePath() {
    const path = window.location.pathname;
    const inSubfolder = path.includes('/LMS/') || path.includes('/lms/');

    if (inSubfolder) {
        const depth = (path.match(/\//g) || []).length - 2;
        return '../'.repeat(Math.max(0, depth));
    } else {
        const depth = (path.match(/\//g) || []).length - 1;
        return '../'.repeat(Math.max(0, depth));
    }
}
