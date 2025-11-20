<?php

namespace App\Http\Controllers;

use App\Models\PeriodeKepengurusan;
use App\Models\KategoriBiro;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama
     */
    public function index()
    {
        // Get periode aktif
        $periodeAktif = PeriodeKepengurusan::where('is_aktif', true)
            ->orderBy('tanggal_mulai', 'desc')
            ->first();

        // Get pengurus periode aktif dengan urutan: Ketua, Sekretaris, Wakil Ketua, Bendahara
        $pengurusInti = collect();
        
        if ($periodeAktif) {
            // Load presidium dengan jabatan yang sesuai
            // Mencari: Ketua, Sekretaris, Wakil/Wakil Ketua, Bendahara
            $pengurusInti = $periodeAktif->presidium()
                ->whereIn('jabatan', ['Ketua', 'Sekretaris', 'Wakil', 'Wakil Ketua', 'Bendahara'])
                ->get()
                ->sortBy(function($user) {
                    // Urutan: Ketua (1), Sekretaris (2), Wakil/Wakil Ketua (3), Bendahara (4)
                    $jabatan = $user->jabatan;
                    $order = [
                        'Ketua' => 1,
                        'Sekretaris' => 2,
                        'Wakil' => 3,
                        'Wakil Ketua' => 3,
                        'Bendahara' => 4,
                    ];
                    return $order[$jabatan] ?? 99;
                })
                ->values();
        }

        // Get kategori biro aktif
        $kategoriBiro = KategoriBiro::where('is_aktif', true)
            ->orderBy('nama')
            ->get();

        // Statistik
        $totalKader = \App\Models\User::whereHas('roleModel', function($q) {
            $q->where('name', 'kader');
        })->where('status_aktif', true)->count();

        $totalProgramKerja = \App\Models\ProgramKerja::where('status', 'aktif')->count();

        return view('home', compact(
            'periodeAktif',
            'pengurusInti',
            'kategoriBiro',
            'totalKader',
            'totalProgramKerja'
        ));
    }
}

