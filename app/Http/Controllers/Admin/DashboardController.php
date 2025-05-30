<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SuratIjinKegiatanService;
use Inertia\Inertia;

class DashboardController extends Controller
{

    protected $suratIjinKegiatanService;
    public function __construct(SuratIjinKegiatanService $suratIjinKegiatanService)
    {
        $this->suratIjinKegiatanService = $suratIjinKegiatanService;
    }
    public function index()
    {
        return Inertia::render('DashboardAdmin/Index');
    }

    public function layananUmum()
    {
        $dataSuratIjinKegiatan = $this->suratIjinKegiatanService->getAllSuratIjinKegiatan();
        return Inertia::render('DashboardAdmin/LayananUmum', [
            'dataSuratIjinKegiatan' => $dataSuratIjinKegiatan
        ]);
    }
    // bagian show data by id surat ijin kegiatan
    public function showSuratIjinKegiatan($id)
    {
        $dataSuratIjinKegiatanById = $this->suratIjinKegiatanService->getSuratIjinKegiatanById($id);
        return Inertia::render('DashboardAdmin/SuratIjinKegiatan/Show', [
            'dataSuratIjinKegiatanById' => $dataSuratIjinKegiatanById
        ]);
    }
    // bagian destroy data by id surat ijin kegiatan
    public function deleteSuratIjinKegiatan($id)
    {
        $this->suratIjinKegiatanService->destroySuratIjinKegiatan($id);
        return redirect()->back()->with('success', 'Surat Ijin Kegiatan berhasil dihapus.');
    }
}
