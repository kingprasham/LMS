<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Teach on SAS-AI - Become an Instructor', ['css/teach.css']);
renderNavbar();
?>

    <!-- Teach Hero Section -->
    <section class="teach-hero-section">
        <div class="teach-hero-container fade-in-up">
            <div class="hero-content">
                <h1 class="hero-title">Teach the World Online</h1>
                <p class="hero-subtitle">Create an online course and reach millions of learners worldwide. Share your knowledge and earn money doing what you love.</p>
                <button class="btn-hero-cta">Start Teaching Today</button>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&h=600&fit=crop" alt="Teach Online">
            </div>
        </div>
    </section>

    <!-- Reasons to Teach Section -->
    <section class="reasons-section">
        <div class="reasons-container">
            <h2 class="section-title fade-in-up">So Many Reasons to Start</h2>
            <div class="reasons-grid">
                <div class="reason-card fade-in-up" style="animation-delay: 0.1s">
                    <div class="reason-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3>Teach Your Way</h3>
                    <p>Publish the course you want, in the way you want, and always have control of your own content.</p>
                </div>

                <div class="reason-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="reason-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h3>Inspire Learners</h3>
                    <p>Teach what you know and help learners explore their interests, gain new skills, and advance their careers.</p>
                </div>

                <div class="reason-card fade-in-up" style="animation-delay: 0.3s">
                    <div class="reason-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <h3>Get Rewarded</h3>
                    <p>Expand your professional network, build your expertise, and earn money on each paid enrollment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Begin Section -->
    <section class="how-to-begin-section">
        <div class="how-to-container">
            <h2 class="section-title fade-in-up">How to Begin</h2>
            <div class="steps-grid">
                <div class="step-card fade-in-up" style="animation-delay: 0.1s">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <i class="bi bi-camera-video-fill"></i>
                    </div>
                    <h3>Plan Your Curriculum</h3>
                    <p>You start with your passion and knowledge. Then choose a promising topic with the help of our Marketplace Insights tool.</p>
                </div>

                <div class="step-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h3>Record Your Video</h3>
                    <p>Use basic tools like a smartphone or a DSLR camera. Add a good microphone and you're ready to start.</p>
                </div>

                <div class="step-card fade-in-up" style="animation-delay: 0.3s">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <i class="bi bi-rocket-takeoff-fill"></i>
                    </div>
                    <h3>Launch Your Course</h3>
                    <p>Gather your first ratings and reviews by promoting your course through social media and your professional networks.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Become Instructor CTA Section -->
    <section class="become-instructor-cta">
        <div class="cta-container fade-in-up">
            <div class="cta-content">
                <h2>Become an Instructor Today</h2>
                <p>Join one of the world's largest online learning marketplaces. More than 70,000 instructors teach on SAS-AI.</p>
            </div>
            <button class="btn-get-started">Get Started Now</button>
        </div>
    </section>

    <!-- Support Section -->
    <section class="support-section">
        <div class="support-container">
            <h2 class="section-title fade-in-up">You Won't Have to Do It Alone</h2>
            <p class="section-subtitle fade-in-up">Our Instructor Support Team is here to answer your questions and review your course.</p>
            <div class="support-grid">
                <div class="support-card fade-in-up" style="animation-delay: 0.1s">
                    <i class="bi bi-chat-dots-fill"></i>
                    <h3>Instructor Community</h3>
                    <p>Connect with experienced instructors in our online community.</p>
                </div>

                <div class="support-card fade-in-up" style="animation-delay: 0.2s">
                    <i class="bi bi-book-fill"></i>
                    <h3>Teaching Center</h3>
                    <p>Learn about best practices for teaching on SAS-AI.</p>
                </div>

                <div class="support-card fade-in-up" style="animation-delay: 0.3s">
                    <i class="bi bi-headset"></i>
                    <h3>24/7 Support</h3>
                    <p>Get help from our dedicated instructor support team anytime.</p>
                </div>

                <div class="support-card fade-in-up" style="animation-delay: 0.4s">
                    <i class="bi bi-graph-up-arrow"></i>
                    <h3>Marketing Tools</h3>
                    <p>Promote your courses with our built-in marketing tools.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-container">
            <h2 class="section-title fade-in-up">Frequently Asked Questions</h2>

            <div class="faq-accordion">
                <div class="faq-item fade-in-up" style="animation-delay: 0.1s">
                    <button class="faq-question">
                        <span>What are the requirements to teach on SAS-AI?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Anyone passionate about teaching can become an instructor on SAS-AI. You don't need any specific teaching credentials. However, you should have expertise in the subject you plan to teach and the ability to create engaging video content.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.2s">
                    <button class="faq-question">
                        <span>How much does it cost to create a course?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>It's completely free to create and publish courses on SAS-AI. We only take a revenue share when you make a sale through the platform.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.3s">
                    <button class="faq-question">
                        <span>How much money can I make as an instructor?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Instructor earnings vary widely depending on course quality, marketing, and student demand. Top instructors earn six figures annually, while others use it as supplemental income. You earn revenue from every paid enrollment.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.4s">
                    <button class="faq-question">
                        <span>What kind of support will I receive?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>You'll have access to our Teaching Center with resources and best practices, instructor community forums, and 24/7 support from our dedicated team. We also provide course quality reviews and marketing support.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up" style="animation-delay: 0.5s">
                    <button class="faq-question">
                        <span>How long does it take to create a course?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>The time to create a course varies depending on the topic and your preparation. On average, instructors spend 3-6 weeks planning, recording, and editing their first course. Once published, you can update it anytime.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="final-cta-section">
        <div class="final-cta-container fade-in-up">
            <h2>Ready to Share Your Knowledge?</h2>
            <p>Join thousands of instructors teaching millions of learners worldwide</p>
            <button class="btn-final-cta">Start Teaching Today</button>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/teach.js']); ?>
