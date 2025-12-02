<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('Certificate Preview', ['css/dashboard.css', 'css/certificate.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('achievements'); ?>

    <!-- Main Content -->
    <main class="dashboard-main">
        <div class="certificate-page-container fade-in-up">
            
            <div class="page-header text-center mb-4">
                <h1 class="page-title">Congratulations!</h1>
                <p class="page-subtitle">You've successfully completed the course</p>
            </div>

            <div class="certificate-preview-card">
                <!-- Certificate Visual -->
                <div class="certificate-frame">
                    <div class="certificate-content">
                        <i class="bi bi-award-fill cert-logo display-4"></i>
                        <h2 class="cert-title">Certificate of Completion</h2>
                        <p class="cert-subtitle">This is to certify that</p>
                        <div class="cert-recipient">John Doe</div>
                        <p class="cert-subtitle">has successfully completed the course</p>
                        <h3 class="cert-course">Advanced Machine Learning</h3>
                        
                        <div class="cert-footer">
                            <div class="cert-signature">
                                <div class="signature-line"></div>
                                <div class="signature-name">Dr. Sarah Johnson</div>
                                <div class="signature-title">Lead Instructor</div>
                            </div>
                            <div class="cert-signature">
                                <div class="signature-line"></div>
                                <div class="signature-name">Nov 21, 2025</div>
                                <div class="signature-title">Date Issued</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="certificate-actions">
                    <button class="btn-cert-action btn-download-pdf">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
                    </button>
                    <button class="btn-cert-action btn-share">
                        <i class="bi bi-linkedin share-linkedin"></i> Share on LinkedIn
                    </button>
                    <button class="btn-cert-action btn-share">
                        <i class="bi bi-twitter share-twitter"></i> Share on Twitter
                    </button>
                    <button class="btn-cert-action btn-share">
                        <i class="bi bi-facebook share-facebook"></i> Share on Facebook
                    </button>
                </div>
            </div>

        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>
