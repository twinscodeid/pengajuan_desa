<?php

namespace App\Repositories\Eloquent;

use App\Models\BantuanSosial;
use App\Repositories\Interfaces\BantuanSosialRepositoryInterface;

class BantuanSosialRepository implements BantuanSosialRepositoryInterface
{
    public function getAllBantuanSosial()
    {
        return BantuanSosial::with(['user', 'imageSuratPengantarRTRW'])->paginate(10);
    }
    public function getBantuanSosialById($id)
    {
        return BantuanSosial::with(['user', 'imageSuratPengantarRTRW'])->findOrFail($id);
    }

    public function createBantuanSosial(array $data)
    {
        return BantuanSosial::create($data);
    }
    public function updateBantuanSosial($id, array $data)
    {
        $bantuanSosial = BantuanSosial::findOrFail($id);
        $bantuanSosial->update($data);
        return $bantuanSosial;
    }
    public function deleteBantuanSosial($id)
    {
        $bantuanSosial = BantuanSosial::findOrFail($id);
        $bantuanSosial->delete();
        return $bantuanSosial;
    }
}
