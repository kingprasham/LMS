<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('Support Center', ['css/dashboard.css', 'css/support.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Global Sidebar -->
    <?php renderSidebar('support'); ?>

    <!-- Main Content -->
    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Support Center</h1>
                <p class="dashboard-subtitle">Get help and find answers to your questions</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Support Content -->
        <div class="support-content fade-in-up" style="animation-delay: 0.1s">
            
            <!-- Search Hero -->
            <div class="support-hero-card">
                <h2 class="h3 mb-3">How can we help you?</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control bg-card" placeholder="Search for answers...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links Grid -->
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div class="support-card">
                        <div class="support-icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <h5>Student Guide</h5>
                        <p>Learn how to take courses, quizzes, and get certificates.</p>
                        <a href="#" class="text-accent">Read Articles &rarr;</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="support-card">
                        <div class="support-icon">
                            <i class="bi bi-person-video3"></i>
                        </div>
                        <h5>Instructor Guide</h5>
                        <p>Everything you need to know about creating and managing courses.</p>
                        <a href="#" class="text-accent">Read Articles &rarr;</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="support-card">
                        <div class="support-icon">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <h5>Billing & Payments</h5>
                        <p>Questions about subscriptions, refunds, and invoices.</p>
                        <a href="#" class="text-accent">Read Articles &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Ticket Form -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="ticket-form-card">
                        <h3 class="h4 mb-4 fw-bold">Submit a Support Ticket</h3>
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" value="John Doe" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="john@example.com" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select">
                                    <option>Technical Issue</option>
                                    <option>Billing Question</option>
                                    <option>Course Content</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control" placeholder="Brief summary of the issue">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" rows="5" placeholder="Describe your issue in detail..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Attachments (Optional)</label>
                                <input type="file" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-custom-primary btn-lg w-100">Submit Ticket</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
    // Mobile Sidebar Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('mobileSidebarToggle');
        const sidebar = document.getElementById('dashboardSidebar');
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            }
        });
    });
</script>
