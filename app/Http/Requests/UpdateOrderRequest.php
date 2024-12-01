<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address_id' => 'required',
            'comment' => 'nullable|string|max:225',
            'delivery_method_id' => 'required|numeric',
            'payment_type_id' => 'required|numeric',
            'products' => 'required',
            'summ' => 'required|numeric'
        ];
    }
}
