<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro | Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-100 to-blue-200 flex items-center justify-center">

    <div class="w-full max-w-sm mx-auto bg-white rounded-2xl shadow-lg p-8">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-indigo-600 mb-1">Crie sua conta</h1>
            <p class="text-gray-500 text-sm">Preencha para se cadastrar</p>
        </div>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form action="/register" method="POST" class="space-y-5">
            <div>
                <label for="name" class="block text-sm text-gray-600 mb-1">Nome</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-indigo-400"
                    placeholder="Seu nome completo">
            </div>
            <div>
                <label for="email" class="block text-sm text-gray-600 mb-1">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-indigo-400"
                    placeholder="Seu e-mail">
            </div>
            <div>
                <label for="password" class="block text-sm text-gray-600 mb-1">Senha</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    minlength="6"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-indigo-400"
                    placeholder="Digite sua senha">
            </div>
            <div>
                <label for="confirm_password" class="block text-sm text-gray-600 mb-1">Confirmar Senha</label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    required
                    minlength="6"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-indigo-400"
                    placeholder="Repita sua senha">
            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 font-semibold transition">Cadastrar</button>
        </form>

        <div class="mt-5 text-center">
            <a href="/login" class="text-indigo-500 hover:underline text-sm">Já tem conta? Entrar</a>
        </div>
    </div>
</body>

</html>