<?php

namespace App\Http\Controllers\Api;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use App\Http\Resources\TableCollection;
use App\Http\Requests\TableStoreRequest;
use App\Http\Requests\TableUpdateRequest;

class TableController extends Controller
{
    public function index(Request $request): TableCollection
    {
        $this->authorize('view-any', Table::class);

        $search = $request->get('search', '');

        $tables = Table::search($search)
            ->latest()
            ->paginate();

        return new TableCollection($tables);
    }

    public function store(TableStoreRequest $request): TableResource
    {
        $this->authorize('create', Table::class);

        $validated = $request->validated();

        $table = Table::create($validated);

        return new TableResource($table);
    }

    public function show(Request $request, Table $table): TableResource
    {
        $this->authorize('view', $table);

        return new TableResource($table);
    }

    public function update(
        TableUpdateRequest $request,
        Table $table
    ): TableResource {
        $this->authorize('update', $table);

        $validated = $request->validated();

        $table->update($validated);

        return new TableResource($table);
    }

    public function destroy(Request $request, Table $table): Response
    {
        $this->authorize('delete', $table);

        $table->delete();

        return response()->noContent();
    }
}
