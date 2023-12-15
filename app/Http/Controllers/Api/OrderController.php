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
	public function index(Request $request): OrderCollection {

		$search = $request->get('search', '');

		$orders = Order::search($search)
			->latest()
			->paginate();

		return new OrderCollection($orders);
	}

	public function store(OrderStoreRequest $request): OrderResource {

		$validated = $request->validated();

		$order = Order::create($validated);

		return new OrderResource($order);
	}

	public function show(Request $request, Order $order): OrderResource {

		return new OrderResource($order);
	}

	public function update(
		OrderUpdateRequest $request,
		Order $order
	): OrderResource {

		$validated = $request->validated();

		$order->update($validated);

		return new OrderResource($order);
	}

	public function destroy(Request $request, Order $order): Response {

		$order->delete();

		return response()->noContent();
	}
}
