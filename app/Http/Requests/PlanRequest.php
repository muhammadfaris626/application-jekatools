<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'product_id' => 'required',
            'name' => 'required',
            'duration_months' => 'required',
            'price' => 'required'
        ];
    }

    public function messages(): array {
        return [
            'product_id.required' => 'Kolom nama produk wajib diisi.',
            'name.required' => 'Kolom nama jenis langganan wajib diisi.',
            'duration_months.required' => 'Kolom durasi langganan wajib diisi.',
            'price.required' => 'Kolom harga wajib diisi.'
        ];
    }
}
