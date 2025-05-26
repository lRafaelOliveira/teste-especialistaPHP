<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    protected $table = 'assuntos';
    protected $fillable = ['descricao'];
    public $timestamps = false;

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assunto', 'assunto_id', 'livro_id');
    }
}
