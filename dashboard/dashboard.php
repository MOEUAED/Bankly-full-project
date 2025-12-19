<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bankly — Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="assets/css/output.css">
        <link rel="shortcut icon" href="assets/img/icon.png" type="image/png">
    </head>

    <body class="bg-[#0e0e0e] text-white flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-[#161616] h-screen p-6 fixed left-0 top-0 border-r border-[#242424]">
            <h1 class="text-2xl font-bold text-red-600 mb-10">Bankly</h1>
            <nav class="space-y-4">
                <a href="#" class="block px-3 py-2 rounded-lg bg-red-600/20 text-red-500 font-semibold">Dashboard</a>
                <a href="#" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f] transition">Customers</a>
                <a href="accounts/list_accounts.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f] transition">Accounts</a>
                <a href="#" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f] transition">Transactions</a>
                <a href="#" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f] transition">Advisors</a>
                <a href="logout.php" class="block px-3 py-2 rounded-lg hover:bg-[#1f1f1f] transition text-red-500">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 p-8 w-full">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Dashboard</h2>

                <div class="flex items-center gap-3 bg-[#1a1a1a] px-4 py-2 rounded-lg">
                    <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center">
                        <span class="text-sm font-bold"></span>
                    </div>
                    <span class="text-gray-300"></span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
                    <p class="text-gray-400 text-sm">Total Customers</p>

                    <h3 class="text-3xl font-bold mt-2"></h3>
                </div>

                <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
                    <p class="text-gray-400 text-sm">Total Accounts</p>

                    <h3 class="text-3xl font-bold mt-2"></h3>
                </div>

                <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">
                    <p class="text-gray-400 text-sm">Total Transactions</p>
                    <h3 class="text-3xl font-bold mt-2"></h3>
                </div>

            </div>

            <!-- Recent Transactions Table -->
            <div class="bg-[#1a1a1a] p-6 rounded-xl border border-[#242424]">

                <h3 class="text-xl font-bold mb-4">Recent Transactions</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm border-b border-[#242424]">
                                <th class="pb-3">ID</th>
                                <th class="pb-3">Type</th>
                                <th class="pb-3">Amount</th>
                                <th class="pb-3">Date</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-300">

                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </body>
    </html>
