<?php

namespace App\Repositories\Interfaces;

interface BantuanSosialRepositoryInterface
{
    public function getAllBantuanSosial();
    public function getBantuanSosialById($id);
    public function createBantuanSosial(array $data);
    public function updateBantuanSosial($id, array $data);
    public function deleteBantuanSosial($id);
}
