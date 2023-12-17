<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StockController extends Controller {
	public function index(Request $request) {

		$stocks = Stock::all();

		$data = new StockCollection($stocks);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
	}

	public function store(StockStoreRequest $request): StockResource {

		$validated = $request->validated();

		$stock = Stock::create($validated);

		return new StockResource($stock);
	}

	public function show(Request $request, Stock $stock): StockResource {

		return new StockResource($stock);
	}

	public function update(
		StockUpdateRequest $request,
		Stock $stock
	): StockResource {

		$validated = $request->validated();

		$stock->update($validated);

		return new StockResource($stock);
	}

	public function destroy(Request $request, Stock $stock): Response {

		$stock->delete();

		return response()->noContent();
	}
}
