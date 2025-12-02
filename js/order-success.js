// Order Success Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    loadOrderDetails();
    generateOrderNumber();
});

// Load order details from localStorage
function loadOrderDetails() {
    const orders = localStorage.getItem('orders');

    if (!orders) {
        // No orders found, redirect to home
        setTimeout(() => {
            window.location.href = getBasePath() + 'index.php';
        }, 3000);
        return;
    }

    const ordersArray = JSON.parse(orders);
    const lastOrder = ordersArray[ordersArray.length - 1];

    if (!lastOrder || !lastOrder.items) {
        return;
    }

    // Display order items
    displayOrderItems(lastOrder.items);

    // Calculate and display totals
    displayOrderSummary(lastOrder);
}

// Display order items
function displayOrderItems(items) {
    const container = document.getElementById('order-items-list');

    if (!container) return;

    container.innerHTML = '';

    items.forEach(item => {
        const orderItemHTML = `
            <div class="order-item">
                <img src="${item.image || 'https://via.placeholder.com/80x60'}" alt="${item.title}" class="order-item-image">
                <div class="order-item-details">
                    <div class="order-item-title">${item.title}</div>
                    <div class="order-item-instructor">By ${item.instructor || 'Anonymous'}</div>
                </div>
                <div class="order-item-price">₹${item.price || 455}</div>
            </div>
        `;
        container.innerHTML += orderItemHTML;
    });
}

// Display order summary
function displayOrderSummary(order) {
    const items = order.items;

    const originalPriceTotal = items.reduce((sum, item) => sum + (item.originalPrice || 3199), 0);
    const currentPriceTotal = items.reduce((sum, item) => sum + (item.price || 455), 0);
    const discountAmount = originalPriceTotal - currentPriceTotal;

    // Get final total from order
    const finalTotal = order.total || currentPriceTotal;

    // Update summary elements
    const subtotalEl = document.getElementById('order-subtotal');
    const discountEl = document.getElementById('order-discount');
    const totalEl = document.getElementById('order-total');

    if (subtotalEl) subtotalEl.textContent = `₹${originalPriceTotal.toLocaleString()}`;
    if (discountEl) discountEl.textContent = `-₹${discountAmount.toLocaleString()}`;
    if (totalEl) totalEl.textContent = `₹${finalTotal.toLocaleString()}`;
}

// Generate unique order number
function generateOrderNumber() {
    const orderNumberEl = document.getElementById('order-number');

    if (!orderNumberEl) return;

    // Generate order number based on timestamp
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const random = Math.floor(Math.random() * 10000).toString().padStart(4, '0');

    const orderNumber = `#ORD-${year}${month}${day}-${random}`;

    // Animate the order number display
    let displayText = '#ORD-';
    let index = 5;
    const fullText = orderNumber;

    const interval = setInterval(() => {
        if (index < fullText.length) {
            displayText += fullText[index];
            orderNumberEl.textContent = displayText;
            index++;
        } else {
            clearInterval(interval);
        }
    }, 50);
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

// Confetti animation (optional enhancement)
function launchConfetti() {
    // Simple confetti effect using CSS animations
    const colors = ['#0066FF', '#00C9FF', '#7B2FFF', '#00D4AA', '#FFB800'];
    const confettiCount = 50;

    for (let i = 0; i < confettiCount; i++) {
        createConfetti(colors[Math.floor(Math.random() * colors.length)]);
    }
}

function createConfetti(color) {
    const confetti = document.createElement('div');
    confetti.style.cssText = `
        position: fixed;
        width: 10px;
        height: 10px;
        background: ${color};
        top: -10px;
        left: ${Math.random() * 100}%;
        opacity: ${Math.random()};
        transform: rotate(${Math.random() * 360}deg);
        animation: confetti-fall ${2 + Math.random() * 2}s linear forwards;
        z-index: 9999;
        pointer-events: none;
    `;

    // Add confetti animation if not exists
    if (!document.getElementById('confetti-styles')) {
        const style = document.createElement('style');
        style.id = 'confetti-styles';
        style.textContent = `
            @keyframes confetti-fall {
                to {
                    transform: translateY(100vh) rotate(${360 + Math.random() * 360}deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    document.body.appendChild(confetti);

    // Remove confetti after animation
    setTimeout(() => {
        confetti.remove();
    }, 4000);
}

// Launch confetti on page load
setTimeout(launchConfetti, 500);
