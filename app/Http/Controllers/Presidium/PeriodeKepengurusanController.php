<?php

namespace App\Http\Controllers\Presidium;

use App\Http\Controllers\Controller;
use App\Models\PeriodeKepengurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeKepengurusanController extends Controller
{
    /**
     * Menampilkan daftar periode kepengurusan
     */
    public function index()
    {
        $periode = PeriodeKepengurusan::with(['presidium', 'programKerja'])
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(15);
        
        return view('presidium.periode.index', compact('periode'));
    }

    /**
     * Menampilkan form tambah periode
     */
    public function create()
    {
        return view('presidium.periode.create');
    }

    /**
     * Menyimpan periode baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_mulai',
            'is_aktif' => 'boolean',
            'deskripsi' => 'nullable|string',
        ]);

        // Jika periode ini diaktifkan, nonaktifkan periode lain
        if ($request->has('is_aktif') && $request->is_aktif) {
            DB::table('periode_kepengurusan')->update(['is_aktif' => false]);
        }

        $validated['is_aktif'] = $request->has('is_aktif') && $request->is_aktif;

        PeriodeKepengurusan::create($validated);

        return redirect()->route('presidium.periode.index')
            ->with('success', 'Periode kepengurusan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail periode
     */
    public function show(PeriodeKepengurusan $periode)
    {
        $periode->load(['presidium', 'programKerja']);
        
        return view('presidium.periode.show', compact('periode'));
    }

    /**
     * Menampilkan form edit periode
     */
    public function edit(PeriodeKepengurusan $periode)
    {
        return view('presidium.periode.edit', compact('periode'));
    }

    /**
     * Update periode
     */
    public function update(Request $request, PeriodeKepengurusan $periode)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_mulai',
            'is_aktif' => 'boolean',
            'deskripsi' => 'nullable|string',
        ]);

        // Jika periode ini diaktifkan, nonaktifkan periode lain
        if ($request->has('is_aktif') && $request->is_aktif && !$periode->is_aktif) {
            DB::table('periode_kepengurusan')
                ->where('id', '!=', $periode->id)
                ->update(['is_aktif' => false]);
        }

        $validated['is_aktif'] = $request->has('is_aktif') && $request->is_aktif;

        $periode->update($validated);

        return redirect()->route('presidium.periode.index')
            ->with('success', 'Periode kepengurusan berhasil diperbarui.');
    }

    /**
     * Hapus periode
     */
    public function destroy(PeriodeKepengurusan $periode)
    {
        // Cek apakah ada program kerja yang menggunakan periode ini
        if ($periode->programKerja()->count() > 0) {
            return redirect()->route('presidium.periode.index')
                ->with('error', 'Tidak dapat menghapus periode karena masih ada program kerja yang menggunakan periode ini.');
        }

        $periode->delete();

        return redirect()->route('presidium.periode.index')
            ->with('success', 'Periode kepengurusan berhasil dihapus.');
    }
}

