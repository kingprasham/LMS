<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('Course Player', ['css/dashboard.css', 'css/course-player.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('my-courses'); ?>

    <!-- Main Content -->
    <main class="dashboard-main">
        <div class="player-layout fade-in-up">
            
            <!-- Left Column: Video & Tabs -->
            <div class="video-section">
                <!-- Video Player -->
                <div class="video-container">
                    <!-- Placeholder Image for Demo -->
                    <img src="https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=1200&h=675&fit=crop" alt="Video Placeholder" style="width:100%; height:100%; object-fit:cover;">
                    
                    <!-- Custom Controls Overlay -->
                    <div class="video-controls">
                        <button class="control-btn"><i class="bi bi-play-fill"></i></button>
                        <div class="progress-bar-video">
                            <div class="progress-fill-video"></div>
                        </div>
                        <span class="time-display">04:20 / 10:00</span>
                        <div class="speed-control">1x</div>
                        <div class="quality-control">HD</div>
                        <button class="control-btn"><i class="bi bi-fullscreen"></i></button>
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="action-bar">
                    <h2 class="h4 mb-0">1.2 Introduction to Generative Models</h2>
                    <button class="btn-complete" id="markCompleteBtn">
                        <i class="bi bi-check-circle"></i> Mark as Complete
                    </button>
                </div>

                <!-- Content Tabs -->
                <div class="course-tabs">
                    <div class="tabs-header">
                        <button class="tab-btn active" onclick="switchTab('overview')">Overview</button>
                        <button class="tab-btn" onclick="switchTab('qa')">Q&A</button>
                        <button class="tab-btn" onclick="switchTab('notes')">Notes</button>
                        <button class="tab-btn" onclick="switchTab('announcements')">Announcements</button>
                    </div>
                    <div class="tab-content">
                        <!-- Overview Tab -->
                        <div id="overview" class="tab-pane active">
                            <h3 class="h5 fw-bold mb-3">About this lesson</h3>
                            <p class="text-secondary mb-4">In this lesson, we will explore the fundamental concepts of generative models, including how they differ from discriminative models and their applications in drug discovery.</p>
                            
                            <h4 class="h6 fw-bold mb-2">Key Topics:</h4>
                            <ul class="text-secondary mb-4">
                                <li>Definition of Generative AI</li>
                                <li>VAE vs GANs</li>
                                <li>Applications in Molecular Design</li>
                            </ul>

                            <div class="instructor-mini d-flex align-items-center gap-3 p-3 bg-light rounded">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=random" class="rounded-circle" width="48" height="48">
                                <div>
                                    <h5 class="mb-0 text-dark">Dr. Sarah Johnson</h5>
                                    <span class="text-muted small">Lead Instructor</span>
                                </div>
                            </div>
                        </div>

                        <!-- Q&A Tab -->
                        <div id="qa" class="tab-pane">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="h5 fw-bold mb-0">Questions (12)</h3>
                                <button class="btn btn-sm btn-outline-primary">Ask a Question</button>
                            </div>
                            
                            <!-- Question Item -->
                            <div class="qa-item mb-4 pb-3 border-bottom">
                                <div class="d-flex gap-3">
                                    <img src="https://ui-avatars.com/api/?name=John+D&background=random" class="rounded-circle" width="32" height="32">
                                    <div>
                                        <h6 class="mb-1 fw-bold">John Doe <span class="text-muted fw-normal small ms-2">2 hours ago</span></h6>
                                        <p class="text-secondary mb-2">Can you explain the difference between VAE and GANs again?</p>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-muted small"><i class="bi bi-reply"></i> Reply</a>
                                            <a href="#" class="text-muted small"><i class="bi bi-hand-thumbs-up"></i> 5</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Tab -->
                        <div id="notes" class="tab-pane">
                            <div class="form-group mb-3">
                                <textarea class="form-control" rows="5" placeholder="Take notes here..."></textarea>
                            </div>
                            <button class="btn btn-primary">Save Note</button>
                            
                            <div class="saved-notes mt-4">
                                <h4 class="h6 fw-bold mb-3">Your Notes</h4>
                                <div class="note-card p-3 border rounded mb-2">
                                    <span class="badge bg-light text-dark mb-2">04:20</span>
                                    <p class="mb-0 text-secondary small">Key concept: Generative models learn the joint probability distribution...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Announcements Tab -->
                        <div id="announcements" class="tab-pane">
                            <div class="announcement-card p-3 bg-light rounded border-start border-4 border-warning">
                                <h5 class="fw-bold mb-2">Live Session Rescheduled</h5>
                                <p class="text-secondary mb-0 small">The live Q&A session for this module has been moved to Friday at 2 PM EST.</p>
                                <span class="text-muted x-small mt-2 d-block">Posted by Instructor • Yesterday</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Course Sidebar -->
            <aside class="course-sidebar">
                <div class="sidebar-header-course">
                    <h3 class="h5 fw-bold mb-1">Course Content</h3>
                    <div class="course-progress-mini">
                        <div class="progress-text">
                            <span>35% Complete</span>
                            <span>12/45 Items</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 35%"></div>
                        </div>
                    </div>
                </div>

                <div class="module-list">
                    <!-- Module 1 -->
                    <div class="module-item">
                        <div class="module-header">
                            <span>Module 1: Introduction</span>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                        <ul class="lesson-list">
                            <li class="lesson-item completed">
                                <i class="bi bi-check-circle-fill check-icon"></i>
                                <span class="lesson-title">1.1 Welcome to the Course</span>
                                <span class="lesson-duration">5m</span>
                            </li>
                            <li class="lesson-item active">
                                <i class="bi bi-play-circle check-icon"></i>
                                <span class="lesson-title">1.2 Intro to Generative Models</span>
                                <span class="lesson-duration">10m</span>
                            </li>
                            <li class="lesson-item">
                                <i class="bi bi-lock check-icon"></i>
                                <span class="lesson-title">1.3 History of AI in Pharma</span>
                                <span class="lesson-duration">15m</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Module 2 -->
                    <div class="module-item">
                        <div class="module-header">
                            <span>Module 2: Neural Networks</span>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                        <ul class="lesson-list">
                            <li class="lesson-item">
                                <i class="bi bi-lock check-icon"></i>
                                <span class="lesson-title">2.1 Neural Net Basics</span>
                                <span class="lesson-duration">20m</span>
                            </li>
                            <li class="lesson-item">
                                <i class="bi bi-lock check-icon"></i>
                                <span class="lesson-title">2.2 Backpropagation</span>
                                <span class="lesson-duration">25m</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>

        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
    // Tab Switching Logic
    function switchTab(tabId) {
        // Hide all tabs
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('active');
        });
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        // Show selected tab
        document.getElementById(tabId).classList.add('active');
        event.target.classList.add('active');
    }

    // Mark as Complete Logic
    document.getElementById('markCompleteBtn').addEventListener('click', function() {
        this.classList.toggle('completed');
        if(this.classList.contains('completed')) {
            this.innerHTML = '<i class="bi bi-check-circle-fill"></i> Completed';
            // Find active lesson and mark as complete (visual only)
            document.querySelector('.lesson-item.active .check-icon').classList.remove('bi-play-circle');
            document.querySelector('.lesson-item.active .check-icon').classList.add('bi-check-circle-fill');
            document.querySelector('.lesson-item.active').classList.add('completed');
        } else {
            this.innerHTML = '<i class="bi bi-check-circle"></i> Mark as Complete';
        }
    });
</script>
