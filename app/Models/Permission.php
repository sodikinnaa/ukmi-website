<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'menu_item_id',
        'description',
    ];

    /**
     * Relationship: Menu item yang terkait
     */
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

    /**
     * Relationship: Roles yang memiliki permission ini
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id')
            ->withTimestamps();
    }
}

