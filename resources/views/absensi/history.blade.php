@extends('layouts.tabler')

@section('title', 'Riwayat Absensi')

@section('pretitle', 'Absensi')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Absensi Saya</h3>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('absensi.history') }}" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Filter Program Kerja</label>
                            <select name="program_kerja_id" class="form-select">
                                <option value="">Semua Program Kerja</option>
                                @foreach($allProgramKerja as $progja)
                                    <option value="{{ $progja->id }}" {{ request('program_kerja_id') == $progja->id ? 'selected' : '' }}>
                                        {{ $progja->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alpha" {{ request('status') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tanggal Dari</label>
                            <input type="date" name="tanggal_dari" class="form-select" value="{{ request('tanggal_dari') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tanggal Sampai</label>
                            <input type="date" name="tanggal_sampai" class="form-select" value="{{ request('tanggal_sampai') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('absensi.history') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                    @if(request('program_kerja_id') || request('status') || request('tanggal_dari') || request('tanggal_sampai'))
                        <div class="mt-2">
                            <div class="d-flex flex-wrap gap-2">
                                @if(request('program_kerja_id'))
                                    <span class="badge bg-blue">Program: {{ $allProgramKerja->firstWhere('id', request('program_kerja_id'))->judul ?? 'Dipilih' }}</span>
                                @endif
                                @if(request('status'))
                                    <span class="badge bg-blue">Status: {{ ucfirst(request('status')) }}</span>
                                @endif
                                @if(request('tanggal_dari'))
                                    <span class="badge bg-blue">Dari: {{ request('tanggal_dari') }}</span>
                                @endif
                                @if(request('tanggal_sampai'))
                                    <span class="badge bg-blue">Sampai: {{ request('tanggal_sampai') }}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </form>
                
                @if($absensi->count() == 0)
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                            </div>
                            <div>
                                Belum ada riwayat absensi.
                            </div>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>PROGRAM KERJA</th>
                                    <th>PERTEMUAN</th>
                                    <th>TANGGAL</th>
                                    <th>STATUS</th>
                                    <th>KETERANGAN</th>
                                    <th class="w-1">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absensi as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->programKerja->foto_progja)
                                                    <img src="{{ asset('storage/' . $item->programKerja->foto_progja) }}" alt="{{ $item->programKerja->judul }}" class="avatar avatar-sm me-2">
                                                @else
                                                    <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $item->programKerja->judul }}" class="avatar avatar-sm me-2">
                                                @endif
                                                <div>
                                                    <div class="fw-bold">{{ $item->programKerja->judul }}</div>
                                                    <div class="text-muted small">
                                                        <span class="badge bg-blue">{{ $item->programKerja->kategoriBiro->nama ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">Pertemuan Ke-{{ $item->pertemuan_ke }}</span>
                                        </td>
                                        <td>{{ $item->tanggal->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status === 'hadir' ? 'success' : ($item->status === 'izin' ? 'warning' : ($item->status === 'sakit' ? 'info' : 'danger')) }}">
                                                {{ $item->status_label }}
                                            </span>
                                        </td>
                                        <td>{{ $item->keterangan ?: '-' }}</td>
                                        <td>
                                            <a href="{{ route('absensi.edit', $item) }}" class="btn btn-sm btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($absensi->hasPages())
                        <div class="card-footer d-flex align-items-center">
                            <div class="ms-auto">
                                {{ $absensi->links('vendor.pagination.tabler') }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

