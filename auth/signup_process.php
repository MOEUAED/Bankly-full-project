<?php
require_once "config.php";
session_start();

if (isset($_POST['submit_s'])) {
    $full_name = htmlspecialchars($_POST['full_name_s']);
    $email = trim($_POST['email_s']);
    $password = $_POST['password_s'];
    $r_password = $_POST['r_password'];
    $role = 'agent';

    if ($password !== $r_password) {
        die("Passwords do not match");
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($connect, "SELECT user_id FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        die("This email already has an account");
    }

    $stmt = mysqli_prepare($connect, "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $full_name, $email, $password_hashed, $role);
    mysqli_stmt_execute($stmt);

    header("Location: login.php");
    exit;
}
?>