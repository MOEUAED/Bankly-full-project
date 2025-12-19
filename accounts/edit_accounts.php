<?php
session_start();
require_once "../config.php";

if (!isset($_GET['id'])) {
    header("Location: list_accounts.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = mysqli_prepare($connect, "SELECT * FROM accounts WHERE account_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$account = mysqli_fetch_assoc($result);

if (!$account) {
    header("Location: list_accounts.php");
    exit;
}

$customers = mysqli_query($connect, "SELECT customer_id, full_name FROM customers");

if (isset($_POST['submit'])) {
    $account_number = trim($_POST['account_number']);
    $account_type   = $_POST['account_type'];
    $balance        = (float)$_POST['balance'];
    $customerid     = (int)$_POST['customerid'];

    $stmt = mysqli_prepare(
        $connect,
        "UPDATE accounts 
         SET account_number = ?, balance = ?, account_type = ?, customerid = ?
         WHERE account_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sdsii",
        $account_number,
        $balance,
        $account_type,
        $customerid,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: list_accounts.php?msg=updated");
        exit;
    } else {
        $error = mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Account</title>
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

    <h2 class="text-3xl font-bold mb-8">Edit Account</h2>

    <?php if (isset($error)) { ?>
        <div class="bg-red-600/20 text-red-500 p-4 rounded mb-6">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php } ?>

    <form method="POST" class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424] max-w-xl">

        <div class="mb-4">
            <label class="block mb-2 text-gray-400">Account Number</label>
            <input type="text" name="account_number" required
                   value="<?php echo htmlspecialchars($account['account_number']); ?>"
                   class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 text-gray-400">Account Type</label>
            <select name="account_type" required
                    class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
                <?php
                $types = ['Checking', 'Savings', 'Business'];
                foreach ($types as $type) {
                    $selected = ($account['account_type'] === $type) ? 'selected' : '';
                    echo "<option value='$type' $selected>$type</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2 text-gray-400">Balance</label>
            <input type="number" step="0.01" name="balance"
                   value="<?php echo $account['balance']; ?>"
                   class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-gray-400">Customer</label>
            <select name="customerid" required
                    class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
                <?php while ($c = mysqli_fetch_assoc($customers)) { ?>
                    <option value="<?php echo $c['customer_id']; ?>"
                        <?php if ($c['customer_id'] == $account['customerid']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($c['full_name']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit"
                class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg font-semibold">
            Update Account
        </button>

    </form>
</main>

</body>
</html>
