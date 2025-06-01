<?php

namespace App\Http\Controllers\SuratIjinKegiatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuratIjinKegiatan;
use App\Http\Requests\UpdateSuratIjinKegiatanRequest;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use App\Services\SuratIjinKegiatanService;
use Inertia\Inertia;
use App\Mail\IjinKegiatan;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SuratIjinKegiatanNotification;
use Illuminate\Validation\ValidationException;

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

            // ambil data admin
            $admin = User::where('role', 'admin')->first();
            $admin->notify(new AdminNotification($admin));

            return redirect()->route('dashboard.index.user')->with('success', 'Surat Ijin Kegiatan berhasil dibuat.');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index.user')->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    // show
    public function show(string $id)
    {
        try {
            $dataSuratIjinKegiatanById = $this->suratIjinKegiatanService->getSuratIjinKegiatanById($id);
            return Inertia::render('DashboardAdmin/SuratIjinKegiatan/Show', [
                'dataSuratIjinKegiatanById' => $dataSuratIjinKegiatanById
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    // update surat ijin kegiatan
    public function update(string $id, UpdateSuratIjinKegiatanRequest $request)
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

    private function generatePdf($id)
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
            $this->generatePdf($id);
            // nama pdf
            $fileName = "surat_ijin_kegiatan_" . $SuratIjinKegiatanById->user->email . ".pdf";
            // ambil data pdf
            $dataPdfUser = Storage::disk('local')->path('pdf/' . $fileName);
            if (!file_exists($dataPdfUser)) {
                return redirect()->back()->with('error', 'File PDF tidak ditemukan.');
            }
            // Mail::to($SuratIjinKegiatanById->user->email)->send(new IjinKegiatan($SuratIjinKegiatan ById, $dataPdfUser));
            $SuratIjinKegiatanById->user->notify(new SuratIjinKegiatanNotification($SuratIjinKegiatanById, $dataPdfUser));
            redirect()->back()->with('success', 'Surat Ijin Kegiatan berhasil dikirim.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
