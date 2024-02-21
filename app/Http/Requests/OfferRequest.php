<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'contract_type' => 'required|string|in:CDI,CDD,Stage,Alternance,Freelance',
            'annual_salary_minumun' => 'required|numeric',
            'annual_salary_maximun' => 'required|numeric',
            'advantages' => 'nullable|string',
            'city' => 'required|string|max:255',
            'location' => 'required|string|in:Télétravail,Présentiel,Mixte',
            'experience' => 'nullable|string',
            'languages_required' => 'nullable|string',
        ];
    }
}
