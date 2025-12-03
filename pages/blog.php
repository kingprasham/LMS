<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Blog - Latest Medical AI & Drug Discovery Articles - AiCureAcademy', ['css/blog.css']);
renderNavbar();
?>

    <!-- Blog Header Section -->
    <section class="blog-header-section">
        <div class="blog-header-container fade-in-up">
            <h1 class="blog-main-title">Latest From Our Blog</h1>
            <p class="blog-subtitle">Stay updated with the latest breakthroughs, insights, and innovations from the medical AI and drug discovery world</p>
        </div>
    </section>

    <!-- Main Blog Content -->
    <section class="blog-main-section">
        <div class="blog-wrapper">
            <!-- Filters Sidebar -->
            <aside class="filters-sidebar fade-in-up">
                <div class="filters-header">
                    <h3>Categories</h3>
                </div>

                <div class="category-filter-list">
                    <label class="category-filter-item">
                        <input type="checkbox" checked>
                        <span>All Articles</span>
                        <span class="count">(48)</span>
                    </label>
                    <label class="category-filter-item">
                        <input type="checkbox">
                        <span>Drug Discovery</span>
                        <span class="count">(24)</span>
                    </label>
                    <label class="category-filter-item">
                        <input type="checkbox">
                        <span>Medical Imaging</span>
                        <span class="count">(18)</span>
                    </label>
                    <label class="category-filter-item">
                        <input type="checkbox">
                        <span>Research Methods</span>
                        <span class="count">(31)</span>
                    </label>
                    <label class="category-filter-item">
                        <input type="checkbox">
                        <span>Clinical Trials</span>
                        <span class="count">(15)</span>
                    </label>
                    <label class="category-filter-item">
                        <input type="checkbox">
                        <span>Computational Biology</span>
                        <span class="count">(22)</span>
                    </label>
                    <label class="category-filter-item">
                        <input type="checkbox">
                        <span>Genomics</span>
                        <span class="count">(19)</span>
                    </label>
                </div>
            </aside>

            <!-- Blog Grid -->
            <div class="blog-content-area">
                <!-- Search and Sort -->
                <div class="content-header fade-in-up">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search articles...">
                    </div>
                    <select class="sort-select">
                        <option>Latest First</option>
                        <option>Oldest First</option>
                        <option>Most Popular</option>
                    </select>
                </div>

                <!-- Blog Grid -->
                <div class="blog-articles-grid">
                    <!-- Blog Card 1 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.1s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Drug Discovery</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 15, 2025</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 5 min read</span>
                            </div>
                            <h3 class="blog-title">Top 10 AI-Driven Drug Discovery Breakthroughs in 2025</h3>
                            <p class="blog-excerpt">Discover the revolutionary advances in AI-powered drug discovery that are transforming pharmaceutical research...</p>
                            <a href="blog-detail.php?id=1" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>

                    <!-- Blog Card 2 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.2s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Medical Imaging</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 12, 2025</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 7 min read</span>
                            </div>
                            <h3 class="blog-title">How Machine Learning is Revolutionizing Medical Diagnostics</h3>
                            <p class="blog-excerpt">Explore how deep learning and computer vision are transforming the way physicians analyze medical images...</p>
                            <a href="blog-detail.php?id=2" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>

                    <!-- Blog Card 3 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.3s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Research Methods</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 10, 2025</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 6 min read</span>
                            </div>
                            <h3 class="blog-title">5 Essential AI Models for Precision Medicine Research</h3>
                            <p class="blog-excerpt">Learn the cutting-edge AI architectures that researchers use to accelerate therapeutic discovery...</p>
                            <a href="blog-detail.php?id=3" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>

                    <!-- Blog Card 4 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.4s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Clinical Trials</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 8, 2025</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 8 min read</span>
                            </div>
                            <h3 class="blog-title">AI-Optimized Clinical Trial Design and Patient Recruitment</h3>
                            <p class="blog-excerpt">Understand how artificial intelligence is streamlining clinical trial protocols and improving patient selection...</p>
                            <a href="blog-detail.php?id=4" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>

                    <!-- Blog Card 5 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.5s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1642790106117-e829e14a795f?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Computational Biology</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 5, 2025</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 10 min read</span>
                            </div>
                            <h3 class="blog-title">Getting Started with Computational Drug Design</h3>
                            <p class="blog-excerpt">A comprehensive guide for beginners on molecular modeling, docking simulations, and AI-powered compound screening...</p>
                            <a href="blog-detail.php?id=5" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>

                    <!-- Blog Card 6 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.6s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Genomics</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 3, 2025</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 6 min read</span>
                            </div>
                            <h3 class="blog-title">Genomic Data Analysis with Machine Learning</h3>
                            <p class="blog-excerpt">Discover how AI is unlocking insights from vast genomic datasets to personalize treatments and predict disease risk...</p>
                            <a href="blog-detail.php?id=6" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>

                    <!-- Blog Card 7 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.7s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Drug Discovery</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Dec 30, 2024</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 9 min read</span>
                            </div>
                            <h3 class="blog-title">The Role of Quantum Computing in Drug Discovery</h3>
                            <p class="blog-excerpt">Explore how quantum computers are revolutionizing molecular simulations and accelerating drug development...</p>
                            <a href="blog-detail.php?id=7" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>

                    <!-- Blog Card 8 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.8s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Medical Imaging</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Dec 28, 2024</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 7 min read</span>
                            </div>
                            <h3 class="blog-title">AI in Radiology: From Detection to Diagnosis</h3>
                            <p class="blog-excerpt">Learn about the latest AI algorithms that are helping radiologists detect diseases earlier and more accurately...</p>
                            <a href="blog-detail.php?id=8" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>

                    <!-- Blog Card 9 -->
                    <article class="blog-card fade-in-up" style="animation-delay: 0.9s">
                        <div class="blog-image">
                            <img src="https://images.unsplash.com/photo-1507413245164-6160d8298b31?w=600&h=400&fit=crop" alt="Blog">
                            <span class="blog-category">Research Methods</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date"><i class="bi bi-calendar3"></i> Dec 25, 2024</span>
                                <span class="blog-read-time"><i class="bi bi-clock"></i> 8 min read</span>
                            </div>
                            <h3 class="blog-title">Building Reproducible AI Models for Healthcare Research</h3>
                            <p class="blog-excerpt">Best practices for developing, validating, and deploying AI models in medical research environments...</p>
                            <a href="blog-detail.php?id=9" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>
                </div>

                <!-- Load More Button -->
                <div class="load-more-wrapper fade-in-up">
                    <button class="btn-load-more">Load More Articles</button>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/blog.js']); ?>
