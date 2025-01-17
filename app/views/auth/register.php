<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Login/Signup</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Logo Section -->
            <div class="p-6 bg-indigo-600 text-white text-center">
                <div class="flex justify-center items-center space-x-2">
                    <h1 class="text-2xl font-bold">Youdemy</h1>
                </div>
                <p class="mt-2 text-indigo-200">Your Gateway to Knowledge</p>
            </div>

            <!-- Registration Form -->
            <div id="registerForm" class="p-6">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Create an Account</h2>
                
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <form action="/register" method="POST">
                    <div class="mb-4">
                        <label for="fullname" class="block text-gray-700">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your Full Name" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email Address:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-gray-700">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-gray-700">Role:</label>
                        <select name="role" id="role" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Student">Student</option>
                            <option value="Teacher">Teacher</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center space-x-2">
                            <span>Sign Up</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </button>
                    </div>
                </form>

                <p class="text-center text-gray-600">
                    Already have an account? <a href="/login" class="text-indigo-600 hover:text-indigo-500">Log in here</a>.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
