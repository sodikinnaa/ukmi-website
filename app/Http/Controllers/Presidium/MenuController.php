<?php

namespace App\Http\Controllers\Presidium;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Permission;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar menu items
     */
    public function index()
    {
        $menuItems = MenuItem::whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();
        
        return view('presidium.menu.index', compact('menuItems'));
    }

    /**
     * Menampilkan form tambah menu
     */
    public function create()
    {
        $parentMenus = MenuItem::whereNull('parent_id')->orderBy('label')->get();
        
        return view('presidium.menu.create', compact('parentMenus'));
    }

    /**
     * Menyimpan menu baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:menu_items,name',
            'label' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:menu_items,id',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menuItem = MenuItem::create($validated);

        // Buat permission otomatis untuk menu ini
        Permission::create([
            'name' => $menuItem->name . '.access',
            'label' => 'Akses ' . $menuItem->label,
            'menu_item_id' => $menuItem->id,
            'description' => 'Permission untuk mengakses menu ' . $menuItem->label,
        ]);

        return redirect()->route('presidium.menu.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit menu
     */
    public function edit(MenuItem $menu)
    {
        $parentMenus = MenuItem::whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->orderBy('label')
            ->get();
        
        return view('presidium.menu.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update menu
     */
    public function update(Request $request, MenuItem $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:menu_items,name,' . $menu->id,
            'label' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:menu_items,id',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect()->route('presidium.menu.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Hapus menu
     */
    public function destroy(MenuItem $menu)
    {
        if ($menu->children()->count() > 0) {
            return redirect()->route('presidium.menu.index')
                ->with('error', 'Menu tidak dapat dihapus karena masih memiliki submenu.');
        }

        $menu->delete();

        return redirect()->route('presidium.menu.index')
            ->with('success', 'Menu berhasil dihapus.');
    }
}

