<?php
session_start();
require_once "../config/config.php"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';
$error = '';
$success = '';

// Fetch clients
$clients = mysqli_query($connect, "SELECT client_id, full_name FROM clients ORDER BY full_name ASC");

// Handle form submission
if (isset($_POST['submit'])) {
    $account_number = htmlspecialchars(trim($_POST['account_number']));
    $account_type   = $_POST['account_type'];
    $balance        = (float)$_POST['balance'];
    $client_id      = (int)$_POST['client_id'];

    // Validation
    if (empty($account_number) || empty($account_type) || $balance < 0 || $client_id <= 0) {
        $error = "Please fill all required fields correctly.";
    } else {
        // Check client exists
        $stmt_c = mysqli_prepare($connect, "SELECT client_id FROM clients WHERE client_id = ?");
        mysqli_stmt_bind_param($stmt_c, "i", $client_id);
        mysqli_stmt_execute($stmt_c);
        $res_c = mysqli_stmt_get_result($stmt_c);
        if (mysqli_num_rows($res_c) == 0) {
            $error = "Invalid client selected.";
        }
    }

    // Insert account
    if (empty($error)) {
        $stmt = mysqli_prepare($connect, "INSERT INTO comptes (account_number, balance, account_type, client_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sdsi", $account_number, $balance, $account_type, $client_id);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Account created successfully!";
        } else {
            $error = "Error creating account: " . mysqli_error($connect);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/output.css">
</head>
<body class="bg-[#0e0e0e] text-white flex">

<aside class="w-64 bg-[#161616] h-screen p-6 fixed border-r border-[#242424]">
    <h1 class="text-2xl font-bold text-red-600 mb-10">Bankly</h1>
    <nav class="space-y-4">
        <a href="../dashboard/dashboard.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Dashboard</a>
        <a href="../clients/list_clients.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f]">Customers</a>
        <a href="list_accounts.php" class="block px-3 py-2 rounded-lg bg-red-600/20 text-red-500 font-semibold">Accounts</a>
        <a href="../auth/logout.php" class="block px-3 py-2 rounded-lg text-red-500 hover:bg-[#1f1f1f]">Logout</a>
    </nav>
</aside>

<main class="ml-64 p-8 w-full">
    <h2 class="text-3xl font-bold mb-8">Add Account</h2>

    <?php if (!empty($error)) { ?>
        <div class="bg-red-600/20 text-red-500 p-4 rounded mb-6">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php } elseif (!empty($success)) { ?>
        <div class="bg-green-600/20 text-green-500 p-4 rounded mb-6">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php } ?>

    <form method="POST" class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424] max-w-xl space-y-4">
        <div>
            <label class="block mb-2 text-gray-400">Account Number</label>
            <input type="text" name="account_number" required
                   class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
        </div>

        <div>
            <label class="block mb-2 text-gray-400">Account Type</label>
            <select name="account_type" required class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
                <option value="">Select type</option>
                <option value="Checking">Checking</option>
                <option value="Savings">Savings</option>
                <option value="Business">Business</option>
            </select>
        </div>

        <div>
            <label class="block mb-2 text-gray-400">Initial Balance</label>
            <input type="number" step="0.01" name="balance" value="0"
                   class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
        </div>

        <div>
            <label class="block mb-2 text-gray-400">Client</label>
            <select name="client_id" required class="w-full bg-[#0e0e0e] border border-[#242424] rounded px-4 py-2">
                <option value="">Select client</option>
                <?php while ($c = mysqli_fetch_assoc($clients)) { ?>
                    <option value="<?php echo $c['client_id']; ?>">
                        <?php echo htmlspecialchars($c['full_name']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" name="submit"
                class="bg-red-600 hover:bg-red-700 transition px-6 py-2 rounded-lg font-semibold">
            Create Account
        </button>
    </form>
</main>

</body>
</html>
