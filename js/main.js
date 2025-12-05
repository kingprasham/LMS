// Main JavaScript file for Udemy Clone

// Sample course data
const courses = [
    {
        id: 1,
        title: "Learning Python for Data Analysis and Visualization",
        author: "Jose Portilla",
        rating: 4.4,
        price: 455,
        image: "https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=480&h=270&fit=crop",
        category: "Development",
        level: "All Levels"
    },
    {
        id: 2,
        title: "The Complete Web Developer Course 2.0",
        author: "Rob Percival",
        rating: 4.5,
        price: 455,
        image: "https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=480&h=270&fit=crop",
        category: "Development",
        level: "All Levels"
    },
    {
        id: 3,
        title: "Machine Learning A-Z™: Hands-On Python & R In Data Science",
        author: "Kirill Eremenko",
        rating: 4.5,
        price: 455,
        image: "https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=480&h=270&fit=crop",
        category: "Data Science",
        level: "All Levels"
    },
    {
        id: 4,
        title: "Angular - The Complete Guide (2024 Edition)",
        author: "Maximilian Schwarzmüller",
        rating: 4.6,
        price: 455,
        image: "https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=480&h=270&fit=crop",
        category: "Development",
        level: "All Levels"
    },
    {
        id: 5,
        title: "React - The Complete Guide (incl Hooks, React Router, Redux)",
        author: "Maximilian Schwarzmüller",
        rating: 4.6,
        price: 455,
        image: "https://images.unsplash.com/photo-1633356122102-3fe601e05bd2?w=480&h=270&fit=crop",
        category: "Development",
        level: "All Levels"
    },
    {
        id: 6,
        title: "The Complete JavaScript Course 2024",
        author: "Jonas Schmedtmann",
        rating: 4.7,
        price: 455,
        image: "https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=480&h=270&fit=crop",
        category: "Development",
        level: "Beginner"
    }
];

// Initialize cart count from database (not localStorage)
let cartItems = [];
let wishlistItems = JSON.parse(localStorage.getItem('wishlist')) || [];
let csrfToken = '';

// Update cart count on page load
document.addEventListener('DOMContentLoaded', function () {
    fetchCSRFToken();
    updateCartCountFromServer();
    loadCourses();
    initializeEventListeners();
});

// Fetch CSRF token
async function fetchCSRFToken() {
    try {
        // If we're in /pages/ directory, use cart_api.php, otherwise use pages/cart_api.php
        const apiPath = window.location.pathname.includes('/pages/')
            ? 'cart_api.php?action=csrf_token'
            : 'pages/cart_api.php?action=csrf_token';
        const response = await fetch(apiPath);
        const data = await response.json();
        if (data.success) {
            csrfToken = data.csrf_token;
        }
    } catch (error) {
        console.error('Error fetching CSRF token:', error);
    }
}

// Update cart count from server
async function updateCartCountFromServer() {
    try {
        // If we're in /pages/ directory, use cart_api.php, otherwise use pages/cart_api.php
        const apiPath = window.location.pathname.includes('/pages/')
            ? 'cart_api.php?action=count'
            : 'pages/cart_api.php?action=count';
        const response = await fetch(apiPath);
        const data = await response.json();

        if (data.success) {
            updateCartBadgeDisplay(data.count);
        }
    } catch (error) {
        console.error('Error fetching cart count:', error);
    }
}

// ENHANCED: Update cart count with animation
function updateCartBadgeDisplay(count) {
    const cartBadge = document.getElementById('cart-count');
    const mobileCartBadge = document.getElementById('mobile-cart-count');
    const cartIcon = document.querySelector('.cart-btn-enhanced');

    if (cartBadge) {
        cartBadge.textContent = count;
        if (count > 0) {
            cartBadge.style.display = 'flex';
        } else {
            cartBadge.style.display = 'none';
        }
    }

    if (mobileCartBadge) {
        mobileCartBadge.textContent = count;
        if (count > 0) {
            mobileCartBadge.style.display = 'inline-block';
        } else {
            mobileCartBadge.style.display = 'none';
        }
    }

    // Animate cart icon when item is added
    if (cartIcon && count > 0) {
        cartIcon.classList.add('cart-bounce');
        setTimeout(() => {
            cartIcon.classList.remove('cart-bounce');
        }, 600);
    }
}

// Add bounce animation CSS dynamically
const cartAnimationStyle = document.createElement('style');
cartAnimationStyle.textContent = `
    @keyframes cartBounce {
        0%, 100% {
            transform: scale(1);
        }
        25% {
            transform: scale(1.3) rotate(-8deg);
        }
        50% {
            transform: scale(1.2) rotate(8deg);
        }
        75% {
            transform: scale(1.25) rotate(-5deg);
        }
    }
    
    .cart-bounce {
        animation: cartBounce 0.6s ease-in-out !important;
    }
`;
document.head.appendChild(cartAnimationStyle);

// Load courses on homepage
function loadCourses() {
    const coursesContainer = document.getElementById('courses-container');
    const trendingContainer = document.getElementById('trending-courses');

    if (coursesContainer) {
        coursesContainer.innerHTML = '';
        courses.slice(0, 5).forEach(course => {
            coursesContainer.appendChild(createCourseCard(course));
        });
    }

    if (trendingContainer) {
        trendingContainer.innerHTML = '';
        courses.forEach(course => {
            trendingContainer.appendChild(createCourseCard(course));
        });
    }
}

// Create course card element
function createCourseCard(course) {
    const card = document.createElement('div');
    card.className = 'course-card-wrapper';

    const courseDetails = getCourseDetails(course);

    card.innerHTML = `
        <a href="pages/course-detail.php?id=${course.id}" class="prodLink" style="text-decoration: none; color: inherit;">
            <div class="prodcard">
                <img class="prodimg" src="${course.image}" alt="${course.title}">
                <h3 class="card-title">${course.title}</h3>
                <div class="author">${course.author}</div>
                <div class="rating-div">
                    <span class="rate-num">${course.rating}</span>
                    ${createStars(course.rating)}
                    <span class="rate-count">(1,200)</span>
                </div>
                <div class="price-bar">
                    <span class="price">₹${course.price}</span>
                    <span class="oldprice">₹${course.price + 1000}</span>
                </div>

                <!-- Hover Overlay -->
                <div class="course-hover-overlay">
                    <div class="hover-content">
                        <h3 class="hover-title">${course.title}</h3>
                        <p class="hover-updated"><span class="badge bg-success">Bestseller</span> Updated November 2025</p>
                        <p class="hover-meta">${courseDetails.duration} • ${course.level} • Subtitles</p>
                        <p class="hover-description">${courseDetails.description}</p>

                        <ul class="hover-features">
                            ${courseDetails.features.map(feature => `<li><i class="bi bi-check2"></i> ${feature}</li>`).join('')}
                        </ul>

                        <div class="hover-actions">
                            <button class="btn btn-primary w-100 add-to-cart-btn" onclick="event.preventDefault(); event.stopPropagation(); addToCart(${course.id});">
                                Add to cart
                            </button>
                            <button class="btn-icon-round" onclick="event.preventDefault(); event.stopPropagation(); addToWishlist(${course.id});" title="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    `;

    return card;
}

// Get detailed course information
function getCourseDetails(course) {
    const details = {
        'Python': {
            duration: '17 total hours',
            description: 'Master AI Agents in 30 days: build 8 real-world projects with OpenAI Agents SDK, CrewAI, LangGraph, AutoGen and MCP.',
            features: [
                'Project 1: Career Digital Twin. Build and deploy your own Agent to represent you to potential future employers.',
                'Project 2: SDR Agent. An instant business application: create Sales Representatives that craft and send professional emails.',
                'Project 3: Deep Research. Make your own version of the essential Agentic use case: a team of Agents that carry out extensive research on any topic you choose.'
            ]
        },
        'Web Development': {
            duration: '42 total hours',
            description: 'Learn Web Development by building 25 websites and mobile apps using HTML, CSS, JavaScript, PHP, Python, MySQL & more!',
            features: [
                'Build 25 real-world websites and mobile apps',
                'Learn to program in JavaScript, PHP, Python',
                'Master both front-end and back-end development',
                'Create a blog, e-Commerce sites, mobile apps'
            ]
        }
    };

    return details[course.category] || {
        duration: '20 total hours',
        description: `Master ${course.title} with comprehensive hands-on training and real-world projects.`,
        features: [
            'Build real-world projects from scratch',
            'Learn industry best practices',
            'Get hands-on coding experience',
            'Master the fundamentals and advanced concepts'
        ]
    };
}

// Create star rating HTML
function createStars(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    let starsHtml = '';

    for (let i = 0; i < fullStars; i++) {
        starsHtml += '<i class="bi bi-star-fill stars"></i>';
    }

    if (hasHalfStar) {
        starsHtml += '<i class="bi bi-star-half stars"></i>';
    }

    const emptyStars = 5 - Math.ceil(rating);
    for (let i = 0; i < emptyStars; i++) {
        starsHtml += '<i class="bi bi-star stars"></i>';
    }

    return starsHtml;
}

// ENHANCED: Add to cart with backend API and login check
async function addToCart(courseId) {
    // Check if user is logged in
    if (!window.isLoggedIn) {
        // Store current page for redirect after login
        const currentPage = window.location.pathname + window.location.search;
        sessionStorage.setItem('return_url', currentPage);

        // Redirect to login - use correct path based on current location
        showEnhancedNotification('Please login to add items to cart', 'info');
        setTimeout(() => {
            const loginPath = window.location.pathname.includes('/pages/')
                ? 'login.php?return_url=' + encodeURIComponent(currentPage)
                : 'pages/login.php?return_url=' + encodeURIComponent(currentPage);
            window.location.href = loginPath;
        }, 1000);
        return;
    }

    const course = courses.find(c => c.id === courseId);
    if (!course) {
        showEnhancedNotification('Course not found', 'error');
        return;
    }

    try {
        // Determine correct API path based on current location
        const apiPath = window.location.pathname.includes('/pages/')
            ? 'cart_api.php'
            : 'pages/cart_api.php';

        const response = await fetch(apiPath, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                action: 'add',
                csrf_token: csrfToken,
                course_id: course.id,
                course_title: course.title,
                course_price: course.price,
                course_original_price: course.price + 1000,
                course_image: course.image,
                course_instructor: course.author,
                course_rating: course.rating,
                course_duration: '20 hours',
                course_lectures: '50 lectures'
            })
        });

        const data = await response.json();

        if (data.success) {
            updateCartBadgeDisplay(data.count);
            showEnhancedNotification('✓ Course added to cart!', 'success');
        } else if (data.already_in_cart) {
            showEnhancedNotification('ℹ Course is already in cart!', 'info');
        } else {
            showEnhancedNotification(data.message || 'Failed to add to cart', 'error');
        }
    } catch (error) {
        console.error('Error adding to cart:', error);
        showEnhancedNotification('An error occurred. Please try again.', 'error');
    }
}

// Add to wishlist functionality
function addToWishlist(courseId) {
    const course = courses.find(c => c.id === courseId);
    if (course && !wishlistItems.find(item => item.id === courseId)) {
        wishlistItems.push(course);
        localStorage.setItem('wishlist', JSON.stringify(wishlistItems));
        showEnhancedNotification('✓ Course added to wishlist!', 'success');
    } else {
        showEnhancedNotification('ℹ Course is already in wishlist!', 'info');
    }
}

// Remove from cart
function removeFromCart(courseId) {
    cartItems = cartItems.filter(item => item.id !== courseId);
    localStorage.setItem('cart', JSON.stringify(cartItems));
    updateCartCount();
    showEnhancedNotification('Course removed from cart!', 'success');

    // Reload page if on cart page
    if (window.location.pathname.includes('cart')) {
        window.location.reload();
    }
}

// ENHANCED: Better notification with icon and styling
function showEnhancedNotification(message, type = 'success') {
    // Remove existing notification if any
    const existingNotification = document.querySelector('.cart-notification');
    if (existingNotification) {
        existingNotification.remove();
    }

    const notification = document.createElement('div');
    notification.className = 'cart-notification';

    const iconClass = type === 'success' ? 'bi-check-circle-fill' : 'bi-info-circle-fill';
    const bgGradient = type === 'success'
        ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'
        : 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)';

    notification.innerHTML = `
        <i class="bi ${iconClass}"></i>
        <span>${message}</span>
    `;

    notification.style.cssText = `
        position: fixed;
        top: 80px;
        right: 20px;
        background: ${bgGradient};
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 10000;
        animation: slideInRight 0.3s ease-out;
        font-weight: 500;
        font-size: 14px;
    `;

    document.body.appendChild(notification);

    // Add notification styles if not already added
    if (!document.getElementById('notification-styles')) {
        const notificationStyle = document.createElement('style');
        notificationStyle.id = 'notification-styles';
        notificationStyle.textContent = `
            .cart-notification i {
                font-size: 20px;
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
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
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(notificationStyle);
    }

    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Show notification (keeping old function for compatibility)
function showNotification(message) {
    showEnhancedNotification(message, 'success');
}

// Initialize event listeners
function initializeEventListeners() {
    // Mobile Hamburger Menu
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    if (hamburgerBtn && mobileMenu && mobileMenuOverlay) {
        hamburgerBtn.addEventListener('click', function () {
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeMenuBtn.addEventListener('click', function () {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });

        mobileMenuOverlay.addEventListener('click', function () {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // Topic tabs
    const topicTabs = document.querySelectorAll('.topic-tab');
    topicTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            topicTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Skills tabs
    const skillsTabs = document.querySelectorAll('.skills-tab');
    skillsTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            skillsTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const skill = this.getAttribute('data-skill');
            showNotification(`Showing ${this.textContent} courses`);
        });
    });

    // Search functionality
    const searchInputs = document.querySelectorAll('.searchbar input');
    searchInputs.forEach(input => {
        input.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value;
                console.log('Searching for:', searchTerm);
                showNotification(`Searching for: ${searchTerm}`);
            }
        });
    });

    // Skills carousel navigation
    const skillsTrack = document.querySelector('.skills-cards-track');
    const skillsPrevBtn = document.getElementById('skillsPrevBtn');
    const skillsNextBtn = document.getElementById('skillsNextBtn');
    const skillsDots = document.querySelectorAll('#skillsDots .dot');

    if (skillsTrack && skillsPrevBtn && skillsNextBtn) {
        let currentSlide = 0;
        const cardWidth = 350 + 24; // card width + gap
        const totalCards = document.querySelectorAll('.skill-category-card').length;
        const maxSlide = totalCards - 1;

        skillsNextBtn.addEventListener('click', () => {
            if (currentSlide < maxSlide) {
                currentSlide++;
                skillsTrack.scrollLeft = currentSlide * cardWidth;
                updateDots();
            }
        });

        skillsPrevBtn.addEventListener('click', () => {
            if (currentSlide > 0) {
                currentSlide--;
                skillsTrack.scrollLeft = currentSlide * cardWidth;
                updateDots();
            }
        });

        skillsDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                skillsTrack.scrollLeft = currentSlide * cardWidth;
                updateDots();
            });
        });

        function updateDots() {
            skillsDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }
    }
}

// Export functions for use in other files
window.udemyApp = {
    addToCart,
    addToWishlist,
    removeFromCart,
    courses,
    cartItems,
    wishlistItems
};

// FAQ Accordion
function initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            // Close other FAQs
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle current FAQ
            item.classList.toggle('active');
        });
    });
}

// Initialize all features when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    initFAQ();
    initContactForm();
});

// Contact Form Handler
function initContactForm() {
    const contactForm = document.getElementById('homepage-contact-form');

    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Get form data
            const formData = {
                name: document.getElementById('contact-name').value,
                email: document.getElementById('contact-email').value,
                phone: document.getElementById('contact-phone').value,
                subject: document.getElementById('contact-subject').value,
                message: document.getElementById('contact-message').value
            };

            // Simulate form submission
            const submitBtn = contactForm.querySelector('.contact-submit-btn');
            const originalBtnContent = submitBtn.innerHTML;

            // Change button state to loading
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';
            submitBtn.disabled = true;

            // Simulate API call with timeout
            setTimeout(() => {
                // Success notification
                showEnhancedNotification('✓ Message sent successfully! We\'ll get back to you soon.', 'success');

                // Reset form
                contactForm.reset();

                // Reset button
                submitBtn.innerHTML = originalBtnContent;
                submitBtn.disabled = false;

                // In production, you would send this data to your backend:
                // fetch('/api/contact', {
                //     method: 'POST',
                //     headers: { 'Content-Type': 'application/json' },
                //     body: JSON.stringify(formData)
                // })

            }, 1500);
        });
    }
}
