<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])
    ->group(function () {
        Route::get('/dashboard', function () { return Inertia::render('Dashboard');})->name('dashboard');

        Route::resource('usuario',App\Http\Controllers\UserController::class);
        Route::resource('perfil',App\Http\Controllers\PerfilController::class);
        Route::resource('permissao',App\Http\Controllers\PermissaoController::class);

        Route::resource('empresa',App\Http\Controllers\EmpresaController::class);
        Route::resource('departamento',App\Http\Controllers\DepartamentoController::class);
        Route::resource('maquinario',App\Http\Controllers\MaquinarioController::class);

        Route::prefix('app')->group(function () {
            Route::get('tempos', 'App\Http\Controllers\AppTemposController@index')->name('app.tempos.index');
        });
    });
