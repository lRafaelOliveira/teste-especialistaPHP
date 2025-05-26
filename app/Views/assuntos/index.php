<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-indigo-700">Assuntos</h1>
    <a href="/assuntos/criar" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Novo Assunto</a>
</div>

<?php require __DIR__ . '/../partials/flashMessages.php'; ?>

<div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full text-sm">
        <thead>
            <tr class="bg-indigo-100">
                <th class="py-2 px-4 text-left">Descrição</th>
                <th class="py-2 px-4 text-left">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assuntos as $assunto): ?>
                <tr class="border-b">
                    <td class="py-2 px-4"><?= htmlspecialchars($assunto->descricao) ?></td>
                    <td class="py-2 px-4 flex space-x-2">
                        <a href="/assuntos/<?= $assunto->id ?>/editar" class="text-yellow-600 hover:underline">Editar</a>
                        <form action="/assuntos/<?= $assunto->id ?>/deletar" method="POST" class="inline">
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>