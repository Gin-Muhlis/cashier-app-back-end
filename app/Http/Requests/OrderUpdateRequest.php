<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'order_date' => ['required', 'date'],
            'start' => ['required', 'date_format:H:i:s'],
            'end' => ['required', 'date_format:H:i:s'],
            'order_name' => ['required', 'max:255', 'string'],
            'customer_amount' => ['required', 'numeric'],
            'table_id' => ['required', 'exists:tables,id'],
        ];
    }
}
