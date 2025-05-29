<?php

namespace App\Http\Controllers\SuratIjinKegiatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuratIjinKegiatan;
use Illuminate\Http\Request;
use App\Services\SuratIjinKegiatanService;
use Inertia\Inertia;

class SuratIjinKegiatanController extends Controller
{
    protected $suratIjinKegiatanService;
    public function __construct(SuratIjinKegiatanService $suratIjinKegiatanService)
    {
        $this->suratIjinKegiatanService = $suratIjinKegiatanService;
    }

    // index
    public function index(Request $request)
    {
        try {
            $suratIjinKegiatan = $this->suratIjinKegiatanService->getAllSuratIjinKegiatan();
            return Inertia::render('SuratIjinKegiatan/Index', [
                'suratIjinKegiatan' => $suratIjinKegiatan,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    // store
    public function store(SuratIjinKegiatan $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $this->suratIjinKegiatanService->createSuratIjinKegiatan($data);
            return redirect()->route('surat-ijin-kegiatan.index')->with('success', 'Surat Ijin Kegiatan berhasil dibuat.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    // show
    public function show(string $id)
    {
        try {
            $SuratIjinKegiatanById = $this->suratIjinKegiatanService->getSuratIjinKegiatanById($id);
            return Inertia::render('SuratIjinKegiatan/Show', [
                'suratIjinKegiatanById' => $SuratIjinKegiatanById,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    // update surat ijin kegiatan
    public function update(string $id, SuratIjinKegiatan $request)
    {
        try {
            $data = $request->validated();
            // ambil data surat ijin kegiatan bedasarkan idnya
            $suratIjinkegiatanUser = $this->suratIjinKegiatanService->getSuratIjinKegiatanById($id);
            $data['user_id'] = $suratIjinkegiatanUser->user_id;
            $this->suratIjinKegiatanService->updateSuratIjinKegiatan($id, $data);
            return redirect()->back()->with('success', 'Surat Ijin Kegiatan berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $this->suratIjinKegiatanService->destroySuratIjinKegiatan($id);
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function generatePdf($id)
    {
        try {
            $SuratIjinKegiatanById = $this->suratIjinKegiatanService->getSuratIjinKegiatanById($id);
            return $this->suratIjinKegiatanService->generataPdfSuratIjinKegiatan($SuratIjinKegiatanById);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function sendEmail($id)
    {
        try {
            $SuratIjinKegiatanById = $this->suratIjinKegiatanService->getSuratIjinKegiatanById($id);
            return $this->suratIjinKegiatanService->sendEmailSuratIjinKegiatan($SuratIjinKegiatanById);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
