<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller {
	public function index(Request $request) {
		$categories = Category::all();

		$data = new CategoryCollection($categories);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
	}

	public function store(CategoryStoreRequest $request) {
		$validated = $request->validated();

		$category = Category::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Kategori berhasil ditambahkan',
		]);
	}

	public function show(Request $request, Category $category): CategoryResource {
		return new CategoryResource($category);
	}

	public function update(
		CategoryUpdateRequest $request,
		Category $category
	) {

		$validated = $request->validated();

		$category->update($validated);

		$updated_category = new CategoryResource($category);

		return response()->json([
			'success' => true,
			'message' => 'Kategori berhasil diupdate',
			'data' => $updated_category,
		]);
	}

	public function destroy(Request $request, Category $category) {

		$category->delete();

		return response()->json([
			'success' => true,
			'message' => 'Kategori berhasil dihapus',
		]);
	}
}
