<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

// Get category from URL parameter
$category = isset($_GET['cat']) ? htmlspecialchars($_GET['cat']) : 'Generative AI';

renderHead($category . ' Courses - SAS-AI', ['css/category.css']);
renderNavbar();
?>

    <!-- Category Header Section -->
    <section class="category-header-section">
        <div class="category-header-container fade-in-up">
            <nav aria-label="breadcrumb" class="fade-in-up">
                <ol class="breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="../index.php"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Categories</a></li>
                    <li class="breadcrumb-item active"><?php echo $category; ?></li>
                </ol>
            </nav>
            <h1 class="category-main-title"><?php echo $category; ?></h1>
            <p class="category-subtitle">Master cutting-edge skills and revolutionize your career with our comprehensive courses</p>
            <div class="category-stats">
                <div class="stat-item">
                    <i class="bi bi-collection-play"></i>
                    <span><strong>850+</strong> Courses</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-people"></i>
                    <span><strong>1.7M+</strong> Learners</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-star-fill"></i>
                    <span><strong>4.7</strong> Avg Rating</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Category Content -->
    <section class="category-main-section">
        <div class="category-wrapper">
            
            <!-- Horizontal Filter Bar -->
            <div class="filters-bar fade-in-up">
                <div class="filter-pills">
                    <button class="filter-pill active">All Courses</button>
                    <button class="filter-pill">Popular</button>
                    <button class="filter-pill">Newest</button>
                    <button class="filter-pill">Beginner</button>
                    <button class="filter-pill">Advanced</button>
                    <button class="filter-pill"><i class="bi bi-sliders"></i> More Filters</button>
                </div>
                <div class="view-options">
                    <span class="results-count">Showing 850 courses</span>
                </div>
            </div>

            <!-- Courses Grid -->
            <div class="category-content-full">




                <!-- Courses Grid -->
                <div class="courses-grid" id="coursesGrid">
                    <!-- Course Card 1 -->
                    <div class="course-card-category fade-in-up" data-tags="popular all beginner" data-rating="4.8" style="animation-delay: 0.1s">
                        <div class="course-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=450&fit=crop" alt="Course" class="course-image">
                            <button class="btn-wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                        <div class="course-details">
                            <h3 class="course-title">Complete AI-Powered Drug Discovery Masterclass</h3>
                            <p class="course-author">By Dr. Sarah Johnson</p>
                            <div class="course-rating">
                                <span class="rating-number">4.8</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(12,458)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 42 hours</span>
                                <span><i class="bi bi-collection-play"></i> 325 lectures</span>
                                <span class="level-badge">All Levels</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹455</span>
                                    <span class="original-price">₹3,199</span>
                                </div>
                                <span class="bestseller-badge"><i class="bi bi-award-fill"></i> Bestseller</span>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card 2 -->
                    <div class="course-card-category fade-in-up" data-tags="newest all intermediate" data-rating="4.7" style="animation-delay: 0.2s">
                        <div class="course-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1576086213369-97a306d36557?w=800&h=450&fit=crop" alt="Course" class="course-image">
                            <button class="btn-wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                        <div class="course-details">
                            <h3 class="course-title">Machine Learning for Medical Diagnostics</h3>
                            <p class="course-author">By Prof. Michael Chen</p>
                            <div class="course-rating">
                                <span class="rating-number">4.7</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(8,924)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 28 hours</span>
                                <span><i class="bi bi-collection-play"></i> 198 lectures</span>
                                <span class="level-badge">Intermediate</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹455</span>
                                    <span class="original-price">₹2,999</span>
                                </div>
                                <span class="bestseller-badge"><i class="bi bi-award-fill"></i> Bestseller</span>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card 3 -->
                    <div class="course-card-category fade-in-up" data-tags="popular all advanced" data-rating="4.9" style="animation-delay: 0.3s">
                        <div class="course-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=800&h=450&fit=crop" alt="Course" class="course-image">
                            <button class="btn-wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                        <div class="course-details">
                            <h3 class="course-title">Advanced NLP with Transformers & BERT</h3>
                            <p class="course-author">By James Wilson</p>
                            <div class="course-rating">
                                <span class="rating-number">4.9</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <span class="rating-count">(5,210)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 18 hours</span>
                                <span><i class="bi bi-collection-play"></i> 145 lectures</span>
                                <span class="level-badge">Advanced</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹455</span>
                                    <span class="original-price">₹4,999</span>
                                </div>
                                <span class="bestseller-badge"><i class="bi bi-award-fill"></i> Bestseller</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course Card 4 -->
                    <div class="course-card-category fade-in-up" data-tags="newest all beginner" data-rating="4.6" style="animation-delay: 0.4s">
                        <div class="course-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=800&h=450&fit=crop" alt="Course" class="course-image">
                            <button class="btn-wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                        <div class="course-details">
                            <h3 class="course-title">Python for Beginners: From Zero to Hero</h3>
                            <p class="course-author">By Angela Yu</p>
                            <div class="course-rating">
                                <span class="rating-number">4.6</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(6,543)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 25 hours</span>
                                <span><i class="bi bi-collection-play"></i> 180 lectures</span>
                                <span class="level-badge">All Levels</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹455</span>
                                    <span class="original-price">₹2,799</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card 6 -->
                    <div class="course-card-category fade-in-up" style="animation-delay: 0.6s">
                        <div class="course-image-wrapper">
                            <img src="https://img-c.udemycdn.com/course/240x135/567828_67d0.jpg" alt="Course" class="course-image">
                            <button class="btn-wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                        <div class="course-details">
                            <h3 class="course-title">Precision Medicine & Personalized Healthcare AI</h3>
                            <p class="course-author">By Dr. Robert Kumar</p>
                            <div class="course-rating">
                                <span class="rating-number">4.7</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(11,234)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 38 hours</span>
                                <span><i class="bi bi-collection-play"></i> 298 lectures</span>
                                <span class="level-badge">Advanced</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹455</span>
                                    <span class="original-price">₹3,399</span>
                                </div>
                                <span class="bestseller-badge"><i class="bi bi-award-fill"></i> Bestseller</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper fade-in-up">
                    <button class="pagination-btn">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn">4</button>
                    <button class="pagination-btn">5</button>
                    <button class="pagination-btn">...</button>
                    <button class="pagination-btn">28</button>
                    <button class="pagination-btn">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/category.js']); ?>
