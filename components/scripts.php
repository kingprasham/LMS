<?php
function renderScripts($additionalJS = []) {
    $base = getBasePath();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $base; ?>js/main.js?v=<?php echo time(); ?>"></script>
<?php foreach ($additionalJS as $js): ?>
<script src="<?php echo $base . $js; ?>?v=<?php echo time(); ?>"></script>
<?php endforeach; ?>

<!-- Video Modal -->
<div id="videoModal" class="video-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
    <div class="video-container" style="position: relative; width: 90%; max-width: 800px; aspect-ratio: 16/9; background: black;">
        <button onclick="closeVideo()" style="position: absolute; top: -40px; right: 0; color: white; background: none; border: none; font-size: 2rem; cursor: pointer;">&times;</button>
        <iframe id="videoFrame" width="100%" height="100%" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

<script>
function openVideo(videoId) {
    const modal = document.getElementById('videoModal');
    const frame = document.getElementById('videoFrame');
    // Use YouTube embed URL with autoplay
    frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    modal.style.display = 'flex';
}

function closeVideo() {
    const modal = document.getElementById('videoModal');
    const frame = document.getElementById('videoFrame');
    frame.src = ''; // Stop video
    modal.style.display = 'none';
}

// Close modal on click outside
document.getElementById('videoModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeVideo();
    }
});
</script>
</body>
</html>
<?php
}
?>
