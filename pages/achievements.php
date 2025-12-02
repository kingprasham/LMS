<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('Achievements', ['css/dashboard.css', 'css/achievements.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('achievements'); ?>

    <!-- Main Content -->
    <main class="dashboard-main">
        <div class="achievements-container fade-in-up">
            <div class="page-header">
                <h1 class="page-title">Achievements</h1>
                <p class="page-subtitle">Track your progress and earned certificates</p>
            </div>

            <!-- Stats Overview -->
            <div class="achievement-stats">
                <div class="stat-box">
                    <div class="stat-icon gold">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3>12</h3>
                        <p>Badges Earned</p>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon purple">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3>4</h3>
                        <p>Certificates</p>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon blue">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3>2,450</h3>
                        <p>XP Points</p>
                    </div>
                </div>
            </div>

            <!-- Badges Section -->
            <section class="badges-section">
                <h2 class="section-title">Recent Badges</h2>
                <div class="badges-grid">
                    <div class="badge-card">
                        <div class="badge-img">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h3>Fast Learner</h3>
                        <p>Completed 3 lessons in one day</p>
                        <span class="badge-date">Earned Nov 15</span>
                    </div>

                    <div class="badge-card">
                        <div class="badge-img">
                            <i class="bi bi-chat-square-quote-fill"></i>
                        </div>
                        <h3>Top Contributor</h3>
                        <p>Posted 10 helpful comments</p>
                        <span class="badge-date">Earned Nov 10</span>
                    </div>

                    <div class="badge-card">
                        <div class="badge-img">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h3>Week Warrior</h3>
                        <p>Maintained a 7-day streak</p>
                        <span class="badge-date">Earned Nov 05</span>
                    </div>

                    <div class="badge-card locked">
                        <div class="badge-img">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <h3>Master Mind</h3>
                        <p>Score 100% on a final exam</p>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Certificates Section -->
            <section class="certificates-section">
                <h2 class="section-title">Certificates</h2>
                <div class="certificates-list">
                    <!-- Course 1: Completed & Unlocked -->
                    <div class="certificate-item">
                        <div class="cert-icon">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>
                        <div class="cert-details">
                            <h3>Advanced Python Programming</h3>
                            <p>Issued by Tech Academy • Oct 20, 2025</p>
                        </div>
                        <a href="<?php echo url('pages/certificate.php'); ?>" class="btn-download text-decoration-none">
                            <i class="bi bi-eye"></i> View Certificate
                        </a>
                    </div>

                    <!-- Course 2: In Progress (Locked) -->
                    <div class="certificate-item" style="opacity: 0.7;">
                        <div class="cert-icon" style="background: #f3f4f6; color: #9ca3af;">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <div class="cert-details">
                            <h3>Machine Learning Fundamentals</h3>
                            <p class="text-muted">Course in progress (85% complete)</p>
                            <div class="progress mt-2" style="height: 6px; width: 200px;">
                                <div class="progress-bar bg-primary" style="width: 85%"></div>
                            </div>
                        </div>
                        <button class="btn-download" disabled style="cursor: not-allowed; opacity: 0.6;">
                            <i class="bi bi-lock"></i> Locked
                        </button>
                    </div>

                    <!-- Course 3: Completed & Unlocked -->
                    <div class="certificate-item">
                        <div class="cert-icon">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>
                        <div class="cert-details">
                            <h3>Web Development Bootcamp</h3>
                            <p>Issued by Code Masters • Aug 01, 2025</p>
                        </div>
                        <a href="<?php echo url('pages/certificate.php'); ?>" class="btn-download text-decoration-none">
                            <i class="bi bi-eye"></i> View Certificate
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>
