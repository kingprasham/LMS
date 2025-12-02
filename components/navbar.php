<?php
function renderNavbar() {
    $base = getBasePath();
?>
<header>
    <div class="topnavbar">
        <a class="aicure-link" href="<?php echo $base; ?>index.php">
            <div class="aicure-logo">
                <img src="<?php echo $base; ?>images/logo-f.png" alt="AI Cure Academy Logo" class="navbar-logo-img">
            </div>
        </a>

        <div class="dropdown-wrapper d-none d-lg-block">
            <button class="nav-btn categories-btn" style="display: flex; align-items: center;">
                Categories
                <i class="bi bi-chevron-down" style="margin-left: 5px; font-size: 0.8rem;"></i>
            </button>
            <div class="categories-dropdown">
                <a href="<?php echo $base; ?>pages/courses.php?category=generative-ai" class="dropdown-item">
                    <i class="bi bi-robot"></i>
                    Generative AI
                </a>
                <a href="<?php echo $base; ?>pages/courses.php?category=data-science" class="dropdown-item">
                    <i class="bi bi-graph-up"></i>
                    Data Science
                </a>
                <a href="<?php echo $base; ?>pages/courses.php?category=machine-learning" class="dropdown-item">
                    <i class="bi bi-cpu"></i>
                    Machine Learning
                </a>
                <a href="<?php echo $base; ?>pages/courses.php?category=web-development" class="dropdown-item">
                    <i class="bi bi-code-slash"></i>
                    Web Development
                </a>
                <a href="<?php echo $base; ?>pages/courses.php?category=it-certifications" class="dropdown-item">
                    <i class="bi bi-award"></i>
                    IT Certifications
                </a>
                <a href="<?php echo $base; ?>pages/courses.php?category=leadership" class="dropdown-item">
                    <i class="bi bi-people"></i>
                    Leadership
                </a>
                <a href="<?php echo $base; ?>pages/courses.php?category=communication" class="dropdown-item">
                    <i class="bi bi-chat-dots"></i>
                    Communication
                </a>
                <a href="<?php echo $base; ?>pages/courses.php?category=digital-marketing" class="dropdown-item">
                    <i class="bi bi-megaphone"></i>
                    Digital Marketing
                </a>
            </div>
        </div>

        <a class="linkstyle d-none d-lg-inline-block" href="<?php echo $base; ?>pages/courses.php"><span class="nav-btn">All Courses</span></a>

        <a class="linkstyle d-none d-lg-inline-block" href="<?php echo $base; ?>pages/blog.php"><span class="nav-btn">Blog</span></a>

        <button class="cart-btn d-lg-none" id="hamburger-btn" aria-label="Menu">
            <i class="bi bi-list" style="font-size: 1.5rem;"></i>
        </button>

        <div class="searchbar d-none d-lg-flex">
            <button><i class="bi bi-search"></i></button>
            <input type="text" placeholder="Search for Medical AI & Drug Discovery courses">
        </div>

        <div class="desktop-nav-links d-none d-lg-flex align-items-center">
            <div class="dropdown-wrapper">
                <button class="nav-btn company-dropdown-btn" style="display: flex; align-items: center;">
                    Company
                    <i class="bi bi-chevron-down" style="margin-left: 5px; font-size: 0.8rem;"></i>
                </button>
                <div class="categories-dropdown company-dropdown">
                    <a href="<?php echo $base; ?>pages/about.php" class="dropdown-item">
                        <i class="bi bi-info-circle"></i>
                        About Us
                    </a>
                    <a href="<?php echo $base; ?>index.php#comparison-section" class="dropdown-item">
                        <i class="bi bi-shield-check"></i>
                        Why Choose Us
                    </a>
                    <a href="<?php echo $base; ?>pages/teach.php" class="dropdown-item">
                        <i class="bi bi-mortarboard"></i>
                        Teach on AI Cure Academy
                    </a>
                    <a href="<?php echo $base; ?>pages/careers.php" class="dropdown-item">
                        <i class="bi bi-briefcase"></i>
                        Careers
                    </a>
                    <a href="<?php echo $base; ?>pages/faq.php" class="dropdown-item">
                        <i class="bi bi-question-circle"></i>
                        FAQ
                    </a>
                    <a href="<?php echo $base; ?>pages/contact.php" class="dropdown-item">
                        <i class="bi bi-envelope"></i>
                        Contact Us
                    </a>
                </div>
            </div>
            <a class="linkstyle" href="<?php echo $base; ?>pages/wishlist.php"><span class="nav-btn" id="my-learning-link" style="display:none;">My learning</span></a>

            <a href="<?php echo $base; ?>pages/wishlist.php" id="wishlist-link" style="display:none;" class="icon-link">
                <button class="cart-btn">
                    <i class="bi bi-heart"></i>
                </button>
            </a>

            <a href="<?php echo $base; ?>pages/cart.php" class="icon-link cart-icon-link">
                <button class="cart-btn cart-btn-enhanced">
                    <i class="bi bi-cart3"></i>
                    <span class="badge cart-badge" id="cart-count">0</span>
                </button>
            </a>

            <button class="cart-btn" id="notifications-btn" style="display:none;">
                <i class="bi bi-bell"></i>
                <span class="badge">0</span>
            </button>

            <button class="cart-btn" id="profile-btn" style="display:none;">
                <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
            </button>

            <a href="<?php echo $base; ?>pages/login.php" id="login-link">
                <button class="login-btn">Log in</button>
            </a>

            <a href="<?php echo $base; ?>pages/signup.php" id="signup-link">
                <button class="signup-btn">Sign up</button>
            </a>
        </div>
    </div>

    <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>

    <div class="mobile-menu" id="mobile-menu">
        <div class="mobile-menu-header">
            <button class="cart-btn" id="close-menu-btn" aria-label="Close menu">
                <i class="bi bi-x-lg" style="font-size: 1.5rem;"></i>
            </button>
        </div>
        <div class="mobile-menu-content">
            <div class="mobile-searchbar">
                <button><i class="bi bi-search"></i></button>
                <input type="text" placeholder="Search for Medical AI & Drug Discovery courses">
            </div>
            
            <div class="mobile-nav-links">
                <a href="<?php echo $base; ?>pages/cart.php" class="mobile-nav-item">
                    <i class="bi bi-cart3"></i>
                    Cart <span class="badge" id="mobile-cart-count">0</span>
                </a>
                <a href="<?php echo $base; ?>pages/wishlist.php" class="mobile-nav-item">
                    <i class="bi bi-heart"></i>
                    Wishlist
                </a>
                <a href="#" class="mobile-nav-item">
                    <i class="bi bi-bell"></i>
                    Notifications
                </a>
                <a href="#" class="mobile-nav-item">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>
                <hr>
                <a href="<?php echo $base; ?>pages/category.php" class="mobile-nav-item">Categories</a>
                <a href="<?php echo $base; ?>pages/courses.php" class="mobile-nav-item">All Courses</a>
                <a href="<?php echo $base; ?>pages/blog.php" class="mobile-nav-item">Blog</a>
                <a href="<?php echo $base; ?>pages/about.php" class="mobile-nav-item">About Us</a>
                <a href="<?php echo $base; ?>pages/teach.php" class="mobile-nav-item">Teach on AI Cure Academy</a>
                <a href="<?php echo $base; ?>pages/careers.php" class="mobile-nav-item">Careers</a>
                <a href="<?php echo $base; ?>pages/faq.php" class="mobile-nav-item">FAQ</a>
                <a href="<?php echo $base; ?>pages/contact.php" class="mobile-nav-item">Contact Us</a>
                <a href="#" class="mobile-nav-item">My Learning</a>
                <hr>
                <a href="<?php echo $base; ?>pages/login.php" class="mobile-nav-item" style="color: var(--primary-color); font-weight: 700;">
                    <i class="bi bi-box-arrow-in-right"></i> Log In
                </a>
                <a href="<?php echo $base; ?>pages/signup.php" class="mobile-nav-item signup-item">
                    <i class="bi bi-person-plus"></i> Sign Up
                </a>
            </div>
        </div>
    </div>
</header>

<style>
/* Enhanced Cart Icon Styles */
.cart-icon-link {
    position: relative;
    margin: 0 8px;
}

.cart-btn-enhanced {
    position: relative;
    padding: 10px 12px;
    border-radius: 50%;
    transition: all 0.3s ease;
    background-color: transparent;
}

.cart-btn-enhanced:hover {
    background-color: #f7f9fa;
    transform: scale(1.1);
}

.cart-btn-enhanced i {
    font-size: 1.75rem;
    color: #1c1d1f;
    transition: color 0.3s ease;
}

.cart-btn-enhanced:hover i {
    color: #5624d0;
}

.cart-badge {
    position: absolute;
    top: 2px;
    right: 2px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px;
    padding: 2px 6px;
    font-size: 11px;
    font-weight: 700;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

.cart-badge:empty {
    display: none;
}

/* Icon link improvements */
.icon-link {
    text-decoration: none;
    display: flex;
    align-items: center;
}

.icon-link .cart-btn {
    border: none;
    background: none;
    cursor: pointer;
}

/* Mobile cart enhancement */
.mobile-nav-item .badge {
    margin-left: auto;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px;
    padding: 2px 8px;
    font-size: 11px;
    font-weight: 700;
    min-width: 20px;
}

/* Remove extra spacing from removed elements */
.desktop-nav-links {
    gap: 5px;
}

/* Adjust navbar spacing */
.topnavbar {
    padding: 12px 24px;
}

@media (max-width: 991px) {
    .topnavbar {
        padding: 12px 16px;
    }
}

/* Categories Dropdown */
.dropdown-wrapper {
    position: relative;
    display: inline-block;
    z-index: 10000 !important;
}

.categories-btn,
.company-dropdown-btn {
    display: flex !important;
    align-items: center !important;
    background: none;
    border: none;
    cursor: pointer;
    white-space: nowrap;
    color: #1e293b !important;
}

.categories-dropdown,
.company-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    margin-top: 10px;
    background: #ffffff !important;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25) !important;
    min-width: 250px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 10001 !important;
    padding: 8px 0;
    border: 1px solid #e2e8f0 !important;
}

.dropdown-wrapper:hover .categories-dropdown,
.dropdown-wrapper:hover .company-dropdown {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(0);
}

.categories-dropdown .dropdown-item,
.company-dropdown .dropdown-item,
.dropdown-item {
    display: flex !important;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: #1c1d1f !important;
    text-decoration: none !important;
    transition: all 0.2s;
    font-size: 0.95rem;
    background: #ffffff !important;
    font-weight: 500;
}

.categories-dropdown .dropdown-item:hover,
.company-dropdown .dropdown-item:hover,
.dropdown-item:hover {
    background: #f7f9fa !important;
    color: #5624d0 !important;
}

.categories-dropdown .dropdown-item i,
.company-dropdown .dropdown-item i,
.dropdown-item i {
    font-size: 1.1rem;
    color: #667eea !important;
    width: 20px;
    text-align: center;
}

.linkstyle {
    text-decoration: none;
    display: inline-block;
}

/* Fix for white text on white background */
.topnavbar {
    background-color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    position: relative;
    z-index: 9999;
}

.nav-btn, .categories-btn, .company-dropdown-btn, .login-btn, .signup-btn {
    color: #1e293b !important;
    font-weight: 500;
}

.nav-btn:hover, .categories-btn:hover, .company-dropdown-btn:hover {
    color: #4f46e5 !important;
}

.login-btn {
    border: 1px solid #e2e8f0;
    background: transparent;
}

.signup-btn {
    background: #4f46e5;
    color: #ffffff !important;
}

.cart-btn i {
    color: #1e293b !important;
}
</style>

<?php
}
?>
