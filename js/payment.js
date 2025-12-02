// Payment Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    setupPaymentTabs();
    loadOrderSummary();
    setupPaymentForms();
});

// Setup payment tab switching
function setupPaymentTabs() {
    const paymentTabs = document.querySelectorAll('.payment-tab');
    const paymentPanels = document.querySelectorAll('.payment-panel');

    paymentTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const target = this.getAttribute('data-target');

            // Remove active class from all tabs and panels
            paymentTabs.forEach(t => t.classList.remove('active'));
            paymentPanels.forEach(p => p.classList.remove('active'));

            // Add active class to clicked tab and corresponding panel
            this.classList.add('active');
            document.getElementById(target).classList.add('active');
        });
    });
}

function loadOrderSummary() {
    const cartItems = window.udemyApp?.cartItems || [];

    if (cartItems.length === 0) {
        // If no cart data, use default values from page
        return;
    }

    // Calculate totals
    const total = cartItems.reduce((sum, item) => sum + item.price, 0);
    const originalTotal = cartItems.reduce((sum, item) => sum + item.price + 1000, 0);
    const discount = originalTotal - total;

    // Update summary box
    const summaryRows = document.querySelectorAll('.summary-row');
    if (summaryRows.length >= 3) {
        summaryRows[0].querySelector('span:last-child').textContent = `₹${originalTotal}`;
        summaryRows[1].querySelector('span:last-child').textContent = `-₹${discount}`;
        summaryRows[2].querySelector('span:last-child strong').textContent = `₹${total}`;
    }
}

function setupPaymentForms() {
    // Complete payment button
    const completeBtn = document.querySelector('.complete-payment-btn');
    if (completeBtn) {
        completeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            processPayment();
        });
    }

    // Card number formatting
    const cardNumberInput = document.querySelector('input[placeholder*="1234"]');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });
    }

    // Expiry date formatting
    const expiryInput = document.querySelector('input[placeholder="MM/YY"]');
    if (expiryInput) {
        expiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });
    }

    // CVV input - numbers only
    const cvvInput = document.querySelector('input[placeholder="CVV"]');
    if (cvvInput) {
        cvvInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 4);
        });
    }
}

function processPayment() {
    // Get active payment method
    const activeTab = document.querySelector('.payment-tab.active');
    const paymentMethod = activeTab ? activeTab.getAttribute('data-target') : 'card';

    // Validate form based on payment method
    if (paymentMethod === 'card') {
        if (!validateCardForm()) return;
    } else if (paymentMethod === 'upi') {
        if (!validateUPIForm()) return;
    } else if (paymentMethod === 'netbanking') {
        if (!validateNetBankingForm()) return;
    }

    // Simulate payment processing
    showPaymentProcessing();

    setTimeout(() => {
        // Clear cart
        if (typeof(Storage) !== "undefined") {
            localStorage.setItem('cart', JSON.stringify([]));
        }

        // Show success message
        alert('Payment successful! Thank you for your purchase.');

        // Redirect to my learning page
        window.location.href = 'wishlist.php';
    }, 2000);
}

function validateCardForm() {
    const cardNumber = document.querySelector('#card input[placeholder*="1234"]');
    const cardName = document.querySelector('#card input[placeholder*="cardholder"]');
    const expiry = document.querySelector('#card input[placeholder="MM/YY"]');
    const cvv = document.querySelector('#card input[placeholder="CVV"]');

    if (!cardNumber || !cardNumber.value || cardNumber.value.replace(/\s/g, '').length < 16) {
        alert('Please enter a valid 16-digit card number');
        return false;
    }

    if (!cardName || !cardName.value) {
        alert('Please enter the name on card');
        return false;
    }

    if (!expiry || !expiry.value || expiry.value.length < 5) {
        alert('Please enter a valid expiry date (MM/YY)');
        return false;
    }

    if (!cvv || !cvv.value || cvv.value.length < 3) {
        alert('Please enter a valid CVV');
        return false;
    }

    return true;
}

function validateUPIForm() {
    const upiId = document.querySelector('#upi input[placeholder*="upi"]');

    if (!upiId || !upiId.value || !upiId.value.includes('@')) {
        alert('Please enter a valid UPI ID (e.g., yourname@upi)');
        return false;
    }

    return true;
}

function validateNetBankingForm() {
    const bank = document.querySelector('#netbanking select');

    if (!bank || !bank.value) {
        alert('Please select a bank');
        return false;
    }

    return true;
}

function showPaymentProcessing() {
    const btn = document.querySelector('.complete-payment-btn');
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
    }
}
