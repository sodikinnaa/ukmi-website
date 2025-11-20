@extends('layouts.tabler')

@section('title', 'Kelola Permission - ' . $role->label)

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
    $menuGroupMap = [
        'presidium' => 'Presidium',
        'kabid' => 'Kabid',
        'kader' => 'Kader',
        'pembina' => 'Pembina',
    ];
    $dashboardDescriptions = [
        'presidium.dashboard' => 'Dashboard khusus Presidium untuk memantau aktivitas organisasi dan progres program kerja.',
        'kabid.dashboard' => 'Dashboard Ketua Bidang untuk melihat program dan kebutuhan kolaborasi lintas biro.',
        'kader.dashboard' => 'Dashboard Kader yang menampilkan agenda dan tugas pribadi.',
        'pembina.dashboard' => 'Dashboard Pembina untuk supervisi laporan dan periode kepengurusan.',
    ];
@endphp

@section('content')
<div class="row row-deck row-cards">
    <!-- Info Role dan Permission Aktif -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Role: {{ $role->label }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-transparent">
                            <tr>
                                <th width="40%">Nama Role</th>
                                <td><strong>{{ $role->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Label</th>
                                <td>{{ $role->label }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $role->description ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tipe</th>
                                <td>
                                    @if($role->is_system)
                                        <span class="badge bg-green">Sistem</span>
                                    @else
                                        <span class="badge bg-secondary">Custom</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah User</th>
                                <td><span class="badge bg-blue">{{ $role->users()->count() }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4>Permission Aktif ({{ count($rolePermissions) }})</h4>
                        @if(count($rolePermissions) > 0)
                            <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                                @foreach($role->permissions as $permission)
                                    <div class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                            <div class="flex-fill">
                                                <div class="fw-bold">{{ $permission->label }}</div>
                                                <small class="text-muted">{{ $permission->name }}</small>
                                                @if($permission->menuItem)
                                                    <div class="mt-1">
                                                        <span class="badge bg-info">{{ $permission->menuItem->label }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning mb-0">
                                <p class="mb-0">Belum ada permission yang diberikan untuk role ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Form Pengaturan Permission -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kelola Permission untuk Role: {{ $role->label }}</h3>
                <div class="card-actions">
                    <a href="{{ route('presidium.role.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible mx-3 mt-3" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                        </div>
                        <div>
                            {{ session('success') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible mx-3 mt-3" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                        </div>
                        <div>
                            {{ session('error') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <form action="{{ route('presidium.role.permissions.update', $role) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted">Pilih menu yang dapat diakses oleh role <strong>{{ $role->label }}</strong></p>
                        <div class="alert alert-info">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                                </div>
                                <div>
                                    <strong>Info:</strong> Permission yang dipilih akan menentukan menu yang dapat diakses oleh user dengan role <strong>{{ $role->label }}</strong>. 
                                    Saat ini role ini memiliki <strong>{{ count($rolePermissions) }}</strong> permission yang aktif.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($menuItems->count() > 0)
                        <div class="row">
                            @foreach($menuItems as $menu)
                                @php
                                    $menuPermission = $menu->permissions->first();
                                @endphp
                                @if($menuPermission)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                @php
                                                    $menuPrefix = str_contains($menu->name, '.') ? explode('.', $menu->name)[0] : $menu->name;
                                                    $menuGroupLabel = $menuGroupMap[$menuPrefix] ?? ucfirst($menuPrefix);
                                                    $menuDescription = $dashboardDescriptions[$menu->route] ?? null;
                                                @endphp
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        name="permissions[]" 
                                                        value="{{ $menuPermission->id }}"
                                                        id="menu_{{ $menu->id }}"
                                                        {{ in_array($menuPermission->id, $rolePermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-bold" for="menu_{{ $menu->id }}">
                                                        {!! $menu->icon !!}
                                                        <span class="ms-2">{{ $menu->label }}</span>
                                                        <span class="badge bg-blue ms-2 text-uppercase">{{ $menuGroupLabel }}</span>
                                                    </label>
                                                    @if($menuDescription)
                                                        <div class="text-muted small mt-1">{{ $menuDescription }}</div>
                                                    @endif
                                                </div>
                                                
                                                @if($menu->children->count() > 0)
                                                    <div class="ms-4 mt-2">
                                                        @foreach($menu->children as $child)
                                                            @php
                                                                $childPermission = $child->permissions->first();
                                                            @endphp
                                                            @if($childPermission)
                                                                @php
                                                                    $childPrefix = str_contains($child->name, '.') ? explode('.', $child->name)[0] : $child->name;
                                                                    $childGroupLabel = $menuGroupMap[$childPrefix] ?? ucfirst($childPrefix);
                                                                    $childDescription = $dashboardDescriptions[$child->route] ?? null;
                                                                @endphp
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" 
                                                                        name="permissions[]" 
                                                                        value="{{ $childPermission->id }}"
                                                                        id="menu_{{ $child->id }}"
                                                                        {{ in_array($childPermission->id, $rolePermissions) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="menu_{{ $child->id }}">
                                                                        {!! $child->icon !!}
                                                                        <span class="ms-2">{{ $child->label }}</span>
                                                                        <span class="badge bg-blue ms-2 text-uppercase">{{ $childGroupLabel }}</span>
                                                                    </label>
                                                                    @if($childDescription)
                                                                        <div class="text-muted small ms-1">{{ $childDescription }}</div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                                </div>
                                <div>
                                    <strong>Peringatan:</strong> Belum ada menu yang tersedia. Pastikan MenuItemSeeder sudah dijalankan.
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                        Simpan Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

