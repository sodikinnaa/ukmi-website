@extends('layouts.tabler')

@section('title', 'Video Tutorial')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('header-actions')
    <a href="{{ route('presidium.video-tutorial.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
        Tambah Video Tutorial
    </a>
@endsection

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manajemen Video Tutorial</h3>
                <div class="card-subtitle text-muted">
                    Dokumentasi dan penjelasan video tutorial untuk berbagai modul sistem
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('presidium.video-tutorial.index') }}" class="mb-4" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Filter Modul</label>
                            <select name="modul" class="form-select" id="modul">
                                <option value="">Semua Modul</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module }}" {{ request('modul') == $module ? 'selected' : '' }}>
                                        {{ $module }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter Status</label>
                            <select name="is_aktif" class="form-select" id="is_aktif">
                                <option value="">Semua Status</option>
                                <option value="1" {{ request('is_aktif') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('is_aktif') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pencarian</label>
                            <input type="text" name="search" class="form-control" placeholder="Cari judul, keterangan, atau modul..." value="{{ request('search') }}" id="searchInput">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-secondary w-100" onclick="resetFilter()">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
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

                @if($videoTutorials->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>VIDEO</th>
                                    <th>JUDUL</th>
                                    <th>MODUL</th>
                                    <th>KETERANGAN</th>
                                    <th>DURASI</th>
                                    <th>URUTAN</th>
                                    <th>STATUS</th>
                                    <th>DIBUAT OLEH</th>
                                    <th class="w-1">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($videoTutorials as $video)
                                    <tr>
                                        <td>
                                            @if($video->video_path || $video->video_url)
                                                <div class="d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" /><path d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" /></svg>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $video->judul }}</div>
                                        </td>
                                        <td>
                                            @if($video->modul)
                                                <span class="badge bg-blue">{{ $video->modul }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($video->keterangan)
                                                <div class="text-muted small">{{ Str::limit($video->keterangan, 80) }}</div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $video->formatted_durasi }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $video->urutan }}</span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $video->is_aktif ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $video->is_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($video->creator)
                                                <div class="text-muted small">{{ $video->creator->name }}</div>
                                                <div class="text-muted small">{{ $video->created_at->format('d/m/Y H:i') }}</div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="{{ route('presidium.video-tutorial.show', $video) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                                </a>
                                                <a href="{{ route('presidium.video-tutorial.edit', $video) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                </a>
                                                <form action="{{ route('presidium.video-tutorial.destroy', $video) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video tutorial ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 3v3" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $videoTutorials->links() }}
                    </div>
                @else
                    <div class="empty">
                        <div class="empty-img">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" /><path d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" /></svg>
                        </div>
                        <p class="empty-title">Tidak ada video tutorial</p>
                        <p class="empty-subtitle text-muted">
                            Belum ada video tutorial yang ditambahkan. Klik tombol "Tambah Video Tutorial" untuk menambahkan video tutorial baru.
                        </p>
                        <div class="empty-action">
                            <a href="{{ route('presidium.video-tutorial.create') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                Tambah Video Tutorial
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto submit form ketika dropdown berubah
    document.getElementById('modul').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });

    document.getElementById('is_aktif').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });

    // Debounce untuk search input
    let searchTimeout;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            document.getElementById('filterForm').submit();
        }, 500);
    });

    function resetFilter() {
        document.getElementById('modul').value = '';
        document.getElementById('is_aktif').value = '';
        document.getElementById('searchInput').value = '';
        document.getElementById('filterForm').submit();
    }
</script>
@endpush
@endsection

