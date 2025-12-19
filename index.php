<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankly — Login</title>
    <link rel="stylesheet" href="assets/css/output.css">
    <link rel="shortcut icon" href="assets/img/icon.png" type="image/png">

</head>
<body class="bg-[#0f0f0f] flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-sm bg-[#1a1a1a] rounded-xl p-8 shadow-xl shadow-black/40">

        <h2 class="text-2xl font-bold text-center text-white mb-6">
            Login to Bankly
        </h2>

        <form action="auth/login.php" method="POST" class="space-y-5">

            <div class="flex flex-col">
                <label for="email" class="text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" id="email" name="email_l" required
                       class="px-4 py-2 rounded-lg bg-[#2a2a2a] text-white border border-[#3d3d3d] focus:border-red-500 outline-none transition">
            </div>

            <div class="flex flex-col">
                <label for="password" class="text-sm font-medium text-gray-300 mb-1">Password</label>
                <input type="password" id="password" name="password_l" required
                       class="px-4 py-2 rounded-lg bg-[#2a2a2a] text-white border border-[#3d3d3d] focus:border-red-500 outline-none transition">
            </div>

            <button type="submit" name="submit_l"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold transition">
                Log In
            </button>
        </form>

        <p class="text-center text-gray-400 text-sm mt-5">
            You don't have an account?
            <a href="auth/signup.php" class="text-red-500 hover:text-red-600 font-semibold">Sign Up</a>
        </p>

    </div>

</body>
</html>
