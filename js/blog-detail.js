// Blog Detail Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initAnimations();

    // Setup share buttons
    setupShareButtons();

    // Setup newsletter form
    setupNewsletter();
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

// Setup share buttons
function setupShareButtons() {
    const shareButtons = document.querySelectorAll('.share-btn');
    const pageUrl = encodeURIComponent(window.location.href);
    const pageTitle = encodeURIComponent(document.title);

    shareButtons.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            let shareUrl = '';

            if (icon.classList.contains('bi-facebook')) {
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
            } else if (icon.classList.contains('bi-twitter-x')) {
                shareUrl = `https://twitter.com/intent/tweet?url=${pageUrl}&text=${pageTitle}`;
            } else if (icon.classList.contains('bi-linkedin')) {
                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${pageUrl}`;
            } else if (icon.classList.contains('bi-envelope')) {
                shareUrl = `mailto:?subject=${pageTitle}&body=Check out this article: ${pageUrl}`;
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        });
    });
}

// Setup newsletter form
function setupNewsletter() {
    const form = document.querySelector('.newsletter-form');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input').value;

            // Show success message
            alert(`Thank you for subscribing with ${email}!`);
            this.reset();
        });
    }
}

// Make related articles clickable
document.querySelectorAll('.related-article-item').forEach(item => {
    item.addEventListener('click', function() {
        window.location.href = 'blog-detail.php?id=2';
    });
});
