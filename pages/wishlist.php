<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('My Wishlist', ['css/dashboard.css', 'css/wishlist.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!--  Sidebar (Same as Dashboard) -->
    <?php renderSidebar('wishlist'); ?>

    <!-- Main Content -->
    <main class="dashboard-main" id="wishlistMain">
        <!-- Header -->
        <div class="wishlist-header fade-in-up">
            <div>
                <h1 class="page-title">My Wishlist</h1>
                <p class="page-subtitle">Courses you've saved for later</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Wishlist Stats -->
        <div class="wishlist-stats fade-in-up" style="animation-delay: 0.1s">
            <div class="stat-item">
                <i class="bi bi-heart-fill"></i>
                <div>
                    <span class="stat-value" id="wishlistCount">6</span>
                    <span class="stat-label">Saved Courses</span>
                </div>
            </div>
            <div class="stat-item">
                <i class="bi bi-tag-fill"></i>
                <div>
                    <span class="stat-value" id="totalValue">$534.94</span>
                    <span class="stat-label">Total Value</span>
                </div>
            </div>
            <div class="bulk-actions">
                <button class="btn-bulk-action" id="moveAllToCart">
                    <i class="bi bi-cart-plus"></i> Move All to Cart
                </button>
                <button class="btn-bulk-action danger" id="clearWishlist">
                    <i class="bi bi-trash"></i> Clear Wishlist
                </button>
            </div>
        </div>

        <!-- Wishlist Grid -->
        <div class="wishlist-grid fade-in-up" style="animation-delay: 0.2s" id="wishlistGrid">
            <!-- Wishlist Item 1 -->
            <div class="wishlist-card" data-course-id="101">
                <button class="remove-btn" data-course-id="101" title="Remove from wishlist">
                    <i class="bi bi-x"></i>
                </button>
                <div class="course-thumbnail">
                    <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&h=400&fit=crop" alt="NLP Course" class="course-img">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-detail.php?id=101'); ?>" class="btn-preview">
                            <i class="bi bi-eye"></i> Preview
                        </a>
                    </div>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Natural Language Processing in Clinical Research</h3>
                    <p class="course-instructor">
                        <i class="bi bi-person"></i> Dr. Rachel Green
                    </p>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="rating-text">4.8 (2,340 reviews)</span>
                    </div>
                    <div class="course-meta-row">
                        <span class="meta-item">
                            <i class="bi bi-clock"></i> 12.5 hours
                        </span>
                        <span class="meta-item">
                            <i class="bi bi-collection-play"></i> 89 lectures
                        </span>
                    </div>
                    <div class="course-footer">
                        <div class="price-section">
                            <span class="current-price">$79.99</span>
                            <span class="original-price">$149.99</span>
                            <span class="discount-badge">47% OFF</span>
                        </div>
                        <button class="btn-add-cart" data-course-id="101">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Wishlist Item 2 -->
            <div class="wishlist-card" data-course-id="102">
                <button class="remove-btn" data-course-id="102" title="Remove from wishlist">
                    <i class="bi bi-x"></i>
                </button>
                <div class="course-thumbnail">
                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=600&h=400&fit=crop" alt="Genomics Course" class="course-img">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-detail.php?id=102'); ?>" class="btn-preview">
                            <i class="bi bi-eye"></i> Preview
                        </a>
                    </div>
                </div>
                <div class="course-content">
                    <h3 class="course-title">AI in Genomics and Precision Medicine</h3>
                    <p class="course-instructor">
                        <i class="bi bi-person"></i> Prof. David Lee
                    </p>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <span class="rating-text">4.9 (1,890 reviews)</span>
                    </div>
                    <div class="course-meta-row">
                        <span class="meta-item">
                            <i class="bi bi-clock"></i> 15 hours
                        </span>
                        <span class="meta-item">
                            <i class="bi bi-collection-play"></i> 102 lectures
                        </span>
                    </div>
                    <div class="course-footer">
                        <div class="price-section">
                            <span class="current-price">$89.99</span>
                            <span class="original-price">$169.99</span>
                            <span class="discount-badge">47% OFF</span>
                        </div>
                        <button class="btn-add-cart" data-course-id="102">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Wishlist Item 3 -->
            <div class="wishlist-card" data-course-id="103">
                <button class="remove-btn" data-course-id="103" title="Remove from wishlist">
                    <i class="bi bi-x"></i>
                </button>
                <div class="course-thumbnail">
                    <img src="<?php echo getBasePath(); ?>images/courses/rec3.jpg" alt="Clinical Trials" onerror="this.src='<?php echo getBasePath(); ?>images/placeholder-course.jpg'">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-detail.php?id=103'); ?>" class="btn-preview">
                            <i class="bi bi-eye"></i> Preview
                        </a>
                    </div>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Machine Learning for Clinical Trials</h3>
                    <p class="course-instructor">
                        <i class="bi bi-person"></i> Dr. Jennifer Adams
                    </p>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="rating-text">4.7 (3,120 reviews)</span>
                    </div>
                    <div class="course-meta-row">
                        <span class="meta-item">
                            <i class="bi bi-clock"></i> 10.5 hours
                        </span>
                        <span class="meta-item">
                            <i class="bi bi-collection-play"></i> 75 lectures
                        </span>
                    </div>
                    <div class="course-footer">
                        <div class="price-section">
                            <span class="current-price">$69.99</span>
                            <span class="original-price">$139.99</span>
                            <span class="discount-badge">50% OFF</span>
                        </div>
                        <button class="btn-add-cart" data-course-id="103">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Wishlist Item 4 -->
            <div class="wishlist-card" data-course-id="104">
                <button class="remove-btn" data-course-id="104" title="Remove from wishlist">
                    <i class="bi bi-x"></i>
                </button>
                <div class="course-thumbnail">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop" alt="Bioinformatics Course" class="course-img">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-detail.php?id=104'); ?>" class="btn-preview">
                            <i class="bi bi-eye"></i> Preview
                        </a>
                    </div>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Bioinformatics and Computational Biology</h3>
                    <p class="course-instructor">
                        <i class="bi bi-person"></i> Prof. Steven Park
                    </p>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <span class="rating-text">4.6 (1,540 reviews)</span>
                    </div>
                    <div class="course-meta-row">
                        <span class="meta-item">
                            <i class="bi bi-clock"></i> 14 hours
                        </span>
                        <span class="meta-item">
                            <i class="bi bi-collection-play"></i> 95 lectures
                        </span>
                    </div>
                    <div class="course-footer">
                        <div class="price-section">
                            <span class="current-price">$84.99</span>
                            <span class="original-price">$159.99</span>
                            <span class="discount-badge">47% OFF</span>
                        </div>
                        <button class="btn-add-cart" data-course-id="104">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Wishlist Item 5 -->
            <div class="wishlist-card" data-course-id="105">
                <button class="remove-btn" data-course-id="105" title="Remove from wishlist">
                    <i class="bi bi-x"></i>
                </button>
                <div class="course-thumbnail">
                    <img src="<?php echo getBasePath(); ?>images/courses/course5.jpg" alt="Neural Networks" onerror="this.src='<?php echo getBasePath(); ?>images/placeholder-course.jpg'">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-detail.php?id=105'); ?>" class="btn-preview">
                            <i class="bi bi-eye"></i> Preview
                        </a>
                    </div>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Advanced Neural Networks for Medical Applications</h3>
                    <p class="course-instructor">
                        <i class="bi bi-person"></i> Dr. Anna Thompson
                    </p>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <span class="rating-text">5.0 (980 reviews)</span>
                    </div>
                    <div class="course-meta-row">
                        <span class="meta-item">
                            <i class="bi bi-clock"></i> 18 hours
                        </span>
                        <span class="meta-item">
                            <i class="bi bi-collection-play"></i> 120 lectures
                        </span>
                    </div>
                    <div class="course-footer">
                        <div class="price-section">
                            <span class="current-price">$99.99</span>
                            <span class="original-price">$199.99</span>
                            <span class="discount-badge">50% OFF</span>
                        </div>
                        <button class="btn-add-cart" data-course-id="105">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Wishlist Item 6 -->
            <div class="wishlist-card" data-course-id="106">
                <button class="remove-btn" data-course-id="106" title="Remove from wishlist">
                    <i class="bi bi-x"></i>
                </button>
                <div class="course-thumbnail">
                    <img src="<?php echo getBasePath(); ?>images/courses/course6.jpg" alt="Drug Discovery" onerror="this.src='<?php echo getBasePath(); ?>images/placeholder-course.jpg'">
                    <div class="course-overlay">
                        <a href="<?php echo url('pages/course-detail.php?id=106'); ?>" class="btn-preview">
                            <i class="bi bi-eye"></i> Preview
                        </a>
                    </div>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Computational Drug Discovery with AI</h3>
                    <p class="course-instructor">
                        <i class="bi bi-person"></i> Prof. Marcus Johnson
                    </p>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="rating-text">4.8 (2,670 reviews)</span>
                    </div>
                    <div class="course-meta-row">
                        <span class="meta-item">
                            <i class="bi bi-clock"></i> 16.5 hours
                        </span>
                        <span class="meta-item">
                            <i class="bi bi-collection-play"></i> 110 lectures
                        </span>
                    </div>
                    <div class="course-footer">
                        <div class="price-section">
                            <span class="current-price">$109.99</span>
                            <span class="original-price">$199.99</span>
                            <span class="discount-badge">45% OFF</span>
                        </div>
                        <button class="btn-add-cart" data-course-id="106">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (Hidden by default) -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <i class="bi bi-heart"></i>
            <h3>Your wishlist is empty</h3>
            <p>Start saving courses you're interested in for later</p>
            <a href="<?php echo url('pages/courses.php'); ?>" class="btn-browse">
                <i class="bi bi-search"></i> Browse Courses
            </a>
        </div>
    </main>
</div>

<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<?php renderFooter(); ?>
<?php renderScripts(['js/wishlist.js']); ?>
