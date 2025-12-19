<?php
session_start();
require_once "../config.php";

if (!isset($_GET['id'])) {
    header("Location: list_accounts.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = mysqli_prepare($connect, "DELETE FROM comptes WHERE account_id = ?");
if (!$stmt) {
    die(mysqli_error($connect));
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: list_accounts.php?msg=deleted");
        exit;
    } else {
        echo "No account found with this ID.";
    }
} else {
    echo mysqli_error($connect);
}

mysqli_stmt_close($stmt);
?>
