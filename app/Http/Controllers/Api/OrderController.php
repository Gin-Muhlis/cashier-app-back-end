<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller {
	public function index(Request $request) {

		$orders = Order::all();

		$data = new OrderCollection($orders);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
	}

	public function store(OrderStoreRequest $request) {

		$validated = $request->validated();

		$order = Order::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Pemesanan berhasil ditambahkan',
		]);
	}

	public function show(Request $request, Order $order): OrderResource {

		return new OrderResource($order);
	}

	public function update(
		OrderUpdateRequest $request,
		Order $order
	) {

		$validated = $request->validated();

		$order->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Pemesanan berhasil diupdate',
		]);
	}

	public function destroy(Request $request, Order $order) {

		$order->delete();

		return response()->json([
			'success' => true,
			'message' => 'Pemesanan berhasil dihapus',
		]);
	}
}
