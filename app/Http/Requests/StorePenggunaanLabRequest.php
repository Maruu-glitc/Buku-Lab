<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePenggunaanLabRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pengunjung_id' => ['required', 'exists:pengunjungs,id'],
            'lab_id' => ['required', 'exists:labs,id'],
            'keperluan_id' => ['required', 'exists:keperluans,id'],
            // 'nama' => ['required', 'string', 'max:255'],
            'tipe_pengguna' => ['required', 'string', 'max:255'],
            'keperluan' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'jam_masuk' => ['required', 'date_format:H:i'],
            'jam_keluar' => ['required', 'date_format:H:i', 'after:jam_masuk'],
        ];
    }
}
