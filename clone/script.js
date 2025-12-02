// ============================================
// ANIMATION UTILITIES & SCROLL EFFECTS
// ============================================

// Intersection Observer for scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

// Initialize all animations when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initScrollAnimations();
    initCounterAnimations();
    initHeroAnimations();
    initCourseCardAnimations();
    initFeatureCardAnimations();
    initFAQAnimations();
    initEcosystemAnimations();
    initFacultyAnimations();
});

// ============================================
// SCROLL ANIMATIONS
// ============================================
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                // Optional: stop observing after animation
                scrollObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach(el => scrollObserver.observe(el));
}

// ============================================
// ANIMATED COUNTERS
// ============================================
function initCounterAnimations() {
    const counters = document.querySelectorAll('.stat-number, .stat-number-modern');

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                animateCounter(entry.target);
                entry.target.classList.add('counted');
                counterObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    counters.forEach(counter => counterObserver.observe(counter));
}

function animateCounter(element) {
    const target = element.getAttribute('data-target');
    const suffix = element.getAttribute('data-suffix') || '';
    const duration = 2000; // 2 seconds
    const increment = target / (duration / 16); // 60fps
    let current = 0;

    const updateCounter = () => {
        current += increment;
        if (current < target) {
            element.textContent = Math.floor(current) + suffix;
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = target + suffix;
        }
    };

    updateCounter();
}

// ============================================
// HERO SECTION ANIMATIONS
// ============================================
function initHeroAnimations() {
    // Animate hero text elements with stagger effect
    const heroTitle = document.querySelector('.hero-text h1');
    const heroPractical = document.querySelector('.hero-text .practical-text');
    const heroLead = document.querySelector('.hero-text .lead');
    const heroBtn = document.querySelector('.hero-text .explore-btn');
    const heroImage = document.querySelector('.hero-image-wrapper-new');

    setTimeout(() => {
        if (heroTitle) heroTitle.classList.add('fade-in-up');
    }, 100);

    setTimeout(() => {
        if (heroPractical) heroPractical.classList.add('fade-in-up');
    }, 300);

    setTimeout(() => {
        if (heroLead) heroLead.classList.add('fade-in-up');
    }, 500);

    setTimeout(() => {
        if (heroBtn) heroBtn.classList.add('fade-in-up');
    }, 700);

    setTimeout(() => {
        if (heroImage) heroImage.classList.add('fade-in-right');
    }, 400);
}

// ============================================
// COURSE CARD ANIMATIONS
// ============================================
function initCourseCardAnimations() {
    const courseCards = document.querySelectorAll('.course-card-container');

    courseCards.forEach((card, index) => {
        // Add hover effect enhancements
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });

        // Staggered entrance animation
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('fade-in-up');
                    }, index * 150); // Stagger by 150ms
                    cardObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        cardObserver.observe(card);
    });
}

// ============================================
// FEATURE CARD ANIMATIONS
// ============================================
function initFeatureCardAnimations() {
    const featureCards = document.querySelectorAll('.feature-card');

    featureCards.forEach((card, index) => {
        // Enhanced hover effects
        const cardImage = card.querySelector('.card-image');

        card.addEventListener('mouseenter', function() {
            if (cardImage) {
                cardImage.style.transform = 'scale(1.05) translateY(-5px)';
            }
        });

        card.addEventListener('mouseleave', function() {
            if (cardImage) {
                cardImage.style.transform = 'scale(1) translateY(0)';
            }
        });

        // Staggered entrance animation
        const featureObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('fade-in-up');
                    }, index * 100); // Stagger by 100ms
                    featureObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        featureObserver.observe(card);
    });
}

// ============================================
// FAQ ANIMATIONS
// ============================================
function initFAQAnimations() {
    const faqCards = document.querySelectorAll('.faq-card');

    faqCards.forEach((card, index) => {
        const faqObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('fade-in-up');
                    }, index * 100);
                    faqObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        faqObserver.observe(card);
    });

    // Smooth collapse animations
    const faqButtons = document.querySelectorAll('.faq-question');
    faqButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Add ripple effect
            createRipple(this, event);
        });
    });
}

// ============================================
// ECOSYSTEM SECTION ANIMATIONS
// ============================================
function initEcosystemAnimations() {
    const ecosystemCards = document.querySelectorAll('.ecosystem-card');

    ecosystemCards.forEach((card, index) => {
        // Enhanced hover effects
        const cardIcon = card.querySelector('.icon-gradient');

        card.addEventListener('mouseenter', function() {
            if (cardIcon) {
                cardIcon.style.transform = 'scale(1.1) rotate(5deg)';
            }
        });

        card.addEventListener('mouseleave', function() {
            if (cardIcon) {
                cardIcon.style.transform = 'scale(1) rotate(0deg)';
            }
        });

        // Staggered entrance animation
        const ecosystemObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('fade-in-up');
                    }, index * 100); // Stagger by 100ms
                    ecosystemObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        ecosystemObserver.observe(card);
    });
}

// ============================================
// FACULTY SECTION ANIMATIONS
// ============================================
function initFacultyAnimations() {
    const facultyCards = document.querySelectorAll('.faculty-card');

    facultyCards.forEach((card, index) => {
        // Staggered entrance animation
        const facultyObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('fade-in-up');
                    }, index * 150); // Stagger by 150ms
                    facultyObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        facultyObserver.observe(card);
    });
}

// ============================================
// UTILITY FUNCTIONS
// ============================================

// Ripple effect for buttons
function createRipple(element, event) {
    const ripple = document.createElement('span');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;

    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple-effect');

    element.appendChild(ripple);

    setTimeout(() => {
        ripple.remove();
    }, 600);
}

// Add ripple effect to all primary buttons
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn-primary, .explore-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            createRipple(this, e);
        });
    });
});

// ============================================
// NAVBAR SCROLL EFFECT
// ============================================
let lastScroll = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    // Add shadow on scroll
    if (currentScroll > 50) {
        navbar.classList.add('navbar-scrolled');
    } else {
        navbar.classList.remove('navbar-scrolled');
    }

    lastScroll = currentScroll;
});

// ============================================
// SMOOTH SCROLL FOR ANCHOR LINKS
// ============================================
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

// ============================================
// PARALLAX EFFECT FOR HERO IMAGE
// ============================================
window.addEventListener('scroll', () => {
    const heroImage = document.querySelector('.hero-image-wrapper-new');
    if (heroImage) {
        const scrolled = window.pageYOffset;
        const rate = scrolled * 0.3;
        heroImage.style.transform = `translateY(${rate}px)`;
    }
});

// ============================================
// LOADING ANIMATION
// ============================================
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
});

// ============================================
// SEARCH BOX ENHANCEMENT
// ============================================
const searchInput = document.querySelector('.search-box input');
if (searchInput) {
    searchInput.addEventListener('focus', function() {
        this.parentElement.parentElement.classList.add('search-focused');
    });

    searchInput.addEventListener('blur', function() {
        this.parentElement.parentElement.classList.remove('search-focused');
    });
}

// ============================================
// COURSE TABS ANIMATION
// ============================================
const courseTabs = document.querySelectorAll('.courses-tabs .nav-link');
courseTabs.forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();

        // Remove active class from all tabs
        courseTabs.forEach(t => t.classList.remove('active'));

        // Add active class to clicked tab
        this.classList.add('active');

        // Add animation to course cards
        const courseCards = document.querySelectorAll('.course-card-container');
        courseCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.4s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
});

// ============================================
// COMPANY LOGOS ANIMATION
// ============================================
const companyLogos = document.querySelectorAll('.company-logos img');
const logoObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'scale(1)';
            }, index * 150);
            logoObserver.unobserve(entry.target);
        }
    });
}, observerOptions);

companyLogos.forEach(logo => {
    logo.style.opacity = '0';
    logo.style.transform = 'scale(0.8)';
    logo.style.transition = 'all 0.5s ease';
    logoObserver.observe(logo);
});

// ============================================
// SCROLL TO TOP BUTTON
// ============================================
const scrollToTopBtn = document.getElementById('scrollToTop');

if (scrollToTopBtn) {
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ============================================
// COURSE FILTERS (MODERN DESIGN)
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const filterPills = document.querySelectorAll('.filter-pill');

    filterPills.forEach(pill => {
        pill.addEventListener('click', function() {
            // Remove active class from all pills
            filterPills.forEach(p => p.classList.remove('active'));

            // Add active class to clicked pill
            this.classList.add('active');

            // Add animation to course cards
            const courseCards = document.querySelectorAll('.course-card-redesign');
            courseCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    });
});

// ============================================
// COURSE CARD ANIMATIONS (REDESIGNED)
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const courseCardsRedesign = document.querySelectorAll('.course-card-redesign');

    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 150);
                cardObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    courseCardsRedesign.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        cardObserver.observe(card);
    });
});
