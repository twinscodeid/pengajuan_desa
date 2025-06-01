<?php

namespace App\Services;

use App\Repositories\Interfaces\BantuanSosialRepositoryInterface;
use App\Models\ImageSuratPengantarRTRW;
use Illuminate\Support\Facades\Storage;

class BantuanSosialService
{
    protected $bantuanSosialRepository;

    public function __construct(BantuanSosialRepositoryInterface $bantuanSosialRepository)
    {
        $this->bantuanSosialRepository = $bantuanSosialRepository;
    }

    public function getAllBantuanSosial()
    {
        return $this->bantuanSosialRepository->getAllBantuanSosial();
    }

    public function getBantuanSosialById($id)
    {
        return $this->bantuanSosialRepository->getBantuanSosialById($id);
    }

    public function createBantuanSosial(array $data)
    {
        $dataBantuanSosial = $this->bantuanSosialRepository->createBantuanSosial([
            'user_id' => $data['user_id'],
            'nama' => $data['nama'],
            'nik' => $data['nik'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'status_perkawinan' => $data['status_perkawinan'],
            'agama' => $data['agama'],
            'kewarganegaraan' => $data['kewarganegaraan'],
            'alamat' => $data['alamat'],
            'pekerjaan' => $data['pekerjaan'],
            'no_hp' => $data['no_hp']
        ]);

        if (isset($data['image_pengantar_rt_rw']) && !empty($data['image_pengantar_rt_rw'])) {
            $images = $data['image_pengantar_rt_rw'];

            // Jika form mengirim dengan name="image_pengantar_rt_rw[]"
            if (!is_array($images)) {
                $images = [$images];
            }

            // Filter hanya file yang valid
            $validImages = array_filter($images, function ($image) {
                return $image && $image->isValid();
            });

            if (count($validImages) > 2) {
                throw new \Exception('Maksimal 2 surat pengantar dari RT dan RW');
            }

            foreach ($validImages as $image) {
                $imagePath = $image->store('surat_pengantar_rt_rw', 'local');
                ImageSuratPengantarRTRW::create([
                    'bantuan_sosial_id' => $dataBantuanSosial->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return $dataBantuanSosial;
    }

    public function updateBantuanSosial($id, array $data)
    {
        $dataBantuanSosial = $this->bantuanSosialRepository->updateBantuanSosial($id, [
            'user_id' => $data['user_id'],
            'nama' => $data['nama'],
            'nik' => $data['nik'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'status_perkawinan' => $data['status_perkawinan'],
            'agama' => $data['agama'],
            'kewarganegaraan' => $data['kewarganegaraan'],
            'alamat' => $data['alamat'],
            'pekerjaan' => $data['pekerjaan'],
            'no_hp' => $data['no_hp']
        ]);

        // if (isset($data['image_pengantar_rt_rw']) && is_array($data['image_pengantar_rt_rw']) && count($data['image_pengantar_rt_rw']) > 0) {
        //     $pengantar = ImageSuratPengantarRTRW::where('bantuan_sosial_id', $id)->get();
        //     if ($pengantar) {
        //         foreach ($pengantar->image_path as $imagePath) {
        //             Storage::disk('local')->delete($imagePath->image_path);
        //             $imagePath->delete();
        //         }
        //     }
        // }

        // foreach ($data['image_pengantar_rt_rw'] as $image) {
        //     ImageSuratPengantarRTRW::create([
        //         'bantuan_sosial_id' => $dataBantuanSosial->id,
        //         'image_path' => Storage::disk('local')->putFile('surat_pengantar_rt_rw', $image),
        //     ]);
        // }

        return $dataBantuanSosial;
    }

    public function destroyBantuanSosial($id)
    {
        $pengantar = ImageSuratPengantarRTRW::where('bantuan_sosial_id', $id)->get();
        if ($pengantar) {
            foreach ($pengantar as $imagePath) {
                Storage::disk('local')->delete($imagePath->image_path);
                $imagePath->delete();
            }
        }
        return $this->bantuanSosialRepository->deleteBantuanSosial($id);
    }
}
