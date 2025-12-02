<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('FAQ - Frequently Asked Questions', ['css/faq.css']);
renderNavbar();
?>

    <!-- FAQ Header -->
    <section class="faq-header-section">
        <div class="faq-header-container fade-in-up">
            <h1 class="faq-main-title">Frequently Asked Questions</h1>
            <p class="faq-subtitle">Find answers to common questions about AI Cure Academy</p>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="faq-content-section">
        <div class="faq-container">
            <!-- General Questions -->
            <div class="faq-category fade-in-up">
                <h2 class="category-title">General Questions</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What is AI Cure Academy?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>AI Cure Academy is a leading online learning platform specializing in medical AI, drug discovery, and computational biology education. We provide comprehensive courses designed by industry experts to help healthcare professionals, researchers, and students master AI technologies in medicine.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Who are the courses designed for?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Our courses are designed for medical professionals, healthcare workers, biotech researchers, pharmaceutical professionals, medical students, and anyone interested in the intersection of AI and healthcare. Courses range from beginner to advanced levels.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Do I need prior programming experience?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>It depends on the course. We offer beginner-friendly courses that start with programming basics, as well as advanced courses that assume programming knowledge. Each course clearly states its prerequisites in the course description.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Access -->
            <div class="faq-category fade-in-up" style="animation-delay: 0.1s">
                <h2 class="category-title">Course Access & Content</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How long do I have access to a course?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>All courses come with lifetime access. Once you enroll, you can access the course materials anytime, anywhere, forever. You can also download resources for offline viewing.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Are course materials updated?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Yes! We regularly update our courses to reflect the latest developments in medical AI. All updates are free for enrolled students, and you will be notified when new content is added.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can I download course videos?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Yes, you can download lectures for offline viewing using our mobile app. This feature is available for all enrolled students at no extra cost.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment & Pricing -->
            <div class="faq-category fade-in-up" style="animation-delay: 0.2s">
                <h2 class="category-title">Payment & Pricing</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What payment methods do you accept?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>We accept all major credit/debit cards, PayPal, and UPI payments. All transactions are secured with 256-bit SSL encryption.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Do you offer refunds?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Yes! We offer a 30-day money-back guarantee. If you are not satisfied with a course for any reason, you can request a full refund within 30 days of purchase, no questions asked.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Are there any subscription fees?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>No, we do not have subscription fees. You pay once for each course and get lifetime access. We also offer course bundles at discounted prices.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certificates -->
            <div class="faq-category fade-in-up" style="animation-delay: 0.3s">
                <h2 class="category-title">Certificates & Recognition</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Do you provide certificates?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Yes! Upon successful completion of a course, you will receive a Certificate of Completion that can be shared on LinkedIn, included in your resume, and presented to employers.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Are the certificates accredited?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Our certificates are industry-recognized and valued by employers worldwide. While they are not university-accredited degrees, they demonstrate your commitment to professional development and mastery of medical AI skills.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div class="faq-category fade-in-up" style="animation-delay: 0.4s">
                <h2 class="category-title">Support & Help</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How can I get help if I'm stuck?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>We offer multiple support channels: Q&A forums in each course, direct messaging to instructors, live office hours, and 24/7 email support. Our community is also very active and helpful!</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can I get a demo before purchasing?</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Absolutely! Every course has free preview lectures. You can also contact us to schedule a personalized demo or consultation to help you choose the right course.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Still Have Questions -->
    <section class="contact-cta-section">
        <div class="contact-cta-container fade-in-up">
            <i class="bi bi-question-circle-fill"></i>
            <h2>Still have questions?</h2>
            <p>Cannot find the answer you are looking for? Our support team is here to help.</p>
            <a href="<?php echo url('pages/contact.php'); ?>" class="btn-contact-cta">Contact Support</a>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(['js/faq.js']); ?>
