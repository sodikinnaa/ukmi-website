<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'route',
        'icon',
        'order',
        'parent_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relationship: Parent menu (untuk submenu)
     */
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Relationship: Child menus (submenu)
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    /**
     * Relationship: Permissions yang terkait dengan menu ini
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'menu_item_id');
    }
}

