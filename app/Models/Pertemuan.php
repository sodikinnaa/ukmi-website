<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuan';

    protected $fillable = [
        'program_kerja_id',
        'pertemuan_ke',
        'tanggal',
        'deskripsi',
        'foto_kegiatan',
        'foto_absen',
        'total_peserta',
        'lokasi_kegiatan',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    /**
     * Relationship: Program kerja
     */
    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_kerja_id');
    }

    /**
     * Relationship: User yang membuat pertemuan
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship: Absensi pertemuan ini
     */
    public function absensi()
    {
        return Absensi::where('program_kerja_id', $this->program_kerja_id)
            ->where('pertemuan_ke', $this->pertemuan_ke);
    }

    /**
     * Relationship: Dokumentasi pertemuan ini
     */
    public function dokumentasi()
    {
        return Dokumentasi::where('program_kerja_id', $this->program_kerja_id)
            ->where('pertemuan_ke', $this->pertemuan_ke);
    }
}

