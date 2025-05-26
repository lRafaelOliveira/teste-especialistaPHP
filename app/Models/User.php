<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role'];
    public $timestamps = false;

    // Um usuário pode ter muitos livros cadastrados
    public function livros()
    {
        return $this->hasMany(Livro::class, 'user_id');
    }
}
