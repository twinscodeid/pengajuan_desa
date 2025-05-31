<?php

namespace App\Repositories\Eloquent;

use App\Models\SuratIjinKegiatan;
use App\Repositories\Interfaces\SuratIjinKegiatanRepositoryInterface;

class SuratIjinKegiatanRepository implements SuratIjinKegiatanRepositoryInterface
{
    public function getAllSuratIjinKegiatan()
    {
        return SuratIjinKegiatan::with(['user', 'suratPengantarRTRW'])->paginate(3);
    }

    public function getSuratIjinKegiatanById($id)
    {
        return SuratIjinKegiatan::with(['user', 'suratPengantarRTRW'])->findOrFail($id);
    }

    public function createSuratIjinKegiatan(array $data)
    {
        return SuratIjinKegiatan::create($data);
    }
    public function updateSuratIjinKegiatan($id, array $data)
    {
        $suratIjinKegiatan = SuratIjinKegiatan::findOrFail($id);
        $suratIjinKegiatan->update($data);
        return $suratIjinKegiatan;
    }
    public function deleteSuratIjinKegiatan($id)
    {
        $suratIjinKegiatan = SuratIjinKegiatan::findOrFail($id);
        $suratIjinKegiatan->delete();
        return $suratIjinKegiatan;
    }
}
