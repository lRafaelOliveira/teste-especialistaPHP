<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditoriaLivro extends Model
{
    protected $table = 'auditoria_livro';
    public $timestamps = false;
    protected $fillable = ['livro_id', 'acao', 'data_evento'];
}
