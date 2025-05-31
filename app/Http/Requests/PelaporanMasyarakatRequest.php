<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelaporanMasyarakatRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string|in:Laki-laki, Perempuan',
            'alamat' => 'required|string',
            'laporan' => 'required|string'
        ];
    }
}
