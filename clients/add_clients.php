<?php
session_start();
require_once "../config.php";

$error = '';

if (isset($_POST['submit'])) {

    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);

    if (empty($full_name) || empty($email)) {
        $error = "Full name and email are required.";
    } else {

        $stmt = mysqli_prepare($connect, "SELECT customer_id FROM customers WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($res) > 0) {
            $error = "This email already exists.";
        } else {

            $stmt = mysqli_prepare(
                $connect,
                "INSERT INTO customers (full_name, email, phone) VALUES (?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $phone);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: list_clients.php?msg=added");
                exit;
            } else {
                $error = "Error while adding client.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/output.css">
</head>

<body class="bg-[#0e0e0e] text-white flex">

<aside class="w-64 bg-[#161616] h-screen p-6 fixed border-r border-[#242424]">
    <h1 class="text-2xl font-bold text-red-600 mb-10">Bankly</h1>
    <nav class="space-y-4">
        <a href="../dashboard.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Dashboard</a>
        <a href="list_clients.php" class="block px-3 py-2 rounded-lg bg-red-600/20 text-red-500 font-semibold">Customers</a>
        <a href="../accounts/list_accounts.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Accounts</a>
        <a href="../logout.php" class="block px-3 py-2 rounded-lg text-red-500 hover:bg-[#1f1f1f]">Logout</a>
    </nav>
</aside>

<main class="ml-64 p-8 w-full">

    <h2 class="text-3xl font-bold mb-8">Add Client</h2>

    <?php if (!empty($error)) { ?>
        <div class="bg-red-600/20 text-red-500 p-4 rounded mb-6">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php } ?>

    <form method="POST" class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424] max-w-xl">

        <div class="mb-4">
            <label class="block mb-2 text-gray-400">Full Name</label>
            <input type="text" name="full_name" required
                   class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 text-gray-400">Email</label>
            <input type="email" name="email" required
                   class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-gray-400">Phone (optional)</label>
            <input type="text" name="phone"
                   class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
        </div>

        <button type="submit" name="submit"
                class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg font-semibold">
            Add Client
        </button>

    </form>

</main>
</body>
</html>
