<?php

$db_host = 'localhost';
$db_name = 'xmen_db';
$db_user = 'root';
$db_pass = '';       

try {
    $pdo = new PDO(
        "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4",
        $db_user,
        $db_pass
    );
    // Throw exceptions on errors instead of silently failing
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Return rows as associative arrays
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
