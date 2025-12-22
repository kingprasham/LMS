<?php
function renderNavbar() {
    // Start session with centralized configuration
    if (session_status() === PHP_SESSION_NONE) {
        require_once(__DIR__ . '/../includes/session.php');
    }
    
    // Check if user is logged in
    $isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    $userName = $isLoggedIn ? $_SESSION['full_name'] : '';
    $userRole = $isLoggedIn ? $_SESSION['role'] : '';
    
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

            <?php if ($isLoggedIn): ?>
                <!-- Logged In State -->
                <div class="dropdown-wrapper">
                    <button class="cart-btn profile-btn-nav" style="display: flex; align-items: center; gap: 8px;">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                        <span style="font-weight: 500;"><?php echo htmlspecialchars($userName); ?></span>
                        <i class="bi bi-chevron-down" style="font-size: 0.8rem;"></i>
                    </button>
                    <div class="categories-dropdown profile-dropdown">
                        <?php if ($userRole === 'admin'): ?>
                            <a href="<?php echo $base; ?>pages/admin/dashboard.php" class="dropdown-item">
                                <i class="bi bi-speedometer2"></i>
                                Admin Dashboard
                            </a>
                        <?php elseif ($userRole === 'instructor'): ?>
                            <a href="<?php echo $base; ?>pages/instructor/dashboard.php" class="dropdown-item">
                                <i class="bi bi-speedometer2"></i>
                                Instructor Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo $base; ?>pages/dashboard.php" class="dropdown-item">
                                <i class="bi bi-speedometer2"></i>
                                My Dashboard
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo $base; ?>pages/wishlist.php" class="dropdown-item">
                            <i class="bi bi-book"></i>
                            My Learning
                        </a>
                        <a href="<?php echo $base; ?>pages/cart.php" class="dropdown-item">
                            <i class="bi bi-receipt"></i>
                            Purchase History
                        </a>
                        <a href="<?php echo $base; ?>pages/settings.php" class="dropdown-item">
                            <i class="bi bi-gear"></i>
                            Settings
                        </a>
                        <hr style="margin: 8px 0; border-color: #e2e8f0;">
                        <a href="<?php echo $base; ?>pages/logout.php" class="dropdown-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Log Out
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Logged Out State -->
                <a href="<?php echo $base; ?>pages/login.php">
                    <button class="login-btn">Log in</button>
                </a>
                <a href="<?php echo $base; ?>pages/signup.php">
                    <button class="signup-btn">Sign up</button>
                </a>
            <?php endif; ?>
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

/* Categories Dropdown - FIXED HOVER GAP */
.dropdown-wrapper {
    position: relative;
    display: inline-block;
    z-index: 10000 !important;
}

/* The trigger buttons */
.categories-btn,
.company-dropdown-btn,
.profile-btn-nav {
    display: flex !important;
    align-items: center !important;
    background: none;
    border: none;
    cursor: pointer;
    white-space: nowrap;
    color: #1e293b !important;
    position: relative;
}

/* Create invisible hover bridge from button to dropdown */
.dropdown-wrapper::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    height: 15px; /* Bridge height - covers the gap */
    background: transparent;
}

/* The dropdown menus */
.categories-dropdown,
.company-dropdown,
.profile-dropdown {
    position: absolute;
    top: calc(100% + 10px); /* Position below with gap */
    left: 0;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    border: 1px solid #e2e8f0;
    min-width: 250px;
    padding: 8px 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.2s ease;
    z-index: 10001 !important;
}

/* Profile dropdown positioned from right */
.profile-dropdown {
    left: auto;
    right: 0;
    min-width: 220px;
}

/* Show dropdown on wrapper hover */
.dropdown-wrapper:hover > .categories-dropdown,
.dropdown-wrapper:hover > .company-dropdown,
.dropdown-wrapper:hover > .profile-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.categories-dropdown .dropdown-item,
.company-dropdown .dropdown-item,
.profile-dropdown .dropdown-item {
    display: flex !important;
    align-items: center;
    gap: 12px;
    padding: 10px 20px;
    color: #1c1d1f !important;
    text-decoration: none !important;
    transition: all 0.15s ease;
    font-size: 0.95rem;
    background: transparent;
    font-weight: 500;
}

.categories-dropdown .dropdown-item:hover,
.company-dropdown .dropdown-item:hover,
.profile-dropdown .dropdown-item:hover {
    background: #f7f9fa !important;
    color: #5624d0 !important;
}

.categories-dropdown .dropdown-item i,
.company-dropdown .dropdown-item i,
.profile-dropdown .dropdown-item i {
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

/* Profile button styling */
.profile-btn-nav {
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 6px 16px;
    background: transparent;
    transition: all 0.2s;
    color: #1e293b !important;
}

.profile-btn-nav:hover {
    background: #f7f9fa;
    border-color: #cbd5e0;
}
</style>

<?php
}
?>
