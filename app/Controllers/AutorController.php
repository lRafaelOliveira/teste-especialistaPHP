<?php

namespace App\Controllers;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Core\Controller;
use App\Models\Autor;

class AutorController extends Controller
{
    // Listar todos os autores
    public function index()
    {
        $autores = Autor::orderBy('nome')->get();
        $this->render('autores.index', ['autores' => $autores]);
    }

    // Formulário de criação
    public function create()
    {
        $this->render('autores.create');
    }

    // Salvar novo autor
    public function store()
    {
        $nome = trim($this->request->input('nome'));
        if (!$nome) {
            $this->withError('Nome é obrigatório.');
            $this->redirect('/autores/criar');
        }

        try {
            Capsule::connection()->statement('CALL sp_criar_autor(?)', [$nome]);
            $this->with('Autor cadastrado com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            $this->withError($e->getMessage());
        }
        $this->redirect('/autores');
    }

    // Formulário de edição
    public function edit($params)
    {
        $id = $params['id'] ?? null;
        $autor = Autor::find($id);

        if (!$autor) {
            $this->withError("Autor não encontrado.");
            $this->redirect('/autores');
        }

        $this->render('autores.edit', ['autor' => $autor]);
    }

    // Atualizar autor
    public function update($params)
    {
        $id = $params['id'] ?? null;
        $autor = Autor::find($id);

        if (!$autor) {
            $this->withError("Autor não encontrado.");
            $this->redirect('/autores');
        }

        $nome = trim($this->request->input('nome'));
        $erros = [];
        if (!$nome) $erros[] = "Nome é obrigatório.";

        if ($erros) {
            $this->withError($erros);
            $this->redirect("/autores/{$id}/editar");
        }

        $autor->nome = $nome;
        $autor->save();

        $this->with("Autor atualizado com sucesso!");
        $this->redirect('/autores');
    }

    // Excluir autor
    public function destroy($params)
    {
        $id = $params['id'] ?? null;
        $autor = Autor::find($id);

        if (!$autor) {
            $this->withError("Autor não encontrado.");
            $this->redirect('/autores');
        }

        // Se tiver relacionamento de livros, pode detacar/desvincular aqui (opcional)
        $autor->delete();

        $this->with("Autor excluído com sucesso!");
        $this->redirect('/autores');
    }
}
