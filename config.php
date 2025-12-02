<?php
// Configuration for LMS

// Detect if we're in root or subdirectory
function getBasePath() {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']));
    $configDir = str_replace('\\', '/', __DIR__);
    
    // If we are in the root (where config.php is)
    if ($scriptDir === $configDir) {
        return './';
    }
    
    // Check if script is inside config dir
    if (strpos($scriptDir, $configDir) === 0) {
        $subPath = substr($scriptDir, strlen($configDir));
        // Count slashes to determine depth
        // e.g. /pages -> 1 slash -> depth 1
        // e.g. /pages/admin -> 2 slashes -> depth 2
        $depth = substr_count($subPath, '/');
        
        if ($depth > 0) {
            return str_repeat('../', $depth);
        }
    }
    
    return './';
}

// Helper for assets (CSS, JS, images)
function asset($path) {
    $base = getBasePath();
    return $base . ltrim($path, '/');
}

// Helper for page URLs
function url($path) {
    $base = getBasePath();
    return $base . ltrim($path, '/');
}
?>
