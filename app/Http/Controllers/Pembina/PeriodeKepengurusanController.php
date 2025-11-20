<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\PeriodeKepengurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeKepengurusanController extends Controller
{
    /**
     * Menampilkan daftar periode kepengurusan
     */
    public function index()
    {
        $periode = PeriodeKepengurusan::with('presidium')
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(15);
        
        return view('pembina.periode.index', compact('periode'));
    }

    /**
     * Menampilkan form tambah periode
     */
    public function create()
    {
        $presidiumList = User::whereHas('roleModel', function($q) {
            $q->where('name', 'presidium');
        })->orderBy('name')->get();
        
        return view('pembina.periode.create', compact('presidiumList'));
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
            'presidium_ids' => 'required|array|min:1',
            'presidium_ids.*' => 'exists:users,id',
        ]);

        // Jika periode ini diaktifkan, nonaktifkan periode lain
        if ($request->has('is_aktif') && $request->is_aktif) {
            DB::table('periode_kepengurusan')->update(['is_aktif' => false]);
        }

        $validated['is_aktif'] = $request->has('is_aktif') && $request->is_aktif;

        // Hapus presidium_ids dari validated sebelum create
        $presidiumIds = $validated['presidium_ids'];
        unset($validated['presidium_ids']);

        $periode = PeriodeKepengurusan::create($validated);

        // Attach presidium
        $periode->presidium()->attach($presidiumIds);

        return redirect()->route('pembina.periode.index')
            ->with('success', 'Periode kepengurusan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail periode
     */
    public function show(PeriodeKepengurusan $periode)
    {
        $periode->load(['presidium', 'programKerja']);
        
        return view('pembina.periode.show', compact('periode'));
    }

    /**
     * Menampilkan form edit periode
     */
    public function edit(PeriodeKepengurusan $periode)
    {
        $periode->load('presidium');
        $presidiumList = User::whereHas('roleModel', function($q) {
            $q->where('name', 'presidium');
        })->orderBy('name')->get();
        
        $selectedPresidiumIds = $periode->presidium->pluck('id')->toArray();
        
        return view('pembina.periode.edit', compact('periode', 'presidiumList', 'selectedPresidiumIds'));
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
            'presidium_ids' => 'required|array|min:1',
            'presidium_ids.*' => 'exists:users,id',
        ]);

        // Jika periode ini diaktifkan, nonaktifkan periode lain
        if ($request->has('is_aktif') && $request->is_aktif && !$periode->is_aktif) {
            DB::table('periode_kepengurusan')
                ->where('id', '!=', $periode->id)
                ->update(['is_aktif' => false]);
        }

        $validated['is_aktif'] = $request->has('is_aktif') && $request->is_aktif;

        // Hapus presidium_ids dari validated sebelum update
        $presidiumIds = $validated['presidium_ids'];
        unset($validated['presidium_ids']);

        $periode->update($validated);

        // Sync presidium
        $periode->presidium()->sync($presidiumIds);

        return redirect()->route('pembina.periode.index')
            ->with('success', 'Periode kepengurusan berhasil diperbarui.');
    }

    /**
     * Hapus periode
     */
    public function destroy(PeriodeKepengurusan $periode)
    {
        // Cek apakah ada program kerja yang menggunakan periode ini
        if ($periode->programKerja()->count() > 0) {
            return redirect()->route('pembina.periode.index')
                ->with('error', 'Tidak dapat menghapus periode karena masih ada program kerja yang menggunakan periode ini.');
        }

        $periode->delete();

        return redirect()->route('pembina.periode.index')
            ->with('success', 'Periode kepengurusan berhasil dihapus.');
    }

    /**
     * Aktifkan periode (set periode lain menjadi tidak aktif)
     */
    public function activate(PeriodeKepengurusan $periode)
    {
        // Nonaktifkan semua periode
        DB::table('periode_kepengurusan')->update(['is_aktif' => false]);
        
        // Aktifkan periode ini
        $periode->update(['is_aktif' => true]);

        return redirect()->route('pembina.periode.index')
            ->with('success', 'Periode ' . $periode->nama_periode . ' berhasil diaktifkan.');
    }
}

