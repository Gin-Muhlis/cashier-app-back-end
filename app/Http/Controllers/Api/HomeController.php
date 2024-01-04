<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Transaction;
use Exception;

class HomeController extends Controller {
	public function index() {
		try {

			$data = [
				'transactionsAmount' => Transaction::sum('total_payment'),
				'stocksAmount' => Stock::sum('amount'),
				'transactions' => $transactions = Transaction::count(),
			];

			return response()->json([
				'success' => true,
				'data' => $data,
			]);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage(),
			]);
		}
	}
}
