<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransactionDetailController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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

// menu
Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menus/{menu}', [MenuController::class, 'show']);
// pelanggan
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
// order
Route::apiResource('/orders', OrderController::class);
// meja
Route::get('/tables', [TableController::class, 'index']);
Route::get('/tables/{table}', [TableController::class, 'show']);
// transaksi
Route::apiResource('transactions', TransactionController::class);
// jenis pembayaran
Route::apiResource('payment_methods', PaymentMethodController::class);

Route::apiResource(
	'transaction-details',
	TransactionDetailController::class
);

// kategori
Route::apiResource('/categories', CategoryController::class);
// menu
Route::post('/menus', [MenuController::class, 'store']);
Route::put('/menus/{menu}', [MenuController::class, 'update']);
Route::delete('/menus/{menu}', [MenuController::class, 'destroy']);
// pelanggan
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{customer}', [CustomerController::class, 'update']);
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);

// stok
Route::apiResource('stocks', StockController::class);
// meja
Route::post('/tables', [TableController::class, 'store']);
Route::put('/tables/{table}', [TableController::class, 'update']);
Route::delete('/tables/{table}', [TableController::class, 'destroy']);
// jenis
Route::apiResource('types', TypeController::class);
// user
Route::apiResource('users', UserController::class);
// role
Route::apiResource('roles', RoleController::class);