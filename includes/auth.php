<?php
// Authentication functions

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/**
 * Returns true if a user is currently logged in.
 */
// Check if the user is currently logged in
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']) && isset($_SESSION['username']);
}


/**
 * Redirects to the login page if the user is not authenticated.
 * Call this at the top of any page that requires authentication
 * (e.g. add, edit, delete hero pages).
 */
// Redirect to login if the user is not authenticated
function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

