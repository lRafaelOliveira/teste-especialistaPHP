<!-- Choices.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<!-- Choices.js JS -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<form action="/livros" method="POST" class="bg-white p-6 rounded shadow space-y-5">
    <div>
        <label class="block text-gray-700 mb-1">Título</label>
        <input type="text" name="titulo" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
    </div>
    <div>
        <label class="block text-gray-700 mb-1">Valor</label>
        <div class="relative flex items-center">
            <span class="absolute left-3 text-gray-500 font-medium select-none">R$</span>
            <input
                type="text"
                name="valor"
                id="valor"
                required
                inputmode="numeric"
                pattern="^\d+([,\.]\d{2})?$"
                autocomplete="off"
                class="pl-10 w-full border px-3 py-2 rounded focus:outline-none focus:ring"
                placeholder="0,00">
        </div>
    </div>

    <div>
        <label class="block text-gray-700 mb-1">Data de Publicação</label>
        <input type="date" name="data_publicacao" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
    </div>
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-gray-700">Autores</label>
            <a href="/autores/criar" target="_blank"
                class="flex items-center border border-indigo-600 text-indigo-600 px-2 py-1 rounded hover:bg-indigo-50 transition text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Novo autor
            </a>
        </div>
        <select name="autores[]" multiple required class="choices w-full border px-3 py-2 rounded focus:outline-none focus:ring">
            <?php foreach ($autores as $autor): ?>
                <option value="<?= $autor->id ?>"><?= htmlspecialchars($autor->nome) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-gray-700">Assuntos</label>
            <a href="/assuntos/criar" target="_blank"
                class="flex items-center border border-indigo-600 text-indigo-600 px-2 py-1 rounded hover:bg-indigo-50 transition text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Novo assunto
            </a>
        </div>
        <select name="assuntos[]" multiple required class="choices w-full border px-3 py-2 rounded focus:outline-none focus:ring">
            <?php foreach ($assuntos as $assunto): ?>
                <option value="<?= $assunto->id ?>"><?= htmlspecialchars($assunto->descricao) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="flex space-x-2">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Salvar</button>
        <a href="/livros" class="bg-gray-200 text-gray-800 px-6 py-2 rounded hover:bg-gray-300 transition">Cancelar</a>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('.choices');
        selects.forEach(function(select) {
            new Choices(select, {
                removeItemButton: true,
                noResultsText: 'Nenhum resultado encontrado',
                noChoicesText: 'Sem opções para escolher',
                itemSelectText: 'Clique para selecionar',
                searchPlaceholderValue: 'Buscar...',
                placeholder: true,
                placeholderValue: 'Selecione...'
            });
        });
    });
</script>