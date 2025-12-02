<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Messages', ['css/dashboard.css', 'css/admin-users.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('messages'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Messages</h1>
                <p class="dashboard-subtitle">Communicate with instructors and students</p>
            </div>
            <button class="btn-primary" onclick="openNewMessage()">
                <i class="bi bi-plus-lg"></i> New Message
            </button>
        </div>

        <!-- Messages Container -->
        <div class="messages-container fade-in-up" style="animation-delay: 0.1s">
            <div class="messages-sidebar">
                <div class="message-search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search messages..." class="form-control">
                </div>

                <div class="message-list">
                    <div class="message-item active">
                        <div class="message-avatar">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff" alt="John Doe">
                        </div>
                        <div class="message-preview">
                            <div class="message-header">
                                <span class="message-name">John Doe</span>
                                <span class="message-time">2h ago</span>
                            </div>
                            <p class="message-text">Question about the new course curriculum...</p>
                        </div>
                        <span class="message-unread">2</span>
                    </div>

                    <div class="message-item">
                        <div class="message-avatar">
                            <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=10b981&color=fff" alt="Jane Smith">
                        </div>
                        <div class="message-preview">
                            <div class="message-header">
                                <span class="message-name">Jane Smith</span>
                                <span class="message-time">5h ago</span>
                            </div>
                            <p class="message-text">Thanks for the feedback on my assignment</p>
                        </div>
                    </div>

                    <div class="message-item">
                        <div class="message-avatar">
                            <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=f59e0b&color=fff" alt="Mike Johnson">
                        </div>
                        <div class="message-preview">
                            <div class="message-header">
                                <span class="message-name">Mike Johnson</span>
                                <span class="message-time">1d ago</span>
                            </div>
                            <p class="message-text">Can we schedule a meeting to discuss...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="message-content">
                <div class="message-content-header">
                    <div class="message-user-info">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff" alt="John Doe" class="message-user-avatar">
                        <div>
                            <h3 class="message-user-name">John Doe</h3>
                            <p class="message-user-role">Instructor - Web Development</p>
                        </div>
                    </div>
                    <div class="message-actions">
                        <button class="btn-icon" title="Archive"><i class="bi bi-archive"></i></button>
                        <button class="btn-icon" title="Delete"><i class="bi bi-trash"></i></button>
                    </div>
                </div>

                <div class="message-thread">
                    <div class="message-bubble received">
                        <div class="message-bubble-content">
                            <p>Hi, I have a question about the new course curriculum we're implementing. Could you review the attached document?</p>
                            <span class="message-bubble-time">Today at 2:30 PM</span>
                        </div>
                    </div>

                    <div class="message-bubble sent">
                        <div class="message-bubble-content">
                            <p>Sure, I'll take a look at it and get back to you by end of day.</p>
                            <span class="message-bubble-time">Today at 3:15 PM</span>
                        </div>
                    </div>

                    <div class="message-bubble received">
                        <div class="message-bubble-content">
                            <p>Great, thanks! Also, do you have any feedback on the assessment structure?</p>
                            <span class="message-bubble-time">Today at 4:20 PM</span>
                        </div>
                    </div>
                </div>

                <div class="message-input-container">
                    <button class="btn-icon" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5; border: 1px solid rgba(79, 70, 229, 0.2); padding: 0.75rem; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(79, 70, 229, 0.2)'" onmouseout="this.style.background='rgba(79, 70, 229, 0.1)'">
                        <i class="bi bi-paperclip"></i>
                    </button>
                    <input type="text" class="message-input" placeholder="Type your message...">
                    <button class="btn-primary" style="background: #4f46e5; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s;" onmouseover="this.style.background='#4338ca'" onmouseout="this.style.background='#4f46e5'">
                        <i class="bi bi-send-fill"></i> Send
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<style>
.messages-container {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 1.5rem;
    height: calc(100vh - 200px);
}

.messages-sidebar {
    background: var(--bg-card);
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.message-search {
    position: relative;
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.message-search i {
    position: absolute;
    left: 1.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
}

.message-search input {
    padding-left: 2.5rem;
}

.message-list {
    flex: 1;
    overflow-y: auto;
}

.message-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.2s;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    position: relative;
}

.message-item:hover {
    background: rgba(79, 70, 229, 0.05);
}

.message-item.active {
    background: rgba(79, 70, 229, 0.1);
    border-left: 3px solid var(--primary);
}

.message-avatar img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
}

.message-preview {
    flex: 1;
    min-width: 0;
}

.message-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.25rem;
}

.message-name {
    font-weight: 600;
    color: var(--text-main);
}

.message-time {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.message-text {
    font-size: 0.875rem;
    color: var(--text-secondary);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0;
}

.message-unread {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--primary);
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    min-width: 20px;
    text-align: center;
}

.message-content {
    background: var(--bg-card);
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    flex-direction: column;
}

.message-content-header {
    padding: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.message-user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.message-user-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
}

.message-user-name {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-main);
    margin: 0;
}

.message-user-role {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
}

.message-thread {
    flex: 1;
    overflow-y: auto;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.message-bubble {
    max-width: 70%;
    display: flex;
}

.message-bubble.received {
    align-self: flex-start;
}

.message-bubble.sent {
    align-self: flex-end;
}

.message-bubble-content {
    background: rgba(255, 255, 255, 0.05);
    padding: 1rem;
    border-radius: 1rem;
}

.message-bubble.sent .message-bubble-content {
    background: var(--primary);
}

.message-bubble-content p {
    margin: 0 0 0.5rem 0;
    color: var(--text-main);
}

.message-bubble.sent .message-bubble-content p {
    color: white;
}

.message-bubble-time {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.message-bubble.sent .message-bubble-time {
    color: rgba(255, 255, 255, 0.8);
}

.message-input-container {
    padding: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    gap: 1rem;
    align-items: center;
}

.message-input {
    flex: 1;
    padding: 0.75rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.5rem;
    color: var(--text-main);
}

.message-input:focus {
    outline: none;
    border-color: var(--primary);
}

@media (max-width: 968px) {
    .messages-container {
        grid-template-columns: 1fr;
    }
    
    .messages-sidebar {
        display: none;
    }
}
</style>

<script>
function openNewMessage() {
    alert('New Message modal would open here (static demo)');
}

// File attachment functionality
document.addEventListener('DOMContentLoaded', function() {
    const attachmentBtns = document.querySelectorAll('.message-input-container .btn-icon');
    
    attachmentBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Create hidden file input
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.multiple = true;
            fileInput.accept = 'image/*,.pdf,.doc,.docx,.txt';
            
            fileInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    const fileNames = Array.from(this.files).map(f => f.name).join(', ');
                    alert(`Files selected: ${fileNames}\n\n(In production, these would be uploaded)`);
                }
            });
            
            fileInput.click();
        });
    });

    // Mobile sidebar toggle
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
});
</script>
