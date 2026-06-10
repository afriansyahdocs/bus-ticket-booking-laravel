<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusRequest extends FormRequest
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
            'name'        => ['required', 'string', 'max:100'],
            'bus_number'  => ['required', 'string', 'unique:buses,bus_number,' . $this->route('bus')->id],
            'bus_class'   => ['required', 'in:economy,executive,sleeper'],
            'total_seats' => ['required', 'integer', 'min:1', 'max:60'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Nama bus wajib diisi.',
            'bus_number.required'  => 'Nomor bus wajib diisi.',
            'bus_number.unique'    => 'Nomor bus sudah digunakan.',
            'bus_class.required'   => 'Kelas bus wajib dipilih.',
            'total_seats.required' => 'Jumlah kursi wajib diisi.',
        ];
    }
}
