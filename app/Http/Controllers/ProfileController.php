<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile user
     */
    public function show()
    {
        $user = Auth::user();
        $user->load(['roleModel', 'periodeKader', 'periodeKabid', 'periodePresidium', 'kategoriBiro']);
        
        return view('profile.show', compact('user'));
    }

    /**
     * Menampilkan form edit profile
     */
    public function edit()
    {
        $user = Auth::user();
        $user->load(['roleModel', 'periodeKader', 'periodeKabid', 'periodePresidium']);
        
        // Get periode untuk kader, kabid, dan presidium
        $periodeList = \App\Models\PeriodeKepengurusan::orderBy('tanggal_mulai', 'desc')->get();
        $periodeAktif = \App\Models\PeriodeKepengurusan::where('is_aktif', true)->first();
        
        // Get periode yang sudah dipilih
        $selectedPeriodeIds = [];
        if ($user->roleModel) {
            if ($user->roleModel->name === 'kader') {
                $selectedPeriodeIds = $user->periodeKader->pluck('id')->toArray();
            } elseif ($user->roleModel->name === 'kabid') {
                $selectedPeriodeIds = $user->periodeKabid->pluck('id')->toArray();
            } elseif ($user->roleModel->name === 'presidium') {
                $selectedPeriodeIds = $user->periodePresidium->pluck('id')->toArray();
            }
        }
        
        return view('profile.edit', compact('user', 'periodeList', 'periodeAktif', 'selectedPeriodeIds'));
    }

    /**
     * Update profile user
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nomor_wa' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:255',
            'npm' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:L,P',
            'hobi' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'periode_ids' => 'nullable|array',
            'periode_ids.*' => 'exists:periode_kepengurusan,id',
        ]);

        // Handle password update
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle foto profile upload
        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($user->foto_profile) {
                Storage::disk('public')->delete($user->foto_profile);
            }
            $validated['foto_profile'] = $request->file('foto_profile')->store('profiles', 'public');
        }

        // Update user data
        $user->update($validated);

        // Handle periode untuk kader, kabid, dan presidium
        if ($user->roleModel && in_array($user->roleModel->name, ['kader', 'kabid', 'presidium'])) {
            $periodeIds = $request->input('periode_ids', []);
            
            // Jika tidak ada periode yang dipilih, default ke periode aktif (hanya untuk kader dan kabid)
            if (empty($periodeIds) && in_array($user->roleModel->name, ['kader', 'kabid'])) {
                $periodeAktif = \App\Models\PeriodeKepengurusan::where('is_aktif', true)->first();
                if ($periodeAktif) {
                    $periodeIds = [$periodeAktif->id];
                }
            }
            
            // Sync periode berdasarkan role
            if ($user->roleModel->name === 'kader') {
                $user->periodeKader()->sync($periodeIds);
            } elseif ($user->roleModel->name === 'kabid') {
                $user->periodeKabid()->sync($periodeIds);
            } elseif ($user->roleModel->name === 'presidium') {
                $user->periodePresidium()->sync($periodeIds);
            }
        }

        return redirect()->route('profile.show')
            ->with('success', 'Profile berhasil diperbarui.');
    }
}

