<?php

session_start();

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit; 
}

$firstname = trim($_POST['firstname'] ?? '');
$lastname  = trim($_POST['lastname']  ?? '');
$email     = trim($_POST['email']     ?? '');
$password  = $_POST['password']       ?? ''; 

$errors = []; 

if (empty($firstname)) {
    $errors[] = "First name is required.";
}
if (empty($lastname)) {
    $errors[] = "Last name is required.";
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "A valid email address is required.";
}
if (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old_input'] = compact('firstname', 'lastname', 'email'); 
    header('Location: register.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    $_SESSION['errors'] = ["An account with that email already exists."];
    $_SESSION['old_input'] = compact('firstname', 'lastname', 'email');
    header('Location: register.php');
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
    "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)"
);
$stmt->execute([$firstname, $lastname, $email, $hashedPassword]);

$_SESSION['user_id']   = $pdo->lastInsertId(); 
$_SESSION['user_name'] = $firstname;

$_SESSION['success'] = "Welcome to Outfitly, $firstname!";
header('Location: dashboard.php');
exit;
?>