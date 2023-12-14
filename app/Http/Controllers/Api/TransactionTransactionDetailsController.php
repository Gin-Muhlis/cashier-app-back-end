<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\TransactionDetailCollection;

class TransactionTransactionDetailsController extends Controller
{
    public function index(
        Request $request,
        Transaction $transaction
    ): TransactionDetailCollection {
        $this->authorize('view', $transaction);

        $search = $request->get('search', '');

        $transactionDetails = $transaction
            ->transactionDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransactionDetailCollection($transactionDetails);
    }

    public function store(
        Request $request,
        Transaction $transaction
    ): TransactionDetailResource {
        $this->authorize('create', TransactionDetail::class);

        $validated = $request->validate([
            'menu_id' => ['required', 'exists:menus,id'],
            'quantity' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
        ]);

        $transactionDetail = $transaction
            ->transactionDetails()
            ->create($validated);

        return new TransactionDetailResource($transactionDetail);
    }
}
