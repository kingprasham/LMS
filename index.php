<?php
require_once('./config.php');
require_once('./components/head.php');
require_once('./components/navbar.php');
require_once('./components/footer.php');
require_once('./components/scripts.php');

// Render head with page-specific title and CSS
renderHead('AI Cure Academy - Smart AI-Powered Learning Platform');
?>

<?php renderNavbar(); ?>

    <!-- Hero Carousel Section -->
    <section class="hero-carousel-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="<?php echo asset('images/hero2.png'); ?>" class="d-block w-100" alt="Learn together">
                    <div class="carousel-caption-custom">
                        <div class="hero-content-card">
                            <h1>Revolutionize Healthcare</h1>
                            <p>Master AI-driven drug discovery and medical research. Transform lives through cutting-edge technology. Starting at ₹455 through March 31.</p>
                            <a href="pages/courses.php" class="btn-hero-cta">
                                <span>Explore Courses</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="<?php echo asset('images/hero4.jpg'); ?>" alt="Skill up">
                    <div class="carousel-caption-custom">
                        <div class="hero-content-card">
                            <h1>Pioneer Medical AI</h1>
                            <p>Learn computational drug design and AI-powered diagnostics from leading researchers. Shape the future of medicine.</p>
                            <a href="pages/courses.php" class="btn-hero-cta">
                                <span>Start Learning</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="<?php echo asset('images/hero3.png'); ?>" alt="Career growth">
                    <div class="carousel-caption-custom">
                        <div class="hero-content-card">
                            <h1>Accelerate Breakthroughs</h1>
                            <p>Join world-class scientists in advancing precision medicine and therapeutic innovation.</p>
                            <a href="pages/courses.php" class="btn-hero-cta">
                                <span>View All Courses</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    
    <!-- Learn Essential Career and Life Skills Section -->
    <section class="career-life-skills-section">
        <div class="career-life-container">
            <div class="skills-intro">
                <h2>Master AI-Powered Medical Research</h2>
                <p>AI Cure Academy helps you develop cutting-edge skills in medical AI, drug discovery, and computational biology to revolutionize healthcare.</p>
            </div>

            <div class="skills-cards-carousel">
                <button class="carousel-nav-btn prev-btn" id="skillsPrevBtn">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="skills-cards-track">
                    <div class="skill-category-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=600&h=400&fit=crop" alt="Generative AI" class="skill-card-bg">
                        <div class="skill-card-content">
                            <div class="skill-card-meta">
                                <i class="bi bi-people-fill"></i>
                                <span>1.7M+</span>
                            </div>
                            <h3>Generative AI</h3>
                            <a href="pages/courses.php?category=generative-ai" class="skill-card-link">
                                <span>Explore</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="skill-category-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop" alt="IT Certifications" class="skill-card-bg">
                        <div class="skill-card-content">
                            <div class="skill-card-meta">
                                <i class="bi bi-people-fill"></i>
                                <span>1.4M+</span>
                            </div>
                            <h3>IT Certifications</h3>
                            <a href="pages/courses.php?category=it-certifications" class="skill-card-link">
                                <span>Explore</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="skill-category-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop" alt="Data Science" class="skill-card-bg">
                        <div class="skill-card-content">
                            <div class="skill-card-meta">
                                <i class="bi bi-people-fill"></i>
                                <span>8.1M+</span>
                            </div>
                            <h3>Data Science</h3>
                            <a href="pages/courses.php?category=data-science" class="skill-card-link">
                                <span>Explore</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="skill-category-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop" alt="Web Development" class="skill-card-bg">
                        <div class="skill-card-content">
                            <div class="skill-card-meta">
                                <i class="bi bi-people-fill"></i>
                                <span>5.2M+</span>
                            </div>
                            <h3>Web Development</h3>
                            <a href="pages/courses.php?category=web-development" class="skill-card-link">
                                <span>Explore</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="skill-category-card" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&h=400&fit=crop" alt="Leadership" class="skill-card-bg">
                        <div class="skill-card-content">
                            <div class="skill-card-meta">
                                <i class="bi bi-people-fill"></i>
                                <span>3.5M+</span>
                            </div>
                            <h3>Leadership</h3>
                            <a href="pages/courses.php?category=leadership" class="skill-card-link">
                                <span>Explore</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="skill-category-card" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600&h=400&fit=crop" alt="Communication" class="skill-card-bg">
                        <div class="skill-card-content">
                            <div class="skill-card-meta">
                                <i class="bi bi-people-fill"></i>
                                <span>2.8M+</span>
                            </div>
                            <h3>Communication</h3>
                            <a href="pages/courses.php?category=communication" class="skill-card-link">
                                <span>Explore</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="skill-category-card" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
                        <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=600&h=400&fit=crop" alt="Machine Learning" class="skill-card-bg">
                        <div class="skill-card-content">
                            <div class="skill-card-meta">
                                <i class="bi bi-people-fill"></i>
                                <span>4.3M+</span>
                            </div>
                            <h3>Machine Learning</h3>
                            <a href="pages/courses.php?category=machine-learning" class="skill-card-link">
                                <span>Explore</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="skill-category-card" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop" alt="Digital Marketing" class="skill-card-bg">
                        <div class="skill-card-content">
                            <div class="skill-card-meta">
                                <i class="bi bi-people-fill"></i>
                                <span>3.9M+</span>
                            </div>
                            <h3>Digital Marketing</h3>
                            <a href="pages/category.php?cat=Digital Marketing" class="skill-card-link">
                                <span>Explore</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <button class="carousel-nav-btn next-btn" id="skillsNextBtn">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>

            <div class="carousel-dots" id="skillsDots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <!-- Headline Section -->
    <section>
        <div class="headline">
            <div class="headline_main-text">Comprehensive Medical AI & Drug Discovery Programs</div>
            <div class="headline_sub-text">
                Access specialized courses in AI-driven healthcare, from clinical data analysis to computational drug design
            </div>
        </div>
    </section>

   

    <!-- Suggestion Sections -->
    <section>
        <div class="tec-cont">
            <div class="prod-cont" id="trending-courses">
                <!-- Trending courses will be loaded here -->
            </div>
        </div>
    </section>

    

    <!-- Trusted by Companies -->
    <section>
        <div class="trusted-section">
            <div class="trusted-container">
                <h3 class="trusted-title">Trusted by over 17,000 companies and millions of learners around the world</h3>
                <br>
                <div class="company-logos">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6d/Volkswagen_logo_2019.svg" alt="Volkswagen" style="height: 80px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Cisco_logo_blue_2016.svg" alt="Cisco" style="height: 80px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Hewlett_Packard_Enterprise_logo.svg" alt="HP Enterprise" style="height: 80px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/1b/Citi.svg" alt="Citi" style="height: 80px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Career Accelerators Section -->
    <section>
        <div class="career-section">
            <div class="career-container">
                <h2 class="career-main-heading">Ready to reimagine your career?</h2>
                <p class="career-sub-heading">Get the skills and real-world experience employers want with Career Accelerators.</p>

                <div class="career-cards-grid">
                    <!-- Career Card 1 -->
                    <div class="career-card">
                        <div class="career-card-image" style="background: linear-gradient(135deg, #FFB84D 0%, #FF9933 100%);">
                            <div class="career-icon">
                                <i class="bi bi-code-slash" style="font-size: 4rem; color: white;"></i>
                            </div>
                        </div>
                        <div class="career-card-content">
                            <h3 class="career-card-title">Full Stack Web Developer</h3>
                            <div class="career-card-meta">
                                <span><i class="bi bi-star-fill"></i> 4.7</span>
                                <span>462K ratings</span>
                                <span>87.8 total hours</span>
                            </div>
                        </div>
                    </div>

                    <!-- Career Card 2 -->
                    <div class="career-card">
                        <div class="career-card-image" style="background: linear-gradient(135deg, #A855F7 0%, #7C3AED 100%);">
                            <div class="career-icon">
                                <i class="bi bi-phone" style="font-size: 4rem; color: white;"></i>
                            </div>
                        </div>
                        <div class="career-card-content">
                            <h3 class="career-card-title">Digital Marketer</h3>
                            <div class="career-card-meta">
                                <span><i class="bi bi-star-fill"></i> 4.4</span>
                                <span>3.7K ratings</span>
                                <span>28.4 total hours</span>
                            </div>
                        </div>
                    </div>

                    <!-- Career Card 3 -->
                    <div class="career-card">
                        <div class="career-card-image" style="background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);">
                            <div class="career-icon">
                                <i class="bi bi-bar-chart" style="font-size: 4rem; color: white;"></i>
                            </div>
                        </div>
                        <div class="career-card-content">
                            <h3 class="career-card-title">Data Scientist</h3>
                            <div class="career-card-meta">
                                <span><i class="bi bi-star-fill"></i> 4.6</span>
                                <span>223K ratings</span>
                                <span>47.1 total hours</span>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#" class="career-all-link">All Career Accelerators <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>


        <!-- Why Choose AI Cure Academy Banner -->
    <section class="why-choose-banner" id="about-section">
        <div class="banner-overlay"></div>
        <div class="banner-content fade-in-up">
            <h2 class="banner-title">Why Choose AI Cure Academy?</h2>
            <p class="banner-text">Transform healthcare with India's most trusted Medical AI & Drug Discovery institute</p>
            <a href="#contact" class="banner-cta-btn">Get Started Today</a>
        </div>
    </section>
    <!-- Trending Courses Section -->
    <section>
        <div class="trending-section">
            <div class="trending-container">
                <h2 class="trending-heading">Trending courses</h2>

                <div class="trending-courses-grid">
                    <!-- Trending Course 1 -->
                    <div class="trending-course-card">
                        <div class="trending-course-image">
                            <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=480&h=270&fit=crop" alt="Python Bootcamp">
                        </div>
                        <div class="trending-course-content">
                            <h3 class="trending-course-title">100 Days of Code™: The Complete Python Pro Bootcamp</h3>
                            <p class="trending-course-author">Dr. Angela Yu, Developer and Lead Instructor</p>
                            <div class="trending-course-rating">
                                <span class="bestseller-badge">Bestseller</span>
                                <span class="rating-stars">
                                    <i class="bi bi-star-fill"></i> 4.7
                                </span>
                                <span class="rating-count">399,617 ratings</span>
                            </div>
                            <div class="trending-course-price">
                                <span class="current-price">₹519</span>
                                <span class="original-price">₹3,109</span>
                            </div>
                        </div>
                    </div>

                    <!-- Trending Course 2 -->
                    <div class="trending-course-card">
                        <div class="trending-course-image">
                            <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?w=480&h=270&fit=crop" alt="AI Agent Course">
                        </div>
                        <div class="trending-course-content">
                            <h3 class="trending-course-title">AI Engineer Agentic Track: The Complete Agent & MCP Course</h3>
                            <p class="trending-course-author">Ed Donner, Ligency</p>
                            <div class="trending-course-rating">
                                <span class="bestseller-badge">Bestseller</span>
                                <span class="rating-stars">
                                    <i class="bi bi-star-fill"></i> 4.7
                                </span>
                                <span class="rating-count">20,539 ratings</span>
                            </div>
                            <div class="trending-course-price">
                                <span class="current-price">₹519</span>
                                <span class="original-price">₹799</span>
                            </div>
                        </div>
                    </div>

                    <!-- Trending Course 3 -->
                    <div class="trending-course-card">
                        <div class="trending-course-image">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=480&h=270&fit=crop" alt="Full Stack Web">
                        </div>
                        <div class="trending-course-content">
                            <h3 class="trending-course-title">The Complete Full-Stack Web Development Bootcamp</h3>
                            <p class="trending-course-author">Dr. Angela Yu, Developer and Lead Instructor</p>
                            <div class="trending-course-rating">
                                <span class="bestseller-badge">Bestseller</span>
                                <span class="rating-stars">
                                    <i class="bi bi-star-fill"></i> 4.7
                                </span>
                                <span class="rating-count">457,004 ratings</span>
                            </div>
                            <div class="trending-course-price">
                                <span class="current-price">₹519</span>
                                <span class="original-price">₹3,109</span>
                            </div>
                        </div>
                    </div>

                    <!-- Trending Course 4 -->
                    <div class="trending-course-card">
                        <div class="trending-course-image">
                            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=480&h=270&fit=crop" alt="AWS Solutions Architect">
                        </div>
                        <div class="trending-course-content">
                            <h3 class="trending-course-title">Ultimate AWS Certified Solutions Architect Associate 2025</h3>
                            <p class="trending-course-author">Stephane Maarek | AWS Certified Cloud Practitioner...</p>
                            <div class="trending-course-rating">
                                <span class="bestseller-badge">Bestseller</span>
                                <span class="rating-stars">
                                    <i class="bi bi-star-fill"></i> 4.7
                                </span>
                                <span class="rating-count">273,674 ratings</span>
                            </div>
                            <div class="trending-course-price">
                                <span class="current-price">₹559</span>
                                <span class="original-price">₹3,379</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   



    <!-- Why AI Cure Academy is Exceptional Section -->
    <section class="exceptional-section" id="comparison-section">
        <div class="exceptional-container">
            <div class="exceptional-header fade-in-up">
                <span class="section-badge">Why Choose Us</span>
                <h2 class="exceptional-title">AI Cure Academy Medical AI Programs Aren't Just Different, <span class="highlight-text">They're Exceptional</span></h2>
                <p class="exceptional-subtitle">In the rapidly evolving field of medical AI and drug discovery, the right training can transform healthcare. What makes our AI Cure Academy medical AI programs stand out is our research-focused, real-world approach. We don't just teach theory - we train minds to think like pioneering researchers and medical AI scientists.</p>
            </div>

            <div class="comparison-container">
                <!-- Stats Cards -->
                <div class="stats-cards fade-in-up" style="animation-delay: 0.1s">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">9000+</h3>
                            <p class="stat-label">Happy Students</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">98%</h3>
                            <p class="stat-label">Success Rate</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">10+</h3>
                            <p class="stat-label">Years Experience</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">4.9/5</h3>
                            <p class="stat-label">Average Rating</p>
                        </div>
                    </div>
                </div>

                <!-- Comparison Cards -->
                <div class="comparison-cards">
                    <div class="comparison-card ai-cure-card fade-in-up" style="animation-delay: 0.2s">
                        <div class="card-header">
                            <div class="institute-badge ai-badge">
                                <i class="bi bi-lightning-charge-fill"></i>
                                <span>AI Cure Institute</span>
                            </div>
                            <div class="recommend-badge">Recommended</div>
                        </div>
                        <div class="card-body">
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Basic to Advance Class</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>AI Model Development Training</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Unlimited Lab & Research Sessions</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Lifetime Support</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Proven Research Methodologies</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Affordable Fees</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Online / Offline Access</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Drug Target Identification Using AI</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Notes / PPT</span>
                            </div>
                        </div>
                    </div>

                    <div class="vs-divider fade-in-up" style="animation-delay: 0.3s">
                        <div class="vs-circle">VS</div>
                    </div>

                    <div class="comparison-card other-card fade-in-up" style="animation-delay: 0.4s">
                        <div class="card-header">
                            <div class="institute-badge other-badge">
                                <i class="bi bi-building"></i>
                                <span>Other Institute</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Basic to Advance Class</span>
                            </div>
                            <div class="feature-item disabled">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>AI Model Development Training</span>
                            </div>
                            <div class="feature-item disabled">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>Unlimited Lab & Research Sessions</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Lifetime Support</span>
                            </div>
                            <div class="feature-item disabled">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>Proven Research Methodologies</span>
                            </div>
                            <div class="feature-item disabled">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>Affordable Fees</span>
                            </div>
                            <div class="feature-item disabled">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>Online / Offline Access</span>
                            </div>
                            <div class="feature-item disabled">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>Drug Target Identification Using AI</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Notes / PPT</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- We Are No.1 Section -->
    <section class="no-one-section">
        <div class="no-one-container">
            <div class="section-header fade-in-up">
                <h2 class="section-main-title">We Are No.1 Medical AI & Drug Discovery Academy</h2>
                <h3 class="section-sub-title">India's Trusted Medical AI Research Institute</h3>
            </div>

            <div class="features-grid">
                <div class="feature-card fade-in-up" style="animation-delay: 0.1s">
                    <div class="feature-icon">
                        <i class="bi bi-infinity"></i>
                    </div>
                    <h4 class="feature-title">Unlimited Lab & Research Sessions</h4>
                </div>

                <div class="feature-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="feature-icon">
                        <i class="bi bi-robot"></i>
                    </div>
                    <h4 class="feature-title">AI-Powered Drug Target Discovery</h4>
                </div>

                <div class="feature-card fade-in-up" style="animation-delay: 0.3s">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h4 class="feature-title">Machine Learning for Medical Imaging</h4>
                </div>

                <div class="feature-card fade-in-up" style="animation-delay: 0.4s">
                    <div class="feature-icon">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h4 class="feature-title">Online & Offline Course Access</h4>
                </div>

                <div class="feature-card fade-in-up" style="animation-delay: 0.5s">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="feature-title">Proven Methodologies with Real Projects</h4>
                </div>

                <div class="feature-card fade-in-up" style="animation-delay: 0.6s">
                    <div class="feature-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h4 class="feature-title">Comprehensive Research Materials</h4>
                </div>

                <div class="feature-card fade-in-up" style="animation-delay: 0.7s">
                    <div class="feature-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4 class="feature-title">Trusted by 9000+ Medical Researchers</h4>
                </div>

                <div class="feature-card fade-in-up" style="animation-delay: 0.8s">
                    <div class="feature-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <h4 class="feature-title">Latest Clinical Trial & Research Updates</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Get Free DEMO Banner -->
    <section class="demo-banner">
        <div class="demo-banner-overlay"></div>
        <div class="demo-banner-content fade-in-up">
            <h2 class="demo-title">Ready to Transform Healthcare Through AI?</h2>
            <p class="demo-subtitle">Call Today To Get Your FREE DEMO Class</p>
            <div class="demo-actions">
                <a href="tel:+919876543210" class="demo-btn phone-btn">
                    <i class="bi bi-telephone-fill"></i>
                    <span>Call Now: +91 89787 84848</span>
                </a>
                <a href="#contact" class="demo-btn contact-btn">
                    <i class="bi bi-envelope-fill"></i>
                    <span>Book Free Demo</span>
                </a>
            </div>
        </div>
    </section>



     <!-- Pricing Section -->
    <section>
        <div class="pricing-section">
            <div class="pricing-container">
                <h2 class="pricing-main-heading">Grow your team's skills and your business</h2>
                <p class="pricing-sub-heading">Reach goals faster with one of our plans or programs. Try one free today or contact sales to learn more.</p>

                <div class="pricing-cards-grid">
                    <!-- Team Plan -->
                    <div class="pricing-card">
                        <div class="pricing-card-header" style="border-top: 4px solid #a435f0;">
                            <h3>Team Plan</h3>
                            <div class="pricing-for">
                                <i class="bi bi-people"></i>
                                <span>2 to 50 people - For your team</span>
                            </div>
                            <button class="pricing-btn">Start subscription</button>
                        </div>
                        <div class="pricing-card-body">
                            <div class="pricing-amount">
                                <h2>₹2,000 <span>a month per user</span></h2>
                                <p>Billed annually. Cancel anytime.</p>
                            </div>
                            <ul class="pricing-features">
                                <li><i class="bi bi-check-circle"></i> Access to 13,000+ top courses</li>
                                <li><i class="bi bi-check-circle"></i> Certification prep</li>
                                <li><i class="bi bi-check-circle"></i> Goal-focused recommendations</li>
                                <li><i class="bi bi-check-circle"></i> AI-powered coaching</li>
                                <li><i class="bi bi-check-circle"></i> Analytics and adoption reports</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Enterprise Plan -->
                    <div class="pricing-card">
                        <div class="pricing-card-header" style="border-top: 4px solid #5022c3;">
                            <h3>Enterprise Plan</h3>
                            <div class="pricing-for">
                                <i class="bi bi-building"></i>
                                <span>More than 20 people - For your whole organization</span>
                            </div>
                            <button class="pricing-btn">Request a demo</button>
                        </div>
                        <div class="pricing-card-body">
                            <div class="pricing-amount">
                                <h2>Contact sales for pricing</h2>
                            </div>
                            <ul class="pricing-features">
                                <li><i class="bi bi-check-circle"></i> Access to 30,000+ top courses</li>
                                <li><i class="bi bi-check-circle"></i> Certification prep</li>
                                <li><i class="bi bi-check-circle"></i> Goal-focused recommendations</li>
                                <li><i class="bi bi-check-circle"></i> AI-powered coaching</li>
                                <li><i class="bi bi-check-circle"></i> Advanced analytics and insights</li>
                                <li><i class="bi bi-check-circle"></i> Dedicated customer success team</li>
                                <li><i class="bi bi-check-circle"></i> International course collection featuring 15 languages</li>
                                <li><i class="bi bi-check-circle"></i> Customizable content</li>
                                <li><i class="bi bi-check-circle"></i> Hands-on tech training with add-on</li>
                                <li><i class="bi bi-check-circle"></i> Strategic implementation services with add-on</li>
                            </ul>
                        </div>
                    </div>

                    <!-- AI Fluency -->
                    <div class="pricing-card">
                        <div class="pricing-card-header" style="border-top: 4px solid #2d2f31;">
                            <h3>AI Fluency</h3>
                            <div class="pricing-for">
                                <i class="bi bi-stars"></i>
                                <span>From AI foundations to Enterprise transformation</span>
                            </div>
                            <button class="pricing-btn">Contact Us</button>
                        </div>
                        <div class="pricing-card-body">
                            <div class="pricing-feature-section">
                                <h4>AI Readiness Collection</h4>
                                <div class="pricing-for">
                                    <i class="bi bi-people"></i>
                                    <span>More than 100 people</span>
                                </div>
                                <p>Build org-wide AI fluency fast with 50 curated courses + AI Assistant to accelerate learning.</p>
                            </div>

                            <div class="pricing-feature-section">
                                <h4>AI Growth Collection</h4>
                                <div class="pricing-for">
                                    <i class="bi bi-people"></i>
                                    <span>More than 20 people</span>
                                </div>
                                <p>Scale AI and technical expertise with 800+ specialized courses and 30+ role-specific learning paths in multiple languages.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="section-header fade-in-up">
                <h2 class="section-title">What Our Researchers Say</h2>
                <p class="section-subtitle">Join thousands of medical AI professionals who transformed healthcare with AI Cure Academy</p>
            </div>

            <div class="testimonials-slider">
                <div class="testimonial-track" id="testimonial-track">
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Dr. Rajesh Kumar</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"AI Cure Academy completely transformed my approach to drug discovery research. The lab sessions and AI-driven methodologies helped me identify promising therapeutic targets. Best career decision I ever made!"</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Dr. Priya Sharma</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"The machine learning for medical imaging module is exceptional! The instructors are leading researchers and the lifetime support is invaluable. Highly recommended for serious medical professionals."</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Amit Patel, PhD</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"From a complete beginner to a confident AI researcher in just 3 months. The structured curriculum and hands-on lab sessions are amazing. Thank you AI Cure Academy!"</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Dr. Sneha Desai</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"The AI-powered drug target identification tools are game-changers. I've seen a 300% improvement in my research efficiency. Worth every penny!"</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Dr. Vikram Singh</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"The unlimited lab sessions gave me real clinical research experience. I'm now leading drug discovery projects full-time with confidence. AI Cure Academy changed my career!"</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Dr. Meera Reddy</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"Best decision I made! The personalized mentorship and expert guidance helped me build a strong research portfolio. Highly recommend for anyone serious about medical AI."</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Dr. Arjun Malhotra</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"The course content is comprehensive and the teaching methodology is excellent. Live clinical trial analysis sessions are incredibly valuable. 5 stars!"</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Dr. Kavya Iyer</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"From a complete novice to publishing research papers in 6 months. The support team is always there when you need them. Thank you AI Cure!"</p>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?w=100&h=100&fit=crop" alt="Student" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4 class="testimonial-name">Rohan Kapoor, MSc</h4>
                                <div class="testimonial-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"The computational drug design module is worth the entire course fee alone. I've automated my molecular screening and now research smarter, not harder. Brilliant!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Blog Section -->
    <section class="blog-section">
        <div class="blog-container">
            <div class="section-header fade-in-up">
                <h2 class="section-title" style="color: black;">Latest From Our Blog</h2>
                <p class="section-subtitle"style="color: black;">Stay updated with the latest breakthroughs, insights, and innovations from the medical AI and drug discovery world</p>
            </div>

            <div class="blog-grid">
                <article class="blog-card fade-in-up" style="animation-delay: 0.1s">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600&h=400&fit=crop" alt="Stock Market Trends">
                        <span class="blog-category">Drug Discovery</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 15, 2025</span>
                            <span class="blog-read-time"><i class="bi bi-clock"></i> 5 min read</span>
                        </div>
                        <h3 class="blog-title">Top 10 AI-Driven Drug Discovery Breakthroughs in 2025</h3>
                        <p class="blog-excerpt">Discover the revolutionary advances in AI-powered drug discovery that are transforming pharmaceutical research. From target identification to clinical trials...</p>
                        <a href="pages/blog-detail.php?id=1" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop" alt="AI Trading">
                        <span class="blog-category">Medical Imaging</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 12, 2025</span>
                            <span class="blog-read-time"><i class="bi bi-clock"></i> 7 min read</span>
                        </div>
                        <h3 class="blog-title">How Machine Learning is Revolutionizing Medical Diagnostics</h3>
                        <p class="blog-excerpt">Explore how deep learning and computer vision are transforming the way physicians analyze medical images and diagnose diseases...</p>
                        <a href="pages/blog-detail.php?id=1" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card fade-in-up" style="animation-delay: 0.3s">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?w=600&h=400&fit=crop" alt="Trading Strategies">
                        <span class="blog-category">Research Methods</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 10, 2025</span>
                            <span class="blog-read-time"><i class="bi bi-clock"></i> 6 min read</span>
                        </div>
                        <h3 class="blog-title">5 Essential AI Models for Precision Medicine Research</h3>
                        <p class="blog-excerpt">Learn the cutting-edge AI architectures that researchers use to accelerate therapeutic discovery and personalized treatment development...</p>
                        <a href="pages/blog-detail.php?id=1" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card fade-in-up" style="animation-delay: 0.4s">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=600&h=400&fit=crop" alt="Risk Management">
                        <span class="blog-category">Clinical Trials</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 8, 2025</span>
                            <span class="blog-read-time"><i class="bi bi-clock"></i> 8 min read</span>
                        </div>
                        <h3 class="blog-title">AI-Optimized Clinical Trial Design and Patient Recruitment</h3>
                        <p class="blog-excerpt">Understand how artificial intelligence is streamlining clinical trial protocols and improving patient selection for better outcomes...</p>
                        <a href="pages/blog-detail.php?id=1" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card fade-in-up" style="animation-delay: 0.5s">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1642790106117-e829e14a795f?w=600&h=400&fit=crop" alt="Algo Trading">
                        <span class="blog-category">Computational Biology</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 5, 2025</span>
                            <span class="blog-read-time"><i class="bi bi-clock"></i> 10 min read</span>
                        </div>
                        <h3 class="blog-title">Getting Started with Computational Drug Design</h3>
                        <p class="blog-excerpt">A comprehensive guide for beginners on molecular modeling, docking simulations, and AI-powered compound screening methodologies...</p>
                        <a href="pages/blog-detail.php?id=1" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card fade-in-up" style="animation-delay: 0.6s">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=600&h=400&fit=crop" alt="Investment">
                        <span class="blog-category">Genomics</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-date"><i class="bi bi-calendar3"></i> Jan 3, 2025</span>
                            <span class="blog-read-time"><i class="bi bi-clock"></i> 6 min read</span>
                        </div>
                        <h3 class="blog-title">Genomic Medicine vs Traditional Approaches: The Future of Healthcare</h3>
                        <p class="blog-excerpt">Compare AI-driven personalized genomic medicine with conventional treatment methods and discover how precision therapeutics are reshaping patient care...</p>
                        <a href="pages/blog-detail.php?id=1" class="blog-read-more">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </article>
            </div>

            <div class="blog-load-more fade-in-up">
                <a href="pages/blog.php">
                    <button class="load-more-btn">Load More Articles <i class="bi bi-arrow-down"></i></button>
                </a>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-container">
            <div class="section-header fade-in-up">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Got questions? We've got answers!</p>
            </div>

            <div class="faq-accordion">
                <div class="faq-item fade-in-up" style="animation-delay: 0.1s">
                    <button class="faq-question">
                        <span>What makes AI Cure Academy different from other medical AI institutes?</span>
                        <i class="bi bi-plus-lg faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>AI Cure Academy offers a unique combination of AI-powered drug discovery, computational biology training, unlimited lab sessions, and lifetime support. Our proven research methodologies with real-world projects and affordable fees make us stand out in medical AI education.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.2s">
                    <button class="faq-question">
                        <span>Do I need any prior experience in medical AI or drug discovery to join?</span>
                        <i class="bi bi-plus-lg faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>No prior experience is required! We offer programs from basic to advanced levels. Our expert researchers will guide you step-by-step, whether you're a complete beginner or an experienced professional looking to enhance your medical AI skills.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.3s">
                    <button class="faq-question">
                        <span>Is the course available online or offline?</span>
                        <i class="bi bi-plus-lg faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>We offer both online and offline course access. You can attend live sessions from anywhere in the world, and all recorded sessions are available for lifetime access so you can learn at your own pace.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.4s">
                    <button class="faq-question">
                        <span>What is included in the course fee?</span>
                        <i class="bi bi-plus-lg faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>The course fee includes all research materials, session-wise PPTs and notes, unlimited lab sessions, lifetime support, AI-powered drug discovery tools, computational biology modules, and access to our exclusive medical AI research community.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.5s">
                    <button class="faq-question">
                        <span>How long does it take to complete the course?</span>
                        <i class="bi bi-plus-lg faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>The comprehensive course typically takes 2-3 months to complete, depending on your learning pace. However, you'll have lifetime access to all materials and can continue learning and practicing at your convenience.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.6s">
                    <button class="faq-question">
                        <span>Do you provide research placement assistance?</span>
                        <i class="bi bi-plus-lg faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>While we don't directly provide job placements, we offer career guidance and help you build a strong research portfolio. Many of our students have successfully joined pharmaceutical companies, biotech startups, and research institutions as medical AI specialists.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.7s">
                    <button class="faq-question">
                        <span>Can I get a free demo class before enrolling?</span>
                        <i class="bi bi-plus-lg faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Absolutely! We offer free demo classes so you can experience our teaching methodology and course content before making a commitment. Contact us to schedule your free demo session.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-form-section" id="contact">
        <div class="contact-form-container">
            <div class="contact-form-grid">
                <!-- Contact Info Side -->
                <div class="contact-info-side fade-in-up">
                    <h2 class="contact-form-title">Get In Touch</h2>
                    <p class="contact-form-subtitle">Have questions about our medical AI programs? We're here to help you start your journey in healthcare innovation.</p>

                    <div class="contact-info-items">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="contact-info-text">
                                <h4>Visit Us</h4>
                                <p>AI Cure Academy, Medical AI Center<br>Bangalore, Karnataka, India</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="contact-info-text">
                                <h4>Call Us</h4>
                                <p>+91 89787 84848<br>Mon - Sat, 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div class="contact-info-text">
                                <h4>Email Us</h4>
                                <p>info@aicureacademy.com<br>support@aicureacademy.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-social-links">
                        <a href="#" class="contact-social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="contact-social-link"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="contact-social-link"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="contact-social-link"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <!-- Contact Form Side -->
                <div class="contact-form-side fade-in-up" style="animation-delay: 0.2s">
                    <form class="homepage-contact-form" id="homepage-contact-form">
                        <div class="form-row">
                            <div class="form-group-half">
                                <label for="contact-name">Full Name <span class="required">*</span></label>
                                <input type="text" id="contact-name" name="name" class="form-input" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group-half">
                                <label for="contact-email">Email Address <span class="required">*</span></label>
                                <input type="email" id="contact-email" name="email" class="form-input" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group-half">
                                <label for="contact-phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="contact-phone" name="phone" class="form-input" placeholder="Enter your phone" required>
                            </div>
                            <div class="form-group-half">
                                <label for="contact-subject">Subject <span class="required">*</span></label>
                                <select id="contact-subject" name="subject" class="form-input" required>
                                    <option value="">Select a subject</option>
                                    <option value="course-inquiry">Course Inquiry</option>
                                    <option value="demo-request">Free Demo Request</option>
                                    <option value="career-guidance">Career Guidance</option>
                                    <option value="technical-support">Technical Support</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-full">
                            <label for="contact-message">Message <span class="required">*</span></label>
                            <textarea id="contact-message" name="message" class="form-textarea" rows="5" placeholder="Tell us about your inquiry..." required></textarea>
                        </div>

                        <button type="submit" class="contact-submit-btn">
                            <span>Send Message</span>
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>

<?php renderScripts(); ?>
