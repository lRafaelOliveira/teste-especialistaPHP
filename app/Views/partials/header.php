<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel - Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-50 to-blue-100">

    <!-- Header -->
    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="font-bold text-indigo-600 text-2xl">
                <a href="/" class="text-indigo-600 hover:underline">
                    Biblioteca
                </a>
            </span>
        </div>
        <div class="flex items-center space-x-4">
            <?php
            if (is_logged()): ?>
                <a href="/livros" class="text-indigo-600 hover:underline">Livros</a>
                <a href="/autores" class="text-indigo-600 hover:underline">Autores</a>
                <a href="/assuntos" class="text-indigo-600 hover:underline">Assuntos</a>
                <a href="/logout" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">Sair</a>
            <?php else: ?>
                <a href="/login" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">Entrar</a>
            <?php endif; ?>
        </div>
    </nav>

    <main class="flex-grow max-w-5xl mx-auto py-10 px-4 w-full">