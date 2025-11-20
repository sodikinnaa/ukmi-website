<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuItem;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     * Mengecek apakah user memiliki permission untuk mengakses route berdasarkan route name
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $routeName = $request->route()->getName();
        
        // Load roleModel dengan permissions
        if (!$user->relationLoaded('roleModel')) {
            $user->load('roleModel');
        }
        
        if (!$user->roleModel) {
            abort(403, 'Akses ditolak. Role tidak ditemukan.');
        }
        
        // Load permissions jika belum di-load
        if (!$user->roleModel->relationLoaded('permissions')) {
            $user->roleModel->load('permissions.menuItem');
        }
        
        // Cari menu item berdasarkan route name
        // Pertama coba exact match dengan route
        $menuItem = MenuItem::where('route', $routeName)
            ->where('is_active', true)
            ->with('permissions')
            ->first();
        
        // Jika tidak ditemukan exact match, coba cari berdasarkan name (prefix)
        // Misalnya: presidium.user.index -> cari menu dengan name presidium.user
        if (!$menuItem && str_contains($routeName, '.')) {
            $routeParts = explode('.', $routeName);
            // Coba berbagai kombinasi prefix, mulai dari yang terpanjang
            for ($i = count($routeParts) - 1; $i >= 1; $i--) {
                $prefix = implode('.', array_slice($routeParts, 0, $i));
                
                // Coba cari berdasarkan name (lebih umum)
                $menuItem = MenuItem::where('name', $prefix)
                    ->where('is_active', true)
                    ->with('permissions')
                    ->first();
                
                if ($menuItem) {
                    break;
                }
                
                // Jika tidak ditemukan berdasarkan name, coba berdasarkan route
                $menuItem = MenuItem::where('route', $prefix)
                    ->where('is_active', true)
                    ->with('permissions')
                    ->first();
                
                if ($menuItem) {
                    break;
                }
            }
        }
        
        if (!$menuItem) {
            // Jika menu item tidak ditemukan, cek apakah route adalah bagian dari presidium
            // dan user memiliki role presidium (fallback untuk backward compatibility)
            if (str_starts_with($routeName, 'presidium.')) {
                if ($user->role === 'presidium') {
                    return $next($request);
                }
            }
            
            // Jika tidak ada menu item dan bukan presidium route, tolak akses
            abort(403, 'Akses ditolak. Menu tidak ditemukan atau tidak aktif.');
        }
        
        // Cek apakah user memiliki permission untuk menu ini
        $menuPermission = $menuItem->permissions->first();
        
        if (!$menuPermission) {
            // Jika menu tidak memiliki permission, tolak akses
            abort(403, 'Akses ditolak. Menu tidak memiliki permission yang valid.');
        }
        
        // Cek apakah user memiliki permission ini
        if (!$user->hasPermission($menuPermission->name)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}

