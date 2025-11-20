<?php

namespace App\Http\Controllers;

use App\Models\ProgramKerja;
use App\Models\PeriodeKepengurusan;
use Illuminate\Http\Request;

class ReferensiProgjaController extends Controller
{
    /**
     * Menampilkan daftar program kerja dari semua periode
     */
    public function index(Request $request)
    {
        // Get periode aktif
        $periodeAktif = PeriodeKepengurusan::where('is_aktif', true)->first();
        
        // Get semua periode (aktif dan non-aktif)
        $query = PeriodeKepengurusan::orderBy('tanggal_mulai', 'desc');
        
        // Filter berdasarkan periode jika dipilih
        if ($request->filled('periode_id')) {
            $query->where('id', $request->periode_id);
        }
        
        $periodeList = $query->get();
        
        // Get program kerja dari semua periode
        $programKerjaQuery = ProgramKerja::with(['kategoriBiro', 'periode', 'creator'])
            ->withCount(['kader', 'pertemuan']);
        
        // Filter berdasarkan periode jika dipilih
        if ($request->filled('periode_id')) {
            $programKerjaQuery->where('periode_id', $request->periode_id);
        }
        
        // Filter berdasarkan kategori biro jika dipilih
        if ($request->filled('kategori_biro_id')) {
            $programKerjaQuery->where('kategori_biro_id', $request->kategori_biro_id);
        }
        
        // Filter berdasarkan status jika dipilih
        if ($request->filled('status')) {
            $programKerjaQuery->where('status', $request->status);
        }
        
        // Filter berdasarkan search
        if ($request->filled('search')) {
            $search = $request->search;
            $programKerjaQuery->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        
        $programKerja = $programKerjaQuery->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();
        
        // Get kategori biro untuk filter
        $kategoriBiroList = \App\Models\KategoriBiro::where('is_aktif', true)
            ->orderBy('nama')
            ->get();
        
        return view('referensi-progja.index', compact('programKerja', 'periodeList', 'kategoriBiroList', 'periodeAktif'));
    }

    /**
     * Menampilkan detail program kerja dari semua periode
     */
    public function show(ProgramKerja $programKerja)
    {
        // Load semua relasi yang diperlukan
        $programKerja->load([
            'kategoriBiro',
            'periode',
            'creator',
            'kader' => function($query) {
                $query->orderBy('name');
            },
            'pertemuan' => function($query) {
                $query->orderBy('pertemuan_ke');
            },
            'absensi.kader',
            'dokumentasi'
        ]);
        
        // Group absensi dan dokumentasi by pertemuan_ke
        $absensiByPertemuan = $programKerja->absensi->groupBy('pertemuan_ke');
        $dokumentasiByPertemuan = $programKerja->dokumentasi->groupBy('pertemuan_ke');
        
        return view('referensi-progja.show', compact('programKerja', 'absensiByPertemuan', 'dokumentasiByPertemuan'));
    }
}

