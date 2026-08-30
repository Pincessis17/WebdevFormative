<?php 
require_once 'config/db.php';
require_once 'includes/auth.php';
requireLogin();

$error=''; //to capture error

$values = [
    'hero_name' => '',
    'real_name' => '',
    'short_bio' => '',
    'long_bio' => '',
    'powers' => '',
    'team' => '',
    'publisher' => 'Marvel Comics',
    'gender' => '',
    'status' => 'Active',
    'image_url' => '',
];

//Post method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Trimming values to remove whitespace
    foreach ($values as $key => $default) {
        $values[$key] = trim($_POST[$key] ?? $default);
    }

    //if any is empty, assign error message to $error
    if ($values['hero_name'] === '' ||  $values['real_name'] === '' ||$values['short_bio'] === '' ||$values['long_bio'] === '' ) {
        $error = 'Hero Name, Real Name, Short Biography and Long Biography are all required. Please fill all of them.'
    } else {
        //prepare data for processing
        $stmt = $pdo -> prepare("
            INSERT INTO heroes(hero_name, real_name, short_bio, long_bio, powers, team, publisher, gender, status, image_url)
            VALUES (:hero_name, :real_name, :short_bio, :long_bio, :powers, :team, :publisher, :gender, :status, :image_url)
        ");

        //Processes the prepared data
        $stmt -> execute($values);

        //redirects user to index.php, the main page
        header('Location: index.php');
        exit; //exits cleanly

    }

}




?>