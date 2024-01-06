<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest {
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
			'total_payment' => ['required', 'numeric'],
			'payment_method_id' => ['required', 'exists:payment_methods,id'],
			'description' => ['required', 'string', 'max:1000'],
			// 'user_id' => ['required', 'exists:users,id'],
			'menus' => ['required', 'array'],
		];
	}
}
