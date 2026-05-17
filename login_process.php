<?php

session_start();

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email    = trim($_POST['username'] ?? ''); 
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['login_error'] = "Please fill in all fields.";
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, firstname, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(); 


if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['login_error'] = "Invalid email or password.";
    header('Location: login.php');
    exit;
}


session_regenerate_id(true);

$_SESSION['user_id']   = $user['id'];
$_SESSION['user_name'] = $user['firstname'];

header('Location: dashboard.php');
exit;
?>