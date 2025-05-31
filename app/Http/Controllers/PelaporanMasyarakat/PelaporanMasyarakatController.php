<?php

namespace App\Http\Controllers\PelaporanMasyarakat;

use App\Http\Controllers\Controller;
use App\Models\PelaporanMasyarakat;
use Illuminate\Http\Request;
use App\Services\PelaporanMasyarakatService;
use App\Http\Requests\PelaporanMasyarakatRequest;
use Inertia\Inertia;

class PelaporanMasyarakatController extends Controller
{
    protected $pelaporanMasyarakatService;

    public function __construct(PelaporanMasyarakat $pelaporanMasyarakatService)
    {
        $this->pelaporanMasyarakatService = $pelaporanMasyarakatService;
    }

    public function index()
    {
        $dataPelaporanMasyarakat = $this->pelaporanMasyarakatService->getAllPelaporanMasyarakat();
        return Inertia::render('PelaporanMasyarakat/PelaporanMasyarakat', [
            'dataPelaporanMasyarakat' => $dataPelaporanMasyarakat
        ]);
    }

    // bagian store
    public function store(PelaporanMasyarakatRequest $request)
    {
        try {
            $data = $request->validated();
            $idUser = auth()->user()->id;
            $data['user_id'] = $idUser;
            $dataPelaporanMasyarakat = $this->pelaporanMasyarakatService->storePelaporanMasyarakat($data);
            return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    // bagian update
    public function update($id, PelaporanMasyarakatRequest $request)
    {

        try {
            $data = $request->validated();
            $dataUserId = $this->pelaporanMasyarakatService->getPelaporanMasyarakatById($id);
            $data['user_id'] = $dataUserId->user_id;
            $this->pelaporanMasyarakatService->updatePelaporanMasyarakat($id, $data);
            return redirect()->back()->with('success', 'Laporan berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->pelaporanMasyarakatService->destroyPelaporanMasyarakat($id);
            return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
