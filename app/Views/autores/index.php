<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-indigo-700">Autores</h1>
    <a href="/autores/criar" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Novo Autor</a>
</div>

<?php require __DIR__ . '/../partials/flashMessages.php'; ?>

<div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full text-sm">
        <thead>
            <tr class="bg-indigo-100">
                <th class="py-2 px-4 text-left">Nome</th>
                <th class="py-2 px-4 text-left">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autores as $autor): ?>
                <tr class="border-b">
                    <td class="py-2 px-4"><?= htmlspecialchars($autor->nome) ?></td>
                    <td class="py-2 px-4 flex space-x-2">
                        <a href="/autores/<?= $autor->id ?>/editar" class="text-yellow-600 hover:underline">Editar</a>
                        <form action="/autores/<?= $autor->id ?>/deletar" method="POST" class="inline">
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>