<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\KategoriBiro;
use App\Models\PeriodeKepengurusan;

class StrukturOrganisasiController extends Controller
{
    /**
     * Halaman publik untuk menampilkan struktur organisasi periode aktif.
     */
    public function __invoke()
    {
        $periodeAktif = PeriodeKepengurusan::with([
            'presidium' => function ($query) {
                $query->orderBy('jabatan')->orderBy('name');
            },
            'programKerja',
        ])->where('is_aktif', true)->orderBy('tanggal_mulai', 'desc')->first();

        if (!$periodeAktif) {
            return view('public.struktur-organisasi', compact('periodeAktif'));
        }

        // Filter kabid dan kader berdasarkan periode aktif
        $periodeAktifId = $periodeAktif->id;
        
        // Get kategori biro yang aktif dengan eager loading kabid dan kader yang memiliki periode aktif
        $kategoriBiro = KategoriBiro::where('is_aktif', true)
            ->with([
                'kabid' => function ($query) use ($periodeAktifId) {
                    $query->whereHas('periodeKabid', function($q) use ($periodeAktifId) {
                        $q->where('periode_id', $periodeAktifId);
                    })
                    ->orderByRaw("CASE 
                        WHEN jabatan = 'Ketua' THEN 1 
                        WHEN jabatan = 'Sekretaris' THEN 2 
                        WHEN jabatan = 'Bendahara' THEN 3 
                        ELSE 4 
                    END")
                    ->orderBy('name');
                },
                'kader' => function ($query) use ($periodeAktifId) {
                    $query->whereHas('periodeKader', function($q) use ($periodeAktifId) {
                        $q->where('periode_id', $periodeAktifId);
                    })
                    ->orderBy('name');
                },
            ])
            ->orderBy('nama')
            ->get();

        // Filter kategori biro yang memiliki ketua (kabid dengan jabatan "Ketua") di periode aktif
        // Dan urutkan kabid berdasarkan urutan: Ketua, Sekretaris, Bendahara
        $kategoriBiro = $kategoriBiro->filter(function($biro) {
            // Cek apakah ada kabid dengan jabatan "Ketua"
            $hasKetua = $biro->kabid->contains(function($kabid) {
                return $kabid->jabatan === 'Ketua';
            });
            
            // Urutkan kabid berdasarkan urutan: Ketua, Sekretaris, Bendahara
            $biro->kabid = $biro->kabid->sortBy(function($kabid) {
                $order = [
                    'Ketua' => 1,
                    'Sekretaris' => 2,
                    'Bendahara' => 3,
                ];
                return $order[$kabid->jabatan] ?? 99;
            })->values();
            
            return $hasKetua;
        });

        return view('public.struktur-organisasi', compact('periodeAktif', 'kategoriBiro'));
    }
}

