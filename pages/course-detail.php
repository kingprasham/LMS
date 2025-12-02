<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Complete Python Bootcamp - AI Cure Academy', ['css/course-detail.css?v=' . time()]);
renderNavbar();
?>

    <!-- Modern Course Hero Section -->
    <section class="course-hero-modern">
        <div class="course-hero-container">
            <div class="hero-content-area fade-in-up">
                <nav aria-label="breadcrumb">
                    <ol class="course-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo url('index.php'); ?>"><i class="bi bi-house-door"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo url('pages/courses.php'); ?>">Courses</a></li>
                        <li class="breadcrumb-item"><a href="#">Development</a></li>
                        <li class="breadcrumb-item active">Python</li>
                    </ol>
                </nav>

                <h1 class="hero-title-modern">100 Days of Code™: The Complete Python Pro Bootcamp</h1>
                <p class="hero-description">Master Python by building 100 projects in 100 days. Learn data science, automation, build websites, games and apps!</p>

                <div class="hero-meta-badges">
                    <div class="meta-badge bestseller">
                        <i class="bi bi-award-fill"></i>
                        <span>Bestseller</span>
                    </div>
                    <div class="meta-badge rating">
                        <i class="bi bi-star-fill"></i>
                        <span>4.7 (399,617)</span>
                    </div>
                    <div class="meta-badge students">
                        <i class="bi bi-people-fill"></i>
                        <span>1.8M+ students</span>
                    </div>
                </div>

                <div class="hero-instructor-info">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=60&h=60&fit=crop" alt="Dr. Angela Yu" class="instructor-avatar-small">
                    <div class="instructor-text">
                        <span class="instructor-label">Created by</span>
                        <a href="#instructor" class="instructor-link">Dr. Angela Yu</a>
                    </div>
                    <div class="hero-meta-extra">
                        <span class="meta-text"><i class="bi bi-clock-history"></i> Updated 01/2025</span>
                    </div>
                </div>

                <!-- Preview Video Card -->
                <div class="preview-video-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="video-thumbnail-wrapper">
                        <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=1200&h=800&fit=crop" alt="Course Preview" class="video-thumbnail">
                        <div class="video-play-overlay">
                            <button class="video-play-btn" id="previewVideoBtn">
                                <i class="bi bi-play-circle-fill"></i>
                            </button>
                            <span class="preview-label">Preview this course</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="course-main-content">
        <div class="content-container">
            <!-- Left Column: Main Content -->
            <div class="content-left-column">



                <!-- What You'll Learn -->
                <div class="what-learn-section fade-in-up" style="animation-delay: 0.1s">
                    <h2 class="content-section-title">What you'll learn</h2>
                    <div class="learn-outcomes-grid">
                        <div class="outcome-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>You will master the Python programming language by building 100 unique projects over 100 days</span>
                        </div>
                        <div class="outcome-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>You will learn automation, game, app and web development, data science and machine learning all using Python</span>
                        </div>
                        <div class="outcome-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>You will be able to program in Python professionally</span>
                        </div>
                        <div class="outcome-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>You will learn Selenium, Beautiful Soup, Request, Flask, Pandas, NumPy, Scikit Learn, Plotly, and Matplotlib</span>
                        </div>
                        <div class="outcome-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Create a portfolio of 100 Python projects to apply for developer jobs</span>
                        </div>
                        <div class="outcome-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Be able to build fully fledged websites and web apps with Python</span>
                        </div>
                        <div class="outcome-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Be able to use Python for data science and machine learning</span>
                        </div>
                        <div class="outcome-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Build games like Blackjack, Pong and Snake using Python</span>
                        </div>
                    </div>
                </div>

                <!-- Course Content (Accordion) -->
                <div class="course-content-section fade-in-up" style="animation-delay: 0.2s">
                    <div class="content-header-row">
                        <h2 class="content-section-title">Course content</h2>
                        <button class="btn-expand-all" id="expandAllBtn">
                            <i class="bi bi-arrows-angle-expand"></i>
                            Expand all sections
                        </button>
                    </div>
                    <p class="content-summary">23 sections • 686 lectures • 59h 25m total length</p>

                    <div class="course-accordion" id="courseContentAccordion">
                        <!-- Section 1 -->
                        <div class="accordion-section">
                            <button class="accordion-section-header" type="button" data-bs-toggle="collapse" data-bs-target="#section1">
                                <div class="section-left">
                                    <i class="bi bi-chevron-down section-chevron"></i>
                                    <span class="section-title">Day 1 - Beginner - Working with Variables in Python to Manage Data</span>
                                </div>
                                <div class="section-right">
                                    <span class="section-meta">8 lectures • 45min</span>
                                </div>
                            </button>
                            <div id="section1" class="accordion-section-collapse collapse show" data-bs-parent="#courseContentAccordion">
                                <div class="accordion-section-body">
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">What You're Going to Get from This Course</span>
                                        </div>
                                        <div class="lecture-right">
                                            <button class="btn-preview">Preview</button>
                                            <span class="lecture-duration">07:13</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-file-earmark-text lecture-icon"></i>
                                            <span class="lecture-title">Download the Course Syllabus</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">1 page</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">Printing to the Console in Python</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">05:42</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-code-square lecture-icon"></i>
                                            <span class="lecture-title">Exercise 1 - Printing</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">1 question</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">String Manipulation and Code Intelligence</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">08:17</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">The Python Input Function</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">06:25</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-code-square lecture-icon"></i>
                                            <span class="lecture-title">Exercise 2 - Input Function</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">1 question</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-trophy lecture-icon"></i>
                                            <span class="lecture-title">Day 1 Project: Band Name Generator</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">07:41</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2 -->
                        <div class="accordion-section">
                            <button class="accordion-section-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section2">
                                <div class="section-left">
                                    <i class="bi bi-chevron-right section-chevron"></i>
                                    <span class="section-title">Day 2 - Beginner - Understanding Data Types and How to Manipulate Strings</span>
                                </div>
                                <div class="section-right">
                                    <span class="section-meta">7 lectures • 38min</span>
                                </div>
                            </button>
                            <div id="section2" class="accordion-section-collapse collapse" data-bs-parent="#courseContentAccordion">
                                <div class="accordion-section-body">
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">Python Primitive Data Types</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">06:12</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">Type Error, Type Checking and Type Conversion</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">07:45</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">Mathematical Operations in Python</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">05:33</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3 -->
                        <div class="accordion-section">
                            <button class="accordion-section-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section3">
                                <div class="section-left">
                                    <i class="bi bi-chevron-right section-chevron"></i>
                                    <span class="section-title">Day 3 - Beginner - Control Flow and Logical Operators</span>
                                </div>
                                <div class="section-right">
                                    <span class="section-meta">10 lectures • 1h 5min</span>
                                </div>
                            </button>
                            <div id="section3" class="accordion-section-collapse collapse" data-bs-parent="#courseContentAccordion">
                                <div class="accordion-section-body">
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">Control Flow with if / else and Conditional Operators</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">09:27</span>
                                        </div>
                                    </div>
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">Nested if statements and elif statements</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">08:15</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4 -->
                        <div class="accordion-section">
                            <button class="accordion-section-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section4">
                                <div class="section-left">
                                    <i class="bi bi-chevron-right section-chevron"></i>
                                    <span class="section-title">Day 4 - Beginner - Randomisation and Python Lists</span>
                                </div>
                                <div class="section-right">
                                    <span class="section-meta">6 lectures • 42min</span>
                                </div>
                            </button>
                            <div id="section4" class="accordion-section-collapse collapse" data-bs-parent="#courseContentAccordion">
                                <div class="accordion-section-body">
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">Random Module</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">07:32</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 5 -->
                        <div class="accordion-section">
                            <button class="accordion-section-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section5">
                                <div class="section-left">
                                    <i class="bi bi-chevron-right section-chevron"></i>
                                    <span class="section-title">Day 5 - Beginner - Python Loops</span>
                                </div>
                                <div class="section-right">
                                    <span class="section-meta">5 lectures • 35min</span>
                                </div>
                            </button>
                            <div id="section5" class="accordion-section-collapse collapse" data-bs-parent="#courseContentAccordion">
                                <div class="accordion-section-body">
                                    <div class="lecture-item">
                                        <div class="lecture-left">
                                            <i class="bi bi-play-circle lecture-icon"></i>
                                            <span class="lecture-title">Using the for loop with Python Lists</span>
                                        </div>
                                        <div class="lecture-right">
                                            <span class="lecture-duration">08:24</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn-show-more-sections" id="showMoreSectionsBtn">
                        <span>Show 18 more sections</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                </div>

                <!-- Requirements -->
                <div class="requirements-section fade-in-up" style="animation-delay: 0.3s">
                    <h2 class="content-section-title">Requirements</h2>
                    <ul class="requirements-list">
                        <li>No programming experience needed - I'll teach you everything you need to know</li>
                        <li>A Mac or PC computer with access to the internet</li>
                        <li>No paid software required - I'll teach you how to use PyCharm, Jupyter Notebooks and Google Colab</li>
                        <li>I'll walk you through, step-by-step how to get all the software installed and set up</li>
                    </ul>
                </div>

                <!-- Description -->
                <div class="description-section fade-in-up" style="animation-delay: 0.4s">
                    <h2 class="content-section-title">Description</h2>
                    <div class="description-content" id="descriptionContent">
                        <p><strong>Welcome to the 100 Days of Code - The Complete Python Pro Bootcamp</strong>, the only course you need to learn to code with Python. With over 500,000 5 STAR reviews and a 4.7 average, my courses are some of the HIGHEST RATED courses in the history of Udemy!</p>

                        <p>100 days, 1 hour per day, learn to build 1 project per day, this is how you master Python.</p>

                        <p>At 60+ hours, this Python course is without a doubt the most comprehensive Python course available anywhere online. Even if you have zero programming experience, this course will take you from beginner to professional. Here's why:</p>

                        <ul class="description-list">
                            <li>The course is taught by the lead instructor at the App Brewery, London's leading in-person programming bootcamp.</li>
                            <li>The course has been updated to be 2025 ready and you'll be learning the latest tools and technologies used at large companies such as Apple, Google and Netflix.</li>
                            <li>This course doesn't cut any corners, there are beautiful animated explanation videos and tens of real-world projects which you will get to build.</li>
                            <li>The curriculum was developed over a period of four years, with comprehensive student testing and feedback.</li>
                        </ul>

                        <div class="description-more" id="descriptionMore" style="display: none;">
                            <p>We'll take you step-by-step through engaging video tutorials and teach you everything you need to know to succeed as a Python developer.</p>

                            <p>The course includes 60+ hours of HD video tutorials and builds your programming knowledge while making real-world Python projects.</p>

                            <h3>What You'll Build:</h3>
                            <ul class="description-list">
                                <li><strong>Blackjack</strong></li>
                                <li><strong>Snake Game</strong></li>
                                <li><strong>Pong Game</strong></li>
                                <li><strong>Auto Swipe on Tinder</strong></li>
                                <li><strong>Auto Job Applications on LinkedIn</strong></li>
                                <li><strong>Automate Birthday Emails/SMS</strong></li>
                                <li><strong>Build Your Own Blog</strong></li>
                                <li><strong>Build Your Own Public API</strong></li>
                                <li><strong>Data Science with Google Trends</strong></li>
                                <li><strong>Analysing Lego Datasets</strong></li>
                                <li><strong>Google App Store Analysis</strong></li>
                                <li><strong>Create an Etch-A-Sketch App</strong></li>
                            </ul>

                            <h3>By the end of this course, you will be fluent in Python and ready for your career as a Python Developer.</h3>

                            <p>You'll also build a portfolio of 100 projects that you can show off to any potential employer. Signing up gives you access to all the videos, quizzes, programming exercises and solutions.</p>

                            <p>The curriculum was designed by the lead instructor at the App Brewery, London's leading in-person programming bootcamp. She is a developer, lead instructor and founder at the App Brewery.</p>
                        </div>
                    </div>
                    <button class="btn-show-more" id="showMoreBtn">
                        <span class="show-more-text">Show more</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>

                    <div class="target-audience">
                        <h3 class="subsection-title">Who this course is for:</h3>
                        <ul class="audience-list">
                            <li>If you want to learn to code from scratch, this course is for you</li>
                            <li>If you want to build projects and create a portfolio of work, this course is for you</li>
                            <li>If you want to learn Python professionally and get hired as a developer, this course is for you</li>
                        </ul>
                    </div>
                </div>

                <!-- Instructor Section -->
                <div class="instructor-section fade-in-up" style="animation-delay: 0.5s" id="instructor">
                    <h2 class="content-section-title">Instructor</h2>
                    <div class="instructor-card">
                        <div class="instructor-header">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="Dr. Angela Yu" class="instructor-photo">
                            <div class="instructor-info">
                                <h3 class="instructor-name">Dr. Angela Yu</h3>
                                <p class="instructor-title">Developer and Lead Instructor</p>
                            </div>
                        </div>

                        <div class="instructor-stats">
                            <div class="stat-item">
                                <i class="bi bi-star-fill"></i>
                                <span>4.7 Instructor Rating</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-award-fill"></i>
                                <span>399,617 Reviews</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-people-fill"></i>
                                <span>1,825,449 Students</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-play-btn-fill"></i>
                                <span>5 Courses</span>
                            </div>
                        </div>

                        <div class="instructor-bio">
                            <p>I'm Angela, I'm a developer with a passion for teaching. I'm the lead instructor at the London App Brewery, London's leading Programming Bootcamp. I've helped hundreds of thousands of students learn to code and change their lives by becoming a developer. I've been invited by companies such as Twitter, Facebook and Google to teach their employees.</p>

                            <p>My first foray into programming was when I was just 12 years old, wanting to build my own Space Invader game. Since then, I've made hundred of websites, apps and games. But most importantly, I realised that my greatest passion is teaching.</p>

                            <p>I spend most of my time researching how to make learning to code fun and make hard concepts easy to understand. I apply everything I discover into my bootcamp courses. In my courses, you'll find lots of geeky humor but also lots of explanations and animations to make sure everything is easy to understand.</p>
                        </div>
                    </div>
                </div>

                <!-- Student Feedback Section -->
                <div class="student-feedback-section fade-in-up" style="animation-delay: 0.6s" id="reviews">
                    <h2 class="content-section-title">Student feedback</h2>

                    <div class="feedback-overview">
                        <div class="rating-summary">
                            <div class="overall-rating">
                                <span class="rating-number-large">4.7</span>
                                <div class="rating-details">
                                    <div class="stars-large">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <p class="rating-label">Course Rating</p>
                                </div>
                            </div>

                            <div class="rating-breakdown">
                                <div class="rating-bar-row">
                                    <div class="bar-label">
                                        <div class="stars-small">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-fill" style="width: 72%;"></div>
                                    </div>
                                    <span class="percentage">72%</span>
                                </div>

                                <div class="rating-bar-row">
                                    <div class="bar-label">
                                        <div class="stars-small">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-fill" style="width: 18%;"></div>
                                    </div>
                                    <span class="percentage">18%</span>
                                </div>

                                <div class="rating-bar-row">
                                    <div class="bar-label">
                                        <div class="stars-small">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-fill" style="width: 6%;"></div>
                                    </div>
                                    <span class="percentage">6%</span>
                                </div>

                                <div class="rating-bar-row">
                                    <div class="bar-label">
                                        <div class="stars-small">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-fill" style="width: 2%;"></div>
                                    </div>
                                    <span class="percentage">2%</span>
                                </div>

                                <div class="rating-bar-row">
                                    <div class="bar-label">
                                        <div class="stars-small">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-fill" style="width: 2%;"></div>
                                    </div>
                                    <span class="percentage">2%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sample Reviews -->
                    <div class="reviews-list">
                        <div class="review-card">
                            <div class="review-header">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=50&h=50&fit=crop" alt="User" class="review-avatar">
                                <div class="review-info">
                                    <h4 class="reviewer-name">Michael S.</h4>
                                    <div class="review-meta">
                                        <div class="review-stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <span class="review-date">2 weeks ago</span>
                                    </div>
                                </div>
                            </div>
                            <p class="review-text">This is hands down the best Python course on Udemy. Angela's teaching style is engaging, clear, and thorough. The projects are practical and fun to build. I went from zero to confident Python developer in just 3 months!</p>
                            <div class="review-helpful">
                                <span>Helpful?</span>
                                <button class="btn-helpful"><i class="bi bi-hand-thumbs-up"></i> Yes</button>
                                <button class="btn-helpful"><i class="bi bi-hand-thumbs-down"></i> No</button>
                            </div>
                        </div>

                        <div class="review-card">
                            <div class="review-header">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=50&h=50&fit=crop" alt="User" class="review-avatar">
                                <div class="review-info">
                                    <h4 class="reviewer-name">Sarah L.</h4>
                                    <div class="review-meta">
                                        <div class="review-stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <span class="review-date">1 month ago</span>
                                    </div>
                                </div>
                            </div>
                            <p class="review-text">Amazing course! The 100 days format keeps me motivated and accountable. Every day I learn something new and build a project. The instructor explains complex concepts in simple terms. Highly recommend!</p>
                            <div class="review-helpful">
                                <span>Helpful?</span>
                                <button class="btn-helpful"><i class="bi bi-hand-thumbs-up"></i> Yes</button>
                                <button class="btn-helpful"><i class="bi bi-hand-thumbs-down"></i> No</button>
                            </div>
                        </div>

                        <div class="review-card">
                            <div class="review-header">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=50&h=50&fit=crop" alt="User" class="review-avatar">
                                <div class="review-info">
                                    <h4 class="reviewer-name">David K.</h4>
                                    <div class="review-meta">
                                        <div class="review-stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </div>
                                        <span class="review-date">3 weeks ago</span>
                                    </div>
                                </div>
                            </div>
                            <p class="review-text">Best investment I've made in my career. The course is comprehensive, well-structured, and the projects are exactly what you need to build a portfolio. I got a job as a Python developer 4 months after completing this course!</p>
                            <div class="review-helpful">
                                <span>Helpful?</span>
                                <button class="btn-helpful"><i class="bi bi-hand-thumbs-up"></i> Yes</button>
                                <button class="btn-helpful"><i class="bi bi-hand-thumbs-down"></i> No</button>
                            </div>
                        </div>
                    </div>

                    <button class="btn-show-more-reviews">
                        Show all reviews
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <!-- Right Column: Sticky Purchase Box -->
            <div class="content-right-column">
                <div class="purchase-box-sticky" id="purchaseBox">
                    <!-- Pricing Header -->
                    <div class="purchase-header-gradient">
                        <span class="offer-badge">Special Offer</span>
                    </div>

                    <!-- Pricing -->
                    <div class="purchase-box-content">
                        <div class="price-section">
                            <div class="price-row">
                                <span class="price-current">₹455</span>
                                <span class="price-original">₹3,199</span>
                                <span class="price-discount">86% off</span>
                            </div>
                        </div>

                        <!-- Countdown Timer -->
                        <div class="urgency-timer">
                            <i class="bi bi-alarm-fill"></i>
                            <span><strong>Discount expires in: </strong></span>
                            <div class="countdown-display">
                                <div class="countdown-item">
                                    <span class="countdown-value" id="hours">23</span>
                                    <span class="countdown-label">h</span>
                                </div>
                                <span class="countdown-separator">:</span>
                                <div class="countdown-item">
                                    <span class="countdown-value" id="minutes">45</span>
                                    <span class="countdown-label">m</span>
                                </div>
                                <span class="countdown-separator">:</span>
                                <div class="countdown-item">
                                    <span class="countdown-value" id="seconds">32</span>
                                    <span class="countdown-label">s</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="purchase-buttons">
                            <button class="btn-add-to-cart-purchase" onclick="addToCart(1)">
                                <i class="bi bi-cart-plus-fill"></i>
                                Add to cart
                            </button>
                            <button class="btn-buy-now-purchase">
                                Buy now
                            </button>
                        </div>

                        <!-- Money Back Guarantee -->
                        <div class="guarantee-banner">
                            <i class="bi bi-shield-fill-check"></i>
                            <span>30-Day Money-Back Guarantee</span>
                        </div>

                        <!-- Course Includes -->
                        <div class="course-includes-section">
                            <h4 class="includes-title">This course includes:</h4>
                            <ul class="includes-list">
                                <li>
                                    <i class="bi bi-play-btn-fill"></i>
                                    <span>59 hours on-demand video</span>
                                </li>
                                <li>
                                    <i class="bi bi-code-square"></i>
                                    <span>113 coding exercises</span>
                                </li>
                                <li>
                                    <i class="bi bi-file-earmark-text-fill"></i>
                                    <span>232 articles</span>
                                </li>
                                <li>
                                    <i class="bi bi-download"></i>
                                    <span>156 downloadable resources</span>
                                </li>
                                <li>
                                    <i class="bi bi-phone-fill"></i>
                                    <span>Access on mobile and TV</span>
                                </li>
                                <li>
                                    <i class="bi bi-infinity"></i>
                                    <span>Full lifetime access</span>
                                </li>
                                <li>
                                    <i class="bi bi-trophy-fill"></i>
                                    <span>Certificate of completion</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Share and Wishlist -->
                        <div class="purchase-actions">
                            <button class="btn-share-purchase">
                                <i class="bi bi-share-fill"></i>
                                Share
                            </button>
                            <button class="btn-wishlist-purchase" onclick="addToWishlist(1)">
                                <i class="bi bi-heart"></i>
                                Wishlist
                            </button>
                            <button class="btn-gift-purchase">
                                <i class="bi bi-gift-fill"></i>
                                Gift
                            </button>
                        </div>

                        <!-- Apply Coupon -->
                        <div class="coupon-section">
                            <button class="btn-apply-coupon">
                                <i class="bi bi-tag-fill"></i>
                                Apply Coupon
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/course-detail.js']); ?>
