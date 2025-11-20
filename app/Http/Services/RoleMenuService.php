<?php

namespace App\Http\Services;

use App\Models\Role;
use App\Models\MenuItem;
use App\Models\Permission;

class RoleMenuService
{
    /**
     * Membuat menu item dan permission untuk role baru di Manajemen User
     */
    public static function createRoleMenu(Role $role): void
    {
        // Cari parent menu "Manajemen User"
        $userMenuParent = MenuItem::where('name', 'presidium.user')->first();
        
        if (!$userMenuParent) {
            \Log::warning('Parent menu presidium.user tidak ditemukan');
            return;
        }

        // Cek apakah menu item sudah ada
        $menuItemName = 'presidium.user.' . $role->name;
        $existingMenuItem = MenuItem::where('name', $menuItemName)->first();
        
        if ($existingMenuItem) {
            // Jika sudah ada, update label saja
            $existingMenuItem->update([
                'label' => $role->label ?? ucfirst($role->name),
            ]);
            return;
        }

        // Get order terakhir untuk sub menu
        $lastOrder = MenuItem::where('parent_id', $userMenuParent->id)
            ->max('order') ?? 0;

        // Buat menu item baru
        $menuItem = MenuItem::create([
            'name' => $menuItemName,
            'label' => $role->label ?? ucfirst($role->name),
            'route' => 'presidium.user.index',
            'icon' => '',
            'order' => $lastOrder + 1,
            'parent_id' => $userMenuParent->id,
            'is_active' => true,
        ]);

        // Buat permission untuk menu item
        $permission = Permission::create([
            'name' => $menuItemName . '.access',
            'label' => 'Akses ' . ($role->label ?? ucfirst($role->name)) . ' (Manajemen User)',
            'menu_item_id' => $menuItem->id,
            'description' => 'Permission untuk mengakses menu ' . ($role->label ?? ucfirst($role->name)) . ' di Manajemen User',
        ]);

        // Assign permission ke role presidium (jika ada)
        $presidiumRole = Role::where('name', 'presidium')->first();
        if ($presidiumRole) {
            // Reload permissions untuk memastikan tidak ada duplikasi
            $presidiumRole->load('permissions');
            if (!$presidiumRole->permissions->contains($permission->id)) {
                $presidiumRole->permissions()->attach($permission->id);
            }
        }
    }

    /**
     * Menghapus menu item dan permission untuk role yang dihapus
     */
    public static function deleteRoleMenu(Role $role): void
    {
        $menuItemName = 'presidium.user.' . $role->name;
        $menuItem = MenuItem::where('name', $menuItemName)->first();
        
        if ($menuItem) {
            // Hapus permission terkait
            $permissionName = $menuItemName . '.access';
            Permission::where('name', $permissionName)->delete();
            
            // Hapus menu item
            $menuItem->delete();
        }
    }

    /**
     * Menghapus menu item berdasarkan role name (untuk update)
     */
    public static function deleteRoleMenuByName(string $roleName): void
    {
        $menuItemName = 'presidium.user.' . $roleName;
        $menuItem = MenuItem::where('name', $menuItemName)->first();
        
        if ($menuItem) {
            // Hapus permission terkait
            $permissionName = $menuItemName . '.access';
            Permission::where('name', $permissionName)->delete();
            
            // Hapus menu item
            $menuItem->delete();
        }
    }

    /**
     * Update label menu item ketika role diupdate
     */
    public static function updateRoleMenu(Role $role): void
    {
        $menuItemName = 'presidium.user.' . $role->name;
        $menuItem = MenuItem::where('name', $menuItemName)->first();
        
        if ($menuItem) {
            $menuItem->update([
                'label' => $role->label ?? ucfirst($role->name),
            ]);

            // Update permission label juga
            $permissionName = $menuItemName . '.access';
            Permission::where('name', $permissionName)->update([
                'label' => 'Akses ' . ($role->label ?? ucfirst($role->name)) . ' (Manajemen User)',
                'description' => 'Permission untuk mengakses menu ' . ($role->label ?? ucfirst($role->name)) . ' di Manajemen User',
            ]);
        }
    }
}

