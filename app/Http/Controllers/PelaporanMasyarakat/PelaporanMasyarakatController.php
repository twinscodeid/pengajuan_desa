<?php

namespace App\Http\Controllers\PelaporanMasyarakat;

use App\Http\Controllers\Controller;
use App\Models\PelaporanMasyarakat;
use Illuminate\Http\Request;
use App\Services\PelaporanMasyarakatService;
use App\Http\Requests\PelaporanMasyarakatRequest;
use App\Notifications\PelaporanMasyarakatNotification;
use App\Notifications\AdminPelaporanMasyarakatNotification;
use App\Models\User;
use App\Models\PegawaiDesa;
use Inertia\Inertia;

class PelaporanMasyarakatController extends Controller
{
    protected $pelaporanMasyarakatService;

    public function __construct(PelaporanMasyarakatService $pelaporanMasyarakatService)
    {
        $this->pelaporanMasyarakatService = $pelaporanMasyarakatService;
    }

    public function show($id)
    {
        try {
            $dataPelaporanMasyarakat = $this->pelaporanMasyarakatService->getPelaporanMasyarakatById($id);
            return Inertia::render('DashboardAdmin/PelaporanMasyarakat/Show', [
                'dataPelaporanMasyarakat' => $dataPelaporanMasyarakat
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    // bagian store
    public function store(PelaporanMasyarakatRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $this->pelaporanMasyarakatService->storePelaporanMasyarakat($data);

            // ambil data admin
            $admin = PegawaiDesa::where('role_id', '1')->first();
            $admin->notify(new AdminPelaporanMasyarakatNotification($admin));
            return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    // bagian update
    // public function update($id, PelaporanMasyarakatRequest $request)
    // {

    //     try {
    //         $data = $request->validated();
    //         $dataUserId = $this->pelaporanMasyarakatService->getPelaporanMasyarakatById($id);
    //         $data['user_id'] = $dataUserId->user_id;
    //         $this->pelaporanMasyarakatService->updatePelaporanMasyarakat($id, $data);
    //         return redirect()->back()->with('success', 'Laporan berhasil diperbarui.');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    //     }
    // }

    public function destroy($id)
    {
        try {
            $this->pelaporanMasyarakatService->destroyPelaporanMasyarakat($id);
            return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function sendEmail($id)
    {
        try {
            $pelaporanMasyarakatById = $this->pelaporanMasyarakatService->getPelaporanMasyarakatById($id);
            if ($pelaporanMasyarakatById) {
                $pelaporanMasyarakatById->user->notify(new PelaporanMasyarakatNotification($pelaporanMasyarakatById));
                return redirect()->back()->with('success', 'Laporan berhasil dikirim ke user.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
