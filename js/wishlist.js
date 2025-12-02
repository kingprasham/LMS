// Wishlist Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initWishlist();
});

function initWishlist() {
    initSidebarToggle();
    initRemoveButtons();
    initAddToCartButtons();
    initBulkActions();
    initFadeInAnimations();
}

// Sidebar Toggle (same as dashboard and my-courses)
function initSidebarToggle() {
    const sidebar = document.getElementById('dashboardSidebar');
    const mobileToggle = document.getElementById('mobileSidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !mobileToggle || !overlay) return;

    mobileToggle.addEventListener('click', function() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    });

    const sidebarLinks = sidebar.querySelectorAll('.sidebar-link');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 992) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}

// Remove Course from Wishlist
function initRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-btn');

    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.getAttribute('data-course-id');
            const card = this.closest('.wishlist-card');

            // Confirm removal
            if (confirm('Remove this course from your wishlist?')) {
                removeCourseFromWishlist(courseId, card);
            }
        });
    });
}

function removeCourseFromWishlist(courseId, card) {
    // Animate card removal
    card.style.transition = 'all 0.3s ease';
    card.style.opacity = '0';
    card.style.transform = 'scale(0.9)';

    setTimeout(() => {
        card.remove();
        updateWishlistStats();
        checkEmptyState();

        // Show success notification
        showNotification('Course removed from wishlist', 'success');
    }, 300);

    // Remove from localStorage (if implemented)
    removeFromLocalStorage(courseId);
}

// Add to Cart
function initAddToCartButtons() {
    const addToCartButtons = document.querySelectorAll('.btn-add-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.getAttribute('data-course-id');
            const card = this.closest('.wishlist-card');
            const courseTitle = card.querySelector('.course-title').textContent;

            addToCart(courseId, courseTitle, card);
        });
    });
}

function addToCart(courseId, courseTitle, card) {
    // Add to cart localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Check if already in cart
    if (cart.find(item => item.id === courseId)) {
        showNotification('Course already in cart', 'info');
        return;
    }

    // Add to cart
    cart.push({ id: courseId, title: courseTitle });
    localStorage.setItem('cart', JSON.stringify(cart));

    // Update cart count in navbar
    updateCartCount();

    // Show success notification
    showNotification('Added to cart! Visit cart to checkout.', 'success');

    // Optional: Remove from wishlist after adding to cart
    if (confirm('Would you like to remove this course from your wishlist?')) {
        removeCourseFromWishlist(courseId, card);
    }
}

// Bulk Actions
function initBulkActions() {
    const moveAllBtn = document.getElementById('moveAllToCart');
    const clearAllBtn = document.getElementById('clearWishlist');

    if (moveAllBtn) {
        moveAllBtn.addEventListener('click', moveAllToCart);
    }

    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', clearWishlist);
    }
}

function moveAllToCart() {
    const wishlistCards = document.querySelectorAll('.wishlist-card');

    if (wishlistCards.length === 0) {
        showNotification('Your wishlist is empty', 'info');
        return;
    }

    if (confirm(`Move all ${wishlistCards.length} courses to cart?`)) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        wishlistCards.forEach(card => {
            const courseId = card.getAttribute('data-course-id');
            const courseTitle = card.querySelector('.course-title').textContent;

            // Add to cart if not already there
            if (!cart.find(item => item.id === courseId)) {
                cart.push({ id: courseId, title: courseTitle });
            }
        });

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();

        // Clear wishlist
        clearWishlist(false);

        showNotification('All courses moved to cart!', 'success');
    }
}

function clearWishlist(showConfirm = true) {
    const wishlistCards = document.querySelectorAll('.wishlist-card');

    if (wishlistCards.length === 0) {
        showNotification('Your wishlist is already empty', 'info');
        return;
    }

    if (showConfirm && !confirm(`Remove all ${wishlistCards.length} courses from wishlist?`)) {
        return;
    }

    // Animate all cards removal
    wishlistCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.transition = 'all 0.3s ease';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';

            setTimeout(() => {
                card.remove();
                updateWishlistStats();
                checkEmptyState();
            }, 300);
        }, index * 50); // Stagger animation
    });

    // Clear from localStorage
    localStorage.removeItem('wishlist');

    setTimeout(() => {
        if (showConfirm) {
            showNotification('Wishlist cleared', 'success');
        }
    }, wishlistCards.length * 50 + 300);
}

// Update Wishlist Statistics
function updateWishlistStats() {
    const wishlistCards = document.querySelectorAll('.wishlist-card');
    const countElement = document.getElementById('wishlistCount');
    const totalValueElement = document.getElementById('totalValue');

    if (countElement) {
        countElement.textContent = wishlistCards.length;
    }

    if (totalValueElement && wishlistCards.length > 0) {
        let totalValue = 0;
        wishlistCards.forEach(card => {
            const priceText = card.querySelector('.current-price').textContent;
            const price = parseFloat(priceText.replace('$', ''));
            totalValue += price;
        });
        totalValueElement.textContent = '$' + totalValue.toFixed(2);
    } else if (totalValueElement) {
        totalValueElement.textContent = '$0.00';
    }
}

// Check if wishlist is empty and show empty state
function checkEmptyState() {
    const wishlistGrid = document.getElementById('wishlistGrid');
    const emptyState = document.getElementById('emptyState');
    const wishlistCards = document.querySelectorAll('.wishlist-card');

    if (wishlistCards.length === 0) {
        if (wishlistGrid) wishlistGrid.style.display = 'none';
        if (emptyState) emptyState.style.display = 'flex';
    } else {
        if (wishlistGrid) wishlistGrid.style.display = 'grid';
        if (emptyState) emptyState.style.display = 'none';
    }
}

// Update Cart Count in Navbar
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartCountElements = document.querySelectorAll('#cart-count, #mobile-cart-count');

    cartCountElements.forEach(element => {
        if (element) {
            element.textContent = cart.length;
            if (cart.length > 0) {
                element.style.display = 'flex';
            }
        }
    });
}

// LocalStorage Management
function removeFromLocalStorage(courseId) {
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    wishlist = wishlist.filter(item => item.id !== courseId);
    localStorage.setItem('wishlist', JSON.stringify(wishlist));
}

// Show Notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;

    // Styling
    Object.assign(notification.style, {
        position: 'fixed',
        top: '20px',
        right: '20px',
        padding: '1rem 1.5rem',
        borderRadius: '10px',
        backgroundColor: type === 'success' ? '#28a745' : type === 'info' ? '#007bff' : '#ffc107',
        color: 'white',
        fontWeight: '600',
        boxShadow: '0 4px 12px rgba(0, 0, 0, 0.15)',
        zIndex: '10000',
        animation: 'slideInRight 0.3s ease',
        maxWidth: '300px'
    });

    document.body.appendChild(notification);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Add notification animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Fade In Animations
function initFadeInAnimations() {
    const fadeElements = document.querySelectorAll('.fade-in-up');

    if (!fadeElements.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    fadeElements.forEach(element => {
        element.style.animationPlayState = 'paused';
        observer.observe(element);
    });
}

// Initialize cart count on page load
updateCartCount();
checkEmptyState();

console.log('Wishlist page initialized successfully');
