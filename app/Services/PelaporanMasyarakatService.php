<?php

namespace App\Services;

use App\Repositories\Interfaces\PelaporanMasyarakatRepositoryInterface;

class PelaporanMasyarakatService
{
    protected $pelaporanMasyarakatRepository;
    public function __construct(PelaporanMasyarakatRepositoryInterface $pelaporanMasyarakatRepositoryInterface)
    {
        $this->pelaporanMasyarakatRepository = $pelaporanMasyarakatRepositoryInterface;
    }

    public function getAllPelaporanMasyarakat()
    {
        $dataPelaporanMasyarakat = $this->pelaporanMasyarakatRepository->getAllPelaporanMasyarakat();
        return $dataPelaporanMasyarakat;
    }

    public function getPelaporanMasyarakatById($id)
    {
        return $this->pelaporanMasyarakatRepository->getPelaporanMasyarakatById($id);
    }

    public function storePelaporanMasyarakat(array $data)
    {
        $dataPelaporanMasyarakat = $this->pelaporanMasyarakatRepository->createPelaporanMasyarakat([
            'user_id' => $data['user_id'],
            'nama' => $data['nama'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'laporan' => $data['laporan']
        ]);
        return $dataPelaporanMasyarakat;
    }

    // public function updatePelaporanMasyarakat($id, array $data)
    // {
    //     $dataPelaporanMasyarakat = $this->pelaporanMasyarakatRepository->updatePelaporanMasyarakat($id, [
    //         'user_id' => $data['user_id'],
    //         'nama' => $data['nama'],
    //         'jenis_kelamin' => $data['jenis_kelamin'],
    //         'alamat' => $data['alamat'],
    //         'laporan' => $data['laporan']
    //     ]);
    //     return $dataPelaporanMasyarakat;
    // }

    public function destroyPelaporanMasyarakat($id)
    {
        return $this->pelaporanMasyarakatRepository->deletePelaporanMasyarakat($id);
    }
}
