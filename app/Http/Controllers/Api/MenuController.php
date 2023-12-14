<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;
use App\Http\Requests\MenuStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MenuUpdateRequest;

class MenuController extends Controller
{
    public function index(Request $request): MenuCollection
    {
        $this->authorize('view-any', Menu::class);

        $search = $request->get('search', '');

        $menus = Menu::search($search)
            ->latest()
            ->paginate();

        return new MenuCollection($menus);
    }

    public function store(MenuStoreRequest $request): MenuResource
    {
        $this->authorize('create', Menu::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $menu = Menu::create($validated);

        return new MenuResource($menu);
    }

    public function show(Request $request, Menu $menu): MenuResource
    {
        $this->authorize('view', $menu);

        return new MenuResource($menu);
    }

    public function update(MenuUpdateRequest $request, Menu $menu): MenuResource
    {
        $this->authorize('update', $menu);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::delete($menu->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $menu->update($validated);

        return new MenuResource($menu);
    }

    public function destroy(Request $request, Menu $menu): Response
    {
        $this->authorize('delete', $menu);

        if ($menu->image) {
            Storage::delete($menu->image);
        }

        $menu->delete();

        return response()->noContent();
    }
}
