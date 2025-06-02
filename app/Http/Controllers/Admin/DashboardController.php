<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SuratIjinKegiatanService;
use Inertia\Inertia;
use App\Services\PelaporanMasyarakatService;
use App\Services\BantuanSosialService;
use App\Models\SuratIjinKegiatan;
use App\Models\PelaporanMasyarakat;
use App\Models\BantuanSosial;
use App\Models\User;

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

        $daysInMonth = now()->daysInMonth;
        $labels = collect(range(1, $daysInMonth))->map(fn($day) => str_pad($day, 2, '0', STR_PAD_LEFT));

        $surat = SuratIjinKegiatan::getDailyCountsThisMonth();
        $pelaporan = PelaporanMasyarakat::getDailyCountsThisMonth();
        $bantuan = BantuanSosial::getDailyCountsThisMonth();

        $suratData = $labels->map(fn($day) => $surat[(int)$day] ?? 0);
        $pelaporanData = $labels->map(fn($day) => $pelaporan[(int)$day] ?? 0);
        $bantuanData = $labels->map(fn($day) => $bantuan[(int)$day] ?? 0);


        return Inertia::render('DashboardAdmin/Index', [
            'totalSuratIjinKegiatan' => SuratIjinKegiatan::getTotalSuratIjinKegiatan(),
            'totalPelaporanMasyarakat' => PelaporanMasyarakat::getTotalPelaporanMasyarakat(),
            'totalBantuanSosial' => BantuanSosial::getTotalBantuanSosial(),
            'totalRoleUser' => User::getTotalRoleUser(),
            'labels' => $labels,
            'suratData' => $suratData,
            'pelaporanData' => $pelaporanData,
            'bantuanData' => $bantuanData,
        ]);
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
