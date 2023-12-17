<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest {
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
			'name' => ['required', 'max:255', 'string'],
			'address' => ['required', 'max:255', 'string'],
			'email' => ['required', 'unique:users,email', 'email'],
			'phone' => ['required', 'max:255', 'string'],
			'password' => ['required'],
			// 'role_id' => ['required', 'exists:roles,id'],
		];
	}
}
