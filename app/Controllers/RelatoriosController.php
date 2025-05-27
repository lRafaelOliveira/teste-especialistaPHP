<?php

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Database;
use App\Models\Assunto;
use App\Models\Autor;

class RelatoriosController extends Controller
{
    public function index()
    {
        $busca    = $this->request()->input('busca', '');
        $autores  = $this->request()->input('autor', []);
        $assuntos = $this->request()->input('assunto', []);

        // Select options
        $autoresOptions = Autor::orderBy('nome')->get();
        $assuntosOptions = Assunto::orderBy('descricao')->get();

        // Paginando
        $perPage = 10;
        $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;

        // Montando SQL base e de contagem
        $sqlBase = "FROM vw_relatorio_livros WHERE 1";
        $params = [];

        if ($busca) {
            $sqlBase .= " AND livro LIKE ?";
            $params[] = "%$busca%";
        }
        if (!empty($autores)) {
            $in = implode(',', array_fill(0, count($autores), '?'));
            $sqlBase .= " AND autor IN ($in)";
            $params = array_merge($params, $autores);
        }
        if (!empty($assuntos)) {
            $in = implode(',', array_fill(0, count($assuntos), '?'));
            $sqlBase .= " AND assunto IN ($in)";
            $params = array_merge($params, $assuntos);
        }

        // Total de registros para paginação
        $countSql = "SELECT COUNT(*) AS total $sqlBase";
        $totalResult = Database::connection()->select($countSql, $params);
        $totalRegistros = $totalResult[0]->total ?? 0;
        $totalPaginas = ceil($totalRegistros / $perPage);

        // SQL paginado
        $sql = "SELECT * $sqlBase ORDER BY autor, livro LIMIT $perPage OFFSET $offset";
        $dados = Database::connection()->select($sql, $params);

        // Organiza igual antes (agrupando autores/assuntos)
        $relatorio = [];
        foreach ($dados as $row) {
            $livroId = $row->livro . '|' . $row->data_publicacao;
            if (!isset($relatorio[$livroId])) {
                $relatorio[$livroId] = [
                    'livro' => $row->livro,
                    'valor' => $row->valor,
                    'data_publicacao' => $row->data_publicacao,
                    'usuario' => $row->usuario,
                    'autores' => [],
                    'assuntos' => [],
                ];
            }
            if (!in_array($row->autor, $relatorio[$livroId]['autores'])) {
                $relatorio[$livroId]['autores'][] = $row->autor;
            }
            if (!in_array($row->assunto, $relatorio[$livroId]['assuntos'])) {
                $relatorio[$livroId]['assuntos'][] = $row->assunto;
            }
        }

        $this->render('relatorios.livros', [
            'relatorio' => $relatorio,
            'autoresOptions' => $autoresOptions,
            'assuntosOptions' => $assuntosOptions,
            'busca' => $busca,
            'filtroAutores' => $autores,
            'filtroAssuntos' => $assuntos,
            'paginaAtual' => $page,
            'totalPaginas' => $totalPaginas
        ]);
    }
}
