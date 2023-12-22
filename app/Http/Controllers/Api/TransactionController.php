<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller {
	public function index(Request $request): TransactionCollection {

		$search = $request->get('search', '');

		$transactions = Transaction::search($search)
			->latest()
			->paginate();

		return new TransactionCollection($transactions);
	}

	public function store(TransactionStoreRequest $request) {

		try {
			$validated = $request->validated();
			$validated['date'] = Carbon::now()->format('Y-m-d');
			$validated['user_id'] = 1;
			$validated['description'] = '-';

			DB::beginTransaction();

			$transaction = Transaction::create($validated);

			foreach ($validated['menus'] as $menu) {
				$data = [
					'menu_id' => $menu['id'],
					'quantity' => $menu['quantity'],
					'sub_total' => $menu['quantity'] * $menu['unit_price'],
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
	): TransactionResource {

		$validated = $request->validated();

		$transaction->update($validated);

		return new TransactionResource($transaction);
	}

	public function destroy(
		Request $request,
		Transaction $transaction
	): Response {

		$transaction->delete();

		return response()->noContent();
	}
}
