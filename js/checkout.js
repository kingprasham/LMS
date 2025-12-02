// Checkout Page JavaScript - Complete Checkout Functionality

document.addEventListener('DOMContentLoaded', function() {
    initializeCheckout();
    setupPaymentMethodSwitch();
    setupFormValidation();
    setupCardFormatting();
    setupCheckoutButton();
});

// Initialize checkout and load cart items
function initializeCheckout() {
    loadCartFromLocalStorage();

    if (window.cartItems.length === 0) {
        showEmptyCheckout();
        return;
    }

    displayOrderItems();
    updateOrderSummary();
}

// Load cart items from localStorage
function loadCartFromLocalStorage() {
    const cartData = localStorage.getItem('cart');
    window.cartItems = cartData ? JSON.parse(cartData) : [];

    // Load applied coupon if exists
    const appliedCoupon = localStorage.getItem('appliedCoupon');
    window.appliedCoupon = appliedCoupon ? JSON.parse(appliedCoupon) : null;
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
            <div class="empty-checkout-state" style="grid-column: 1 / -1;">
                <i class="bi bi-cart-x"></i>
                <h3>Your cart is empty</h3>
                <p>Add some courses to your cart to proceed with checkout</p>
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
        radio.addEventListener('change', function() {
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
            input.addEventListener('blur', function() {
                validateField(this);
            });

            input.addEventListener('input', function() {
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
        cardNumberInput.addEventListener('input', function(e) {
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
        expiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');

            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }

            e.target.value = value;
        });
    }

    // CVV - only numbers
    if (cvvInput) {
        cvvInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    }
}

// Setup checkout button
function setupCheckoutButton() {
    const checkoutBtn = document.getElementById('complete-payment-btn');
    const termsCheckbox = document.getElementById('terms-agree');

    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function(e) {
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
function processPayment() {
    const checkoutBtn = document.getElementById('complete-payment-btn');

    // Disable button and show loading
    checkoutBtn.disabled = true;
    checkoutBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing Payment...';

    // Simulate payment processing
    setTimeout(() => {
        // In production, this would send data to payment gateway

        // Get order details
        const orderData = {
            items: window.cartItems,
            billingDetails: getBillingDetails(),
            paymentMethod: document.querySelector('input[name="payment_method"]:checked').value,
            total: calculateFinalTotal(),
            timestamp: new Date().toISOString()
        };

        // Store order in localStorage
        let orders = localStorage.getItem('orders');
        orders = orders ? JSON.parse(orders) : [];
        orders.push(orderData);
        localStorage.setItem('orders', JSON.stringify(orders));

        // Clear cart
        localStorage.removeItem('cart');
        localStorage.removeItem('appliedCoupon');

        // Redirect to success page
        window.location.href = getBasePath() + 'pages/order-success.php';

    }, 2000);
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
