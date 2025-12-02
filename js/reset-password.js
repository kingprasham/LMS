// Reset Password Form Handler
document.addEventListener('DOMContentLoaded', function() {
    const resetPasswordForm = document.getElementById('reset-password-form');
    const resetStep = document.getElementById('reset-step');
    const successStep = document.getElementById('success-step');
    const newPasswordInput = document.getElementById('new-password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordStrengthDiv = document.getElementById('password-strength');
    const strengthMeterFill = document.querySelector('.strength-meter-fill');
    const strengthText = document.querySelector('.strength-text');

    // Password strength checker
    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            
            if (password.length === 0) {
                passwordStrengthDiv.style.display = 'none';
                return;
            }

            passwordStrengthDiv.style.display = 'block';
            const strength = checkPasswordStrength(password);
            updateStrengthMeter(strength);
        });
    }

    // Form submission
    if (resetPasswordForm) {
        resetPasswordForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Validation
            if (newPassword.length < 8) {
                showError('Password must be at least 8 characters long');
                return;
            }

            if (newPassword !== confirmPassword) {
                showError('Passwords do not match');
                return;
            }

            const strength = checkPasswordStrength(newPassword);
            if (strength.score < 2) {
                showError('Please choose a stronger password');
                return;
            }

            // Show loading state
            const submitBtn = resetPasswordForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Resetting...';
            submitBtn.disabled = true;

            // Simulate API call (replace with actual API call)
            setTimeout(() => {
                // In production, replace with actual API call:
                // const urlParams = new URLSearchParams(window.location.search);
                // const token = urlParams.get('token');
                // 
                // fetch('/api/reset-password', {
                //     method: 'POST',
                //     headers: { 'Content-Type': 'application/json' },
                //     body: JSON.stringify({ 
                //         token: token,
                //         password: newPassword 
                //     })
                // })
                // .then(response => response.json())
                // .then(data => {
                //     if (data.success) {
                //         showSuccessStep();
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
                showSuccessStep();
            }, 1500);
        });
    }

    function checkPasswordStrength(password) {
        let score = 0;
        let feedback = [];

        // Length check
        if (password.length >= 8) score++;
        if (password.length >= 12) score++;

        // Character variety checks
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;

        // Determine strength level
        let level, color, text;
        if (score < 3) {
            level = 'weak';
            color = '#dc3545';
            text = 'Weak';
        } else if (score < 5) {
            level = 'medium';
            color = '#ffc107';
            text = 'Medium';
        } else {
            level = 'strong';
            color = '#28a745';
            text = 'Strong';
        }

        return { score, level, color, text };
    }

    function updateStrengthMeter(strength) {
        const percentage = (strength.score / 6) * 100;
        strengthMeterFill.style.width = percentage + '%';
        strengthMeterFill.style.backgroundColor = strength.color;
        strengthText.textContent = `Password strength: ${strength.text}`;
        strengthText.style.color = strength.color;
    }

    function showSuccessStep() {
        resetStep.style.display = 'none';
        successStep.style.display = 'block';
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
        resetPasswordForm.parentNode.insertBefore(errorDiv, resetPasswordForm);

        // Remove error after 5 seconds
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }
});

// Toggle password visibility
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

// Add styles
const style = document.createElement('style');
style.textContent = `
    .auth-subtitle {
        color: #6a6f73;
        font-size: 14px;
        margin-bottom: 20px;
        text-align: center;
    }

    .password-input-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6a6f73;
        cursor: pointer;
        padding: 5px;
        font-size: 18px;
        transition: color 0.3s;
    }

    .password-toggle:hover {
        color: #1c1d1f;
    }

    .password-input-wrapper input {
        padding-right: 45px;
    }

    .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #1c1d1f;
        margin-bottom: 8px;
        display: block;
    }

    .password-strength {
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .strength-meter {
        height: 4px;
        background-color: #e0e0e0;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 5px;
    }

    .strength-meter-fill {
        height: 100%;
        width: 0;
        transition: width 0.3s, background-color 0.3s;
        border-radius: 2px;
    }

    .strength-text {
        display: block;
        font-size: 12px;
        font-weight: 500;
    }

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

    .spinner-border {
        width: 1rem;
        height: 1rem;
        border-width: 0.15em;
    }
`;
document.head.appendChild(style);
