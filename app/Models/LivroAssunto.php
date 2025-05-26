<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroAssunto extends Model
{
    protected $table = 'livro_assunto';
    public $timestamps = false;
    protected $fillable = ['livro_id', 'assunto_id'];
}
