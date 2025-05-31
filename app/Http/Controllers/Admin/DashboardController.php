<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SuratIjinKegiatanService;
use Inertia\Inertia;
use App\Http\Requests\SuratIjinKegiatan;
use App\Services\PelaporanMasyarakatService;

class DashboardController extends Controller
{

    protected $suratIjinKegiatanService;
    protected $pelaporanMasyarakatService;
    public function __construct(SuratIjinKegiatanService $suratIjinKegiatanService, PelaporanMasyarakatService $pelaporanMasyarakatService)
    {
        $this->suratIjinKegiatanService = $suratIjinKegiatanService;
        $this->pelaporanMasyarakatService = $pelaporanMasyarakatService;
    }
    public function index()
    {
        return Inertia::render('DashboardAdmin/Index');
    }

    public function layananUmum()
    {
        $dataSuratIjinKegiatan = $this->suratIjinKegiatanService->getAllSuratIjinKegiatan();
        $dataPelaporanMasyarakat = $this->pelaporanMasyarakatService->getAllPelaporanMasyarakat();
        return Inertia::render('DashboardAdmin/LayananUmum', [
            'dataSuratIjinKegiatan' => $dataSuratIjinKegiatan,
            'dataPelaporanMasyarakat' => $dataPelaporanMasyarakat
        ]);
    }

    public function updateSuratIjinKegiatan(string $id)
    {
        try {
            $SuratIjinKegiatanByIdUpdate = $this->suratIjinKegiatanService->getSuratIjinKegiatanById($id);
            return Inertia::render('DashboardAdmin/SuratIjinKegiatan/Update', [
                'SuratIjinKegiatanByIdUpdate' => $SuratIjinKegiatanByIdUpdate
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
