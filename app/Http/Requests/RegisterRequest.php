<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|regex:/^[\pL\s\-\']+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-\']+$/u',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^\+?[0-9]{1,15}$/',
            'password' => 'required|min:6'
        ];
    }
}
