<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBiro extends Model
{
    use HasFactory;

    protected $table = 'kategori_biro';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'is_aktif',
    ];

    protected function casts(): array
    {
        return [
            'is_aktif' => 'boolean',
        ];
    }

    /**
     * Relationship: Program kerja dalam kategori biro ini
     */
    public function programKerja()
    {
        return $this->hasMany(ProgramKerja::class, 'kategori_biro_id');
    }

    /**
     * Relationship: Kader di kategori biro ini (many-to-many)
     */
    public function kader()
    {
        return $this->belongsToMany(User::class, 'kader_biro', 'kategori_biro_id', 'kader_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Kabid di kategori biro ini (many-to-many)
     */
    public function kabid()
    {
        return $this->belongsToMany(User::class, 'kategori_biro_kabid', 'kategori_biro_id', 'kabid_id')
            ->withPivot('periode_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Kabid di kategori biro ini untuk periode tertentu
     */
    public function kabidPeriode($periodeId)
    {
        return $this->belongsToMany(User::class, 'kategori_biro_kabid', 'kategori_biro_id', 'kabid_id')
            ->wherePivot('periode_id', $periodeId)
            ->withPivot('periode_id')
            ->withTimestamps();
    }

    /**
     * Scope: Kategori biro aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}

