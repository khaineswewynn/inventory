<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    
    Route::get('/', function () {
        return view('index');
    })->name('index');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/provider', ProviderController::class);
    Route::resource('/location', LocationController::class);
    Route::resource('/warehouse', WarehouseController::class);
    Route::resource('/purchase', PurchaseController::class);
    Route::get('invoice_download/{id}', [PurchaseController::class, 'download'])->name('invoice.download');
    Route::resource('/permission', PermissionController::class);

    Route::middleware('check.role:Admin')->group(function () {
        Route::resource('/permission', PermissionController::class);
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/view', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/singin', [LoginController::class, 'singin'])->name('singin');