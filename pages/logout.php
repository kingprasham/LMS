<?php
session_start();
require_once('../includes/auth_functions.php');

// Destroy session
destroySession();

// Redirect to home page
header('Location: ../index.php');
exit;
?>
