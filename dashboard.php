<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit; 
}

$userName = $_SESSION['user_name'];

include_once "header.php";
?>

<div class="container">

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php
                echo htmlspecialchars($_SESSION['success']);
                unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <div id="dashboard_content">
        <h2>Welcome back, <?php echo htmlspecialchars($userName); ?>!</h2>
        <p>You're logged in to your Outfitly account.</p>

        <div class="dashboard_links">
            <a href="index.php" class="btn">Browse Products</a>
            <a href="logout.php" class="btn btn-outline">Logout</a>
        </div>
    </div>

</div>

<?php include_once "footer.php"; ?>