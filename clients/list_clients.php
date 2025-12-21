<?php
session_start();
require_once "../config/config.php";

$userName = $_SESSION['user_name'];
$initial  = strtoupper(substr($userName, 0, 1));

$stmt = mysqli_prepare(
    $connect,
    "SELECT client_id, full_name, email, cin FROM clients ORDER BY client_id DESC"
);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bankly — Customers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/output.css">
</head>

<body class="bg-[#0e0e0e] text-white flex">

<aside class="w-64 bg-[#161616] h-screen p-6 fixed border-r border-[#242424]">
    <h1 class="text-2xl font-bold text-red-600 mb-10">Bankly</h1>
    <nav class="space-y-4">
        <a href="../dashboard/dashboard.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Dashboard</a>
        <a href="list_clients.php" class="block px-3 py-2 rounded-lg bg-red-600/20 text-red-500 font-semibold">Customers</a>
        <a href="../accounts/list_accounts.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Accounts</a>
        <a href="../auth/logout.php" class="block px-3 py-2 rounded-lg text-red-500 hover:bg-[#1f1f1f]">Logout</a>
    </nav>
</aside>

<main class="ml-64 p-8 w-full">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold">Customers</h2>
            <div class="flex items-center gap-3 bg-[#1a1a1a] px-4 py-2 rounded-lg">
        <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center font-bold">
            <?php echo $initial; ?>
        </div>
        <span class="text-gray-300"><?php echo htmlspecialchars($userName); ?></span>
    </div>
    </div>

    <div class="mb-6">
        <a href="add_clients.php"
           class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold">
            + Add Customer
        </a>
    </div>

    <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
        <h3 class="text-xl font-bold mb-4">Customers List</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                <tr class="text-gray-400 border-b border-[#242424]">
                    <th class="pb-3">ID</th>
                    <th class="pb-3">Full Name</th>
                    <th class="pb-3">Email</th>
                    <th class="pb-3">CIN</th>
                    <th class="pb-3">Actions</th>
                </tr>
                </thead>


                <tbody class="text-gray-300">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr class="border-b border-[#242424] hover:bg-[#222222] transition">
                    <td class="py-3"><?php echo $row['client_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['cin']); ?></td>
                    <td class="flex gap-3 py-3">
                        <a href="edit_clients.php?id=<?php echo (int)$row['client_id']; ?>"
                        class="text-blue-400 hover:underline">Edit</a>

                        <a href="delete_clients.php?id=<?php echo (int)$row['client_id']; ?>"
                        onclick="return confirm('Delete this client?')"
                        class="text-red-500 hover:underline">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</main>

</body>
</html>
