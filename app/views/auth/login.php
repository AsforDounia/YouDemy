<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Login</title>
    <!-- Font Awesome CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Logo Section -->
            <div class="p-6 bg-indigo-600 text-white text-center">
                <div class="flex justify-center items-center space-x-2">
                    <i data-lucide="book-key"></i>
                    <h1 class="text-2xl font-bold">Youdemy</h1>
                </div>
                <p class="mt-2 text-indigo-200">Your Gateway to Knowledge</p>
            </div>

            <!-- Login Form -->
            <div id="loginForm" class="p-6">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Welcome Back!</h2>
                
                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($_SESSION['error']); ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <form class="space-y-4" action="/login" method="POST">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <input type="email"
                                class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter your email" name="email" required>
                            <i
                                class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password"
                                class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter your password" name="password" required>
                            <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center space-x-2">
                        <span>Login</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </form>
                    </button>
                </form>
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Vous n'avez pas de compte?
                        <a href="signup.html"
                            class="ml-1 text-indigo-600 hover:text-indigo-800 font-medium flex items-center justify-center space-x-1 mx-auto mt-1">
                            <span>Inscrivez-vous</span>
                            <i class="fas fa-chevron-right text-sm"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>



    <script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
</body>

</html>
