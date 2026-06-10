<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
            'bus_id'         => ['required', 'exists:buses,id'],
            'route_id'       => ['required', 'exists:routes,id'],
            'departure_time' => ['required', 'date'],
            'arrival_time'   => ['required', 'date', 'after:departure_time'],
            'price'          => ['required', 'numeric', 'min:1000'],
            'status'         => ['required', 'in:active,cancelled,completed'],
        ];
    }

    public function messages(): array
    {
        return [
            'bus_id.required'         => 'Bus wajib dipilih.',
            'route_id.required'       => 'Rute wajib dipilih.',
            'departure_time.required' => 'Waktu berangkat wajib diisi.',
            'arrival_time.required'   => 'Waktu tiba wajib diisi.',
            'arrival_time.after'      => 'Waktu tiba harus setelah waktu berangkat.',
            'price.required'          => 'Harga wajib diisi.',
            'status.required'         => 'Status wajib dipilih.',
        ];
    }
}
