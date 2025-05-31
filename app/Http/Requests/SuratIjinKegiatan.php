<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

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
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'tempat_kegiatan' => 'required|string',
            'no_hp' => 'required|string|max:12',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tujuan_kegiatan' => 'required|string',
            'image_pengantar_rt_rw' => 'required|array|size:2',
            'image_pengantar_rt_rw.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong.',
            'alamat.required' => 'Alamat wajib diisi.',
            'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
            'tanggal_kegiatan.date' => 'Format tanggal kegiatan tidak valid.',
            'tempat_kegiatan.required' => 'Tempat kegiatan tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP maksimal 12 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'tujuan_kegiatan.required' => 'Tujuan kegiatan wajib diisi.',
            'image_pengantar_rt_rw.required' => 'Surat pengantar dari RT dan RW wajib diunggah.',
            'image_pengantar_rt_rw.array' => 'Format surat pengantar tidak valid.',
            'image_pengantar_rt_rw.size' => 'Harus mengunggah tepat 2 surat pengantar (RT dan RW).',
            'image_pengantar_rt_rw.*.image' => 'File surat pengantar harus berupa gambar.',
            'image_pengantar_rt_rw.*.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'image_pengantar_rt_rw.*.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
