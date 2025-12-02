// Category Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initAnimations();

    // Setup wishlist functionality
    setupWishlist();

    // Setup filters
    setupFilters();

    // Setup sorting
    setupSorting();
});

// Initialize fade-in animations
function initAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.fade-in-up').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
}

// Setup wishlist functionality
function setupWishlist() {
    const wishlistBtns = document.querySelectorAll('.btn-wishlist');

    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const icon = this.querySelector('i');

            if (icon.classList.contains('bi-heart')) {
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
                this.style.background = '#ff4444';
                icon.style.color = '#fff';

                // Show toast notification
                showToast('Added to wishlist!');
            } else {
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
                this.style.background = '#fff';
                icon.style.color = '#ff4444';

                showToast('Removed from wishlist!');
            }
        });
    });
}

// Setup filters functionality
function setupFilters() {
    const clearFiltersBtn = document.querySelector('.btn-clear-filters');
    const checkboxes = document.querySelectorAll('.filter-checkbox input[type="checkbox"]');

    // Clear all filters
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            showToast('Filters cleared!');
        });
    }

    // Apply filters
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            applyFilters();
        });
    });
}

// Apply filters (placeholder function - would connect to backend in production)
function applyFilters() {
    // Get all checked filters
    const activeFilters = {
        price: [],
        level: [],
        duration: [],
        rating: []
    };

    document.querySelectorAll('.filter-checkbox input[type="checkbox"]:checked').forEach(checkbox => {
        const filterGroup = checkbox.closest('.filter-group');
        const filterType = filterGroup.querySelector('h4').textContent.toLowerCase();
        const filterValue = checkbox.nextElementSibling.textContent.trim();

        if (activeFilters[filterType]) {
            activeFilters[filterType].push(filterValue);
        }
    });

    console.log('Active filters:', activeFilters);
    // In production, this would trigger an API call or filter the courses client-side
}

// Setup sorting functionality
function setupSorting() {
    const sortSelect = document.querySelector('.sort-select');

    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            console.log('Sorting by:', sortBy);
            // In production, this would trigger a resort of the courses
            showToast(`Sorted by: ${sortBy}`);
        });
    }
}

// Show toast notification
function showToast(message) {
    // Remove existing toast if any
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }

    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.textContent = message;

    // Add styles
    Object.assign(toast.style, {
        position: 'fixed',
        bottom: '20px',
        right: '20px',
        background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        color: '#fff',
        padding: '1rem 1.5rem',
        borderRadius: '12px',
        boxShadow: '0 4px 12px rgba(102, 126, 234, 0.3)',
        zIndex: '9999',
        animation: 'slideInRight 0.3s ease-out',
        fontWeight: '600'
    });

    // Add animation
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

    document.body.appendChild(toast);

    // Remove toast after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Make course cards clickable
document.querySelectorAll('.course-card-category').forEach(card => {
    card.addEventListener('click', function(e) {
        // Don't trigger if clicking wishlist button
        if (!e.target.closest('.btn-wishlist')) {
            window.location.href = 'course-detail.php';
        }
    });
});
