<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'user_id' => 'required',
            'product_id' => 'required',
            'plan_id' => 'required',
            'license_key' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'is_active' => 'required'
        ];
    }

    public function messages(): array {
        return [
            'user_id.required' => 'Kolom pengguna wajib diisi.',
            'product_id.required' => 'Kolom nama produk wajib diisi.',
            'plan_id.required' => 'Kolom jenis langganan wajib diisi.',
            'license_key.required' => 'Kolom lisensi wajib diisi.',
            'start_date.required' => 'Kolom tanggal mulai aktif wajib diisi.',
            'end_date.required' => 'Kolom tanggal kadaluwarsa wajib diisi.',
            'is_active.required' => 'Kolom status langganan wajib diisi.'
        ];
    }
}
