<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Assunto;

class AssuntoController extends Controller
{
    // Listar todos os assuntos
    public function index()
    {
        $assuntos = Assunto::orderBy('descricao')->get();
        $this->render('assuntos.index', ['assuntos' => $assuntos]);
    }

    // Formulário de criação
    public function create()
    {
        $this->render('assuntos.create');
    }

    // Salvar novo assunto
    public function store()
    {
        $descricao = trim($this->request->input('descricao'));
        $erros = [];

        if (!$descricao) $erros[] = "Descrição é obrigatória.";

        if ($erros) {
            $this->withError($erros);
            $this->redirect('/assuntos/criar');
        }

        $assunto = new Assunto();
        $assunto->descricao = $descricao;
        $assunto->save();

        $this->with("Assunto cadastrado com sucesso!");
        $this->redirect('/assuntos');
    }

    // Formulário de edição
    public function edit($params)
    {
        $id = $params['id'] ?? null;
        $assunto = Assunto::find($id);

        if (!$assunto) {
            $this->withError("Assunto não encontrado.");
            $this->redirect('/assuntos');
        }

        $this->render('assuntos.edit', ['assunto' => $assunto]);
    }

    // Atualizar assunto
    public function update($params)
    {
        $id = $params['id'] ?? null;
        $assunto = Assunto::find($id);

        if (!$assunto) {
            $this->withError("Assunto não encontrado.");
            $this->redirect('/assuntos');
        }

        $descricao = trim($this->request->input('descricao'));
        $erros = [];
        if (!$descricao) $erros[] = "Descrição é obrigatória.";

        if ($erros) {
            $this->withError($erros);
            $this->redirect("/assuntos/{$id}/editar");
        }

        $assunto->descricao = $descricao;
        $assunto->save();

        $this->with("Assunto atualizado com sucesso!");
        $this->redirect('/assuntos');
    }

    // Excluir assunto
    public function destroy($params)
    {
        $id = $params['id'] ?? null;
        $assunto = Assunto::find($id);

        if (!$assunto) {
            $this->withError("Assunto não encontrado.");
            $this->redirect('/assuntos');
        }

        // Se tiver relacionamento com livros, pode desvincular aqui (opcional)
        $assunto->delete();

        $this->with("Assunto excluído com sucesso!");
        $this->redirect('/assuntos');
    }
}
