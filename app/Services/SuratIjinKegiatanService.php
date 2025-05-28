<?php

namespace App\Services;

use App\Models\SuratIjinKegiatan;
use App\Repositories\Interfaces\SuratIjinKegiatanRepositoryInterface;

class SuratIjinKegiatanService
{
    protected $suratIjinKegiatanRepository;

    public function __construct(SuratIjinKegiatanRepositoryInterface $suratIjinKegiatanRepository)
    {
        $this->suratIjinKegiatanRepository = $suratIjinKegiatanRepository;
    }

    public function getAllSuratIjinKegiatan()
    {
        return $this->suratIjinKegiatanRepository->getAllSuratIjinKegiatan();
    }

    public function createSuratIjinKegiatan(array $data)
    {
        $createdSuratIjinKegiatan = $this->suratIjinKegiatanRepository->createSuratIjinKegiatan([
            'user_id' => $data['user_id'],
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'tanggal_kegiatan' => $data['tanggal_kegiatan'],
            'tempat_kegiatan' => $data['tempat_kegiatan'],
            'no_hp' => $data['no_hp'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tujuan_kegiatan' => $data['tujuan_kegiatan'],
        ]);

        return $createdSuratIjinKegiatan;
    }
}
