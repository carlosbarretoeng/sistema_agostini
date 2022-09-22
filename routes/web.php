<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MachineryController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () { return redirect('/login'); });

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])
    ->group(function () {
        Route::get('/dashboard', function () { return Inertia::render('Dashboard');})->name('dashboard');

        Route::resource('company', CompanyController::class);
        Route::resource('department', DepartmentController::class);
        Route::resource('machinery', MachineryController::class);
        Route::resource('product', ProductController::class);
        Route::resource('part', PartController::class);
    });
