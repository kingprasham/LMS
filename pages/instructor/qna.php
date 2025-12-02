<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('Q&A Dashboard', ['css/dashboard.css', 'css/instructor-dashboard.css', 'css/instructor-pages.css']);
renderNavbar();

// Static data for Q&A
$questions = [
    [
        'id' => 1,
        'student' => 'Sarah Johnson',
        'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Johnson&background=random',
        'course' => 'Complete Web Development Bootcamp 2024',
        'lecture' => 'Lecture 24: CSS Grid vs Flexbox',
        'title' => 'When should I use Grid over Flexbox?',
        'content' => 'I understand the basics of both, but I\'m confused about when to choose one over the other for main page layouts. Can you clarify?',
        'date' => '2 hours ago',
        'status' => 'unanswered',
        'replies' => []
    ],
    [
        'id' => 2,
        'student' => 'Michael Chen',
        'avatar' => 'https://ui-avatars.com/api/?name=Michael+Chen&background=random',
        'course' => 'Advanced React Patterns',
        'lecture' => 'Lecture 12: Custom Hooks',
        'title' => 'Error in the useLocalStorage hook code',
        'content' => 'I tried following the video but I get a "window is not defined" error when using Next.js. How do I fix this?',
        'date' => '1 day ago',
        'status' => 'answered',
        'replies' => [
            [
                'instructor' => 'John Doe',
                'content' => 'Hi Michael, since Next.js renders on the server first, window is not available. You need to wrap the access in a useEffect or check if typeof window !== "undefined".',
                'date' => '20 hours ago'
            ]
        ]
    ],
    [
        'id' => 3,
        'student' => 'Emily Davis',
        'avatar' => 'https://ui-avatars.com/api/?name=Emily+Davis&background=random',
        'course' => 'Complete Web Development Bootcamp 2024',
        'lecture' => 'Lecture 45: Async/Await',
        'title' => 'Can we use try/catch with .then()?',
        'content' => 'Is it possible to mix async/await syntax with .then() chains? Or should we stick to one style?',
        'date' => '2 days ago',
        'status' => 'unanswered',
        'replies' => []
    ]
];
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('qna'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Q&A Dashboard</h1>
                <p class="dashboard-subtitle">Answer student questions and facilitate discussions</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-bar fade-in-up" style="animation-delay: 0.1s">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" placeholder="Search questions...">
            </div>
            <div class="filter-btn-group">
                <button class="filter-btn active">All</button>
                <button class="filter-btn">Unanswered</button>
                <button class="filter-btn">Answered</button>
            </div>
        </div>

        <!-- Questions List -->
        <div class="qna-list fade-in-up" style="animation-delay: 0.2s">
            <?php foreach ($questions as $q): ?>
            <div class="qna-card <?php echo $q['status']; ?>">
                <div class="qna-header">
                    <div class="user-info">
                        <img src="<?php echo $q['avatar']; ?>" class="user-avatar" alt="Avatar">
                        <div>
                            <div class="user-name"><?php echo $q['student']; ?></div>
                            <div class="qna-meta">
                                <span><?php echo $q['date']; ?></span>
                                <span class="separator">•</span>
                                <span><?php echo $q['course']; ?></span>
                            </div>
                        </div>
                    </div>
                    <span class="status-badge status-<?php echo $q['status'] == 'answered' ? 'published' : 'draft'; ?>">
                        <?php echo ucfirst($q['status']); ?>
                    </span>
                </div>
                
                <div class="qna-content">
                    <div class="lecture-ref">
                        <i class="bi bi-play-circle"></i> <?php echo $q['lecture']; ?>
                    </div>
                    <h3 class="qna-title"><?php echo $q['title']; ?></h3>
                    <p class="qna-text"><?php echo $q['content']; ?></p>
                </div>

                <!-- Replies Section -->
                <?php if (!empty($q['replies'])): ?>
                <div class="qna-replies">
                    <?php foreach ($q['replies'] as $reply): ?>
                    <div class="reply-item">
                        <div class="reply-header">
                            <span class="instructor-badge">Instructor</span>
                            <span class="reply-date"><?php echo $reply['date']; ?></span>
                        </div>
                        <p class="reply-text"><?php echo $reply['content']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Action Footer -->
                <div class="qna-footer">
                    <button class="btn-reply-action" onclick="toggleReplyForm(<?php echo $q['id']; ?>)">
                        <i class="bi bi-reply-fill"></i> Reply
                    </button>
                    
                    <!-- Reply Form (Hidden) -->
                    <div class="reply-form" id="replyForm-<?php echo $q['id']; ?>" style="display: none;">
                        <textarea class="form-control mb-2" rows="3" placeholder="Write your answer here..."></textarea>
                        <div class="form-actions-right">
                            <button class="btn-secondary btn-sm" onclick="toggleReplyForm(<?php echo $q['id']; ?>)">Cancel</button>
                            <button class="btn-primary btn-sm">Post Answer</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
function toggleReplyForm(id) {
    const form = document.getElementById('replyForm-' + id);
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle logic
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('active'));
    }
});
</script>
