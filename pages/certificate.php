<?php
include('../config.php');
include('../includes/session.php'); // Start session early
include('../includes/db_connect.php');
include('../components/head.php');
include('../components/navbar.php');
include('../components/footer.php');
include('../components/scripts.php');
include('../components/sidebar.php');

// Get course ID from URL
$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

// Get user info from session
$user_id = $_SESSION['user_id'] ?? 0;
$user_name = $_SESSION['full_name'] ?? $_SESSION['username'] ?? 'Student';

// Get course details
$course = null;
$instructor_name = 'Instructor';
$completion_date = date('F d, Y');
$certificate_id = '';

if ($course_id && $user_id && isset($conn)) {
    // Get course info - use user_id instead of id for users table
    $stmt = $conn->prepare("SELECT c.*, u.full_name as instructor_name FROM courses c LEFT JOIN users u ON c.instructor_id = u.user_id WHERE c.course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();

    if ($course) {
        $instructor_name = $course['instructor_name'] ?? 'Course Instructor';

        // Check if user has completed this course (100% progress)
        $progressStmt = $conn->prepare("
            SELECT
                COUNT(DISTINCT v.video_id) as total_lessons,
                COUNT(DISTINCT CASE WHEN vp.is_completed = 1 THEN vp.video_id END) as completed_lessons
            FROM videos v
            INNER JOIN course_sections cs ON v.section_id = cs.section_id
            LEFT JOIN video_progress vp ON v.video_id = vp.video_id AND vp.user_id = ?
            WHERE cs.course_id = ?
        ");
        $progressStmt->bind_param("ii", $user_id, $course_id);
        $progressStmt->execute();
        $progressResult = $progressStmt->get_result();
        $progress = $progressResult->fetch_assoc();

        $total = $progress['total_lessons'] ?? 0;
        $completed = $progress['completed_lessons'] ?? 0;
        $progressPercent = $total > 0 ? round(($completed / $total) * 100) : 0;

        // Generate unique certificate ID
        $certificate_id = 'CERT-' . strtoupper(substr(md5($user_id . $course_id . $completion_date), 0, 8));

        // Get completion date from video_progress
        $dateStmt = $conn->prepare("
            SELECT MAX(vp.completed_at) as completion_date
            FROM video_progress vp
            INNER JOIN videos v ON vp.video_id = v.video_id
            INNER JOIN course_sections cs ON v.section_id = cs.section_id
            WHERE vp.user_id = ? AND cs.course_id = ? AND vp.is_completed = 1
        ");
        $dateStmt->bind_param("ii", $user_id, $course_id);
        $dateStmt->execute();
        $dateResult = $dateStmt->get_result();
        $dateRow = $dateResult->fetch_assoc();
        if ($dateRow && $dateRow['completion_date']) {
            $completion_date = date('F d, Y', strtotime($dateRow['completion_date']));
        }
    }
}

// Fallback for demo
if (!$course) {
    $course = [
        'title' => 'Course Title',
        'course_id' => 0
    ];
}

$course_title = $course['title'] ?? 'Course Title';
$site_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$certificate_url = $site_url . "/LMS/pages/certificate.php?course_id=" . $course_id;

renderHead('Certificate of Completion', ['css/dashboard.css', 'css/certificate.css']);
renderNavbar();
?>

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php renderSidebar('achievements'); ?>

    <!-- Main Content -->
    <main class="dashboard-main">
        <div class="certificate-page-container">

            <!-- Confetti Canvas -->
            <canvas id="confettiCanvas"></canvas>

            <!-- Celebration Header -->
            <div class="celebration-header" id="celebrationHeader">
                <div class="trophy-icon">
                    <i class="bi bi-trophy-fill"></i>
                </div>
                <h1 class="celebration-title">Congratulations!</h1>
                <p class="celebration-subtitle">You've successfully completed the course</p>
                <div class="sparkles">
                    <span class="sparkle"></span>
                    <span class="sparkle"></span>
                    <span class="sparkle"></span>
                </div>
            </div>

            <!-- Certificate Card -->
            <div class="certificate-card" id="certificateCard">
                <!-- Certificate Visual (for PDF capture) -->
                <div class="certificate-frame" id="certificateFrame">
                    <div class="certificate-border">
                        <div class="certificate-inner">
                            <!-- Decorative corners -->
                            <div class="corner-decoration top-left"></div>
                            <div class="corner-decoration top-right"></div>
                            <div class="corner-decoration bottom-left"></div>
                            <div class="corner-decoration bottom-right"></div>

                            <!-- Certificate Content -->
                            <div class="certificate-content">
                                <!-- Logo/Badge -->
                                <div class="cert-badge">
                                    <i class="bi bi-award-fill"></i>
                                </div>

                                <h2 class="cert-title">Certificate of Completion</h2>

                                <div class="cert-divider">
                                    <span class="divider-line"></span>
                                    <i class="bi bi-star-fill"></i>
                                    <span class="divider-line"></span>
                                </div>

                                <p class="cert-text">This is to certify that</p>

                                <div class="cert-recipient" id="recipientName"><?php echo htmlspecialchars($user_name); ?></div>

                                <p class="cert-text">has successfully completed the course</p>

                                <h3 class="cert-course"><?php echo htmlspecialchars($course_title); ?></h3>

                                <div class="cert-details">
                                    <div class="cert-detail">
                                        <i class="bi bi-calendar3"></i>
                                        <span>Completed on <?php echo $completion_date; ?></span>
                                    </div>
                                    <div class="cert-detail">
                                        <i class="bi bi-patch-check-fill"></i>
                                        <span>Certificate ID: <?php echo $certificate_id; ?></span>
                                    </div>
                                </div>

                                <div class="cert-footer">
                                    <div class="cert-signature">
                                        <div class="signature-graphic">
                                            <svg viewBox="0 0 100 30" class="signature-svg">
                                                <path d="M5,25 Q15,5 30,20 T50,15 T70,20 T95,10" stroke="#1e293b" fill="none" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="signature-line"></div>
                                        <div class="signature-name"><?php echo htmlspecialchars($instructor_name); ?></div>
                                        <div class="signature-title">Course Instructor</div>
                                    </div>

                                    <div class="cert-seal">
                                        <div class="seal-outer">
                                            <div class="seal-inner">
                                                <i class="bi bi-patch-check-fill"></i>
                                            </div>
                                        </div>
                                        <span class="seal-text">VERIFIED</span>
                                    </div>

                                    <div class="cert-signature">
                                        <div class="signature-graphic">
                                            <svg viewBox="0 0 100 30" class="signature-svg">
                                                <path d="M5,15 Q25,30 45,10 T85,20" stroke="#1e293b" fill="none" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="signature-line"></div>
                                        <div class="signature-name"><?php echo $completion_date; ?></div>
                                        <div class="signature-title">Date Issued</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="certificate-actions">
                    <button class="btn-action btn-download" id="downloadPdfBtn">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                        <span>Download PDF</span>
                    </button>

                    <button class="btn-action btn-download-img" id="downloadImgBtn">
                        <i class="bi bi-image"></i>
                        <span>Download Image</span>
                    </button>
                </div>

                <!-- Share Section -->
                <div class="share-section">
                    <h4 class="share-title">
                        <i class="bi bi-share-fill"></i>
                        Share Your Achievement
                    </h4>
                    <p class="share-subtitle">Let the world know about your accomplishment!</p>

                    <div class="share-buttons">
                        <button class="share-btn share-linkedin" id="shareLinkedIn" title="Share on LinkedIn">
                            <i class="bi bi-linkedin"></i>
                            <span>LinkedIn</span>
                        </button>

                        <button class="share-btn share-twitter" id="shareTwitter" title="Share on Twitter/X">
                            <i class="bi bi-twitter-x"></i>
                            <span>Twitter/X</span>
                        </button>

                        <button class="share-btn share-facebook" id="shareFacebook" title="Share on Facebook">
                            <i class="bi bi-facebook"></i>
                            <span>Facebook</span>
                        </button>

                        <button class="share-btn share-whatsapp" id="shareWhatsApp" title="Share on WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                            <span>WhatsApp</span>
                        </button>

                        <button class="share-btn share-copy" id="copyLink" title="Copy Link">
                            <i class="bi bi-link-45deg"></i>
                            <span>Copy Link</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Back to Course Button -->
            <div class="back-section">
                <a href="<?php echo url('pages/courses.php'); ?>" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Browse More Courses
                </a>
            </div>

        </div>
    </main>
</div>

<?php renderFooter(); ?>
<?php renderScripts(); ?>

<!-- html2canvas for capturing certificate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- jsPDF for PDF generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
// Certificate data
const certificateData = {
    userName: <?php echo json_encode($user_name); ?>,
    courseName: <?php echo json_encode($course_title); ?>,
    certificateId: <?php echo json_encode($certificate_id); ?>,
    completionDate: <?php echo json_encode($completion_date); ?>,
    certificateUrl: <?php echo json_encode($certificate_url); ?>
};

// ==================== CONFETTI ANIMATION ====================
class ConfettiAnimation {
    constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext('2d');
        this.particles = [];
        this.colors = ['#6366f1', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981', '#3b82f6'];
        this.running = false;
        this.resize();
        window.addEventListener('resize', () => this.resize());
    }

    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }

    createParticle() {
        return {
            x: Math.random() * this.canvas.width,
            y: -20,
            size: Math.random() * 10 + 5,
            color: this.colors[Math.floor(Math.random() * this.colors.length)],
            speedY: Math.random() * 3 + 2,
            speedX: Math.random() * 4 - 2,
            rotation: Math.random() * 360,
            rotationSpeed: Math.random() * 10 - 5,
            shape: Math.random() > 0.5 ? 'rect' : 'circle'
        };
    }

    update() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        // Add new particles
        if (this.running && this.particles.length < 150) {
            for (let i = 0; i < 3; i++) {
                this.particles.push(this.createParticle());
            }
        }

        // Update and draw particles
        this.particles = this.particles.filter(p => {
            p.y += p.speedY;
            p.x += p.speedX;
            p.rotation += p.rotationSpeed;

            this.ctx.save();
            this.ctx.translate(p.x, p.y);
            this.ctx.rotate(p.rotation * Math.PI / 180);
            this.ctx.fillStyle = p.color;

            if (p.shape === 'rect') {
                this.ctx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size * 0.6);
            } else {
                this.ctx.beginPath();
                this.ctx.arc(0, 0, p.size / 2, 0, Math.PI * 2);
                this.ctx.fill();
            }

            this.ctx.restore();

            return p.y < this.canvas.height + 20;
        });

        if (this.running || this.particles.length > 0) {
            requestAnimationFrame(() => this.update());
        }
    }

    start() {
        this.running = true;
        this.update();

        // Stop creating new particles after 3 seconds
        setTimeout(() => {
            this.running = false;
        }, 3000);
    }
}

// ==================== CERTIFICATE REVEAL ANIMATION ====================
function animateCertificateReveal() {
    const header = document.getElementById('celebrationHeader');
    const card = document.getElementById('certificateCard');

    // Animate header
    header.classList.add('animate-in');

    // Animate certificate card after delay
    setTimeout(() => {
        card.classList.add('animate-in');
    }, 500);
}

// ==================== PDF DOWNLOAD ====================
async function downloadPDF() {
    const btn = document.getElementById('downloadPdfBtn');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Generating...';
    btn.disabled = true;

    try {
        const certificate = document.getElementById('certificateFrame');

        // Capture certificate as canvas
        const canvas = await html2canvas(certificate, {
            scale: 2,
            useCORS: true,
            allowTaint: true,
            backgroundColor: '#ffffff',
            logging: false
        });

        // Create PDF
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: 'a4'
        });

        // Calculate dimensions to fit A4 landscape
        const imgWidth = 297; // A4 landscape width in mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        // Center vertically if needed
        const yOffset = (210 - imgHeight) / 2; // A4 height is 210mm

        pdf.addImage(
            canvas.toDataURL('image/png'),
            'PNG',
            0,
            yOffset > 0 ? yOffset : 0,
            imgWidth,
            imgHeight
        );

        // Download
        pdf.save(`Certificate-${certificateData.courseName.replace(/[^a-zA-Z0-9]/g, '_')}.pdf`);

        btn.innerHTML = '<i class="bi bi-check-circle-fill"></i> Downloaded!';
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 2000);

    } catch (error) {
        console.error('PDF generation failed:', error);
        btn.innerHTML = '<i class="bi bi-exclamation-circle"></i> Failed';
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 2000);
    }
}

// ==================== IMAGE DOWNLOAD ====================
async function downloadImage() {
    const btn = document.getElementById('downloadImgBtn');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Generating...';
    btn.disabled = true;

    try {
        const certificate = document.getElementById('certificateFrame');

        const canvas = await html2canvas(certificate, {
            scale: 2,
            useCORS: true,
            allowTaint: true,
            backgroundColor: '#ffffff',
            logging: false
        });

        // Create download link
        const link = document.createElement('a');
        link.download = `Certificate-${certificateData.courseName.replace(/[^a-zA-Z0-9]/g, '_')}.png`;
        link.href = canvas.toDataURL('image/png');
        link.click();

        btn.innerHTML = '<i class="bi bi-check-circle-fill"></i> Downloaded!';
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 2000);

    } catch (error) {
        console.error('Image generation failed:', error);
        btn.innerHTML = '<i class="bi bi-exclamation-circle"></i> Failed';
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 2000);
    }
}

// ==================== SOCIAL SHARING ====================
function shareOnLinkedIn() {
    const text = `I just completed "${certificateData.courseName}" and earned my certificate! #Learning #Achievement #OnlineCourse`;
    const url = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(certificateData.certificateUrl)}`;
    window.open(url, '_blank', 'width=600,height=600');
}

function shareOnTwitter() {
    const text = `I just completed "${certificateData.courseName}" and earned my certificate! #Learning #Achievement`;
    const url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(certificateData.certificateUrl)}`;
    window.open(url, '_blank', 'width=600,height=400');
}

function shareOnFacebook() {
    const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(certificateData.certificateUrl)}&quote=${encodeURIComponent(`I just completed "${certificateData.courseName}"!`)}`;
    window.open(url, '_blank', 'width=600,height=600');
}

function shareOnWhatsApp() {
    const text = `I just completed "${certificateData.courseName}" and earned my certificate! Check it out: ${certificateData.certificateUrl}`;
    const url = `https://wa.me/?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
}

function copyLink() {
    const btn = document.getElementById('copyLink');
    navigator.clipboard.writeText(certificateData.certificateUrl).then(() => {
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-lg"></i><span>Copied!</span>';
        btn.classList.add('copied');

        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('copied');
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = certificateData.certificateUrl;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);

        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-lg"></i><span>Copied!</span>';
        setTimeout(() => {
            btn.innerHTML = originalHTML;
        }, 2000);
    });
}

// ==================== INITIALIZE ====================
document.addEventListener('DOMContentLoaded', function() {
    // Start confetti
    const confetti = new ConfettiAnimation(document.getElementById('confettiCanvas'));
    confetti.start();

    // Animate certificate reveal
    setTimeout(animateCertificateReveal, 300);

    // Event listeners
    document.getElementById('downloadPdfBtn').addEventListener('click', downloadPDF);
    document.getElementById('downloadImgBtn').addEventListener('click', downloadImage);
    document.getElementById('shareLinkedIn').addEventListener('click', shareOnLinkedIn);
    document.getElementById('shareTwitter').addEventListener('click', shareOnTwitter);
    document.getElementById('shareFacebook').addEventListener('click', shareOnFacebook);
    document.getElementById('shareWhatsApp').addEventListener('click', shareOnWhatsApp);
    document.getElementById('copyLink').addEventListener('click', copyLink);
});
</script>
