<?php
require_once 'config/db.php';
require_once 'includes/auth.php';
requirelogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0 ) {
        //Prepares data for deletion
        $stmt = $pdo -> prepare("DELETE FROM heroes WHERE id = :id");
        //executes the deletion
        $stmt -> execute(['id' => $id]);
    }

    //updating header
    header('Location: index.php?deleted=1');
    exit; //exiting clealy
}

 // no closing tag as the file only has php