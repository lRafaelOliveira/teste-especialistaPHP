    <main class="flex-grow max-w-5xl mx-auto py-8 px-4 w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-700">Livros</h1>
            <a href="/livros/criar" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Novo Livro</a>
        </div>

        <?php require __DIR__ . '/../partials/flashMessages.php'; ?>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-indigo-100">
                        <th class="py-2 px-4 text-left">Título</th>
                        <th class="py-2 px-4 text-left">Autores</th>
                        <th class="py-2 px-4 text-left">Assuntos</th>
                        <th class="py-2 px-4 text-left">Valor</th>
                        <th class="py-2 px-4 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr class="border-b">
                            <td class="py-2 px-4"><?= htmlspecialchars($livro->titulo) ?></td>
                            <td class="py-2 px-4">
                                <?php foreach ($livro->autores as $autor): ?>
                                    <span class="inline-block bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded mr-1"><?= htmlspecialchars($autor->nome) ?></span>
                                <?php endforeach; ?>
                            </td>
                            <td class="py-2 px-4">
                                <?php foreach ($livro->assuntos as $assunto): ?>
                                    <span class="inline-block bg-blue-100 text-blue-700 px-2 py-0.5 rounded mr-1"><?= htmlspecialchars($assunto->descricao) ?></span>
                                <?php endforeach; ?>
                            </td>
                            <td class="py-2 px-4">R$ <?= number_format($livro->valor, 2, ',', '.') ?></td>
                            <td class="py-2 px-4 flex space-x-2">
                                <a href="/livros/<?= $livro->id ?>"
                                    class="flex items-center border border-blue-600 text-blue-600 px-3 py-1 rounded hover:bg-blue-50 transition text-sm font-medium">
                                    <!-- Ícone Olho (Ver) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Ver
                                </a>
                                <a href="/livros/<?= $livro->id ?>/editar"
                                    class="flex items-center border border-yellow-600 text-yellow-600 px-3 py-1 rounded hover:bg-yellow-50 transition text-sm font-medium">
                                    <!-- Ícone Lápis (Editar) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                    Editar
                                </a>
                                <form action="/livros/<?= $livro->id ?>/deletar" method="POST" class="inline">
                                    <button type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir?')"
                                        class="flex items-center border border-red-600 text-red-600 px-3 py-1 rounded hover:bg-red-50 transition text-sm font-medium">
                                        <!-- Ícone Lixeira (Excluir) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php if ($livros->lastPage() > 1): ?>
                <nav class="flex justify-center my-8">
                    <ul class="inline-flex items-center -space-x-px">
                        <?php for ($page = 1; $page <= $livros->lastPage(); $page++): ?>
                            <li>
                                <a href="?page=<?= $page ?>"
                                    class="px-4 py-2 border <?= $livros->currentPage() == $page ? 'bg-indigo-600 text-white' : 'bg-white text-indigo-600' ?> rounded hover:bg-indigo-100 mx-1">
                                    <?= $page ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>

        </div>
    </main>