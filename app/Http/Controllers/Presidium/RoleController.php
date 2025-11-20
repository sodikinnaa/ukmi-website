<?php

namespace App\Http\Controllers\Presidium;

use App\Http\Controllers\Controller;
use App\Http\Services\RoleMenuService;
use App\Models\Role;
use App\Models\Permission;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Menampilkan daftar role
     */
    public function index()
    {
        $roles = Role::withCount('users')->orderBy('name')->get();
        
        return view('presidium.role.index', compact('roles'));
    }

    /**
     * Menampilkan form tambah role
     */
    public function create()
    {
        return view('presidium.role.create');
    }

    /**
     * Menyimpan role baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $role = DB::transaction(function () use ($validated) {
            $role = Role::create($validated);

            // Buat menu item dan permission untuk role baru di Manajemen User
            RoleMenuService::createRoleMenu($role);
            
            return $role;
        });

        return redirect()->route('presidium.role.index')
            ->with('success', 'Role berhasil ditambahkan. Menu item otomatis dibuat di Manajemen User.');
    }

    /**
     * Menampilkan detail role dan permission
     */
    public function show(Role $role)
    {
        // Load permissions dengan menuItem
        $role->load(['permissions.menuItem', 'users']);
        
        // Get semua menu items aktif (parent menu)
        $menuItems = MenuItem::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => function($query) {
                $query->where('is_active', true)
                      ->with('permissions')
                      ->orderBy('order');
            }, 'permissions'])
            ->orderBy('order')
            ->get();
        
        // Get permission IDs yang sudah diberikan ke role ini
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return view('presidium.role.show', compact('role', 'menuItems', 'rolePermissions'));
    }

    /**
     * Menampilkan form edit role
     */
    public function edit(Role $role)
    {
        if ($role->is_system) {
            return redirect()->route('presidium.role.index')
                ->with('error', 'Role sistem tidak dapat diubah.');
        }

        return view('presidium.role.edit', compact('role'));
    }

    /**
     * Update role
     */
    public function update(Request $request, Role $role)
    {
        if ($role->is_system) {
            return redirect()->route('presidium.role.index')
                ->with('error', 'Role sistem tidak dapat diubah.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($role, $validated) {
            $oldName = $role->name;
            
            // Jika name berubah, hapus menu item lama dulu (sebelum update)
            if ($oldName !== $validated['name']) {
                RoleMenuService::deleteRoleMenuByName($oldName);
            }
            
            $role->update($validated);
            $role->refresh(); // Refresh untuk mendapatkan data terbaru

            // Jika name berubah, buat menu item baru dengan name yang baru
            if ($oldName !== $role->name) {
                RoleMenuService::createRoleMenu($role);
            } else {
                // Update label menu item jika hanya label yang berubah
                RoleMenuService::updateRoleMenu($role);
            }
        });

        return redirect()->route('presidium.role.index')
            ->with('success', 'Role berhasil diperbarui. Menu item otomatis diupdate di Manajemen User.');
    }

    /**
     * Hapus role
     */
    public function destroy(Role $role)
    {
        if ($role->is_system) {
            return redirect()->route('presidium.role.index')
                ->with('error', 'Role sistem tidak dapat dihapus.');
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('presidium.role.index')
                ->with('error', 'Role tidak dapat dihapus karena masih digunakan oleh user.');
        }

        // Hapus menu item dan permission terkait untuk role ini
        DB::transaction(function () use ($role) {
            // Hapus menu item dan permission terkait
            RoleMenuService::deleteRoleMenu($role);
            
            // Hapus relasi permission dari role
            $role->permissions()->detach();
            
            // Hapus role
            $role->delete();
        });

        return redirect()->route('presidium.role.index')
            ->with('success', 'Role berhasil dihapus.');
    }

    /**
     * Update permissions untuk role
     */
    public function updatePermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        try {
            $permissionIds = $validated['permissions'] ?? [];
            
            // Log untuk debugging
            \Log::info('Updating permissions for role', [
                'role_id' => $role->id,
                'role_name' => $role->name,
                'permission_ids' => $permissionIds,
                'permission_count' => count($permissionIds)
            ]);
            
            // Sync permissions (ini akan menghapus permission yang tidak dipilih dan menambahkan yang baru)
            $role->permissions()->sync($permissionIds);
            
            // Clear cache jika ada
            \Cache::forget("role_permissions_{$role->id}");
            
            // Reload role dengan permissions untuk verifikasi
            $role->refresh();
            $role->load('permissions');
            $syncedCount = $role->permissions->count();
            
            // Log hasil
            \Log::info('Permissions synced successfully', [
                'role_id' => $role->id,
                'synced_count' => $syncedCount,
                'permission_names' => $role->permissions->pluck('name')->toArray()
            ]);
            
            return redirect()->route('presidium.role.show', $role)
                ->with('success', "Permission berhasil diperbarui. Role {$role->label} sekarang memiliki {$syncedCount} permission aktif.");
        } catch (\Exception $e) {
            \Log::error('Error updating permissions', [
                'role_id' => $role->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('presidium.role.show', $role)
                ->with('error', 'Terjadi kesalahan saat memperbarui permission: ' . $e->getMessage());
        }
    }
}

