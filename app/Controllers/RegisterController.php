<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegister()
    {
        $this->render('auth.register');
    }

    public function store()
    {
        $request = $this->request();

        $name = trim($request->input('name'));
        $email = trim($request->input('email'));
        $password = $request->input('password');
        $confirm = $request->input('confirm_password');

        // Validação simples
        if (!$name || !$email || !$password || !$confirm) {
            $this->withError("Preencha todos os campos.");
            $this->redirect('/register');
        }

        if ($password !== $confirm) {
            $this->withError("As senhas não coincidem.");
            $this->redirect('/register');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->withError("E-mail inválido.");
            $this->redirect('/register');
        }

        if (User::where('email', $email)->exists()) {
            $this->withError("E-mail já cadastrado.");
            $this->redirect('/register');
        }

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = passwd($password, PASSWORD_BCRYPT);
        $user->role = 'user';
        $user->save();

        $this->with("Cadastro realizado com sucesso! Faça login.");
        $this->redirect('/login');
    }
}
