<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activity' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|numeric',
            'city' => 'required|string|max:255',
            'company_phone' => 'required|string|regex:/^(\+\d{1,3})?\d{7,14}$/',
            'company_email' => 'required|email|max:255',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'banner' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ];
    }
}
