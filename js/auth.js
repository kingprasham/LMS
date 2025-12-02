// Authentication JavaScript

document.addEventListener('DOMContentLoaded', function() {
    setupAuthForms();
});

function setupAuthForms() {
    // Login form
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Simulate login
            if (email && password) {
                const user = {
                    name: email.split('@')[0],
                    email: email
                };

                localStorage.setItem('user', JSON.stringify(user));

                // Show success message
                alert('Login successful!');

                // Redirect to dashboard
                window.location.href = 'dashboard.php';
            }
        });
    }

    // Signup form
    const signupForm = document.getElementById('signup-form');
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const fullname = document.getElementById('fullname').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const newsletter = document.getElementById('newsletter').checked;

            // Simulate signup
            if (fullname && email && password) {
                const user = {
                    name: fullname,
                    email: email,
                    newsletter: newsletter
                };

                localStorage.setItem('user', JSON.stringify(user));

                // Show success message
                alert('Account created successfully!');

                // Redirect to dashboard
                window.location.href = 'dashboard.php';
            }
        });
    }

    // Social login buttons
    const socialButtons = document.querySelectorAll('.social-btn');
    socialButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const provider = this.textContent.includes('Google') ? 'Google' :
                           this.textContent.includes('Facebook') ? 'Facebook' : 'Apple';
            alert(`${provider} authentication coming soon!`);
        });
    });
}

// Check if user is logged in and update UI
function checkAuthStatus() {
    const user = JSON.parse(localStorage.getItem('user'));

    if (user) {
        // Update header to show user is logged in
        const loginLink = document.getElementById('login-link');
        const signupLink = document.getElementById('signup-link');
        const myLearningLink = document.getElementById('my-learning-link');
        const wishlistLink = document.getElementById('wishlist-link');
        const notificationsBtn = document.getElementById('notifications-btn');
        const profileBtn = document.getElementById('profile-btn');

        if (loginLink) loginLink.style.display = 'none';
        if (signupLink) signupLink.style.display = 'none';
        if (myLearningLink) myLearningLink.style.display = 'inline';
        if (wishlistLink) wishlistLink.style.display = 'inline';
        if (notificationsBtn) notificationsBtn.style.display = 'inline';
        if (profileBtn) profileBtn.style.display = 'inline';
    }
}

// Call on page load
if (typeof window !== 'undefined') {
    checkAuthStatus();
}
