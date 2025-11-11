<?php
// cek posisi file (kalau di index.php, naikkan path-nya)
$base_path = dirname($_SERVER['SCRIPT_NAME']);
$base_path = str_replace('/view', '', $base_path);
?>

<link rel="stylesheet" href="<?= $base_path ?>/style.css">

<nav>
    <a href="<?= $base_path ?>/index.php">Home</a>
    <a href="<?= $base_path ?>/view/products.php">Products</a>
    <a href="<?= $base_path ?>/view/categories.php">Categories</a>
    <a href="<?= $base_path ?>/view/users.php">Users</a>
</nav>

<div class="container">
