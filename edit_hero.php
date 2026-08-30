<?php 
require_once 'config/db.php';
require_once 'includes/auth.php';
requireLogin();




//Post method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Trimming values to remove whitespace
    foreach ($values as $key => $default) {
        $values[$key] = trim($_POST[$key] ?? $default);
    }


        //redirects header to index.php, the main page
        header('Location: index.php');
        exit; //exits cleanly

    }

}

$pageTitle = 'Add Hero';
require_once 'includes/header.php'; //redirects user to header (which should be pointing to main page, index.php)

?>

<!doctype html>
<div class = "form-page"> 
    <h1>Edit Hero:<?php echo htmlspecialchars($hero['hero_name']); ?> </h1>


    //error message if there is an error
    <? if ($error):
        <div className = "alert alert-error"> echo htmlspecialchars($error); <div>

    endif; ?>

    <form method = "POST" action="add_hero.php" class="add-form" id = "hero-form" novalidate>

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
        <input type="text" id="gender" name="gendegenderr" value="<?php echo htmlspecialchars($values['gender']); ?>">


        <label for = "status"> Status *</label>
        <?php foreach (['Active', 'Inactive', 'Deceased', 'Unknown'] as $opt): ?>
                <option value="<?php echo $opt; ?>" <?php echo $values['status'] === $opt ? 'selected' : ''; ?>><?php echo $opt; ?></option>
        <?php endforeach; ?>


        <label for="image_url">Image URL</label>
        <input type="url" id="image_url" name="image_url" placeholder="https://..." value="<?php echo htmlspecialchars($values['image_url']); ?>">


        <div class="form-error" id="form-error"></div>

        <button type="submit" class="btn btn-primary">Save Hero</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>


    </form>

</div>

<script src="js/validation.js"></script>
<?php require_once 'includes/footer.php'; ?>
