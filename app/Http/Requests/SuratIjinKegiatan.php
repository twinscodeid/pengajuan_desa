<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratIjinKegiatan extends FormRequest
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
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'tempat_kegiatan' => 'required|string',
            'no_hp' => 'required|string|max:12',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tujuan_kegiatan' => 'required|string',
        ];
    }
}
