<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'schedule_id'                    => ['required', 'exists:schedules,id'],
            'passengers'                     => ['required', 'array', 'min:1', 'max:10'],
            'passengers.*.passenger_name'    => ['required', 'string', 'max:100'],
            'passengers.*.id_number'         => ['required', 'string', 'max:20'],
            'passengers.*.seat_number'       => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'schedule_id.required'                 => 'Jadwal wajib dipilih.',
            'schedule_id.exists'                   => 'Jadwal tidak ditemukan.',
            'passengers.required'                  => 'Data penumpang wajib diisi.',
            'passengers.min'                       => 'Minimal 1 penumpang.',
            'passengers.max'                       => 'Maksimal 10 penumpang.',
            'passengers.*.passenger_name.required' => 'Nama penumpang wajib diisi.',
            'passengers.*.id_number.required'      => 'Nomor identitas wajib diisi.',
            'passengers.*.seat_number.required'    => 'Nomor kursi wajib dipilih.',
            'passengers.*.seat_number.integer'     => 'Nomor kursi tidak valid.',
        ];
    }
}
