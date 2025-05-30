<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-warning text-dark text-center rounded-top-4">
                    <h2 class="mb-0 fw-bold"><i class="bi bi-person-lines-fill me-2"></i>Editar Usuário</h2>
                </div>
                <div class="card-body p-4">
                    <form action="/usuarios/<?= $user->id ?>" method="post" class="needs-validation" novalidate autocomplete="off">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nome:</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user->name) ?>" class="form-control" required>
                            <div class="invalid-feedback">Por favor, insira o nome.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email:</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->email) ?>" class="form-control" required>
                            <div class="invalid-feedback">Por favor, insira um email válido.</div>
                        </div>
                        <div class="mb-4">
                            <label for="role" class="form-label fw-semibold">Perfil:</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="" disabled>Selecione...</option>
                                <option value="admin" <?= $user->role === 'admin' ? 'selected' : '' ?>>Administrador</option>
                                <option value="user" <?= $user->role === 'user' ? 'selected' : '' ?>>Usuário</option>
                            </select>
                            <div class="invalid-feedback">Por favor, selecione o perfil.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold text-white">
                                <i class="bi bi-check2-circle me-2"></i>Atualizar Usuário
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Botão de Voltar -->
            <div class="mt-4 text-center">
                <a href="/usuarios" class="btn btn-link text-decoration-none fw-semibold">
                    <i class="bi bi-arrow-left-circle me-2"></i>Voltar para lista de usuários
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Bootstrap 5 validação
    (function() {
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.forEach.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>