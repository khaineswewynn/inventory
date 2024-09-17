<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\SalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('locations', LocationController::class);
Route::apiResource('warehouse', WarehouseController::class);
Route::apiResource('provider', ProviderController::class);
// Route::apiResource('sales', SalesController::class);
Route::middleware(['auth:api'])->group(function () {

    // Permission check for viewing (index, show)
    Route::middleware('check.permission:view-sales')->group(function () {
        Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
        Route::get('/sales/{sale}', [SalesController::class, 'show'])->name('sales.show');
    });

    // Permission check for creating a sale
    Route::middleware('check.permission:create-sales')->group(function () {
        Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
    });

    // Permission check for updating a sale
    Route::middleware('check.permission:edit-sales')->group(function () {
        Route::put('/sales/{sale}', [SalesController::class, 'update'])->name('sales.update');
        Route::patch('/sales/{sale}', [SalesController::class, 'update'])->name('sales.update');
    });

    // Permission check for deleting a sale
    Route::middleware('check.permission:delete-sales')->group(function () {
        Route::delete('/sales/{sale}', [SalesController::class, 'destroy'])->name('sales.destroy');
    });
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('jwt.verify')->get('me', [AuthController::class, 'me']);
