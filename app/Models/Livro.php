<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livros';
    protected $fillable = ['titulo', 'valor', 'data_publicacao', 'user_id'];
    public $timestamps = false;

    // Livro pertence a um usuário (quem cadastrou)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Livro tem vários autores (N-N)
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'livro_id', 'autor_id');
    }

    // Livro tem vários assuntos (N-N)
    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'livro_id', 'assunto_id');
    }
}
