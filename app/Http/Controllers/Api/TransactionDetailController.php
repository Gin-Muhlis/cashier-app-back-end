<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionDetailStoreRequest;
use App\Http\Requests\TransactionDetailUpdateRequest;
use App\Http\Resources\TransactionDetailCollection;
use App\Http\Resources\TransactionDetailResource;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionDetailController extends Controller {
	public function index(Request $request): TransactionDetailCollection {

		$transactionDetails = TransactionDetail::all();

		return new TransactionDetailCollection($transactionDetails);
	}

	public function store(
		TransactionDetailStoreRequest $request
	) {
		$validated = $request->validated();

		$transactionDetail = TransactionDetail::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Detail Transaksi berhasil ditambahkan',
		]);
	}

	public function show(
		Request $request,
		TransactionDetail $transactionDetail
	): TransactionDetailResource {

		return new TransactionDetailResource($transactionDetail);
	}

	public function update(
		TransactionDetailUpdateRequest $request,
		TransactionDetail $transactionDetail
	) {
		$validated = $request->validated();

		$transactionDetail->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Detail Transaksi berhasil diupdate',
		]);
	}

	public function destroy(
		Request $request,
		TransactionDetail $transactionDetail
	) {

		$transactionDetail->delete();

		return response()->json([
			'success' => true,
			'message' => 'Detail Transaksi berhasil dihapus',
		]);
	}
}
