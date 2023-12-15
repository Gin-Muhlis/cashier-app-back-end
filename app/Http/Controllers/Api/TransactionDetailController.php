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

		$search = $request->get('search', '');

		$transactionDetails = TransactionDetail::search($search)
			->latest()
			->paginate();

		return new TransactionDetailCollection($transactionDetails);
	}

	public function store(
		TransactionDetailStoreRequest $request
	): TransactionDetailResource {
		$validated = $request->validated();

		$transactionDetail = TransactionDetail::create($validated);

		return new TransactionDetailResource($transactionDetail);
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
	): TransactionDetailResource {
		$validated = $request->validated();

		$transactionDetail->update($validated);

		return new TransactionDetailResource($transactionDetail);
	}

	public function destroy(
		Request $request,
		TransactionDetail $transactionDetail
	): Response {

		$transactionDetail->delete();

		return response()->noContent();
	}
}
