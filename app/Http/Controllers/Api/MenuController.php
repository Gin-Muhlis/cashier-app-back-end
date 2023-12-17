<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller {
	public function index(Request $request) {

		$menus = Menu::all();

		$data = new MenuCollection($menus);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
	}

	public function store(MenuStoreRequest $request) {

		try {
			$validated = $request->validated();
			if ($request->hasFile('image')) {
				$validated['image'] = $request->file('image')->store('public');
			}

			$menu = Menu::create($validated);

			return new MenuResource($menu);
		} catch (Exception $e) {
			return response()->json([
				'message' => $e->getMessage(),
			]);
		}
	}

	public function show(Request $request, Menu $menu): MenuResource {

		return new MenuResource($menu);
	}

	public function update(MenuUpdateRequest $request, Menu $menu) {
		$validated = $request->validated();
		return response()->json(['date' => $validated], 500);
		if ($request->hasFile('image')) {
			if ($menu->image) {
				Storage::delete($menu->image);
			}

			$validated['image'] = $request->file('image')->store('public');
		}

		$menu->update($validated);

		return new MenuResource($menu);
	}

	public function destroy(Request $request, Menu $menu): Response {

		if ($menu->image) {
			Storage::delete($menu->image);
		}

		$menu->delete();

		return response()->noContent();
	}
}