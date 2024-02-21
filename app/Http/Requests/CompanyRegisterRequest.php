<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRegisterRequest extends FormRequest
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
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'company_email' => 'required|string|email|max:255|unique:company',
            'phone' => 'required|string|regex:/^(\+\d{1,3})?\d{7,14}$/',
            'company_phone' => 'required|string|regex:/^(\+\d{1,3})?\d{7,14}$/',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'website' => 'nullable|url',
        ];
    }
}
