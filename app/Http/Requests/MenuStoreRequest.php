<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
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
            'menu_name' => ['required', 'max:255', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['required', 'max:255', 'string'],
            'type_id' => ['required', 'exists:types,id'],
            'stock_id' => ['required', 'exists:stocks,id'],
        ];
    }
}
