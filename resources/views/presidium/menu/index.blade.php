@extends('layouts.tabler')

@section('title', 'Manajemen Menu')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('header-actions')
    <a href="{{ route('presidium.menu.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
        Tambah Menu
    </a>
@endsection

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Menu</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th>LABEL</th>
                                <th>ROUTE</th>
                                <th>PARENT</th>
                                <th>URUTAN</th>
                                <th>STATUS</th>
                                <th class="w-1">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menuItems as $menu)
                                <tr>
                                    <td><strong>{{ $menu->name }}</strong></td>
                                    <td>{{ $menu->label }}</td>
                                    <td><code>{{ $menu->route ?? '-' }}</code></td>
                                    <td>{{ $menu->parent ? $menu->parent->label : '-' }}</td>
                                    <td>{{ $menu->order }}</td>
                                    <td>
                                        @if($menu->is_active)
                                            <span class="badge bg-green">Aktif</span>
                                        @else
                                            <span class="badge bg-red">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('presidium.menu.edit', $menu) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                            <form action="{{ route('presidium.menu.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @if($menu->children->count() > 0)
                                    @foreach($menu->children as $child)
                                        <tr>
                                            <td class="ps-4"><small>{{ $child->name }}</small></td>
                                            <td class="ps-4"><small>{{ $child->label }}</small></td>
                                            <td><code><small>{{ $child->route ?? '-' }}</small></code></td>
                                            <td><small>{{ $child->parent->label }}</small></td>
                                            <td><small>{{ $child->order }}</small></td>
                                            <td>
                                                @if($child->is_active)
                                                    <span class="badge bg-green">Aktif</span>
                                                @else
                                                    <span class="badge bg-red">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('presidium.menu.edit', $child) }}" class="btn btn-sm btn-warning" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                    </a>
                                                    <form action="{{ route('presidium.menu.destroy', $child) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada menu</p>
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

