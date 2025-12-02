document.addEventListener('DOMContentLoaded', () => {
    // Video Player Logic
    const video = document.getElementById('courseVideo');
    const playBtn = document.getElementById('playBtn');
    const playIcon = playBtn.querySelector('i');
    const progressBar = document.querySelector('.progress-fill');
    const progressContainer = document.querySelector('.progress-bar-container');
    const speedBtn = document.getElementById('speedBtn');

    // Play/Pause Toggle
    function togglePlay() {
        if (video.paused) {
            video.play();
            playIcon.classList.replace('fa-play', 'fa-pause');
        } else {
            video.pause();
            playIcon.classList.replace('fa-pause', 'fa-play');
        }
    }

    playBtn.addEventListener('click', togglePlay);
    video.addEventListener('click', togglePlay);

    // Update Progress Bar
    video.addEventListener('timeupdate', () => {
        const percent = (video.currentTime / video.duration) * 100;
        progressBar.style.width = `${percent}%`;
    });

    // Click on Progress Bar
    progressContainer.addEventListener('click', (e) => {
        const width = progressContainer.clientWidth;
        const clickX = e.offsetX;
        const duration = video.duration;
        video.currentTime = (clickX / width) * duration;
    });

    // Speed Control
    speedBtn.addEventListener('click', () => {
        let currentSpeed = video.playbackRate;
        let newSpeed = 1.0;
        if (currentSpeed === 1.0) newSpeed = 1.5;
        else if (currentSpeed === 1.5) newSpeed = 2.0;
        else if (currentSpeed === 2.0) newSpeed = 0.5;

        video.playbackRate = newSpeed;
        speedBtn.textContent = `${newSpeed}x`;
    });

    // Tab Switching Logic
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            // Add active class to clicked
            btn.classList.add('active');
            const targetId = btn.getAttribute('data-tab');
            document.getElementById(targetId).classList.add('active');
        });
    });

    // Sidebar Accordion Logic
    const moduleHeaders = document.querySelectorAll('.module-header');

    moduleHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const targetId = header.getAttribute('data-target');
            const content = document.getElementById(targetId);
            const icon = header.querySelector('.fa-chevron-down');

            // Toggle display
            if (content.style.display === 'block') {
                content.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            } else {
                content.style.display = 'block';
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });

    // Mark as Complete Logic (Mock)
    const lessonItems = document.querySelectorAll('.lesson-item');
    lessonItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // If clicking the checkbox specifically
            if (e.target.closest('.checkbox')) {
                e.stopPropagation();
                item.classList.toggle('completed');
            } else {
                // Navigate to lesson (visual only for now)
                lessonItems.forEach(l => l.classList.remove('active'));
                item.classList.add('active');
                // Here you would normally load the new video source
            }
        });
    });
});
