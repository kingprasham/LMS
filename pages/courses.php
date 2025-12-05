<?php
// Start session with centralized configuration
require_once('../includes/session.php');

include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Course Catalog - Discover Medical AI Courses - AiCureAcademy', ['css/courses.css']);
renderNavbar();
?>

<!-- Pass login status to JavaScript -->
<script>
window.isLoggedIn = <?php echo (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) ? 'true' : 'false'; ?>;
</script>

    <!-- Course Catalog Header -->
    <section class="catalog-header-section">
        <div class="catalog-header-container fade-in-up">
            <h1 class="catalog-main-title">Explore Medical AI Courses</h1>
            <p class="catalog-subtitle">Discover thousands of courses in medical AI, drug discovery, and computational biology from world-class instructors</p>
        </div>
    </section>

    <!-- Main Catalog Section -->
    <section class="catalog-main-section">
        <div class="catalog-wrapper">
            <!-- Sidebar Filters -->
            <aside class="filters-sidebar fade-in-up">
                <div class="filters-header">
                    <h3>Filters</h3>
                    <button class="btn-clear-filters">Clear All</button>
                </div>

                <!-- Categories Filter -->
                <div class="filter-group">
                    <h4 class="filter-title">
                        Categories
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </h4>
                    <div class="filter-content">
                        <label class="filter-checkbox">
                            <input type="checkbox" name="category" value="drug-discovery">
                            <span>Drug Discovery</span>
                            <span class="count">(245)</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="category" value="medical-imaging">
                            <span>Medical Imaging</span>
                            <span class="count">(189)</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="category" value="genomics">
                            <span>Genomics</span>
                            <span class="count">(167)</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="category" value="clinical-trials">
                            <span>Clinical Trials</span>
                            <span class="count">(134)</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="category" value="machine-learning">
                            <span>Machine Learning</span>
                            <span class="count">(312)</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="category" value="bioinformatics">
                            <span>Bioinformatics</span>
                            <span class="count">(156)</span>
                        </label>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="filter-group">
                    <h4 class="filter-title">
                        Price
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </h4>
                    <div class="filter-content">
                        <label class="filter-checkbox">
                            <input type="checkbox" name="price" value="free">
                            <span>Free</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="price" value="paid">
                            <span>Paid</span>
                        </label>
                        <div class="price-range-slider">
                            <label>Price Range: ₹<span id="price-min">0</span> - ₹<span id="price-max">10000</span></label>
                            <input type="range" id="price-range-min" min="0" max="10000" value="0" step="500">
                            <input type="range" id="price-range-max" min="0" max="10000" value="10000" step="500">
                        </div>
                    </div>
                </div>

                <!-- Ratings Filter -->
                <div class="filter-group">
                    <h4 class="filter-title">
                        Ratings
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </h4>
                    <div class="filter-content">
                        <label class="filter-checkbox rating-filter">
                            <input type="checkbox" name="rating" value="4.5">
                            <span class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                4.5 & up
                            </span>
                        </label>
                        <label class="filter-checkbox rating-filter">
                            <input type="checkbox" name="rating" value="4.0">
                            <span class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                4.0 & up
                            </span>
                        </label>
                        <label class="filter-checkbox rating-filter">
                            <input type="checkbox" name="rating" value="3.5">
                            <span class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                                3.5 & up
                            </span>
                        </label>
                        <label class="filter-checkbox rating-filter">
                            <input type="checkbox" name="rating" value="3.0">
                            <span class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                                3.0 & up
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Level Filter -->
                <div class="filter-group">
                    <h4 class="filter-title">
                        Level
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </h4>
                    <div class="filter-content">
                        <label class="filter-checkbox">
                            <input type="checkbox" name="level" value="beginner">
                            <span>Beginner</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="level" value="intermediate">
                            <span>Intermediate</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="level" value="advanced">
                            <span>Advanced</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="level" value="all-levels">
                            <span>All Levels</span>
                        </label>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="catalog-content-area">
                <!-- Top Bar -->
                <div class="catalog-top-bar fade-in-up">
                    <div class="results-info">
                        <h2>Showing <span id="results-count">1,247</span> results</h2>
                    </div>
                    <div class="sort-controls">
                        <select class="sort-select" id="sort-by">
                            <option value="relevance">Most Relevant</option>
                            <option value="newest">Newest</option>
                            <option value="price-low-high">Price: Low to High</option>
                            <option value="price-high-low">Price: High to Low</option>
                            <option value="highest-rated">Highest Rated</option>
                            <option value="most-popular">Most Popular</option>
                        </select>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="courses-grid">
                    <!-- Course Card 1 -->
                    <article class="course-card fade-in-up" style="animation-delay: 0.1s" data-category="drug-discovery" data-price="2499" data-rating="4.8" data-level="intermediate">
                        <div class="course-image">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=400&h=250&fit=crop" alt="Course">
                            <div class="course-overlay">
                                <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                            </div>
                            <button class="btn-wishlist-course"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="course-content">
                            <div class="course-category-badge">Drug Discovery</div>
                            <h3 class="course-title">AI-Powered Drug Discovery: From Target to Molecule</h3>
                            <p class="course-instructor">Dr. Sarah Johnson</p>
                            <div class="course-rating">
                                <span class="rating-score">4.8</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(2,458)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 12.5 hours</span>
                                <span><i class="bi bi-play-circle"></i> 87 lectures</span>
                                <span><i class="bi bi-bar-chart"></i> Intermediate</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹2,499</span>
                                    <span class="original-price">₹9,999</span>
                                    <span class="discount-badge">75% off</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Course Card 2 -->
                    <article class="course-card fade-in-up" style="animation-delay: 0.2s" data-category="medical-imaging" data-price="0" data-rating="4.6" data-level="beginner">
                        <div class="course-image">
                            <img src="https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=400&h=250&fit=crop" alt="Course">
                            <div class="course-overlay">
                                <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                            </div>
                            <button class="btn-wishlist-course"><i class="bi bi-heart"></i></button>
                            <div class="free-badge">FREE</div>
                        </div>
                        <div class="course-content">
                            <div class="course-category-badge">Medical Imaging</div>
                            <h3 class="course-title">Introduction to Medical Image Analysis with Deep Learning</h3>
                            <p class="course-instructor">Prof. Michael Chen</p>
                            <div class="course-rating">
                                <span class="rating-score">4.6</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(1,892)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 8.0 hours</span>
                                <span><i class="bi bi-play-circle"></i> 52 lectures</span>
                                <span><i class="bi bi-bar-chart"></i> Beginner</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price free">Free</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Course Card 3 -->
                    <article class="course-card fade-in-up" style="animation-delay: 0.3s" data-category="genomics" data-price="3999" data-rating="4.9" data-level="advanced">
                        <div class="course-image">
                            <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=400&h=250&fit=crop" alt="Course">
                            <div class="course-overlay">
                                <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                            </div>
                            <button class="btn-wishlist-course"><i class="bi bi-heart"></i></button>
                            <div class="bestseller-badge">BESTSELLER</div>
                        </div>
                        <div class="course-content">
                            <div class="course-category-badge">Genomics</div>
                            <h3 class="course-title">Advanced Genomic Data Analysis and Machine Learning</h3>
                            <p class="course-instructor">Dr. Emily Rodriguez</p>
                            <div class="course-rating">
                                <span class="rating-score">4.9</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <span class="rating-count">(3,721)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 18.5 hours</span>
                                <span><i class="bi bi-play-circle"></i> 124 lectures</span>
                                <span><i class="bi bi-bar-chart"></i> Advanced</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹3,999</span>
                                    <span class="original-price">₹14,999</span>
                                    <span class="discount-badge">73% off</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Course Card 4 -->
                    <article class="course-card fade-in-up" style="animation-delay: 0.4s" data-category="clinical-trials" data-price="1999" data-rating="4.5" data-level="intermediate">
                        <div class="course-image">
                            <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=400&h=250&fit=crop" alt="Course">
                            <div class="course-overlay">
                                <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                            </div>
                            <button class="btn-wishlist-course"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="course-content">
                            <div class="course-category-badge">Clinical Trials</div>
                            <h3 class="course-title">AI in Clinical Trial Design and Patient Recruitment</h3>
                            <p class="course-instructor">Dr. James Wilson</p>
                            <div class="course-rating">
                                <span class="rating-score">4.5</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(987)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 10.0 hours</span>
                                <span><i class="bi bi-play-circle"></i> 68 lectures</span>
                                <span><i class="bi bi-bar-chart"></i> Intermediate</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹1,999</span>
                                    <span class="original-price">₹7,999</span>
                                    <span class="discount-badge">75% off</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Course Card 5 -->
                    <article class="course-card fade-in-up" style="animation-delay: 0.5s" data-category="machine-learning" data-price="2799" data-rating="4.7" data-level="all-levels">
                        <div class="course-image">
                            <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=400&h=250&fit=crop" alt="Course">
                            <div class="course-overlay">
                                <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                            </div>
                            <button class="btn-wishlist-course"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="course-content">
                            <div class="course-category-badge">Machine Learning</div>
                            <h3 class="course-title">Complete Machine Learning for Healthcare Professionals</h3>
                            <p class="course-instructor">Dr. Lisa Martinez</p>
                            <div class="course-rating">
                                <span class="rating-score">4.7</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(4,567)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 22.0 hours</span>
                                <span><i class="bi bi-play-circle"></i> 156 lectures</span>
                                <span><i class="bi bi-bar-chart"></i> All Levels</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹2,799</span>
                                    <span class="original-price">₹11,999</span>
                                    <span class="discount-badge">77% off</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Course Card 6 -->
                    <article class="course-card fade-in-up" style="animation-delay: 0.6s" data-category="bioinformatics" data-price="3499" data-rating="4.8" data-level="advanced">
                        <div class="course-image">
                            <img src="https://images.unsplash.com/photo-1532187643603-ba119ca4109e?w=400&h=250&fit=crop" alt="Course">
                            <div class="course-overlay">
                                <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                            </div>
                            <button class="btn-wishlist-course"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="course-content">
                            <div class="course-category-badge">Bioinformatics</div>
                            <h3 class="course-title">Computational Bioinformatics: Python & R Programming</h3>
                            <p class="course-instructor">Prof. David Park</p>
                            <div class="course-rating">
                                <span class="rating-score">4.8</span>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-count">(2,134)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="bi bi-clock"></i> 16.0 hours</span>
                                <span><i class="bi bi-play-circle"></i> 98 lectures</span>
                                <span><i class="bi bi-bar-chart"></i> Advanced</span>
                            </div>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="current-price">₹3,499</span>
                                    <span class="original-price">₹13,999</span>
                                    <span class="discount-badge">75% off</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Add more course cards as needed -->
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper fade-in-up">
                    <button class="pagination-btn" disabled><i class="bi bi-chevron-left"></i> Previous</button>
                    <div class="pagination-numbers">
                        <button class="page-number active">1</button>
                        <button class="page-number">2</button>
                        <button class="page-number">3</button>
                        <button class="page-number">4</button>
                        <button class="page-number">5</button>
                        <span class="pagination-dots">...</span>
                        <button class="page-number">42</button>
                    </div>
                    <button class="pagination-btn">Next <i class="bi bi-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/courses.js']); ?>
