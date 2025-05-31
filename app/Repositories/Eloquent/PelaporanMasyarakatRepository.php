<?php


namespace App\Repositories\Eloquent;

use App\Models\PelaporanMasyarakat;
use App\Repositories\Interfaces\PelaporanMasyarakatRepositoryInterface;

class PelaporanMasyarakatRepository implements PelaporanMasyarakatRepositoryInterface
{
    public function getAllPelaporanMasyarakat()
    {
        return PelaporanMasyarakat::with(['user'])->paginate(3);
    }

    public function getPelaporanMasyarakatById($id)
    {
        return PelaporanMasyarakat::with(['user'])->first($id);
    }

    public function createPelaporanMasyarakat(array $data)
    {
        return PelaporanMasyarakat::create($data);
    }

    public function updatePelaporanMasyarakat($id, array $data)
    {
        $pelaporanMasyarakat = PelaporanMasyarakat::findOrFail($id);
        $pelaporanMasyarakat->update($data);
        return $pelaporanMasyarakat;
    }

    public function deletePelaporanMasyarakat($id)
    {
        $pelaporanMasyarakat = PelaporanMasyarakat::findOrFail($id);
        $pelaporanMasyarakat->delete();
        return $pelaporanMasyarakat;
    }
}
