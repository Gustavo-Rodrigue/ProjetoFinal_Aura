<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pag_init/index');
});
Route::get('/mural', [UserController::class, 'index'])->name('mural.index');
Route::get('/informacoes', [UserController::class, 'informacoes'])->name('informacoes.index');
Route::get('/documento_estagio', [UserController::class, 'documento_estagio'])->name('documento_estagio.index');

// Página de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/cadastrar',[UserController::class,'cadastrar'])->name('cadastrar');

// Página inicial / mural
Route::get('/mural', [UserController::class, 'index'])->name('mural.index');

// Página inicial personalizada
Route::get('/pag_init', [UserController::class, 'pagInit'])->name('pag_init');

// Documento de estágio
Route::get('/documento_estagio', [UserController::class, 'documento_estagio'])->name('documento_estagio.index');

// Informações
Route::get('/informacoes', [UserController::class, 'informacoes'])->name('informacoes.index');

// Cadastrar vaga
Route::post('/vaga', [UserController::class, 'vaga'])->name('vaga');

// Atualizar vaga (PUT)
Route::put('/vaga/{id}', [UserController::class, 'atualizarVaga'])->name('vaga.atualizar');

// Excluir vaga (DELETE)
Route::delete('/vaga/{id}', [UserController::class, 'excluirVaga'])->name('vaga.excluir');

Route::get('/google/redirect', [GoogleController::class, 'redirectToGoogle']);
Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);



