<?php

namespace App\Repositories\Interfaces;

interface PelaporanMasyarakatRepositoryInterface
{
    public function getAllPelaporanMasyarakat();

    public function getPelaporanMasyarakatById($id);

    public function createPelaporanMasyarakat(array $data);

    public function updatePelaporanMasyarakat($id, array $data);

    public function deletePelaporanMasyarakat($id);
}
