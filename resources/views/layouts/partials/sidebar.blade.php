@php
    $user = Auth::user();
    $currentRoute = Route::currentRouteName() ?? '';
    
    // Load roleModel dengan permissions untuk permission checking
    if ($user) {
        if (!$user->relationLoaded('roleModel')) {
            $user->load('roleModel');
        }
        if ($user->roleModel && !$user->roleModel->relationLoaded('permissions')) {
            $user->roleModel->load('permissions.menuItem');
        }
        if ($user->isKabid() && !$user->relationLoaded('kategoriBiroKabid')) {
            $user->load('kategoriBiroKabid');
        }
    }
    
    // Get semua menu items aktif (akan difilter berdasarkan permission)
    $allMenuItems = \App\Models\MenuItem::where('is_active', true)
        ->whereNull('parent_id')
        ->with(['children' => function($query) {
            $query->where('is_active', true)
                  ->with('permissions')
                  ->orderBy('order');
        }, 'permissions'])
        ->orderBy('order')
        ->get();
@endphp

<aside class="navbar navbar-vertical navbar-expand-lg" id="sidebarMenu">
    <div class="container-fluid d-flex flex-column h-100 p-0">
        {{-- Header with close button for mobile --}}
        <div class="d-flex align-items-center justify-content-between d-lg-none" style="padding: 1rem 1.25rem; border-bottom: 1px solid rgba(var(--tblr-border-color-rgb), 0.1); min-height: 3.5rem; background: transparent;">
            <h1 class="navbar-brand navbar-brand-autodark mb-0">
                <a href="{{ route('dashboard') }}">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Logo_UKMI.png" width="90" height="28" alt="UKMI Ar-Rahman" class="navbar-brand-image" style="object-fit: contain;">
                </a>
            </h1>
            <button class="btn btn-link p-0 border-0" type="button" id="sidebarCloseBtn" aria-label="Close navigation" style="font-size: 1.5rem; line-height: 1; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; color: var(--tblr-body-color);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="collapse navbar-collapse flex-grow-1 show" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3 flex-column w-100">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute, 'presidium.dashboard') || str_starts_with($currentRoute, 'kabid.dashboard') || str_starts_with($currentRoute, 'kader.dashboard') || str_starts_with($currentRoute, 'pembina.dashboard') || $currentRoute === 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="nav-link-icon me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>
                
                {{-- Dynamic Menu berdasarkan Permission --}}
                @if($user && $user->roleModel)
                    @foreach($allMenuItems as $menuItem)
                        @php
                            $menuPermission = $menuItem->permissions->first();
                            $hasAccess = $menuPermission && $user->hasPermission($menuPermission->name);
                        @endphp
                        @if($hasAccess)
                            @php
                                // Check if menu is active (including sub menu) - dinamis
                                $menuIsActive = str_starts_with($currentRoute, $menuItem->name);
                                $hasActiveChild = false;
                                if ($menuItem->children->count() > 0) {
                                    // Check if any child is active (dinamis untuk semua role)
                                    foreach ($menuItem->children as $child) {
                                        $childPermission = $child->permissions->first();
                                        $childHasAccess = $childPermission && $user->hasPermission($childPermission->name);
                                        
                                        if ($childHasAccess) {
                                            if (str_starts_with($currentRoute, $child->name)) {
                                                $hasActiveChild = true;
                                                $menuIsActive = true;
                                                break;
                                            }
                                            // For user sub menu, check query parameter (dinamis untuk semua role)
                                            if ($menuItem->name === 'presidium.user' && str_contains($child->name, 'presidium.user.')) {
                                                // Extract role name dari child name (dinamis)
                                                $roleName = str_replace('presidium.user.', '', $child->name);
                                                $requestedRoleId = request('role_id');
                                                if ($requestedRoleId && str_starts_with($currentRoute, 'presidium.user')) {
                                                    $requestedRole = \App\Models\Role::find($requestedRoleId);
                                                    if ($requestedRole && $requestedRole->name === $roleName) {
                                                        $hasActiveChild = true;
                                                        $menuIsActive = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                
                                // Generate unique ID for collapse
                                $collapseId = 'submenu-' . str_replace('.', '-', $menuItem->name);
                                $shouldShow = $hasActiveChild || $menuIsActive;
                            @endphp
                            <li class="nav-item">
                                @if($menuItem->children->count() > 0)
                                    {{-- Menu dengan sub menu - bisa di-toggle --}}
                                    <a class="nav-link d-flex align-items-center {{ $menuIsActive ? 'active' : '' }}" 
                                       href="#"
                                       data-bs-toggle="collapse" 
                                       data-bs-target="#{{ $collapseId }}"
                                       aria-expanded="{{ $shouldShow ? 'true' : 'false' }}"
                                       aria-controls="{{ $collapseId }}"
                                       onclick="event.preventDefault();">
                                        <span class="nav-link-icon me-2">
                                            {!! $menuItem->icon !!}
                                        </span>
                                        <span class="nav-link-title">{{ $menuItem->label }}</span>
                                        @if($user->isKabid() && $menuItem->name === 'kabid.program-kerja' && $user->kategoriBiroKabid && $user->kategoriBiroKabid->count() > 0)
                                            <span class="badge bg-blue ms-2">
                                                {{ $user->kategoriBiroKabid->pluck('nama')->join(', ') }}
                                            </span>
                                        @endif
                                        <span class="nav-link-arrow ms-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M9 6l6 6l-6 6" />
                                            </svg>
                                        </span>
                                    </a>
                                    {{-- Submenu dengan collapse --}}
                                    <div class="collapse {{ $shouldShow ? 'show' : '' }}" id="{{ $collapseId }}">
                                        <ul class="nav nav-sub">
                                            @foreach($menuItem->children as $child)
                                                @php
                                                    $childPermission = $child->permissions->first();
                                                    $childHasAccess = $childPermission && $user->hasPermission($childPermission->name);
                                                    
                                                    // Untuk sub menu user, tambahkan query parameter role_id (dinamis berdasarkan role)
                                                    $childUrl = '#';
                                                    if ($child->route && $childHasAccess) {
                                                        try {
                                                            if (Route::has($child->route)) {
                                                                if ($menuItem->name === 'presidium.user' && str_contains($child->name, 'presidium.user.')) {
                                                                    // Extract role name dari child name (presidium.user.{role_name} -> {role_name})
                                                                    $roleName = str_replace('presidium.user.', '', $child->name);
                                                                    $role = \App\Models\Role::where('name', $roleName)->first();
                                                                    if ($role) {
                                                                        // Gunakan URL dengan query parameter
                                                                        $childUrl = route($child->route) . '?role_id=' . $role->id;
                                                                    } else {
                                                                        $childUrl = route($child->route);
                                                                    }
                                                                } else {
                                                                    $childUrl = route($child->route);
                                                                }
                                                            }
                                                        } catch (\Exception $e) {
                                                            // Route tidak ditemukan, gunakan #
                                                            $childUrl = '#';
                                                        }
                                                    }
                                                    
                                                    // Check if this sub menu is active (dinamis berdasarkan role)
                                                    $isActive = false;
                                                    if ($childHasAccess) {
                                                        if (str_starts_with($currentRoute, $child->name)) {
                                                            $isActive = true;
                                                        } elseif ($menuItem->name === 'presidium.user' && str_contains($child->name, 'presidium.user.')) {
                                                            // Dinamis: cek berdasarkan role name dari child name
                                                            $roleName = str_replace('presidium.user.', '', $child->name);
                                                            $requestedRoleId = request('role_id');
                                                            if ($requestedRoleId) {
                                                                $requestedRole = \App\Models\Role::find($requestedRoleId);
                                                                if ($requestedRole && $requestedRole->name === $roleName) {
                                                                    $isActive = true;
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                @if($childHasAccess)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ $isActive ? 'active' : '' }}" 
                                                           href="{{ $childUrl }}">
                                                            <span class="nav-link-title">{{ $child->label }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    {{-- Menu tanpa sub menu --}}
                                    @php
                                        $menuUrl = '#';
                                        if ($menuItem->route) {
                                            try {
                                                if (Route::has($menuItem->route)) {
                                                    $menuUrl = route($menuItem->route);
                                                }
                                            } catch (\Exception $e) {
                                                // Route tidak ditemukan, gunakan #
                                                $menuUrl = '#';
                                            }
                                        }
                                    @endphp
                                    <a class="nav-link d-flex align-items-center {{ $menuIsActive ? 'active' : '' }}" 
                                       href="{{ $menuUrl }}">
                                        <span class="nav-link-icon me-2">
                                            {!! $menuItem->icon !!}
                                        </span>
                                        <span class="nav-link-title">{{ $menuItem->label }}</span>
                                        @if($user->isKabid() && $menuItem->name === 'kabid.program-kerja' && $user->kategoriBiroKabid && $user->kategoriBiroKabid->count() > 0)
                                            <span class="badge bg-blue ms-2">
                                                {{ $user->kategoriBiroKabid->pluck('nama')->join(', ') }}
                                            </span>
                                        @endif
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endforeach
                @else
                    {{-- Fallback ke menu berdasarkan role jika tidak ada permission atau roleModel --}}
                    @if($user && $user->isPresidium())
                        @include('layouts.partials.menu.presidium')
                    @elseif($user && $user->isKabid())
                        @include('layouts.partials.menu.kabid')
                    @elseif($user && $user->isKader())
                        @include('layouts.partials.menu.kader')
                    @elseif($user && $user->isPembina())
                        @include('layouts.partials.menu.pembina')
                    @endif
                @endif

                {{-- Logout (at the bottom) --}}
                <li class="nav-item mt-auto" style="border-top: 1px solid rgba(var(--tblr-border-color-rgb), 0.1); margin-top: auto !important;">
                    <form action="{{ route('logout') }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="nav-link d-flex align-items-center w-100 text-start border-0 bg-transparent" style="padding: 0.75rem 1.25rem; color: var(--tblr-body-color) !important;">
                            <span class="nav-link-icon me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M9 12h12l-3 -3" />
                                    <path d="M18 15l3 -3" />
                                </svg>
                            </span>
                            <span class="nav-link-title">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
