<?php
include('../../config.php');
include('../../includes/db_connect.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

// Fetch categories from database
$categories = [];
$result = $conn->query("SELECT category_id, name FROM categories ORDER BY name");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch instructors (admins and instructors)
$instructors = [];
$result = $conn->query("SELECT user_id, full_name, role FROM users WHERE role IN ('admin', 'instructor') ORDER BY full_name");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $instructors[] = $row;
    }
}

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
                                <select class="form-select" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                    <?php endforeach; ?>
                                    <?php if (empty($categories)): ?>
                                    <option value="" disabled>No categories - run seed_categories.php</option>
                                    <?php endif; ?>
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
                            <input type="text" class="form-control" name="thumbnail" placeholder="Paste image URL (e.g., https://images.unsplash.com/...)" style="margin-bottom: 0.75rem;">
                            <div class="file-upload-area" id="thumbnailUpload">
                                <i class="bi bi-image file-upload-icon"></i>
                                <div class="file-upload-text">Or drop your image here to upload</div>
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
                            <input type="text" class="form-control" name="promo_video_url" placeholder="Paste video URL (YouTube, Vimeo, etc.)" style="margin-bottom: 0.75rem;">
                            <div class="file-upload-area" id="promoVideoUpload">
                                <i class="bi bi-play-circle file-upload-icon"></i>
                                <div class="file-upload-text">Or drop your video here to upload</div>
                                <div class="file-upload-hint">Supports: MP4, WebM (Max 100MB)</div>
                                <input type="file" hidden accept="video/*">
                            </div>
                            <div class="file-preview video-preview" style="display: none;">
                                <div class="video-preview-icon"><i class="bi bi-film"></i></div>
                                <div class="file-info">
                                    <div class="file-name">video.mp4</div>
                                    <div class="file-size">10.5 MB</div>
                                </div>
                                <button type="button" class="file-remove-btn">Remove</button>
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
                                        <button type="button" class="btn-add-lecture add-lecture-btn" title="Add Lecture"><i class="bi bi-plus-circle"></i> Add Lecture</button>
                                        <button type="button" class="btn-icon delete-section-btn" title="Delete Section"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                <div class="lecture-list">
                                    <!-- Lectures go here -->
                                </div>
                            </div>

                            <!-- Empty State - Prompt user to add sections -->
                            <div class="curriculum-empty-state" id="curriculumEmptyState" style="text-align: center; padding: 3rem 1.5rem; background: #f8fafc; border: 2px dashed #e2e8f0; border-radius: 0.5rem;">
                                <i class="bi bi-collection-play" style="font-size: 3rem; color: #94a3b8; margin-bottom: 1rem; display: block;"></i>
                                <h4 style="color: #475569; margin-bottom: 0.5rem;">No sections yet</h4>
                                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">Click "Add Section" above to start building your curriculum</p>
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
                            <select class="form-select" name="instructor_id" required>
                                <?php foreach ($instructors as $inst): ?>
                                <option value="<?php echo $inst['user_id']; ?>"><?php echo htmlspecialchars($inst['full_name']); ?> (<?php echo ucfirst($inst['role']); ?>)</option>
                                <?php endforeach; ?>
                                <?php if (empty($instructors)): ?>
                                <option value="" disabled>No instructors found</option>
                                <?php endif; ?>
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

.btn-add-lecture {
    background: #e0e7ff;
    color: #4f46e5;
    border: none;
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    transition: all 0.2s;
}
.btn-add-lecture:hover {
    background: #4f46e5;
    color: white;
}

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

/* File Upload Area Styles */
.file-upload-area {
    border: 2px dashed #cbd5e1;
    border-radius: 0.5rem;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
}

.file-upload-area:hover,
.file-upload-area.dragover {
    border-color: #4f46e5;
    background: #f5f3ff;
}

.file-upload-icon {
    font-size: 2rem;
    color: #94a3b8;
    margin-bottom: 0.5rem;
}

.file-upload-text {
    color: #64748b;
    margin-bottom: 0.25rem;
}

.file-upload-hint {
    font-size: 0.8rem;
    color: #94a3b8;
}

/* File Preview Styles */
.file-preview {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    margin-top: 0.75rem;
}

.file-preview img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 0.375rem;
}

.file-preview .file-info {
    flex: 1;
}

.file-preview .file-name {
    font-weight: 500;
    color: #1e293b;
    word-break: break-word;
}

.file-preview .file-size {
    font-size: 0.85rem;
    color: #64748b;
}

.file-preview .file-remove-btn {
    background: #fee2e2;
    color: #dc2626;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}

.file-preview .file-remove-btn:hover {
    background: #fecaca;
}

/* Video Preview Specific Styles */
.video-preview .video-preview-icon {
    width: 80px;
    height: 60px;
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    border-radius: 0.375rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generic File Store to hold files in memory before upload
    // Must be declared before setupFileUpload is called
    const fileStore = {}; // Map inputId -> Array of File objects

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

        // Initialize fileStore for this upload area
        if (!fileStore[areaId]) fileStore[areaId] = [];

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
                // Store file in fileStore for later upload
                fileStore[areaId] = [e.dataTransfer.files[0]];
                handleFile(fileInput.files[0], preview, dropZone);
            }
        });

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                // Store file in fileStore for later upload
                fileStore[areaId] = [this.files[0]];
                handleFile(this.files[0], preview, dropZone);
            }
        });

        if (removeBtn) {
            removeBtn.addEventListener('click', () => {
                fileInput.value = '';
                // Clear fileStore when file is removed
                fileStore[areaId] = [];
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

        // Update file name and size
        const fileNameEl = preview.querySelector('.file-name');
        const fileSizeEl = preview.querySelector('.file-size');
        if (fileNameEl) fileNameEl.textContent = file.name;
        if (fileSizeEl) fileSizeEl.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

        const img = preview.querySelector('img');
        const videoIcon = preview.querySelector('.video-preview-icon');

        if (file.type.startsWith('image/') && img) {
            // For images, show preview thumbnail
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.style.display = 'block';
                if (videoIcon) videoIcon.style.display = 'none';
                dropZone.style.display = 'none';
                preview.style.display = 'flex';
            }
            reader.readAsDataURL(file);
        } else {
            // For videos and other files, just show icon (don't read the file)
            if (img) img.style.display = 'none';
            if (videoIcon) videoIcon.style.display = 'flex';
            dropZone.style.display = 'none';
            preview.style.display = 'flex';
        }
    }

    setupFileUpload('thumbnailUpload');
    setupFileUpload('promoVideoUpload');


    // Curriculum Builder Logic
    const addSectionBtn = document.getElementById('addSectionBtn');
    const container = document.getElementById('curriculumContainer');

    addSectionBtn.addEventListener('click', () => {
        // Hide empty state message if visible
        const emptyState = document.getElementById('curriculumEmptyState');
        if (emptyState) emptyState.style.display = 'none';
        
        const newSection = document.createElement('div');
        newSection.className = 'curriculum-section';
        newSection.innerHTML = `
            <div class="section-header">
                <div class="drag-handle"><i class="bi bi-grip-vertical"></i></div>
                <div class="section-title-edit">
                    <input type="text" class="form-control form-control-sm curriculum-section-title" placeholder="Enter Section Title">
                </div>
                <div class="section-actions">
                    <button type="button" class="btn-add-lecture add-lecture-btn" title="Add Lecture">
                        <i class="bi bi-plus-circle"></i> Add Lecture
                    </button>
                    <button type="button" class="btn-icon delete-section-btn" title="Delete Section"><i class="bi bi-trash"></i></button>
                </div>
            </div>
            <div class="lecture-list"></div>
        `;
        container.appendChild(newSection);
        attachSectionEvents(newSection);
    });

    function attachLectureEvents(lecture) {
        // Handle remove button
        const removeBtn = lecture.querySelector('.remove-lecture') || lecture.querySelector('.btn-icon.text-danger');
        if (removeBtn) {
            removeBtn.addEventListener('click', () => lecture.remove());
        }
        
        // Handle Content Type Selection for checkboxes
        const checkboxes = lecture.querySelectorAll('.content-check');
        const dynamicInputs = lecture.querySelector('.dynamic-inputs');
        
        if (checkboxes.length > 0 && dynamicInputs) {
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    renderDynamicInputs(dynamicInputs, checkboxes);
                });
            });
        }
    }

    function attachSectionEvents(section) {
        // Skip the template section
        if (section.id === 'sectionTemplate') return;
        
        const deleteBtn = section.querySelector('.delete-section-btn');
        const addLectureBtn = section.querySelector('.add-lecture-btn');
        const lectureList = section.querySelector('.lecture-list');

        deleteBtn.addEventListener('click', () => {
            if (confirm('Delete this section?')) section.remove();
        });
        
        // Attach events to existing lectures in this section
        section.querySelectorAll('.lecture-item').forEach(lecture => {
            attachLectureEvents(lecture);
        });

        addLectureBtn.addEventListener('click', () => {
            const lecture = document.createElement('div');
            lecture.className = 'lecture-item curriculum-lecture';
            lecture.innerHTML = `
                <div class="lecture-header" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: #fff; border: 1px solid #e2e8f0; border-radius: 0.375rem 0.375rem 0 0;">
                    <div class="lecture-drag"><i class="bi bi-grip-vertical"></i></div>
                    <div class="lecture-icon"><i class="bi bi-play-circle-fill"></i></div>
                    <div class="lecture-info" style="flex: 1;">
                        <input type="text" class="form-control form-control-sm lecture-title" placeholder="Lecture Title">
                    </div>
                    <div class="lecture-meta">
                        <button type="button" class="btn-icon text-danger remove-lecture"><i class="bi bi-x"></i></button>
                    </div>
                </div>
                <div class="lecture-content-options" style="padding: 1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 0.375rem 0.375rem; margin-bottom: 0.5rem;">
                    <div class="content-type-selector" style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                            <input type="checkbox" class="content-check" value="video" style="width: 16px; height: 16px; accent-color: #4f46e5;"> Video
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                            <input type="checkbox" class="content-check" value="article" style="width: 16px; height: 16px; accent-color: #4f46e5;"> Article
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                            <input type="checkbox" class="content-check" value="quiz" style="width: 16px; height: 16px; accent-color: #4f46e5;"> Quiz
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                            <input type="checkbox" class="content-check" value="resources" style="width: 16px; height: 16px; accent-color: #4f46e5;"> Resources
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #475569;">
                            <input type="checkbox" class="content-check" value="notes" style="width: 16px; height: 16px; accent-color: #4f46e5;"> Notes
                        </label>
                    </div>
                    <div class="dynamic-inputs"></div>
                </div>
            `;
            lectureList.appendChild(lecture);
            
            // Attach events to the new lecture
            attachLectureEvents(lecture);
        });
    }

    function renderDynamicInputs(container, checkboxes) {
        container.innerHTML = ''; // Clear existing
        checkboxes.forEach(cb => {
            if (cb.checked) {
                const type = cb.value;
                const inputGroup = document.createElement('div');
                inputGroup.className = 'dynamic-input-group';
                inputGroup.dataset.type = type;
                inputGroup.style.cssText = 'background: #fff; padding: 1.25rem; border-radius: 0.5rem; border: 1px solid #e2e8f0; margin-bottom: 0.75rem;';
                
                if (type === 'video') {
                    inputGroup.innerHTML = `
                        <label class="dynamic-label" style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem; font-size: 0.9rem;">
                            <i class="bi bi-camera-video" style="color: #4f46e5; margin-right: 0.5rem;"></i>Video URL / Upload
                        </label>
                        <input type="text" class="form-control form-control-sm video-url-input" name="video_url" placeholder="Paste video URL (YouTube, Vimeo, etc.)" style="margin-bottom: 0.75rem;">
                        <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <label style="font-size: 0.875rem; color: #64748b; margin: 0;">Duration:</label>
                                <input type="text" class="form-control form-control-sm video-duration-input" name="video_duration" placeholder="10:30" style="width: 80px;">
                            </div>
                            <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: #64748b; cursor: pointer;">
                                <input type="checkbox" class="is-preview-check" name="is_preview" style="accent-color: #4f46e5;">
                                Free Preview
                            </label>
                        </div>
                    `;
                } else if (type === 'article') {
                    inputGroup.innerHTML = `
                        <label class="dynamic-label" style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem; font-size: 0.9rem;">
                            <i class="bi bi-file-text" style="color: #4f46e5; margin-right: 0.5rem;"></i>Article Content
                        </label>
                        <textarea class="form-control form-control-sm article-content-input" name="article_content" rows="6" placeholder="Write your article content here... HTML formatting is supported."></textarea>
                    `;
                } else if (type === 'quiz') {
                    const quizId = 'quiz_' + Date.now();
                    inputGroup.innerHTML = `
                        <label class="dynamic-label" style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem; font-size: 0.9rem;">
                            <i class="bi bi-question-circle" style="color: #4f46e5; margin-right: 0.5rem;"></i>Quiz Questions
                        </label>
                        <div class="quiz-questions-container" id="${quizId}" style="margin-bottom: 0.75rem;"></div>
                        <button type="button" class="add-quiz-question-btn" data-quiz-id="${quizId}" style="background: #4f46e5; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem;">
                            <i class="bi bi-plus-circle"></i> Add Question
                        </button>
                    `;
                    // Attach quiz event after appending
                    setTimeout(() => {
                        const addBtn = inputGroup.querySelector('.add-quiz-question-btn');
                        const questionsContainer = inputGroup.querySelector('.quiz-questions-container');
                        if (addBtn && questionsContainer) {
                            addBtn.addEventListener('click', () => addQuizQuestion(questionsContainer));
                        }
                    }, 0);
                } else if (type === 'resources') {
                    const resourceId = 'resource_' + Date.now();
                    inputGroup.innerHTML = `
                        <label class="dynamic-label" style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem; font-size: 0.9rem;">
                            <i class="bi bi-folder" style="color: #4f46e5; margin-right: 0.5rem;"></i>Downloadable Resources
                        </label>
                        <input type="file" class="resource-file-input" id="${resourceId}" multiple accept=".pdf,.doc,.docx,.zip,.rar,.ppt,.pptx,.xls,.xlsx,.txt" style="display: none;">
                        <div class="resource-upload-area" data-input-id="${resourceId}" style="border: 2px dashed #e2e8f0; border-radius: 0.5rem; padding: 1.5rem; text-align: center; cursor: pointer; transition: all 0.2s;">
                            <i class="bi bi-cloud-upload" style="font-size: 1.5rem; color: #64748b; display: block; margin-bottom: 0.5rem;"></i>
                            <span style="font-size: 0.875rem; color: #64748b;">Click to select files or drag & drop</span>
                            <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem;">PDF, DOC, ZIP, PPT, etc. (Max 50MB each)</div>
                        </div>
                        <div class="resource-file-list" style="margin-top: 0.75rem;"></div>
                        <input type="text" class="form-control form-control-sm resource-link-input" name="resource_link" placeholder="Or paste external link (Google Drive, Dropbox)" style="margin-top: 0.75rem;">
                    `;
                    // Attach file upload events
                    setTimeout(() => {
                        const fileInput = inputGroup.querySelector('.resource-file-input');
                        const uploadArea = inputGroup.querySelector('.resource-upload-area');
                        const fileList = inputGroup.querySelector('.resource-file-list');
                        if (fileInput && uploadArea && fileList) {
                            setupDynamicFileUpload(fileInput, uploadArea, fileList, 'resource');
                        }
                    }, 0);
                } else if (type === 'notes') {
                    const notesId = 'notes_' + Date.now();
                    inputGroup.innerHTML = `
                        <label class="dynamic-label" style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem; font-size: 0.9rem;">
                            <i class="bi bi-journal-text" style="color: #4f46e5; margin-right: 0.5rem;"></i>Lecture Notes
                        </label>
                        <textarea class="form-control form-control-sm notes-content-input" name="notes_content" rows="5" placeholder="Add detailed notes for this lecture... Markdown formatting is supported."></textarea>
                        <div style="display: flex; gap: 0.5rem; margin-top: 0.75rem; flex-wrap: wrap;">
                            <input type="file" class="notes-file-input" id="${notesId}" accept=".pdf,.doc,.docx,.txt,.md" style="display: none;">
                            <div class="notes-upload-area" data-input-id="${notesId}" style="flex: 1; min-width: 200px; border: 2px dashed #e2e8f0; border-radius: 0.5rem; padding: 1rem; text-align: center; cursor: pointer; transition: all 0.2s;">
                                <i class="bi bi-file-earmark-pdf" style="color: #64748b; margin-right: 0.25rem;"></i>
                                <span style="font-size: 0.8rem; color: #64748b;">Upload PDF/DOC Notes</span>
                            </div>
                        </div>
                        <div class="notes-file-list" style="margin-top: 0.5rem;"></div>
                    `;
                    // Attach file upload events
                    setTimeout(() => {
                        const fileInput = inputGroup.querySelector('.notes-file-input');
                        const uploadArea = inputGroup.querySelector('.notes-upload-area');
                        const fileList = inputGroup.querySelector('.notes-file-list');
                        if (fileInput && uploadArea && fileList) {
                            setupDynamicFileUpload(fileInput, uploadArea, fileList, 'notes');
                        }
                    }, 0);
                }
                container.appendChild(inputGroup);
            }
        });
    }

    // fileStore is now declared at the top of DOMContentLoaded

    // Helper: Upload a single file
    async function uploadFile(file, type = 'auto') {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('type', type);
        
        try {
            const response = await fetch('<?php echo url('api/upload.php'); ?>', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                return result.data; // { path: '...', url: '...', name: '...', size: ..., type: ... }
            } else {
                console.error('Upload failed:', result.error);
                return null;
            }
        } catch (error) {
            console.error('Upload error:', error);
            return null;
        }
    }

    // Helper: Setup dynamic file upload for resources/notes
    function setupDynamicFileUpload(fileInput, uploadArea, fileListContainer, type) {
        const inputId = fileInput.id;
        if (!fileStore[inputId]) fileStore[inputId] = [];
        
        uploadArea.addEventListener('click', () => fileInput.click());
        
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#4f46e5';
            uploadArea.style.background = '#f5f3ff';
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = 'transparent';
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = 'transparent';
            const files = Array.from(e.dataTransfer.files);
            addFilesToStore(inputId, files, fileListContainer, type);
        });
        
        fileInput.addEventListener('change', () => {
            const files = Array.from(fileInput.files);
            addFilesToStore(inputId, files, fileListContainer, type);
            fileInput.value = ''; // Reset to allow re-selecting same file
        });
    }

    function addFilesToStore(inputId, files, container, type) {
        // If single file type (notes), clear previous
        if (type === 'notes') {
            fileStore[inputId] = files.slice(0, 1);
        } else {
            // Append
            fileStore[inputId] = [...fileStore[inputId], ...files];
        }
        renderFileList(inputId, container, type);
    }

    // Helper: Handle selected files display
    function renderFileList(inputId, container, type) {
        container.innerHTML = '';
        const files = fileStore[inputId] || [];
        
        files.forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'selected-file-item';
            fileItem.style.cssText = 'display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.375rem; margin-bottom: 0.5rem;';
            
            const icon = type === 'notes' ? 'bi-file-earmark-text' : 'bi-file-earmark';
            const sizeStr = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            
            fileItem.innerHTML = `
                <i class="bi ${icon}" style="color: #4f46e5;"></i>
                <div style="flex: 1; overflow: hidden;">
                    <div style="font-size: 0.875rem; font-weight: 500; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${file.name}</div>
                    <div style="font-size: 0.75rem; color: #64748b;">${sizeStr}</div>
                </div>
                <button type="button" class="remove-file-btn" data-index="${index}" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0.25rem;">
                    <i class="bi bi-x-circle"></i>
                </button>
            `;
            
            fileItem.querySelector('.remove-file-btn').addEventListener('click', (e) => {
                const idx = parseInt(e.currentTarget.dataset.index);
                fileStore[inputId].splice(idx, 1);
                renderFileList(inputId, container, type);
            });
            container.appendChild(fileItem);
        });
    }

    // Helper: Add quiz question
    function addQuizQuestion(container) {
        const questionNum = container.querySelectorAll('.quiz-question-item').length + 1;
        const questionItem = document.createElement('div');
        questionItem.className = 'quiz-question-item';
        questionItem.style.cssText = 'background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 1rem; margin-bottom: 0.75rem;';
        
        questionItem.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                <label style="font-weight: 600; color: #1e293b; font-size: 0.9rem;">Question ${questionNum}</label>
                <button type="button" class="remove-question-btn" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0.25rem;">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <input type="text" class="form-control form-control-sm quiz-question-text" placeholder="Enter your question" style="margin-bottom: 0.75rem;">
            <div class="quiz-options" style="display: flex; flex-direction: column; gap: 0.5rem;">
                <div class="quiz-option" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="radio" name="correct_${Date.now()}" class="correct-answer-radio" style="accent-color: #10b981;">
                    <input type="text" class="form-control form-control-sm quiz-option-text" placeholder="Option A" style="flex: 1;">
                </div>
                <div class="quiz-option" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="radio" name="correct_${Date.now()}" class="correct-answer-radio" style="accent-color: #10b981;">
                    <input type="text" class="form-control form-control-sm quiz-option-text" placeholder="Option B" style="flex: 1;">
                </div>
                <div class="quiz-option" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="radio" name="correct_${Date.now()}" class="correct-answer-radio" style="accent-color: #10b981;">
                    <input type="text" class="form-control form-control-sm quiz-option-text" placeholder="Option C" style="flex: 1;">
                </div>
                <div class="quiz-option" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="radio" name="correct_${Date.now()}" class="correct-answer-radio" style="accent-color: #10b981;">
                    <input type="text" class="form-control form-control-sm quiz-option-text" placeholder="Option D" style="flex: 1;">
                </div>
            </div>
            <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.5rem;">
                <i class="bi bi-info-circle"></i> Select the radio button next to the correct answer
            </div>
        `;
        
        questionItem.querySelector('.remove-question-btn').addEventListener('click', () => {
            questionItem.remove();
            // Renumber remaining questions
            container.querySelectorAll('.quiz-question-item').forEach((item, idx) => {
                item.querySelector('label').textContent = 'Question ' + (idx + 1);
            });
        });
        
        container.appendChild(questionItem);
    }

    // Attach events to initial section
    document.querySelectorAll('.curriculum-section').forEach(attachSectionEvents);

    // Note: Static file uploads (Thumbnail & Promo) are handled by setupFileUpload() above
    // which properly stores files in fileStore for later upload

    // Form Submission
    document.getElementById('addCourseForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const form = e.target;
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Uploading Media...';
        
        try {
            // 1. Upload Static Files (Thumbnail/Promo)
            let thumbnailUrl = form.querySelector('[name="thumbnail"]')?.value || '';
            console.log('Thumbnail fileStore:', fileStore['thumbnailUpload']);
            if (fileStore['thumbnailUpload'] && fileStore['thumbnailUpload'].length > 0) {
                console.log('Uploading thumbnail:', fileStore['thumbnailUpload'][0].name);
                const uploaded = await uploadFile(fileStore['thumbnailUpload'][0], 'image');
                console.log('Thumbnail upload result:', uploaded);
                if (uploaded) thumbnailUrl = uploaded.path;
            }

            let promoUrl = form.querySelector('[name="promo_video_url"]')?.value || '';
            console.log('Promo fileStore:', fileStore['promoVideoUpload']);
            if (fileStore['promoVideoUpload'] && fileStore['promoVideoUpload'].length > 0) {
                console.log('Uploading promo video:', fileStore['promoVideoUpload'][0].name);
                const uploaded = await uploadFile(fileStore['promoVideoUpload'][0], 'video');
                console.log('Promo video upload result:', uploaded);
                if (uploaded) promoUrl = uploaded.path;
            }
            console.log('Final thumbnailUrl:', thumbnailUrl);
            console.log('Final promoUrl:', promoUrl);

            // 2. Process Curriculum (Sections & Lectures)
            const sections = [];
            const sectionEls = document.querySelectorAll('.curriculum-section:not(#sectionTemplate)');
            
            for (let i = 0; i < sectionEls.length; i++) {
                const sectionEl = sectionEls[i];
                // Skip hidden template sections
                if (sectionEl.style.display === 'none' || sectionEl.id === 'sectionTemplate') continue;
                
                const sectionTitleInput = sectionEl.querySelector('.curriculum-section-title');
                const sectionTitle = sectionTitleInput?.value?.trim();
                
                // Skip sections without a title - user must provide one
                if (!sectionTitle) continue;
                
                const lectures = [];
                const lectureEls = sectionEl.querySelectorAll('.curriculum-lecture');
                
                for (let j = 0; j < lectureEls.length; j++) {
                    const lectureEl = lectureEls[j];
                    let lectureTitle = lectureEl.querySelector('.lecture-title')?.value || 'Lecture ' + (j + 1);
                    const isPreview = lectureEl.querySelector('.is-preview-check')?.checked || false;
                    
                    // Determine content based on checked inputs
                    const checks = lectureEl.querySelectorAll('.content-check:checked');
                    let videoUrl = lectureEl.querySelector('.video-url-input')?.value || '';
                    let videoDuration = lectureEl.querySelector('.video-duration-input')?.value || '';
                    let description = '';
                    const resources = []; // { name, path, type, size }

                    // Process Video
                    // (already grabbed videoUrl)
                    
                    // Process Article
                    const articleInput = lectureEl.querySelector('.article-content-input');
                    if (articleInput) {
                         // Append article content to description
                         description += "<!-- ARTICLE -->\n" + articleInput.value + "\n";
                    }

                    // Process Quiz
                    const quizContainer = lectureEl.querySelector('.quiz-questions-container');
                    if (quizContainer) {
                        const questions = [];
                        quizContainer.querySelectorAll('.quiz-question-item').forEach(qItem => {
                            const qText = qItem.querySelector('.quiz-question-text')?.value;
                            const options = [];
                            let correctIndex = -1;
                            qItem.querySelectorAll('.quiz-option').forEach((opt, idx) => {
                                const optText = opt.querySelector('.quiz-option-text')?.value;
                                const isCorrect = opt.querySelector('input[type="radio"]')?.checked;
                                options.push(optText || '');
                                if (isCorrect) correctIndex = idx;
                            });
                            if (qText) {
                                questions.push({ question: qText, options, correctIndex });
                            }
                        });
                        if (questions.length > 0) {
                            description = JSON.stringify({ type: 'quiz', questions: questions }); // Override description for Quiz
                            lectureTitle = lectureTitle.startsWith('Lecture') ? 'Quiz: ' + lectureTitle : lectureTitle; // Auto-prefix
                        }
                    }

                    // Process Resources
                    const resourceInput = lectureEl.querySelector('.resource-file-input');
                    if (resourceInput && fileStore[resourceInput.id]) {
                        submitBtn.textContent = `Uploading Resources (${i+1}/${sectionEls.length})...`;
                        for (const file of fileStore[resourceInput.id]) {
                            const uploaded = await uploadFile(file, 'document');
                            if (uploaded) {
                                resources.push({
                                    name: file.name,
                                    path: uploaded.path,
                                    type: 'file',
                                    size: file.size
                                });
                            }
                        }
                    }

                    // Process Notes (Upload PDF + Text)
                    const notesText = lectureEl.querySelector('.notes-content-input')?.value;
                    if (notesText) {
                        description += "\n<!-- NOTES -->\n" + notesText;
                    }
                    
                    const notesInput = lectureEl.querySelector('.notes-file-input');
                    if (notesInput && fileStore[notesInput.id]) {
                        for (const file of fileStore[notesInput.id]) {
                            const uploaded = await uploadFile(file, 'document');
                            if (uploaded) {
                                resources.push({
                                    name: "Notes: " + file.name,
                                    path: uploaded.path,
                                    type: 'note',
                                    size: file.size
                                });
                            }
                        }
                    }

                    lectures.push({
                        title: lectureTitle,
                        video_url: videoUrl,
                        duration: videoDuration,
                        description: description,
                        is_preview: isPreview,
                        resources: resources
                    });
                }
                
                sections.push({
                    title: sectionTitle,
                    lectures: lectures
                });
            }

            submitBtn.textContent = 'Creating Course...';

            // Collect form data
            const formData = {
                title: form.querySelector('[name="title"]').value,
                subtitle: form.querySelector('[name="subtitle"]')?.value || '',
                category_id: form.querySelector('[name="category_id"]').value,
                instructor_id: form.querySelector('[name="instructor_id"]').value,
                level: form.querySelector('[name="level"]')?.value || 'beginner',
                language: form.querySelector('[name="language"]')?.value || 'English',
                description: form.querySelector('[name="description"]')?.value || '',
                thumbnail: thumbnailUrl,
                promo_video_url: promoUrl,
                price: parseFloat(form.querySelector('[name="price"]')?.value) || 0,
                original_price: parseFloat(form.querySelector('[name="discount_price"]')?.value) || null,
                outcomes: form.querySelector('[name="outcomes"]')?.value || '',
                requirements: form.querySelector('[name="requirements"]')?.value || '',
                status: form.querySelector('[name="status"]:checked')?.value || 'draft',
                sections: sections
            };
            
            const response = await fetch('<?php echo url('api/admin/courses/create.php'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Course created successfully!');
                window.location.href = '<?php echo url('pages/admin/courses.php'); ?>';
            } else {
                throw new Error(result.error || 'Failed to create course');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error: ' + error.message);
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        }
    });
});
</script>
