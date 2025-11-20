<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'program_kerja_id',
        'kader_id',
        'tanggal',
        'pertemuan_ke',
        'status',
        'keterangan',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    /**
     * Get label status
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'hadir' => 'Hadir',
            'izin' => 'Izin',
            'sakit' => 'Sakit',
            'alpha' => 'Alpha',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Relationship: Program kerja
     */
    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_kerja_id');
    }

    /**
     * Relationship: Kader
     */
    public function kader()
    {
        return $this->belongsTo(User::class, 'kader_id');
    }

    /**
     * Relationship: User yang membuat absensi
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship: Pertemuan (melalui program_kerja_id dan pertemuan_ke)
     */
    public function pertemuan()
    {
        return $this->hasOne(Pertemuan::class, 'program_kerja_id', 'program_kerja_id')
            ->where('pertemuan_ke', $this->pertemuan_ke);
    }
}
