<?php
require_once "../config/config.php";
session_start();

if (isset($_POST['submit_l'])) {
    $email = trim($_POST['email_l']);
    $password = $_POST['password_l'];

    $stmt = mysqli_prepare($connect, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        header("Location: signup.php?email_not_found=1");
        exit;
    }

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        header("Location: ../dashboard/dashboard.php");
        exit;
    } else {
        header("Location: ../index.php?error=1");
        exit;
    }
}
?>
