<?php

use App\Controllers\AssuntoController;
use App\Controllers\AutorController;
use App\Controllers\LivroController;
use App\Controllers\LoginController;
use App\Core\Route;
use App\Controllers\PainelController;
use App\Controllers\RegisterController;
use App\Controllers\RelatoriosController;
use App\Middlewares\AuthMiddleware;

Route::get('/', [RelatoriosController::class, 'index'])->name('relatorios.index');
Route::get('/login', [LoginController::class, 'showLogin']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register', [RegisterController::class, 'showRegister']);
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/dashboard', [PainelController::class, 'dashboard']);
    Route::get('/usuarios', [PainelController::class, 'usuarios']);
    Route::get('/sair', [LoginController::class, 'logout']);

    Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/livros/criar', [LivroController::class, 'create'])->name('livros.create');
    Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
    Route::get('/livros/{id}', [LivroController::class, 'show'])->name('livros.show');
    Route::get('/livros/{id}/editar', [LivroController::class, 'edit'])->name('livros.edit');
    Route::post('/livros/{id}', [LivroController::class, 'update'])->name('livros.update');
    Route::post('/livros/{id}/deletar', [LivroController::class, 'destroy'])->name('livros.destroy');

    Route::get('/autores', [AutorController::class, 'index'])->name('autores.index');
    Route::get('/autores/criar', [AutorController::class, 'create'])->name('autores.create');
    Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');
    Route::get('/autores/{id}/editar', [AutorController::class, 'edit'])->name('autores.edit');
    Route::post('/autores/{id}', [AutorController::class, 'update'])->name('autores.update');
    Route::post('/autores/{id}/deletar', [AutorController::class, 'destroy'])->name('autores.destroy');

    Route::get('/assuntos', [AssuntoController::class, 'index'])->name('assuntos.index');
    Route::get('/assuntos/criar', [AssuntoController::class, 'create'])->name('assuntos.create');
    Route::post('/assuntos', [AssuntoController::class, 'store'])->name('assuntos.store');
    Route::get('/assuntos/{id}/editar', [AssuntoController::class, 'edit'])->name('assuntos.edit');
    Route::post('/assuntos/{id}', [AssuntoController::class, 'update'])->name('assuntos.update');
    Route::post('/assuntos/{id}/deletar', [AssuntoController::class, 'destroy'])->name('assuntos.destroy');
});
