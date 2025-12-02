<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');

renderHead('Contact Us - Get in Touch with SAS-AI', ['css/contact.css']);
renderNavbar();
?>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="contact-container">
            <div class="section-header fade-in-up" style="color: white;">
                <h2 class="section-title">Get In Touch With Us</h2>
                <p class="section-subtitle">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>

            <div class="contact-wrapper">
                <!-- Contact Information -->
                <div>
                    <div class="contact-info-card fade-in-up" style="animation-delay: 0.1s">
                        <i class="bi bi-geo-alt-fill"></i>
                        <h3>Visit Us</h3>
                        <p>123 Trading Street, Financial District<br>Mumbai, Maharashtra 400001, India</p>
                    </div>

                    <div class="contact-info-card fade-in-up" style="animation-delay: 0.2s">
                        <i class="bi bi-telephone-fill"></i>
                        <h3>Call Us</h3>
                        <p>+91 98765 43210<br>+91 87654 32109</p>
                        <p style="font-size: 0.9rem; opacity: 0.9; margin-top: 10px;">Mon-Sat: 9:00 AM - 7:00 PM</p>
                    </div>

                    <div class="contact-info-card fade-in-up" style="animation-delay: 0.3s">
                        <i class="bi bi-envelope-fill"></i>
                        <h3>Email Us</h3>
                        <p>info@aicureacademy.com<br>support@aicureacademy.com</p>
                    </div>

                    <div class="contact-info-card fade-in-up" style="animation-delay: 0.4s">
                        <i class="bi bi-clock-fill"></i>
                        <h3>Office Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 7:00 PM<br>Saturday: 10:00 AM - 5:00 PM<br>Sunday: Closed</p>
                    </div>

                    <div class="contact-info-card fade-in-up" style="animation-delay: 0.5s">
                        <i class="bi bi-share-fill"></i>
                        <h3>Follow Us</h3>
                        <div style="display: flex; gap: 15px; font-size: 1.5rem; margin-top: 15px;">
                            <a href="#" style="color: white; transition: color 0.3s;" onmouseover="this.style.color='#1DA1F2'" onmouseout="this.style.color='white'">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" style="color: white; transition: color 0.3s;" onmouseover="this.style.color='#0A66C2'" onmouseout="this.style.color='white'">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" style="color: white; transition: color 0.3s;" onmouseover="this.style.color='#1877F2'" onmouseout="this.style.color='white'">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" style="color: white; transition: color 0.3s;" onmouseover="this.style.color='#E4405F'" onmouseout="this.style.color='white'">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" style="color: white; transition: color 0.3s;" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='white'">
                                <i class="bi bi-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form fade-in-up" style="animation-delay: 0.2s">
                    <h3 style="color: var(--text-dark); margin-bottom: 25px; font-size: 1.8rem;">Send Us A Message</h3>
                    <form id="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name <span style="color: red;">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" required placeholder="Enter your full name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address <span style="color: red;">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" required placeholder="Enter your email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number <span style="color: red;">*</span></label>
                                    <input type="tel" id="phone" name="phone" class="form-control" required placeholder="Enter your phone number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Subject <span style="color: red;">*</span></label>
                                    <select id="subject" name="subject" class="form-control" required>
                                        <option value="">Select a subject</option>
                                        <option value="course-inquiry">Course Inquiry</option>
                                        <option value="demo-request">Free Demo Request</option>
                                        <option value="support">Technical Support</option>
                                        <option value="partnership">Partnership Opportunity</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message <span style="color: red;">*</span></label>
                            <textarea id="message" name="message" class="form-control" required placeholder="Tell us more about your inquiry..."></textarea>
                        </div>

                        <div class="form-check" style="margin-bottom: 20px;">
                            <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                            <label class="form-check-label" for="newsletter" style="color: var(--text-gray);">
                                Subscribe to our newsletter for latest updates and offers
                            </label>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="bi bi-send-fill"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section style="padding: 0;">
        <div style="width: 100%; height: 400px; background: #e9ecef; position: relative;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241317.11609823277!2d72.74109995709657!3d19.08219783894948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1642234567890!5m2!1sen!2sin"
                width="100%"
                height="400"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </section>

<?php renderFooter(); ?>
<?php renderScripts(); ?>
