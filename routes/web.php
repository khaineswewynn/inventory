<?php

<<<<<<< HEAD
use App\Http\Controllers\CustomerController;
=======
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LocationController;
>>>>>>> 73f16fa (updated purchase migrations)
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\WarehouseController;

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

Route::get('/', function () {
    return view('index');
<<<<<<< HEAD
});

Route::resource('/customer', CustomerController::class);
=======
})->name('index');

Route::resource('/customer', CustomerController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/product', ProductController::class);
Route::resource('/provider', ProviderController::class);
Route::resource('/location', LocationController::class);
Route::resource('/warehouse', WarehouseController::class);
>>>>>>> 73f16fa (updated purchase migrations)
