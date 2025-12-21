<?php
session_start();
require_once "../config/config.php";

if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit;
}

$userName = $_SESSION['user_name'];
$initial  = strtoupper(substr($userName, 0, 1));

$customersCount = mysqli_fetch_assoc(
    mysqli_query($connect, "SELECT COUNT(*) AS total FROM clients")
)['total'];

$accountsCount = mysqli_fetch_assoc(
    mysqli_query($connect, "SELECT COUNT(*) AS total FROM comptes")
)['total'];

$transactionsCount = mysqli_fetch_assoc(
    mysqli_query($connect, "SELECT COUNT(*) AS total FROM transactions")
)['total'];

$transactions = mysqli_query($connect, "
    SELECT transaction_id, transaction_type, amount, transaction_date
    FROM transactions
    ORDER BY transaction_date DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bankly — Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/output.css">
    <link rel="shortcut icon" href="assets/img/icon.png">
</head>

<body class="bg-[#0e0e0e] text-white flex">

<aside class="w-64 bg-[#161616] h-screen p-6 fixed border-r border-[#242424]">
    <h1 class="text-2xl font-bold text-red-600 mb-10">Bankly</h1>
    <nav class="space-y-4">
        <a href="dashboard.php" class="block px-3 py-2 rounded-lg bg-red-600/20 text-red-500 font-semibold">Dashboard</a>
        <a href="../clients/list_clients.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Customers</a>
        <a href="../accounts/list_accounts.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Accounts</a>
        <a href="../transactions/list_transactions.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Transactions</a>
        <a href="logout.php" class="block px-3 py-2 rounded-lg text-red-500 hover:bg-[#1f1f1f]">Logout</a>
    </nav>
</aside>

<main class="ml-64 p-8 w-full">

<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-bold">Dashboard</h2>

    <div class="flex items-center gap-3 bg-[#1a1a1a] px-4 py-2 rounded-lg">
        <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center font-bold">
            <?php echo $initial; ?>
        </div>
        <span class="text-gray-300"><?php echo htmlspecialchars($userName); ?></span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
        <p class="text-gray-400 text-sm">Total Customers</p>
        <h3 class="text-3xl font-bold mt-2"><?php echo $customersCount; ?></h3>
    </div>

    <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
        <p class="text-gray-400 text-sm">Total Accounts</p>
        <h3 class="text-3xl font-bold mt-2"><?php echo $accountsCount; ?></h3>
    </div>

    <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
        <p class="text-gray-400 text-sm">Total Transactions</p>
        <h3 class="text-3xl font-bold mt-2"><?php echo $transactionsCount; ?></h3>
    </div>

</div>

<div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
    <h3 class="text-xl font-bold mb-4">Recent Transactions</h3>

    <table class="w-full text-left">
        <thead>
            <tr class="text-gray-400 border-b border-[#242424]">
                <th class="pb-3">ID</th>
                <th class="pb-3">Type</th>
                <th class="pb-3">Amount</th>
                <th class="pb-3">Date</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
        <?php while ($t = mysqli_fetch_assoc($transactions)) { ?>
            <tr class="border-b border-[#242424] hover:bg-[#222]">
                <td class="py-3"><?php echo $t['transaction_id']; ?></td>
                <td class="<?php echo $t['transaction_type'] === 'credit' ? 'text-green-500' : 'text-red-500'; ?>">
                    <?php echo ucfirst($t['transaction_type']); ?>
                </td>
                <td><?php echo number_format($t['amount'], 2); ?> MAD</td>
                <td><?php echo date("Y-m-d H:i", strtotime($t['transaction_date'])); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</main>
</body>
</html>
