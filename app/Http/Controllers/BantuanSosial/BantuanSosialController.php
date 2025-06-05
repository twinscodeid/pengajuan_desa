<?php

namespace App\Http\Controllers\BantuanSosial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BantuanSosialService;
use App\Http\Requests\BantuanSosialRequest;
use App\Http\Requests\UpdateBantuanSosialRequest;
use App\Notifications\BantuanSosialNotification;
use App\Notifications\AdminBantuanSosialNotification;
use App\Models\User;
use App\Models\PegawaiDesa;
use Inertia\Inertia;

class BantuanSosialController extends Controller
{
    protected $bantuanSosialService;

    public function __construct(BantuanSosialService $bantuanSosialService)
    {
        $this->bantuanSosialService = $bantuanSosialService;
    }

    public function show($id)
    {
        try {
            $bantuanSosialById = $this->bantuanSosialService->getBantuanSosialById($id);
            return Inertia::render('DashboardAdmin/BantuanSosial/Show', [
                'bantuanSosialById' => $bantuanSosialById
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function store(BantuanSosialRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $this->bantuanSosialService->createBantuanSosial($data);
            $admin = PegawaiDesa::where('role_id', '1')->first();
            $admin->notify(new AdminBantuanSosialNotification($admin));
            return redirect()->back()->with('success', 'Bantuan Sosial berhasil dikirim');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function update(UpdateBantuanSosialRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $idUser = $this->bantuanSosialService->getBantuanSosialById($id);
            $data['user_id'] = $idUser->user_id;
            $this->bantuanSosialService->updateBantuanSosial($id, $data);
            return redirect()->back()->with('success', 'Bantuan Sosial berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->bantuanSosialService->destroyBantuanSosial($id);
            return redirect()->back()->with('success', 'Bantuan Sosial berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function sendEmail($id)
    {
        try {
            $bantuanSosialById = $this->bantuanSosialService->getBantuanSosialById($id);
            if ($bantuanSosialById) {
                $bantuanSosialById->user->notify(new BantuanSosialNotification($bantuanSosialById));
                return redirect()->back()->with('success', 'Bantuan Sosial berhasil dikirim ke user.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
