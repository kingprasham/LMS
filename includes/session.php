<?php
/**
 * Centralized Session Management
 * Ensures consistent session configuration across the entire application
 */

if (session_status() === PHP_SESSION_NONE) {
    // Security: Session configuration
    // Prevent JavaScript access to session cookie
    ini_set('session.cookie_httponly', 1);
    
    // Prevent CSRF attacks by restricting cookie to same-site requests
    ini_set('session.cookie_samesite', 'Strict');
    
    // Ensure cookies are only sent over HTTPS if available (optional but recommended)
    // if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    //     ini_set('session.cookie_secure', 1);
    // }

    session_start();
}
?>
