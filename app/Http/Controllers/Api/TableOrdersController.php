<?php

namespace App\Http\Controllers\Api;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class TableOrdersController extends Controller
{
    public function index(Request $request, Table $table): OrderCollection
    {
        $this->authorize('view', $table);

        $search = $request->get('search', '');

        $orders = $table
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(Request $request, Table $table): OrderResource
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'order_date' => ['required', 'date'],
            'start' => ['required', 'date_format:H:i:s'],
            'end' => ['required', 'date_format:H:i:s'],
            'order_name' => ['required', 'max:255', 'string'],
            'customer_amount' => ['required', 'numeric'],
        ]);

        $order = $table->orders()->create($validated);

        return new OrderResource($order);
    }
}
