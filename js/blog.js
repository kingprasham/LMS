// Blog Listing Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initAnimations();

    // Setup category filters
    setupCategoryFilters();

    // Setup search functionality
    setupSearch();

    // Setup sort functionality
    setupSort();

    // Setup load more button
    setupLoadMore();
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

// Setup Category Filters
function setupCategoryFilters() {
    const filterCheckboxes = document.querySelectorAll('.category-filter-item input[type="checkbox"]');
    const allArticlesCheckbox = filterCheckboxes[0]; // First checkbox is "All Articles"
    const blogCards = document.querySelectorAll('.blog-card');

    filterCheckboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', function() {
            if (index === 0) {
                // "All Articles" checkbox
                if (this.checked) {
                    // Uncheck all other checkboxes
                    filterCheckboxes.forEach((cb, i) => {
                        if (i !== 0) cb.checked = false;
                    });
                    // Show all cards
                    blogCards.forEach(card => {
                        card.style.display = 'block';
                    });
                }
            } else {
                // Other category checkboxes
                if (this.checked) {
                    // Uncheck "All Articles"
                    allArticlesCheckbox.checked = false;
                }

                // Filter cards based on selected categories
                filterBlogCards();
            }

            // If no checkboxes are checked, check "All Articles"
            const anyChecked = Array.from(filterCheckboxes).some(cb => cb.checked);
            if (!anyChecked) {
                allArticlesCheckbox.checked = true;
                blogCards.forEach(card => {
                    card.style.display = 'block';
                });
            }
        });
    });
}

// Filter blog cards based on selected categories
function filterBlogCards() {
    const filterCheckboxes = document.querySelectorAll('.category-filter-item input[type="checkbox"]');
    const blogCards = document.querySelectorAll('.blog-card');

    // Get selected categories (skip the first "All Articles" checkbox)
    const selectedCategories = [];
    filterCheckboxes.forEach((checkbox, index) => {
        if (index > 0 && checkbox.checked) {
            const categoryName = checkbox.parentElement.querySelector('span:not(.count)').textContent.trim();
            selectedCategories.push(categoryName);
        }
    });

    // Show/hide cards based on selected categories
    blogCards.forEach(card => {
        const cardCategory = card.querySelector('.blog-category').textContent.trim();

        if (selectedCategories.length === 0 || selectedCategories.includes(cardCategory)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Setup Search Functionality
function setupSearch() {
    const searchInput = document.querySelector('.search-box input');
    const blogCards = document.querySelectorAll('.blog-card');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();

            blogCards.forEach(card => {
                const title = card.querySelector('.blog-title').textContent.toLowerCase();
                const excerpt = card.querySelector('.blog-excerpt').textContent.toLowerCase();
                const category = card.querySelector('.blog-category').textContent.toLowerCase();

                if (title.includes(searchTerm) || excerpt.includes(searchTerm) || category.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
}

// Setup Sort Functionality
function setupSort() {
    const sortSelect = document.querySelector('.sort-select');
    const blogGrid = document.querySelector('.blog-articles-grid');

    if (sortSelect && blogGrid) {
        sortSelect.addEventListener('change', function() {
            const blogCards = Array.from(document.querySelectorAll('.blog-card'));
            const sortValue = this.value;

            // Sort cards based on selected option
            blogCards.sort((a, b) => {
                const dateA = new Date(a.querySelector('.blog-date').textContent.replace(/.*\s/, ''));
                const dateB = new Date(b.querySelector('.blog-date').textContent.replace(/.*\s/, ''));

                if (sortValue === 'Latest First') {
                    return dateB - dateA;
                } else if (sortValue === 'Oldest First') {
                    return dateA - dateB;
                } else if (sortValue === 'Most Popular') {
                    // For demo purposes, using animation delay as a proxy for popularity
                    const delayA = parseFloat(a.style.animationDelay) || 0;
                    const delayB = parseFloat(b.style.animationDelay) || 0;
                    return delayA - delayB;
                }
                return 0;
            });

            // Clear grid and re-append sorted cards
            blogGrid.innerHTML = '';
            blogCards.forEach(card => {
                blogGrid.appendChild(card);
            });
        });
    }
}

// Setup Load More Button
function setupLoadMore() {
    const loadMoreBtn = document.querySelector('.btn-load-more');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // In a production environment, this would load more articles via AJAX
            // For now, show a message
            this.textContent = 'Loading...';
            this.disabled = true;

            setTimeout(() => {
                alert('In production, this would load more articles from the database.');
                this.textContent = 'Load More Articles';
                this.disabled = false;
            }, 1000);
        });
    }
}

// Make blog cards clickable
document.addEventListener('DOMContentLoaded', function() {
    const blogCards = document.querySelectorAll('.blog-card');

    blogCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Don't trigger if clicking on a link
            if (e.target.tagName !== 'A' && !e.target.closest('a')) {
                const readMoreLink = this.querySelector('.blog-read-more');
                if (readMoreLink) {
                    window.location.href = readMoreLink.getAttribute('href');
                }
            }
        });
    });
});
