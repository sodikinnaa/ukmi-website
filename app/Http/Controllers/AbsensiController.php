<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\ProgramKerja;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Menampilkan halaman absensi untuk user yang login
     * User hanya bisa melihat program kerja yang mereka ikuti
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Query langsung dari pivot table untuk memastikan data terbaru
        $programKerjaQuery = \App\Models\ProgramKerja::whereHas('kader', function($q) use ($user) {
            $q->where('users.id', $user->id);
        })
        ->with(['kategoriBiro', 'periode', 'pertemuan' => function($q) {
            $q->orderBy('pertemuan_ke', 'desc');
        }]);
        
        if ($request->filled('program_kerja_id')) {
            $programKerjaQuery->where('program_kerja.id', $request->program_kerja_id);
        }
        
        // Filter hanya program kerja aktif atau selesai (bukan draft atau dibatalkan)
        $programKerjaQuery->whereIn('program_kerja.status', ['aktif', 'selesai']);
        
        $programKerjaList = $programKerjaQuery->orderBy('created_at', 'desc')->get();
        
        // Get semua program kerja untuk filter dropdown
        $allProgramKerja = \App\Models\ProgramKerja::whereHas('kader', function($q) use ($user) {
            $q->where('users.id', $user->id);
        })
        ->whereIn('program_kerja.status', ['aktif', 'selesai'])
        ->with('kategoriBiro')
        ->orderBy('judul')
        ->get();
        
        return view('absensi.index', compact('programKerjaList', 'allProgramKerja'));
    }

    /**
     * Menampilkan form absensi untuk program kerja tertentu
     */
    public function create(ProgramKerja $programKerja)
    {
        $user = Auth::user();
        
        // Refresh relasi untuk memastikan data terbaru
        $user->refresh();
        $user->load('programKerja');
        
        // Cek apakah user mengikuti program kerja ini (cek langsung dari pivot table)
        $isParticipant = DB::table('program_kader')
            ->where('program_kerja_id', $programKerja->id)
            ->where('kader_id', $user->id)
            ->exists();
        
        if (!$isParticipant) {
            abort(403, 'Anda tidak mengikuti program kerja ini.');
        }
        
        // Cek apakah program kerja aktif atau selesai (bukan draft atau dibatalkan)
        if (!in_array($programKerja->status, ['aktif', 'selesai'])) {
            return redirect()->route('absensi.index')
                ->with('error', 'Program kerja ini tidak aktif atau sudah dibatalkan.');
        }
        
        // Load pertemuan terbaru untuk program kerja ini
        $pertemuanList = $programKerja->pertemuan()
            ->orderBy('pertemuan_ke', 'desc')
            ->get();
        
        // Load absensi user untuk program kerja ini
        $absensiUser = $user->absensi()
            ->where('program_kerja_id', $programKerja->id)
            ->with('pertemuan')
            ->orderBy('tanggal', 'desc')
            ->orderBy('pertemuan_ke', 'desc')
            ->get();
        
        return view('absensi.create', compact('programKerja', 'pertemuanList', 'absensiUser'));
    }

    /**
     * Menyimpan absensi baru
     */
    public function store(Request $request, ProgramKerja $programKerja)
    {
        $user = Auth::user();
        
        // Refresh relasi untuk memastikan data terbaru
        $user->refresh();
        $user->load('programKerja');
        
        // Cek apakah user mengikuti program kerja ini (cek langsung dari pivot table)
        $isParticipant = DB::table('program_kader')
            ->where('program_kerja_id', $programKerja->id)
            ->where('kader_id', $user->id)
            ->exists();
        
        if (!$isParticipant) {
            abort(403, 'Anda tidak mengikuti program kerja ini.');
        }
        
        // Cek apakah program kerja aktif atau selesai (bukan draft atau dibatalkan)
        if (!in_array($programKerja->status, ['aktif', 'selesai'])) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['program_kerja_id' => 'Program kerja ini tidak aktif atau sudah dibatalkan.']);
        }
        
        $validated = $request->validate([
            'pertemuan_ke' => 'required|integer|min:1',
            'tanggal' => 'nullable|date', // Tanggal akan diambil dari pertemuan
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
        ]);
        
        // Validasi pertemuan_ke ada di program kerja ini
        $pertemuan = Pertemuan::where('program_kerja_id', $programKerja->id)
            ->where('pertemuan_ke', $validated['pertemuan_ke'])
            ->first();
        
        if (!$pertemuan) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['pertemuan_ke' => 'Pertemuan ke-' . $validated['pertemuan_ke'] . ' tidak ditemukan untuk program kerja ini.']);
        }
        
        // Gunakan tanggal dari pertemuan, bukan tanggal input user
        $tanggalAbsensi = $pertemuan->tanggal->format('Y-m-d');
        
        // Cek apakah sudah ada absensi untuk pertemuan ini (sesuai unique constraint baru: program_kerja_id, kader_id, pertemuan_ke)
        $existingAbsensi = Absensi::where('program_kerja_id', $programKerja->id)
            ->where('kader_id', $user->id)
            ->where('pertemuan_ke', $validated['pertemuan_ke'])
            ->first();
        
        if ($existingAbsensi) {
            // Jika sudah ada, tampilkan error dengan link ke edit
            return redirect()->back()
                ->withInput()
                ->withErrors(['pertemuan_ke' => 'Anda sudah melakukan absensi untuk pertemuan ke-' . $validated['pertemuan_ke'] . ' (tanggal ' . $pertemuan->tanggal->format('d M Y') . '). Silakan edit absensi yang sudah ada.'])
                ->with('existing_absensi_id', $existingAbsensi->id);
        }
        
        // Set tanggal dari pertemuan, bukan dari input user
        $validated['tanggal'] = $tanggalAbsensi;
        $validated['program_kerja_id'] = $programKerja->id;
        $validated['kader_id'] = $user->id;
        $validated['created_by'] = $user->id;
        
        Absensi::create($validated);
        
        return redirect()->route('absensi.index')
            ->with('success', 'Absensi berhasil disimpan.');
    }

    /**
     * Menampilkan riwayat absensi user
     */
    public function history(Request $request)
    {
        $user = Auth::user();
        
        // Load absensi user dengan relasi
        $absensiQuery = $user->absensi()
            ->with(['programKerja.kategoriBiro', 'programKerja.periode', 'pertemuan'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('pertemuan_ke', 'desc');
        
        // Filter berdasarkan program kerja jika dipilih
        if ($request->filled('program_kerja_id')) {
            $absensiQuery->where('program_kerja_id', $request->program_kerja_id);
        }
        
        // Filter berdasarkan status jika dipilih
        if ($request->filled('status')) {
            $absensiQuery->where('status', $request->status);
        }
        
        // Filter berdasarkan tanggal jika dipilih
        if ($request->filled('tanggal_dari')) {
            $absensiQuery->where('tanggal', '>=', $request->tanggal_dari);
        }
        
        if ($request->filled('tanggal_sampai')) {
            $absensiQuery->where('tanggal', '<=', $request->tanggal_sampai);
        }
        
        $absensi = $absensiQuery->paginate(15)->withQueryString();
        
        // Get semua program kerja untuk filter dropdown
        $allProgramKerja = $user->programKerja()
            ->with('kategoriBiro')
            ->orderBy('judul')
            ->get();
        
        return view('absensi.history', compact('absensi', 'allProgramKerja'));
    }

    /**
     * Edit absensi
     */
    public function edit(Absensi $absensi)
    {
        $user = Auth::user();
        
        // Cek apakah absensi ini milik user yang login
        if ($absensi->kader_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit absensi ini.');
        }
        
        $absensi->load(['programKerja.kategoriBiro', 'pertemuan']);
        
        return view('absensi.edit', compact('absensi'));
    }

    /**
     * Update absensi
     */
    public function update(Request $request, Absensi $absensi)
    {
        $user = Auth::user();
        
        // Cek apakah absensi ini milik user yang login
        if ($absensi->kader_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit absensi ini.');
        }
        
        $validated = $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
        ]);
        
        $absensi->update($validated);
        
        return redirect()->route('absensi.history')
            ->with('success', 'Absensi berhasil diperbarui.');
    }
}

