<?php 
require_once 'config/db.php';
require_once 'includes/auth.php';
requireLogin();

//if id is set, int = id, else post id 
$id = isset($_GET['id']) ? (int) $_GET['id'] : (int) ($_POST['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM heroes WHERE id = :id");
$stmt->execute(['id' => $id]);
$hero = $stmt->fetch();

//if hero was not found, return to index.php,  main page
if (!$hero) {
    header('Location: index.php');
    exit;
}

$error = '';
$values = $hero;

//Updating database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Trimming values to remove whitespace
    foreach ($values as $key => $default) {
        $values[$key] = trim($_POST[$key] ?? $default);
    }

    if ($values['hero_name'] === '' || $values['real_name'] === '' || $values['short_bio'] === '' || $values['long_bio'] === '') {
        //if anything is empty, return error
        $error = 'Hero Name, Real Name, Short Biography, and Long Biography are all required.';
    } else {
        //if all good, prepare data
        $update = $pdo->prepare("
        UPDATE heroes SET
            hero_name = :hero_name,
            real_name = :real_name,
            short_bio = :short_bio,
            long_bio  = :long_bio,
            powers    = :powers,
            team      = :team,
            publisher = :publisher,
            gender    = :gender,
            status    = :status,
            image_url = :image_url
        WHERE id = :id
        ");

        //execute the prepared data
        $update -> execute([
            'hero_name' => $values['hero_name'],
            'real_name' => $values['real_name'],
            'short_bio' => $values['short_bio'],
            'long_bio'  => $values['long_bio'],
            'powers'    => $values['powers'],
            'team'      => $values['team'],
            'publisher' => $values['publisher'],
            'gender'    => $values['gender'],
            'status'    => $values['status'],
            'image_url' => $values['image_url'],
            'id'        => $id,
        ]);

        //redirects header to index.php, the main page
        header('Location: index.php?update=1');
        exit; //exits cleanly

    }

}

$pageTitle = 'Edit' . $hero['hero_name'];
require_once 'includes/header.php'; //redirects user to header (which should be pointing to main page, index.php)

?>

<div class = "form-page"> 
    <h1>Edit Hero:<?php echo htmlspecialchars($hero['hero_name']); ?> </h1>


    //error message if there is an error
    <?php if ($error): ?>
        <div class = "alert alert-error"> <?php echo htmlspecialchars($error); ?> </div>
    <? endif; ?>

    <form method = "POST" action="edit_hero.php" class="add-form" id = "hero-form" novalidate>

        <label for = "hero_name"> Hero Name *</label>
        <input type="text" id="hero_name" name="hero_name" required value="<?php echo htmlspecialchars($values['hero_name']); ?>">

        <label for = "real_name"> Real Name *</label>
        <input type="text" id="real_name" name="real_name" required value="<?php echo htmlspecialchars($values['real_name']); ?>">

        <label for = "short_bio"> Short Biography *</label>
        <textarea id="short_bio" name="short_bio" rows="2" required><?php echo htmlspecialchars($values['short_bio']); ?></textarea>


        <label for = "long_bio"> Long  Biography *</label>
        <textarea id="long_bio" name="long_bio" rows="6" required><?php echo htmlspecialchars($values['long_bio']); ?></textarea>


        <label for = "powers"> Powers *</label>
        <input type="text" id="powers" name="powers" value="<?php echo htmlspecialchars($values['powers']); ?>">


        <label for = "team"> Team *</label>
        <input type="text" id="team" name="team" value="<?php echo htmlspecialchars($values['team']); ?>">


        <label for = "publisher"> Publisher *</label>
        <input type="text" id="publisher" name="publisher" value="<?php echo htmlspecialchars($values['publisher']); ?>">


        <label for = "gender"> Gender *</label>
        <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($values['gender']); ?>">


        <label for = "status"> Status *</label>
        <select id = 'status' name = "status">
            <?php foreach (['Active', 'Inactive', 'Deceased', 'Unknown'] as $opt): ?>
                    <option value="<?php echo $opt; ?>" <?php echo $values['status'] === $opt ? 'selected' : ''; ?>><?php echo $opt; ?></option>
            <?php endforeach; ?>
        </select>


        <label for="image_url">Image URL</label>
        <input type="url" id="image_url" name="image_url" placeholder="https://..." value="<?php echo htmlspecialchars($values['image_url']); ?>">


        <div class="form-error" id="form-error"></div>

        <button type="submit" class="btn btn-primary">Save Hero</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>


    </form>

</div>

<script src="js/validation.js"></script>
<?php require_once 'includes/footer.php'; ?>
