<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionDetailUpdateRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 */
	public function rules(): array {
		return [
			'menu_id' => ['required', 'exists:menus,id'],
			'quantity' => ['required', 'numeric'],
			'sub_total' => ['required', 'numeric'],
			'unit_price' => ['required', 'numeric'],
			'transaction_id' => ['required', 'exists:transactions,id'],
		];
	}
}
