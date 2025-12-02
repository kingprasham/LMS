// Careers Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initAnimations();

    // Setup position filters
    setupPositionFilters();

    // Setup apply buttons
    setupApplyButtons();

    // Setup smooth scrolling
    setupSmoothScroll();
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

// Setup Position Filters
function setupPositionFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const positionCards = document.querySelectorAll('.position-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Get filter category
            const filter = this.dataset.filter;

            // Show/hide position cards
            positionCards.forEach(card => {
                const category = card.dataset.category;

                if (filter === 'all' || category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
}

// Setup Apply Buttons
function setupApplyButtons() {
    const applyBtns = document.querySelectorAll('.btn-apply');

    applyBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();

            const positionTitle = this.closest('.position-card').querySelector('h3').textContent;

            // In production, this would open an application form
            showToast(`Application form for "${positionTitle}" will open soon!`);

            // Simulate button state change
            const originalText = this.textContent;
            this.innerHTML = '<i class="bi bi-check-circle-fill"></i> Applied!';
            this.style.background = '#00D4AA';

            setTimeout(() => {
                this.textContent = originalText;
                this.style.background = '';
            }, 2000);
        });
    });
}

// Setup Smooth Scrolling
function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Show Toast Notification
function showToast(message) {
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
