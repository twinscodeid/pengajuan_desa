<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            return redirect()->back()->with('success', 'Profil kamu berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Profil kamu gagal diupdate');
        }
    }
    public function getProfileRoleUser($id)
    {
        try {
            $dataUser = User::getProfileRoleUser($id);
            return Inertia::render('DashboardUser/Profile', [
                'dataUser' => $dataUser
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
