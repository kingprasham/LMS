<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('Grade Assignment', ['css/dashboard.css', 'css/admin-users.css', 'css/instructor-dashboard.css']);
renderNavbar();

// Static data for demo
$submission = [
    'id' => 1,
    'title' => 'Build a Portfolio Website',
    'course' => 'Complete Web Development Bootcamp 2024',
    'student' => 'Sarah Johnson',
    'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Johnson&background=random',
    'submitted_date' => '2024-04-10 14:30',
    'description' => 'I have built a responsive portfolio website using HTML, CSS, and a bit of JavaScript for the mobile menu. I used Flexbox for the layout and CSS Grid for the projects section.',
    'files' => [
        ['name' => 'portfolio-project.zip', 'size' => '4.2 MB', 'type' => 'zip'],
        ['name' => 'screenshot.png', 'size' => '1.5 MB', 'type' => 'image']
    ],
    'link' => 'https://sarah-portfolio-demo.netlify.app'
];
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('assignments'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <div class="back-link mb-2">
                    <a href="<?php echo url('pages/instructor/assignments.php'); ?>" class="text-secondary" style="text-decoration: none; font-size: 0.9rem;">
                        <i class="bi bi-arrow-left"></i> Back to Assignments
                    </a>
                </div>
                <h1 class="dashboard-title">Grade Submission</h1>
                <p class="dashboard-subtitle"><?php echo $submission['title']; ?> - <?php echo $submission['course']; ?></p>
            </div>
        </div>

        <div class="grading-container fade-in-up" style="animation-delay: 0.1s">
            <div class="row">
                <!-- Submission Details -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Submission Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="student-meta mb-4">
                                <img src="<?php echo $submission['avatar']; ?>" class="user-avatar" alt="Avatar">
                                <div>
                                    <div class="user-name"><?php echo $submission['student']; ?></div>
                                    <div class="text-secondary text-sm">Submitted on <?php echo date('M d, Y \a\t H:i', strtotime($submission['submitted_date'])); ?></div>
                                </div>
                            </div>

                            <div class="submission-content mb-4">
                                <h4 class="text-sm font-bold text-secondary uppercase mb-2">Student Notes</h4>
                                <p class="text-main"><?php echo $submission['description']; ?></p>
                            </div>

                            <div class="submission-files mb-4">
                                <h4 class="text-sm font-bold text-secondary uppercase mb-2">Attached Files</h4>
                                <div class="file-list">
                                    <?php foreach ($submission['files'] as $file): ?>
                                    <div class="file-item">
                                        <i class="bi bi-file-earmark-zip file-icon"></i>
                                        <div class="file-info">
                                            <div class="file-name"><?php echo $file['name']; ?></div>
                                            <div class="file-size"><?php echo $file['size']; ?></div>
                                        </div>
                                        <a href="#" class="btn-icon-sm"><i class="bi bi-download"></i></a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="submission-link">
                                <h4 class="text-sm font-bold text-secondary uppercase mb-2">Project Link</h4>
                                <a href="<?php echo $submission['link']; ?>" target="_blank" class="external-link">
                                    <?php echo $submission['link']; ?> <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grading Form -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Evaluation</h3>
                        </div>
                        <div class="card-body">
                            <form id="gradingForm">
                                <div class="form-group mb-3">
                                    <label class="form-label">Grade (0-100)</label>
                                    <input type="number" class="form-control" min="0" max="100" placeholder="e.g., 95" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Feedback</label>
                                    <textarea class="form-control" rows="6" placeholder="Provide constructive feedback..." required></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="checkbox-item">
                                        <input type="checkbox" checked>
                                        <span>Notify student via email</span>
                                    </label>
                                </div>

                                <button type="submit" class="btn-primary w-100">Submit Grade</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<style>
/* Grading Page Styles */
.card {
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

.card-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    background: #f8fafc;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.card-body {
    padding: 1.5rem;
}

.student-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
}

.text-sm { font-size: 0.875rem; }
.font-bold { font-weight: 600; }
.uppercase { text-transform: uppercase; letter-spacing: 0.05em; }
.text-secondary { color: #64748b; }
.text-main { color: #334155; line-height: 1.6; }

.file-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.file-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
}

.file-icon {
    font-size: 1.5rem;
    color: #4f46e5;
}

.file-info { flex: 1; }
.file-name { font-weight: 500; color: #1e293b; font-size: 0.9rem; }
.file-size { font-size: 0.8rem; color: #64748b; }

.btn-icon-sm {
    color: #64748b;
    font-size: 1.1rem;
    padding: 0.25rem;
}
.btn-icon-sm:hover { color: #4f46e5; }

.external-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
}
.external-link:hover { text-decoration: underline; }

.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.col-lg-8 { flex: 0 0 66.666667%; max-width: 66.666667%; padding: 0 15px; }
.col-lg-4 { flex: 0 0 33.333333%; max-width: 33.333333%; padding: 0 15px; }

@media (max-width: 992px) {
    .col-lg-8, .col-lg-4 { flex: 0 0 100%; max-width: 100%; }
}

.w-100 { width: 100%; }
.mb-2 { margin-bottom: 0.5rem; }
.mb-3 { margin-bottom: 1rem; }
.mb-4 { margin-bottom: 1.5rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle logic
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('active'));
    }

    // Form submission
    document.getElementById('gradingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Grade submitted successfully! (This is a static demo)');
        window.location.href = '<?php echo url('pages/instructor/assignments.php'); ?>';
    });
});
</script>
