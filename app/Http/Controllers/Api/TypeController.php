<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeStoreRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Http\Resources\TypeCollection;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeController extends Controller {
	public function index(Request $request) {

		$types = Type::all();

		$data = new TypeCollection($types);
		return response()->json([
			'success' => 'true',
			'data' => $data,
		]);
	}

	public function store(TypeStoreRequest $request) {

		$validated = $request->validated();

		$type = Type::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Jenis berhasil ditambahkan',
		]);
	}

	public function show(Request $request, Type $type): TypeResource {

		return new TypeResource($type);
	}

	public function update(TypeUpdateRequest $request, Type $type) {

		$validated = $request->validated();

		$type->update($validated);

		$updatedType = new TypeResource($type);

		return response()->json([
			'success' => true,
			'message' => 'Jenis berhasil diupdate',
			'data' => $updatedType,
		]);
	}

	public function destroy(Request $request, Type $type) {

		$type->delete();

		return response()->json([
			'success' => true,
			'message' => 'Jenis berhasil dihapus',
		]);
	}
}
