<?php
session_start();
require_once "../config/config.php";

$error = '';
$success = '';

$accounts = mysqli_query($connect, "
    SELECT a.account_id, a.account_number, c.full_name 
    FROM comptes a
    JOIN clients c ON a.client_id = c.client_id
    ORDER BY c.full_name ASC
");

if (isset($_POST['submit'])) {
    $account_id = (int)$_POST['account_id'];
    $type       = $_POST['transaction_type'];
    $amount     = (float)$_POST['amount'];

    if ($account_id <= 0 || $amount <= 0 || !in_array($type, ['credit', 'debit'])) {
        $error = "Please fill all fields correctly.";
    } else {
        $stmt = mysqli_prepare($connect, "SELECT balance FROM comptes WHERE account_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $account_id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $account = mysqli_fetch_assoc($res);

        if (!$account) {
            $error = "Invalid account selected.";
        } else {
            $new_balance = $account['balance'];
            if ($type == 'credit') {
                $new_balance += $amount;
            } else {
                if ($amount > $new_balance) {
                    $error = "Insufficient balance for debit.";
                } else {
                    $new_balance -= $amount;
                }
            }

            if (empty($error)) {
                $stmt = mysqli_prepare($connect, "
                    INSERT INTO transactions (account_id, transaction_type, amount, transaction_date)
                    VALUES (?, ?, ?, NOW())
                ");
                mysqli_stmt_bind_param($stmt, "isd", $account_id, $type, $amount);

                if (mysqli_stmt_execute($stmt)) {
                    $stmt_upd = mysqli_prepare($connect, "UPDATE comptes SET balance = ? WHERE account_id = ?");
                    mysqli_stmt_bind_param($stmt_upd, "di", $new_balance, $account_id);
                    mysqli_stmt_execute($stmt_upd);

                    $success = "Transaction successful!";
                } else {
                    $error = "Error: " . mysqli_error($connect);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make Transaction</title>
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
        <a href="list_transactions.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Transactions</a>
        <a href="../auth/logout.php" class="block px-3 py-2 rounded-lg text-red-500 hover:bg-[#1f1f1f]">Logout</a>
    </nav>
</aside>

<main class="ml-64 p-8 w-full">
    <h2 class="text-3xl font-bold mb-8">Make Transaction</h2>

    <?php if ($error) { ?>
        <div class="bg-red-600/20 text-red-500 p-4 rounded mb-6"><?php echo htmlspecialchars($error); ?></div>
    <?php } ?>
    <?php if ($success) { ?>
        <div class="bg-green-600/20 text-green-500 p-4 rounded mb-6"><?php echo htmlspecialchars($success); ?></div>
    <?php } ?>

    <form method="POST" class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424] max-w-xl">
        <div class="mb-4">
            <label class="block mb-2 text-gray-400">Account</label>
            <select name="account_id" required class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
                <option value="">Select account</option>
                <?php while ($a = mysqli_fetch_assoc($accounts)) { ?>
                    <option value="<?php echo $a['account_id']; ?>">
                        <?php echo htmlspecialchars($a['full_name'] . " — " . $a['account_number']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2 text-gray-400">Transaction Type</label>
            <select name="transaction_type" required class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
                <option value="">Select type</option>
                <option value="credit">Credit</option>
                <option value="debit">Debit</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-gray-400">Amount</label>
            <input type="number" step="0.01" name="amount" required class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
        </div>

        <button type="submit" name="submit" class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg font-semibold">
            Submit Transaction
        </button>
    </form>
</main>

</body>
</html>
