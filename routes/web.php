<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])
    ->group(function () {
        Route::get('/dashboard', function () { return Inertia::render('Dashboard');})->name('dashboard');

        Route::resource('empresa',App\Http\Controllers\EmpresaController::class);
        Route::resource('departamento',App\Http\Controllers\DepartamentoController::class);
    });
