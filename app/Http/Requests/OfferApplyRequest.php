<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferApplyRequest extends FormRequest
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
            'offer_id' => 'required|exists:company_offers,id',
            'curriculum' => 'required|file|mimes:pdf',
            'cover_letter' => 'required|file|mimes:pdf',
            'message' => 'nullable|string',
        ];
    }
}
