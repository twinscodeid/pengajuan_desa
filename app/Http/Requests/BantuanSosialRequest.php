<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BantuanSosialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'nik' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'status_perkawinan' => 'required|string',
            'agama' =>  'required|string',
            'kewarganegaraan' => 'required|string',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string',
            'no_hp' => 'required|string',
            'image_pengantar_rt_rw' => 'required|array|size:2',
            'image_pengantar_rt_rw.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'status_perkawinan.required' => 'Status perkawinan wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'image_pengantar_rt_rw.required' => 'Surat pengantar dari RT dan RW wajib diunggah.',
            'image_pengantar_rt_rw.array' => 'Format surat pengantar tidak valid.',
            'image_pengantar_rt_rw.size' => 'Harus mengunggah tepat 2 surat pengantar (RT dan RW).',
            'image_pengantar_rt_rw.*.image' => 'File surat pengantar harus berupa gambar.',
            'image_pengantar_rt_rw.*.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'image_pengantar_rt_rw.*.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
