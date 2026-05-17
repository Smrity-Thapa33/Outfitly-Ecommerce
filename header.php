<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outfitly</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/validation.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>

<div id="navbar">
    <div id="logo">
        <img src="assets/images/logo1.png" alt="Outfitly logo">
    </div>

    <div id="nav">
        <a href="index.php">Home</a>
        <a href="product.php">Products</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </div>

    <div id="login_register">
        <?php if (isset($_SESSION['user_id'])): ?>
            <span>Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
            <a href="dashboard.php">My Account</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</div>