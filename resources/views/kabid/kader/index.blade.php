@extends('layouts.tabler')

@section('title', 'Daftar Kader')

@section('pretitle', 'Kepala Bidang/Biro')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kader</h3>
                <div class="card-subtitle text-muted">
                    Kader dari kategori biro yang Anda kelola
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('kabid.kader.index') }}" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Filter Kategori Biro</label>
                            <select name="kategori_biro_id" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoriBiroList as $biro)
                                    <option value="{{ $biro->id }}" {{ request('kategori_biro_id') == $biro->id ? 'selected' : '' }}>{{ $biro->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cari Kader</label>
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama, email, atau NPM..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2 w-100">Cari</button>
                        </div>
                    </div>
                    @if(request('kategori_biro_id') || request('search'))
                        <div class="mt-2">
                            <a href="{{ route('kabid.kader.index') }}" class="btn btn-sm btn-secondary">Reset Filter</a>
                        </div>
                    @endif
                </form>

                @if($kategoriBiroList->isEmpty())
                    <div class="alert alert-warning">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                            </div>
                            <div>
                                Anda belum memiliki kategori biro yang ditugaskan. Silakan hubungi presidium untuk menugaskan Anda ke kategori biro.
                            </div>
                        </div>
                    </div>
                @elseif($kader->count() == 0)
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                            </div>
                            <div>
                                Belum ada kader yang ditambahkan ke kategori biro yang Anda kelola.
                            </div>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NPM</th>
                                    <th>Jurusan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kategori Biro</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kader as $kaderItem)
                                    <tr>
                                        <td>
                                            @if($kaderItem->foto_profile)
                                                <img src="{{ asset('storage/' . $kaderItem->foto_profile) }}" alt="{{ $kaderItem->name }}" class="avatar avatar-sm">
                                            @else
                                                <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $kaderItem->name }}" class="avatar avatar-sm">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $kaderItem->name }}</div>
                                        </td>
                                        <td>
                                            <div class="text-muted">{{ $kaderItem->email }}</div>
                                        </td>
                                        <td>
                                            <div class="text-muted">{{ $kaderItem->npm ?? '-' }}</div>
                                        </td>
                                        <td>
                                            <div class="text-muted">{{ $kaderItem->jurusan ?? '-' }}</div>
                                        </td>
                                        <td>
                                            @if($kaderItem->jenis_kelamin)
                                                <span class="badge bg-{{ $kaderItem->jenis_kelamin == 'L' ? 'primary' : 'pink' }}">
                                                    {{ $kaderItem->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($kaderItem->kategoriBiro->count() > 0)
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach($kaderItem->kategoriBiro as $biro)
                                                        <span class="badge bg-blue">{{ $biro->nama }}</span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($kaderItem->periodeKader->count() > 0)
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach($kaderItem->periodeKader as $periode)
                                                        <span class="badge bg-{{ $periode->is_aktif ? 'success' : 'secondary' }}">
                                                            {{ $periode->nama_periode }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $kaderItem->status_badge_color }}">
                                                {{ $kaderItem->status_label }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($kader->hasPages())
                        <div class="card-footer d-flex align-items-center">
                            <div class="ms-auto">
                                {{ $kader->links('vendor.pagination.tabler') }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

