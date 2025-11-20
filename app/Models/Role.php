<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'description',
        'is_system',
    ];

    protected function casts(): array
    {
        return [
            'is_system' => 'boolean',
        ];
    }

    /**
     * Relationship: Users dengan role ini
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relationship: Permissions yang dimiliki role
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id')
            ->withTimestamps();
    }

    /**
     * Cek apakah role memiliki permission tertentu
     */
    public function hasPermission(string $permissionName): bool
    {
        // Jika permissions sudah di-load, gunakan collection (lebih cepat)
        if ($this->relationLoaded('permissions')) {
            return $this->permissions->contains('name', $permissionName);
        }
        
        // Jika belum di-load, gunakan query
        return $this->permissions()->where('name', $permissionName)->exists();
    }

    /**
     * Cek apakah role memiliki akses ke menu tertentu
     */
    public function hasMenuAccess(string $menuName): bool
    {
        // Jika permissions sudah di-load dengan menuItem, gunakan collection
        if ($this->relationLoaded('permissions')) {
            return $this->permissions->contains(function($permission) use ($menuName) {
                return $permission->menuItem && $permission->menuItem->name === $menuName;
            });
        }
        
        // Jika belum di-load, gunakan query
        return $this->permissions()
            ->whereHas('menuItem', function($query) use ($menuName) {
                $query->where('name', $menuName);
            })
            ->exists();
    }
}

