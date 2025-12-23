<?php
include('../../config.php');
include('../../includes/db_connect.php');
include('../../components/head.php');
include('../../components/navbar.php');
include('../../components/footer.php');
include('../../components/scripts.php');
include('../../components/admin-sidebar.php');

// Get course ID
$course_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$course_id) {
    header('Location: ' . url('pages/admin/courses.php'));
    exit;
}

// Fetch course from database
$stmt = $conn->prepare("SELECT c.*, cat.name as category_name, u.full_name as instructor_name 
    FROM courses c 
    LEFT JOIN categories cat ON c.category_id = cat.category_id 
    LEFT JOIN users u ON c.instructor_id = u.user_id 
    WHERE c.course_id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: ' . url('pages/admin/courses.php'));
    exit;
}

$course = $result->fetch_assoc();

// Fetch categories
$categories = [];
$catResult = $conn->query("SELECT category_id, name FROM categories ORDER BY name");
if ($catResult) {
    while ($row = $catResult->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch instructors
$instructors = [];
$instResult = $conn->query("SELECT user_id, full_name, role FROM users WHERE role IN ('admin', 'instructor') ORDER BY full_name");
if ($instResult) {
    while ($row = $instResult->fetch_assoc()) {
        $instructors[] = $row;
    }
}

// Fetch sections with videos
$sections = [];
$sectResult = $conn->prepare("SELECT * FROM course_sections WHERE course_id = ? ORDER BY position");
$sectResult->bind_param("i", $course_id);
$sectResult->execute();
$sectionsResult = $sectResult->get_result();
while ($section = $sectionsResult->fetch_assoc()) {
    $videoStmt = $conn->prepare("SELECT * FROM videos WHERE section_id = ? ORDER BY position");
    $videoStmt->bind_param("i", $section['section_id']);
    $videoStmt->execute();
    $videosResult = $videoStmt->get_result();
    $videos = [];
    while ($video = $videosResult->fetch_assoc()) {
        $videos[] = $video;
    }
    $section['videos'] = $videos;
    $sections[] = $section;
}

renderHead('Edit Course - ' . htmlspecialchars($course['title']), ['css/dashboard.css', 'css/admin-courses.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <?php renderAdminSidebar('courses'); ?>

    <main class="dashboard-main" id="dashboardMain">
        <!-- Header -->
        <div class="dashboard-header fade-in-up">
            <div class="header-content">
                <h1 class="dashboard-title">Edit Course</h1>
                <p class="dashboard-subtitle"><?php echo htmlspecialchars($course['title']); ?></p>
            </div>
            <div class="header-actions">
                <a href="<?php echo url('pages/course-detail.php?id=' . $course_id); ?>" class="btn-secondary" target="_blank">
                    <i class="bi bi-eye"></i> Preview
                </a>
                <a href="<?php echo url('pages/admin/courses.php'); ?>" class="btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="edit-tabs fade-in-up" style="animation-delay: 0.1s">
            <button class="edit-tab active" data-tab="basic">Basic Info</button>
            <button class="edit-tab" data-tab="curriculum">Curriculum</button>
            <button class="edit-tab" data-tab="media">Media</button>
            <button class="edit-tab" data-tab="pricing">Pricing</button>
            <button class="edit-tab" data-tab="settings">Settings</button>
        </div>

        <!-- Tab Content -->
        <div class="edit-tab-content">
            
            <!-- Basic Info Tab -->
            <div class="tab-panel active" id="tab-basic">
                <form id="basicInfoForm" class="admin-form">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    
                    <div class="form-section">
                        <div class="form-group">
                            <label class="form-label">Course Title <span class="required">*</span></label>
                            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subtitle / Tagline</label>
                            <input type="text" class="form-control" name="subtitle" value="<?php echo htmlspecialchars($course['subtitle'] ?? ''); ?>">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category_id">
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo $course['category_id'] == $cat['category_id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($cat['name']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Instructor</label>
                                <select class="form-select" name="instructor_id">
                                    <?php foreach ($instructors as $inst): ?>
                                    <option value="<?php echo $inst['user_id']; ?>" <?php echo $course['instructor_id'] == $inst['user_id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($inst['full_name']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="6"><?php echo htmlspecialchars($course['description'] ?? ''); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Level</label>
                            <select class="form-select" name="level">
                                <option value="beginner" <?php echo $course['level'] == 'beginner' ? 'selected' : ''; ?>>Beginner</option>
                                <option value="intermediate" <?php echo $course['level'] == 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                <option value="advanced" <?php echo $course['level'] == 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- Curriculum Tab -->
            <div class="tab-panel" id="tab-curriculum">
                <div class="curriculum-editor">
                    <div class="curriculum-header">
                        <h3>Course Curriculum</h3>
                        <button type="button" class="btn-primary" id="addSectionBtn">
                            <i class="bi bi-plus-lg"></i> Add Section
                        </button>
                    </div>

                    <div id="sectionsContainer">
                        <?php if (empty($sections)): ?>
                        <div class="empty-curriculum" id="emptyCurriculum">
                            <i class="bi bi-collection-play"></i>
                            <p>No sections yet. Click "Add Section" to start building your curriculum.</p>
                        </div>
                        <?php else: ?>
                            <?php foreach ($sections as $sIndex => $section): ?>
                            <div class="curriculum-section" data-section-id="<?php echo $section['section_id']; ?>">
                                <div class="section-header">
                                    <div class="section-drag"><i class="bi bi-grip-vertical"></i></div>
                                    <input type="text" class="section-title-input" value="<?php echo htmlspecialchars($section['title']); ?>" data-original="<?php echo htmlspecialchars($section['title']); ?>">
                                    <div class="section-actions">
                                        <button type="button" class="btn-icon save-section-btn" title="Save"><i class="bi bi-check-lg"></i></button>
                                        <button type="button" class="btn-icon add-video-btn" title="Add Video"><i class="bi bi-plus-circle"></i></button>
                                        <button type="button" class="btn-icon delete-section-btn" title="Delete Section"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                <div class="videos-list">
                                    <?php foreach ($section['videos'] as $video): ?>
                                    <div class="video-item" data-video-id="<?php echo $video['video_id']; ?>" data-description="<?php echo htmlspecialchars($video['description'] ?? ''); ?>">
                                        <div class="video-drag"><i class="bi bi-grip-vertical"></i></div>
                                        <i class="bi bi-play-circle-fill video-icon"></i>
                                        <input type="text" class="video-title-input" value="<?php echo htmlspecialchars($video['title']); ?>">
                                        <input type="text" class="video-url-input" value="<?php echo htmlspecialchars($video['video_url'] ?? ''); ?>" placeholder="Video URL">
                                        <input type="number" class="video-duration-input" value="<?php echo $video['duration_minutes']; ?>" placeholder="Min" style="width: 60px;">
                                        <label class="preview-checkbox">
                                            <input type="checkbox" class="video-preview-check" <?php echo $video['is_preview'] ? 'checked' : ''; ?>>
                                            <span>Preview</span>
                                        </label>
                                        <button type="button" class="btn-icon edit-content-btn" title="Edit Quiz/Article/Resources"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn-icon save-video-btn" title="Save"><i class="bi bi-check-lg"></i></button>
                                        <button type="button" class="btn-icon delete-video-btn" title="Delete"><i class="bi bi-x-lg"></i></button>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Media Tab -->
            <div class="tab-panel" id="tab-media">
                <form id="mediaForm" class="admin-form">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    
                    <div class="form-section">
                        <div class="form-group">
                            <label class="form-label">Thumbnail URL</label>
                            <input type="text" class="form-control" name="thumbnail" id="thumbnailInput" value="<?php echo htmlspecialchars($course['thumbnail'] ?? ''); ?>" placeholder="https://example.com/image.jpg">
                            <div class="thumbnail-preview" style="margin-top: 1rem;">
                                <?php if ($course['thumbnail']): ?>
                                <img src="<?php echo htmlspecialchars($course['thumbnail']); ?>" alt="Thumbnail" style="max-width: 300px; border-radius: 8px;" id="thumbnailPreview">
                                <?php else: ?>
                                <img src="" alt="Thumbnail" style="max-width: 300px; border-radius: 8px; display: none;" id="thumbnailPreview">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Promo Video URL (YouTube/Vimeo)</label>
                            <input type="text" class="form-control" name="promo_video" value="<?php echo htmlspecialchars($course['promo_video'] ?? ''); ?>" placeholder="https://youtube.com/watch?v=...">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Save Media</button>
                    </div>
                </form>
            </div>

            <!-- Pricing Tab -->
            <div class="tab-panel" id="tab-pricing">
                <form id="pricingForm" class="admin-form">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    
                    <div class="form-section">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Price (₹)</label>
                                <input type="number" class="form-control" name="price" value="<?php echo $course['price']; ?>" step="0.01">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Original Price (₹) - for discount display</label>
                                <input type="number" class="form-control" name="original_price" value="<?php echo $course['original_price']; ?>" step="0.01">
                            </div>
                        </div>
                        <?php if ($course['original_price'] && $course['price'] && $course['original_price'] > $course['price']): 
                            $discountPercent = round((($course['original_price'] - $course['price']) / $course['original_price']) * 100);
                        ?>
                        <div class="discount-info" style="background: #e0e7ff; padding: 1rem; border-radius: 8px; margin-top: 1rem;">
                            <strong>Discount:</strong> <?php echo $discountPercent; ?>% off (Displayed as ₹<?php echo number_format($course['price']); ?> <del>₹<?php echo number_format($course['original_price']); ?></del>)
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Save Pricing</button>
                    </div>
                </form>
            </div>

            <!-- Settings Tab -->
            <div class="tab-panel" id="tab-settings">
                <form id="settingsForm" class="admin-form">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    
                    <div class="form-section">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <div class="radio-group">
                                <label class="radio-card">
                                    <input type="radio" name="status" value="draft" <?php echo $course['status'] == 'draft' ? 'checked' : ''; ?>>
                                    <div class="radio-content">
                                        <span class="radio-title">Draft</span>
                                        <span class="radio-desc">Only visible to admins</span>
                                    </div>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="status" value="published" <?php echo $course['status'] == 'published' ? 'checked' : ''; ?>>
                                    <div class="radio-content">
                                        <span class="radio-title">Published</span>
                                        <span class="radio-desc">Visible to everyone</span>
                                    </div>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="status" value="archived" <?php echo $course['status'] == 'archived' ? 'checked' : ''; ?>>
                                    <div class="radio-content">
                                        <span class="radio-title">Archived</span>
                                        <span class="radio-desc">Hidden from catalog</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="checkbox-item">
                                <input type="checkbox" name="is_featured" <?php echo $course['is_featured'] ? 'checked' : ''; ?>>
                                <span>Feature this course on homepage</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<!-- Toast for notifications -->
<div id="toast" class="toast-notification"></div>

<!-- Edit Content Modal -->
<div id="editContentModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 700px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header">
            <h3><i class="bi bi-pencil-square"></i> Edit Lesson Content</h3>
            <button type="button" class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="editVideoId">
            
            <!-- Content Type -->
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label">Content Type</label>
                <div class="content-type-btns" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <button type="button" class="type-btn active" data-type="video" onclick="setContentType('video')">
                        <i class="bi bi-play-circle"></i> Video
                    </button>
                    <button type="button" class="type-btn" data-type="quiz" onclick="setContentType('quiz')">
                        <i class="bi bi-question-circle"></i> Quiz
                    </button>
                    <button type="button" class="type-btn" data-type="article" onclick="setContentType('article')">
                        <i class="bi bi-file-text"></i> Article
                    </button>
                </div>
            </div>
            
            <!-- Video Section -->
            <div id="videoSection" class="content-section">
                <p class="text-muted" style="color: #64748b; font-size: 0.9rem;">
                    <i class="bi bi-info-circle"></i> Video URL and duration are set in the main form above.
                </p>
            </div>
            
            <!-- Quiz Section -->
            <div id="quizSection" class="content-section" style="display: none;">
                <div class="form-group">
                    <label class="form-label">Quiz Questions</label>
                    <div id="quizQuestionsEditor">
                        <!-- Questions will be added here -->
                    </div>
                    <button type="button" class="btn-secondary" onclick="addQuizQuestion()" style="margin-top: 1rem;">
                        <i class="bi bi-plus"></i> Add Question
                    </button>
                </div>
            </div>
            
            <!-- Article Section -->
            <div id="articleSection" class="content-section" style="display: none;">
                <div class="form-group">
                    <label class="form-label">Article Content</label>
                    <textarea id="articleContent" class="form-control" rows="8" placeholder="Enter article content..."></textarea>
                </div>
            </div>
            
            <!-- Resources Section -->
            <div class="form-group" style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0;">
                <label class="form-label"><i class="bi bi-folder" style="color: #4f46e5; margin-right: 0.5rem;"></i>Downloadable Resources</label>
                
                <!-- File Upload Area -->
                <input type="file" id="resourceFileInput" multiple accept=".pdf,.doc,.docx,.zip,.rar,.ppt,.pptx,.xls,.xlsx,.txt" style="display: none;">
                <div id="resourceUploadArea" style="border: 2px dashed #e2e8f0; border-radius: 0.5rem; padding: 1.5rem; text-align: center; cursor: pointer; transition: all 0.2s; margin-bottom: 1rem;">
                    <i class="bi bi-cloud-upload" style="font-size: 1.5rem; color: #64748b; display: block; margin-bottom: 0.5rem;"></i>
                    <span style="font-size: 0.875rem; color: #64748b;">Click to select files or drag & drop</span>
                    <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem;">PDF, DOC, ZIP, PPT, etc. (Max 50MB each)</div>
                </div>
                
                <!-- File List -->
                <div id="resourceFileList" style="margin-bottom: 1rem;"></div>
                
                <!-- External Link -->
                <label class="form-label" style="font-size: 0.9rem; margin-top: 0.5rem;"><i class="bi bi-link-45deg" style="color: #4f46e5; margin-right: 0.25rem;"></i>External Resource Links</label>
                <textarea id="resourceLinks" class="form-control" rows="2" placeholder="Paste external links (Google Drive, Dropbox, etc.) - one per line"></textarea>
                
                <!-- Notes -->
                <label class="form-label" style="font-size: 0.9rem; margin-top: 1rem;"><i class="bi bi-journal-text" style="color: #4f46e5; margin-right: 0.25rem;"></i>Additional Notes</label>
                <textarea id="additionalNotes" class="form-control" rows="3" placeholder="Additional notes for this lesson"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeEditModal()">Cancel</button>
            <button type="button" class="btn-primary" onclick="saveContentEdit()">
                <i class="bi bi-check-lg"></i> Save Content
            </button>
        </div>
    </div>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<style>
/* Tab styles */
.edit-tabs { display: flex; gap: 0.5rem; background: #fff; padding: 0.5rem; border-radius: 0.75rem; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.edit-tab { padding: 0.75rem 1.5rem; border: none; background: transparent; border-radius: 0.5rem; font-weight: 500; color: #64748b; cursor: pointer; transition: all 0.2s; }
.edit-tab:hover { background: #f1f5f9; color: #1e293b; }
.edit-tab.active { background: #4f46e5; color: white; }

.tab-panel { display: none; }
.tab-panel.active { display: block; }

/* Form styles */
.admin-form { background: #fff; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.form-section { margin-bottom: 1.5rem; }
.form-row { display: flex; gap: 1.5rem; }
.form-group { margin-bottom: 1.5rem; flex: 1; }
.col-md-6 { flex: 0 0 calc(50% - 0.75rem); }
.form-label { display: block; margin-bottom: 0.5rem; font-weight: 500; color: #475569; }
.required { color: #ef4444; }
.form-control, .form-select { width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.95rem; }
.form-control:focus, .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); outline: none; }
.form-actions { display: flex; justify-content: flex-end; gap: 1rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; }
.btn-primary { padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; border: none; background: #4f46e5; color: white; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; }
.btn-primary:hover { background: #4338ca; }
.btn-secondary { padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; border: none; background: #f1f5f9; color: #475569; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; }
.btn-secondary:hover { background: #e2e8f0; }

/* Curriculum Editor */
.curriculum-editor { background: #fff; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.curriculum-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; }
.curriculum-header h3 { font-size: 1.25rem; font-weight: 600; color: #1e293b; margin: 0; }

.empty-curriculum { text-align: center; padding: 3rem; color: #94a3b8; }
.empty-curriculum i { font-size: 3rem; margin-bottom: 1rem; display: block; }

.curriculum-section { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; margin-bottom: 1rem; overflow: hidden; }
.section-header { display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #f1f5f9; border-bottom: 1px solid #e2e8f0; }
.section-drag { color: #94a3b8; cursor: grab; }
.section-title-input { flex: 1; padding: 0.5rem; border: 1px solid transparent; border-radius: 0.375rem; font-weight: 600; background: transparent; }
.section-title-input:focus { border-color: #4f46e5; background: #fff; outline: none; }
.section-actions { display: flex; gap: 0.5rem; }

.videos-list { padding: 0.5rem; }
.video-item { display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; background: #fff; border: 1px solid #e2e8f0; border-radius: 0.375rem; margin-bottom: 0.5rem; }
.video-drag { color: #94a3b8; cursor: grab; }
.video-icon { color: #4f46e5; font-size: 1.25rem; }
.video-title-input { flex: 1; padding: 0.375rem 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.25rem; font-size: 0.9rem; }
.video-url-input { width: 200px; padding: 0.375rem 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.25rem; font-size: 0.85rem; }
.video-duration-input { width: 60px; padding: 0.375rem 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.25rem; font-size: 0.85rem; text-align: center; }
.preview-checkbox { display: flex; align-items: center; gap: 0.25rem; font-size: 0.85rem; color: #64748b; white-space: nowrap; }

.btn-icon { background: none; border: none; cursor: pointer; color: #64748b; padding: 0.375rem; font-size: 1rem; border-radius: 0.25rem; }
.btn-icon:hover { background: #e2e8f0; color: #4f46e5; }
.btn-icon.delete-section-btn:hover, .btn-icon.delete-video-btn:hover { color: #ef4444; }
.btn-icon.save-section-btn, .btn-icon.save-video-btn { color: #10b981; }

/* Radio and Checkbox */
.radio-group { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
.radio-card { position: relative; cursor: pointer; }
.radio-card input { position: absolute; opacity: 0; }
.radio-content { padding: 1rem; border: 2px solid #e2e8f0; border-radius: 0.5rem; transition: all 0.2s; }
.radio-card input:checked + .radio-content { border-color: #4f46e5; background: #e0e7ff; }
.radio-title { display: block; font-weight: 600; color: #1e293b; margin-bottom: 0.25rem; }
.radio-desc { font-size: 0.85rem; color: #64748b; }
.checkbox-item { display: flex; align-items: center; gap: 0.75rem; cursor: pointer; }
.checkbox-item input { width: 1.1rem; height: 1.1rem; }

/* Toast */
.toast-notification { position: fixed; bottom: 2rem; right: 2rem; padding: 1rem 1.5rem; border-radius: 0.5rem; color: white; font-weight: 500; z-index: 9999; transform: translateX(200%); transition: transform 0.3s ease; }
.toast-notification.show { transform: translateX(0); }
.toast-notification.success { background: #10b981; }
.toast-notification.error { background: #ef4444; }

@media (max-width: 768px) {
    .form-row { flex-direction: column; gap: 0; }
    .col-md-6 { flex: 1 1 100%; }
    .radio-group { grid-template-columns: 1fr; }
    .edit-tabs { flex-wrap: wrap; }
    .video-item { flex-wrap: wrap; }
    .video-url-input { width: 100%; }
}

/* Modal Styles */
.modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 10000; display: flex; align-items: center; justify-content: center; padding: 1rem; }
.modal-content { background: white; border-radius: 1rem; width: 100%; box-shadow: 0 20px 50px rgba(0,0,0,0.2); }
.modal-header { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; border-bottom: 1px solid #e2e8f0; }
.modal-header h3 { margin: 0; font-size: 1.25rem; color: #1e293b; display: flex; align-items: center; gap: 0.5rem; }
.modal-close { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #64748b; padding: 0.5rem; line-height: 1; }
.modal-close:hover { color: #1e293b; }
.modal-body { padding: 1.5rem; }
.modal-footer { padding: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 0.75rem; }

/* Content Type Buttons */
.type-btn { padding: 0.75rem 1.25rem; border: 2px solid #e2e8f0; border-radius: 0.5rem; background: white; cursor: pointer; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
.type-btn:hover { border-color: #4f46e5; color: #4f46e5; }
.type-btn.active { border-color: #4f46e5; background: #e0e7ff; color: #4f46e5; }

/* Quiz Question Editor */
.quiz-question-block { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem; }
.quiz-question-block .question-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; }
.quiz-question-block .question-number { font-weight: 600; color: #4f46e5; }
.quiz-question-block .remove-question { background: none; border: none; color: #ef4444; cursor: pointer; padding: 0.25rem; }
.quiz-question-block textarea { margin-bottom: 0.75rem; }
.quiz-option-row { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; }
.quiz-option-row input[type="text"] { flex: 1; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem; }
.quiz-option-row input[type="radio"] { width: 1rem; height: 1rem; }
.quiz-option-row label { font-size: 0.85rem; color: #64748b; white-space: nowrap; }

/* Edit button style */
.btn-icon.edit-content-btn { color: #4f46e5; }
.btn-icon.edit-content-btn:hover { background: #e0e7ff; }
</style>

<script>
const courseId = <?php echo $course_id; ?>;
const apiBase = '<?php echo url('api/admin/courses/'); ?>';

// Tab switching
document.querySelectorAll('.edit-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.edit-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
    });
});

// Toast notification
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className = 'toast-notification ' + type + ' show';
    setTimeout(() => toast.classList.remove('show'), 3000);
}

// Basic Info Form
document.getElementById('basicInfoForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const data = {
        course_id: courseId,
        title: form.title.value,
        subtitle: form.subtitle.value,
        category_id: form.category_id.value,
        instructor_id: form.instructor_id.value,
        description: form.description.value,
        level: form.level.value
    };
    
    try {
        const res = await fetch(apiBase + 'update.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });
        const result = await res.json();
        if (result.success) showToast('Basic info saved!');
        else showToast(result.error || 'Failed to save', 'error');
    } catch (err) {
        showToast('Failed to save', 'error');
    }
});

// Media Form
document.getElementById('mediaForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const data = {
        course_id: courseId,
        thumbnail: form.thumbnail.value,
        promo_video: form.promo_video?.value || ''
    };
    
    try {
        const res = await fetch(apiBase + 'update.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });
        const result = await res.json();
        if (result.success) showToast('Media saved!');
        else showToast(result.error || 'Failed to save', 'error');
    } catch (err) {
        showToast('Failed to save', 'error');
    }
});

// Thumbnail preview
document.getElementById('thumbnailInput').addEventListener('input', (e) => {
    const preview = document.getElementById('thumbnailPreview');
    if (e.target.value) {
        preview.src = e.target.value;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
});

// Pricing Form
document.getElementById('pricingForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const data = {
        course_id: courseId,
        price: parseFloat(form.price.value) || 0,
        original_price: parseFloat(form.original_price.value) || null
    };
    
    try {
        const res = await fetch(apiBase + 'update.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });
        const result = await res.json();
        if (result.success) showToast('Pricing saved!');
        else showToast(result.error || 'Failed to save', 'error');
    } catch (err) {
        showToast('Failed to save', 'error');
    }
});

// Settings Form
document.getElementById('settingsForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const data = {
        course_id: courseId,
        status: form.querySelector('[name="status"]:checked').value,
        is_featured: form.is_featured.checked ? 1 : 0
    };
    
    try {
        const res = await fetch(apiBase + 'update.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });
        const result = await res.json();
        if (result.success) showToast('Settings saved!');
        else showToast(result.error || 'Failed to save', 'error');
    } catch (err) {
        showToast('Failed to save', 'error');
    }
});

// =========== CURRICULUM MANAGEMENT ===========

// Add Section
document.getElementById('addSectionBtn').addEventListener('click', async () => {
    const title = prompt('Enter section title:');
    if (!title) return;
    
    try {
        const res = await fetch(apiBase + 'sections.php?action=create', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ course_id: courseId, title: title })
        });
        const result = await res.json();
        if (result.success) {
            showToast('Section added!');
            location.reload();
        } else {
            showToast(result.error || 'Failed to add section', 'error');
        }
    } catch (err) {
        showToast('Failed to add section', 'error');
    }
});

// Section event listeners
document.querySelectorAll('.curriculum-section').forEach(section => {
    const sectionId = section.dataset.sectionId;
    
    // Save section title
    section.querySelector('.save-section-btn').addEventListener('click', async () => {
        const title = section.querySelector('.section-title-input').value;
        try {
            const res = await fetch(apiBase + 'sections.php?action=update', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ section_id: sectionId, title: title })
            });
            const result = await res.json();
            if (result.success) showToast('Section saved!');
            else showToast(result.error || 'Failed to save', 'error');
        } catch (err) {
            showToast('Failed to save', 'error');
        }
    });
    
    // Delete section
    section.querySelector('.delete-section-btn').addEventListener('click', async () => {
        if (!confirm('Delete this section and all its videos?')) return;
        try {
            const res = await fetch(apiBase + 'sections.php?action=delete', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ section_id: sectionId })
            });
            const result = await res.json();
            if (result.success) {
                showToast('Section deleted!');
                section.remove();
            } else {
                showToast(result.error || 'Failed to delete', 'error');
            }
        } catch (err) {
            showToast('Failed to delete', 'error');
        }
    });
    
    // Add video to section
    section.querySelector('.add-video-btn').addEventListener('click', async () => {
        const title = prompt('Enter video title:');
        if (!title) return;
        
        try {
            const res = await fetch(apiBase + 'videos.php?action=create', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ section_id: sectionId, title: title })
            });
            const result = await res.json();
            if (result.success) {
                showToast('Video added!');
                location.reload();
            } else {
                showToast(result.error || 'Failed to add video', 'error');
            }
        } catch (err) {
            showToast('Failed to add video', 'error');
        }
    });
    
    // Video event listeners
    section.querySelectorAll('.video-item').forEach(video => {
        const videoId = video.dataset.videoId;
        
        // Save video
        video.querySelector('.save-video-btn').addEventListener('click', async () => {
            const data = {
                video_id: videoId,
                title: video.querySelector('.video-title-input').value,
                video_url: video.querySelector('.video-url-input').value,
                duration_minutes: parseInt(video.querySelector('.video-duration-input').value) || 0,
                is_preview: video.querySelector('.video-preview-check').checked
            };
            
            try {
                const res = await fetch(apiBase + 'videos.php?action=update', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(data)
                });
                const result = await res.json();
                if (result.success) showToast('Video saved!');
                else showToast(result.error || 'Failed to save', 'error');
            } catch (err) {
                showToast('Failed to save', 'error');
            }
        });
        
        // Delete video
        video.querySelector('.delete-video-btn').addEventListener('click', async () => {
            if (!confirm('Delete this video?')) return;
            try {
                const res = await fetch(apiBase + 'videos.php?action=delete', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ video_id: videoId })
                });
                const result = await res.json();
                if (result.success) {
                    showToast('Video deleted!');
                    video.remove();
                } else {
                    showToast(result.error || 'Failed to delete', 'error');
                }
            } catch (err) {
                showToast('Failed to delete', 'error');
            }
        });
        // Edit content button handler
        const editBtn = video.querySelector('.edit-content-btn');
        if (editBtn) {
            editBtn.addEventListener('click', () => openEditModal(video));
        }
    });
});

// =========== EDIT CONTENT MODAL ===========

let currentEditVideo = null;
let currentContentType = 'video';
let quizQuestionCount = 0;

function openEditModal(videoElement) {
    currentEditVideo = videoElement;
    const videoId = videoElement.dataset.videoId;
    const description = videoElement.dataset.description || '';
    
    document.getElementById('editVideoId').value = videoId;
    document.getElementById('editContentModal').style.display = 'flex';
    
    // Reset
    document.getElementById('quizQuestionsEditor').innerHTML = '';
    document.getElementById('articleContent').value = '';
    document.getElementById('additionalNotes').value = '';
    quizQuestionCount = 0;
    
    // Parse description to determine content type
    if (description.includes('{"type":"quiz"')) {
        setContentType('quiz');
        try {
            const quizData = JSON.parse(description);
            if (quizData.questions) {
                quizData.questions.forEach(q => {
                    addQuizQuestion(q.question, q.options, q.correctIndex);
                });
            }
        } catch (e) { console.error('Error parsing quiz:', e); }
    } else if (description.includes('<!-- ARTICLE -->')) {
        setContentType('article');
        const articleText = description.replace('<!-- ARTICLE -->', '').replace('<!-- NOTES -->', '\n---NOTES---\n').trim();
        const parts = articleText.split('---NOTES---');
        document.getElementById('articleContent').value = parts[0].trim();
        if (parts[1]) document.getElementById('additionalNotes').value = parts[1].trim();
    } else {
        setContentType('video');
        // Check for notes
        if (description.includes('<!-- NOTES -->')) {
            document.getElementById('additionalNotes').value = description.replace('<!-- NOTES -->', '').trim();
        }
    }
}

function closeEditModal() {
    document.getElementById('editContentModal').style.display = 'none';
    currentEditVideo = null;
}

function setContentType(type) {
    currentContentType = type;
    document.querySelectorAll('.type-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.type === type);
    });
    document.getElementById('videoSection').style.display = type === 'video' ? 'block' : 'none';
    document.getElementById('quizSection').style.display = type === 'quiz' ? 'block' : 'none';
    document.getElementById('articleSection').style.display = type === 'article' ? 'block' : 'none';
}

function addQuizQuestion(qText = '', options = ['', '', '', ''], correctIndex = 0) {
    quizQuestionCount++;
    const container = document.getElementById('quizQuestionsEditor');
    const qNum = quizQuestionCount;
    const randomName = 'q' + qNum + '_' + Date.now();
    
    const questionHtml = `
        <div class="quiz-question-block" data-question-index="${qNum}">
            <div class="question-header">
                <span class="question-number">Question ${qNum}</span>
                <button type="button" class="remove-question" onclick="this.closest('.quiz-question-block').remove()"><i class="bi bi-trash"></i></button>
            </div>
            <textarea class="form-control question-text" rows="2" placeholder="Enter your question...">${qText}</textarea>
            <div class="options-container">
                ${options.map((opt, i) => `
                    <div class="quiz-option-row">
                        <input type="radio" name="${randomName}" ${i === correctIndex ? 'checked' : ''}>
                        <input type="text" class="option-text" value="${opt}" placeholder="Option ${i + 1}">
                        <label>Correct</label>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', questionHtml);
}

async function saveContentEdit() {
    const videoId = document.getElementById('editVideoId').value;
    let description = '';
    
    if (currentContentType === 'quiz') {
        const questions = [];
        document.querySelectorAll('.quiz-question-block').forEach(block => {
            const qText = block.querySelector('.question-text').value;
            const options = [];
            let correctIndex = 0;
            block.querySelectorAll('.quiz-option-row').forEach((row, idx) => {
                options.push(row.querySelector('.option-text').value);
                if (row.querySelector('input[type="radio"]').checked) correctIndex = idx;
            });
            if (qText) questions.push({ question: qText, options, correctIndex });
        });
        if (questions.length > 0) {
            description = JSON.stringify({ type: 'quiz', questions });
        }
    } else if (currentContentType === 'article') {
        const articleText = document.getElementById('articleContent').value.trim();
        if (articleText) {
            description = '<!-- ARTICLE -->\n' + articleText;
        }
    }
    
    // Add notes
    const notes = document.getElementById('additionalNotes').value.trim();
    if (notes) {
        description += '\n<!-- NOTES -->\n' + notes;
    }
    
    // Save via API
    try {
        const res = await fetch(apiBase + 'videos.php?action=update', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ video_id: videoId, description: description })
        });
        const result = await res.json();
        if (result.success) {
            showToast('Content saved!');
            currentEditVideo.dataset.description = description;
            closeEditModal();
        } else {
            showToast(result.error || 'Failed to save', 'error');
        }
    } catch (err) {
        showToast('Failed to save content', 'error');
    }
}

// =========== RESOURCE FILE UPLOAD ===========

let uploadedResources = [];

// Setup file upload handlers
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('resourceFileInput');
    const uploadArea = document.getElementById('resourceUploadArea');
    const fileList = document.getElementById('resourceFileList');
    
    if (uploadArea && fileInput) {
        // Click to upload
        uploadArea.addEventListener('click', () => fileInput.click());
        
        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#4f46e5';
            uploadArea.style.background = '#f0f0ff';
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = 'transparent';
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = 'transparent';
            handleFiles(e.dataTransfer.files);
        });
        
        // File input change
        fileInput.addEventListener('change', () => {
            handleFiles(fileInput.files);
        });
    }
    
    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (file.size > 50 * 1024 * 1024) {
                showToast(`${file.name} exceeds 50MB limit`, 'error');
                return;
            }
            uploadedResources.push(file);
            renderFileList();
        });
    }
    
    window.renderFileList = function() {
        if (!fileList) return;
        fileList.innerHTML = uploadedResources.map((file, idx) => `
            <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: #f8fafc; border-radius: 0.375rem; margin-bottom: 0.25rem;">
                <i class="bi bi-file-earmark" style="color: #4f46e5;"></i>
                <span style="flex: 1; font-size: 0.875rem; color: #1e293b;">${file.name}</span>
                <span style="font-size: 0.75rem; color: #64748b;">${(file.size / 1024).toFixed(1)} KB</span>
                <button type="button" onclick="removeResourceFile(${idx})" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0.25rem;">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `).join('');
    };
    
    window.removeResourceFile = function(idx) {
        uploadedResources.splice(idx, 1);
        renderFileList();
    };
});

// Reset resources when opening modal
const originalOpenEditModal = openEditModal;
openEditModal = function(videoElement) {
    uploadedResources = [];
    document.getElementById('resourceFileList').innerHTML = '';
    document.getElementById('resourceLinks').value = '';
    originalOpenEditModal(videoElement);
    
    // Parse existing resources from description
    const description = videoElement.dataset.description || '';
    if (description.includes('<!-- RESOURCES -->')) {
        const match = description.match(/<!-- RESOURCES -->([\s\S]*?)(?=<!-- |$)/);
        if (match) {
            document.getElementById('resourceLinks').value = match[1].trim();
        }
    }
};

// Extend save function to include resources
const originalSaveContentEdit = saveContentEdit;
saveContentEdit = async function() {
    const videoId = document.getElementById('editVideoId').value;
    let description = '';
    
    if (currentContentType === 'quiz') {
        const questions = [];
        document.querySelectorAll('.quiz-question-block').forEach(block => {
            const qText = block.querySelector('.question-text').value;
            const options = [];
            let correctIndex = 0;
            block.querySelectorAll('.quiz-option-row').forEach((row, idx) => {
                options.push(row.querySelector('.option-text').value);
                if (row.querySelector('input[type="radio"]').checked) correctIndex = idx;
            });
            if (qText) questions.push({ question: qText, options, correctIndex });
        });
        if (questions.length > 0) {
            description = JSON.stringify({ type: 'quiz', questions });
        }
    } else if (currentContentType === 'article') {
        const articleText = document.getElementById('articleContent').value.trim();
        if (articleText) {
            description = '<!-- ARTICLE -->\n' + articleText;
        }
    }
    
    // Add resource links
    const resourceLinks = document.getElementById('resourceLinks').value.trim();
    if (resourceLinks) {
        description += '\n<!-- RESOURCES -->\n' + resourceLinks;
    }
    
    // Add notes
    const notes = document.getElementById('additionalNotes').value.trim();
    if (notes) {
        description += '\n<!-- NOTES -->\n' + notes;
    }
    
    // Handle file uploads (if any)
    if (uploadedResources.length > 0) {
        const fileNames = uploadedResources.map(f => f.name).join(', ');
        description += '\n<!-- FILES -->\n' + fileNames;
        // Note: Actual file upload would require a separate API endpoint
        showToast(`${uploadedResources.length} file(s) queued for upload`);
    }
    
    // Save via API
    try {
        const res = await fetch(apiBase + 'videos.php?action=update', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ video_id: videoId, description: description })
        });
        const result = await res.json();
        if (result.success) {
            showToast('Content saved!');
            currentEditVideo.dataset.description = description;
            closeEditModal();
        } else {
            showToast(result.error || 'Failed to save', 'error');
        }
    } catch (err) {
        showToast('Failed to save content', 'error');
    }
};
</script>
