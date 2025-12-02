// Student Dashboard JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initDashboard();
});

function initDashboard() {
    initSidebarToggle();
    animateStatCards();
    animateProgressBars();
    initFadeInAnimations();
}

// Sidebar Toggle for Mobile
function initSidebarToggle() {
    const sidebar = document.getElementById('dashboardSidebar');
    const mobileToggle = document.getElementById('mobileSidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !mobileToggle || !overlay) return;

    // Open sidebar
    mobileToggle.addEventListener('click', function() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    // Close sidebar
    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    });

    // Close on sidebar link click (mobile)
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

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}

// Animate Stat Cards with Count Up
function animateStatCards() {
    const statValues = document.querySelectorAll('.stat-value');

    if (!statValues.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-target'));
                animateCount(entry.target, 0, target, 1500);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });

    statValues.forEach(stat => {
        observer.observe(stat);
    });
}

// Count Up Animation
function animateCount(element, start, end, duration) {
    const startTime = performance.now();

    function updateCount(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Easing function (ease out cubic)
        const easeOut = 1 - Math.pow(1 - progress, 3);
        const current = Math.floor(start + (end - start) * easeOut);

        element.textContent = current;

        if (progress < 1) {
            requestAnimationFrame(updateCount);
        } else {
            element.textContent = end;
        }
    }

    requestAnimationFrame(updateCount);
}

// Animate Progress Bars
function animateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar');

    if (!progressBars.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const progress = progressBar.getAttribute('data-progress');

                setTimeout(() => {
                    progressBar.style.width = progress + '%';
                }, 100);

                observer.unobserve(progressBar);
            }
        });
    }, {
        threshold: 0.3
    });

    progressBars.forEach(bar => {
        observer.observe(bar);
    });
}

// Fade In Animations on Scroll
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

// Smooth scroll to sections
function smoothScroll(target) {
    const element = document.querySelector(target);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Load user courses from localStorage (for future integration)
function loadUserCourses() {
    // This will be integrated with actual data later
    const courses = localStorage.getItem('userCourses');
    if (courses) {
        return JSON.parse(courses);
    }
    return [];
}

// Update course progress
function updateCourseProgress(courseId, progress) {
    const courses = loadUserCourses();
    const course = courses.find(c => c.id === courseId);
    if (course) {
        course.progress = progress;
        localStorage.setItem('userCourses', JSON.stringify(courses));

        // Update UI
        const progressBar = document.querySelector(`[data-course-id="${courseId}"] .progress-bar`);
        const progressText = document.querySelector(`[data-course-id="${courseId}"] .progress-text`);
        const badge = document.querySelector(`[data-course-id="${courseId}"] .course-badge`);

        if (progressBar) {
            progressBar.style.width = progress + '%';
        }
        if (progressText) {
            progressText.textContent = progress + '%';
        }
        if (badge) {
            badge.textContent = progress + '% Complete';
        }
    }
}

// Initialize tooltips if Bootstrap is available
if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Add visual feedback for interactive elements
document.querySelectorAll('.btn-continue, .btn-view-course').forEach(button => {
    button.addEventListener('click', function(e) {
        // Create ripple effect
        const ripple = document.createElement('span');
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.6)';
        ripple.style.width = '100px';
        ripple.style.height = '100px';
        ripple.style.marginTop = '-50px';
        ripple.style.marginLeft = '-50px';
        ripple.style.animation = 'ripple 0.6s';
        ripple.style.pointerEvents = 'none';

        const rect = this.getBoundingClientRect();
        ripple.style.left = (e.clientX - rect.left) + 'px';
        ripple.style.top = (e.clientY - rect.top) + 'px';

        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add CSS for ripple animation dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        from {
            opacity: 1;
            transform: scale(0);
        }
        to {
            opacity: 0;
            transform: scale(2);
        }
    }
`;
document.head.appendChild(style);

// Console log for debugging
console.log('Dashboard initialized successfully');
