<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - Xavier\'s Roster' : "Xavier's Roster"; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="index.php" class="logo">🧬 Xavier's Roster</a>
            <nav class="main-nav">
                <a href="index.php">Heroes</a>
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="add_hero.php">Add Hero</a>
                    <span class="welcome">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="logout.php" class="btn-link">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn-link">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container">
