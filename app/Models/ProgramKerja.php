<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;

    protected $table = 'program_kerja';

    protected $fillable = [
        'foto_progja',
        'judul',
        'deskripsi',
        'kategori_biro_id',
        'frekuensi_kegiatan',
        'periode_id',
        'status',
        'created_by',
    ];

    /**
     * Relationship: Kategori biro
     */
    public function kategoriBiro()
    {
        return $this->belongsTo(KategoriBiro::class, 'kategori_biro_id');
    }

    /**
     * Get label kategori biro (backward compatibility)
     */
    public function getKategoriBiroLabelAttribute(): string
    {
        if ($this->kategoriBiro) {
            return $this->kategoriBiro->nama;
        }
        
        // Fallback untuk data lama yang masih menggunakan enum
        return match($this->kategori_biro ?? '') {
            'ksi' => 'KSI (Kajian dan Syiar Islam)',
            'bbq' => 'BBQ (Bimbingan Baca Quran)',
            'hmd' => 'HMD (Humas dan Dokumentasi)',
            'kaderisasi' => 'Kaderisasi',
            'danus' => 'Danus (Dana dan Usaha)',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Relationship: User yang membuat program kerja
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship: Kader yang mengikuti program kerja
     */
    public function kader()
    {
        return $this->belongsToMany(User::class, 'program_kader', 'program_kerja_id', 'kader_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Kabid yang mengelola program kerja
     */
    public function kabid()
    {
        return $this->belongsToMany(User::class, 'program_kabid', 'program_kerja_id', 'kabid_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Absensi program kerja
     */
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'program_kerja_id');
    }

    /**
     * Relationship: Dokumentasi program kerja
     */
    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'program_kerja_id');
    }

    /**
     * Relationship: Pertemuan program kerja
     */
    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'program_kerja_id')->orderBy('pertemuan_ke');
    }

    /**
     * Get jumlah pertemuan yang sudah dilakukan
     */
    public function getJumlahPertemuanAttribute(): int
    {
        return $this->pertemuan()->count();
    }

    /**
     * Get pertemuan berikutnya (belum dibuat)
     * Mencari nomor pertemuan terkecil yang belum ada
     */
    public function getPertemuanBerikutnyaAttribute(): int
    {
        // Ambil semua nomor pertemuan yang sudah ada
        $existingPertemuanKe = $this->pertemuan()->pluck('pertemuan_ke')->toArray();
        
        // Jika belum ada pertemuan sama sekali, mulai dari 1
        if (empty($existingPertemuanKe)) {
            return 1;
        }
        
        // Cari gap (nomor yang hilang) dari 1 sampai max yang ada
        $maxPertemuanKe = max($existingPertemuanKe);
        for ($i = 1; $i <= $maxPertemuanKe; $i++) {
            if (!in_array($i, $existingPertemuanKe)) {
                // Ditemukan gap, gunakan nomor gap ini
                return $i;
            }
        }
        
        // Tidak ada gap, gunakan nomor setelah max
        // Tapi pastikan tidak melebihi frekuensi_kegiatan jika ada
        $nextPertemuanKe = $maxPertemuanKe + 1;
        if ($this->frekuensi_kegiatan && $nextPertemuanKe > $this->frekuensi_kegiatan) {
            // Jika melebihi frekuensi, cari gap di range 1 sampai frekuensi_kegiatan
            for ($i = 1; $i <= $this->frekuensi_kegiatan; $i++) {
                if (!in_array($i, $existingPertemuanKe)) {
                    return $i;
                }
            }
            // Semua sudah terisi, kembalikan max + 1 (meskipun melebihi frekuensi)
            return $nextPertemuanKe;
        }
        
        return $nextPertemuanKe;
    }

    /**
     * Relationship: Periode kepengurusan
     */
    public function periode()
    {
        return $this->belongsTo(PeriodeKepengurusan::class, 'periode_id');
    }

    /**
     * Get label status program kerja
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'draft' => 'Draft',
            'aktif' => 'Aktif',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Get badge color untuk status
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'draft' => 'secondary',
            'aktif' => 'success',
            'selesai' => 'info',
            'dibatalkan' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Update status program kerja berdasarkan jumlah pertemuan
     * Otomatis mengubah status menjadi 'selesai' jika semua pertemuan sudah selesai
     */
    public function updateStatusBasedOnPertemuan(): void
    {
        // Hanya update jika program kerja memiliki frekuensi_kegiatan
        if (!$this->frekuensi_kegiatan) {
            return;
        }

        // Refresh untuk mendapatkan jumlah pertemuan terbaru
        $this->refresh();
        $jumlahPertemuan = $this->jumlah_pertemuan;

        // Jika jumlah pertemuan sudah mencapai atau melebihi frekuensi_kegiatan
        if ($jumlahPertemuan >= $this->frekuensi_kegiatan) {
            // Update status menjadi 'selesai' jika statusnya bukan 'dibatalkan'
            if ($this->status !== 'dibatalkan') {
                $this->update(['status' => 'selesai']);
            }
        } else {
            // Jika jumlah pertemuan belum mencapai frekuensi_kegiatan
            // Ubah kembali ke 'aktif' jika statusnya 'selesai' (karena ada pertemuan yang dihapus)
            if ($this->status === 'selesai' && $jumlahPertemuan < $this->frekuensi_kegiatan) {
                $this->update(['status' => 'aktif']);
            }
        }
    }
}
