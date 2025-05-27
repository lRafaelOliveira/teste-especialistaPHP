<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Choices.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<main class="container py-5">
    <h2 class="mb-4 text-center">Relatório de Livros</h2>
    <!-- Filtros -->
    <form class="mb-4" method="GET" action="">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <input type="text" name="busca" class="form-control" placeholder="Buscar por título..." value="<?= htmlspecialchars($busca ?? '') ?>">
            </div>
            <div class="col-md-4">
                <select id="autor-select" name="autor[]" class="form-select" multiple>
                    <?php foreach ($autoresOptions as $autor): ?>
                        <option value="<?= $autor->nome ?>" <?= (!empty($filtroAutores) && in_array($autor->nome, $filtroAutores)) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($autor->nome) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-4">
                <select id="assunto-select" name="assunto[]" class="form-select" multiple>
                    <?php foreach ($assuntosOptions as $assunto): ?>
                        <option value="<?= $assunto->descricao ?>" <?= (!empty($filtroAssuntos) && in_array($assunto->descricao, $filtroAssuntos)) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($assunto->descricao) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="text-end mt-3">
            <button class="btn btn-primary" type="submit">Filtrar</button>
            <a href="/relatorios/livros" class="btn btn-secondary">Limpar</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Livro</th>
                    <th>Autor</th>
                    <th>Assunto</th>
                    <th>Valor</th>
                    <th>Data Publicação</th>
                    <th>Usuário</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($relatorio)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Nenhum livro encontrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($relatorio as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['livro']) ?></td>
                            <td><?= htmlspecialchars(implode(', ', $row['autores'])) ?></td>
                            <td><?= htmlspecialchars(implode(', ', $row['assuntos'])) ?></td>
                            <td>R$ <?= number_format($row['valor'], 2, ',', '.') ?></td>
                            <td><?= date('d/m/Y', strtotime($row['data_publicacao'])) ?></td>
                            <td><?= htmlspecialchars($row['usuario']) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
        <?php if ($totalPaginas > 1): ?>
            <nav class="flex justify-center my-8">
                <ul class="inline-flex items-center -space-x-px">
                    <?php for ($p = 1; $p <= $totalPaginas; $p++): ?>
                        <li>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $p])) ?>"
                                class="px-4 py-2 border <?= $paginaAtual == $p ? 'bg-indigo-600 text-white' : 'bg-white text-indigo-600' ?> rounded hover:bg-indigo-100 mx-1">
                                <?= $p ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</main>


<!-- Bootstrap 5 JS (Popper incluído) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Choices.js -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Choices('#autor-select', {
            removeItemButton: true,
            placeholder: true,
            placeholderValue: 'Filtrar autor(es)...'
        });
        new Choices('#assunto-select', {
            removeItemButton: true,
            placeholder: true,
            placeholderValue: 'Filtrar assunto(s)...'
        });
    });
</script>