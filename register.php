<?php
session_start();
include_once "header.php";

$old = $_SESSION['old_input'] ?? [];
unset($_SESSION['old_input']);
?>

<div class="container-box">
    <div id="register_form">

        <?php if (!empty($_SESSION['errors'])): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <h2>Create an Account</h2>

        <form action="register_process.php" method="post" onsubmit="return validateRegister()">
            <div>
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname"
                       placeholder="Enter your first name"
                       value="<?php echo htmlspecialchars($old['firstname'] ?? ''); ?>">
                <span id="firstname-error"></span>
            </div>
            <div>
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname"
                       placeholder="Enter your last name"
                       value="<?php echo htmlspecialchars($old['lastname'] ?? ''); ?>">
                <span id="lastname-error"></span>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                       placeholder="Enter your email"
                       value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
                <span id="email-error"></span>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                       placeholder="At least 6 characters">
                <span id="password-error"></span>
            </div>
            <div class="terms">
                <input type="checkbox" id="terms" name="terms" value="1" required>
                <label for="terms">I agree to the terms and conditions</label>
            </div>
            <div>
                <input type="submit" value="Register" id="register_btn">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>

    </div>
</div>

<?php include_once "footer.php"; ?>