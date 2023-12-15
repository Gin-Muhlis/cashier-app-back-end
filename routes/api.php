<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryTypesController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\MenuTransactionDetailsController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\TableOrdersController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransactionDetailController;
use App\Http\Controllers\Api\TransactionTransactionDetailsController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\TypeMenusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserTransactionsController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::name('api.')
	->middleware('auth:api')
	->group(function () {
		Route::post('/logout', [AuthController::class, 'logout']);
		Route::apiResource('categories', CategoryController::class);

		// Category Types
		Route::get('/categories/{category}/types', [
			CategoryTypesController::class,
			'index',
		])->name('categories.types.index');
		Route::post('/categories/{category}/types', [
			CategoryTypesController::class,
			'store',
		])->name('categories.types.store');

		Route::apiResource('customers', CustomerController::class);

		Route::apiResource('menus', MenuController::class);

		// Menu Transaction Details
		Route::get('/menus/{menu}/transaction-details', [
			MenuTransactionDetailsController::class,
			'index',
		])->name('menus.transaction-details.index');
		Route::post('/menus/{menu}/transaction-details', [
			MenuTransactionDetailsController::class,
			'store',
		])->name('menus.transaction-details.store');

		Route::apiResource('orders', OrderController::class);

		Route::apiResource('stocks', StockController::class);

		Route::apiResource('tables', TableController::class);

		// Table Orders
		Route::get('/tables/{table}/orders', [
			TableOrdersController::class,
			'index',
		])->name('tables.orders.index');
		Route::post('/tables/{table}/orders', [
			TableOrdersController::class,
			'store',
		])->name('tables.orders.store');

		Route::apiResource('transactions', TransactionController::class);

		// Transaction Transaction Details
		Route::get('/transactions/{transaction}/transaction-details', [
			TransactionTransactionDetailsController::class,
			'index',
		])->name('transactions.transaction-details.index');
		Route::post('/transactions/{transaction}/transaction-details', [
			TransactionTransactionDetailsController::class,
			'store',
		])->name('transactions.transaction-details.store');

		Route::apiResource(
			'transaction-details',
			TransactionDetailController::class
		);

		Route::apiResource('types', TypeController::class);

		// Type Menus
		Route::get('/types/{type}/menus', [
			TypeMenusController::class,
			'index',
		])->name('types.menus.index');
		Route::post('/types/{type}/menus', [
			TypeMenusController::class,
			'store',
		])->name('types.menus.store');

		Route::apiResource('users', UserController::class);

		// User Transactions
		Route::get('/users/{user}/transactions', [
			UserTransactionsController::class,
			'index',
		])->name('users.transactions.index');
		Route::post('/users/{user}/transactions', [
			UserTransactionsController::class,
			'store',
		])->name('users.transactions.store');
	});
