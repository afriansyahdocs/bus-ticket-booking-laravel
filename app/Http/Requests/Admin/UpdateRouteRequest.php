<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRouteRequest extends FormRequest
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
            'origin'             => ['required', 'string', 'max:100'],
            'destination'        => ['required', 'string', 'max:100'],
            'distance_km'        => ['nullable', 'numeric', 'min:0'],
            'estimated_duration' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'origin.required'             => 'Kota asal wajib diisi.',
            'destination.required'        => 'Kota tujuan wajib diisi.',
            'estimated_duration.required' => 'Estimasi durasi wajib diisi.',
        ];
    }
}
