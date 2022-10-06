<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MachineryController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionOrderController;
use App\Http\Controllers\ProductionOrderProductController;
use App\Http\Controllers\ProductRecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () { return redirect('/login'); });

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])
    ->group(function () {
        Route::resource('/dashboard', DashboardController::class, ["names"=> 'dashboard']);

        Route::put('user/{user}/password', [UserController::class, 'passwordUpdate'])
            ->middleware(['role:super-admin'])
            ->name('user.passwordUpdate');
        Route::resource('user', UserController::class)
            ->middleware(['role:super-admin']);

        Route::resource('company', CompanyController::class);
        Route::resource('department', DepartmentController::class);
        Route::resource('machinery', MachineryController::class);
        Route::resource('product', ProductController::class);
        Route::resource('part', PartController::class);
        Route::resource('product_recipe', ProductRecipeController::class);

        Route::get('production_order/print/{productionOrder}', [ProductionOrderController::class, 'print'])
            ->name('production_order.print');
        Route::resource('production_order', ProductionOrderController::class);

        Route::put('production_order_product/increment/{productionOrder}', [ProductionOrderProductController::class, 'increment'])
            ->name('production_order_product.increment');
        Route::put('production_order_product/decrement/{productionOrder}', [ProductionOrderProductController::class, 'decrement'])
            ->name('production_order_product.decrement');
        Route::resource('production_order_product', ProductionOrderProductController::class);
    });
