<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemeriksaanUpdateRequest extends FormRequest
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
            'ttd' => ['required', 'max:255', 'string'],
            'catatan' => ['required', 'max:255', 'string'],
            'pemeliharaan2_id' => ['required', 'exists:pemeliharaan2s,id'],
        ];
    }
}
