<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$email, $username, $hashed_password])) {
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['email'] = $email;

        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Registration failed. Try again.";
        header("Location: register.php");
        exit();
    }
}
?>
