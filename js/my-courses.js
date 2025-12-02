// My Courses Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initMyCourses();
});

function initMyCourses() {
    initSidebarToggle();
    initTabSwitching();
    initSearch();
    initSort();
    animateProgressBars();
    initFadeInAnimations();
}

// Sidebar Toggle (same as dashboard)
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

// Tab Switching
function initTabSwitching() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const courseCards = document.querySelectorAll('.course-card');

    if (!tabButtons.length || !courseCards.length) return;

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Update active tab
            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Filter courses
            filterCourses(targetTab);
        });
    });
}

function filterCourses(filter) {
    const courseCards = document.querySelectorAll('.course-card');
    const coursesGrid = document.getElementById('coursesGrid');
    const emptyState = document.getElementById('emptyState');
    let visibleCount = 0;

    courseCards.forEach(card => {
        const status = card.getAttribute('data-status');

        if (filter === 'all') {
            card.style.display = 'block';
            visibleCount++;
        } else if (filter === status) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // Show/hide empty state
    if (visibleCount === 0) {
        coursesGrid.style.display = 'none';
        emptyState.style.display = 'flex';
    } else {
        coursesGrid.style.display = 'grid';
        emptyState.style.display = 'none';
    }

    // Re-animate visible cards
    setTimeout(() => {
        animateProgressBars();
    }, 100);
}

// Search Functionality
function initSearch() {
    const searchInput = document.getElementById('courseSearch');

    if (!searchInput) return;

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const courseCards = document.querySelectorAll('.course-card');
        const coursesGrid = document.getElementById('coursesGrid');
        const emptyState = document.getElementById('emptyState');
        let visibleCount = 0;

        courseCards.forEach(card => {
            const title = card.querySelector('.course-title').textContent.toLowerCase();
            const instructor = card.querySelector('.course-instructor').textContent.toLowerCase();
            const category = card.querySelector('.course-category').textContent.toLowerCase();

            // Check active tab
            const activeTab = document.querySelector('.tab-btn.active');
            const activeFilter = activeTab ? activeTab.getAttribute('data-tab') : 'all';
            const cardStatus = card.getAttribute('data-status');

            const matchesSearch = title.includes(searchTerm) ||
                                 instructor.includes(searchTerm) ||
                                 category.includes(searchTerm);

            const matchesFilter = activeFilter === 'all' || activeFilter === cardStatus;

            if (matchesSearch && matchesFilter) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide empty state
        if (visibleCount === 0) {
            coursesGrid.style.display = 'none';
            emptyState.style.display = 'flex';
        } else {
            coursesGrid.style.display = 'grid';
            emptyState.style.display = 'none';
        }
    });
}

// Sort Functionality
function initSort() {
    const sortSelect = document.getElementById('sortCourses');

    if (!sortSelect) return;

    sortSelect.addEventListener('change', function() {
        const sortBy = this.value;
        sortCourses(sortBy);
    });
}

function sortCourses(sortBy) {
    const coursesGrid = document.getElementById('coursesGrid');
    const courseCards = Array.from(coursesGrid.querySelectorAll('.course-card'));

    courseCards.sort((a, b) => {
        switch(sortBy) {
            case 'title':
                const titleA = a.querySelector('.course-title').textContent;
                const titleB = b.querySelector('.course-title').textContent;
                return titleA.localeCompare(titleB);

            case 'progress':
                const progressA = parseInt(a.querySelector('.progress-bar').getAttribute('data-progress'));
                const progressB = parseInt(b.querySelector('.progress-bar').getAttribute('data-progress'));
                return progressB - progressA;

            case 'recent':
            case 'date':
            default:
                // Keep original order for recent/date
                return 0;
        }
    });

    // Re-append sorted cards
    courseCards.forEach(card => {
        coursesGrid.appendChild(card);
    });

    // Re-animate progress bars
    setTimeout(() => {
        animateProgressBars();
    }, 100);
}

// Animate Progress Bars
function animateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar');

    if (!progressBars.length) return;

    progressBars.forEach(bar => {
        const parentCard = bar.closest('.course-card');

        // Only animate if visible
        if (parentCard && parentCard.style.display !== 'none') {
            const progress = bar.getAttribute('data-progress');

            // Reset width first
            bar.style.width = '0';

            // Animate after short delay
            setTimeout(() => {
                bar.style.width = progress + '%';
            }, 100);
        }
    });
}

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

// Download Certificate Function
function downloadCertificate(courseId) {
    // Placeholder function for certificate download
    console.log('Downloading certificate for course:', courseId);
    alert('Certificate download functionality will be implemented soon!');
}

// Course Settings Function
function openCourseSettings(courseId) {
    // Placeholder function for course settings
    console.log('Opening settings for course:', courseId);
    alert('Course settings functionality will be implemented soon!');
}

// Add certificate download handlers
document.addEventListener('click', function(e) {
    if (e.target.closest('.action-btn[title="Download Certificate"]') &&
        !e.target.closest('.action-btn').disabled) {
        const courseCard = e.target.closest('.course-card');
        const courseTitle = courseCard.querySelector('.course-title').textContent;
        downloadCertificate(courseTitle);
    }

    if (e.target.closest('.action-btn[title="Course Settings"]')) {
        const courseCard = e.target.closest('.course-card');
        const courseTitle = courseCard.querySelector('.course-title').textContent;
        openCourseSettings(courseTitle);
    }
});

// Add ripple effect to buttons
document.querySelectorAll('.btn-continue-small, .btn-play, .btn-browse').forEach(button => {
    button.addEventListener('click', function(e) {
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

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    // Press '/' to focus search
    if (e.key === '/' && e.target.tagName !== 'INPUT') {
        e.preventDefault();
        const searchInput = document.getElementById('courseSearch');
        if (searchInput) {
            searchInput.focus();
        }
    }

    // Press Escape to clear search
    if (e.key === 'Escape') {
        const searchInput = document.getElementById('courseSearch');
        if (searchInput && searchInput === document.activeElement) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.blur();
        }
    }
});

// Initialize tooltips for disabled buttons
document.querySelectorAll('.action-btn:disabled').forEach(btn => {
    btn.title = 'Complete the course to download certificate';
});

console.log('My Courses page initialized successfully');
