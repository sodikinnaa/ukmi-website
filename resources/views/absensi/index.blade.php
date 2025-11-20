@extends('layouts.tabler')

@section('title', 'Absensi')

@section('pretitle', 'Absensi')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Program Kerja yang Diikuti</h3>
                <div class="card-subtitle text-muted">
                    Pilih program kerja untuk melakukan absensi
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('absensi.index') }}" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Filter Program Kerja</label>
                            <select name="program_kerja_id" class="form-select">
                                <option value="">Semua Program Kerja</option>
                                @foreach($allProgramKerja as $progja)
                                    <option value="{{ $progja->id }}" {{ request('program_kerja_id') == $progja->id ? 'selected' : '' }}>
                                        {{ $progja->judul }} - {{ $progja->kategoriBiro->nama ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
                
                @if($programKerjaList->count() == 0)
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                            </div>
                            <div>
                                <p class="mb-0"><strong>Belum ada program kerja yang diikuti.</strong></p>
                                <p class="mb-0 mt-1">Anda perlu ditambahkan ke program kerja terlebih dahulu untuk dapat melakukan absensi.</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        @foreach($programKerjaList as $progja)
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            @if($progja->foto_progja)
                                                <img src="{{ asset('storage/' . $progja->foto_progja) }}" alt="{{ $progja->judul }}" class="avatar avatar-lg me-3">
                                            @else
                                                <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $progja->judul }}" class="avatar avatar-lg me-3">
                                            @endif
                                            <div class="flex-fill">
                                                <h4 class="mb-1">{{ $progja->judul }}</h4>
                                                <div class="text-muted small">
                                                    <span class="badge bg-blue">{{ $progja->kategoriBiro->nama ?? '-' }}</span>
                                                    @if($progja->periode)
                                                        <span class="badge bg-secondary ms-1">{{ $progja->periode->nama_periode }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($progja->deskripsi)
                                            <p class="text-muted mb-3">{{ Str::limit($progja->deskripsi, 100) }}</p>
                                        @endif
                                        
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="text-muted small">Pertemuan</div>
                                                <div class="fw-bold">{{ $progja->pertemuan->count() }} Pertemuan</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-muted small">Status</div>
                                                <div>
                                                    <span class="badge bg-{{ $progja->status_badge_color }}">
                                                        {{ $progja->status_label }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($progja->pertemuan->count() > 0)
                                            <div class="mb-3">
                                                <div class="text-muted small mb-2">Pertemuan Terbaru:</div>
                                                <div class="list-group list-group-flush">
                                                    @foreach($progja->pertemuan->take(3) as $pertemuan)
                                                        <div class="list-group-item px-0 py-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <strong>Pertemuan Ke-{{ $pertemuan->pertemuan_ke }}</strong>
                                                                    <div class="text-muted small">{{ $pertemuan->tanggal->format('d M Y') }}</div>
                                                                </div>
                                                                @php
                                                                    $userAbsensi = \App\Models\Absensi::where('program_kerja_id', $progja->id)
                                                                        ->where('kader_id', $user->id)
                                                                        ->where('pertemuan_ke', $pertemuan->pertemuan_ke)
                                                                        ->first();
                                                                @endphp
                                                                @if($userAbsensi)
                                                                    <span class="badge bg-{{ $userAbsensi->status === 'hadir' ? 'success' : ($userAbsensi->status === 'izin' ? 'warning' : ($userAbsensi->status === 'sakit' ? 'info' : 'danger')) }}">
                                                                        {{ $userAbsensi->status_label }}
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-secondary">Belum Absen</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('absensi.create', $progja) }}" class="btn btn-primary btn-sm flex-fill">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                    <path d="M9 12l2 2l4 -4" />
                                                </svg>
                                                Absen
                                            </a>
                                            <a href="{{ route('absensi.history', ['program_kerja_id' => $progja->id]) }}" class="btn btn-outline-info btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                    <path d="M9 9l1 0" />
                                                    <path d="M9 13l6 0" />
                                                    <path d="M9 17l6 0" />
                                                </svg>
                                                Riwayat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

