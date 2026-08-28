<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if ($username === '' || $password === '' || $confirm === '') {
        $error = 'All fields are required.';
    } elseif (strlen($username) < 3) {
        $error = 'Username must be at least 3 characters.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        // Check if username already exists
        $check = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $check->execute(['username' => $username]);

        if ($check->fetch()) {
            $error = 'That username is already taken.';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $insert->execute(['username' => $username, 'password' => $hashed]);
            $success = 'Account created successfully! You can now log in.';
        }
    }
}

$pageTitle = 'Register';
require_once 'includes/header.php';
?>

<div class="form-page">
    <h1>Register</h1>
    <p class="subtitle">Create an account to manage the roster.</p>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?> <a href="login.php">Go to login</a></div>
    <?php endif; ?>

    <form method="POST" action="register.php" class="app-form" id="register-form" novalidate>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" minlength="3" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" minlength="6" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" minlength="6" required>

        <div class="form-error" id="form-error"></div>

        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>

    <p class="hint">Already have an account? <a href="login.php">Login here</a>.</p>
</div>

<script src="js/validation.js"></script>
<?php require_once 'includes/footer.php'; ?>
