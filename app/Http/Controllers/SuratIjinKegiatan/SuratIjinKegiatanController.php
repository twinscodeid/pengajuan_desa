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
}
