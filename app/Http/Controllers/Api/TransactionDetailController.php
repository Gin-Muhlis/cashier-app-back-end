<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\TransactionDetailCollection;
use App\Http\Requests\TransactionDetailStoreRequest;
use App\Http\Requests\TransactionDetailUpdateRequest;

class TransactionDetailController extends Controller
{
    public function index(Request $request): TransactionDetailCollection
    {
        $this->authorize('view-any', TransactionDetail::class);

        $search = $request->get('search', '');

        $transactionDetails = TransactionDetail::search($search)
            ->latest()
            ->paginate();

        return new TransactionDetailCollection($transactionDetails);
    }

    public function store(
        TransactionDetailStoreRequest $request
    ): TransactionDetailResource {
        $this->authorize('create', TransactionDetail::class);

        $validated = $request->validated();

        $transactionDetail = TransactionDetail::create($validated);

        return new TransactionDetailResource($transactionDetail);
    }

    public function show(
        Request $request,
        TransactionDetail $transactionDetail
    ): TransactionDetailResource {
        $this->authorize('view', $transactionDetail);

        return new TransactionDetailResource($transactionDetail);
    }

    public function update(
        TransactionDetailUpdateRequest $request,
        TransactionDetail $transactionDetail
    ): TransactionDetailResource {
        $this->authorize('update', $transactionDetail);

        $validated = $request->validated();

        $transactionDetail->update($validated);

        return new TransactionDetailResource($transactionDetail);
    }

    public function destroy(
        Request $request,
        TransactionDetail $transactionDetail
    ): Response {
        $this->authorize('delete', $transactionDetail);

        $transactionDetail->delete();

        return response()->noContent();
    }
}
