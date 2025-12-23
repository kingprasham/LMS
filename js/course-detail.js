// Course Detail Page - Complete Sales Page JavaScript

document.addEventListener('DOMContentLoaded', function () {
    // Initialize all features
    initCountdownTimer();
    initAccordion();
    initShowMoreDescription();
    initExpandAllSections();
    initVideoPreview();
    initAnimations();
});

// Countdown Timer
function initCountdownTimer() {
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');

    if (!hoursEl || !minutesEl || !secondsEl) return;

    // Set countdown to 24 hours from now
    const countdownEnd = new Date().getTime() + (24 * 60 * 60 * 1000);

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countdownEnd - now;

        if (distance < 0) {
            hoursEl.textContent = '00';
            minutesEl.textContent = '00';
            secondsEl.textContent = '00';
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        hoursEl.textContent = String(hours).padStart(2, '0');
        minutesEl.textContent = String(minutes).padStart(2, '0');
        secondsEl.textContent = String(seconds).padStart(2, '0');
    }

    // Update immediately and then every second
    updateCountdown();
    setInterval(updateCountdown, 1000);
}

// Accordion Functionality
function initAccordion() {
    const accordionButtons = document.querySelectorAll('.accordion-section-header');

    accordionButtons.forEach(button => {
        button.addEventListener('click', function () {
            const isCollapsed = this.classList.contains('collapsed');

            // Toggle collapsed class
            this.classList.toggle('collapsed');

            // Update chevron icon
            const chevron = this.querySelector('.section-chevron');
            if (chevron) {
                if (isCollapsed) {
                    chevron.classList.remove('bi-chevron-right');
                    chevron.classList.add('bi-chevron-down');
                } else {
                    chevron.classList.remove('bi-chevron-down');
                    chevron.classList.add('bi-chevron-right');
                }
            }
        });
    });
}

// Show More Description
function initShowMoreDescription() {
    const showMoreBtn = document.getElementById('showMoreBtn');
    const descriptionMore = document.getElementById('descriptionMore');
    const showMoreText = showMoreBtn?.querySelector('.show-more-text');

    if (showMoreBtn && descriptionMore) {
        showMoreBtn.addEventListener('click', function () {
            const isHidden = descriptionMore.style.display === 'none' || !descriptionMore.style.display;

            if (isHidden) {
                descriptionMore.style.display = 'block';
                showMoreText.textContent = 'Show less';
                this.querySelector('i').style.transform = 'rotate(180deg)';
            } else {
                descriptionMore.style.display = 'none';
                showMoreText.textContent = 'Show more';
                this.querySelector('i').style.transform = 'rotate(0deg)';
            }
        });
    }
}

// Expand All Sections
function initExpandAllSections() {
    const expandAllBtn = document.getElementById('expandAllBtn');
    const accordionSections = document.querySelectorAll('.accordion-section-collapse');
    const accordionButtons = document.querySelectorAll('.accordion-section-header');

    if (expandAllBtn) {
        let allExpanded = false;

        expandAllBtn.addEventListener('click', function () {
            allExpanded = !allExpanded;

            accordionSections.forEach((section, index) => {
                const button = accordionButtons[index];

                if (allExpanded) {
                    section.classList.add('show');
                    button.classList.remove('collapsed');
                    button.setAttribute('aria-expanded', 'true');
                    this.innerHTML = '<i class="bi bi-arrows-angle-contract"></i> Collapse all sections';
                } else {
                    // Keep first section open
                    if (index === 0) {
                        section.classList.add('show');
                        button.classList.remove('collapsed');
                    } else {
                        section.classList.remove('show');
                        button.classList.add('collapsed');
                    }
                    button.setAttribute('aria-expanded', index === 0 ? 'true' : 'false');
                    this.innerHTML = '<i class="bi bi-arrows-angle-expand"></i> Expand all sections';
                }
            });
        });
    }
}

// Show More Sections Button
const showMoreSectionsBtn = document.getElementById('showMoreSectionsBtn');
if (showMoreSectionsBtn) {
    showMoreSectionsBtn.addEventListener('click', function () {
        // In production, this would load more sections dynamically
        alert('This would load more course sections. This is a demo.');
    });
}

// Video Preview
function initVideoPreview() {
    const previewButtons = document.querySelectorAll('.video-play-button, .purchase-play-btn, #previewVideoBtn');

    previewButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.stopPropagation();
            const videoUrl = this.dataset.promoVideo || this.dataset.videoUrl || '';
            showVideoModal(videoUrl);
        });
    });

    // Preview video wrappers
    const videoWrappers = document.querySelectorAll('.video-player-wrapper, .purchase-box-video');
    videoWrappers.forEach(wrapper => {
        wrapper.addEventListener('click', function () {
            const btn = this.querySelector('[data-promo-video]');
            const videoUrl = btn ? btn.dataset.promoVideo : '';
            showVideoModal(videoUrl);
        });
    });
}

// Helper function to extract YouTube video ID
function getYouTubeVideoId(url) {
    if (!url) return null;
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
}

// Helper function to extract Vimeo video ID
function getVimeoVideoId(url) {
    if (!url) return null;
    const regExp = /vimeo\.com\/(?:video\/)?(\d+)/;
    const match = url.match(regExp);
    return match ? match[1] : null;
}

function showVideoModal(videoUrl = '') {
    // Create modal overlay
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        animation: fadeIn 0.3s;
    `;

    const content = document.createElement('div');
    content.style.cssText = `
        max-width: 900px;
        width: 90%;
        background: #000;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    `;

    const videoContainer = document.createElement('div');
    videoContainer.style.cssText = `
        position: relative;
        padding-bottom: 56.25%;
        background: #000;
    `;

    // Try to embed the video
    let videoElement = null;
    const youtubeId = getYouTubeVideoId(videoUrl);
    const vimeoId = getVimeoVideoId(videoUrl);

    if (youtubeId) {
        // YouTube embed
        videoElement = document.createElement('iframe');
        videoElement.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0`;
        videoElement.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        `;
        videoElement.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        videoElement.allowFullscreen = true;
    } else if (vimeoId) {
        // Vimeo embed
        videoElement = document.createElement('iframe');
        videoElement.src = `https://player.vimeo.com/video/${vimeoId}?autoplay=1`;
        videoElement.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        `;
        videoElement.allow = 'autoplay; fullscreen; picture-in-picture';
        videoElement.allowFullscreen = true;
    } else if (videoUrl) {
        // Check if it's a direct video file (by extension or path pattern)
        const isVideoFile = /\.(mp4|webm|mov|avi|ogg)(\?.*)?$/i.test(videoUrl) ||
            videoUrl.includes('/uploads/') ||
            videoUrl.includes('/video/');

        if (isVideoFile) {
            // Direct video file
            videoElement = document.createElement('video');
            videoElement.src = videoUrl;
            videoElement.controls = true;
            videoElement.autoplay = true;
            videoElement.playsInline = true;
            videoElement.style.cssText = `
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: contain;
                background: #000;
            `;
            // Add error handling for video
            videoElement.onerror = function () {
                console.error('Video failed to load:', videoUrl);
                this.parentElement.innerHTML = `
                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;color:white;">
                        <i class="bi bi-exclamation-circle" style="font-size:3rem;opacity:0.5;"></i>
                        <span style="margin-top:1rem;">Video failed to load</span>
                    </div>
                `;
            };
        } else {
            // Unknown video format, show placeholder
            videoElement = document.createElement('div');
            videoElement.style.cssText = `
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.2rem;
                flex-direction: column;
                gap: 1rem;
            `;
            videoElement.innerHTML = `
                <i class="bi bi-film" style="font-size: 3rem; opacity: 0.5;"></i>
                <span>Unsupported video format</span>
            `;
        }
    } else {
        // No video URL at all
        videoElement = document.createElement('div');
        videoElement.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-direction: column;
            gap: 1rem;
        `;
        videoElement.innerHTML = `
            <i class="bi bi-film" style="font-size: 3rem; opacity: 0.5;"></i>
            <span>No preview video available</span>
        `;
    }

    const closeBtn = document.createElement('button');
    closeBtn.innerHTML = '<i class="bi bi-x-lg"></i>';
    closeBtn.style.cssText = `
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s;
        z-index: 10;
    `;

    closeBtn.addEventListener('mouseover', function () {
        this.style.background = 'rgba(255, 255, 255, 0.3)';
    });

    closeBtn.addEventListener('mouseout', function () {
        this.style.background = 'rgba(255, 255, 255, 0.2)';
    });

    closeBtn.addEventListener('click', function () {
        // Stop video playback when closing
        const iframe = modal.querySelector('iframe');
        const video = modal.querySelector('video');
        if (iframe) iframe.src = '';
        if (video) video.pause();
        document.body.removeChild(modal);
    });

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            const iframe = modal.querySelector('iframe');
            const video = modal.querySelector('video');
            if (iframe) iframe.src = '';
            if (video) video.pause();
            document.body.removeChild(modal);
        }
    });

    // ESC key to close
    const escHandler = function (e) {
        if (e.key === 'Escape') {
            const iframe = modal.querySelector('iframe');
            const video = modal.querySelector('video');
            if (iframe) iframe.src = '';
            if (video) video.pause();
            if (document.body.contains(modal)) {
                document.body.removeChild(modal);
            }
            document.removeEventListener('keydown', escHandler);
        }
    };
    document.addEventListener('keydown', escHandler);

    videoContainer.appendChild(videoElement);
    content.appendChild(videoContainer);
    content.appendChild(closeBtn);
    modal.appendChild(content);
    document.body.appendChild(modal);

    // Add fade in animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    `;
    if (!document.getElementById('modal-animations')) {
        style.id = 'modal-animations';
        document.head.appendChild(style);
    }
}

// Initialize Animations
function initAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.fade-in-up').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
}

// Sticky Purchase Box on Scroll (for mobile only)
window.addEventListener('scroll', function () {
    const purchaseBox = document.getElementById('purchaseBox');
    if (!purchaseBox) return;

    if (window.innerWidth <= 992) {
        const scrollPosition = window.scrollY;

        if (scrollPosition > 500) {
            purchaseBox.style.position = 'fixed';
            purchaseBox.style.bottom = '0';
            purchaseBox.style.left = '0';
            purchaseBox.style.right = '0';
            purchaseBox.style.top = 'auto';
            purchaseBox.style.zIndex = '1000';
            purchaseBox.style.boxShadow = '0 -4px 12px rgba(0, 0, 0, 0.15)';
            purchaseBox.style.borderRadius = '16px 16px 0 0';
        } else {
            purchaseBox.style.position = '';
            purchaseBox.style.bottom = '';
            purchaseBox.style.left = '';
            purchaseBox.style.right = '';
            purchaseBox.style.top = '';
            purchaseBox.style.zIndex = '';
            purchaseBox.style.boxShadow = '';
            purchaseBox.style.borderRadius = '';
        }
    } else {
        // Desktop: Reset all inline styles to let CSS take over
        purchaseBox.style.position = '';
        purchaseBox.style.bottom = '';
        purchaseBox.style.left = '';
        purchaseBox.style.right = '';
        purchaseBox.style.top = '';
        purchaseBox.style.zIndex = '';
        purchaseBox.style.boxShadow = '';
        purchaseBox.style.borderRadius = '';
    }
});

// Also reset on resize
window.addEventListener('resize', function () {
    const purchaseBox = document.getElementById('purchaseBox');
    if (!purchaseBox) return;

    if (window.innerWidth > 992) {
        // Desktop: Clear all inline styles
        purchaseBox.style.position = '';
        purchaseBox.style.bottom = '';
        purchaseBox.style.left = '';
        purchaseBox.style.right = '';
        purchaseBox.style.top = '';
        purchaseBox.style.zIndex = '';
        purchaseBox.style.boxShadow = '';
        purchaseBox.style.borderRadius = '';
    }
});

// Preview Lecture Buttons
const previewLectureBtns = document.querySelectorAll('.btn-preview');
previewLectureBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        const videoUrl = this.dataset.videoUrl || '';
        showVideoModal(videoUrl);
    });
});

// Buy Now Button
const buyNowBtn = document.querySelector('.btn-buy-now-purchase');
if (buyNowBtn) {
    buyNowBtn.addEventListener('click', function () {
        // Get course ID
        const urlParams = new URLSearchParams(window.location.search);
        const courseId = parseInt(urlParams.get('id')) || 1;

        // Add to cart
        if (typeof addToCart === 'function') {
            addToCart(courseId);
        }

        // Redirect to payment
        window.location.href = 'payment.php';
    });
}

// Share Button
const shareBtn = document.querySelector('.btn-share-purchase');
if (shareBtn) {
    shareBtn.addEventListener('click', function () {
        if (navigator.share) {
            navigator.share({
                title: document.title,
                url: window.location.href
            }).catch(err => console.log('Error sharing:', err));
        } else {
            // Fallback: Copy to clipboard
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Link copied to clipboard!');
            });
        }
    });
}

// Gift Button
const giftBtn = document.querySelector('.btn-gift-purchase');
if (giftBtn) {
    giftBtn.addEventListener('click', function () {
        alert('Gift functionality coming soon!');
    });
}

// Apply Coupon Button
const applyCouponBtn = document.querySelector('.btn-apply-coupon');
if (applyCouponBtn) {
    applyCouponBtn.addEventListener('click', function () {
        const couponCode = prompt('Enter your coupon code:');
        if (couponCode) {
            // In production, this would validate the coupon
            alert('Coupon validation would happen here. This is a demo.');
        }
    });
}

// Helpful Review Buttons
const helpfulBtns = document.querySelectorAll('.btn-helpful');
helpfulBtns.forEach(btn => {
    btn.addEventListener('click', function () {
        const icon = this.querySelector('i');
        const isThumbsUp = icon.classList.contains('bi-hand-thumbs-up');

        // Toggle active state
        this.classList.toggle('active');

        if (this.classList.contains('active')) {
            this.style.background = '#f7f9fa';
            this.style.borderColor = '#5624d0';
            this.style.color = '#5624d0';
        } else {
            this.style.background = 'transparent';
            this.style.borderColor = '#d1d7dc';
            this.style.color = '#2d2f31';
        }
    });
});

// Show All Reviews Button
const showAllReviewsBtn = document.querySelector('.btn-show-more-reviews');
if (showAllReviewsBtn) {
    showAllReviewsBtn.addEventListener('click', function () {
        // In production, this would load all reviews
        alert('This would show all reviews. This is a demo.');
    });
}
