<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportProductRequest;
use App\Http\Resources\EntrustedProductResource;
use App\Imports\ProductImport;
use App\Models\EntrustedProduct;
use App\Http\Requests\StoreEntrustedProductRequest;
use App\Http\Requests\UpdateEntrustedProductRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class EntrustedProductController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        try {

            $entrusted_products = EntrustedProduct::all();

            $data = EntrustedProductResource::collection( $entrusted_products );

            return response()->json( [
                'success' => true,
                'data' => $data
            ] );

        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Terjadi kesalahan dengan sistem',
                'error' => $e->getMessage()
            ] );
        }
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( StoreEntrustedProductRequest $request ) {
        try {
            $validated = $request->validated();

            DB::beginTransaction();

            EntrustedProduct::create( $validated );

            DB::commit();

            return response()->json( [
                'success' => true,
                'message' => 'Data produk titipan berhasil ditambahkan'
            ] );

        } catch ( Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => 'Terjadi kesalahan dengan sistem',
                'error' => $e->getMessage()
            ] );
        }
    }

    /**
    * Display the specified resource.
    */

    public function show( EntrustedProduct $entrustedProduct ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( UpdateEntrustedProductRequest $request, EntrustedProduct $entrustedProduct ) {
        try {
            $validated = $request->validated();

            DB::beginTransaction();

            $entrustedProduct->update( $validated );

            DB::commit();

            return response()->json( [
                'success' => true,
                'message' => 'Data produk titipan berhasil diperbarui'
            ] );

        } catch ( Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => 'Terjadi kesalahan dengan sistem',
                'error' => $e->getMessage()
            ] );
        }
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( EntrustedProduct $entrustedProduct ) {
        try {

            DB::beginTransaction();

            $entrustedProduct->delete();

            DB::commit();

            return response()->json( [
                'success' => true,
                'message' => 'Data produk titipan berhasil dihapus'
            ] );

        } catch ( Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => 'Terjadi kesalahan dengan sistem',
                'error' => $e->getMessage()
            ] );
        }
    }

    public function exportPdf() {
        try {

            $data = EntrustedProduct::all();

            $pdf = Pdf::loadView( 'pdf.entrustedProduct', compact( 'data' ) );
            return $pdf->download( 'Produk titipan.pdf' );

        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Terjadi kesalahan dengan sistem',
                'error' => $e->getMessage()
            ] );
        }
    }

    public function importExcel( ImportProductRequest $request ) {
        try {
            $validated = $request->validated();

            Excel::import( new ProductImport, $validated[ 'file' ] );

            return response()->json( [
                'message' => 'Data berhasil diimport'
            ] );

        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Terjadi kesalahan dengan sistem',
                'error' => $e->getMessage()
            ] );
        }
    }
}
