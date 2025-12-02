// Forgot Password Form Handler
document.addEventListener('DOMContentLoaded', function() {
    const forgotPasswordForm = document.getElementById('forgot-password-form');
    const emailStep = document.getElementById('email-step');
    const successStep = document.getElementById('success-step');
    const emailInput = document.getElementById('email');
    const sentEmailSpan = document.getElementById('sent-email');
    const resendLink = document.getElementById('resend-link');

    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = emailInput.value.trim();

            // Basic email validation
            if (!isValidEmail(email)) {
                showError('Please enter a valid email address');
                return;
            }

            // Show loading state
            const submitBtn = forgotPasswordForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
            submitBtn.disabled = true;

            // Simulate API call (replace with actual API call)
            setTimeout(() => {
                // In production, replace this with actual API call:
                // fetch('/api/forgot-password', {
                //     method: 'POST',
                //     headers: { 'Content-Type': 'application/json' },
                //     body: JSON.stringify({ email: email })
                // })
                // .then(response => response.json())
                // .then(data => {
                //     if (data.success) {
                //         showSuccessStep(email);
                //     } else {
                //         showError(data.message);
                //         submitBtn.innerHTML = originalText;
                //         submitBtn.disabled = false;
                //     }
                // })
                // .catch(error => {
                //     showError('An error occurred. Please try again.');
                //     submitBtn.innerHTML = originalText;
                //     submitBtn.disabled = false;
                // });

                // For demo purposes, always show success
                showSuccessStep(email);
            }, 1500);
        });
    }

    // Resend link handler
    if (resendLink) {
        resendLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            const email = sentEmailSpan.textContent;
            
            // Show loading state
            resendLink.innerHTML = 'Sending...';
            resendLink.style.pointerEvents = 'none';

            // Simulate resend API call
            setTimeout(() => {
                resendLink.innerHTML = 'resend the link';
                resendLink.style.pointerEvents = 'auto';
                
                // Show temporary success message
                const alertDiv = resendLink.closest('.alert');
                const tempSuccess = document.createElement('small');
                tempSuccess.style.color = '#5cb85c';
                tempSuccess.style.display = 'block';
                tempSuccess.style.marginTop = '5px';
                tempSuccess.innerHTML = '✓ Email sent successfully!';
                alertDiv.appendChild(tempSuccess);
                
                setTimeout(() => {
                    tempSuccess.remove();
                }, 3000);
            }, 1000);
        });
    }

    function showSuccessStep(email) {
        sentEmailSpan.textContent = email;
        emailStep.style.display = 'none';
        successStep.style.display = 'block';
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showError(message) {
        // Remove existing error if any
        const existingError = document.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }

        // Create error element
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.cssText = `
            background-color: #fff4e5;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        `;
        errorDiv.innerHTML = `
            <i class="bi bi-exclamation-triangle-fill" style="color: #ffc107;"></i>
            <span>${message}</span>
        `;

        // Insert before form
        forgotPasswordForm.parentNode.insertBefore(errorDiv, forgotPasswordForm);

        // Remove error after 5 seconds
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }
});

// Add smooth animations
const style = document.createElement('style');
style.textContent = `
    .success-icon-wrapper {
        text-align: center;
        margin: 20px 0;
    }
    
    .success-icon {
        display: inline-block;
        animation: scaleIn 0.5s ease-out;
    }
    
    .success-icon i {
        font-size: 64px;
        color: #5cb85c;
    }
    
    @keyframes scaleIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .alert {
        background-color: #e7f3ff;
        border: 1px solid #b3d9ff;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }
    
    .alert i {
        color: #0066cc;
        font-size: 20px;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    .alert strong {
        display: block;
        color: #1c1d1f;
        margin-bottom: 5px;
    }
    
    .alert p {
        color: #6a6f73;
        font-size: 14px;
    }
    
    .alert a {
        color: #0066cc;
        text-decoration: none;
        font-weight: 500;
    }
    
    .alert a:hover {
        text-decoration: underline;
    }
    
    .spinner-border {
        width: 1rem;
        height: 1rem;
        border-width: 0.15em;
    }
`;
document.head.appendChild(style);
