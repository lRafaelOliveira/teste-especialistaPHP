<?php

namespace App\Controllers;

class UsuarioController extends \App\Core\Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function usuarios()
    {
        $users = \App\Models\User::all();
        $this->render('usuarios/index', ['users' => $users]);
    }

    public function criarUsuario()
    {
        $this->render('usuarios/criar');
    }

    public function storeUsuario()
    {
        $user = new \App\Models\User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->role = $_POST['role'];
        $user->save();
        header('Location: /usuarios');
    }

    public function editarUsuario($id)
    {
        $user = \App\Models\User::where('id', $id)->first();
        if (!$user) {
            $this->withError("Usuario Nao encontrado");
            $this->redirect('/usuarios');
            return;
        }
        $this->render('usuarios/editar', ['user' => $user]);
    }

    public function atualizarUsuario($id)
    {
        $usuarioLogado = \App\Models\User::find($_SESSION['user_id']);
        if (!$usuarioLogado) {
            $this->withError("Usuario Nao encontrado");
            $this->redirect('/usuarios');
            return;
        }
        if ($usuarioLogado->role != "admin") {
            $this->withError("Voce não tem permissão para editar este usuario.");
            $this->redirect('/usuarios');
            return;
        }
        $user = \App\Models\User::where('id', $id)->first();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->role = $_POST['role'];
        $user->save();
        header('Location: /usuarios');
    }

    public function deletarUsuario($id)
    {
        $usuarioLogado = \App\Models\User::find($_SESSION['user_id']);
        if (!$usuarioLogado) {
            $this->withError("Usuario Nao encontrado");
            $this->redirect('/usuarios');
            return;
        }
        if ($usuarioLogado->role != "admin") {
            $this->withError("Voce não tem permissão para deletar este usuario.");
            $this->redirect('/usuarios');
            return;
        }
        $user = \App\Models\User::find($id);
        $this->render('usuarios/deletar', ['user' => $user]);
    }

    public function confirmarDeletarUsuario($id)
    {
        $user = \App\Models\User::find($id);
        $user->delete();
        header('Location: /usuarios');
    }
}
