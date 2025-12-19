<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankly — Sign Up</title>
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/png">
</head>
<body class="bg-[#0f0f0f] flex items-center justify-center min-h-screen p-4">

<div class="w-full max-w-sm bg-[#1a1a1a] rounded-xl p-8 shadow-xl shadow-black/40">
    <h2 class="text-2xl font-bold text-center text-white mb-6">Create Your Account</h2>
    <form action="signup_process.php" method="POST" class="space-y-5">
        <div class="flex flex-col">
            <label for="full_name" class="text-sm font-medium text-gray-300 mb-1">Full Name</label>
            <input type="text" id="full_name" name="full_name_s"
                   class="px-4 py-2 rounded-lg bg-[#2a2a2a] text-white border border-[#3d3d3d] focus:border-red-500 outline-none transition"
                   required>
        </div>
        <div class="flex flex-col">
            <label for="email" class="text-sm font-medium text-gray-300 mb-1">Email</label>
            <input type="email" id="email" name="email_s"
                   class="px-4 py-2 rounded-lg bg-[#2a2a2a] text-white border border-[#3d3d3d] focus:border-red-500 outline-none transition"
                   required>
        </div>
        <div class="flex flex-col">
            <label for="password" class="text-sm font-medium text-gray-300 mb-1">Password</label>
            <input type="password" id="password" name="password_s" minlength="6"
                   class="px-4 py-2 rounded-lg bg-[#2a2a2a] text-white border border-[#3d3d3d] focus:border-red-500 outline-none transition"
                   required>
        </div>
        <div class="flex flex-col">
            <label for="r_password" class="text-sm font-medium text-gray-300 mb-1">Repeat Password</label>
            <input type="password" id="r_password" name="r_password" minlength="6"
                   class="px-4 py-2 rounded-lg bg-[#2a2a2a] text-white border border-[#3d3d3d] focus:border-red-500 outline-none transition"
                   required>
        </div>
        <button type="submit" name="submit_s"
                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold transition">
            Sign Up
        </button>
    </form>
    <p class="text-center text-gray-400 text-sm mt-5">
        Already have an account?
        <a href="../index.php" class="text-red-500 hover:text-red-600 font-semibold">Login</a>
    </p>
</div>

</body>
</html>
