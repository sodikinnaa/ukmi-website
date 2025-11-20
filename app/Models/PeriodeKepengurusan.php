<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeKepengurusan extends Model
{
    use HasFactory;

    protected $table = 'periode_kepengurusan';

    protected $fillable = [
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_aktif',
        'deskripsi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'is_aktif' => 'boolean',
        ];
    }

    /**
     * Relationship: Program kerja dalam periode ini
     */
    public function programKerja()
    {
        return $this->hasMany(ProgramKerja::class, 'periode_id');
    }

    /**
     * Relationship: Presidium di periode ini (many-to-many)
     */
    public function presidium()
    {
        return $this->belongsToMany(User::class, 'periode_presidium', 'periode_id', 'presidium_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Kader di periode ini (many-to-many)
     */
    public function kader()
    {
        return $this->belongsToMany(User::class, 'kader_periode', 'periode_id', 'kader_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Kabid di periode ini (many-to-many)
     * Menggunakan tabel kader_periode yang sama karena strukturnya sama
     */
    public function kabid()
    {
        return $this->belongsToMany(User::class, 'kader_periode', 'periode_id', 'kader_id')
            ->withTimestamps();
    }

    /**
     * Scope: Periode aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    /**
     * Get label status periode
     */
    public function getStatusLabelAttribute(): string
    {
        if ($this->is_aktif) {
            return 'Aktif';
        }
        
        if ($this->tanggal_selesai && $this->tanggal_selesai->isPast()) {
            return 'Selesai';
        }
        
        return 'Tidak Aktif';
    }
}

