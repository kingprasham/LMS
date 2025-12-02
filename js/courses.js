// Course Catalog (Marketplace) JavaScript

document.addEventListener('DOMContentLoaded', function () {
    // Initialize animations
    initAnimations();

    // Setup filters
    setupFilters();

    // Setup price range slider
    setupPriceRange();

    // Setup sorting
    setupSorting();

    // Setup wishlist
    setupWishlist();

    // Setup add to cart
    setupAddToCart();

    // Setup filter collapse/expand
    setupFilterToggle();

    // Setup clear filters
    setupClearFilters();

    // Apply filters from URL
    applyFiltersFromURL();
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

// Setup Filters
function setupFilters() {
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox input[type="checkbox"]');
    const courseCards = document.querySelectorAll('.course-card');

    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            filterCourses();
        });
    });
}

// Filter Courses
function filterCourses() {
    const categoryFilters = getSelectedFilters('category');
    const priceFilters = getSelectedFilters('price');
    const ratingFilters = getSelectedFilters('rating');
    const levelFilters = getSelectedFilters('level');

    const courseCards = document.querySelectorAll('.course-card');
    let visibleCount = 0;

    courseCards.forEach(card => {
        let showCard = true;

        // Category filter
        if (categoryFilters.length > 0) {
            const cardCategory = card.dataset.category;
            if (!categoryFilters.includes(cardCategory)) {
                showCard = false;
            }
        }

        // Price filter
        if (priceFilters.length > 0) {
            const cardPrice = parseInt(card.dataset.price);
            const isFree = cardPrice === 0;
            const isPaid = cardPrice > 0;

            if (priceFilters.includes('free') && !isFree) {
                showCard = false;
            }
            if (priceFilters.includes('paid') && !isPaid) {
                showCard = false;
            }
        }

        // Rating filter
        if (ratingFilters.length > 0) {
            const cardRating = parseFloat(card.dataset.rating);
            const minRating = Math.min(...ratingFilters.map(r => parseFloat(r)));
            if (cardRating < minRating) {
                showCard = false;
            }
        }

        // Level filter
        if (levelFilters.length > 0) {
            const cardLevel = card.dataset.level;
            if (!levelFilters.includes(cardLevel) && !levelFilters.includes('all-levels')) {
                showCard = false;
            }
        }

        // Show/hide card
        if (showCard) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // Update results count
    updateResultsCount(visibleCount);
}

// Get Selected Filters
function getSelectedFilters(filterName) {
    const checkboxes = document.querySelectorAll(`input[name="${filterName}"]:checked`);
    return Array.from(checkboxes).map(cb => cb.value);
}

// Update Results Count
function updateResultsCount(count) {
    const resultsCountEl = document.getElementById('results-count');
    if (resultsCountEl) {
        resultsCountEl.textContent = count.toLocaleString();
    }
}

// Setup Price Range Slider
function setupPriceRange() {
    const minSlider = document.getElementById('price-range-min');
    const maxSlider = document.getElementById('price-range-max');
    const minDisplay = document.getElementById('price-min');
    const maxDisplay = document.getElementById('price-max');

    if (minSlider && maxSlider) {
        minSlider.addEventListener('input', function () {
            let minValue = parseInt(this.value);
            let maxValue = parseInt(maxSlider.value);

            if (minValue > maxValue - 500) {
                minValue = maxValue - 500;
                this.value = minValue;
            }

            minDisplay.textContent = minValue.toLocaleString();
            filterByPriceRange(minValue, maxValue);
        });

        maxSlider.addEventListener('input', function () {
            let maxValue = parseInt(this.value);
            let minValue = parseInt(minSlider.value);

            if (maxValue < minValue + 500) {
                maxValue = minValue + 500;
                this.value = maxValue;
            }

            maxDisplay.textContent = maxValue.toLocaleString();
            filterByPriceRange(minValue, maxValue);
        });
    }
}

// Filter by Price Range
function filterByPriceRange(min, max) {
    const courseCards = document.querySelectorAll('.course-card');
    let visibleCount = 0;

    courseCards.forEach(card => {
        const price = parseInt(card.dataset.price);
        if (price >= min && price <= max) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    updateResultsCount(visibleCount);
}

// Setup Sorting
function setupSorting() {
    const sortSelect = document.getElementById('sort-by');

    if (sortSelect) {
        sortSelect.addEventListener('change', function () {
            const sortValue = this.value;
            sortCourses(sortValue);
        });
    }
}

// Sort Courses
function sortCourses(sortBy) {
    const coursesGrid = document.querySelector('.courses-grid');
    const courseCards = Array.from(document.querySelectorAll('.course-card'));

    courseCards.sort((a, b) => {
        switch (sortBy) {
            case 'price-low-high':
                return parseInt(a.dataset.price) - parseInt(b.dataset.price);

            case 'price-high-low':
                return parseInt(b.dataset.price) - parseInt(a.dataset.price);

            case 'highest-rated':
                return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);

            case 'newest':
                // In production, this would use actual date data
                return 0;

            case 'most-popular':
                // In production, this would use enrollment data
                return 0;

            default:
                return 0;
        }
    });

    // Clear grid and re-append sorted cards
    coursesGrid.innerHTML = '';
    courseCards.forEach(card => {
        coursesGrid.appendChild(card);
    });
}

// Setup Wishlist
function setupWishlist() {
    const wishlistBtns = document.querySelectorAll('.btn-wishlist-course');

    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            this.classList.toggle('active');

            if (this.classList.contains('active')) {
                this.querySelector('i').classList.remove('bi-heart');
                this.querySelector('i').classList.add('bi-heart-fill');
                showToast('Added to wishlist');
            } else {
                this.querySelector('i').classList.remove('bi-heart-fill');
                this.querySelector('i').classList.add('bi-heart');
                showToast('Removed from wishlist');
            }
        });
    });
}

// Setup Add to Cart
function setupAddToCart() {
    const addToCartBtns = document.querySelectorAll('.btn-add-cart');

    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();

            // Animation effect
            this.innerHTML = '<i class="bi bi-check-circle-fill"></i> Added!';
            this.style.background = '#00D4AA';
            this.style.color = 'white';

            // Show toast
            showToast('Course added to cart!');

            // Update cart count
            updateCartCount();

            // Reset button after 2 seconds
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-cart-plus"></i> Add to Cart';
                this.style.background = 'white';
                this.style.color = '#667eea';
            }, 2000);
        });
    });
}

// Update Cart Count
function updateCartCount() {
    const cartBadge = document.getElementById('cart-count');
    const mobileCartBadge = document.getElementById('mobile-cart-count');

    if (cartBadge) {
        const currentCount = parseInt(cartBadge.textContent) || 0;
        cartBadge.textContent = currentCount + 1;
    }

    if (mobileCartBadge) {
        const currentCount = parseInt(mobileCartBadge.textContent) || 0;
        mobileCartBadge.textContent = currentCount + 1;
    }
}

// Setup Filter Toggle
function setupFilterToggle() {
    const filterTitles = document.querySelectorAll('.filter-title');

    filterTitles.forEach(title => {
        title.addEventListener('click', function () {
            const filterGroup = this.parentElement;
            filterGroup.classList.toggle('collapsed');
        });
    });
}

// Setup Clear Filters
function setupClearFilters() {
    const clearBtn = document.querySelector('.btn-clear-filters');

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            // Uncheck all checkboxes
            const allCheckboxes = document.querySelectorAll('.filter-checkbox input[type="checkbox"]');
            allCheckboxes.forEach(cb => cb.checked = false);

            // Reset price sliders
            const minSlider = document.getElementById('price-range-min');
            const maxSlider = document.getElementById('price-range-max');
            const minDisplay = document.getElementById('price-min');
            const maxDisplay = document.getElementById('price-max');

            if (minSlider) {
                minSlider.value = 0;
                minDisplay.textContent = '0';
            }
            if (maxSlider) {
                maxSlider.value = 10000;
                maxDisplay.textContent = '10,000';
            }

            // Show all courses
            const courseCards = document.querySelectorAll('.course-card');
            courseCards.forEach(card => {
                card.style.display = 'block';
            });

            // Update count
            updateResultsCount(courseCards.length);

            // Show toast
            showToast('All filters cleared');
        });
    }
}

// Show Toast Notification
function showToast(message) {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
        z-index: 10000;
        animation: slideInUp 0.4s ease-out;
        font-weight: 600;
    `;

    document.body.appendChild(toast);

    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'slideOutDown 0.4s ease-out';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 400);
    }, 3000);
}

// Add CSS animations for toast
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInUp {
        from {
            transform: translateY(100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideOutDown {
        from {
            transform: translateY(0);
            opacity: 1;
        }
        to {
            transform: translateY(100px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Make course cards clickable
document.addEventListener('DOMContentLoaded', function () {
    const courseCards = document.querySelectorAll('.course-card');

    courseCards.forEach(card => {
        card.addEventListener('click', function (e) {
            // Don't trigger if clicking on buttons
            if (e.target.closest('.btn-add-cart') ||
                e.target.closest('.btn-wishlist-course')) {
                return;
            }

            // Navigate to course detail page
            window.location.href = '../pages/course-detail.php';
        });
    });
});

// Apply Filters from URL
function applyFiltersFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');

    if (categoryParam) {
        const checkbox = document.querySelector(`.filter-checkbox input[name="category"][value="${categoryParam}"]`);
        if (checkbox) {
            checkbox.checked = true;
            // Open the category filter group if collapsed
            const filterGroup = checkbox.closest('.filter-group');
            if (filterGroup && filterGroup.classList.contains('collapsed')) {
                filterGroup.classList.remove('collapsed');
            }
            filterCourses();
        }
    }
}
