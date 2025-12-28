<?php
session_start();
require_once "../config/config.php";

$userName = $_SESSION['user_name'];
$initial  = strtoupper(substr($userName, 0, 1));

$query = "
    SELECT 
        t.transaction_id,
        t.transaction_type,
        t.amount,
        t.transaction_date,
        cp.account_number,
        cl.full_name AS customer_name
    FROM transactions t
    JOIN comptes cp ON t.account_id = cp.account_id
    JOIN clients cl ON cp.client_id = cl.client_id
    ORDER BY t.transaction_id DESC
";

$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bankly — Transactions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/output.css">
</head>

<body class="bg-[#0e0e0e] text-white flex">

<aside class="w-64 bg-[#161616] h-screen p-6 fixed border-r border-[#242424]">
    <h1 class="text-2xl font-bold text-red-600 mb-10">Bankly</h1>
    <nav class="space-y-4">
        <a href="../dashboard/dashboard.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Dashboard</a>
        <a href="../clients/list_clients.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Customers</a>
        <a href="../accounts/list_accounts.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Accounts</a>
        <a href="list_transactions.php" class="block px-3 py-2 rounded-lg bg-red-600/20 text-red-500 font-semibold">Transactions</a>
        <a href="../auth/logout.php" class="block px-3 py-2 rounded-lg text-red-500 hover:bg-[#1f1f1f]">Logout</a>
    </nav>
</aside>

<main class="ml-64 p-8 w-full">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold">Transactions</h2>
        <div class="flex items-center gap-3 bg-[#1a1a1a] px-4 py-2 rounded-lg">
            <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center font-bold">
                <?php echo $initial; ?>
            </div>
            <span class="text-gray-300"><?php echo htmlspecialchars($userName); ?></span>
        </div>
    </div>

    <div class="mb-6">
        <a href="make_transaction.php"
           class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold">
            + Make Transactions
        </a>
    </div>

    <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
        <h3 class="text-xl font-bold mb-4">Transactions List</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 border-b border-[#242424]">
                        <th class="pb-3">ID</th>
                        <th class="pb-3">Account #</th>
                        <th class="pb-3">Customer</th>
                        <th class="pb-3">Type</th>
                        <th class="pb-3">Amount</th>
                        <th class="pb-3">Date</th>
                    </tr>
                </thead>

                <tbody class="text-gray-300">
                <?php while ($row = mysqli_fetch_assoc($result)) { 
                    $type_class = ($row['transaction_type'] == 'credit') ? 'text-green-500' : 'text-red-500';
                    $sign = ($row['transaction_type'] == 'credit') ? '+' : '-';
                ?>
                    <tr class="border-b border-[#242424] hover:bg-[#222222] transition">
                        <td class="py-3"><?php echo $row['transaction_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['account_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                        <td class="<?php echo $type_class; ?> font-semibold"><?php echo ucfirst($row['transaction_type']); ?></td>
                        <td><?php echo $sign . ' ' . number_format($row['amount'], 2); ?> MAD</td>
                        <td><?php echo $row['transaction_date']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</main>

</body>
</html>
