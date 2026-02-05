<?php
//if username and password are empty, redirect to loginpage
if(empty($_POST["username"])|empty($_POST["password"])){
    header("Location: login.php");
}
$user = $_POST["username"];
$pass = $_POST["password"];
if($user=="admin" & $pass=="123"){
    header("Location: dashboard.php");
} else{
    header("Location: login.php");
}
?>