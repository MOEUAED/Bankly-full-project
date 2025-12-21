<?php
session_start();
require_once "../config/config.php";

if (!isset($_GET['id'])) {
    header("Location: list_clients.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = mysqli_prepare(
    $connect,
    "SELECT account_id FROM comptes WHERE client_id = ? LIMIT 1"
);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res) > 0) {
    header("Location: list_clients.php?error=has_accounts");
    exit;
}

$stmt = mysqli_prepare($connect, "DELETE FROM clients WHERE client_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: list_clients.php?msg=deleted");
    exit;
}

header("Location: list_clients.php?error=failed");
exit;
?>
