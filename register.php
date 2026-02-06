<?php
include_once "header.php";
?>
<div class="container">
            <div id="register_form">
                <form action="process_register.php" method="post">
                <div>
                    <label>First Name</label> 
                    <input type="text" name="firstname" id="username" placeholder="Enter your first name">
                    <span id="firstname-error"></span>
                </div>
                <div>
                    <label>Last Name</label> 
                    <input type="text" name="lastname" id="lastname" placeholder="Enter your last name">
                    <span id="lastname-error"></span>
                </div>
                <div>
                    <label>Email</label> 
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                    <span id="email-error"></span>
                </div>
                <div>
                    <label>Password</label> 
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                    <span id="password-error"></span>
                </div>
                <div class="terms">
                    <input type="checkbox" id="terms" value="1">
                    <label for ="terms">I agree to the terms and conditions</label>
                </div>
                <div>
                    <label><input type="button" value="Register" id="register_btn" onclick="validate()"></label>
                </div>
            </form>
            </div>
        </div>
<?php
include_once "footer.php";
?>