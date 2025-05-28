<?php

namespace App\Repositories\Interfaces;


interface SuratIjinKegiatanRepositoryInterface
{
    public function getAllSuratIjinKegiatan();

    public function getSuratIjinKegiatanById($id);

    public function createSuratIjinKegiatan(array $data);

    public function updateSuratIjinKegiatan($id, array $data);

    public function deleteSuratIjinKegiatan($id);
}
