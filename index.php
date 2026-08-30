<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

$pageTitle = 'All Heroes';

// Fetch all heroes from the database
$stmt = $pdo->query("SELECT id, hero_name, real_name, short_bio, image_url, status FROM heroes ORDER BY hero_name ASC");
$heroes = $stmt->fetchAll();

require_once 'includes/header.php';
?>

<h1>Meet the Team</h1>
<p class="subtitle">Every mutant currently on record at Xavier's School for Gifted Youngsters.</p>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Hero deleted successfully.</div>
<?php endif; ?>
<?php if (isset($_GET['added'])): ?>
    <div class="alert alert-success">Hero added successfully.</div>
<?php endif; ?>

<div class="hero-grid">
    <?php if (empty($heroes)): ?>
        <p>No heroes on file yet.</p>
    <?php endif; ?>

    <?php foreach ($heroes as $hero): ?>
        <div class="hero-card">
            <div class="hero-card-img">
                <?php if (!empty($hero['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($hero['image_url']); ?>" alt="<?php echo htmlspecialchars($hero['hero_name']); ?>" onerror="this.style.display='none'">
                <?php else: ?>
                    <div class="hero-card-placeholder">🦸</div>
                <?php endif; ?>
            </div>
            <div class="hero-card-body">
                <h2><?php echo htmlspecialchars($hero['hero_name']); ?></h2>
                <p class="real-name"><?php echo htmlspecialchars($hero['real_name']); ?></p>
                <p class="short-bio"><?php echo htmlspecialchars($hero['short_bio']); ?></p>
                <span class="badge badge-<?php echo strtolower(htmlspecialchars($hero['status'] ?? 'active')); ?>">
                    <?php echo htmlspecialchars($hero['status'] ?? 'Active'); ?>
                </span>
                <div class="hero-card-actions">
                    <a href="hero.php?id=<?php echo (int) $hero['id']; ?>" class="btn btn-secondary">View Details</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
