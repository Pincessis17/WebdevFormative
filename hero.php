<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM heroes WHERE id = :id");
$stmt->execute(['id' => $id]);
$hero = $stmt->fetch();

if (!$hero) {
    header('Location: index.php');
    exit;
}

$pageTitle = $hero['hero_name'];
require_once 'includes/header.php';
?>

<a href="index.php" class="back-link">&larr; Back to all heroes</a>

<div class="hero-detail">
    <div class="hero-detail-img">
        <?php if (!empty($hero['image_url'])): ?>
            <img src="<?php echo htmlspecialchars($hero['image_url']); ?>" alt="<?php echo htmlspecialchars($hero['hero_name']); ?>" onerror="this.style.display='none'">
        <?php else: ?>
            <div class="hero-card-placeholder large">🦸</div>
        <?php endif; ?>
    </div>

    <div class="hero-detail-body">
        <h1><?php echo htmlspecialchars($hero['hero_name']); ?></h1>
        <p class="real-name">Real name: <?php echo htmlspecialchars($hero['real_name']); ?></p>

        <div class="detail-meta">
            <span class="badge badge-<?php echo strtolower(htmlspecialchars($hero['status'] ?? 'active')); ?>">
                <?php echo htmlspecialchars($hero['status'] ?? 'Active'); ?>
            </span>
            <?php if (!empty($hero['team'])): ?><span class="tag">Team: <?php echo htmlspecialchars($hero['team']); ?></span><?php endif; ?>
            <?php if (!empty($hero['gender'])): ?><span class="tag">Gender: <?php echo htmlspecialchars($hero['gender']); ?></span><?php endif; ?>
            <?php if (!empty($hero['publisher'])): ?><span class="tag">Publisher: <?php echo htmlspecialchars($hero['publisher']); ?></span><?php endif; ?>
        </div>

        <?php if (!empty($hero['powers'])): ?>
            <p><strong>Powers:</strong> <?php echo htmlspecialchars($hero['powers']); ?></p>
        <?php endif; ?>

        <h3>Short Biography</h3>
        <p><?php echo nl2br(htmlspecialchars($hero['short_bio'])); ?></p>

        <h3>Full Biography</h3>
        <p><?php echo nl2br(htmlspecialchars($hero['long_bio'])); ?></p>

        <p class="meta-small">On file since <?php echo htmlspecialchars(date('F j, Y', strtotime($hero['date_created']))); ?></p>

        <?php if (isLoggedIn()): ?>
            <div class="hero-detail-actions">
                <a href="edit_hero.php?id=<?php echo (int) $hero['id']; ?>" class="btn btn-primary">Edit Hero</a>
                <form action="delete_hero.php" method="POST" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this hero? This cannot be undone.');">
                    <input type="hidden" name="id" value="<?php echo (int) $hero['id']; ?>">
                    <button type="submit" class="btn btn-danger">Delete Hero</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
