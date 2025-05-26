<!-- /app/Views/auth/login.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login | Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center">

    <div class="w-full max-w-sm mx-auto bg-white rounded-2xl shadow-lg p-8">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-indigo-600 mb-1">Bem-vindo(a) à Biblioteca</h1>
            <p class="text-gray-500 text-sm">Faça login para continuar</p>
        </div>

        <?php require __DIR__ . '/../partials/flashMessages.php'; ?>

        <form action="/login" method="POST" class="space-y-5">
            <div>
                <label for="email" class="block text-sm text-gray-600 mb-1">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-indigo-400"
                    placeholder="Digite seu e-mail"
                    autofocus>
            </div>
            <div>
                <label for="password" class="block text-sm text-gray-600 mb-1">Senha</label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-indigo-400 pr-12"
                        placeholder="Digite sua senha">
                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-indigo-600 focus:outline-none"
                        tabindex="-1"
                        aria-label="Exibir senha">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 font-semibold transition">Entrar</button>
        </form>

        <div class="mt-5 text-center">
            <a href="/register" class="text-indigo-500 hover:underline text-sm">Criar conta</a>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');
        let passwordVisible = false;

        togglePassword.addEventListener('click', function() {
            passwordVisible = !passwordVisible;
            passwordInput.type = passwordVisible ? 'text' : 'password';

            // Alterna o ícone do olho aberto/fechado
            eyeIcon.innerHTML = passwordVisible ?
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.96 9.96 0 012.293-3.95M6.873 6.877A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.293 5.032M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3l18 18"/>` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        });
    </script>
</body>

</html>