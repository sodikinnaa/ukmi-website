@extends('layouts.tabler')

@section('title', 'Manajemen User')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('header-actions')
    <div class="btn-list">
        <a href="{{ route('presidium.user.export') }}" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11v6" /><path d="M9 14l3 -3l3 3" /></svg>
            Export
        </a>
        <a href="{{ route('presidium.user.download-template') }}" class="btn btn-info">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11v6" /><path d="M9 14l3 -3l3 3" /></svg>
            Download Template
        </a>
        <a href="{{ route('presidium.user.import') }}" class="btn btn-warning">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11v6" /><path d="M9 14l3 3l3 -3" /></svg>
            Import
        </a>
        <a href="{{ route('presidium.user.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Tambah User
        </a>
    </div>
@endsection

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manajemen User</h3>
                <div class="card-actions">
                    <form method="GET" action="{{ route('presidium.user.index') }}" id="filterForm" class="d-flex align-items-center gap-2 flex-wrap">
                        <input type="text" 
                               name="search" 
                               id="searchInput" 
                               class="form-control form-control-sm" 
                               placeholder="Cari nama, email, atau NPM..." 
                               value="{{ request('search') }}"
                               style="width: auto; min-width: 250px;">
                        <select name="role_id" id="roleFilter" class="form-select form-select-sm" style="width: auto; min-width: 200px;">
                            <option value="">Semua Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ request('role_id') == (string)$role->id ? 'selected' : '' }}>
                                    {{ $role->label }}
                                </option>
                            @endforeach
                        </select>
                        <select name="periode_id" id="periodeFilter" class="form-select form-select-sm" style="width: auto; min-width: 200px;">
                            <option value="">Semua Periode</option>
                            @foreach($periodeList as $periode)
                                <option value="{{ $periode->id }}" {{ request('periode_id') == (string)$periode->id ? 'selected' : '' }}>
                                    {{ $periode->nama_periode }}
                                    @if($periode->is_aktif)
                                        (Aktif)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if(request('search') || request('role_id') || request('periode_id'))
                            <a href="{{ route('presidium.user.index') }}" class="btn btn-sm btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                                Reset
                            </a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if(request('search') || request('role_id') || request('periode_id'))
                    <div class="mb-3">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="text-muted">Filter Aktif:</span>
                            @if(request('search'))
                                <span class="badge bg-info">
                                    Pencarian: "{{ request('search') }}"
                                </span>
                            @endif
                            @if(request('role_id'))
                                <span class="badge bg-blue">
                                    Role: {{ $roles->firstWhere('id', (int)request('role_id'))->label ?? 'Role tidak ditemukan' }}
                                </span>
                            @endif
                            @if(request('periode_id'))
                                <span class="badge bg-purple">
                                    Periode: {{ $periodeList->firstWhere('id', (int)request('periode_id'))->nama_periode ?? 'Periode tidak ditemukan' }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>FOTO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>JURUSAN</th>
                                <th>NPM</th>
                                <th>JENIS KELAMIN</th>
                                <th>PERIODE</th>
                                <th>STATUS</th>
                                <th class="w-1">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $userItem)
                                <tr>
                                    <td>
                                        <x-avatar :user="$userItem" size="sm" />
                                    </td>
                                    <td><strong>{{ $userItem->name }}</strong></td>
                                    <td>{{ $userItem->email }}</td>
                                    <td>
                                        <span class="badge bg-blue">{{ $userItem->roleModel?->label ?? '-' }}</span>
                                    </td>
                                    <td>{{ $userItem->jurusan ?? '-' }}</td>
                                    <td>{{ $userItem->npm ?? '-' }}</td>
                                    <td>
                                        @if($userItem->jenis_kelamin)
                                            <span class="badge bg-{{ $userItem->jenis_kelamin == 'L' ? 'blue' : 'pink' }}">
                                                {{ $userItem->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            // Pastikan relasi dimuat
                                            if (!$userItem->relationLoaded('roleModel')) {
                                                $userItem->load('roleModel');
                                            }
                                            
                                            $periodeList = collect();
                                            if ($userItem->roleModel) {
                                                // Load relasi periode berdasarkan role
                                                if ($userItem->roleModel->name === 'kader') {
                                                    if (!$userItem->relationLoaded('periodeKader')) {
                                                        $userItem->load('periodeKader');
                                                    }
                                                    $periodeList = $userItem->periodeKader;
                                                } elseif ($userItem->roleModel->name === 'kabid') {
                                                    if (!$userItem->relationLoaded('periodeKabid')) {
                                                        $userItem->load('periodeKabid');
                                                    }
                                                    $periodeList = $userItem->periodeKabid;
                                                } elseif ($userItem->roleModel->name === 'presidium') {
                                                    if (!$userItem->relationLoaded('periodePresidium')) {
                                                        $userItem->load('periodePresidium');
                                                    }
                                                    $periodeList = $userItem->periodePresidium;
                                                }
                                            }
                                        @endphp
                                        @if($periodeList && $periodeList->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($periodeList as $periode)
                                                    <span class="badge bg-info" title="{{ $periode->nama_periode }}">
                                                        {{ $periode->nama_periode }}
                                                        @if($periode->is_aktif)
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs ms-1" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M5 12l5 5l10 -10" />
                                                            </svg>
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $userItem->status_badge_color }}">{{ $userItem->status_label }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('presidium.user.show', $userItem) }}" class="btn btn-sm btn-info" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                            </a>
                                            <a href="{{ route('presidium.user.edit', $userItem) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                            <form action="{{ route('presidium.user.destroy', $userItem) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada data user</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($users->hasPages())
                    <div class="card-footer">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="text-muted">
                                Menampilkan <strong>{{ $users->firstItem() ?? 0 }}</strong> sampai <strong>{{ $users->lastItem() ?? 0 }}</strong> dari <strong>{{ $users->total() }}</strong> data
                            </div>
                            <div>
                                {{ $users->links('vendor.pagination.tabler') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleFilter = document.getElementById('roleFilter');
        const periodeFilter = document.getElementById('periodeFilter');
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        
        // Auto-submit saat filter role berubah
        if (roleFilter && filterForm) {
            roleFilter.addEventListener('change', function() {
                filterForm.submit();
            });
        }
        
        // Auto-submit saat filter periode berubah
        if (periodeFilter && filterForm) {
            periodeFilter.addEventListener('change', function() {
                filterForm.submit();
            });
        }
        
        // Auto-submit saat search dengan delay (debounce)
        if (searchInput && filterForm) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    // Hanya submit jika search tidak kosong atau sudah pernah diisi
                    if (this.value.length >= 2 || this.value.length === 0) {
                        filterForm.submit();
                    }
                }.bind(this), 500); // Delay 500ms setelah user berhenti mengetik
            });
            
            // Submit saat Enter ditekan
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    filterForm.submit();
                }
            });
        }
    });
</script>
@endpush
@endsection
