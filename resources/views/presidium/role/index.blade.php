@extends('layouts.tabler')

@section('title', 'Manajemen Role')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('header-actions')
    <a href="{{ route('presidium.role.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
        Tambah Role
    </a>
@endsection

@section('content')
<div class="row row-deck row-cards">
    <!-- Ketentuan Role Sistem -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ketentuan Role Sistem</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="border rounded p-3 mb-3">
                            <h4 class="mb-3">
                                <span class="badge bg-blue me-2">Presidium</span>
                                Akses Jabatan
                            </h4>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Ketua
                                </li>
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Wakil
                                </li>
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Bendahara
                                </li>
                                <li class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Sekretaris
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 mb-3">
                            <h4 class="mb-3">
                                <span class="badge bg-green me-2">Kabid</span>
                                Akses Jabatan
                            </h4>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Ketua
                                </li>
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Sekretaris
                                </li>
                                <li class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Bendahara
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mb-0">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 9v2m0 4v.01" />
                                <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                            </svg>
                        </div>
                        <div>
                            <strong>Catatan:</strong> Role sistem (Presidium dan Kabid) memiliki struktur jabatan yang telah ditentukan. Pastikan setiap user dengan role tersebut memiliki jabatan yang sesuai dengan ketentuan di atas. Setiap user dengan jabatan tertentu dapat ditambahkan ke kategori biro yang sesuai melalui menu Kategori Biro.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Daftar Role -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Role</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th>LABEL</th>
                                <th>DESKRIPSI</th>
                                <th>JUMLAH USER</th>
                                <th>TIPE</th>
                                <th class="w-1">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td><strong>{{ $role->name }}</strong></td>
                                    <td>{{ $role->label }}</td>
                                    <td>{{ $role->description ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-blue">{{ $role->users_count }}</span>
                                    </td>
                                    <td>
                                        @if($role->is_system)
                                            <span class="badge bg-green">Sistem</span>
                                        @else
                                            <span class="badge bg-secondary">Custom</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('presidium.role.show', $role) }}" class="btn btn-sm btn-info" title="Kelola Permission">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                                            </a>
                                            @if(!$role->is_system)
                                                <a href="{{ route('presidium.role.edit', $role) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                </a>
                                                <form action="{{ route('presidium.role.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus role ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada role</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

