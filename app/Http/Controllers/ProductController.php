<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();

            return response()->json([
                'success' => true,
                'data' => $products
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

            Product::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dibuat'
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
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

            $product->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diedit'
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
    public function destroy(Product $product)
    {
        try {

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus'
            ]);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }
}
