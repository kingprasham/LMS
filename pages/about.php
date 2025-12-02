<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('About Us - AI Cure Academy', ['css/about.css']);
renderNavbar();
?>

    <!-- About Header Section -->
    <section class="about-header-section">
        <div class="about-header-container fade-in-up">
            <h1 class="about-main-title">About AI Cure Academy</h1>
            <p class="about-subtitle">Empowering the next generation of medical AI innovators</p>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="mission-vision-section">
        <div class="mission-vision-container">
            <div class="mission-card fade-in-up">
                <div class="card-icon">
                    <i class="bi bi-flag-fill"></i>
                </div>
                <h2>Our Mission</h2>
                <p>To democratize access to cutting-edge medical AI education and empower healthcare professionals, researchers, and students with the skills needed to revolutionize healthcare through artificial intelligence.</p>
            </div>

            <div class="vision-card fade-in-up" style="animation-delay: 0.2s">
                <div class="card-icon">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <h2>Our Vision</h2>
                <p>To become the global leader in medical AI education, creating a community of innovators who will transform healthcare delivery, drug discovery, and patient outcomes through responsible AI implementation.</p>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="story-container">
            <div class="story-content fade-in-up">
                <h2 class="section-title">Our Story</h2>
                <div class="story-text">
                    <p>AI Cure Academy was founded in 2020 by a team of medical professionals, AI researchers, and educators who recognized the urgent need for specialized training at the intersection of healthcare and artificial intelligence.</p>

                    <p>What started as a small initiative to train healthcare professionals in basic AI concepts has grown into a comprehensive platform offering world-class courses in medical AI, drug discovery, computational biology, and clinical data science.</p>

                    <p>Today, we're proud to serve over 50,000 students worldwide, from medical students and practicing physicians to biotech researchers and pharmaceutical companies. Our courses have helped launch careers, accelerate research projects, and contribute to breakthrough medical discoveries.</p>

                    <p>We believe that the future of medicine lies in the thoughtful integration of AI technologies, and we're committed to ensuring that healthcare professionals have the knowledge and tools they need to lead this transformation.</p>
                </div>
            </div>

            <div class="story-stats fade-in-up" style="animation-delay: 0.2s">
                <div class="stat-item">
                    <div class="stat-number">50,000+</div>
                    <div class="stat-label">Students Worldwide</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">200+</div>
                    <div class="stat-label">Expert Courses</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Satisfaction Rate</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">40+</div>
                    <div class="stat-label">Countries Reached</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="values-container">
            <h2 class="section-title fade-in-up">Our Core Values</h2>

            <div class="values-grid">
                <div class="value-card fade-in-up">
                    <div class="value-icon">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>We continuously update our curriculum to reflect the latest advancements in medical AI and healthcare technology.</p>
                </div>

                <div class="value-card fade-in-up" style="animation-delay: 0.1s">
                    <div class="value-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3>Ethics</h3>
                    <p>We emphasize responsible AI development with a focus on patient privacy, data security, and ethical considerations.</p>
                </div>

                <div class="value-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="value-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3>Accessibility</h3>
                    <p>We believe quality education should be accessible to everyone, regardless of background or location.</p>
                </div>

                <div class="value-card fade-in-up" style="animation-delay: 0.3s">
                    <div class="value-icon">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h3>Excellence</h3>
                    <p>We maintain the highest standards in course content, instructor expertise, and student support services.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="team-container">
            <h2 class="section-title fade-in-up">Meet Our Team</h2>
            <p class="section-subtitle fade-in-up">World-class educators and researchers dedicated to your success</p>

            <div class="team-grid">
                <!-- Team Member 1 -->
                <div class="team-card fade-in-up">
                    <div class="team-image-wrapper">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Dr. Rajesh Kumar" class="team-image">
                        <div class="team-social">
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dr. Rajesh Kumar</h3>
                        <p class="team-role">Founder & CEO</p>
                        <p class="team-bio">Former Head of Medical AI at Mayo Clinic with 15+ years of experience in healthcare technology and AI research.</p>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="team-card fade-in-up" style="animation-delay: 0.1s">
                    <div class="team-image-wrapper">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dr. Priya Sharma" class="team-image">
                        <div class="team-social">
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dr. Priya Sharma</h3>
                        <p class="team-role">Chief Learning Officer</p>
                        <p class="team-bio">PhD in Computational Biology from MIT. Pioneering research in drug discovery using deep learning algorithms.</p>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="team-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="team-image-wrapper">
                        <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Prof. Amit Patel" class="team-image">
                        <div class="team-social">
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Prof. Amit Patel</h3>
                        <p class="team-role">Director of Curriculum</p>
                        <p class="team-bio">Professor of Medical Informatics at Stanford University. Author of 100+ research papers on clinical AI applications.</p>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="team-card fade-in-up" style="animation-delay: 0.3s">
                    <div class="team-image-wrapper">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Dr. Sneha Reddy" class="team-image">
                        <div class="team-social">
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dr. Sneha Reddy</h3>
                        <p class="team-role">Head of Student Success</p>
                        <p class="team-bio">Former Director of Medical Education at Johns Hopkins. Passionate about student mentorship and career development.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container fade-in-up">
            <h2>Ready to Start Your Medical AI Journey?</h2>
            <p>Join thousands of healthcare professionals transforming medicine through AI</p>
            <a href="<?php echo url('index.php'); ?>" class="btn-cta">
                <i class="bi bi-rocket-takeoff-fill"></i>
                Browse Courses
            </a>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(); ?>
