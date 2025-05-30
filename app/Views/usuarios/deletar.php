<div class="container py-5">
    <h1 class="mb-4 text-center">Deletar Usuário</h1>
    <form action="/usuarios/<?= $user->id ?>/confirmar-deletar" method="post">
        <p>Tem certeza que deseja deletar o usuário <?= $user->name ?>?</p>
        <button type="submit" class="btn btn-danger">Deletar</button>
        <a href="/usuarios" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
