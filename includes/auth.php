<?php
// Authentication functions

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is currently logged in
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']) && isset($_SESSION['username']);
}

// Redirect to login if the user is not authenticated
function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}