<?php

require __DIR__.'/../vendor/autoload.php';
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\RoleController;
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

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::resource('/customer', CustomerController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::get('/product-price/{id}', [ProductController::class, 'getPrice']);
    Route::resource('/provider', ProviderController::class);
    Route::resource('/location', LocationController::class);
    Route::resource('/warehouse', WarehouseController::class);
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::get('/stocks/details/{date}', [StockController::class, 'details'])->name('stocks.details');
    Route::resource('/sale', SalesController::class)->except(['destroy']);

    Route::delete('/sale/{sale}', [SalesController::class, 'destroy'])
    ->middleware('check.permission:delete-sales')
    ->name('sale.destroy');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('/role', RoleController::class);

        Route::get('/roles-permissions/assign-permissions', [RolePermissionController::class, 'showRolesPermissions'])
            ->name('assign-permissions');

        Route::post('/roles-permissions/assign-permissions', [RolePermissionController::class, 'updateRolePermissions'])
            ->middleware('check.permission:update-role-permissions')
            ->name('update-role-permissions');

        Route::get('/roles-permissions/assign-roles', [RolePermissionController::class, 'showAssignRolesToUsers'])
            ->name('assign-roles');

        Route::post('/roles-permissions/assign-roles', [RolePermissionController::class, 'updateUserRole'])
            ->middleware('check.permission:update-user-role')
            ->name('update-user-role');
    });


    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
