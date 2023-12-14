<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;

class TypeMenusController extends Controller
{
    public function index(Request $request, Type $type): MenuCollection
    {
        $this->authorize('view', $type);

        $search = $request->get('search', '');

        $menus = $type
            ->menus()
            ->search($search)
            ->latest()
            ->paginate();

        return new MenuCollection($menus);
    }

    public function store(Request $request, Type $type): MenuResource
    {
        $this->authorize('create', Menu::class);

        $validated = $request->validate([
            'menu_name' => ['required', 'max:255', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['required', 'max:255', 'string'],
            'stock_id' => ['required', 'exists:stocks,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $menu = $type->menus()->create($validated);

        return new MenuResource($menu);
    }
}
