<?php
include_once "header.php";
?>
<div class="container">
        <div id="login_form">
            <form action="login_process.php" method="post">
                <div>
                    <label> Username</label>
                    <input type="text" id="username" name="username">
                </div>
                <div>
                    <label> Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <div>
                    <input type="submit" value="login" id="login_btn">
                </div>
            </form>
        </div>
    </div>
<?php 
include_once "footer.php";
?>