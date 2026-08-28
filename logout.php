<?php
require_once 'includes/auth.php';

// Clear all session data and destroy the session
$_SESSION = [];
session_unset();
session_destroy();

header('Location: login.php');
exit;
