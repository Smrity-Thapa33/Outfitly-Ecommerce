<?php

session_start(); 
include_once "header.php";
?>

<div class="container">
    <div id="login_form">

        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-error">
                <?php
                    echo htmlspecialchars($_SESSION['login_error']);
                    unset($_SESSION['login_error']); 
                ?>
            </div>
        <?php endif; ?>

        <h2>Login</h2>

        <form action="login_process.php" method="post">
            <div>
                <label for="username">Email</label>
                <input type="email" id="username" name="username" placeholder="Enter your email" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div>
                <input type="submit" value="Login" id="login_btn">
            </div>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>

    </div>
</div>

<?php include_once "footer.php"; ?>