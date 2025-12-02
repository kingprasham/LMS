document.addEventListener('DOMContentLoaded', () => {
    // Timer Logic
    const timerDisplay = document.getElementById('quizTimer');
    const timerBadge = document.querySelector('.timer-badge');

    if (timerDisplay) {
        let timeLeft = 15 * 60; // 15 minutes in seconds

        const updateTimer = () => {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;

            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            // Critical warning
            if (timeLeft <= 60) {
                timerBadge.classList.add('critical');
            }

            if (timeLeft === 0) {
                clearInterval(timerInterval);
                alert('Time is up! Submitting quiz...');
                // document.getElementById('quizForm').submit();
            } else {
                timeLeft--;
            }
        };

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer(); // Initial call
    }

    // Option Selection Logic (Visual Feedback)
    const options = document.querySelectorAll('.option-input');
    const navBtns = document.querySelectorAll('.q-nav-btn');

    options.forEach(option => {
        option.addEventListener('change', (e) => {
            // Find parent question ID
            const questionCard = e.target.closest('.question-card');
            const questionId = questionCard.getAttribute('id'); // e.g., "q1"

            // Update sidebar nav
            const navBtn = document.querySelector(`.q-nav-btn[data-target="${questionId}"]`);
            if (navBtn) {
                navBtn.classList.add('answered');
            }
        });
    });

    // File Upload Logic (Assignment)
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const removeFileBtn = document.getElementById('removeFile');

    if (dropZone) {
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
            const files = e.dataTransfer.files;
            if (files.length) handleFile(files[0]);
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) handleFile(fileInput.files[0]);
        });

        function handleFile(file) {
            fileName.textContent = file.name;
            filePreview.classList.add('active');
            dropZone.style.display = 'none';
        }

        removeFileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.value = '';
            filePreview.classList.remove('active');
            dropZone.style.display = 'block';
        });
    }
});
