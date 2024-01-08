<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionResource;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller {
	public function index(Request $request): TransactionCollection {

		$transactions = Transaction::all();

		return new TransactionCollection($transactions);
	}

	public function store(TransactionStoreRequest $request) {

		try {
			$validated = $request->validated();
			$validated['date'] = Carbon::now()->format('Y-m-d');
			$validated['user_id'] = 1;

			DB::beginTransaction();

			$transaction = Transaction::create($validated);

			foreach ($validated['menus'] as $menu) {
				$stock = Stock::where('menu_id', $menu['menu_id'])->first();
				$stock->update(['amount' => $stock->amount - $menu['quantity']]);
				$data = [
					'menu_id' => $menu['menu_id'],
					'quantity' => $menu['quantity'],
					'sub_total' => $menu['sub_total'],
					'unit_price' => $menu['unit_price'],
					'transaction_id' => $transaction->id,
				];

				TransactionDetail::create($data);
			}

			DB::commit();

			return response()->json([
				'success' => true,
				'message' => 'Transaksi berhasil ditambahkan',
				'data' => $transaction,
			]);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage(),
			], 500);
		}
	}

	public function show(
		Request $request,
		Transaction $transaction
	): TransactionResource {

		return new TransactionResource($transaction);
	}

	public function update(
		TransactionUpdateRequest $request,
		Transaction $transaction
	) {

		$validated = $request->validated();

		$transaction->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Transaksi berhasil diupdate',
		]);
	}

	public function destroy(
		Request $request,
		Transaction $transaction
	) {

		$transaction->delete();

		return response()->json([
			'success' => true,
			'message' => 'Transaksi berhasil dihapus',
		]);
	}
}
