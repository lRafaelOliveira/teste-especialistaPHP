<?php

namespace App\Middlewares;

use App\Core\Session;

class AuthMiddleware
{
    /**
     * Middleware: verifica se o usuário está autenticado.
     */
    public static function handle()
    {
        Session::start();
        // Sempre garante que a session está ativa
        if (!Session::has('user_id')) {
            // Redireciona para login, preservando a URL anterior se desejar
            header('Location: /login');
            exit;
        }
    }

    /**
     * O login e logout NÃO devem ficar na middleware,
     * mas sim num AuthService ou Controller.
     * Se quiser, pode remover daqui e centralizar melhor.
     */
    // public static function handleLogin($username, $password) {}

    /**
     * Faz logout limpando a sessão.
     */
    public static function logout()
    {
        Session::start();
        Session::clear();
        header('Location: /login');
        exit;
    }
}
