    <main class="flex-grow max-w-2xl mx-auto py-8 px-4 w-full">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">Editar Livro</h1>

        <?php require __DIR__ . '/../partials/flashMessages.php'; ?>

        <form action="/livros/<?= $livro->id ?>" method="POST" class="bg-white p-6 rounded shadow space-y-5">
            <div>
                <label class="block text-gray-700 mb-1">Título</label>
                <input type="text" name="titulo" value="<?= htmlspecialchars($livro->titulo) ?>" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Valor</label>
                <input type="number" step="0.01" name="valor" value="<?= htmlspecialchars($livro->valor) ?>" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Data de Publicação</label>
                <input type="date" name="data_publicacao" value="<?= htmlspecialchars($livro->data_publicacao) ?>" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Autores</label>
                <select name="autores[]" multiple required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
                    <?php foreach ($autores as $autor): ?>
                        <option value="<?= $autor->id ?>" <?= in_array($autor->id, $livro->autores->pluck('id')->toArray()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($autor->nome) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Assuntos</label>
                <select name="assuntos[]" multiple required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
                    <?php foreach ($assuntos as $assunto): ?>
                        <option value="<?= $assunto->id ?>" <?= in_array($assunto->id, $livro->assuntos->pluck('id')->toArray()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($assunto->descricao) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Salvar</button>
                <a href="/livros" class="bg-gray-200 text-gray-800 px-6 py-2 rounded hover:bg-gray-300 transition">Cancelar</a>
            </div>
        </form>
    </main>