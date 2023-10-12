<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::all();

            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        } catch(Exception $error) {
            return response()->json([
                'success' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),  [
                'name' => ['required', 'string']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan dengan validasi',
                    'error' => $validator->errors()
                ]);
            }

            $validated = $validator->validated();

            Category::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dibuat'
            ]);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } catch(Exception $error) {
            return response()->json([
                'success' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            $validator = Validator::make($request->all(),  [
                'name' => ['required', 'string']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan dengan validasi',
                    'error' => $validator->errors()
                ]);
            }

            $validated = $validator->validated();

            $category->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diedit'
            ]);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus'
            ]);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }
}
