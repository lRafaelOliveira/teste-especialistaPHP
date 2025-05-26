<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';
    protected $fillable = ['nome'];
    public $timestamps = false;

    // Um autor pode ter muitos livros (via relacionamento N-N)
    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_autor', 'autor_id', 'livro_id');
    }
}
