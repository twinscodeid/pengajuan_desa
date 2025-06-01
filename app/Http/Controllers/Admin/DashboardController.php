<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SuratIjinKegiatanService;
use Inertia\Inertia;
use App\Http\Requests\SuratIjinKegiatan;
use App\Services\PelaporanMasyarakatService;
use App\Services\BantuanSosialService;

class DashboardController extends Controller
{

    protected $suratIjinKegiatanService;
    protected $pelaporanMasyarakatService;
    protected $bantuanSosialService;
    public function __construct(SuratIjinKegiatanService $suratIjinKegiatanService, PelaporanMasyarakatService $pelaporanMasyarakatService, BantuanSosialService $bantuanSosialService)
    {
        $this->suratIjinKegiatanService = $suratIjinKegiatanService;
        $this->pelaporanMasyarakatService = $pelaporanMasyarakatService;
        $this->bantuanSosialService = $bantuanSosialService;
    }
    public function index()
    {
        return Inertia::render('DashboardAdmin/Index');
    }

    public function layananUmum()
    {
        $dataSuratIjinKegiatan = $this->suratIjinKegiatanService->getAllSuratIjinKegiatan();
        $dataPelaporanMasyarakat = $this->pelaporanMasyarakatService->getAllPelaporanMasyarakat();
        $dataBantuanSosial = $this->bantuanSosialService->getAllBantuanSosial();
        return Inertia::render('DashboardAdmin/LayananUmum', [
            'dataSuratIjinKegiatan' => $dataSuratIjinKegiatan,
            'dataPelaporanMasyarakat' => $dataPelaporanMasyarakat,
            'dataBantuanSosial' => $dataBantuanSosial
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
    public function updateBantuanSosial($id)
    {
        try {
            $BantuanSosialByIdUpdate = $this->bantuanSosialService->getBantuanSosialById($id);
            return Inertia::render('DashboardAdmin/BantuanSosial/Update', [
                'BantuanSosialByIdUpdate' => $BantuanSosialByIdUpdate
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
