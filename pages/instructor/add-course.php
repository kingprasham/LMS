<?php
include('../../config.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/instructor-sidebar.php');

renderHead('Create New Course', ['css/dashboard.css', 'css/admin-courses.css', 'css/instructor-dashboard.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderInstructorSidebar('courses'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Create New Course</h1>
                <p class="dashboard-subtitle">Build your curriculum and share your knowledge</p>
            </div>
            <div class="header-actions">
                <a href="<?php echo url('pages/instructor/my-courses.php'); ?>" class="btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to My Courses
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
                    <span class="step-label">Details</span>
                </div>
                <div class="step-item" data-step="5">
                    <div class="step-number">5</div>
                    <span class="step-label">Publish</span>
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
                            <button type="button" class="btn-outline-primary btn-sm" id="addSectionBtn">
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
                                        <div class="lecture-drag"><i class="bi bi-grip-vertical"></i></div>
                                        <div class="lecture-icon"><i class="bi bi-play-circle-fill"></i></div>
                                        <div class="lecture-info">
                                            <input type="text" class="form-control form-control-sm" value="Welcome to the course" placeholder="Lecture Title">
                                        </div>
                                        <div class="lecture-meta">
                                            <select class="form-select form-select-sm" style="width: 100px;">
                                                <option value="video">Video</option>
                                                <option value="article">Article</option>
                                                <option value="quiz">Quiz</option>
                                            </select>
                                            <button type="button" class="btn-icon text-danger"><i class="bi bi-x"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary prev-step">Previous</button>
                        <button type="button" class="btn-primary next-step">Next: Details</button>
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
                        <button type="button" class="btn-primary next-step">Next: Publish</button>
                    </div>
                </div>

                <!-- Step 5: Settings -->
                <div class="form-step" id="step5">
                    <div class="form-section">
                        <h3 class="form-section-title">Publishing Settings</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Course Status</label>
                            <div class="radio-group">
                                <label class="radio-card">
                                    <input type="radio" name="status" value="draft" checked>
                                    <div class="radio-content">
                                        <span class="radio-title">Draft</span>
                                        <span class="radio-desc">Save as draft and publish later</span>
                                    </div>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="status" value="pending">
                                    <div class="radio-content">
                                        <span class="radio-title">Submit for Review</span>
                                        <span class="radio-desc">Submit to admin for approval</span>
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
/* Reusing admin course styles */
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
    const dropZone = document.getElementById('thumbnailUpload');
    const fileInput = dropZone.querySelector('input');
    const preview = dropZone.nextElementSibling;
    const removeBtn = preview.querySelector('.file-remove-btn');

    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.querySelector('img').src = e.target.result;
                preview.querySelector('.file-name').textContent = file.name;
                preview.querySelector('.file-size').textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                
                dropZone.style.display = 'none';
                preview.style.display = 'flex';
            }
            
            reader.readAsDataURL(file);
        }
    });

    removeBtn.addEventListener('click', () => {
        fileInput.value = '';
        preview.style.display = 'none';
        dropZone.style.display = 'block';
    });

    // Simple Curriculum Builder Logic (Demo)
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
        
        // Re-attach event listeners for new elements
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
                <div class="lecture-drag"><i class="bi bi-grip-vertical"></i></div>
                <div class="lecture-icon"><i class="bi bi-play-circle-fill"></i></div>
                <div class="lecture-info">
                    <input type="text" class="form-control form-control-sm" placeholder="Lecture Title">
                </div>
                <div class="lecture-meta">
                    <select class="form-select form-select-sm" style="width: 100px;">
                        <option value="video">Video</option>
                        <option value="article">Article</option>
                        <option value="quiz">Quiz</option>
                    </select>
                    <button type="button" class="btn-icon text-danger remove-lecture"><i class="bi bi-x"></i></button>
                </div>
            `;
            lectureList.appendChild(lecture);
            
            lecture.querySelector('.remove-lecture').addEventListener('click', () => lecture.remove());
        });
    }

    // Attach events to initial section
    document.querySelectorAll('.curriculum-section').forEach(attachSectionEvents);

    // Form Submission
    document.getElementById('addCourseForm').addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Course created successfully! (This is a static demo)');
        window.location.href = '<?php echo url('pages/instructor/my-courses.php'); ?>';
    });
});
</script>
