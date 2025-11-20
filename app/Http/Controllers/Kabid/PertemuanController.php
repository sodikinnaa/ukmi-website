<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\ProgramKerja;
use App\Models\PeriodeKepengurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PertemuanController extends Controller
{
    /**
     * Menampilkan form tambah pertemuan untuk kabid
     * Hanya bisa menambahkan pertemuan, tidak bisa edit/delete
     */
    public function create(ProgramKerja $programKerja)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk menambahkan pertemuan pada program kerja ini.');
        }
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }
        
        // Cek apakah pertemuan sudah mencapai batas maksimal
        if ($programKerja->frekuensi_kegiatan && $programKerja->jumlah_pertemuan >= $programKerja->frekuensi_kegiatan) {
            return redirect()->route('kabid.program-kerja.show', $programKerja)
                ->with('error', 'Pertemuan sudah mencapai batas maksimal (' . $programKerja->frekuensi_kegiatan . ' pertemuan). Tidak dapat menambahkan pertemuan baru.');
        }
        
        $pertemuanBerikutnya = $programKerja->pertemuan_berikutnya;
        
        return view('kabid.pertemuan.create', compact('programKerja', 'pertemuanBerikutnya'));
    }

    /**
     * Menyimpan pertemuan baru untuk kabid
     */
    public function store(Request $request, ProgramKerja $programKerja)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk menambahkan pertemuan pada program kerja ini.');
        }
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }
        
        // Cek apakah pertemuan sudah mencapai batas maksimal
        if ($programKerja->frekuensi_kegiatan && $programKerja->jumlah_pertemuan >= $programKerja->frekuensi_kegiatan) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['pertemuan_ke' => 'Pertemuan sudah mencapai batas maksimal (' . $programKerja->frekuensi_kegiatan . ' pertemuan). Tidak dapat menambahkan pertemuan baru.']);
        }

        $validated = $request->validate([
            'pertemuan_ke' => 'required|integer|min:1|unique:pertemuan,pertemuan_ke,NULL,id,program_kerja_id,' . $programKerja->id,
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'foto_absen' => 'nullable|mimes:pdf|max:10240',
            'total_peserta' => 'nullable|integer|min:0',
            'lokasi_kegiatan' => 'nullable|string|max:255',
        ]);

        // Validasi pertemuan_ke tidak melebihi frekuensi_kegiatan
        if ($programKerja->frekuensi_kegiatan && $validated['pertemuan_ke'] > $programKerja->frekuensi_kegiatan) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['pertemuan_ke' => 'Pertemuan ke-' . $validated['pertemuan_ke'] . ' melebihi frekuensi kegiatan yang direncanakan (' . $programKerja->frekuensi_kegiatan . ' pertemuan).']);
        }

        // Handle upload foto kegiatan
        if ($request->hasFile('foto_kegiatan')) {
            $validated['foto_kegiatan'] = $request->file('foto_kegiatan')->store('pertemuan/kegiatan', 'public');
        }

        // Handle upload foto absen (PDF)
        if ($request->hasFile('foto_absen')) {
            $validated['foto_absen'] = $request->file('foto_absen')->store('pertemuan/absen', 'public');
        }

        $validated['program_kerja_id'] = $programKerja->id;
        $validated['created_by'] = Auth::id();

        Pertemuan::create($validated);

        // Update status program kerja jika semua pertemuan sudah selesai
        $programKerja->updateStatusBasedOnPertemuan();

        return redirect()->route('kabid.program-kerja.show', $programKerja)
            ->with('success', 'Pertemuan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pertemuan untuk kabid
     */
    public function show(ProgramKerja $programKerja, Pertemuan $pertemuan)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk melihat pertemuan pada program kerja ini.');
        }
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }
        
        $pertemuan->load('creator');
        
        // Load absensi dan dokumentasi untuk pertemuan ini
        $absensi = \App\Models\Absensi::where('program_kerja_id', $pertemuan->program_kerja_id)
            ->where('pertemuan_ke', $pertemuan->pertemuan_ke)
            ->with('kader')
            ->get();
        
        $dokumentasi = \App\Models\Dokumentasi::where('program_kerja_id', $pertemuan->program_kerja_id)
            ->where('pertemuan_ke', $pertemuan->pertemuan_ke)
            ->with('uploader')
            ->get();
        
        return view('kabid.pertemuan.show', compact('programKerja', 'pertemuan', 'absensi', 'dokumentasi'));
    }

    /**
     * Menampilkan form edit pertemuan untuk kabid
     */
    public function edit(ProgramKerja $programKerja, Pertemuan $pertemuan)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit pertemuan pada program kerja ini.');
        }
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }
        
        return view('kabid.pertemuan.edit', compact('programKerja', 'pertemuan'));
    }

    /**
     * Update pertemuan untuk kabid
     */
    public function update(Request $request, ProgramKerja $programKerja, Pertemuan $pertemuan)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate pertemuan pada program kerja ini.');
        }
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }

        $validated = $request->validate([
            'pertemuan_ke' => 'required|integer|min:1|unique:pertemuan,pertemuan_ke,' . $pertemuan->id . ',id,program_kerja_id,' . $programKerja->id,
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'foto_absen' => 'nullable|mimes:pdf|max:10240',
            'total_peserta' => 'nullable|integer|min:0',
            'lokasi_kegiatan' => 'nullable|string|max:255',
        ]);

        // Validasi pertemuan_ke tidak melebihi frekuensi_kegiatan
        if ($programKerja->frekuensi_kegiatan && $validated['pertemuan_ke'] > $programKerja->frekuensi_kegiatan) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['pertemuan_ke' => 'Pertemuan ke-' . $validated['pertemuan_ke'] . ' melebihi frekuensi kegiatan yang direncanakan (' . $programKerja->frekuensi_kegiatan . ' pertemuan).']);
        }

        // Handle upload foto kegiatan
        if ($request->hasFile('foto_kegiatan')) {
            // Hapus foto lama jika ada
            if ($pertemuan->foto_kegiatan) {
                Storage::disk('public')->delete($pertemuan->foto_kegiatan);
            }
            $validated['foto_kegiatan'] = $request->file('foto_kegiatan')->store('pertemuan/kegiatan', 'public');
        }

        // Handle upload foto absen (PDF)
        if ($request->hasFile('foto_absen')) {
            // Hapus file lama jika ada
            if ($pertemuan->foto_absen) {
                Storage::disk('public')->delete($pertemuan->foto_absen);
            }
            $validated['foto_absen'] = $request->file('foto_absen')->store('pertemuan/absen', 'public');
        }

        $pertemuan->update($validated);

        // Update status program kerja jika semua pertemuan sudah selesai
        $programKerja->updateStatusBasedOnPertemuan();

        return redirect()->route('kabid.program-kerja.show', $programKerja)
            ->with('success', 'Pertemuan berhasil diperbarui.');
    }

    /**
     * Hapus pertemuan untuk kabid
     */
    public function destroy(ProgramKerja $programKerja, Pertemuan $pertemuan)
    {
        $kabid = Auth::user();
        
        // Load kategori biro yang dimiliki kabid
        $kabid->load('kategoriBiroKabid');
        $kabidKategoriBiroIds = $kabid->kategoriBiroKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini sesuai dengan kategori biro kabid
        if (!in_array($programKerja->kategori_biro_id, $kabidKategoriBiroIds)) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus pertemuan pada program kerja ini.');
        }
        
        // Load periode yang dimiliki kabid
        $kabid->load('periodeKabid');
        $kabidPeriodeIds = $kabid->periodeKabid->pluck('id')->toArray();
        
        // Cek apakah program kerja ini dalam periode kabid
        if (!in_array($programKerja->periode_id, $kabidPeriodeIds)) {
            abort(403, 'Program kerja ini tidak dalam periode yang Anda kelola.');
        }

        $deletedPertemuanKe = $pertemuan->pertemuan_ke;
        
        // Hapus file foto kegiatan jika ada
        if ($pertemuan->foto_kegiatan) {
            Storage::disk('public')->delete($pertemuan->foto_kegiatan);
        }
        
        // Hapus file foto absen jika ada
        if ($pertemuan->foto_absen) {
            Storage::disk('public')->delete($pertemuan->foto_absen);
        }
        
        // Hapus pertemuan
        $pertemuan->delete();
        
        // Renumbering pertemuan yang tersisa
        // Ambil semua pertemuan setelah yang dihapus
        $pertemuanAfterDeleted = Pertemuan::where('program_kerja_id', $programKerja->id)
            ->where('pertemuan_ke', '>', $deletedPertemuanKe)
            ->orderBy('pertemuan_ke')
            ->get();
        
        // Update nomor pertemuan secara berurutan
        $newPertemuanKe = $deletedPertemuanKe;
        foreach ($pertemuanAfterDeleted as $pert) {
            $oldPertemuanKe = $pert->pertemuan_ke; // Simpan nilai lama sebelum update
            $newPertemuanKe++;
            
            // Update pertemuan_ke di tabel pertemuan
            $pert->update(['pertemuan_ke' => $newPertemuanKe]);
            
            // Update pertemuan_ke di tabel absensi yang terkait
            \App\Models\Absensi::where('program_kerja_id', $programKerja->id)
                ->where('pertemuan_ke', $oldPertemuanKe)
                ->update(['pertemuan_ke' => $newPertemuanKe]);
            
            // Update pertemuan_ke di tabel dokumentasi yang terkait
            \App\Models\Dokumentasi::where('program_kerja_id', $programKerja->id)
                ->where('pertemuan_ke', $oldPertemuanKe)
                ->update(['pertemuan_ke' => $newPertemuanKe]);
        }

        // Update status program kerja setelah pertemuan dihapus
        $programKerja->updateStatusBasedOnPertemuan();

        return redirect()->route('kabid.program-kerja.show', $programKerja)
            ->with('success', 'Pertemuan berhasil dihapus dan nomor pertemuan telah disesuaikan.');
    }
}

