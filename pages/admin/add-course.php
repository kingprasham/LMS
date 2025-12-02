<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

renderHead('Add New Course', ['css/dashboard.css', 'css/admin-courses.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('courses'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Create New Course</h1>
                <p class="dashboard-subtitle">Build a comprehensive course with curriculum and media</p>
            </div>
            <div class="header-actions">
                <a href="<?php echo url('pages/admin/courses.php'); ?>" class="btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Courses
                </a>
            </div>
        </div>

        <!-- Multi-step Form Container -->
        <div class="course-form-container fade-in-up" style="animation-delay: 0.1s">
            
            <!-- Step Indicators -->
            <div class="step-indicator">
                <div class="step-item active" data-step="1">
                    <div class="step-number">1</div>
                    <span class="step-label">Basic Info</span>
                </div>
                <div class="step-item" data-step="2">
                    <div class="step-number">2</div>
                    <span class="step-label">Media</span>
                </div>
                <div class="step-item" data-step="3">
                    <div class="step-number">3</div>
                    <span class="step-label">Curriculum</span>
                </div>
                <div class="step-item" data-step="4">
                    <div class="step-number">4</div>
                    <span class="step-label">Additional Info</span>
                </div>
                <div class="step-item" data-step="5">
                    <div class="step-number">5</div>
                    <span class="step-label">Settings</span>
                </div>
            </div>

            <form id="addCourseForm" class="admin-form">
                
                <!-- Step 1: Basic Information -->
                <div class="form-step active" id="step1">
                    <div class="form-section">
                        <h3 class="form-section-title">Course Basics</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Course Title <span class="required">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="e.g., Complete Web Development Bootcamp 2024" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subtitle</label>
                            <input type="text" class="form-control" name="subtitle" placeholder="e.g., Become a full-stack web developer with just one course">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Category <span class="required">*</span></label>
                                <select class="form-select" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="development">Development</option>
                                    <option value="business">Business</option>
                                    <option value="design">Design</option>
                                    <option value="marketing">Marketing</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Subcategory</label>
                                <select class="form-select" name="subcategory">
                                    <option value="">Select Subcategory</option>
                                    <option value="web-dev">Web Development</option>
                                    <option value="data-science">Data Science</option>
                                    <option value="mobile-dev">Mobile Development</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Level</label>
                                <select class="form-select" name="level">
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                    <option value="all">All Levels</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Language</label>
                                <select class="form-select" name="language">
                                    <option value="english">English</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="french">French</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Duration (Hours)</label>
                                <input type="number" class="form-control" name="duration" placeholder="e.g., 24.5">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn-primary next-step">Next: Media</button>
                    </div>
                </div>

                <!-- Step 2: Media -->
                <div class="form-step" id="step2">
                    <div class="form-section">
                        <h3 class="form-section-title">Course Media</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Course Thumbnail</label>
                            <div class="file-upload-area" id="thumbnailUpload">
                                <i class="bi bi-image file-upload-icon"></i>
                                <div class="file-upload-text">Drop your image here, or browse</div>
                                <div class="file-upload-hint">Supports: JPG, JPEG, PNG (Max 5MB)</div>
                                <input type="file" hidden accept="image/*">
                            </div>
                            <div class="file-preview" style="display: none;">
                                <img src="" alt="Preview">
                                <div class="file-info">
                                    <div class="file-name">thumbnail.jpg</div>
                                    <div class="file-size">2.4 MB</div>
                                </div>
                                <button type="button" class="file-remove-btn">Remove</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Promotional Video</label>
                            <div class="file-upload-area" id="promoVideoUpload">
                                <i class="bi bi-play-circle file-upload-icon"></i>
                                <div class="file-upload-text">Drop your video here, or browse</div>
                                <div class="file-upload-hint">Supports: MP4, WebM (Max 100MB)</div>
                                <input type="file" hidden accept="video/*">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary prev-step">Previous</button>
                        <button type="button" class="btn-primary next-step">Next: Curriculum</button>
                    </div>
                </div>

                <!-- Step 3: Curriculum -->
                <div class="form-step" id="step3">
                    <div class="form-section">
                        <div class="section-header-row">
                            <h3 class="form-section-title">Course Curriculum</h3>
                            <button type="button" class="btn-outline-primary btn-sm" id="addSectionBtn" style="background: #4f46e5; color: white; border: none; padding: 0.625rem 1.25rem; border-radius: 0.5rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-plus-lg"></i> Add Section
                            </button>
                        </div>

                        <div id="curriculumContainer">
                            <!-- Section Template (Hidden) -->
                            <div class="curriculum-section" id="sectionTemplate" style="display: none;">
                                <div class="section-header">
                                    <div class="drag-handle"><i class="bi bi-grip-vertical"></i></div>
                                    <div class="section-title-edit">
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Section Title">
                                    </div>
                                    <div class="section-actions">
                                        <button type="button" class="btn-icon add-lecture-btn" title="Add Lecture"><i class="bi bi-plus-circle"></i></button>
                                        <button type="button" class="btn-icon delete-section-btn" title="Delete Section"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                <div class="lecture-list">
                                    <!-- Lectures go here -->
                                </div>
                            </div>

                            <!-- Initial Section -->
                            <div class="curriculum-section">
                                <div class="section-header">
                                    <div class="drag-handle"><i class="bi bi-grip-vertical"></i></div>
                                    <div class="section-title-edit">
                                        <input type="text" class="form-control form-control-sm" value="Introduction" placeholder="Enter Section Title">
                                    </div>
                                    <div class="section-actions">
                                        <button type="button" class="btn-icon add-lecture-btn" title="Add Lecture"><i class="bi bi-plus-circle"></i></button>
                                        <button type="button" class="btn-icon delete-section-btn" title="Delete Section"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                <div class="lecture-list">
                                    <div class="lecture-item">
                                        <div class="lecture-header" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: #fff; border: 1px solid #e2e8f0; border-radius: 0.375rem 0.375rem 0 0;">
                                            <div class="lecture-drag"><i class="bi bi-grip-vertical"></i></div>
                                            <div class="lecture-icon"><i class="bi bi-play-circle-fill"></i></div>
                                            <div class="lecture-info" style="flex: 1;">
                                                <input type="text" class="form-control form-control-sm" value="Welcome to the course" placeholder="Lecture Title">
                                            </div>
                                            <div class="lecture-meta">
                                                <button type="button" class="btn-icon text-danger"><i class="bi bi-x"></i></button>
                                            </div>
                                        </div>
                                        <div class="lecture-content-options" style="padding: 1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 0.375rem 0.375rem; margin-bottom: 0.5rem;">
                                            <div class="content-type-selector" style="display: flex; gap: 1.5rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
                                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                                                    <input type="checkbox" class="content-check" value="video" style="width: 16px; height: 16px; accent-color: #4f46e5;">
                                                    Video
                                                </label>
                                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                                                    <input type="checkbox" class="content-check" value="article" style="width: 16px; height: 16px; accent-color: #4f46e5;">
                                                    Article
                                                </label>
                                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                                                    <input type="checkbox" class="content-check" value="quiz" style="width: 16px; height: 16px; accent-color: #4f46e5;">
                                                    Quiz
                                                </label>
                                            </div>
                                            <div class="dynamic-inputs"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary prev-step">Previous</button>
                        <button type="button" class="btn-primary next-step">Next: Additional Info</button>
                    </div>
                </div>

                <!-- Step 4: Additional Info -->
                <div class="form-step" id="step4">
                    <div class="form-section">
                        <h3 class="form-section-title">Course Details</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="6" placeholder="Detailed course description..."></textarea>
                            <small class="form-text">Supports basic HTML or Markdown</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">What you'll learn (One per line)</label>
                            <textarea class="form-control" name="outcomes" rows="4" placeholder="Build full-stack applications&#10;Master React and Node.js&#10;..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Requirements (One per line)</label>
                            <textarea class="form-control" name="requirements" rows="4" placeholder="Basic understanding of HTML/CSS&#10;A computer with internet access&#10;..."></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Price ($)</label>
                                <input type="number" class="form-control" name="price" placeholder="49.99">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Discount Price ($)</label>
                                <input type="number" class="form-control" name="discount_price" placeholder="19.99">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary prev-step">Previous</button>
                        <button type="button" class="btn-primary next-step">Next: Settings</button>
                    </div>
                </div>

                <!-- Step 5: Settings -->
                <div class="form-step" id="step5">
                    <div class="form-section">
                        <h3 class="form-section-title">Publishing Settings</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Instructor</label>
                            <select class="form-select" name="instructor">
                                <option value="1">John Doe (You)</option>
                                <option value="2">Jane Smith</option>
                                <option value="3">Mike Johnson</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Course Status</label>
                            <div class="radio-group">
                                <label class="radio-card">
                                    <input type="radio" name="status" value="draft" checked>
                                    <div class="radio-content">
                                        <span class="radio-title">Draft</span>
                                        <span class="radio-desc">Only visible to you and other admins</span>
                                    </div>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="status" value="published">
                                    <div class="radio-content">
                                        <span class="radio-title">Published</span>
                                        <span class="radio-desc">Visible to everyone and available for enrollment</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Enrollment Settings</label>
                            <div class="checkbox-group">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="certificate" checked>
                                    <span>Issue Certificate upon completion</span>
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="qna" checked>
                                    <span>Enable Q&A section</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary prev-step">Previous</button>
                        <button type="submit" class="btn-primary">Create Course</button>
                    </div>
                </div>

            </form>
        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<style>
/* Additional styles for the course builder */
.course-form-container {
    max-width: 900px;
    margin: 0 auto;
}

.admin-form {
    background: #fff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
}

.form-section {
    margin-bottom: 2rem;
}

.form-section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e2e8f0;
}

.form-row {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.col-md-6 { flex: 0 0 calc(50% - 0.75rem); }
.col-md-4 { flex: 0 0 calc(33.333% - 1rem); }

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #475569;
}

.required { color: #ef4444; }

.form-control, .form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #cbd5e1;
    border-radius: 0.5rem;
    font-size: 0.95rem;
    transition: all 0.2s;
}

.form-control:focus, .form-select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    outline: none;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
}

.btn-primary, .btn-secondary {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
}

.btn-primary {
    background: #4f46e5;
    color: white;
}

.btn-primary:hover { background: #4338ca; }

.btn-secondary {
    background: #f1f5f9;
    color: #475569;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-secondary:hover { background: #e2e8f0; }

/* Curriculum Builder Styles */
.curriculum-section {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    overflow: hidden;
}

.section-header {
    padding: 0.75rem 1rem;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    gap: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.section-title-edit { flex: 1; }

.lecture-list {
    padding: 0.5rem;
}

.lecture-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
}

.lecture-item:last-child { margin-bottom: 0; }

.lecture-info { flex: 1; }
.lecture-meta { display: flex; align-items: center; gap: 0.5rem; }

.btn-icon {
    background: none;
    border: none;
    cursor: pointer;
    color: #64748b;
    padding: 0.25rem;
    font-size: 1.1rem;
}

.btn-icon:hover { color: #4f46e5; }
.btn-icon.text-danger:hover { color: #ef4444; }

/* Radio Cards */
.radio-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.radio-card {
    position: relative;
    cursor: pointer;
}

.radio-card input {
    position: absolute;
    opacity: 0;
}

.radio-content {
    padding: 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

.radio-card input:checked + .radio-content {
    border-color: #4f46e5;
    background: #e0e7ff;
}

.radio-title {
    display: block;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.radio-desc {
    font-size: 0.85rem;
    color: #64748b;
}

/* Checkbox Group */
.checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
}

.checkbox-item input {
    width: 1.1rem;
    height: 1.1rem;
}

@media (max-width: 768px) {
    .form-row { flex-direction: column; gap: 1rem; }
    .col-md-6, .col-md-4 { flex: 1 1 100%; }
    .radio-group { grid-template-columns: 1fr; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Multi-step Form Logic
    const steps = document.querySelectorAll('.step-item');
    const formSteps = document.querySelectorAll('.form-step');
    const nextBtns = document.querySelectorAll('.next-step');
    const prevBtns = document.querySelectorAll('.prev-step');
    let currentStep = 1;

    function updateSteps(step) {
        // Update Indicators
        steps.forEach(s => {
            const stepNum = parseInt(s.dataset.step);
            s.classList.remove('active', 'completed');
            if (stepNum === step) {
                s.classList.add('active');
            } else if (stepNum < step) {
                s.classList.add('completed');
            }
        });

        // Update Form Sections
        formSteps.forEach(fs => {
            fs.classList.remove('active');
            if (fs.id === `step${step}`) {
                fs.classList.add('active');
            }
        });

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep < 5) {
                currentStep++;
                updateSteps(currentStep);
            }
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                updateSteps(currentStep);
            }
        });
    });

    // File Upload Preview Logic
    function setupFileUpload(areaId) {
        const dropZone = document.getElementById(areaId);
        if (!dropZone) return;

        const fileInput = dropZone.querySelector('input');
        // Check if preview element exists, if not create it or find it
        let preview = dropZone.nextElementSibling;
        if (!preview || !preview.classList.contains('file-preview')) {
             // If the next element isn't the preview, we might need to look elsewhere or it might be missing
             // For this specific implementation, we assume the structure is fixed as per HTML
        }
        
        const removeBtn = preview ? preview.querySelector('.file-remove-btn') : null;

        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFile(fileInput.files[0], preview, dropZone);
            }
        });

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                handleFile(this.files[0], preview, dropZone);
            }
        });

        if (removeBtn) {
            removeBtn.addEventListener('click', () => {
                fileInput.value = '';
                preview.style.display = 'none';
                dropZone.style.display = 'block';
            });
        }
    }

    function handleFile(file, preview, dropZone) {
        if (!preview) return;
        
        // Basic validation
        if (file.size > 100 * 1024 * 1024) { // 100MB limit
            alert('File is too large. Maximum size is 100MB.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = preview.querySelector('img');
            if (img && file.type.startsWith('image/')) {
                img.src = e.target.result;
                img.style.display = 'block';
            } else if (img) {
                // For non-image files (like video), maybe show a generic icon or hide the img
                img.style.display = 'none'; 
            }
            
            preview.querySelector('.file-name').textContent = file.name;
            preview.querySelector('.file-size').textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            
            dropZone.style.display = 'none';
            preview.style.display = 'flex';
        }
        reader.readAsDataURL(file);
    }

    setupFileUpload('thumbnailUpload');
    setupFileUpload('promoVideoUpload');


    // Curriculum Builder Logic
    const addSectionBtn = document.getElementById('addSectionBtn');
    const container = document.getElementById('curriculumContainer');

    addSectionBtn.addEventListener('click', () => {
        const newSection = document.createElement('div');
        newSection.className = 'curriculum-section';
        newSection.innerHTML = `
            <div class="section-header">
                <div class="drag-handle"><i class="bi bi-grip-vertical"></i></div>
                <div class="section-title-edit">
                    <input type="text" class="form-control form-control-sm" placeholder="Enter Section Title">
                </div>
                <div class="section-actions">
                    <button type="button" class="btn-icon add-lecture-btn" title="Add Lecture"><i class="bi bi-plus-circle"></i></button>
                    <button type="button" class="btn-icon delete-section-btn" title="Delete Section"><i class="bi bi-trash"></i></button>
                </div>
            </div>
            <div class="lecture-list"></div>
        `;
        container.appendChild(newSection);
        attachSectionEvents(newSection);
    });

    function attachSectionEvents(section) {
        const deleteBtn = section.querySelector('.delete-section-btn');
        const addLectureBtn = section.querySelector('.add-lecture-btn');
        const lectureList = section.querySelector('.lecture-list');

        deleteBtn.addEventListener('click', () => {
            if (confirm('Delete this section?')) section.remove();
        });

        addLectureBtn.addEventListener('click', () => {
            const lecture = document.createElement('div');
            lecture.className = 'lecture-item';
            lecture.innerHTML = `
                <div class="lecture-header" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: #fff; border: 1px solid #e2e8f0; border-radius: 0.375rem 0.375rem 0 0;">
                    <div class="lecture-drag"><i class="bi bi-grip-vertical"></i></div>
                    <div class="lecture-icon"><i class="bi bi-play-circle-fill"></i></div>
                    <div class="lecture-info" style="flex: 1;">
                        <input type="text" class="form-control form-control-sm" placeholder="Lecture Title">
                    </div>
                    <div class="lecture-meta">
                        <button type="button" class="btn-icon text-danger remove-lecture"><i class="bi bi-x"></i></button>
                    </div>
                </div>
                <div class="lecture-content-options" style="padding: 1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 0.375rem 0.375rem; margin-bottom: 0.5rem;">
                    <div class="content-type-selector" style="display: flex; gap: 1.5rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                            <input type="checkbox" class="content-check" value="video" style="width: 16px; height: 16px; accent-color: #4f46e5;"> Video
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                            <input type="checkbox" class="content-check" value="article" style="width: 16px; height: 16px; accent-color: #4f46e5;"> Article
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                            <input type="checkbox" class="content-check" value="quiz" style="width: 16px; height: 16px; accent-color: #4f46e5;"> Quiz
                        </label>
                    </div>
                    <div class="dynamic-inputs"></div>
                </div>
            `;
            lectureList.appendChild(lecture);
            
            lecture.querySelector('.remove-lecture').addEventListener('click', () => lecture.remove());
            
            // Handle Content Type Selection
            const checkboxes = lecture.querySelectorAll('.content-check');
            const dynamicInputs = lecture.querySelector('.dynamic-inputs');
            
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    renderDynamicInputs(dynamicInputs, checkboxes);
                });
            });
        });
    }

    function renderDynamicInputs(container, checkboxes) {
        container.innerHTML = ''; // Clear existing
        checkboxes.forEach(cb => {
            if (cb.checked) {
                const type = cb.value;
                const inputGroup = document.createElement('div');
                inputGroup.className = 'dynamic-input-group';
                inputGroup.style.cssText = 'background: #fff; padding: 1.25rem; border-radius: 0.5rem; border: 1px solid #e2e8f0; margin-bottom: 0.75rem;';
                
                if (type === 'video') {
                    inputGroup.innerHTML = `
                        <label class="dynamic-label" style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem; font-size: 0.9rem;">
                            <i class="bi bi-camera-video" style="color: #4f46e5; margin-right: 0.5rem;"></i>Video URL / Upload
                        </label>
                        <input type="text" class="form-control form-control-sm" placeholder="e.g., Vimeo URL or Upload ID" style="margin-bottom: 0.75rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <label style="font-size: 0.875rem; color: #64748b; margin: 0;">Duration:</label>
                            <input type="text" class="form-control form-control-sm" placeholder="10:00" style="width: 100px;">
                        </div>
                    `;
                } else if (type === 'article') {
                    inputGroup.innerHTML = `
                        <label class="dynamic-label" style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem; font-size: 0.9rem;">
                            <i class="bi bi-file-text" style="color: #4f46e5; margin-right: 0.5rem;"></i>Article Content
                        </label>
                        <textarea class="form-control form-control-sm" rows="4" placeholder="Paste article content or summary..."></textarea>
                    `;
                } else if (type === 'quiz') {
                    inputGroup.innerHTML = `
                        <label class="dynamic-label" style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem; font-size: 0.9rem;">
                            <i class="bi bi-question-circle" style="color: #4f46e5; margin-right: 0.5rem;"></i>Quiz Configuration
                        </label>
                        <button type="button" class="btn-outline-primary btn-sm" style="background: transparent; border: 2px solid #4f46e5; color: #4f46e5; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 600; cursor: pointer; width: 100%; transition: all 0.2s;" onmouseover="this.style.background='#4f46e5'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#4f46e5';">
                            Configure Quiz Questions
                        </button>
                    `;
                }
                container.appendChild(inputGroup);
            }
        });
    }

    // Attach events to initial section
    document.querySelectorAll('.curriculum-section').forEach(attachSectionEvents);

    // Form Submission
    document.getElementById('addCourseForm').addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Course created successfully! (This is a static demo)');
        window.location.href = '<?php echo url('pages/admin/courses.php'); ?>';
    });
});
</script>
