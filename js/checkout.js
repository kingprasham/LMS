// Checkout Page JavaScript - Complete Checkout Functionality

// Initialize cart items as null to indicate loading state
window.cartItems = null;

document.addEventListener('DOMContentLoaded', function () {
    initializeCheckout();
});

// Initialize checkout and load cart items from API
async function initializeCheckout() {
    // Show loading state
    showLoadingState();

    await loadCartFromServer();

    if (!window.cartItems || window.cartItems.length === 0) {
        showEmptyCheckout();
        return;
    }

    displayOrderItems();
    updateOrderSummary();

    // Setup all interactive features AFTER cart loads
    setupPaymentMethodSwitch();
    setupFormValidation();
    setupCardFormatting();
    setupCheckoutButton();
    setupCouponSystem();

    // Hide loading state
    hideLoadingState();
}

// Show loading state
function showLoadingState() {
    const wrapper = document.querySelector('.checkout-wrapper');
    if (wrapper) {
        wrapper.style.opacity = '0.6';
        wrapper.style.pointerEvents = 'none';
    }
}

// Hide loading state
function hideLoadingState() {
    const wrapper = document.querySelector('.checkout-wrapper');
    if (wrapper) {
        wrapper.style.opacity = '1';
        wrapper.style.pointerEvents = 'auto';
    }
}

// Load cart items from server (database API)
async function loadCartFromServer() {
    try {
        const response = await fetch('cart_api.php?action=get');
        const data = await response.json();

        if (data.success) {
            window.cartItems = data.items.map(item => ({
                id: item.id,
                cart_id: item.cart_id,
                title: item.title,
                price: item.price,
                originalPrice: item.originalPrice,
                image: item.image,
                instructor: item.instructor,
                rating: item.rating,
                duration: item.duration,
                lectures: item.lectures
            }));
        } else {
            window.cartItems = [];
        }
    } catch (error) {
        console.error('Error loading cart:', error);
        window.cartItems = [];
    }

    // Load applied coupon from sessionStorage
    const appliedCoupon = sessionStorage.getItem('checkoutCoupon');
    window.appliedCoupon = appliedCoupon ? JSON.parse(appliedCoupon) : null;
}

// Valid coupon codes
const validCoupons = {
    'SAVE10': { discount: 10, description: '10% off' },
    'SAVE20': { discount: 20, description: '20% off' },
    'WELCOME': { discount: 15, description: '15% off for new users' },
    'STUDENT50': { discount: 50, description: '50% student discount' },
    'TEST100': { discount: 100, description: '100% off - FREE course!' }
};

// Setup coupon system for checkout
function setupCouponSystem() {
    // Add coupon input to the pricing summary if not exists
    const pricingSummary = document.querySelector('.pricing-summary');
    if (pricingSummary && !document.getElementById('checkout-coupon-input')) {
        const couponSection = document.createElement('div');
        couponSection.className = 'coupon-section-checkout';
        couponSection.innerHTML = `
            <div class="coupon-input-row" style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                <input type="text" id="checkout-coupon-input" placeholder="Enter coupon code" 
                    style="flex: 1; padding: 0.75rem; border: 1px solid #d1d7dc; border-radius: 6px; font-size: 0.9rem;">
                <button id="apply-coupon-btn" type="button"
                    style="padding: 0.75rem 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                    Apply
                </button>
            </div>
            <div id="coupon-applied-msg" style="display: none; padding: 0.75rem; background: #d4edda; color: #155724; border-radius: 6px; margin-bottom: 1rem;">
                <i class="bi bi-check-circle-fill"></i> <span id="coupon-applied-text"></span>
                <button id="remove-coupon-btn" type="button" style="float: right; background: none; border: none; color: #155724; cursor: pointer;">×</button>
            </div>
        `;
        pricingSummary.insertBefore(couponSection, pricingSummary.firstChild);

        // Setup event listeners
        document.getElementById('apply-coupon-btn').addEventListener('click', applyCoupon);
        document.getElementById('checkout-coupon-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') applyCoupon();
        });
    }

    // Restore applied coupon if exists
    if (window.appliedCoupon) {
        showCouponApplied(window.appliedCoupon.code, window.appliedCoupon.discount);
    }
}

// Apply coupon code
function applyCoupon() {
    const input = document.getElementById('checkout-coupon-input');
    const code = input.value.trim().toUpperCase();

    if (!code) {
        showNotification('Please enter a coupon code', 'error');
        return;
    }

    if (validCoupons[code]) {
        window.appliedCoupon = {
            code: code,
            discount: validCoupons[code].discount
        };
        sessionStorage.setItem('checkoutCoupon', JSON.stringify(window.appliedCoupon));

        showCouponApplied(code, validCoupons[code].discount);
        updateOrderSummary();
        showNotification(`Coupon "${code}" applied! ${validCoupons[code].description}`, 'success');
    } else {
        showNotification('Invalid coupon code', 'error');
        input.value = '';
    }
}

// Show coupon applied state
function showCouponApplied(code, discount) {
    const inputRow = document.querySelector('.coupon-input-row');
    const appliedMsg = document.getElementById('coupon-applied-msg');
    const appliedText = document.getElementById('coupon-applied-text');

    if (inputRow) inputRow.style.display = 'none';
    if (appliedMsg) {
        appliedMsg.style.display = 'block';
        appliedText.textContent = `${code} applied (${discount}% off)`;
    }

    // Setup remove button
    const removeBtn = document.getElementById('remove-coupon-btn');
    if (removeBtn) {
        removeBtn.onclick = function () {
            window.appliedCoupon = null;
            sessionStorage.removeItem('checkoutCoupon');
            if (inputRow) inputRow.style.display = 'flex';
            if (appliedMsg) appliedMsg.style.display = 'none';
            document.getElementById('checkout-coupon-input').value = '';

            // Hide coupon row in summary
            const couponRow = document.getElementById('summary-coupon-row');
            if (couponRow) couponRow.style.display = 'none';

            updateOrderSummary();
            showNotification('Coupon removed', 'info');
        };
    }
}

// Display order items in summary
function displayOrderItems() {
    const container = document.getElementById('order-items-list');

    if (!container) return;

    container.innerHTML = '';

    window.cartItems.forEach(item => {
        const orderItemHTML = `
            <div class="order-item">
                <img src="${item.image || 'https://via.placeholder.com/60x40'}" alt="${item.title}" class="order-item-image">
                <div class="order-item-details">
                    <div class="order-item-title">${item.title}</div>
                    <div class="order-item-price">₹${item.price || 455}</div>
                </div>
            </div>
        `;
        container.innerHTML += orderItemHTML;
    });
}

// Update order summary with totals
function updateOrderSummary() {
    if (window.cartItems.length === 0) return;

    const originalPriceTotal = window.cartItems.reduce((sum, item) => sum + (item.originalPrice || 3199), 0);
    const currentPriceTotal = window.cartItems.reduce((sum, item) => sum + (item.price || 455), 0);
    const discountAmount = originalPriceTotal - currentPriceTotal;

    // Apply coupon discount if active
    let finalTotal = currentPriceTotal;
    let couponDiscountAmount = 0;

    if (window.appliedCoupon) {
        couponDiscountAmount = Math.round(currentPriceTotal * window.appliedCoupon.discount / 100);
        finalTotal = currentPriceTotal - couponDiscountAmount;

        // Show coupon row
        const couponRow = document.getElementById('summary-coupon-row');
        if (couponRow) {
            couponRow.style.display = 'flex';
            document.getElementById('summary-coupon-discount').textContent = `-₹${couponDiscountAmount.toLocaleString()}`;
        }
    }

    // Update summary elements
    document.getElementById('summary-original-price').textContent = `₹${originalPriceTotal.toLocaleString()}`;
    document.getElementById('summary-discount').textContent = `-₹${discountAmount.toLocaleString()}`;
    document.getElementById('summary-total').textContent = `₹${Math.round(finalTotal).toLocaleString()}`;
}

// Show empty checkout state
function showEmptyCheckout() {
    const wrapper = document.querySelector('.checkout-wrapper');

    if (wrapper) {
        wrapper.innerHTML = `
            <div class="empty-checkout-state" style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem;">
                <i class="bi bi-cart-x" style="font-size: 5rem; color: #d1d7dc; margin-bottom: 1.5rem;"></i>
                <h3 style="font-size: 1.8rem; color: #1a1d35; margin-bottom: 1rem;">Your cart is empty</h3>
                <p style="font-size: 1.1rem; color: #5a5f73; margin-bottom: 2rem;">Add some courses to your cart to proceed with checkout</p>
                <a href="${getBasePath()}index.php" class="btn-complete-payment" style="display: inline-flex; text-decoration: none; width: auto;">
                    <i class="bi bi-arrow-left"></i>
                    Browse Courses
                </a>
            </div>
        `;
    }
}

// Setup payment method switching
function setupPaymentMethodSwitch() {
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const cardDetails = document.getElementById('card-details');
    const upiDetails = document.getElementById('upi-details');

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            // Hide all payment detail forms
            if (cardDetails) cardDetails.style.display = 'none';
            if (upiDetails) upiDetails.style.display = 'none';

            // Show relevant form based on selection
            if (this.value === 'card' && cardDetails) {
                cardDetails.style.display = 'block';
            } else if (this.value === 'upi' && upiDetails) {
                upiDetails.style.display = 'block';
            }
        });
    });
}

// Setup form validation
function setupFormValidation() {
    const billingForm = document.getElementById('billing-form');

    if (billingForm) {
        const inputs = billingForm.querySelectorAll('input, select');

        inputs.forEach(input => {
            input.addEventListener('blur', function () {
                validateField(this);
            });

            input.addEventListener('input', function () {
                if (this.classList.contains('invalid')) {
                    validateField(this);
                }
            });
        });
    }
}

// Validate individual field
function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';

    // Check if required field is empty
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'This field is required';
    }

    // Email validation
    if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address';
        }
    }

    // Phone validation
    if (field.type === 'tel' && value) {
        const phoneRegex = /^[\d\s\+\-\(\)]{10,}$/;
        if (!phoneRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number';
        }
    }

    // PIN code validation
    if (field.id === 'pincode' && value) {
        const pincodeRegex = /^\d{6}$/;
        if (!pincodeRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid 6-digit PIN code';
        }
    }

    // Update field styling
    if (isValid) {
        field.classList.remove('invalid');
        field.style.borderColor = 'var(--border-gray)';
        removeErrorMessage(field);
    } else {
        field.classList.add('invalid');
        field.style.borderColor = 'var(--error)';
        showErrorMessage(field, errorMessage);
    }

    return isValid;
}

// Show error message for field
function showErrorMessage(field, message) {
    removeErrorMessage(field);

    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error-message';
    errorDiv.textContent = message;
    errorDiv.style.cssText = `
        color: var(--error);
        font-size: 0.85rem;
        margin-top: 0.3rem;
        animation: fadeInUp 0.3s ease-out;
    `;

    field.parentElement.appendChild(errorDiv);
}

// Remove error message
function removeErrorMessage(field) {
    const existingError = field.parentElement.querySelector('.field-error-message');
    if (existingError) {
        existingError.remove();
    }
}

// Setup card number formatting
function setupCardFormatting() {
    const cardNumberInput = document.getElementById('card-number');
    const expiryInput = document.getElementById('expiry-date');
    const cvvInput = document.getElementById('cvv');

    // Card number formatting (add spaces every 4 digits)
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\s/g, '');
            value = value.replace(/\D/g, '');

            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }

            e.target.value = formattedValue;
        });
    }

    // Expiry date formatting (MM/YY)
    if (expiryInput) {
        expiryInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');

            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }

            e.target.value = value;
        });
    }

    // CVV - only numbers
    if (cvvInput) {
        cvvInput.addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    }
}

// Setup checkout button
function setupCheckoutButton() {
    const checkoutBtn = document.getElementById('complete-payment-btn');
    const termsCheckbox = document.getElementById('terms-agree');

    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function (e) {
            e.preventDefault();

            if (window.cartItems.length === 0) {
                showNotification('Your cart is empty', 'error');
                return;
            }

            // Validate terms checkbox
            if (termsCheckbox && !termsCheckbox.checked) {
                showNotification('Please agree to the Terms & Conditions', 'error');
                termsCheckbox.focus();
                return;
            }

            // Validate billing form
            if (!validateBillingForm()) {
                showNotification('Please fill in all required billing details', 'error');
                return;
            }

            // Validate payment method
            if (!validatePaymentMethod()) {
                showNotification('Please complete payment details', 'error');
                return;
            }

            // Process payment
            processPayment();
        });
    }
}

// Validate billing form
function validateBillingForm() {
    const billingForm = document.getElementById('billing-form');
    if (!billingForm) return false;

    const inputs = billingForm.querySelectorAll('input[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });

    return isValid;
}

// Validate payment method
function validatePaymentMethod() {
    const selectedMethod = document.querySelector('input[name="payment_method"]:checked');

    if (!selectedMethod) return false;

    // Validate card details if card is selected
    if (selectedMethod.value === 'card') {
        const cardNumber = document.getElementById('card-number');
        const expiry = document.getElementById('expiry-date');
        const cvv = document.getElementById('cvv');
        const cardName = document.getElementById('card-name');

        if (!cardNumber.value || !expiry.value || !cvv.value || !cardName.value) {
            return false;
        }

        // Validate card number (simple check for 16 digits)
        const cardDigits = cardNumber.value.replace(/\s/g, '');
        if (cardDigits.length < 13 || cardDigits.length > 19) {
            showNotification('Invalid card number', 'error');
            return false;
        }

        // Validate expiry
        const expiryRegex = /^\d{2}\/\d{2}$/;
        if (!expiryRegex.test(expiry.value)) {
            showNotification('Invalid expiry date', 'error');
            return false;
        }

        // Validate CVV
        if (cvv.value.length < 3) {
            showNotification('Invalid CVV', 'error');
            return false;
        }
    }

    // Validate UPI if UPI is selected
    if (selectedMethod.value === 'upi') {
        const upiId = document.getElementById('upi-id');
        if (upiId && !upiId.value) {
            return false;
        }
    }

    return true;
}

// Process payment
async function processPayment() {
    const checkoutBtn = document.getElementById('complete-payment-btn');

    // Disable button and show loading
    checkoutBtn.disabled = true;
    checkoutBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing Payment...';

    try {
        // Get CSRF token
        const tokenResponse = await fetch('cart_api.php?action=csrf_token');
        const tokenData = await tokenResponse.json();
        const csrfToken = tokenData.csrf_token;

        // Get order details
        const orderData = {
            items: window.cartItems,
            billingDetails: getBillingDetails(),
            paymentMethod: document.querySelector('input[name="payment_method"]:checked').value,
            total: calculateFinalTotal(),
            coupon: window.appliedCoupon ? window.appliedCoupon.code : null,
            timestamp: new Date().toISOString()
        };

        // Process the order via API
        const response = await fetch('checkout_api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                action: 'process_order',
                csrf_token: csrfToken,
                order_data: orderData
            })
        });

        const data = await response.json();

        if (data.success) {
            // Clear cart from server
            await fetch('cart_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    action: 'clear',
                    csrf_token: csrfToken
                })
            });

            // Clear session storage
            sessionStorage.removeItem('checkoutCoupon');

            // Redirect to success page
            window.location.href = 'order-success.php?order_id=' + data.order_id;
        } else {
            showNotification(data.message || 'Payment failed. Please try again.', 'error');
            checkoutBtn.disabled = false;
            checkoutBtn.innerHTML = '<i class="bi bi-lock-fill"></i> Complete Payment';
        }
    } catch (error) {
        console.error('Payment error:', error);
        showNotification('An error occurred. Please try again.', 'error');
        checkoutBtn.disabled = false;
        checkoutBtn.innerHTML = '<i class="bi bi-lock-fill"></i> Complete Payment';
    }
}

// Get billing details from form
function getBillingDetails() {
    return {
        firstName: document.getElementById('first-name').value,
        lastName: document.getElementById('last-name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        address: document.getElementById('address').value,
        city: document.getElementById('city').value,
        state: document.getElementById('state').value,
        pincode: document.getElementById('pincode').value,
        country: document.getElementById('country').value
    };
}

// Calculate final total
function calculateFinalTotal() {
    const currentPriceTotal = window.cartItems.reduce((sum, item) => sum + (item.price || 455), 0);

    let finalTotal = currentPriceTotal;

    if (window.appliedCoupon) {
        finalTotal = currentPriceTotal - (currentPriceTotal * window.appliedCoupon.discount / 100);
    }

    return Math.round(finalTotal);
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `checkout-notification notification-${type}`;

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
    if (!document.getElementById('checkout-notification-styles')) {
        style.id = 'checkout-notification-styles';
        document.head.appendChild(style);
    }

    document.body.appendChild(notification);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideInRight 0.3s ease-out reverse';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
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
