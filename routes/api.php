<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HomeController;
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
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['cors', 'json.response'])->group(function () {
	// login
	// Route::post('/auth/login', [AuthController::class, 'login']);

	// Route::middleware('')->group(function () {
	// 	// logout
	// 	Route::post('/logout', [AuthController::class, 'logout']);
	// 	// profile
	// 	Route::get('/me', [AuthController::class, 'profile']);

	// 	Route::middleware('role:admin')->group(function () {
	// 		// kategori
	// 		Route::apiResource('/categories', CategoryController::class);
	// 		// role
	// 		Route::apiResource('roles', RoleController::class);
	// 		// user
	// 		Route::apiResource('users', UserController::class);
	// 		// stok
	// 		Route::apiResource('stocks', StockController::class);
	// 		// jenis pembayaran
	// 		Route::apiResource('payment_methods', PaymentMethodController::class);
	// 		// jenis
	// 		Route::post('/types', [TypeController::class, 'store']);
	// 		Route::put('/types/{type}', [TypeController::class, 'update']);
	// 		Route::delete('/types/{type}', [TypeController::class, 'destroy']);
	// 		// menu
	// 		Route::post('/menus', [MenuController::class, 'store']);
	// 		Route::put('/menus/{menu}', [MenuController::class, 'update']);
	// 		Route::delete('/menus/{menu}', [MenuController::class, 'destroy']);
	// 		// meja
	// 		Route::post('/tables', [TableController::class, 'store']);
	// 		Route::put('/tables/{table}', [TableController::class, 'update']);
	// 		Route::delete('/tables/{table}', [TableController::class, 'destroy']);
	// 		// transaksi
	// 		Route::get('/transactions', [TransactionController::class, 'index']);
	// 		Route::get('/transactions/{transaction}', [TransactionController::class, 'show']);
	// 		Route::put('/transactions/{transaction}', [TransactionController::class, 'update']);
	// 		Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy']);
	// 		// detail transaksi
	// 		Route::apiResource(
	// 			'transaction-details',
	// 			TransactionDetailController::class
	// 		);

	// 	});
	// 	Route::middleware('role:admin,kasir')->group(function () {
	// 		// order
	// 		Route::apiResource('/orders', OrderController::class);
	// 		// meja
	// 		Route::get('/tables', [TableController::class, 'index']);
	// 		Route::get('/tables/{table}', [TableController::class, 'show']);
	// 		// menu
	// 		Route::get('/menus', [MenuController::class, 'index']);
	// 		Route::get('/menus/{menu}', [MenuController::class, 'show']);
	// 		// pelanggan
	// 		Route::get('/types', [TypeController::class, 'index']);
	// 		Route::get('/types/{type}', [TypeController::class, 'show']);
	// 		// pelanggan
	// 		Route::apiResource('customers', CustomerController::class);
	// 		// transaksi
	// 		Route::post('/transactions', [TransactionController::class, 'store']);
	// 	});
	// });
	Route::get('/data-home', [HomeController::class, 'index']);
	// kategori
	Route::apiResource('/categories', CategoryController::class);
	// role
	Route::apiResource('roles', RoleController::class);
	// user
	Route::apiResource('users', UserController::class);
	// stok
	Route::apiResource('stocks', StockController::class);
	// jenis pembayaran
	Route::apiResource('payment_methods', PaymentMethodController::class);
	// jenis
	Route::post('/types', [TypeController::class, 'store']);
	Route::put('/types/{type}', [TypeController::class, 'update']);
	Route::delete('/types/{type}', [TypeController::class, 'destroy']);
	// menu
	Route::post('/menus', [MenuController::class, 'store']);
	Route::put('/menus/{menu}', [MenuController::class, 'update']);
	Route::delete('/menus/{menu}', [MenuController::class, 'destroy']);
	// meja
	Route::post('/tables', [TableController::class, 'store']);
	Route::put('/tables/{table}', [TableController::class, 'update']);
	Route::delete('/tables/{table}', [TableController::class, 'destroy']);
	// transaksi
	Route::get('/transactions', [TransactionController::class, 'index']);
	Route::get('/transactions/{transaction}', [TransactionController::class, 'show']);
	Route::put('/transactions/{transaction}', [TransactionController::class, 'update']);
	Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy']);
	// detail transaksi
	Route::apiResource(
		'transaction-details',
		TransactionDetailController::class
	);
	// order
	Route::apiResource('/orders', OrderController::class);
	// meja
	Route::get('/tables', [TableController::class, 'index']);
	Route::get('/tables/{table}', [TableController::class, 'show']);
	// menu
	Route::get('/menus', [MenuController::class, 'index']);
	Route::get('/menus/{menu}', [MenuController::class, 'show']);
	// pelanggan
	Route::get('/types', [TypeController::class, 'index']);
	Route::get('/types/{type}', [TypeController::class, 'show']);
	// pelanggan
	Route::apiResource('customers', CustomerController::class);
	// transaksi
	Route::post('/transactions', [TransactionController::class, 'store']);
	// laporan
	Route::get('/stock-report', [ReportController::class, 'stockReport']);
});