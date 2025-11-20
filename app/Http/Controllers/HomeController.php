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
            'kategoriBiro',
            'totalKader',
            'totalProgramKerja'
        ));
    }
}

