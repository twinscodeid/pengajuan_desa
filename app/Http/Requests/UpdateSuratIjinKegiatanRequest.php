<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSuratIjinKegiatanRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'tempat_kegiatan' => 'required|string',
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tujuan_kegiatan' => 'required|string',
            'image_pengantar_rt_rw' => 'nullable|array',
            'image_pengantar_rt_rw.*' => 'file|mimes:jpg,jpeg,png|max:2048', // jika ada file, pastikan valid
        ];
    }
}
