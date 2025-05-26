<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroAutor extends Model
{
    protected $table = 'livro_autor';
    public $timestamps = false;
    protected $fillable = ['livro_id', 'autor_id'];
}
