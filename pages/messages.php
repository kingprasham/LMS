<?php
include('../config.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

renderHead('Messages', ['css/dashboard.css', 'css/messages.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('messages'); ?>

    <!-- Main Content -->
    <main class="dashboard-main">
        <div class="messages-container fade-in-up">
            <!-- Chat Sidebar -->
            <div class="chat-sidebar">
                <div class="chat-header">
                    <h2>Messages</h2>
                    <button class="btn-new-chat"><i class="bi bi-pencil-square"></i></button>
                </div>
                <div class="chat-search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search messages...">
                </div>
                <div class="chat-list">
                    <div class="chat-item active">
                        <div class="avatar">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=random" alt="Sarah">
                            <span class="status online"></span>
                        </div>
                        <div class="chat-info">
                            <div class="chat-top">
                                <h4>Dr. Sarah Johnson</h4>
                                <span class="time">10:30 AM</span>
                            </div>
                            <p>Please review the latest module...</p>
                        </div>
                    </div>

                    <div class="chat-item unread">
                        <div class="avatar">
                            <img src="https://ui-avatars.com/api/?name=Michael+Chen&background=random" alt="Michael">
                            <span class="status offline"></span>
                        </div>
                        <div class="chat-info">
                            <div class="chat-top">
                                <h4>Prof. Michael Chen</h4>
                                <span class="time">Yesterday</span>
                            </div>
                            <p>Great work on the assignment!</p>
                            <span class="unread-badge">2</span>
                        </div>
                    </div>

                    <div class="chat-item">
                        <div class="avatar">
                            <img src="https://ui-avatars.com/api/?name=Emily+R&background=random" alt="Emily">
                            <span class="status online"></span>
                        </div>
                        <div class="chat-info">
                            <div class="chat-top">
                                <h4>Dr. Emily Rodriguez</h4>
                                <span class="time">Mon</span>
                            </div>
                            <p>The webinar link is updated.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Area -->
            <div class="chat-area">
                <div class="chat-area-header">
                    <div class="chat-user">
                        <div class="avatar">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=random" alt="Sarah">
                            <span class="status online"></span>
                        </div>
                        <div>
                            <h3>Dr. Sarah Johnson</h3>
                            <span class="user-status">Online</span>
                        </div>
                    </div>
                    <div class="chat-actions">
                        <button><i class="bi bi-camera-video"></i></button>
                        <button><i class="bi bi-telephone"></i></button>
                        <button><i class="bi bi-three-dots-vertical"></i></button>
                    </div>
                </div>

                <div class="chat-messages">
                    <div class="message received">
                        <div class="message-content">
                            <p>Hello! How are you finding the new module on Drug Discovery?</p>
                            <span class="msg-time">10:00 AM</span>
                        </div>
                    </div>

                    <div class="message sent">
                        <div class="message-content">
                            <p>Hi Dr. Johnson! It's fascinating. I'm really enjoying the section on molecular docking.</p>
                            <span class="msg-time">10:15 AM</span>
                        </div>
                    </div>

                    <div class="message received">
                        <div class="message-content">
                            <p>That's great to hear! I've just uploaded some additional resources for that topic.</p>
                            <span class="msg-time">10:28 AM</span>
                        </div>
                    </div>

                    <div class="message received">
                        <div class="message-content">
                            <p>Please review them when you have a chance.</p>
                            <span class="msg-time">10:30 AM</span>
                        </div>
                    </div>
                </div>

                <div class="chat-input-area">
                    <button class="btn-attach"><i class="bi bi-paperclip"></i></button>
                    <input type="text" placeholder="Type a message...">
                    <button class="btn-send"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatItems = document.querySelectorAll('.chat-item');
    const chatArea = document.querySelector('.chat-messages');
    const chatUser = document.querySelector('.chat-user h3');
    const chatAvatar = document.querySelector('.chat-user img');
    const btnNewChat = document.querySelector('.btn-new-chat');
    const btnSend = document.querySelector('.btn-send');
    const input = document.querySelector('.chat-input-area input');

    // Chat Switching
    chatItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class
            chatItems.forEach(i => i.classList.remove('active'));
            // Add active class
            this.classList.add('active');
            
            // Update Chat Header
            const name = this.querySelector('h4').innerText;
            const img = this.querySelector('img').src;
            
            chatUser.innerText = name;
            chatAvatar.src = img;
            
            // Mark as read (remove unread class/badge)
            this.classList.remove('unread');
            const badge = this.querySelector('.unread-badge');
            if(badge) badge.style.display = 'none';
            
            // Simulate loading messages (clear and add dummy)
            chatArea.innerHTML = `
                <div class="message received">
                    <div class="message-content">
                        <p>This is the beginning of your conversation with ${name}.</p>
                        <span class="msg-time">Just now</span>
                    </div>
                </div>
            `;
        });
    });

    // New Chat
    btnNewChat.addEventListener('click', function() {
        chatUser.innerText = 'New Conversation';
        chatArea.innerHTML = '';
        chatItems.forEach(i => i.classList.remove('active'));
        input.focus();
    });

    // Send Message
    function sendMessage() {
        const text = input.value.trim();
        if (text) {
            const msgHtml = `
                <div class="message sent">
                    <div class="message-content">
                        <p>${text}</p>
                        <span class="msg-time">Just now</span>
                    </div>
                </div>
            `;
            chatArea.insertAdjacentHTML('beforeend', msgHtml);
            input.value = '';
            chatArea.scrollTop = chatArea.scrollHeight;
        }
    }

    btnSend.addEventListener('click', sendMessage);
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });
});
</script>
