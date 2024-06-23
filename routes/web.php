<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

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
});

Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
Route::get('/warehouse/create', [WarehouseController::class, 'create'])->name('warehouse.create');
Route::get('/warehouse/{id}', [WarehouseController::class, 'show'])->name('warehouse.show');
Route::get('/warehouse/{id}/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit');
Route::put('/warehouse/{id}/update', [WarehouseController::class, 'update'])->name('warehouse.update');
Route::delete('/warehouse/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');
Route::post('/warehouse/store', [WarehouseController::class, 'store'])->name('warehouse.store');




Route::get('/location/create', [LocationController::class, 'create'])->name('location.create');

Route::get('/location/{id}', [LocationController::class, 'show'])->name('location.show');

Route::get('/location/{id}/edit', [LocationController::class, 'edit'])->name('location.edit');

Route::put('/location/{id}/update', [LocationController::class, 'update'])->name('location.update');

Route::resource('location', LocationController::class);
