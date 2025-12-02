// Teach Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initAnimations();

    // Setup FAQ accordion
    setupFAQ();

    // Setup CTA buttons
    setupCTAButtons();
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

// Setup FAQ Accordion
function setupFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', function() {
            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle current item
            item.classList.toggle('active');
        });
    });
}

// Setup CTA Buttons
function setupCTAButtons() {
    const ctaButtons = document.querySelectorAll('.btn-hero-cta, .btn-get-started, .btn-final-cta');

    ctaButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // In production, this would navigate to instructor signup page
            alert('Thank you for your interest in teaching on SAS-AI! Our instructor onboarding process will be available soon.');
        });
    });
}
