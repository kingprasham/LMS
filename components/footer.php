<?php
function renderFooter() {
    $base = getBasePath();
?>
<footer class="modern-footer">
    <div class="footer-wave">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 Q300,40 600,20 T1200,0 L1200,120 L0,120 Z" fill="currentColor"></path>
        </svg>
    </div>

    <div class="footer-container">
        <div class="footer-main">
            <div class="footer-brand-section">
                <div class="footer-logo">
                    <img src="<?php echo $base; ?>images/logo-f.png" alt="AI Cure Academy Footer Logo" class="footer-logo-img">
                </div>
                <p class="footer-tagline">Empowering the future of AI-driven medical research and drug discovery through world-class education</p>
                <div class="footer-social">
                    <a href="https://x.com/CureSas24797" class="social-link" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/ai-cure-academy/" class="social-link" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61583992560958" class="social-link" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/aicureacademy/" class="social-link" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCzPbRVmzN6HLt-276SE59KA" class="social-link" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="footer-links-grid">
                <div class="footer-column">
                    <h4 class="footer-column-title">Platform</h4>
                    <ul class="footer-links">
                        <li><a href="#">Medical AI Courses</a></li>
                        <li><a href="#">Drug Discovery Programs</a></li>
                        <li><a href="#">Research Tools & Labs</a></li>
                        <li><a href="#">Get the App</a></li>
                        <li><a href="#">Pricing</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-column-title">Company</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo $base; ?>pages/about.php">About Us</a></li>
                        <li><a href="<?php echo $base; ?>pages/careers.php">Careers</a></li>
                        <li><a href="<?php echo $base; ?>pages/blog.php">Blog</a></li>
                        <li><a href="<?php echo $base; ?>pages/contact.php">Contact</a></li>
                        <li><a href="<?php echo $base; ?>pages/teach.php">Teach with Us</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-column-title">Resources</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo $base; ?>pages/faq.php">FAQ</a></li>
                        <li><a href="<?php echo $base; ?>pages/courses.php">All Courses</a></li>
                        <li><a href="<?php echo $base; ?>pages/category.php">Categories</a></li>
                        <li><a href="<?php echo $base; ?>pages/contact.php">Support</a></li>
                        <li><a href="<?php echo $base; ?>pages/blog.php">Blog</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-column-title">Legal</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo $base; ?>pages/privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="<?php echo $base; ?>pages/terms.php">Terms & Conditions</a></li>
                        <li><a href="<?php echo $base; ?>pages/faq.php">Help Center</a></li>
                        <li><a href="<?php echo $base; ?>pages/contact.php">Contact Us</a></li>
                        <li><a href="<?php echo $base; ?>index.php">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-newsletter">
            <h4 class="newsletter-title">Stay Updated</h4>
            <p class="newsletter-description">Subscribe to our newsletter for the latest medical AI breakthroughs and drug discovery insights</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email" class="newsletter-input" required>
                <button type="submit" class="newsletter-btn">
                    <span>Subscribe</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>

        <div class="footer-bottom">
            <p class="footer-copyright">&copy; 2025 SAS-AI, Inc. All rights reserved.</p>
            <div class="footer-bottom-links">
                <button class="footer-language-btn">
                    <i class="bi bi-globe"></i>
                    <span>English</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>
        </div>
    </div>
</footer>
<?php
}
?>
