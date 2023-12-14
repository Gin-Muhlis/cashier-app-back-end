<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'total_payment' => ['required', 'numeric'],
            'payment_method' => ['required', 'in:cash,paypal,card'],
            'description' => ['required', 'string', 'max:1000'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
