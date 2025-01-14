<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-md flex w-full max-w-4xl">
        <div class="w-1/2 bg-cover bg-center rounded-l-lg" >
            <svg class="border-2 p-20 " viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g data-name="22_Video Player" id="_22_Video_Player"> <path d="M59,48H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2H59a3,3,0,0,1,3,3V45A3,3,0,0,1,59,48Z" style="fill:#0455bf"></path> <path d="M53,44H8a2,2,0,0,1-2-2V8A2,2,0,0,1,8,6H52a2,2,0,0,1,2,2V43A1,1,0,0,1,53,44Z" style="fill:#fdfeff"></path> <path d="M8,42V8a2,2,0,0,1,2-2H8A2,2,0,0,0,6,8V42a2,2,0,0,0,2,2h2A2,2,0,0,1,8,42Z" style="fill:#dfeaef"></path> <circle cx="32" cy="25" r="9" style="fill:#0455bf"></circle> <path d="M36,29a1.994,1.994,0,0,1,1-1.723A1.988,1.988,0,0,0,34,29v3a8.957,8.957,0,0,0,2-.23Z" style="fill:#004787"></path> <path d="M34,32a8.989,8.989,0,0,1-7.279-14.279A8.993,8.993,0,1,0,39.279,30.279,8.951,8.951,0,0,1,34,32Z" style="fill:#004787"></path> <path d="M30,29a1,1,0,0,1-1-1V22a1,1,0,0,1,1.447-.895l6,3a1,1,0,0,1,.26,1.6c-.158.158-.158.158-6.262,3.189A1,1,0,0,1,30,29Z" style="fill:#febc00"></path> <path d="M36.447,24.105l-.2-.1c-.889.443-2.1,1.045-3.8,1.89A1,1,0,0,1,31,25V21.382l-.553-.277A1,1,0,0,0,29,22v6a1,1,0,0,0,1.445.9c6.1-3.031,6.1-3.031,6.262-3.189a1,1,0,0,0-.26-1.6Z" style="fill:#edaa03"></path> <polygon points="21 36 20 36 12 36 12 38 20 38 21 38 40 38 40 36 21 36" style="fill:#0455bf"></polygon> <rect height="4" rx="2" style="fill:#febc00" width="4" x="56" y="23"></rect> <path d="M59,26a1.992,1.992,0,0,1-1.82-2.82,2,2,0,1,0,2.64,2.64A1.99,1.99,0,0,1,59,26Z" style="fill:#edaa03"></path> <path d="M50,42a2,2,0,0,0-2,2V41a2,2,0,0,0-4,0V37a2,2,0,0,0-4,0V29a2,2,0,0,0-4,0V49.172a1.242,1.242,0,0,1-2.121.878L30,46.172A2,2,0,1,0,27.172,49l4.242,4.243L33.2,55.025A9.864,9.864,0,0,1,36.086,62H49.411v-.376a6.855,6.855,0,0,1,1.294-4.008A6.849,6.849,0,0,0,52,53.608V44A2,2,0,0,0,50,42Z" style="fill:#ecc19c"></path> <path d="M18,39a2,2,0,1,1,2-2A2,2,0,0,1,18,39Z" style="fill:#febc00"></path> <path d="M19,38a1.992,1.992,0,0,1-1.82-2.82,2,2,0,1,0,2.64,2.64A1.99,1.99,0,0,1,19,38Z" style="fill:#edaa03"></path> <path d="M27.172,46.172a1.981,1.981,0,0,1,.414-.31A1.992,1.992,0,0,0,24.632,48h2A1.993,1.993,0,0,1,27.172,46.172Z" style="fill:#004787"></path> <rect height="4" style="fill:#004787" width="2" x="34" y="44"></rect> <rect height="6" style="fill:#dfeaef" width="2" x="34" y="38"></rect> <path d="M36,33.053c-.233.116-.471.224-.715.319-.083.033-.168.063-.253.093-.225.081-.453.152-.686.215-.1.028-.207.056-.312.081L34,33.769V36h2Z" style="fill:#dfeaef"></path> <path d="M36,31.77A8.957,8.957,0,0,1,34,32v1.767l.034-.006c.105-.025.209-.053.312-.081.233-.063.462-.134.686-.215.085-.03.17-.06.253-.093.244-.1.482-.2.715-.321Z" style="fill:#004787"></path> <rect height="2" style="fill:#004787" width="2" x="34" y="36"></rect> </g> </g></svg>
        </div>

        <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?= htmlspecialchars($_SESSION['success']); ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST" onsubmit="return validateForm()">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Adresse Email</label>
                    <input type="email" id="email" name="email" placeholder="Entrez votre email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required minlength="6"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Se connecter
                    </button>
                </div>
            </form>

            <p class="text-center text-gray-600">
                Vous n'avez pas de compte ? <a href="/register" class="text-indigo-600 hover:text-indigo-500">Inscrivez-vous ici</a>.
            </p>
        </div>
    </div>

    <script>
        // function validateForm() {
        //     const email = document.getElementById('email').value.trim();
        //     const password = document.getElementById('password').value.trim();

        //     if (!email || !password) {
        //         alert('Veuillez remplir tous les champs.');
        //         return false;
        //     }

        //     if (password.length < 6) {
        //         alert('Le mot de passe doit contenir au moins 6 caractères.');
        //         return false;
        //     }

        //     return true;
        // }
    </script>
</body>
</html>
