<?php

use App\Core\Database;
use PHPUnit\Framework\TestCase;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;

class DatabaseLivroTest extends TestCase
{
    protected function setUp(): void
    {
        Database::initialize(); // Conecta ao banco de dados
        // (Opcional) Limpa tabelas para testes isolados, se necessário.
        // Livro::truncate();
        // Autor::truncate();
        // Assunto::truncate();
    }

    public function testInsercaoCompletaDeLivrosAutoresAssuntos()
    {
        $livros = [
            [
                'titulo' => 'O Enigma das Estrelas',
                'valor' => 49.90,
                'data_publicacao' => '2021-04-10',
                'autores' => ['Lucas Azevedo'],
                'assuntos' => ['Ficção Científica', 'Mistério']
            ],
            [
                'titulo' => 'Caminhos Cruzados',
                'valor' => 35.50,
                'data_publicacao' => '2019-11-15',
                'autores' => ['Maria Alves', 'João Victor'],
                'assuntos' => ['Romance', 'Drama']
            ],
            [
                'titulo' => 'O Poder da Ação',
                'valor' => 39.90,
                'data_publicacao' => '2018-06-20',
                'autores' => ['Paulo Vieira'],
                'assuntos' => ['Autoajuda']
            ],
            [
                'titulo' => 'A Máquina do Tempo',
                'valor' => 59.99,
                'data_publicacao' => '2020-02-10',
                'autores' => ['H. G. Wells'],
                'assuntos' => ['Ficção Científica', 'Aventura']
            ],
            [
                'titulo' => 'Segredos do Subconsciente',
                'valor' => 45.00,
                'data_publicacao' => '2017-09-18',
                'autores' => ['Ana Paula Souza'],
                'assuntos' => ['Psicologia']
            ],
            [
                'titulo' => 'O Alquimista',
                'valor' => 42.00,
                'data_publicacao' => '2014-03-25',
                'autores' => ['Paulo Coelho'],
                'assuntos' => ['Ficção', 'Aventura']
            ],
            [
                'titulo' => 'A Arte da Guerra',
                'valor' => 29.90,
                'data_publicacao' => '2010-12-01',
                'autores' => ['Sun Tzu'],
                'assuntos' => ['Estratégia', 'História']
            ],
            [
                'titulo' => 'Dom Casmurro',
                'valor' => 37.99,
                'data_publicacao' => '2013-01-10',
                'autores' => ['Machado de Assis'],
                'assuntos' => ['Romance', 'Clássico']
            ],
            [
                'titulo' => 'Código Limpo',
                'valor' => 79.90,
                'data_publicacao' => '2012-05-20',
                'autores' => ['Robert C. Martin'],
                'assuntos' => ['Tecnologia', 'Programação']
            ],
            [
                'titulo' => 'Senhora',
                'valor' => 32.90,
                'data_publicacao' => '2016-10-07',
                'autores' => ['José de Alencar'],
                'assuntos' => ['Romance', 'Drama']
            ],
            [
                'titulo' => 'O Pequeno Príncipe',
                'valor' => 28.00,
                'data_publicacao' => '2015-07-04',
                'autores' => ['Antoine de Saint-Exupéry'],
                'assuntos' => ['Infantil', 'Filosofia']
            ],
            [
                'titulo' => 'Mindset',
                'valor' => 54.00,
                'data_publicacao' => '2018-08-23',
                'autores' => ['Carol S. Dweck'],
                'assuntos' => ['Psicologia', 'Autoajuda']
            ],
            [
                'titulo' => 'O Cortiço',
                'valor' => 27.00,
                'data_publicacao' => '2011-03-21',
                'autores' => ['Aluísio Azevedo'],
                'assuntos' => ['Romance', 'Realismo']
            ],
            [
                'titulo' => 'A Revolução dos Bichos',
                'valor' => 38.00,
                'data_publicacao' => '2014-09-18',
                'autores' => ['George Orwell'],
                'assuntos' => ['Fábula', 'Política']
            ],
            [
                'titulo' => '1984',
                'valor' => 43.90,
                'data_publicacao' => '2013-12-15',
                'autores' => ['George Orwell'],
                'assuntos' => ['Distopia', 'Política']
            ],
            [
                'titulo' => 'A Cabana',
                'valor' => 35.00,
                'data_publicacao' => '2015-11-11',
                'autores' => ['William P. Young'],
                'assuntos' => ['Drama', 'Religião']
            ],
            [
                'titulo' => 'A Menina que Roubava Livros',
                'valor' => 45.90,
                'data_publicacao' => '2016-02-09',
                'autores' => ['Markus Zusak'],
                'assuntos' => ['Drama', 'História']
            ],
            [
                'titulo' => 'Extraordinário',
                'valor' => 31.50,
                'data_publicacao' => '2017-06-13',
                'autores' => ['R. J. Palacio'],
                'assuntos' => ['Drama', 'Juvenil']
            ],
            [
                'titulo' => 'O Homem Mais Rico da Babilônia',
                'valor' => 26.00,
                'data_publicacao' => '2019-10-29',
                'autores' => ['George S. Clason'],
                'assuntos' => ['Finanças', 'Autoajuda']
            ],
            [
                'titulo' => 'O Hobbit',
                'valor' => 55.00,
                'data_publicacao' => '2020-05-02',
                'autores' => ['J. R. R. Tolkien'],
                'assuntos' => ['Fantasia', 'Aventura']
            ],
        ];


        foreach ($livros as $item) {
            $autorIds = [];
            $assuntoIds = [];

            // Cria autores se não existem
            foreach ($item['autores'] as $autorNome) {
                $autor = Autor::firstOrCreate(['nome' => $autorNome]);
                $autorIds[] = $autor->id;
            }

            // Cria assuntos se não existem
            foreach ($item['assuntos'] as $assuntoDesc) {
                $assunto = Assunto::firstOrCreate(['descricao' => $assuntoDesc]);
                $assuntoIds[] = $assunto->id;
            }

            // Cria o livro
            $livro = Livro::create([
                'titulo' => $item['titulo'],
                'valor' => $item['valor'],
                'data_publicacao' => $item['data_publicacao'],
                // Ajuste o user_id conforme sua lógica. Aqui está fixo como 1:
                'user_id' => 1
            ]);

            // Relaciona autores e assuntos
            $livro->autores()->sync($autorIds);   // Relacionamento N:N autores
            $livro->assuntos()->sync($assuntoIds); // Relacionamento N:N assuntos

            // Verificações básicas
            $this->assertDatabaseHasLivro($item['titulo']);
        }
    }

    // Helper só para melhorar mensagem do teste
    protected function assertDatabaseHasLivro($titulo)
    {
        $livro = Livro::where('titulo', $titulo)->first();
        $this->assertNotNull($livro, "Livro '{$titulo}' não foi encontrado no banco.");
    }
}
