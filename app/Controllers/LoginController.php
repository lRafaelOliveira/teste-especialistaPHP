<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

class LoginController extends Controller
{
    public function showLogin()
    {
        $this->render_modal('auth.login');
    }

    public function authenticate()
    {
        $email = $this->request->input('email');
        $password = $this->request->input('password');

        $user = User::where('email', $email)->first();
        if ($user && verify_passwd($password, $user->password)) {
            Session::start();
            Session::set('user_id', $user->id);
            Session::set('is_admin', $user->role === "admin");
            $this->with('Login realizado com sucesso!');
            $this->redirect('/');
        } else {
            $this->withError('E-mail ou senha inválidos.');
            $this->redirect('/login');
        }
    }

    public function logout()
    {
        Session::start();
        Session::clear();
        $this->redirect('/login');
    }
}
