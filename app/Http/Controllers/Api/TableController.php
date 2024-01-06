<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Http\Requests\TableUpdateRequest;
use App\Http\Resources\TableCollection;
use App\Http\Resources\TableResource;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TableController extends Controller {
	public function index(Request $request) {

		$search = $request->get('search', '');

		$tables = Table::all();

		$data = new TableCollection($tables);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
	}

	public function store(TableStoreRequest $request) {

		$validated = $request->validated();

		$table = Table::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Meja berhasil ditambahkan',
		]);
	}

	public function show(Request $request, Table $table): TableResource {

		return new TableResource($table);
	}

	public function update(
		TableUpdateRequest $request,
		Table $table
	) {

		$validated = $request->validated();

		$table->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Meja berhasil diupdate',
		]);
	}

	public function destroy(Request $request, Table $table) {

		$table->delete();

		return response()->json([
			'success' => true,
			'message' => 'Meja berhasil dihapus',
		]);
	}
}
