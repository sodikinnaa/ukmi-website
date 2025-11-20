@extends('layouts.tabler')

@section('title', 'Program Kerja')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('header-actions')
    <a href="{{ route('presidium.program-kerja.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
        Tambah Program Kerja
    </a>
@endsection

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manajemen Program Kerja</h3>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('presidium.program-kerja.index') }}" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Filter Periode</label>
                            <select name="periode_id" class="form-select">
                                <option value="">Semua Periode</option>
                                @foreach($periodeList as $periode)
                                    <option value="{{ $periode->id }}" {{ request('periode_id') == $periode->id ? 'selected' : '' }}>
                                        {{ $periode->nama_periode }}
                                        @if($periode->is_aktif) (Aktif) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter Kategori Biro</label>
                            <select name="kategori_biro_id" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoriBiroList as $biro)
                                    <option value="{{ $biro->id }}" {{ request('kategori_biro_id') == $biro->id ? 'selected' : '' }}>{{ $biro->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('presidium.program-kerja.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
                
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>FOTO</th>
                                <th>JUDUL</th>
                                <th>PERIODE</th>
                                <th>STATUS</th>
                                <th>KATEGORI BIRO</th>
                                <th>FREKUENSI</th>
                                <th>DIBUAT OLEH</th>
                                <th>KADER</th>
                                <th class="w-1">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($programKerja as $progja)
                                <tr>
                                    <td>
                                        @if($progja->foto_progja)
                                            <img src="{{ asset('storage/' . $progja->foto_progja) }}" alt="{{ $progja->judul }}" class="avatar avatar-sm" style="object-fit: cover;">
                                        @else
                                            <span class="avatar avatar-sm" style="background-image: url('https://cdn-icons-png.freepik.com/512/4264/4264711.png')"></span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $progja->judul }}</strong></td>
                                    <td>
                                        @if($progja->periode)
                                            <span class="badge bg-info">{{ $progja->periode->nama_periode }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $progja->status_badge_color }}">{{ $progja->status_label }}</span>
                                    </td>
                                    <td>
                                        @if($progja->kategoriBiro)
                                            <span class="badge bg-blue">{{ $progja->kategoriBiro->nama }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $progja->kategori_biro_label ?? 'Tidak Diketahui' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($progja->frekuensi_kegiatan)
                                            {{ $progja->frekuensi_kegiatan }} Pertemuan
                                            <br><small class="text-muted">{{ $progja->pertemuan_count }} / {{ $progja->frekuensi_kegiatan }} selesai</small>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $progja->creator?->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-green">{{ $progja->kader_count }} Kader</span>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('presidium.program-kerja.show', $progja) }}" class="btn btn-sm btn-info" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                            </a>
                                            <a href="{{ route('presidium.program-kerja.edit', $progja) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                            <form action="{{ route('presidium.program-kerja.destroy', $progja) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program kerja ini?');">
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
                                    <td colspan="9" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada data program kerja</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($programKerja->hasPages())
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">
                            Menampilkan {{ $programKerja->firstItem() }} sampai {{ $programKerja->lastItem() }} dari {{ $programKerja->total() }} data
                        </p>
                        <ul class="pagination m-0 ms-auto">
                            {{ $programKerja->links() }}
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
