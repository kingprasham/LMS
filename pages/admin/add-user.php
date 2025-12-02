<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Add New User', ['css/dashboard.css', 'css/admin-users.css']);
renderNavbar();

// Get role from URL parameter (if provided)
$defaultRole = isset($_GET['role']) ? $_GET['role'] : 'student';
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('users'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Add New User</h1>
                <p class="dashboard-subtitle">Create a new student or employee account</p>
            </div>
            <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Form -->
        <div class="form-container fade-in-up" style="animation-delay: 0.1s">
            <form id="addUserForm" onsubmit="handleSubmit(event)">
                <!-- Role Selection -->
                <div class="form-section">
                    <h3 class="form-section-title">User Role</h3>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="role" value="student" <?php echo $defaultRole === 'student' ? 'checked' : ''; ?>>
                            <span>Student</span>
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="role" value="employee" <?php echo $defaultRole === 'employee' ? 'checked' : ''; ?>>
                            <span>Employee</span>
                        </label>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="form-section">
                    <h3 class="form-section-title">Personal Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" class="form-input" name="full_name" placeholder="Enter full name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-input" name="email" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-input" name="phone" placeholder="Enter phone number">
                        </div>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="form-section">
                    <h3 class="form-section-title">Account Settings</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Password *</label>
                            <input type="password" class="form-input" name="password" placeholder="Enter password" required minlength="8">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password *</label>
                            <input type="password" class="form-input" name="confirm_password" placeholder="Confirm password" required minlength="8">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Account Status</label>
                            <select class="form-select" name="status">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Employee-Specific Fields -->
                <div class="form-section" id="employeeFields" style="display: none;">
                    <h3 class="form-section-title">Employee Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            <select class="form-select" name="department">
                                <option value="">Select Department</option>
                                <option value="support">Support</option>
                                <option value="content">Content</option>
                                <option value="quality">Quality</option>
                                <option value="operations">Operations</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Position</label>
                            <input type="text" class="form-input" name="position" placeholder="Enter position/title">
                        </div>
                    </div>
                </div>

                <!-- Student-Specific Fields -->
                <div class="form-section" id="studentFields">
                    <h3 class="form-section-title">Student Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Student ID (Optional)</label>
                            <input type="text" class="form-input" name="student_id" placeholder="e.g., STD-2024-001">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Program / Major</label>
                            <input type="text" class="form-input" name="program" placeholder="e.g., Computer Science">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Academic Year</label>
                            <select class="form-select" name="academic_year">
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Enrollment Type</label>
                            <select class="form-select" name="enrollment_type">
                                <option value="individual">Individual</option>
                                <option value="corporate">Corporate</option>
                                <option value="academic">Academic</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Initial Courses Access</label>
                            <div class="course-selection-wrapper">
                                <div class="course-search-box">
                                    <i class="bi bi-search"></i>
                                    <input type="text" id="courseSearch" placeholder="Search courses..." class="form-control form-control-sm">
                                </div>
                                <div class="course-list-scroll">
                                    <label class="course-select-item">
                                        <input type="checkbox" name="courses[]" value="1">
                                        <div class="course-info">
                                            <span class="course-name">AI Fundamentals</span>
                                            <span class="course-cat">Artificial Intelligence</span>
                                        </div>
                                    </label>
                                    <label class="course-select-item">
                                        <input type="checkbox" name="courses[]" value="2">
                                        <div class="course-info">
                                            <span class="course-name">Web Development Bootcamp</span>
                                            <span class="course-cat">Web Development</span>
                                        </div>
                                    </label>
                                    <label class="course-select-item">
                                        <input type="checkbox" name="courses[]" value="3">
                                        <div class="course-info">
                                            <span class="course-name">Data Science Masterclass</span>
                                            <span class="course-cat">Data Science</span>
                                        </div>
                                    </label>
                                    <label class="course-select-item">
                                        <input type="checkbox" name="courses[]" value="4">
                                        <div class="course-info">
                                            <span class="course-name">Machine Learning Advanced</span>
                                            <span class="course-cat">Machine Learning</span>
                                        </div>
                                    </label>
                                    <label class="course-select-item">
                                        <input type="checkbox" name="courses[]" value="5">
                                        <div class="course-info">
                                            <span class="course-name">Cloud Computing Essentials</span>
                                            <span class="course-cat">Cloud Computing</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="selection-summary">
                                    <span id="selectedCount">0</span> courses selected
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="<?php echo url('pages/admin/users.php'); ?>" class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary">
                        <i class="bi bi-person-plus-fill" style="margin-right: 0.5rem;"></i>
                        Create Account
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<script>
// Toggle role-specific fields
const roleInputs = document.querySelectorAll('input[name="role"]');
const employeeFields = document.getElementById('employeeFields');
const studentFields = document.getElementById('studentFields');

function toggleRoleFields() {
    const selectedRole = document.querySelector('input[name="role"]:checked').value;
    
    if (selectedRole === 'employee') {
        employeeFields.style.display = 'block';
        studentFields.style.display = 'none';
    } else {
        employeeFields.style.display = 'none';
        studentFields.style.display = 'block';
    }
}

roleInputs.forEach(input => {
    input.addEventListener('change', toggleRoleFields);
});

// Initialize on page load
toggleRoleFields();

// Form validation and submission
function handleSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const password = form.password.value;
    const confirmPassword = form.confirm_password.value;
    
    // Validate passwords match
    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return false;
    }
    
    // Validate password strength
    if (password.length < 8) {
        alert('Password must be at least 8 characters long!');
        return false;
    }
    
    // Simulate form submission
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    
    console.log('Form data:', data);
    alert('User created successfully! (This is a static demo)\n\nName: ' + data.full_name + '\nEmail: ' + data.email + '\nRole: ' + data.role);
    
    // In a real scenario, this would redirect to users page
    // window.location.href = '<?php echo url('pages/admin/users.php'); ?>';
    
    return false;
}

// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const sidebar = document.getElementById('dashboardSidebar');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        }
    });

    // Course Search & Selection Logic
    const courseSearch = document.getElementById('courseSearch');
    const courseItems = document.querySelectorAll('.course-select-item');
    const selectedCountSpan = document.getElementById('selectedCount');
    const checkboxes = document.querySelectorAll('input[name="courses[]"]');

    if (courseSearch) {
        courseSearch.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            courseItems.forEach(item => {
                const name = item.querySelector('.course-name').textContent.toLowerCase();
                const cat = item.querySelector('.course-cat').textContent.toLowerCase();
                if (name.includes(term) || cat.includes(term)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    function updateSelectionCount() {
        const count = document.querySelectorAll('input[name="courses[]"]:checked').length;
        if (selectedCountSpan) {
            selectedCountSpan.textContent = count;
        }
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateSelectionCount);
    });
});
</script>
