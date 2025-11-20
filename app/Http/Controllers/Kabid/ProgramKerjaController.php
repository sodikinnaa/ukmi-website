<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\ProgramKerja;
use App\Models\PeriodeKepengurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProgramKerjaController extends Controller
{
    /**
     * Menampilkan daftar program kerja untuk kabid
     * Hanya menampilkan program kerja yang sesuai dengan kategori biro kabid dan periode kabid
     */
    public function index(Request $request)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        $query = ProgramKerja::with(['creator', 'kader', 'periode', 'kategoriBiro'])
            ->withCount(['kader', 'pertemuan']);
        
        // Filter program kerja berdasarkan kategori biro kabid
        if (!empty($kabidKategoriBiroIds)) {
            $query->whereIn('kategori_biro_id', $kabidKategoriBiroIds);
        } else {
            // Jika kabid belum memiliki kategori biro, tidak tampilkan program kerja
            $query->whereRaw('1 = 0');
        }
        
        // Filter berdasarkan periode kabid (bukan hanya periode aktif)
        if (!empty($kabidPeriodeIds)) {
            // Jika ada filter periode dari request, pastikan periode tersebut adalah periode kabid
            if ($request->has('periode_id') && $request->periode_id) {
                if (in_array($request->periode_id, $kabidPeriodeIds)) {
                    $query->where('periode_id', $request->periode_id);
                } else {
                    // Jika periode yang dipilih bukan periode kabid, tidak tampilkan apa-apa
                    $query->whereRaw('1 = 0');
                }
            } else {
                // Default: tampilkan semua program kerja dari periode kabid
                $query->whereIn('periode_id', $kabidPeriodeIds);
            }
        } else {
            // Jika kabid belum memiliki periode, tidak tampilkan program kerja
            $query->whereRaw('1 = 0');
        }
        
        // Filter berdasarkan status (aktif, draft, dan selesai bisa dilihat)
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        } else {
            // Default tampilkan yang aktif, draft, dan selesai (kecuali dibatalkan)
            $query->whereIn('status', ['aktif', 'draft', 'selesai']);
        }
        
        // Filter berdasarkan kategori biro
        if ($request->has('kategori_biro_id') && $request->kategori_biro_id) {
            // Pastikan kategori biro yang dipilih adalah kategori biro kabid
            if (in_array($request->kategori_biro_id, $kabidKategoriBiroIds)) {
                $query->where('kategori_biro_id', $request->kategori_biro_id);
            }
        }
        
        $programKerja = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        
        // Get kategori biro kabid untuk filter
        $kategoriBiroList = $kabid->kategoriBiroKabid;
        
        // Get periode kabid untuk filter
        $periodeList = $kabid->periodeKabid->sortByDesc('tanggal_mulai');
        
        return view('kabid.program-kerja.index', compact('programKerja', 'kategoriBiroList', 'periodeList'));
    }

    /**
     * Menampilkan detail program kerja untuk kabid
     * Hanya bisa melihat, tidak bisa edit/delete
     */
    public function show(ProgramKerja $programKerja)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk melihat program kerja ini.');
        }
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }
        
        $programKerja->load(['creator', 'kader', 'pertemuan', 'kategoriBiro', 'periode']);
        
        // Load absensi dan dokumentasi dengan pertemuan_ke
        $absensi = $programKerja->absensi()->with('kader')->get();
        $dokumentasi = $programKerja->dokumentasi()->with('uploader')->get();
        
        // Group absensi dan dokumentasi by pertemuan_ke
        $absensiByPertemuan = $absensi->groupBy('pertemuan_ke');
        $dokumentasiByPertemuan = $dokumentasi->groupBy('pertemuan_ke');
        
        // Get list semua user yang belum ditambahkan ke program kerja ini
        // Filter berdasarkan periode kabid (semua role di periode ini)
        $programKerja->load('kategoriBiro');
        $existingKaderIds = $programKerja->kader->pluck('id')->toArray();
        
        // Inisialisasi collection kosong sebagai default
        $availableUsers = collect();
        
        // Ambil semua user aktif di periode kabid (semua role)
        if (!empty($kabidPeriodeIds)) {
            $query = \App\Models\User::where('status_aktif', true);
            
            // Filter user berdasarkan periode kabid
            $query->where(function($q) use ($kabidPeriodeIds) {
                $q->whereHas('periodePresidium', function($subQ) use ($kabidPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $kabidPeriodeIds);
                })
                ->orWhereHas('periodeKader', function($subQ) use ($kabidPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $kabidPeriodeIds);
                })
                ->orWhereHas('periodeKabid', function($subQ) use ($kabidPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $kabidPeriodeIds);
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
        
        return view('kabid.program-kerja.show', compact('programKerja', 'absensiByPertemuan', 'dokumentasiByPertemuan', 'availableUsers', 'availableKaders'));
    }

    /**
     * Menampilkan form edit program kerja untuk kabid
     * Kabid hanya bisa edit: judul, deskripsi, frekuensi, status, dan foto
     */
    public function edit(ProgramKerja $programKerja)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit program kerja ini.');
        }
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }
        
        $programKerja->load(['kategoriBiro', 'periode']);
        
        return view('kabid.program-kerja.edit', compact('programKerja'));
    }

    /**
     * Update program kerja untuk kabid
     * Kabid hanya bisa update: judul, deskripsi, frekuensi, status, dan foto
     */
    public function update(Request $request, ProgramKerja $programKerja)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit program kerja ini.');
        }
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }
        
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'frekuensi_kegiatan' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,aktif,selesai,dibatalkan',
            'foto_progja' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle foto progja upload
        if ($request->hasFile('foto_progja')) {
            // Hapus foto lama jika ada
            if ($programKerja->foto_progja) {
                Storage::disk('public')->delete($programKerja->foto_progja);
            }
            $validated['foto_progja'] = $request->file('foto_progja')->store('program-kerja', 'public');
        }

        // Update program kerja (kategori_biro_id dan periode_id tidak bisa diubah oleh kabid)
        $programKerja->update($validated);

        return redirect()->route('kabid.program-kerja.show', $programKerja)
            ->with('success', 'Program kerja berhasil diperbarui.');
    }

    /**
     * Menambahkan user ke program kerja (semua role di periode)
     */
    public function attachKader(Request $request, ProgramKerja $programKerja)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk menambahkan user ke program kerja ini.');
        }
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }

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

        // Validasi bahwa user berada di periode yang sama dengan kabid
        $validUsers = \App\Models\User::whereIn('id', $newUserIds)
            ->where('status_aktif', true)
            ->where(function($q) use ($kabidPeriodeIds) {
                $q->whereHas('periodePresidium', function($subQ) use ($kabidPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $kabidPeriodeIds);
                })
                ->orWhereHas('periodeKader', function($subQ) use ($kabidPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $kabidPeriodeIds);
                })
                ->orWhereHas('periodeKabid', function($subQ) use ($kabidPeriodeIds) {
                    $subQ->whereIn('periode_kepengurusan.id', $kabidPeriodeIds);
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
     * Menghapus user dari program kerja
     */
    public function detachKader(ProgramKerja $programKerja, \App\Models\User $kader)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus user dari program kerja ini.');
        }
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }

        // Reload kader untuk memastikan data terbaru
        $programKerja->load('kader');

        // Cek apakah kader ada di program kerja ini
        $existingKaderIds = $programKerja->kader->pluck('id')->toArray();
        if (!in_array($kader->id, $existingKaderIds)) {
            return redirect()->back()
                ->with('error', 'User tidak ditemukan di program kerja ini.');
        }

        $programKerja->kader()->detach($kader->id);

        return redirect()->back()
            ->with('success', 'User berhasil dihapus dari program kerja ini.');
    }
}

