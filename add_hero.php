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
    'publishers' => 'Marvel Comics',
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

    

}




?>