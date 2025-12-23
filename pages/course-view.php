<?php
require_once('../includes/session.php');
include('../config.php');
include('../includes/db_connect.php');
include('../includes/data-functions.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

// Get course ID and lesson ID from URL parameters
$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$lesson_id = isset($_GET['lesson']) ? (int)$_GET['lesson'] : null;

// Get course data from database
$current_course = null;
$courseStmt = $conn->prepare("SELECT c.*, u.full_name as instructor_name FROM courses c LEFT JOIN users u ON c.instructor_id = u.user_id WHERE c.course_id = ?");
$courseStmt->bind_param("i", $course_id);
$courseStmt->execute();
$courseResult = $courseStmt->get_result();
if ($row = $courseResult->fetch_assoc()) {
    $current_course = [
        'id' => $row['course_id'],
        'title' => $row['title'],
        'instructor' => $row['instructor_name'] ?? 'Unknown Instructor',
        'image' => $row['thumbnail'],
        'description' => $row['description']
    ];
}

// Get modules using the centralized function (now queries database)
$modules = getCourseModules($course_id);

// Fallback if course not found
if (!$current_course || empty($modules)) {
    // Show error page instead of falling back to course 1
    header('Location: ' . url('pages/courses.php') . '?error=course_not_found');
    exit;
}

// Add modules to current course array for compatibility
$current_course['modules'] = $modules;

$current_lesson = null;
$current_module = null;

// Find current lesson and module
if ($lesson_id) {
    foreach ($modules as $module) {
        foreach ($module['lessons'] as $lesson) {
            if ($lesson['id'] == $lesson_id) {
                $current_lesson = $lesson;
                $current_module = $module;
                break 2;
            }
        }
    }
}

// If no lesson found or no lesson_id provided, use first available lesson
if (!$current_lesson && !empty($modules)) {
    // Find first module with at least one lesson
    foreach ($modules as $mod) {
        if (!empty($mod['lessons'])) {
            $current_lesson = $mod['lessons'][0];
            $current_module = $mod;
            $lesson_id = $current_lesson['id'];
            break;
        }
    }
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

// Get resources for current lesson/course
$resources = [];
if ($current_lesson) {
    // First, get resources from video_resources table
    $resStmt = $conn->prepare("SELECT * FROM video_resources WHERE video_id = ? OR course_id = ? ORDER BY created_at DESC");
    $resStmt->bind_param("ii", $current_lesson['id'], $course_id);
    $resStmt->execute();
    $resResult = $resStmt->get_result();
    while ($res = $resResult->fetch_assoc()) {
        $resources[] = $res;
    }
    
    // Also parse resources from lesson description (for files/links stored in description)
    $lessonDescription = $current_lesson['description'] ?? '';
    
    // Parse <!-- FILES --> section (comma-separated file names)
    if (preg_match('/<!-- FILES -->\s*(.+?)(?=<!--|$)/s', $lessonDescription, $filesMatch)) {
        $fileNames = array_filter(array_map('trim', explode(',', $filesMatch[1])));
        foreach ($fileNames as $fileName) {
            if (!empty($fileName)) {
                // Determine file type from extension
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $resources[] = [
                    'name' => $fileName,
                    'file_path' => 'uploads/resources/' . $fileName,
                    'file_type' => $ext,
                    'file_size' => null,
                    'resource_type' => 'file'
                ];
            }
        }
    }
    
    // Parse <!-- RESOURCES --> section (external links, one per line)
    if (preg_match('/<!-- RESOURCES -->\s*(.+?)(?=<!--|$)/s', $lessonDescription, $linksMatch)) {
        $links = array_filter(array_map('trim', explode("\n", $linksMatch[1])));
        foreach ($links as $link) {
            if (!empty($link) && filter_var($link, FILTER_VALIDATE_URL)) {
                // Extract name from URL or use the URL itself
                $urlParts = parse_url($link);
                $linkName = basename($urlParts['path'] ?? '') ?: $urlParts['host'] ?? $link;
                $resources[] = [
                    'name' => $linkName,
                    'file_path' => $link,
                    'file_type' => 'link',
                    'file_size' => null,
                    'resource_type' => 'link'
                ];
            }
        }
    }
}

// Get Q&A questions for this course/video (video-specific only)
$qaQuestions = [];
$currentVideoId = $current_lesson ? $current_lesson['id'] : 0;
$qaStmt = $conn->prepare("
    SELECT q.*, u.full_name as user_name, 
           (SELECT COUNT(*) FROM question_replies WHERE question_id = q.question_id) as reply_count
    FROM course_questions q 
    LEFT JOIN users u ON q.user_id = u.user_id
    WHERE q.video_id = ?
    ORDER BY q.created_at DESC
    LIMIT 20
");
$qaStmt->bind_param("i", $currentVideoId);
$qaStmt->execute();
$qaResult = $qaStmt->get_result();
while ($q = $qaResult->fetch_assoc()) {
    $qaQuestions[] = $q;
}

// Fetch replies for each question
foreach ($qaQuestions as &$question) {
    $question['replies'] = [];
    if ($question['question_id']) {
        $repliesStmt = $conn->prepare("
            SELECT r.*, u.full_name as user_name 
            FROM question_replies r 
            LEFT JOIN users u ON r.user_id = u.user_id 
            WHERE r.question_id = ? 
            ORDER BY r.created_at ASC
        ");
        $repliesStmt->bind_param("i", $question['question_id']);
        $repliesStmt->execute();
        $repliesResult = $repliesStmt->get_result();
        while ($reply = $repliesResult->fetch_assoc()) {
            $question['replies'][] = $reply;
        }
    }
}
unset($question); // Break reference

// Get user notes (if logged in)
$userNotes = [];
$currentUserId = $_SESSION['user_id'] ?? 0;
if ($currentUserId > 0 && $current_lesson) {
    $notesStmt = $conn->prepare("SELECT * FROM user_notes WHERE user_id = ? AND video_id = ? ORDER BY video_timestamp ASC");
    $notesStmt->bind_param("ii", $currentUserId, $current_lesson['id']);
    $notesStmt->execute();
    $notesResult = $notesStmt->get_result();
    while ($note = $notesResult->fetch_assoc()) {
        $userNotes[] = $note;
    }
}

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
                    <?php 
                    // Parse quiz JSON from description (globally for this view)
                    $quizData = null;
                    $description = $current_lesson['description'] ?? '';
                    if (preg_match('/\{.*"type"\s*:\s*"quiz".*\}/s', $description, $matches)) {
                        $quizData = json_decode($matches[0], true);
                    }
                    $quizQuestions = ($quizData && isset($quizData['questions'])) ? $quizData['questions'] : [];
                    ?>

                    <?php
                    // Check if this is a video lesson (may or may not have attached quiz)
                    $isVideoLesson = ($current_lesson['type'] == 'video');
                    $hasQuizAttached = !empty($quizQuestions) && $isVideoLesson;
                    ?>

                    <?php if ($isVideoLesson): ?>
                        <!-- YouTube Embed - Video plays first -->
                        <div id="player"></div>

                        <!-- Pass quiz data to JavaScript if there's an attached quiz -->
                        <script>
                            const hasAttachedQuiz = <?php echo $hasQuizAttached ? 'true' : 'false'; ?>;
                            <?php if ($hasQuizAttached): ?>
                            const quizData = <?php echo json_encode($quizQuestions); ?>;
                            <?php else: ?>
                            const quizData = [];
                            <?php endif; ?>
                        </script>

                    <?php elseif ($current_lesson['type'] == 'quiz'): ?>
                        <div class="quiz-container" id="quizContainer">
                            <?php if (!empty($quizQuestions) && count($quizQuestions) > 0): ?>
                                <div class="quiz-header">
                                    <div class="quiz-header-top">
                                        <div class="quiz-icon"><i class="bi bi-patch-question-fill"></i></div>
                                        <div class="quiz-title-area">
                                            <h3>Quiz Time!</h3>
                                            <p class="quiz-subtitle">Test your knowledge</p>
                                        </div>
                                    </div>
                                    <div class="quiz-progress">
                                        <span id="questionCounter">Question 1 of <?php echo count($quizQuestions); ?></span>
                                        <div class="quiz-progress-bar">
                                            <div class="quiz-progress-fill" id="quizProgressFill" style="width: <?php echo 100 / count($quizQuestions); ?>%"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="quiz-questions" id="quizQuestions">
                                    <?php foreach ($quizQuestions as $qIndex => $q): 
                                        $questionText = isset($q['question']) ? $q['question'] : 'Question ' . ($qIndex + 1);
                                        $options = isset($q['options']) && is_array($q['options']) ? $q['options'] : [];
                                        $correctAnswer = isset($q['correct']) ? (int)$q['correct'] : 0;
                                    ?>
                                    <div class="quiz-question" data-question="<?php echo $qIndex; ?>" style="display: <?php echo $qIndex === 0 ? 'block' : 'none'; ?>;">
                                        <h4 class="question-text"><?php echo htmlspecialchars($questionText); ?></h4>
                                        <div class="options-list">
                                            <?php foreach ($options as $oIndex => $opt): ?>
                                            <label class="option-item">
                                                <input type="radio" name="question_<?php echo $qIndex; ?>" value="<?php echo $oIndex; ?>" data-correct="<?php echo $correctAnswer; ?>">
                                                <span class="option-letter"><?php echo chr(65 + $oIndex); ?></span>
                                                <span class="option-text"><?php echo htmlspecialchars(is_string($opt) ? $opt : ''); ?></span>
                                            </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <div class="quiz-navigation">
                                    <button class="btn btn-secondary" id="prevQuestionBtn" disabled><i class="bi bi-arrow-left"></i> Previous</button>
                                    <button class="btn btn-gradient" id="nextQuestionBtn">Next <i class="bi bi-arrow-right"></i></button>
                                    <button class="btn btn-gradient btn-submit" id="submitQuizBtn" style="display: none;"><i class="bi bi-check-circle"></i> Submit Quiz</button>
                                </div>
                                
                                <div class="quiz-results" id="quizResults" style="display: none;">
                                    <div class="results-content">
                                        <div class="results-icon" id="resultsIcon"><i class="bi bi-trophy-fill"></i></div>
                                        <div class="score-display">
                                            <h3 id="resultsTitle">Quiz Completed!</h3>
                                            <div style="display:flex; align-items:baseline; justify-content:center; gap:0.5rem;">
                                                <span id="scoreText">0/0</span>
                                                <span class="score-percentage" id="scorePercentage">0%</span>
                                            </div>
                                            <p id="resultsMessage" style="color: #64748b; margin-top: 1rem;"></p>
                                        </div>
                                        <div class="countdown-container" id="countdownContainer" style="display: none;">
                                            <p class="countdown-text">Continuing to next lesson in...</p>
                                            <span class="countdown-number" id="countdownNumber">3</span>
                                            <div class="countdown-progress">
                                                <div class="countdown-progress-fill" id="countdownFill" style="width: 100%"></div>
                                            </div>
                                        </div>
                                        <div class="results-actions">
                                            <button class="btn btn-gradient" onclick="restartQuiz()"><i class="bi bi-arrow-repeat"></i> Retake Quiz</button>
                                            <button class="btn btn-secondary" id="continueBtn" style="display: none;" onclick="goToNextLesson()"><i class="bi bi-arrow-right"></i> Continue Now</button>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                const inlineQuizData = <?php echo json_encode($quizQuestions); ?>;
                                </script>
                            <?php else: ?>
                                <div class="content-placeholder">
                                    <i class="bi bi-file-text-fill"></i>
                                    <h3>Quiz Time!</h3>
                                    <p>This quiz is being prepared. Please check back later.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php elseif ($current_lesson['type'] == 'article'): ?>
                        <div class="article-content-container">
                            <div class="article-content">
                                <?php 
                                $articleContent = str_replace('<!-- ARTICLE -->', '', $current_lesson['description'] ?? '');
                                echo nl2br(htmlspecialchars($articleContent));
                                ?>
                            </div>
                        </div>
                    <?php elseif ($current_lesson['type'] == 'assignment'): ?>
                        <div class="content-placeholder">
                            <i class="bi bi-file-earmark-code-fill"></i>
                            <h3>Assignment</h3>
                            <p>Complete and submit your assignment</p>
                            <a href="<?php echo url('pages/assignment.php?id=' . $current_lesson['assignment_id']); ?>" class="btn btn-gradient">View Assignment</a>
                        </div>
                    <?php elseif ($current_lesson['type'] == 'certificate'): 
                        // Redirect to the full certificate page with all features
                        $certificateUrl = url('pages/certificate.php?course_id=' . $course_id);
                    ?>
                        <script>
                            // Auto-redirect to the certificate page
                            window.location.href = '<?php echo $certificateUrl; ?>';
                        </script>
                        <div class="content-placeholder" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 400px; display: flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 1rem;">
                            <div style="animation: pulse 2s infinite; text-align: center;">
                                <i class="bi bi-award-fill" style="font-size: 5rem; color: #fbbf24;"></i>
                                <h2 style="color: white; margin-top: 1.5rem; font-size: 1.75rem;">🎉 Congratulations!</h2>
                                <p style="color: rgba(255,255,255,0.9); margin-top: 0.5rem; font-size: 1.1rem;">Loading your certificate...</p>
                            </div>
                        </div>
                        <style>
                            @keyframes pulse {
                                0%, 100% { transform: scale(1); }
                                50% { transform: scale(1.05); }
                            }
                        </style>
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
                            <?php 
                            $lessonDesc = $current_lesson['description'] ?? '';
                            
                            // Remove quiz JSON from description
                            $cleanDesc = preg_replace('/\{.*"type"\s*:\s*"quiz".*\}/s', '', $lessonDesc);
                            // Remove all markers and their content sections
                            $cleanDesc = preg_replace('/<!-- FILES -->.*?(?=<!--|$)/s', '', $cleanDesc);
                            $cleanDesc = preg_replace('/<!-- RESOURCES -->.*?(?=<!--|$)/s', '', $cleanDesc);
                            $cleanDesc = preg_replace('/<!-- NOTES -->.*?(?=<!--|$)/s', '', $cleanDesc);
                            $cleanDesc = str_replace(['<!-- ARTICLE -->'], '', $cleanDesc);
                            $cleanDesc = trim($cleanDesc);
                            
                            if (!empty($cleanDesc)) {
                                echo '<p class="tab-description">' . nl2br(htmlspecialchars($cleanDesc)) . '</p>';
                            } elseif ($current_lesson['type'] == 'quiz') {
                                echo '<p class="tab-description">Complete the quiz above to test your understanding of the material covered in this section.</p>';
                            } else {
                                echo '<p class="tab-description">This lesson covers important concepts in the course. Watch the video and take notes to maximize your learning.</p>';
                            }
                            ?>

                            <div class="instructor-card">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($current_course['instructor']); ?>&background=007bff&color=fff" class="instructor-avatar">
                                <div class="instructor-info">
                                    <h5 class="instructor-name"><?php echo htmlspecialchars($current_course['instructor']); ?></h5>
                                    <span class="instructor-role">Lead Instructor</span>
                                </div>
                            </div>
                        </div>

                        <!-- Resources Tab -->
                        <div id="resources" class="tab-pane">
                            <h3 class="tab-section-title">Downloadable Resources</h3>
                            <div class="resource-list">
                                <?php if (!empty($resources)): ?>
                                    <?php foreach ($resources as $res): 
                                        // Determine file icon based on type
                                        $fileType = strtolower($res['file_type'] ?? 'file');
                                        $iconClass = 'bi-file-earmark';
                                        $iconColor = 'text-secondary';
                                        $isLink = ($fileType === 'link' || isset($res['resource_type']) && $res['resource_type'] === 'link');
                                        
                                        if ($isLink) {
                                            $iconClass = 'bi-link-45deg';
                                            $iconColor = 'text-info';
                                        } elseif (strpos($fileType, 'pdf') !== false) {
                                            $iconClass = 'bi-file-pdf-fill';
                                            $iconColor = 'text-danger';
                                        } elseif (strpos($fileType, 'doc') !== false || strpos($fileType, 'word') !== false) {
                                            $iconClass = 'bi-file-word-fill';
                                            $iconColor = 'text-primary';
                                        } elseif (strpos($fileType, 'zip') !== false || strpos($fileType, 'rar') !== false) {
                                            $iconClass = 'bi-file-zip-fill';
                                            $iconColor = 'text-warning';
                                        } elseif (strpos($fileType, 'xls') !== false) {
                                            $iconClass = 'bi-file-excel-fill';
                                            $iconColor = 'text-success';
                                        } elseif (strpos($fileType, 'ppt') !== false) {
                                            $iconClass = 'bi-file-ppt-fill';
                                            $iconColor = 'text-orange';
                                        }
                                        $fileSize = $res['file_size'] ? round($res['file_size'] / 1024, 1) . ' KB' : ($isLink ? 'External Link' : 'File');
                                    ?>
                                    <div class="resource-item">
                                        <i class="bi <?php echo $iconClass; ?> <?php echo $iconColor; ?>"></i>
                                        <div class="resource-info">
                                            <h5><?php echo htmlspecialchars($res['name']); ?></h5>
                                            <span><?php echo strtoupper($fileType); ?> • <?php echo $fileSize; ?></span>
                                        </div>
                                        <?php if ($isLink): ?>
                                        <a href="<?php echo htmlspecialchars($res['file_path']); ?>" class="btn-download" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right"></i></a>
                                        <?php else: ?>
                                        <a href="<?php echo url($res['file_path']); ?>" class="btn-download" download><i class="bi bi-download"></i></a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="empty-state-small">
                                        <i class="bi bi-folder" style="font-size: 2rem; color: #94a3b8;"></i>
                                        <p style="color: #64748b; margin-top: 0.5rem;">No resources uploaded for this lesson yet.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Q&A Tab -->
                        <div id="qa" class="tab-pane">
                            <div class="qa-header">
                                <h3 class="tab-section-title">Questions & Answers (<?php echo count($qaQuestions); ?>)</h3>
                                <button class="btn btn-gradient btn-sm" id="askQuestionBtn">Ask a Question</button>
                            </div>
                            
                            <!-- Ask Question Form (hidden by default) -->
                            <div id="askQuestionForm" style="display: none; margin-bottom: 1.5rem;">
                                <textarea class="notes-textarea" id="questionText" rows="3" placeholder="Type your question here..."></textarea>
                                <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem;">
                                    <button class="btn btn-gradient" id="submitQuestion">Submit Question</button>
                                    <button class="btn btn-secondary" id="cancelQuestion">Cancel</button>
                                </div>
                            </div>

                            <?php if (!empty($qaQuestions)): ?>
                                <?php foreach ($qaQuestions as $q): 
                                    $createdAt = $q['created_at'] ?? 'now';
                                    $timeAgo = time() - strtotime($createdAt);
                                    
                                    // Handle negative or very small time differences
                                    if ($timeAgo < 60) {
                                        $timeDisplay = 'Just now';
                                    } elseif ($timeAgo < 3600) {
                                        $timeDisplay = round($timeAgo / 60) . ' minutes ago';
                                    } elseif ($timeAgo < 86400) {
                                        $timeDisplay = round($timeAgo / 3600) . ' hours ago';
                                    } else {
                                        $timeDisplay = round($timeAgo / 86400) . ' days ago';
                                    }
                                ?>
                                <div class="qa-item" data-question-id="<?php echo $q['question_id'] ?? 0; ?>">
                                    <div class="qa-user">
                                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($q['user_name'] ?? 'User'); ?>&background=random" class="qa-avatar">
                                        <div class="qa-user-info">
                                            <h6><?php echo htmlspecialchars($q['user_name'] ?? 'Anonymous'); ?></h6>
                                            <span><?php echo $timeDisplay; ?></span>
                                        </div>
                                    </div>
                                    <p class="qa-question"><?php echo htmlspecialchars($q['question_text'] ?? ''); ?></p>
                                    <div class="qa-actions">
                                        <button class="qa-action-btn"><i class="bi bi-reply"></i> Reply (<?php echo $q['reply_count'] ?? 0; ?>)</button>
                                        <button class="qa-action-btn"><i class="bi bi-hand-thumbs-up"></i> Helpful (<?php echo $q['helpful_count'] ?? 0; ?>)</button>
                                    </div>
                                    
                                    <?php if (!empty($q['replies'])): ?>
                                    <div class="qa-replies" style="margin-top: 1rem; padding-left: 1rem; border-left: 2px solid #e2e8f0;">
                                        <?php foreach ($q['replies'] as $reply): 
                                            $replyTime = time() - strtotime($reply['created_at'] ?? 'now');
                                            if ($replyTime < 60) {
                                                $replyTimeDisplay = 'Just now';
                                            } elseif ($replyTime < 3600) {
                                                $replyTimeDisplay = round($replyTime / 60) . ' min ago';
                                            } elseif ($replyTime < 86400) {
                                                $replyTimeDisplay = round($replyTime / 3600) . ' hours ago';
                                            } else {
                                                $replyTimeDisplay = round($replyTime / 86400) . ' days ago';
                                            }
                                        ?>
                                        <div class="qa-reply" style="padding: 0.75rem; margin-bottom: 0.5rem; background: #f8fafc; border-radius: 0.5rem;">
                                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($reply['user_name'] ?? 'User'); ?>&background=4f46e5&color=fff&size=24" style="width: 24px; height: 24px; border-radius: 50%;">
                                                <strong style="color: #1e293b; font-size: 0.9rem;"><?php echo htmlspecialchars($reply['user_name'] ?? 'Anonymous'); ?></strong>
                                                <?php if ($reply['is_instructor_reply']): ?>
                                                <span style="background: #4f46e5; color: white; padding: 0.1rem 0.5rem; border-radius: 0.25rem; font-size: 0.7rem;">Instructor</span>
                                                <?php endif; ?>
                                                <span class="reply-time" style="font-size: 0.75rem; color: #94a3b8; margin-left: auto;"><?php echo $replyTimeDisplay; ?></span>
                                            </div>
                                            <p style="margin: 0; color: #334155; font-size: 0.9rem;"><?php echo htmlspecialchars($reply['reply_text'] ?? ''); ?></p>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-state-small" style="text-align: center; padding: 2rem;">
                                    <i class="bi bi-chat-dots" style="font-size: 2.5rem; color: #94a3b8;"></i>
                                    <p style="color: #64748b; margin-top: 0.5rem;">No questions yet. Be the first to ask!</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Notes Tab -->
                        <div id="notes" class="tab-pane">
                            <div class="notes-input-section">
                                <h3 class="tab-section-title">Take Notes</h3>
                                <textarea class="notes-textarea" id="noteText" rows="4" placeholder="Type your notes here..."></textarea>
                                <button class="btn btn-gradient" id="saveNoteBtn">Save Note</button>
                            </div>

                            <div class="saved-notes-section">
                                <h4 class="tab-subsection-title">Your Saved Notes</h4>
                                <?php if (!empty($userNotes)): ?>
                                    <?php foreach ($userNotes as $note): 
                                        $mins = floor($note['video_timestamp'] / 60);
                                        $secs = $note['video_timestamp'] % 60;
                                        $timestamp = sprintf("%02d:%02d", $mins, $secs);
                                    ?>
                                    <div class="note-card" data-note-id="<?php echo $note['note_id']; ?>">
                                        <span class="note-timestamp"><?php echo $timestamp; ?></span>
                                        <p class="note-text"><?php echo htmlspecialchars($note['note_text']); ?></p>
                                        <button class="note-delete-btn" onclick="deleteNote(<?php echo $note['note_id']; ?>)"><i class="bi bi-trash"></i></button>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="empty-state-small" id="noNotesMessage" style="text-align: center; padding: 1rem;">
                                        <i class="bi bi-journal-text" style="font-size: 2rem; color: #94a3b8;"></i>
                                        <p style="color: #64748b; margin-top: 0.5rem;">No notes yet. Start taking notes!</p>
                                    </div>
                                <?php endif; ?>
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

<?php
// Quiz modal - ONLY for video lessons with attached quizzes
// We reuse $quizQuestions and $hasQuizAttached from above
$quizQuestionsForModal = $hasQuizAttached ? $quizQuestions : [];
?>

<?php if ($hasQuizAttached && !empty($quizQuestionsForModal)): ?>
<!-- Full-Screen Quiz Modal (Body Level) -->
<div id="quizModal" class="quiz-modal-overlay">
    <div class="quiz-modal-content">
        <button class="close-modal-btn" onclick="closeQuizModal()"><i class="bi bi-x-lg"></i></button>
        
        <div class="quiz-container" id="quizContainer">
            <div class="quiz-header">
                <div class="quiz-header-top">
                    <div class="quiz-icon"><i class="bi bi-patch-question-fill"></i></div>
                    <div class="quiz-title-area">
                        <h3>Pop Quiz!</h3>
                        <p class="quiz-subtitle">Test your knowledge</p>
                    </div>
                </div>
                <div class="quiz-progress">
                    <span id="questionCounter">Question 1 of <?php echo count($quizQuestionsForModal); ?></span>
                    <div class="quiz-progress-bar">
                        <div class="quiz-progress-fill" id="quizProgressFill" style="width: <?php echo 100 / max(1, count($quizQuestionsForModal)); ?>%"></div>
                    </div>
                </div>
            </div>
            
            <div class="quiz-questions" id="quizQuestions">
                <?php foreach ($quizQuestionsForModal as $qIndex => $q): 
                    $questionText = isset($q['question']) ? $q['question'] : 'Question ' . ($qIndex + 1);
                    $options = isset($q['options']) && is_array($q['options']) ? $q['options'] : [];
                    $correctAnswer = isset($q['correct']) ? (int)$q['correct'] : 0;
                ?>
                <div class="quiz-question" data-question="<?php echo $qIndex; ?>" style="display: <?php echo $qIndex === 0 ? 'block' : 'none'; ?>;">
                    <h4 class="question-text"><?php echo htmlspecialchars($questionText); ?></h4>
                    <div class="options-list">
                        <?php foreach ($options as $oIndex => $opt): ?>
                        <label class="option-item">
                            <input type="radio" name="question_<?php echo $qIndex; ?>" value="<?php echo $oIndex; ?>" data-correct="<?php echo $correctAnswer; ?>">
                            <span class="option-letter"><?php echo chr(65 + $oIndex); ?></span>
                            <span class="option-text"><?php echo htmlspecialchars(is_string($opt) ? $opt : ''); ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="quiz-navigation">
                <button class="btn btn-secondary" id="prevQuestionBtn" disabled><i class="bi bi-arrow-left"></i> Previous</button>
                <button class="btn btn-gradient" id="nextQuestionBtn">Next <i class="bi bi-arrow-right"></i></button>
                <button class="btn btn-gradient btn-submit" id="submitQuizBtn" style="display: none;"><i class="bi bi-check-circle"></i> Submit Quiz</button>
            </div>
            
            <div class="quiz-results" id="quizResults" style="display: none;">
                <div class="results-content">
                    <div class="results-icon" id="resultsIcon"><i class="bi bi-trophy-fill"></i></div>
                    <div class="score-display">
                        <h3 id="resultsTitle">Quiz Completed!</h3>
                        <div style="display:flex; align-items:baseline; justify-content:center; gap:0.5rem;">
                            <span id="scoreText">0/0</span>
                            <span class="score-percentage" id="scorePercentage">0%</span>
                        </div>
                        <p id="resultsMessage" style="color: #64748b; margin-top: 1rem;"></p>
                    </div>
                    <div class="countdown-container" id="countdownContainer" style="display: none;">
                        <p class="countdown-text">Continuing to next lesson in...</p>
                        <span class="countdown-number" id="countdownNumber">3</span>
                        <div class="countdown-progress">
                            <div class="countdown-progress-fill" id="countdownFill" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="results-actions">
                        <button class="btn btn-gradient" onclick="restartQuiz()"><i class="bi bi-arrow-repeat"></i> Retake Quiz</button>
                        <button class="btn btn-outline-primary" id="watchAgainBtn" style="display: none;" onclick="watchVideoAgain()"><i class="bi bi-play-circle"></i> Watch Again</button>
                        <button class="btn btn-secondary" id="continueBtn" style="display: none;" onclick="goToNextLesson()"><i class="bi bi-arrow-right"></i> Continue Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

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
let currentVideoId = '<?php echo (!empty($current_lesson['video_id']) && $current_lesson['type'] != 'quiz') ? $current_lesson['video_id'] : ''; ?>';

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
    if (event.data == YT.PlayerState.ENDED) {
        // Check if there's an attached quiz - if so, show quiz modal instead of marking complete
        if (typeof hasAttachedQuiz !== 'undefined' && hasAttachedQuiz) {
            const quizModal = document.getElementById('quizModal');
            if (quizModal) {
                // Show quiz modal with a slight delay for better UX
                setTimeout(() => {
                    quizModal.style.display = 'flex';
                    // Reset quiz state when opening modal
                    resetQuizModal();
                }, 500);
                return; // Stop auto-navigation - quiz must be completed first
            }
        }

        // No quiz attached - mark video as complete and move to next
        const markBtn = document.getElementById('markCompleteBtn');
        if (markBtn && !markBtn.classList.contains('completed')) {
            markBtn.click();
        }

        // Default behavior: Go to next lesson
        setTimeout(() => {
            goToNextLesson();
        }, 2000);
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

// Get the next lesson element from sidebar
function getNextLesson() {
    const activeLesson = document.querySelector('.lesson-item.active');
    if (!activeLesson) return null;
    
    // Try to get next sibling in same module
    let nextLesson = activeLesson.nextElementSibling;
    if (nextLesson && nextLesson.classList.contains('lesson-item')) {
        return nextLesson;
    }
    
    // If no next sibling, try next module's first lesson
    const currentModule = activeLesson.closest('.module-item');
    if (currentModule) {
        let nextModule = currentModule.nextElementSibling;
        while (nextModule) {
            const firstLesson = nextModule.querySelector('.lesson-item');
            if (firstLesson) return firstLesson;
            nextModule = nextModule.nextElementSibling;
        }
    }
    
    return null;
}

// Navigate to next lesson (for autoplay)
function goToNextLesson() {
    const nextLesson = getNextLesson();
    if (nextLesson) {
        nextLesson.click();
    }
}

// Mark as Complete Logic
const progressApiUrl = '<?php echo url('api/progress.php'); ?>';
const courseIdForProgress = <?php echo $course_id; ?>;

document.getElementById('markCompleteBtn').addEventListener('click', async function() {
    if (this.classList.contains('completed')) return; // Already completed
    
    const lessonId = this.dataset.lessonId;
    
    try {
        const response = await fetch(progressApiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                lesson_id: lessonId,
                course_id: courseIdForProgress
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update button
            this.classList.add('completed');
            this.innerHTML = '<i class="bi bi-check-circle-fill"></i> Completed';
            
            // Update sidebar item
            const activeLesson = document.querySelector('.lesson-item.active');
            if (activeLesson) {
                activeLesson.classList.add('completed');
                const icon = activeLesson.querySelector('.lesson-icon');
                if (icon) icon.className = 'bi bi-check-circle-fill lesson-icon';
            }
            
            // Update progress bar
            updateProgressBar(data.progress);
            
            console.log('Lesson marked as complete:', data);
        } else {
            console.error('Failed to mark complete:', data.message);
        }
    } catch (error) {
        console.error('Error marking complete:', error);
    }
});

// Update progress bar UI
function updateProgressBar(progress) {
    const percentageEl = document.querySelector('.progress-percentage');
    const itemsEl = document.querySelector('.progress-items');
    const fillEl = document.querySelector('.progress-bar-fill');
    
    if (percentageEl) percentageEl.textContent = progress.percentage + '% Complete';
    if (itemsEl) itemsEl.textContent = progress.completed + '/' + progress.total + ' Items';
    if (fillEl) fillEl.style.width = progress.percentage + '%';
}

// Get next lesson in the course
function getNextLesson() {
    const allLessons = Array.from(document.querySelectorAll('.lesson-item'));
    const currentIndex = allLessons.findIndex(l => l.classList.contains('active'));
    
    if (currentIndex >= 0 && currentIndex < allLessons.length - 1) {
        return allLessons[currentIndex + 1];
    }
    return null;
}

// Navigate to next lesson (autoplay)
function goToNextLesson() {
    const nextLesson = getNextLesson();
    if (nextLesson) {
        nextLesson.click();
    }
}

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

// ================== INLINE QUIZ FUNCTIONALITY (for standalone quiz lessons) ==================
let currentQuestion = 0;
// Use inlineQuizData for standalone quiz lessons (quizData is for video+quiz modal)
const inlineQuizDataRef = typeof inlineQuizData !== 'undefined' ? inlineQuizData : [];
const totalQuestions = inlineQuizDataRef.length;

if (totalQuestions > 0) {
    // Only attach handlers if we're on a standalone quiz lesson (not video with modal quiz)
    const quizContainer = document.querySelector('#videoContainer > .quiz-container');
    if (quizContainer) {
        const prevBtn = quizContainer.querySelector('#prevQuestionBtn');
        const nextBtn = quizContainer.querySelector('#nextQuestionBtn');
        const submitBtn = quizContainer.querySelector('#submitQuizBtn');
        const questionCounter = quizContainer.querySelector('#questionCounter');
        const progressFill = quizContainer.querySelector('#quizProgressFill');

        function updateQuizUI() {
            // Hide all questions
            quizContainer.querySelectorAll('.quiz-question').forEach(q => q.style.display = 'none');
            // Show current question
            const currentQ = quizContainer.querySelector(`.quiz-question[data-question="${currentQuestion}"]`);
            if (currentQ) currentQ.style.display = 'block';

            // Update counter and progress
            if (questionCounter) questionCounter.textContent = `Question ${currentQuestion + 1} of ${totalQuestions}`;
            if (progressFill) progressFill.style.width = `${((currentQuestion + 1) / totalQuestions) * 100}%`;

            // Update button states
            if (prevBtn) prevBtn.disabled = currentQuestion === 0;

            if (currentQuestion === totalQuestions - 1) {
                if (nextBtn) nextBtn.style.display = 'none';
                if (submitBtn) submitBtn.style.display = 'inline-flex';
            } else {
                if (nextBtn) nextBtn.style.display = 'inline-flex';
                if (submitBtn) submitBtn.style.display = 'none';
            }
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (currentQuestion > 0) {
                    currentQuestion--;
                    updateQuizUI();
                }
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                if (currentQuestion < totalQuestions - 1) {
                    currentQuestion++;
                    updateQuizUI();
                }
            });
        }

        if (submitBtn) {
            submitBtn.addEventListener('click', () => {
                let correct = 0;

                // Check each answer
                for (let i = 0; i < totalQuestions; i++) {
                    const selected = quizContainer.querySelector(`input[name="question_${i}"]:checked`);
                    const correctAnswer = inlineQuizDataRef[i].correct ?? inlineQuizDataRef[i].correctIndex ?? 0;

                    if (selected && parseInt(selected.value) === correctAnswer) {
                        correct++;
                    }
                }

                const percentage = Math.round((correct / totalQuestions) * 100);
                const passed = percentage >= 70;

                // Hide questions and navigation within the quiz container
                const quizQuestionsEl = quizContainer.querySelector('#quizQuestions');
                const quizNavEl = quizContainer.querySelector('.quiz-navigation');
                const quizHeaderEl = quizContainer.querySelector('.quiz-header');

                if (quizQuestionsEl) quizQuestionsEl.style.display = 'none';
                if (quizNavEl) quizNavEl.style.display = 'none';
                if (quizHeaderEl) quizHeaderEl.style.display = 'none';

                // Update score display
                const scoreText = quizContainer.querySelector('#scoreText');
                const scorePercentage = quizContainer.querySelector('#scorePercentage');
                if (scoreText) scoreText.textContent = `${correct}/${totalQuestions}`;
                if (scorePercentage) scorePercentage.textContent = `${percentage}%`;

                // Update results title and message based on pass/fail
                const resultsTitle = quizContainer.querySelector('#resultsTitle');
                const resultsMessage = quizContainer.querySelector('#resultsMessage');
                const resultsIcon = quizContainer.querySelector('#resultsIcon');

                if (passed) {
                    if (resultsTitle) resultsTitle.textContent = 'Great Job!';
                    if (resultsMessage) resultsMessage.textContent = 'You passed! Lesson marked as complete.';
                    if (resultsIcon) resultsIcon.innerHTML = '<i class="bi bi-trophy-fill" style="color: #fbbf24;"></i>';
                } else {
                    if (resultsTitle) resultsTitle.textContent = 'Keep Learning!';
                    if (resultsMessage) resultsMessage.textContent = 'You need 70% to pass. Try again!';
                    if (resultsIcon) resultsIcon.innerHTML = '<i class="bi bi-emoji-smile" style="color: #94a3b8;"></i>';
                }

                // Show results
                const resultsDiv = quizContainer.querySelector('#quizResults');
                if (resultsDiv) resultsDiv.style.display = 'block';

                // Mark lesson as complete if passed
                if (passed) {
                    const markBtn = document.getElementById('markCompleteBtn');
                    if (markBtn && !markBtn.classList.contains('completed')) {
                        markBtn.click();
                    }

                    // Show countdown container and "Continue Now" button
                    const countdownContainer = quizContainer.querySelector('#countdownContainer');
                    const continueBtn = quizContainer.querySelector('#continueBtn');
                    if (countdownContainer) countdownContainer.style.display = 'block';
                    if (continueBtn) continueBtn.style.display = 'inline-flex';

                    // Start countdown
                    let secondsLeft = 3;
                    const countdownNumber = quizContainer.querySelector('#countdownNumber');
                    const countdownFill = quizContainer.querySelector('#countdownFill');

                    if (countdownNumber) countdownNumber.textContent = secondsLeft;
                    if (countdownFill) countdownFill.style.width = '100%';

                    const countdownInterval = setInterval(() => {
                        secondsLeft--;
                        if (countdownNumber) countdownNumber.textContent = secondsLeft;
                        if (countdownFill) countdownFill.style.width = `${(secondsLeft / 3) * 100}%`;

                        if (secondsLeft <= 0) {
                            clearInterval(countdownInterval);
                            goToNextLesson();
                        }
                    }, 1000);

                    window.quizCountdownInterval = countdownInterval;
                }
            });
        }

        // Initialize quiz UI on page load
        updateQuizUI();
    }
}

// ================== MODAL QUIZ FUNCTIONALITY ==================
// Separate handlers for the quiz modal (popup after video ends)
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('quizModal');
    if (!modal) return;

    let modalCurrentQuestion = 0;
    const modalTotalQuestions = typeof quizData !== 'undefined' ? quizData.length : 0;

    if (modalTotalQuestions === 0) return;

    const modalPrevBtn = modal.querySelector('#prevQuestionBtn');
    const modalNextBtn = modal.querySelector('#nextQuestionBtn');
    const modalSubmitBtn = modal.querySelector('#submitQuizBtn');
    const modalQuestionCounter = modal.querySelector('#questionCounter');
    const modalProgressFill = modal.querySelector('#quizProgressFill');

    function updateModalQuizUI() {
        // Hide all questions in modal
        modal.querySelectorAll('.quiz-question').forEach(q => q.style.display = 'none');
        // Show current question
        const currentQ = modal.querySelector(`.quiz-question[data-question="${modalCurrentQuestion}"]`);
        if (currentQ) currentQ.style.display = 'block';

        // Update counter and progress
        if (modalQuestionCounter) modalQuestionCounter.textContent = `Question ${modalCurrentQuestion + 1} of ${modalTotalQuestions}`;
        if (modalProgressFill) modalProgressFill.style.width = `${((modalCurrentQuestion + 1) / modalTotalQuestions) * 100}%`;

        // Update button states
        if (modalPrevBtn) modalPrevBtn.disabled = modalCurrentQuestion === 0;

        if (modalCurrentQuestion === modalTotalQuestions - 1) {
            if (modalNextBtn) modalNextBtn.style.display = 'none';
            if (modalSubmitBtn) modalSubmitBtn.style.display = 'inline-flex';
        } else {
            if (modalNextBtn) modalNextBtn.style.display = 'inline-flex';
            if (modalSubmitBtn) modalSubmitBtn.style.display = 'none';
        }
    }

    if (modalPrevBtn) {
        modalPrevBtn.addEventListener('click', () => {
            if (modalCurrentQuestion > 0) {
                modalCurrentQuestion--;
                updateModalQuizUI();
            }
        });
    }

    if (modalNextBtn) {
        modalNextBtn.addEventListener('click', () => {
            if (modalCurrentQuestion < modalTotalQuestions - 1) {
                modalCurrentQuestion++;
                updateModalQuizUI();
            }
        });
    }

    if (modalSubmitBtn) {
        modalSubmitBtn.addEventListener('click', () => {
            let correct = 0;

            // Check each answer in the modal
            for (let i = 0; i < modalTotalQuestions; i++) {
                const selected = modal.querySelector(`input[name="question_${i}"]:checked`);
                const correctAnswer = quizData[i].correct ?? quizData[i].correctIndex ?? 0;

                if (selected && parseInt(selected.value) === correctAnswer) {
                    correct++;
                }
            }

            const percentage = Math.round((correct / modalTotalQuestions) * 100);
            const passed = percentage >= 70;

            // Hide questions and navigation in modal
            const modalQuestions = modal.querySelector('#quizQuestions');
            const modalNav = modal.querySelector('.quiz-navigation');
            const modalHeader = modal.querySelector('.quiz-header');

            if (modalQuestions) modalQuestions.style.display = 'none';
            if (modalNav) modalNav.style.display = 'none';
            if (modalHeader) modalHeader.style.display = 'none';

            // Update score display in modal
            const modalScoreText = modal.querySelector('#scoreText');
            const modalScorePercentage = modal.querySelector('#scorePercentage');
            if (modalScoreText) modalScoreText.textContent = `${correct}/${modalTotalQuestions}`;
            if (modalScorePercentage) modalScorePercentage.textContent = `${percentage}%`;

            // Update results title and message
            const modalResultsTitle = modal.querySelector('#resultsTitle');
            const modalResultsMessage = modal.querySelector('#resultsMessage');
            const modalResultsIcon = modal.querySelector('#resultsIcon');

            // Get button references
            const modalWatchAgainBtn = modal.querySelector('#watchAgainBtn');

            if (passed) {
                if (modalResultsTitle) modalResultsTitle.textContent = 'Great Job!';
                if (modalResultsMessage) modalResultsMessage.textContent = 'You passed! Moving to the next lesson...';
                if (modalResultsIcon) modalResultsIcon.innerHTML = '<i class="bi bi-trophy-fill" style="color: #fbbf24;"></i>';
                // Hide watch again button on pass
                if (modalWatchAgainBtn) modalWatchAgainBtn.style.display = 'none';
            } else {
                if (modalResultsTitle) modalResultsTitle.textContent = 'Keep Learning!';
                if (modalResultsMessage) modalResultsMessage.textContent = 'You need 70% to pass. Watch the video again and retry!';
                if (modalResultsIcon) modalResultsIcon.innerHTML = '<i class="bi bi-emoji-smile" style="color: #94a3b8;"></i>';
                // Show watch again button on fail
                if (modalWatchAgainBtn) modalWatchAgainBtn.style.display = 'inline-flex';
            }

            // Show results in modal
            const modalResultsDiv = modal.querySelector('#quizResults');
            if (modalResultsDiv) modalResultsDiv.style.display = 'block';

            if (passed) {
                // Mark lesson as complete
                const markBtn = document.getElementById('markCompleteBtn');
                if (markBtn && !markBtn.classList.contains('completed')) {
                    markBtn.click();
                }

                // Show countdown and continue button
                const modalCountdownContainer = modal.querySelector('#countdownContainer');
                const modalContinueBtn = modal.querySelector('#continueBtn');
                if (modalCountdownContainer) modalCountdownContainer.style.display = 'block';
                if (modalContinueBtn) modalContinueBtn.style.display = 'inline-flex';

                // Start countdown
                let secondsLeft = 3;
                const countdownNumber = modal.querySelector('#countdownNumber');
                const countdownFill = modal.querySelector('#countdownFill');

                if (countdownNumber) countdownNumber.textContent = secondsLeft;
                if (countdownFill) countdownFill.style.width = '100%';

                const countdownInterval = setInterval(() => {
                    secondsLeft--;
                    if (countdownNumber) countdownNumber.textContent = secondsLeft;
                    if (countdownFill) countdownFill.style.width = `${(secondsLeft / 3) * 100}%`;

                    if (secondsLeft <= 0) {
                        clearInterval(countdownInterval);
                        closeQuizModal();
                        goToNextLesson();
                    }
                }, 1000);

                window.quizCountdownInterval = countdownInterval;
            }
        });
    }

    // Make resetQuizModal update our local variable
    window.resetModalQuizState = function() {
        modalCurrentQuestion = 0;
        updateModalQuizUI();
    };
});

// Close quiz modal function
function closeQuizModal() {
    const quizModal = document.getElementById('quizModal');
    if (quizModal) {
        quizModal.style.display = 'none';
    }
    // Cancel any pending countdown
    if (window.quizCountdownInterval) {
        clearInterval(window.quizCountdownInterval);
        window.quizCountdownInterval = null;
    }
}

// Watch the video again (close modal and replay video)
function watchVideoAgain() {
    closeQuizModal();
    // Replay the video from the beginning
    if (typeof player !== 'undefined' && player.seekTo && player.playVideo) {
        player.seekTo(0);
        player.playVideo();
    }
}

// Reset quiz modal to initial state
function resetQuizModal() {
    const modal = document.getElementById('quizModal');
    if (!modal) return;

    // Clear all selections
    modal.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
    modal.querySelectorAll('.option-item').forEach(opt => {
        opt.classList.remove('correct-answer', 'wrong-answer');
    });
    modal.querySelectorAll('.question-feedback').forEach(f => f.remove());

    // Show first question, hide others
    modal.querySelectorAll('.quiz-question').forEach((q, idx) => {
        q.style.display = idx === 0 ? 'block' : 'none';
    });

    // Reset header
    const header = modal.querySelector('.quiz-title-area h3');
    if (header) header.textContent = 'Pop Quiz!';
    const subtitle = modal.querySelector('.quiz-subtitle');
    if (subtitle) subtitle.textContent = 'Complete the quiz to continue';

    // Show header and questions
    const quizHeader = modal.querySelector('.quiz-header');
    if (quizHeader) quizHeader.style.display = 'block';

    const quizQuestions = modal.querySelector('#quizQuestions');
    if (quizQuestions) quizQuestions.style.display = 'block';

    const quizNav = modal.querySelector('.quiz-navigation');
    if (quizNav) quizNav.style.display = 'flex';

    // Hide results
    const resultsDiv = modal.querySelector('#quizResults');
    if (resultsDiv) resultsDiv.style.display = 'none';

    // Hide countdown
    const countdownContainer = modal.querySelector('#countdownContainer');
    if (countdownContainer) countdownContainer.style.display = 'none';

    // Hide continue button
    const continueBtn = modal.querySelector('#continueBtn');
    if (continueBtn) continueBtn.style.display = 'none';

    // Hide watch again button
    const watchAgainBtn = modal.querySelector('#watchAgainBtn');
    if (watchAgainBtn) watchAgainBtn.style.display = 'none';

    // Reset buttons
    const prevBtn = modal.querySelector('#prevQuestionBtn');
    const nextBtn = modal.querySelector('#nextQuestionBtn');
    const submitBtn = modal.querySelector('#submitQuizBtn');

    if (prevBtn) prevBtn.disabled = true;
    if (nextBtn) nextBtn.style.display = 'inline-flex';
    if (submitBtn) submitBtn.style.display = 'none';

    // Update counter
    const totalQ = typeof quizData !== 'undefined' ? quizData.length : 0;
    const counter = modal.querySelector('#questionCounter');
    if (counter) counter.textContent = `Question 1 of ${totalQ}`;

    const progressFill = modal.querySelector('#quizProgressFill');
    if (progressFill) progressFill.style.width = `${100 / Math.max(1, totalQ)}%`;

    // Reset the modal's internal question counter
    if (typeof window.resetModalQuizState === 'function') {
        window.resetModalQuizState();
    }
}

function restartQuiz() {
    // Cancel any pending countdown
    if (window.quizCountdownInterval) {
        clearInterval(window.quizCountdownInterval);
        window.quizCountdownInterval = null;
    }

    // Check if we're in the modal or inline quiz context
    const modal = document.getElementById('quizModal');
    const isModalOpen = modal && modal.style.display === 'flex';

    if (isModalOpen) {
        // Reset modal quiz
        resetQuizModal();
    } else {
        // Reset inline quiz (for standalone quiz lessons)
        currentQuestion = 0;

        // Clear all selections and feedback
        document.querySelectorAll('.quiz-question input[type="radio"]').forEach(r => r.checked = false);
        document.querySelectorAll('.option-item').forEach(opt => {
            opt.classList.remove('correct-answer', 'wrong-answer');
        });
        document.querySelectorAll('.question-feedback').forEach(f => f.remove());

        // Reset header
        const header = document.querySelector('.quiz-title-area h3');
        if (header) header.textContent = 'Quiz Time!';
        const subtitle = document.querySelector('.quiz-subtitle');
        if (subtitle) subtitle.textContent = 'Test your knowledge';

        // Show header and questions again
        const quizHeader = document.querySelector('.quiz-header');
        if (quizHeader) quizHeader.style.display = 'block';

        const quizQuestions = document.getElementById('quizQuestions');
        if (quizQuestions) quizQuestions.style.display = 'block';

        document.querySelectorAll('.quiz-question').forEach((q, idx) => {
            q.style.display = idx === 0 ? 'block' : 'none';
        });

        // Show navigation, hide results
        const quizNav = document.querySelector('.quiz-navigation');
        if (quizNav) quizNav.style.display = 'flex';

        const resultsDiv = document.getElementById('quizResults');
        if (resultsDiv) resultsDiv.style.display = 'none';

        // Hide countdown and continue button
        const countdownContainer = document.getElementById('countdownContainer');
        if (countdownContainer) countdownContainer.style.display = 'none';

        const continueBtn = document.getElementById('continueBtn');
        if (continueBtn) continueBtn.style.display = 'none';

        // Update quiz UI if available
        if (typeof updateQuizUI === 'function') {
            updateQuizUI();
        }
    }
}

// ================== NOTES FUNCTIONALITY ==================
const currentLessonId = <?php echo $current_lesson ? $current_lesson['id'] : 0; ?>;
const currentCourseId = <?php echo $course_id; ?>;
const notesApiUrl = '<?php echo url('api/notes.php'); ?>';

document.getElementById('saveNoteBtn')?.addEventListener('click', async function() {
    const noteText = document.getElementById('noteText').value.trim();
    if (!noteText) {
        alert('Please enter a note before saving.');
        return;
    }
    
    // Get current video timestamp (if player exists)
    let timestamp = 0;
    if (typeof player !== 'undefined' && player.getCurrentTime) {
        timestamp = Math.floor(player.getCurrentTime());
    }
    
    this.disabled = true;
    this.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';
    
    try {
        const response = await fetch(notesApiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                video_id: currentLessonId,
                course_id: currentCourseId,
                note_text: noteText,
                video_timestamp: timestamp
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Add new note to the UI
            const savedNotesSection = document.querySelector('.saved-notes-section');
            const noNotesMessage = document.getElementById('noNotesMessage');
            if (noNotesMessage) noNotesMessage.remove();
            
            const mins = Math.floor(timestamp / 60);
            const secs = timestamp % 60;
            const timestampStr = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            
            const noteCard = document.createElement('div');
            noteCard.className = 'note-card';
            noteCard.dataset.noteId = data.note_id;
            noteCard.innerHTML = `
                <span class="note-timestamp">${timestampStr}</span>
                <p class="note-text">${noteText.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
                <button class="note-delete-btn" onclick="deleteNote(${data.note_id})"><i class="bi bi-trash"></i></button>
            `;
            savedNotesSection.appendChild(noteCard);
            
            // Clear input
            document.getElementById('noteText').value = '';
            alert('Note saved successfully!');
        } else {
            alert('Error: ' + (data.message || 'Failed to save note'));
        }
    } catch (error) {
        console.error('Error saving note:', error);
        alert('Failed to save note. Please try again.');
    }
    
    this.disabled = false;
    this.innerHTML = 'Save Note';
});

async function deleteNote(noteId) {
    if (!confirm('Are you sure you want to delete this note?')) return;
    
    try {
        const response = await fetch(notesApiUrl, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ note_id: noteId })
        });
        
        const data = await response.json();
        
        if (data.success) {
            const noteCard = document.querySelector(`.note-card[data-note-id="${noteId}"]`);
            if (noteCard) noteCard.remove();
            
            // If no notes left, show empty state
            const remainingNotes = document.querySelectorAll('.note-card');
            if (remainingNotes.length === 0) {
                const savedNotesSection = document.querySelector('.saved-notes-section');
                savedNotesSection.innerHTML += `
                    <div class="empty-state-small" id="noNotesMessage" style="text-align: center; padding: 1rem;">
                        <i class="bi bi-journal-text" style="font-size: 2rem; color: #94a3b8;"></i>
                        <p style="color: #64748b; margin-top: 0.5rem;">No notes yet. Start taking notes!</p>
                    </div>
                `;
            }
        } else {
            alert('Error: ' + (data.message || 'Failed to delete note'));
        }
    } catch (error) {
        console.error('Error deleting note:', error);
        alert('Failed to delete note. Please try again.');
    }
}

// ================== Q&A FUNCTIONALITY ==================
const qaApiUrl = '<?php echo url('api/qa.php'); ?>';

// Show/hide question form
document.getElementById('askQuestionBtn')?.addEventListener('click', function() {
    const form = document.getElementById('askQuestionForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
    if (form.style.display === 'block') {
        document.getElementById('questionText').focus();
    }
});

document.getElementById('cancelQuestion')?.addEventListener('click', function() {
    document.getElementById('askQuestionForm').style.display = 'none';
    document.getElementById('questionText').value = '';
});

document.getElementById('submitQuestion')?.addEventListener('click', async function() {
    const questionText = document.getElementById('questionText').value.trim();
    if (!questionText) {
        alert('Please enter a question before submitting.');
        return;
    }
    
    this.disabled = true;
    this.innerHTML = '<i class="bi bi-hourglass-split"></i> Submitting...';
    
    try {
        const response = await fetch(qaApiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                video_id: currentLessonId,
                course_id: currentCourseId,
                question_text: questionText
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Add new question to the UI
            const qaTab = document.getElementById('qa');
            const emptyState = qaTab.querySelector('.empty-state-small');
            if (emptyState) emptyState.remove();
            
            // Find where to insert (after the form)
            const form = document.getElementById('askQuestionForm');
            const newQuestion = document.createElement('div');
            newQuestion.className = 'qa-item';
            newQuestion.dataset.questionId = data.question.question_id;
            newQuestion.innerHTML = `
                <div class="qa-user">
                    <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(data.question.user_name)}&background=random" class="qa-avatar">
                    <div class="qa-user-info">
                        <h6>${data.question.user_name}</h6>
                        <span>Just now</span>
                    </div>
                </div>
                <p class="qa-question">${questionText.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
                <div class="qa-actions">
                    <button class="qa-action-btn"><i class="bi bi-reply"></i> Reply (0)</button>
                    <button class="qa-action-btn"><i class="bi bi-hand-thumbs-up"></i> Helpful (0)</button>
                </div>
            `;
            form.after(newQuestion);
            
            // Update question count
            const header = qaTab.querySelector('.tab-section-title');
            const currentCount = parseInt(header.textContent.match(/\d+/) || 0);
            header.textContent = `Questions & Answers (${currentCount + 1})`;
            
            // Reset form
            document.getElementById('questionText').value = '';
            document.getElementById('askQuestionForm').style.display = 'none';
            
            alert('Question submitted successfully!');
        } else {
            alert('Error: ' + (data.message || 'Failed to submit question'));
        }
    } catch (error) {
        console.error('Error submitting question:', error);
        alert('Failed to submit question. Please try again.');
    }
    
    this.disabled = false;
    this.innerHTML = 'Submit Question';
});

// Reply button handler (using event delegation)
document.getElementById('qa')?.addEventListener('click', async function(e) {
    const replyBtn = e.target.closest('.qa-action-btn');
    if (!replyBtn) return;
    
    const qaItem = replyBtn.closest('.qa-item');
    if (!qaItem) return;
    
    const questionId = qaItem.dataset.questionId;
    
    // Check if it's a reply or helpful button
    if (replyBtn.textContent.includes('Reply')) {
        // Toggle reply form
        let replyForm = qaItem.querySelector('.reply-form');
        if (replyForm) {
            replyForm.remove();
            return;
        }
        
        replyForm = document.createElement('div');
        replyForm.className = 'reply-form';
        replyForm.innerHTML = `
            <textarea class="notes-textarea reply-textarea" placeholder="Write your reply..."></textarea>
            <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem;">
                <button class="btn btn-gradient btn-sm submit-reply">Submit Reply</button>
                <button class="btn btn-secondary btn-sm cancel-reply">Cancel</button>
            </div>
        `;
        qaItem.appendChild(replyForm);
        
        // Cancel handler
        replyForm.querySelector('.cancel-reply').addEventListener('click', () => replyForm.remove());
        
        // Submit handler
        replyForm.querySelector('.submit-reply').addEventListener('click', async function() {
            const replyText = replyForm.querySelector('.reply-textarea').value.trim();
            if (!replyText) {
                alert('Please enter a reply');
                return;
            }
            
            this.disabled = true;
            this.textContent = 'Submitting...';
            
            try {
                const response = await fetch(qaApiUrl, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        action: 'reply',
                        question_id: questionId,
                        reply_text: replyText
                    })
                });
                const data = await response.json();
                
                if (data.success) {
                    // Add reply to UI
                    let repliesDiv = qaItem.querySelector('.qa-replies');
                    if (!repliesDiv) {
                        repliesDiv = document.createElement('div');
                        repliesDiv.className = 'qa-replies';
                        qaItem.appendChild(repliesDiv);
                    }
                    
                    const replyEl = document.createElement('div');
                    replyEl.className = 'qa-reply';
                    replyEl.innerHTML = `
                        <strong>${data.reply.user_name}</strong>
                        <p>${replyText.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
                        <span class="reply-time">Just now</span>
                    `;
                    repliesDiv.appendChild(replyEl);
                    
                    // Update reply count
                    const countMatch = replyBtn.textContent.match(/\d+/);
                    const currentCount = countMatch ? parseInt(countMatch[0]) : 0;
                    replyBtn.innerHTML = `<i class="bi bi-reply"></i> Reply (${currentCount + 1})`;
                    
                    replyForm.remove();
                } else {
                    alert('Error: ' + data.message);
                    this.disabled = false;
                    this.textContent = 'Submit Reply';
                }
            } catch (error) {
                alert('Failed to submit reply');
                this.disabled = false;
                this.textContent = 'Submit Reply';
            }
        });
        
    } else if (replyBtn.textContent.includes('Helpful')) {
        // Mark as helpful
        replyBtn.disabled = true;
        
        try {
            const response = await fetch(qaApiUrl, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    action: 'helpful',
                    question_id: questionId
                })
            });
            const data = await response.json();
            
            if (data.success) {
                replyBtn.innerHTML = `<i class="bi bi-hand-thumbs-up-fill"></i> Helpful (${data.helpful_count})`;
                replyBtn.style.color = '#22c55e';
            } else {
                alert('Error: ' + data.message);
            }
        } catch (error) {
            alert('Failed to mark as helpful');
        }
        
        replyBtn.disabled = false;
    }
});
</script>

<style>
/* Quiz Styles - Premium Modern Design */
.quiz-container {
    background: #ffffff;
    border-radius: 1.5rem;
    padding: 0;
    min-height: 450px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.quiz-header {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    padding: 1.5rem 2rem;
    margin-bottom: 0;
}

.quiz-header-top {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.quiz-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.quiz-title-area h3 {
    margin: 0;
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
}

.quiz-subtitle {
    margin: 0;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
}

.quiz-progress {
    margin-top: 0;
}

#questionCounter {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.85rem;
    font-weight: 500;
}

.quiz-progress-bar {
    height: 6px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
    margin-top: 0.5rem;
    overflow: hidden;
}

.quiz-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #34d399, #10b981);
    border-radius: 3px;
    transition: width 0.3s ease;
}

.quiz-questions {
    padding: 2rem;
}

.question-text {
    font-size: 1.35rem;
    margin-bottom: 1.75rem;
    color: #1e293b;
    font-weight: 600;
    line-height: 1.5;
}

.options-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.option-item {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 1rem;
    cursor: pointer;
    transition: all 0.25s ease;
}

.option-item:hover {
    border-color: #6366f1;
    background: #f0f0ff;
    transform: translateX(4px);
}

.option-item input[type="radio"] {
    display: none;
}

.option-item:has(input:checked) {
    border-color: #6366f1;
    background: #eef2ff;
    box-shadow: 0 0 15px rgba(99, 102, 241, 0.15);
}

.option-item:has(input:checked) .option-letter {
    background: #6366f1;
    color: white;
}

.option-letter {
    width: 36px;
    height: 36px;
    background: #e2e8f0;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    color: #64748b;
    margin-right: 1rem;
    transition: all 0.2s ease;
}

.option-text {
    color: #334155;
    font-size: 1rem;
    flex: 1;
}

.quiz-navigation {
    display: flex;
    justify-content: space-between;
    padding: 1.5rem 2rem;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

.quiz-navigation .btn {
    min-width: 130px;
}

.btn-submit {
    background: linear-gradient(135deg, #10b981, #059669) !important;
}

.quiz-results {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: auto;
    padding: 1.5rem;
    background: white;
    border-radius: 1rem;
    margin-top: 1.5rem;
    border: 1px solid #e2e8f0;
}

.results-content {
    display: flex;
    align-items: center;
    gap: 2rem;
    text-align: left;
    max-width: 100%;
}

.results-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    margin: 0;
    flex-shrink: 0;
}

.results-content h3 {
    color: #1e293b;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.score-display {
    padding: 0;
    margin: 0;
    background: none;
    border-radius: 0;
    box-shadow: none;
    display: flex;
    flex-direction: column;
}

#scoreText {
    font-size: 2rem;
    font-weight: 800;
    color: #4f46e5;
    text-shadow: none;
    line-height: 1;
}

.score-percentage {
    font-size: 0.875rem;
    color: #64748b;
    margin-top: 0.25rem;
    font-weight: 500;
}

.results-actions {
    margin-left: auto;
    padding-left: 2rem;
    border-left: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.results-content .btn {
    margin-top: 0;
    padding: 0.5rem 1.25rem;
    font-size: 0.9rem;
}

.btn-outline-primary {
    background: transparent;
    border: 2px solid #6366f1;
    color: #6366f1;
    transition: all 0.2s ease;
}

.btn-outline-primary:hover {
    background: #6366f1;
    color: white;
}

/* Quiz Answer Feedback Styles */
.option-item.correct-answer {
    background: #dcfce7 !important;
    border-color: #22c55e !important;
}

.option-item.correct-answer .option-letter {
    background: #22c55e !important;
    color: white !important;
}

.option-item.correct-answer .option-text {
    color: #166534 !important;
    font-weight: 600;
}

.option-item.wrong-answer {
    background: #fef2f2 !important;
    border-color: #ef4444 !important;
}

.option-item.wrong-answer .option-letter {
    background: #ef4444 !important;
    color: white !important;
}

.option-item.wrong-answer .option-text {
    color: #991b1b !important;
    font-weight: 600;
}

.question-feedback {
    margin-top: 1rem;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.question-feedback.correct {
    background: #dcfce7;
    color: #166534;
}

.question-feedback.wrong {
    background: #fef2f2;
    color: #991b1b;
}

.question-feedback i {
    font-size: 1.1rem;
}

/* Q&A Reply Styles */
.reply-form {
    margin-top: 1rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 0.5rem;
    border: 1px solid #e2e8f0;
}

.reply-textarea {
    width: 100%;
    min-height: 80px;
}

.qa-replies {
    margin-top: 1rem;
    padding-left: 1.5rem;
    border-left: 3px solid #e2e8f0;
}

.qa-reply {
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    background: #f8fafc;
    border-radius: 0.5rem;
}

.qa-reply strong {
    color: #1e293b;
    font-size: 0.9rem;
}

.qa-reply p {
    margin: 0.25rem 0;
    color: #334155;
    font-size: 0.9rem;
}

.reply-time {
    font-size: 0.75rem;
    color: #94a3b8;
}
/* Quiz Popup Modal Styles */
.quiz-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.9);
    z-index: 9999;
    display: none;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    backdrop-filter: blur(5px);
}

.quiz-modal-content {
    background: white;
    width: 100%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    border-radius: 1.5rem;
    padding: 2.5rem;
    position: relative;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    animation: modalSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes modalSlideUp {
    from { 
        transform: translateY(40px) scale(0.95); 
        opacity: 0; 
    }
    to { 
        transform: translateY(0) scale(1); 
        opacity: 1; 
    }
}

.quiz-modal-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
}

.close-modal-btn {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: #f1f5f9;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s;
}

.close-modal-btn:hover {
    background: #e2e8f0;
    color: #0f172a;
    transform: rotate(90deg);
}

.quiz-modal-content .quiz-container {
    padding: 0;
    background: transparent;
    border: none;
    box-shadow: none;
}
</style>

