<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEntrustedProductRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    */

    public function authorize(): bool {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */

    public function rules(): array {
        return [
            'product_name' => [ 'required', 'string' ],
            'supplier_name' => [ 'required', 'string' ],
            'purchase_price' => [ 'required', 'numeric' ],
            'sell_price' => [ 'required', 'numeric' ],
            'stock' => [ 'required', 'numeric' ],
            'description' => [ 'required', 'string' ],
        ];
    }

    public function messages(): array {
        return [
            'product_name.required' => 'Nama produk wajib diisi',
            'product_name.string' => 'Nama produk tidak valid',
            'supplier_name.required' => 'Nama pemasok wajib diisi',
            'supplier_name.string' => 'Nama pemasok tidak valid',
            'purchase_price.required' => 'Harga beli wajib diisi',
            'purchase_price.numeric' => 'Harga beli tidak valid',
            'sell_price.required' => 'Harga jual wajib diisi',
            'sell_price.numeric' => 'Harga jual tidak valid',
            'stock.required' => 'Stok wajib diisi',
            'stock.numeric' => 'Stok tidak valid',
            'description.required' => 'Deskripsi wajib diisi',
            'description.string' => 'Deskripsi tidak valid',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'message' => 'Validasi gagal',
            'error' => $validator->errors(),
        ], 422));
    }
}
