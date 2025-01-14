<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-md flex w-full max-w-4xl">
        <div class="w-1/2 bg-cover bg-center rounded-l-lg">
            <svg class="" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <!-- SVG content here -->
            </svg>
        </div>

        <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Créer un compte</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="/register" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nom:</label>
                    <input type="text" id="name" name="name" placeholder="Entrez votre nom" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Adresse Email:</label>
                    <input type="email" id="email" name="email" placeholder="Entrez votre email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Mot de passe:</label>
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Rôle:</label>
                    <select name="role" id="role" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="student">Étudiant</option>
                        <option value="teacher">Enseignant</option>
                    </select>
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        S'inscrire
                    </button>
                </div>
            </form>

            <p class="text-center text-gray-600">
                Déjà un compte? <a href="/login" class="text-indigo-600 hover:text-indigo-500">Connectez-vous ici</a>.
            </p>
        </div>
    </div>
</body>
</html>
