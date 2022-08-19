<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::redirect('/', '/login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');

    Route::resource('empresa', \App\Http\Controllers\EmpresaController::class, ['names' => 'empresa']);

    /*Route::resource('company', \App\Http\Controllers\CompanyController::class, ['names' => 'company']);
    Route::resource('product', \App\Http\Controllers\CompanyController::class, ['names' => 'product']);
    Route::resource('report', \App\Http\Controllers\CompanyController::class, ['names' => 'report']);*/
});
