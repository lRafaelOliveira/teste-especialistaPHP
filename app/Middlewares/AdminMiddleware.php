<?php

namespace App\Middlewares;

use App\Core\Session;

class AdminMiddleware
{
    public function handle($request = null)
    {
        Session::start();

        $user = Session::get('user');
        $role = $user['role'] ?? null;

        if (!$user) {
            // Usuário não autenticado → redireciona para login
            header('Location: /login');
            exit;
        }

        if ($role !== 'admin') {
            // Usuário autenticado, mas não é admin → acesso negado
            http_response_code(403);
            echo '<h1 style="color:red;text-align:center;">Acesso negado! Somente administradores podem acessar esta página.</h1>';
            exit;
        }
    }
}
