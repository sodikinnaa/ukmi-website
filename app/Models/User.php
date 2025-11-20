<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'jabatan',
        'foto_profile',
        'nomor_wa',
        'jurusan',
        'npm',
        'jenis_kelamin',
        'hobi',
        'alamat',
        'status_aktif',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status_aktif' => 'boolean',
        ];
    }

    /**
     * Relationship: Role user
     */
    public function roleModel()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get role name (backward compatibility)
     */
    public function getRoleAttribute(): ?string
    {
        return $this->roleModel?->name;
    }

    /**
     * Cek apakah user adalah Presidium
     */
    public function isPresidium(): bool
    {
        return $this->role === 'presidium';
    }

    /**
     * Cek apakah user adalah Kabid
     */
    public function isKabid(): bool
    {
        return $this->role === 'kabid';
    }

    /**
     * Cek apakah user adalah Kader
     */
    public function isKader(): bool
    {
        return $this->role === 'kader';
    }

    /**
     * Cek apakah user adalah Pembina
     */
    public function isPembina(): bool
    {
        return $this->role === 'pembina';
    }

    /**
     * Relationship: Periode kepengurusan dimana user menjadi presidium
     */
    public function periodePresidium()
    {
        return $this->belongsToMany(PeriodeKepengurusan::class, 'periode_presidium', 'presidium_id', 'periode_id')
            ->withTimestamps();
    }

    /**
     * Get role label dalam bahasa Indonesia
     */
    public function getRoleLabelAttribute(): string
    {
        return $this->roleModel?->label ?? 'Tidak Diketahui';
    }

    /**
     * Get inisial nama untuk avatar default
     */
    public function getInitialsAttribute(): string
    {
        $name = trim($this->name);
        $words = explode(' ', $name);
        
        if (count($words) >= 2) {
            // Ambil huruf pertama dari kata pertama dan kedua
            return strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
        } else {
            // Jika hanya satu kata, ambil 2 huruf pertama
            return strtoupper(substr($name, 0, 2));
        }
    }

    /**
     * Get warna background untuk avatar berdasarkan inisial
     */
    public function getAvatarColorAttribute(): string
    {
        $colors = [
            '#206bc4', '#4299e1', '#2fb344', '#d63939', '#f59f00',
            '#fd7e14', '#ae3ec9', '#6c757d', '#0d6efd', '#198754',
            '#dc3545', '#ffc107', '#0dcaf0', '#6610f2', '#e91e63'
        ];
        
        $index = ord(strtoupper($this->initials[0])) % count($colors);
        return $colors[$index];
    }

    /**
     * Cek apakah user memiliki permission tertentu
     */
    public function hasPermission(string $permissionName): bool
    {
        if (!$this->roleModel) {
            return false;
        }
        
        // Pastikan permissions sudah di-load
        if (!$this->roleModel->relationLoaded('permissions')) {
            $this->roleModel->load('permissions');
        }
        
        // Cek apakah permission ada di collection (lebih cepat dari query)
        return $this->roleModel->permissions->contains('name', $permissionName);
    }

    /**
     * Cek apakah user memiliki akses ke menu tertentu
     */
    public function hasMenuAccess(string $menuName): bool
    {
        if (!$this->roleModel) {
            return false;
        }
        
        // Pastikan permissions sudah di-load dengan menuItem
        if (!$this->roleModel->relationLoaded('permissions')) {
            $this->roleModel->load('permissions.menuItem');
        }
        
        // Cek apakah ada permission yang terkait dengan menu ini
        return $this->roleModel->permissions->contains(function($permission) use ($menuName) {
            return $permission->menuItem && $permission->menuItem->name === $menuName;
        });
    }

    /**
     * Relationship: Periode kepengurusan dimana user menjadi kader
     */
    public function periodeKader()
    {
        return $this->belongsToMany(PeriodeKepengurusan::class, 'kader_periode', 'kader_id', 'periode_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Periode kepengurusan dimana user menjadi kabid
     * Menggunakan tabel yang sama dengan kader_periode karena strukturnya sama
     */
    public function periodeKabid()
    {
        return $this->belongsToMany(PeriodeKepengurusan::class, 'kader_periode', 'kader_id', 'periode_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Kategori biro yang diikuti kader
     */
    public function kategoriBiro()
    {
        return $this->belongsToMany(KategoriBiro::class, 'kader_biro', 'kader_id', 'kategori_biro_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Kategori biro yang dikelola kabid
     */
    public function kategoriBiroKabid()
    {
        return $this->belongsToMany(KategoriBiro::class, 'kategori_biro_kabid', 'kabid_id', 'kategori_biro_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Program kerja yang diikuti kader
     */
    public function programKerja()
    {
        return $this->belongsToMany(ProgramKerja::class, 'program_kader', 'kader_id', 'program_kerja_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Program kerja yang dikelola kabid
     */
    public function programKerjaKabid()
    {
        return $this->belongsToMany(ProgramKerja::class, 'program_kabid', 'kabid_id', 'program_kerja_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Absensi kader
     */
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'kader_id');
    }

    /**
     * Relationship: Dokumentasi yang diupload
     */
    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'uploaded_by');
    }

    /**
     * Relationship: Program kerja yang dibuat
     */
    public function programKerjaDibuat()
    {
        return $this->hasMany(ProgramKerja::class, 'created_by');
    }

    /**
     * Get label status user
     */
    public function getStatusLabelAttribute(): string
    {
        // Default true jika null (sesuai dengan default di migration)
        return ($this->status_aktif === null || $this->status_aktif) ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Get warna badge untuk status
     */
    public function getStatusBadgeColorAttribute(): string
    {
        // Default green jika null (sesuai dengan default di migration)
        return ($this->status_aktif === null || $this->status_aktif) ? 'green' : 'red';
    }
}
