<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Careers - Join Our Team at SAS-AI', ['css/careers.css']);
renderNavbar();
?>

    <!-- Careers Hero Section -->
    <section class="careers-hero-section">
        <div class="careers-hero-container fade-in-up">
            <h1 class="careers-main-title">Join Our Mission to Revolutionize Medical AI</h1>
            <p class="careers-subtitle">Be part of a team that's transforming healthcare through artificial intelligence and innovation</p>
            <a href="#open-positions" class="btn-hero-cta">
                <span>View Open Positions</span>
                <i class="bi bi-arrow-down"></i>
            </a>
        </div>
    </section>

    <!-- Why Work With Us Section -->
    <section class="why-work-section">
        <div class="why-work-container">
            <div class="section-header fade-in-up">
                <h2>Why Work With Us</h2>
                <p>Join a team that values innovation, collaboration, and making a real impact in healthcare</p>
            </div>

            <div class="benefits-grid">
                <div class="benefit-card fade-in-up" style="animation-delay: 0.1s">
                    <div class="benefit-icon">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>
                    <h3>Innovation First</h3>
                    <p>Work on cutting-edge AI projects that are shaping the future of medical research and drug discovery</p>
                </div>

                <div class="benefit-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="benefit-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3>Amazing Team</h3>
                    <p>Collaborate with world-class researchers, engineers, and healthcare professionals</p>
                </div>

                <div class="benefit-card fade-in-up" style="animation-delay: 0.3s">
                    <div class="benefit-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h3>Career Growth</h3>
                    <p>Continuous learning opportunities, mentorship programs, and clear career progression paths</p>
                </div>

                <div class="benefit-card fade-in-up" style="animation-delay: 0.4s">
                    <div class="benefit-icon">
                        <i class="bi bi-currency-rupee"></i>
                    </div>
                    <h3>Competitive Pay</h3>
                    <p>Industry-leading salaries, performance bonuses, and equity options for key roles</p>
                </div>

                <div class="benefit-card fade-in-up" style="animation-delay: 0.5s">
                    <div class="benefit-icon">
                        <i class="bi bi-heart-pulse-fill"></i>
                    </div>
                    <h3>Health & Wellness</h3>
                    <p>Comprehensive health insurance, mental wellness programs, and fitness memberships</p>
                </div>

                <div class="benefit-card fade-in-up" style="animation-delay: 0.6s">
                    <div class="benefit-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h3>Flexible Work</h3>
                    <p>Hybrid work options, flexible hours, and modern office spaces in prime locations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Open Positions Section -->
    <section class="open-positions-section" id="open-positions">
        <div class="positions-container">
            <div class="section-header fade-in-up">
                <h2>Open Positions</h2>
                <p>Find your next opportunity and apply today</p>
            </div>

            <div class="positions-filter fade-in-up">
                <button class="filter-btn active" data-filter="all">All Positions</button>
                <button class="filter-btn" data-filter="engineering">Engineering</button>
                <button class="filter-btn" data-filter="research">Research</button>
                <button class="filter-btn" data-filter="product">Product</button>
                <button class="filter-btn" data-filter="business">Business</button>
            </div>

            <div class="positions-list">
                <!-- Position 1 -->
                <div class="position-card fade-in-up" style="animation-delay: 0.1s" data-category="engineering">
                    <div class="position-header">
                        <div>
                            <h3>Senior Machine Learning Engineer</h3>
                            <div class="position-meta">
                                <span><i class="bi bi-briefcase-fill"></i> Engineering</span>
                                <span><i class="bi bi-geo-alt-fill"></i> Bangalore, India</span>
                                <span><i class="bi bi-clock-fill"></i> Full-time</span>
                            </div>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </div>
                    <p class="position-description">Build and deploy state-of-the-art ML models for drug discovery and medical imaging analysis. Work with massive healthcare datasets and cutting-edge deep learning frameworks.</p>
                    <div class="position-tags">
                        <span class="tag">Python</span>
                        <span class="tag">TensorFlow</span>
                        <span class="tag">PyTorch</span>
                        <span class="tag">Deep Learning</span>
                    </div>
                </div>

                <!-- Position 2 -->
                <div class="position-card fade-in-up" style="animation-delay: 0.2s" data-category="research">
                    <div class="position-header">
                        <div>
                            <h3>AI Research Scientist</h3>
                            <div class="position-meta">
                                <span><i class="bi bi-briefcase-fill"></i> Research</span>
                                <span><i class="bi bi-geo-alt-fill"></i> Bangalore / Remote</span>
                                <span><i class="bi bi-clock-fill"></i> Full-time</span>
                            </div>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </div>
                    <p class="position-description">Conduct groundbreaking research in AI-powered drug discovery. Publish papers, collaborate with academic institutions, and push the boundaries of what's possible in computational biology.</p>
                    <div class="position-tags">
                        <span class="tag">PhD Required</span>
                        <span class="tag">AI/ML</span>
                        <span class="tag">Bioinformatics</span>
                        <span class="tag">Research</span>
                    </div>
                </div>

                <!-- Position 3 -->
                <div class="position-card fade-in-up" style="animation-delay: 0.3s" data-category="engineering">
                    <div class="position-header">
                        <div>
                            <h3>Full Stack Developer</h3>
                            <div class="position-meta">
                                <span><i class="bi bi-briefcase-fill"></i> Engineering</span>
                                <span><i class="bi bi-geo-alt-fill"></i> Bangalore, India</span>
                                <span><i class="bi bi-clock-fill"></i> Full-time</span>
                            </div>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </div>
                    <p class="position-description">Build scalable web applications for our learning platform. Work with modern frameworks and cloud technologies to create seamless user experiences.</p>
                    <div class="position-tags">
                        <span class="tag">React</span>
                        <span class="tag">Node.js</span>
                        <span class="tag">AWS</span>
                        <span class="tag">MongoDB</span>
                    </div>
                </div>

                <!-- Position 4 -->
                <div class="position-card fade-in-up" style="animation-delay: 0.4s" data-category="product">
                    <div class="position-header">
                        <div>
                            <h3>Product Manager - EdTech</h3>
                            <div class="position-meta">
                                <span><i class="bi bi-briefcase-fill"></i> Product</span>
                                <span><i class="bi bi-geo-alt-fill"></i> Bangalore, India</span>
                                <span><i class="bi bi-clock-fill"></i> Full-time</span>
                            </div>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </div>
                    <p class="position-description">Define product strategy and roadmap for our online learning platform. Work closely with engineering, design, and business teams to deliver exceptional user experiences.</p>
                    <div class="position-tags">
                        <span class="tag">Product Strategy</span>
                        <span class="tag">EdTech</span>
                        <span class="tag">Agile</span>
                        <span class="tag">Analytics</span>
                    </div>
                </div>

                <!-- Position 5 -->
                <div class="position-card fade-in-up" style="animation-delay: 0.5s" data-category="business">
                    <div class="position-header">
                        <div>
                            <h3>Business Development Manager</h3>
                            <div class="position-meta">
                                <span><i class="bi bi-briefcase-fill"></i> Business</span>
                                <span><i class="bi bi-geo-alt-fill"></i> Mumbai, India</span>
                                <span><i class="bi bi-clock-fill"></i> Full-time</span>
                            </div>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </div>
                    <p class="position-description">Drive partnerships with pharmaceutical companies, research institutions, and healthcare organizations. Expand our reach and impact in the medical AI space.</p>
                    <div class="position-tags">
                        <span class="tag">Sales</span>
                        <span class="tag">Partnerships</span>
                        <span class="tag">Healthcare</span>
                        <span class="tag">Strategy</span>
                    </div>
                </div>

                <!-- Position 6 -->
                <div class="position-card fade-in-up" style="animation-delay: 0.6s" data-category="research">
                    <div class="position-header">
                        <div>
                            <h3>Bioinformatics Specialist</h3>
                            <div class="position-meta">
                                <span><i class="bi bi-briefcase-fill"></i> Research</span>
                                <span><i class="bi bi-geo-alt-fill"></i> Bangalore, India</span>
                                <span><i class="bi bi-clock-fill"></i> Full-time</span>
                            </div>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </div>
                    <p class="position-description">Analyze genomic data using computational tools and machine learning. Work on personalized medicine projects and contribute to breakthrough discoveries.</p>
                    <div class="position-tags">
                        <span class="tag">Genomics</span>
                        <span class="tag">Python/R</span>
                        <span class="tag">NGS</span>
                        <span class="tag">Bioinformatics</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Culture Section -->
    <section class="culture-section">
        <div class="culture-container">
            <div class="section-header fade-in-up">
                <h2>Our Culture</h2>
                <p>Experience what it's like to work at SAS-AI</p>
            </div>

            <div class="culture-grid">
                <div class="culture-card fade-in-up" style="animation-delay: 0.1s">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop" alt="Team Collaboration">
                    <h3>Collaborative Environment</h3>
                    <p>Work in modern spaces designed for creativity and teamwork</p>
                </div>

                <div class="culture-card fade-in-up" style="animation-delay: 0.2s">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&h=400&fit=crop" alt="Learning">
                    <h3>Continuous Learning</h3>
                    <p>Access to courses, conferences, and learning resources</p>
                </div>

                <div class="culture-card fade-in-up" style="animation-delay: 0.3s">
                    <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=600&h=400&fit=crop" alt="Celebration">
                    <h3>Celebrate Success</h3>
                    <p>Regular team events, hackathons, and celebrations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="careers-cta-section">
        <div class="careers-cta-container fade-in-up">
            <h2>Don't See the Right Role?</h2>
            <p>We're always looking for talented individuals. Send us your resume and we'll keep you in mind for future opportunities.</p>
            <a href="#" class="btn-cta-primary">Send Your Resume</a>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/careers.js']); ?>
