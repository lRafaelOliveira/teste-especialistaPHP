<!-- Inclua Bootstrap 5 CDN no seu layout base, se ainda não fez -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Opcional: Ícones Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h1 class="fw-bold text-primary">Lista de Usuários</h1>
            <p class="text-muted mb-0">Gerencie aqui os usuários cadastrados no sistema</p>
        </div>
    </div>
    <div class="card shadow rounded-4">
        <div class="card-body p-0">
            <?php require __DIR__ . '/../partials/flashMessages.php'; ?>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th scope="col" class="ps-4">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?= htmlspecialchars($user->name) ?></td>
                                <td><?= htmlspecialchars($user->email) ?></td>
                                <td><?= htmlspecialchars($user->role) ?></td>
                                <td class="text-end pe-4">
                                    <a href="/usuarios/editar/<?= $user->id ?>" class="btn btn-sm btn-outline-primary me-2" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                  
                                    <a href="/usuarios/deletar/<?= $user->id ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Deletar"
                                        onclick="return confirm('Tem certeza que deseja deletar este usuário?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Nenhum usuário encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Botão de Novo Usuário -->
    <div class="mt-4 text-center">
        <a href="/usuarios/criar" class="btn btn-lg btn-success rounded-pill px-5 fw-bold">
            <i class="bi bi-person-plus me-2"></i> Novo Usuário
        </a>
    </div>
</div>