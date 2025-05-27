<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;

class LivroController extends Controller
{
    // Listar todos os livros
    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $livros = Livro::with(['autores', 'assuntos', 'user'])
            ->orderBy('titulo', 'asc')
            ->paginate(10, ['*'], 'page', $page);

        $this->render('livros.index', ['livros' => $livros]);
    }


    // Mostrar formulário de criação
    public function create()
    {
        $autores = Autor::orderBy('nome')->get();
        $assuntos = Assunto::orderBy('descricao')->get();
        $this->render('livros.create', [
            'autores' => $autores,
            'assuntos' => $assuntos,
        ]);
    }

    // Salvar novo livro
    public function store()
    {
        $titulo = trim($this->request->input('titulo'));
        $valor = $this->request->input('valor');
        $data_publicacao = $this->request->input('data_publicacao');
        $autores = $this->request->input('autores') ?? [];
        $assuntos = $this->request->input('assuntos') ?? [];

        $erros = [];
        if (!$titulo) $erros[] = "Título é obrigatório.";
        if (!$valor) $erros[] = "Valor é obrigatório.";
        if (!$data_publicacao) $erros[] = "Data de publicação é obrigatória.";

        if ($erros) {
            $this->withError($erros);
            $this->redirect('/livros/criar');
        }

        $livro = new Livro();
        $livro->titulo = $titulo;
        $livro->valor = $valor;
        $livro->data_publicacao = $data_publicacao;
        $livro->user_id = Session::get('user_id');
        $livro->save();

        $livro->autores()->sync($autores);
        $livro->assuntos()->sync($assuntos);

        $this->with("Livro cadastrado com sucesso!");
        $this->redirect('/livros');
    }

    // Detalhes do livro
    public function show($params)
    {
        $id = $params['id'] ?? null;
        $livro = Livro::with(['autores', 'assuntos', 'user'])->find($id);

        if (!$livro) {
            $this->withError("Livro não encontrado.");
            $this->redirect('/livros');
        }

        $this->render('livros.show', ['livro' => $livro]);
    }

    // Mostrar formulário de edição
    public function edit($params)
    {
        $id = $params['id'] ?? null;
        $livro = Livro::with(['autores', 'assuntos'])->find($id);

        if (!$livro) {
            $this->withError("Livro não encontrado.");
            $this->redirect('/livros');
        }

        $autores = Autor::orderBy('nome')->get();
        $assuntos = Assunto::orderBy('descricao')->get();

        $this->render('livros.edit', [
            'livro' => $livro,
            'autores' => $autores,
            'assuntos' => $assuntos,
        ]);
    }

    // Atualizar livro
    public function update($params)
    {
        $id = $params['id'] ?? null;
        $livro = Livro::find($id);

        if (!$livro) {
            $this->withError("Livro não encontrado.");
            $this->redirect('/livros');
        }

        $titulo = trim($this->request->input('titulo'));
        $valor = $this->request->input('valor');
        $data_publicacao = $this->request->input('data_publicacao');
        $autores = $this->request->input('autores') ?? [];
        $assuntos = $this->request->input('assuntos') ?? [];

        $erros = [];
        if (!$titulo) $erros[] = "Título é obrigatório.";
        if (!$valor) $erros[] = "Valor é obrigatório.";
        if (!$data_publicacao) $erros[] = "Data de publicação é obrigatória.";

        if ($erros) {
            $this->withError($erros);
            $this->redirect("/livros/{$id}/editar");
        }

        $livro->titulo = $titulo;
        $livro->valor = $valor;
        $livro->data_publicacao = $data_publicacao;
        $livro->save();

        $livro->autores()->sync($autores);
        $livro->assuntos()->sync($assuntos);

        $this->with("Livro atualizado com sucesso!");
        $this->redirect('/livros');
    }

    // Excluir livro
    public function destroy($params)
    {
        $id = $params['id'] ?? null;
        $livro = Livro::find($id);

        if (!$livro) {
            $this->withError("Livro não encontrado.");
            $this->redirect('/livros');
        }

        $livro->autores()->detach();
        $livro->assuntos()->detach();
        $livro->delete();

        $this->with("Livro excluído com sucesso!");
        $this->redirect('/livros');
    }
}
