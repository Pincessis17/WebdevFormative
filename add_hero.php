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
    'publishers' => 'Marvel Comics'
    'gender' => 'Active',
    'image_url' => '';
];




?>