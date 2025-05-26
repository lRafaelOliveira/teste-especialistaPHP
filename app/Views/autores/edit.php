<h1 class="text-2xl font-bold text-indigo-700 mb-6">Editar Autor</h1>

<?php require __DIR__ . '/../partials/flashMessages.php'; ?>

<form action="/autores/<?= $autor->id ?>" method="POST" class="bg-white p-6 rounded shadow space-y-5">
    <div>
        <label class="block text-gray-700 mb-1">Nome</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($autor->nome) ?>" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
    </div>
    <div class="flex space-x-2">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Salvar</button>
        <a href="/autores" class="bg-gray-200 text-gray-800 px-6 py-2 rounded hover:bg-gray-300 transition">Cancelar</a>
    </div>
</form>