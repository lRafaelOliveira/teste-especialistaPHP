<?php

use PHPUnit\Framework\TestCase;
use App\Models\Livro;

class LivroTest extends TestCase
{
    public function test_cria_novo_livro()
    {
        $livro = new Livro([
            'titulo' => 'Dom Casmurro',
            'valor' => 39.90,
            'data_publicacao' => '1899-01-01',
            'user_id' => 1
        ]);
        $this->assertEquals('Dom Casmurro', $livro->titulo);
    }
}
