<?php
session_start();
require_once "../config.php";

$query = "
    SELECT 
        accounts.account_id,
        accounts.account_number,
        accounts.balance,
        accounts.account_type,
        customers.full_name AS customer_name
    FROM accounts
    JOIN customers ON accounts.customerid = customers.customer_id
    ORDER BY accounts.account_id DESC
";

$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bankly — Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/output.css">
</head>

<body class="bg-[#0e0e0e] text-white flex">

<aside class="w-64 bg-[#161616] h-screen p-6 fixed border-r border-[#242424]">
    <h1 class="text-2xl font-bold text-red-600 mb-10">Bankly</h1>
    <nav class="space-y-4">
        <a href="../dashboard.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Dashboard</a>
        <a href="../clients/list_clients.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Customers</a>
        <a href="list_accounts.php" class="block px-3 py-2 rounded-lg bg-red-600/20 text-red-500 font-semibold">Accounts</a>
        <a href="../logout.php" class="block px-3 py-2 rounded-lg text-red-500 hover:bg-[#1f1f1f]">Logout</a>
    </nav>
</aside>

<main class="ml-64 p-8 w-full">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold">Accounts</h2>
        <span class="text-gray-300">
            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
        </span>
    </div>

    <div class="mb-6">
        <a href="add_account.php"
           class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold">
            + Add Account
        </a>
    </div>

    <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
        <h3 class="text-xl font-bold mb-4">Accounts List</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 border-b border-[#242424]">
                        <th class="pb-3">ID</th>
                        <th class="pb-3">Account #</th>
                        <th class="pb-3">Customer</th>
                        <th class="pb-3">Type</th>
                        <th class="pb-3">Balance</th>
                        <th class="pb-3">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-gray-300">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="border-b border-[#242424] hover:bg-[#222222] transition">
                        <td class="py-3"><?php echo $row['account_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['account_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['account_type']); ?></td>
                        <td class="font-semibold">
                            <?php echo number_format($row['balance'], 2); ?> MAD
                        </td>
                        <td class="flex gap-3 py-3">
                            <a href="edit_account.php?id=<?php echo (int)$row['account_id']; ?>"
                               class="text-blue-400 hover:underline">Edit</a>

                            <a href="delete_account.php?id=<?php echo (int)$row['account_id']; ?>"
                               onclick="return confirm('Delete this account?')"
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
