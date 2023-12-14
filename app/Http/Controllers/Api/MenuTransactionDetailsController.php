<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\TransactionDetailCollection;

class MenuTransactionDetailsController extends Controller
{
    public function index(
        Request $request,
        Menu $menu
    ): TransactionDetailCollection {
        $this->authorize('view', $menu);

        $search = $request->get('search', '');

        $transactionDetails = $menu
            ->transactionDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransactionDetailCollection($transactionDetails);
    }

    public function store(
        Request $request,
        Menu $menu
    ): TransactionDetailResource {
        $this->authorize('create', TransactionDetail::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
            'transaction_id' => ['required', 'exists:transactions,id'],
        ]);

        $transactionDetail = $menu->transactionDetails()->create($validated);

        return new TransactionDetailResource($transactionDetail);
    }
}
