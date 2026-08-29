<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

// If already logged in, no need to see this page
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter both a username and password.';
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}

$pageTitle = 'Login';
require_once 'includes/header.php';
?>

<div class="form-page">
    <h1>Login</h1>
    <p class="subtitle">Authorized personnel only.</p>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php" class="app-form" id="login-form" novalidate>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <div class="form-error" id="form-error"></div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p class="hint">No account? <a href="register.php">Register here</a>.</p>
    <p class="hint small">Demo credentials: <code>professorx</code> / <code>xavier123</code></p>
</div>

<script src="js/validation.js"></script>
<?php require_once 'includes/footer.php'; ?>
