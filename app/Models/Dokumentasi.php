<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi';

    protected $fillable = [
        'program_kerja_id',
        'foto_dokumentasi',
        'deskripsi',
        'tanggal_kegiatan',
        'pertemuan_ke',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kegiatan' => 'date',
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
     * Relationship: User yang upload
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
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
