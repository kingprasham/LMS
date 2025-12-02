<?php
include('../config.php');
include('../includes/data-functions.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

// Get course ID and lesson ID from URL parameters
$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$lesson_id = isset($_GET['lesson']) ? (int)$_GET['lesson'] : 1;

// Get course data and modules using centralized functions
$current_course = getCourseById($course_id);
$modules = getCourseModules($course_id);

// Fallback if course not found
if (!$current_course || empty($modules)) {
    $current_course = getCourseById(1);
    $modules = getCourseModules(1);
    $course_id = 1;
}

// Add modules to current course array for compatibility
$current_course['modules'] = $modules;

$current_lesson = null;
$current_module = null;

// Find current lesson and module
foreach ($modules as $module) {
    foreach ($module['lessons'] as $lesson) {
        if ($lesson['id'] == $lesson_id) {
            $current_lesson = $lesson;
            $current_module = $module;
            break 2;
        }
    }
}

// If no lesson found, use first lesson
if (!$current_lesson && !empty($modules) && !empty($modules[0]['lessons'])) {
    $current_lesson = $modules[0]['lessons'][0];
    $current_module = $modules[0];
}

// Calculate progress
$total_lessons = 0;
$completed_lessons = 0;
foreach ($current_course['modules'] as $module) {
    foreach ($module['lessons'] as $lesson) {
        $total_lessons++;
        if ($lesson['completed']) $completed_lessons++;
    }
}
$progress_percentage = $total_lessons > 0 ? round(($completed_lessons / $total_lessons) * 100) : 0;

renderHead($current_course['title'] . ' - Course Player', ['css/dashboard.css', 'css/course-view-light.css']);
renderNavbar();
?>

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('my-courses'); ?>

    <!-- Main Content -->
    <main class="dashboard-main" id="dashboardMain">
        <div class="player-layout">

            <!-- Left Column: Video & Tabs -->
            <div class="video-section" data-aos="fade-up" data-aos-duration="800">
                <!-- Video Player -->
                <div class="video-container" id="videoContainer">
                    <?php if ($current_lesson['type'] == 'video'): ?>
                        <!-- YouTube Embed -->
                        <div id="player"></div>
                    <?php elseif ($current_lesson['type'] == 'quiz'): ?>
                        <div class="content-placeholder">
                            <i class="bi bi-file-text-fill"></i>
                            <h3>Quiz Time!</h3>
                            <p>Test your knowledge with this quiz</p>
                            <a href="<?php echo url('pages/quiz.php?id=' . $current_lesson['quiz_id']); ?>" class="btn btn-gradient">Start Quiz</a>
                        </div>
                    <?php elseif ($current_lesson['type'] == 'assignment'): ?>
                        <div class="content-placeholder">
                            <i class="bi bi-file-earmark-code-fill"></i>
                            <h3>Assignment</h3>
                            <p>Complete and submit your assignment</p>
                            <a href="<?php echo url('pages/assignment.php?id=' . $current_lesson['assignment_id']); ?>" class="btn btn-gradient">View Assignment</a>
                        </div>
                    <?php elseif ($current_lesson['type'] == 'certificate'): ?>
                        <div class="content-placeholder">
                            <i class="bi bi-award-fill"></i>
                            <h3>Congratulations!</h3>
                            <p>You've completed the course. Download your certificate.</p>
                            <a href="<?php echo url('pages/certificate.php?course_id=' . $course_id); ?>" class="btn btn-gradient">Get Certificate</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Action Bar -->
                <div class="action-bar" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="lesson-info">
                        <h2 class="lesson-title"><?php echo $current_module['title']; ?>: <?php echo $current_lesson['title']; ?></h2>
                        <span class="lesson-duration"><i class="bi bi-clock"></i> <?php echo $current_lesson['duration']; ?></span>
                    </div>
                    <button class="btn-complete" id="markCompleteBtn" data-lesson-id="<?php echo $current_lesson['id']; ?>">
                        <?php if ($current_lesson['completed']): ?>
                            <i class="bi bi-check-circle-fill"></i> Completed
                        <?php else: ?>
                            <i class="bi bi-check-circle"></i> Mark as Complete
                        <?php endif; ?>
                    </button>
                </div>

                <!-- Content Tabs -->
                <div class="course-tabs" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="tabs-header">
                        <button class="tab-btn active" onclick="switchTab('overview')">
                            <i class="bi bi-info-circle"></i> Overview
                        </button>
                        <button class="tab-btn" onclick="switchTab('resources')">
                            <i class="bi bi-folder"></i> Resources
                        </button>
                        <button class="tab-btn" onclick="switchTab('qa')">
                            <i class="bi bi-chat-dots"></i> Q&A
                        </button>
                        <button class="tab-btn" onclick="switchTab('notes')">
                            <i class="bi bi-pencil-square"></i> Notes
                        </button>
                    </div>
                    <div class="tab-content">
                        <!-- Overview Tab -->
                        <div id="overview" class="tab-pane active">
                            <h3 class="tab-section-title">About this lesson</h3>
                            <p class="tab-description">In this lesson, you'll learn key concepts that are fundamental to understanding the course material. Make sure to take notes and complete the practice exercises.</p>

                            <h4 class="tab-subsection-title">Key Topics:</h4>
                            <ul class="topic-list">
                                <li>Core concepts and definitions</li>
                                <li>Practical applications</li>
                                <li>Real-world examples</li>
                                <li>Best practices and tips</li>
                            </ul>

                            <div class="instructor-card">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($current_course['instructor']); ?>&background=007bff&color=fff" class="instructor-avatar">
                                <div class="instructor-info">
                                    <h5 class="instructor-name"><?php echo $current_course['instructor']; ?></h5>
                                    <span class="instructor-role">Lead Instructor</span>
                                </div>
                            </div>
                        </div>

                        <!-- Resources Tab -->
                        <div id="resources" class="tab-pane">
                            <h3 class="tab-section-title">Downloadable Resources</h3>
                            <div class="resource-list">
                                <div class="resource-item">
                                    <i class="bi bi-file-pdf-fill text-danger"></i>
                                    <div class="resource-info">
                                        <h5>Lecture Slides</h5>
                                        <span>PDF • 2.4 MB</span>
                                    </div>
                                    <button class="btn-download"><i class="bi bi-download"></i></button>
                                </div>
                                <div class="resource-item">
                                    <i class="bi bi-file-code-fill text-primary"></i>
                                    <div class="resource-info">
                                        <h5>Code Examples</h5>
                                        <span>ZIP • 856 KB</span>
                                    </div>
                                    <button class="btn-download"><i class="bi bi-download"></i></button>
                                </div>
                                <div class="resource-item">
                                    <i class="bi bi-file-earmark-text-fill text-success"></i>
                                    <div class="resource-info">
                                        <h5>Reading Material</h5>
                                        <span>PDF • 1.8 MB</span>
                                    </div>
                                    <button class="btn-download"><i class="bi bi-download"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Q&A Tab -->
                        <div id="qa" class="tab-pane">
                            <div class="qa-header">
                                <h3 class="tab-section-title">Questions & Answers (8)</h3>
                                <button class="btn btn-gradient btn-sm">Ask a Question</button>
                            </div>

                            <!-- Question Item -->
                            <div class="qa-item">
                                <div class="qa-user">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" class="qa-avatar">
                                    <div class="qa-user-info">
                                        <h6>John Doe</h6>
                                        <span>2 hours ago</span>
                                    </div>
                                </div>
                                <p class="qa-question">Can you explain this concept in more detail? I'm having trouble understanding the practical applications.</p>
                                <div class="qa-actions">
                                    <button class="qa-action-btn"><i class="bi bi-reply"></i> Reply (3)</button>
                                    <button class="qa-action-btn"><i class="bi bi-hand-thumbs-up"></i> Helpful (12)</button>
                                </div>
                            </div>

                            <div class="qa-item">
                                <div class="qa-user">
                                    <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=random" class="qa-avatar">
                                    <div class="qa-user-info">
                                        <h6>Sarah Smith</h6>
                                        <span>1 day ago</span>
                                    </div>
                                </div>
                                <p class="qa-question">Great lesson! The examples really helped clarify the concepts.</p>
                                <div class="qa-actions">
                                    <button class="qa-action-btn"><i class="bi bi-reply"></i> Reply (1)</button>
                                    <button class="qa-action-btn"><i class="bi bi-hand-thumbs-up"></i> Helpful (25)</button>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Tab -->
                        <div id="notes" class="tab-pane">
                            <div class="notes-input-section">
                                <h3 class="tab-section-title">Take Notes</h3>
                                <textarea class="notes-textarea" rows="6" placeholder="Type your notes here..."></textarea>
                                <button class="btn btn-gradient">Save Note</button>
                            </div>

                            <div class="saved-notes-section">
                                <h4 class="tab-subsection-title">Your Saved Notes</h4>
                                <div class="note-card">
                                    <span class="note-timestamp">04:20</span>
                                    <p class="note-text">Important concept: Always validate your data before processing. This prevents errors downstream.</p>
                                    <button class="note-delete-btn"><i class="bi bi-trash"></i></button>
                                </div>
                                <div class="note-card">
                                    <span class="note-timestamp">08:15</span>
                                    <p class="note-text">Remember to implement error handling for edge cases as discussed in the video.</p>
                                    <button class="note-delete-btn"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Course Sidebar -->
            <aside class="course-sidebar" data-aos="fade-left" data-aos-duration="800" data-aos-delay="300">
                <div class="sidebar-header-course">
                    <div class="course-title-section">
                        <h3 class="course-sidebar-title"><?php echo $current_course['title']; ?></h3>
                        <span class="course-instructor-small"><?php echo $current_course['instructor']; ?></span>
                    </div>
                    <div class="course-progress-section">
                        <div class="progress-info">
                            <span class="progress-percentage"><?php echo $progress_percentage; ?>% Complete</span>
                            <span class="progress-items"><?php echo $completed_lessons; ?>/<?php echo $total_lessons; ?> Items</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill" style="width: <?php echo $progress_percentage; ?>%"></div>
                        </div>
                    </div>
                </div>

                <div class="module-list">
                    <?php foreach ($current_course['modules'] as $module): ?>
                    <div class="module-item">
                        <div class="module-header" onclick="toggleModule(this)">
                            <div class="module-title-section">
                                <i class="bi bi-chevron-down module-chevron"></i>
                                <span class="module-title"><?php echo $module['title']; ?></span>
                            </div>
                            <span class="module-count"><?php echo count($module['lessons']); ?> items</span>
                        </div>
                        <ul class="lesson-list">
                            <?php foreach ($module['lessons'] as $lesson): ?>
                            <li class="lesson-item <?php echo $lesson['completed'] ? 'completed' : ''; ?> <?php echo $lesson['id'] == $lesson_id ? 'active' : ''; ?>"
                                onclick="goToLesson(<?php echo $course_id; ?>, <?php echo $lesson['id']; ?>)">
                                <div class="lesson-item-content">
                                    <?php if ($lesson['completed']): ?>
                                        <i class="bi bi-check-circle-fill lesson-icon"></i>
                                    <?php elseif ($lesson['id'] == $lesson_id): ?>
                                        <i class="bi bi-play-circle-fill lesson-icon"></i>
                                    <?php else: ?>
                                        <?php if ($lesson['type'] == 'quiz'): ?>
                                            <i class="bi bi-file-text lesson-icon"></i>
                                        <?php elseif ($lesson['type'] == 'assignment'): ?>
                                            <i class="bi bi-file-earmark-code lesson-icon"></i>
                                        <?php elseif ($lesson['type'] == 'certificate'): ?>
                                            <i class="bi bi-award lesson-icon"></i>
                                        <?php else: ?>
                                            <i class="bi bi-play-circle lesson-icon"></i>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <span class="lesson-title-text"><?php echo $lesson['title']; ?></span>
                                </div>
                                <span class="lesson-duration-text"><?php echo $lesson['duration']; ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
            </aside>

        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<!-- YouTube IFrame API -->
<script src="https://www.youtube.com/iframe_api"></script>

<!-- AOS Animation Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 50
});


let player;
let currentVideoId = '<?php echo $current_lesson['type'] == 'video' ? $current_lesson['video_id'] : ''; ?>';

// Initialize YouTube Player
function onYouTubeIframeAPIReady() {
    if (currentVideoId) {
        player = new YT.Player('player', {
            height: '100%',
            width: '100%',
            videoId: currentVideoId,
            playerVars: {
                'playsinline': 1,
                'rel': 0,
                'modestbranding': 1
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }
}

function onPlayerReady(event) {
    console.log('Player ready');
}

function onPlayerStateChange(event) {
    // Auto-mark as complete when video ends
    if (event.data == YT.PlayerState.ENDED) {
        const markBtn = document.getElementById('markCompleteBtn');
        if (!markBtn.classList.contains('completed')) {
            markBtn.click();
        }
    }
}

// Tab Switching Logic
function switchTab(tabId) {
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    document.getElementById(tabId).classList.add('active');
    event.target.closest('.tab-btn').classList.add('active');
}

// Module Toggle
function toggleModule(header) {
    header.classList.toggle('active');
    const lessonList = header.nextElementSibling;
    if (lessonList.style.maxHeight) {
        lessonList.style.maxHeight = null;
    } else {
        lessonList.style.maxHeight = lessonList.scrollHeight + "px";
    }
}

// Navigate to lesson
function goToLesson(courseId, lessonId) {
    window.location.href = '<?php echo url('pages/course-view.php'); ?>?id=' + courseId + '&lesson=' + lessonId;
}

// Mark as Complete Logic
document.getElementById('markCompleteBtn').addEventListener('click', function() {
    this.classList.toggle('completed');
    if(this.classList.contains('completed')) {
        this.innerHTML = '<i class="bi bi-check-circle-fill"></i> Completed';

        // Update sidebar item
        const activeLesson = document.querySelector('.lesson-item.active');
        if (activeLesson) {
            activeLesson.classList.add('completed');
            const icon = activeLesson.querySelector('.lesson-icon');
            icon.className = 'bi bi-check-circle-fill lesson-icon';
        }

        // In production: Send AJAX request to save progress
        console.log('Lesson marked as complete');
    } else {
        this.innerHTML = '<i class="bi bi-check-circle"></i> Mark as Complete';
    }
});

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

    // Initialize all module states (expand first module by default)
    const firstModule = document.querySelector('.module-item .module-header');
    if (firstModule) {
        firstModule.click();
    }
});
</script>

