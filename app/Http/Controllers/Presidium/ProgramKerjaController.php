<?php

namespace App\Http\Controllers\Presidium;

use App\Http\Controllers\Controller;
use App\Models\ProgramKerja;
use App\Models\PeriodeKepengurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProgramKerjaController extends Controller
{
    /**
     * Menampilkan daftar program kerja
     */
    public function index(Request $request)
    {
        // Get periode presidium yang login
        $presidium = Auth::user();
        $presidium->load('periodePresidium');
        $presidiumPeriodeIds = $presidium->periodePresidium->pluck('id')->toArray();
        
        $query = ProgramKerja::with(['creator', 'kader', 'periode', 'kategoriBiro'])
            ->withCount(['kader', 'pertemuan']);
        
        // Filter program kerja berdasarkan periode presidium
        if (!empty($presidiumPeriodeIds)) {
            $query->whereIn('periode_id', $presidiumPeriodeIds);
        } else {
            // Jika presidium belum memiliki periode, tidak tampilkan program kerja
            $query->whereRaw('1 = 0');
        }
        
        // Filter berdasarkan periode (jika dipilih di form)
        if ($request->has('periode_id') && $request->periode_id) {
            // Pastikan periode yang dipilih adalah periode presidium
            if (in_array($request->periode_id, $presidiumPeriodeIds)) {
                $query->where('periode_id', $request->periode_id);
            }
        }
        
        // Filter berdasarkan status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan kategori biro
        if ($request->has('kategori_biro_id') && $request->kategori_biro_id) {
            $query->where('kategori_biro_id', $request->kategori_biro_id);
        }
        
        $programKerja = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        
        // Get periode presidium untuk filter (hanya periode yang dimiliki presidium)
        $periodeList = !empty($presidiumPeriodeIds) 
            ? PeriodeKepengurusan::whereIn('id', $presidiumPeriodeIds)->orderBy('tanggal_mulai', 'desc')->get()
            : collect();
        
        // Get semua kategori biro untuk filter
        $kategoriBiroList = \App\Models\KategoriBiro::where('is_aktif', true)->orderBy('nama')->get();
        
        return view('presidium.program-kerja.index', compact('programKerja', 'periodeList', 'kategoriBiroList'));
    }

    /**
     * Menampilkan form tambah program kerja
     */
    public function create()
    {
        // Get periode presidium yang login
        $presidium = Auth::user();
        $presidium->load('periodePresidium');
        $presidiumPeriodeIds = $presidium->periodePresidium->pluck('id')->toArray();
        
        // Filter kader berdasarkan periode presidium
        $kaders = User::whereHas('roleModel', function($q) {
            $q->where('name', 'kader');
        })->where('status_aktif', true);
        
        // Jika presidium memiliki periode, filter kader yang memiliki periode yang sama
        if (!empty($presidiumPeriodeIds)) {
            $kaders->whereHas('periodeKader', function($q) use ($presidiumPeriodeIds) {
                $q->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
            });
        } else {
            // Jika presidium belum memiliki periode, tidak tampilkan kader
            $kaders->whereRaw('1 = 0');
        }
        
        $kaders = $kaders->orderBy('name')->get();
        
        // Get periode presidium untuk dropdown (hanya periode yang dimiliki presidium)
        $periodeList = !empty($presidiumPeriodeIds) 
            ? PeriodeKepengurusan::whereIn('id', $presidiumPeriodeIds)->orderBy('tanggal_mulai', 'desc')->get()
            : collect();
        $periodeAktif = PeriodeKepengurusan::where('is_aktif', true)->first();
        
        // Get kategori biro aktif
        $kategoriBiroList = \App\Models\KategoriBiro::where('is_aktif', true)->orderBy('nama')->get();
        
        return view('presidium.program-kerja.create', compact('kaders', 'periodeList', 'periodeAktif', 'kategoriBiroList'));
    }

    /**
     * Menyimpan program kerja baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_biro_id' => 'required|exists:kategori_biro,id',
            'frekuensi_kegiatan' => 'nullable|integer|min:1',
            'periode_id' => 'nullable|exists:periode_kepengurusan,id',
            'status' => 'required|in:draft,aktif,selesai,dibatalkan',
            'foto_progja' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kader_ids' => 'nullable|array',
            'kader_ids.*' => 'exists:users,id',
        ]);

        // Handle foto progja upload
        if ($request->hasFile('foto_progja')) {
            $validated['foto_progja'] = $request->file('foto_progja')->store('program-kerja', 'public');
        }

        // Set created_by
        $validated['created_by'] = Auth::id();

        // Simpan program kerja
        $programKerja = ProgramKerja::create($validated);

        // Attach kader jika ada
        if ($request->has('kader_ids') && !empty($request->kader_ids)) {
            $programKerja->kader()->attach($request->kader_ids);
        }

        return redirect()->route('presidium.program-kerja.index')
            ->with('success', 'Program kerja berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail program kerja
     */
    public function show(ProgramKerja $programKerja)
    {
        $programKerja->load(['creator', 'kader', 'pertemuan', 'kategoriBiro']);
        
        // Load absensi dan dokumentasi dengan pertemuan_ke
        $absensi = $programKerja->absensi()->with('kader')->get();
        $dokumentasi = $programKerja->dokumentasi()->with('uploader')->get();
        
        // Group absensi dan dokumentasi by pertemuan_ke
        $absensiByPertemuan = $absensi->groupBy('pertemuan_ke');
        $dokumentasiByPertemuan = $dokumentasi->groupBy('pertemuan_ke');
        
        // Get periode presidium yang login
        $presidium = Auth::user();
        $presidium->load('periodePresidium');
        $presidiumPeriodeIds = $presidium->periodePresidium->pluck('id')->toArray();
        
        // Get list semua user yang belum ditambahkan ke program kerja ini
        // Filter berdasarkan periode presidium (semua role di periode ini)
        $programKerja->load('kategoriBiro');
        $existingKaderIds = $programKerja->kader->pluck('id')->toArray();
        
        // Inisialisasi collection kosong sebagai default
        $availableUsers = collect();
        
        // Ambil semua user aktif di periode presidium (semua role)
        if (!empty($presidiumPeriodeIds)) {
            $query = User::where('status_aktif', true);
            
            // Filter user berdasarkan periode presidium
            $query->where(function($q) use ($presidiumPeriodeIds) {
                $q->whereHas('periodePresidium', function($subQ) use ($presidiumPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
                })
                ->orWhereHas('periodeKader', function($subQ) use ($presidiumPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
                })
                ->orWhereHas('periodeKabid', function($subQ) use ($presidiumPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
                });
            });
            
            if (!empty($existingKaderIds)) {
                $query->whereNotIn('id', $existingKaderIds);
            }
            
            // Load program kerja lain yang diikuti user untuk ditampilkan di UI
            $availableUsers = $query->with(['roleModel', 'programKerja' => function($q) {
                $q->select('program_kerja.id', 'program_kerja.judul', 'program_kerja.periode_id')
                  ->with('periode:id,nama_periode,tanggal_mulai,is_aktif');
            }])->orderBy('name')->get();
        }
        
        // Pastikan variabel selalu terdefinisi (fallback untuk backward compatibility)
        $availableKaders = $availableUsers; // Alias untuk backward compatibility
        
        return view('presidium.program-kerja.show', compact('programKerja', 'absensiByPertemuan', 'dokumentasiByPertemuan', 'availableUsers', 'availableKaders'));
    }

    /**
     * Menambahkan user ke program kerja (semua role di periode)
     */
    public function attachKader(Request $request, ProgramKerja $programKerja)
    {
        $request->validate([
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
        ]);

        // Reload kader untuk memastikan data terbaru
        $programKerja->load('kader');

        // Cek apakah user sudah ada
        $existingKaderIds = $programKerja->kader->pluck('id')->toArray();
        $newUserIds = array_diff($request->user_ids, $existingKaderIds);
        
        if (empty($newUserIds)) {
            return redirect()->back()
                ->with('error', 'Semua user yang dipilih sudah ditambahkan ke program kerja ini.');
        }

        // Validasi bahwa user berada di periode yang sama dengan presidium
        $presidium = Auth::user();
        $presidium->load('periodePresidium');
        $presidiumPeriodeIds = $presidium->periodePresidium->pluck('id')->toArray();
        
        $validUsers = User::whereIn('id', $newUserIds)
            ->where('status_aktif', true)
            ->where(function($q) use ($presidiumPeriodeIds) {
                $q->whereHas('periodePresidium', function($subQ) use ($presidiumPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
                })
                ->orWhereHas('periodeKader', function($subQ) use ($presidiumPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
                })
                ->orWhereHas('periodeKabid', function($subQ) use ($presidiumPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
                });
            })
            ->pluck('id')
            ->toArray();

        if (empty($validUsers)) {
            return redirect()->back()
                ->with('error', 'User yang dipilih tidak valid atau tidak berada di periode yang sama.');
        }

        $programKerja->kader()->attach($validUsers);

        $count = count($validUsers);
        return redirect()->back()
            ->with('success', $count . ' user berhasil ditambahkan ke program kerja ini.');
    }

    /**
     * Menghapus kader dari program kerja
     */
    public function detachKader(ProgramKerja $programKerja, User $kader)
    {
        $programKerja->kader()->detach($kader->id);

        return redirect()->back()
            ->with('success', 'Kader berhasil dihapus dari program kerja.');
    }

    /**
     * Menampilkan form edit program kerja
     */
    public function edit(ProgramKerja $programKerja)
    {
        // Get periode presidium yang login
        $presidium = Auth::user();
        $presidium->load('periodePresidium');
        $presidiumPeriodeIds = $presidium->periodePresidium->pluck('id')->toArray();
        
        $programKerja->load(['kader', 'kategoriBiro']);
        
        // Filter kader berdasarkan periode presidium
        $kaders = User::whereHas('roleModel', function($q) {
            $q->where('name', 'kader');
        })->where('status_aktif', true);
        
        // Jika presidium memiliki periode, filter kader yang memiliki periode yang sama
        if (!empty($presidiumPeriodeIds)) {
            $kaders->whereHas('periodeKader', function($q) use ($presidiumPeriodeIds) {
                $q->whereIn('periode_kepengurusan.id', $presidiumPeriodeIds);
            });
        } else {
            // Jika presidium belum memiliki periode, tidak tampilkan kader
            $kaders->whereRaw('1 = 0');
        }
        
        $kaders = $kaders->orderBy('name')->get();
        
        $selectedKaderIds = $programKerja->kader->pluck('id')->toArray();
        
        // Get periode presidium untuk dropdown (hanya periode yang dimiliki presidium)
        $periodeList = !empty($presidiumPeriodeIds) 
            ? PeriodeKepengurusan::whereIn('id', $presidiumPeriodeIds)->orderBy('tanggal_mulai', 'desc')->get()
            : collect();
        
        // Get kategori biro aktif
        $kategoriBiroList = \App\Models\KategoriBiro::where('is_aktif', true)->orderBy('nama')->get();
        
        return view('presidium.program-kerja.edit', compact('programKerja', 'kaders', 'selectedKaderIds', 'periodeList', 'kategoriBiroList'));
    }

    /**
     * Update program kerja
     */
    public function update(Request $request, ProgramKerja $programKerja)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_biro_id' => 'required|exists:kategori_biro,id',
            'frekuensi_kegiatan' => 'nullable|integer|min:1',
            'periode_id' => 'nullable|exists:periode_kepengurusan,id',
            'status' => 'required|in:draft,aktif,selesai,dibatalkan',
            'foto_progja' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kader_ids' => 'nullable|array',
            'kader_ids.*' => 'exists:users,id',
        ]);

        // Handle foto progja upload
        if ($request->hasFile('foto_progja')) {
            // Hapus foto lama jika ada
            if ($programKerja->foto_progja) {
                Storage::disk('public')->delete($programKerja->foto_progja);
            }
            $validated['foto_progja'] = $request->file('foto_progja')->store('program-kerja', 'public');
        }

        // Update program kerja
        $programKerja->update($validated);

        // Sync kader
        if ($request->has('kader_ids')) {
            $programKerja->kader()->sync($request->kader_ids ?? []);
        } else {
            $programKerja->kader()->detach();
        }

        return redirect()->route('presidium.program-kerja.index')
            ->with('success', 'Program kerja berhasil diperbarui.');
    }

    /**
     * Hapus program kerja
     */
    public function destroy(ProgramKerja $programKerja)
    {
        // Hapus foto progja jika ada
        if ($programKerja->foto_progja) {
            Storage::disk('public')->delete($programKerja->foto_progja);
        }

        $programKerja->delete();

        return redirect()->route('presidium.program-kerja.index')
            ->with('success', 'Program kerja berhasil dihapus.');
    }
}

