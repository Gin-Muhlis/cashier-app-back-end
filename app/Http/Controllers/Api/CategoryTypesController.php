<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\TypeResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeCollection;

class CategoryTypesController extends Controller
{
    public function index(Request $request, Category $category): TypeCollection
    {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $types = $category
            ->types()
            ->search($search)
            ->latest()
            ->paginate();

        return new TypeCollection($types);
    }

    public function store(Request $request, Category $category): TypeResource
    {
        $this->authorize('create', Type::class);

        $validated = $request->validate([
            'type_name' => ['required', 'max:255', 'string'],
        ]);

        $type = $category->types()->create($validated);

        return new TypeResource($type);
    }
}
