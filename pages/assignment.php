<?php
include('../config.php');
include('../includes/data-functions.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

// Get course ID from URL, default to 1
$course_id = isset($_GET['course']) ? (int)$_GET['course'] : 1;
$assignment_id = isset($_GET['assignment']) ? (int)$_GET['assignment'] : null;

// Get course data and assignments using centralized functions
$current_course = getCourseById($course_id);
$assignments = getCourseAssignments($course_id);

// Fallback if course not found
if (!$current_course) {
    $current_course = getCourseById(1);
    $course_id = 1;
    $assignments = getCourseAssignments(1);
}

renderHead($current_course['title'] . ' - Assignments', ['css/dashboard.css', 'css/my-courses.css']);
renderNavbar();
?>

<div class="my-courses-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('assignments'); ?>

    <!-- Main Content -->
    <main class="my-courses-main" id="myCoursesMain">
        <!-- Header -->
        <div class="courses-header fade-in-up">
            <div>
                <h1 class="page-title"><?php echo $current_course['title']; ?></h1>
                <p class="page-subtitle">
                    <a href="<?php echo url('pages/assignments.php'); ?>" class="text-decoration-none" style="color: var(--primary);"><i class="bi bi-arrow-left"></i> Back to All Courses</a>
                    &nbsp;&nbsp;•&nbsp;&nbsp; Instructor: <?php echo $current_course['instructor']; ?>
                </p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Assignments List -->
        <div class="courses-grid fade-in-up" style="animation-delay: 0.1s">
            <?php foreach ($assignments as $assignment):
                $days_until_due = getDaysUntilDue($assignment['due_date']);
                $is_due_soon = $days_until_due >= 0 && $days_until_due <= 3;
            ?>
            <!-- Assignment Card -->
            <div class="course-card <?php echo $assignment['status'] === 'locked' ? 'locked' : ''; ?>">
                <div class="course-content" style="padding: 2rem;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div style="flex: 1;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <?php if ($assignment['status'] === 'submitted'): ?>
                                    <span class="badge" style="background: var(--success); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                        <i class="bi bi-check-circle-fill"></i> Submitted
                                    </span>
                                    <?php if ($assignment['grade'] !== null): ?>
                                    <span class="badge" style="background: var(--primary); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                        Grade: <?php echo $assignment['grade']; ?>/<?php echo $assignment['max_points']; ?>
                                    </span>
                                    <?php endif; ?>
                                <?php elseif ($assignment['status'] === 'pending'): ?>
                                    <?php if ($is_due_soon): ?>
                                        <span class="badge" style="background: var(--danger); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                            <i class="bi bi-exclamation-triangle-fill"></i> Due in <?php echo $days_until_due; ?> day<?php echo $days_until_due != 1 ? 's' : ''; ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge" style="background: var(--warning); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                            <i class="bi bi-clock-fill"></i> Pending
                                        </span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge" style="background: var(--text-muted); color: white; padding: 0.25rem 0.75rem; border-radius: 0.5rem;">
                                        <i class="bi bi-lock-fill"></i> Locked
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h3 class="course-title mb-2"><?php echo $assignment['title']; ?></h3>
                        </div>
                        <div style="font-size: 2.5rem; color: var(--primary); opacity: 0.2;">
                            <i class="bi bi-file-earmark-code-fill"></i>
                        </div>
                    </div>

                    <div class="assignment-meta" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; padding: 1rem 0; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); margin: 1rem 0;">
                        <div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em;">Due Date</div>
                            <div style="font-size: 1.1rem; font-weight: 600; color: var(--text-main);"><?php echo date('M d, Y', strtotime($assignment['due_date'])); ?></div>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em;">Max Points</div>
                            <div style="font-size: 1.1rem; font-weight: 600; color: var(--text-main);"><?php echo $assignment['max_points']; ?> pts</div>
                        </div>
                    </div>

                    <?php if ($assignment['status'] === 'pending' && $days_until_due >= 0): ?>
                    <div class="alert" style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); border-radius: 0.5rem; padding: 0.75rem; margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--danger); font-size: 0.9rem;">
                            <i class="bi bi-clock-fill"></i>
                            <?php if ($days_until_due === 0): ?>
                                <strong>Due Today!</strong> Submit before midnight
                            <?php else: ?>
                                <strong><?php echo $days_until_due; ?> day<?php echo $days_until_due != 1 ? 's' : ''; ?> remaining</strong> to submit
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="course-footer" style="margin-top: 1.5rem;">
                        <?php if ($assignment['status'] === 'submitted'): ?>
                            <a href="<?php echo url('pages/assignment.php?course=' . $course_id . '&assignment=' . $assignment['id']); ?>" class="btn-continue-small" style="width: 100%;">
                                <i class="bi bi-eye-fill"></i> View Submission
                            </a>
                        <?php elseif ($assignment['status'] === 'pending'): ?>
                            <a href="<?php echo url('pages/assignment.php?course=' . $course_id . '&assignment=' . $assignment['id']); ?>" class="btn-continue-small" style="width: 100%; background: <?php echo $is_due_soon ? 'var(--danger)' : 'var(--warning)'; ?>;">
                                <i class="bi bi-upload"></i> Submit Assignment
                            </a>
                        <?php else: ?>
                            <button class="btn-continue-small" style="width: 100%; background: var(--text-muted); cursor: not-allowed;" disabled>
                                <i class="bi bi-lock-fill"></i> Complete Previous Assignments
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($assignments)): ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 4rem; color: var(--text-muted);"></i>
            <h3 class="mt-3">No Assignments Available</h3>
            <p class="text-secondary">There are no assignments for this course yet.</p>
        </div>
        <?php endif; ?>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
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

<style>
.course-card.locked {
    opacity: 0.6;
    pointer-events: none;
}
</style>
