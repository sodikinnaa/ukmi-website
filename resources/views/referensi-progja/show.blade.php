@extends('layouts.tabler')

@section('title', 'Detail Program Kerja')

@section('pretitle', 'Referensi Progja')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Program Kerja: {{ $programKerja->judul }}</h3>
                <div class="card-actions">
                    <a href="{{ route('referensi-progja.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        @if($programKerja->foto_progja)
                            <img src="{{ asset('storage/' . $programKerja->foto_progja) }}" alt="{{ $programKerja->judul }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                        @else
                            <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $programKerja->judul }}" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                        @endif
                        <h3>{{ $programKerja->judul }}</h3>
                        <div>
                            <span class="badge bg-blue">{{ $programKerja->kategori_biro_label }}</span>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul</label>
                                <div class="form-control-plaintext">{{ $programKerja->judul }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori Biro</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-blue">{{ $programKerja->kategori_biro_label }}</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Frekuensi Kegiatan</label>
                                <div class="form-control-plaintext">
                                    @if($programKerja->frekuensi_kegiatan)
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-blue">{{ $programKerja->frekuensi_kegiatan }} Pertemuan</span>
                                            @if($programKerja->jumlah_pertemuan >= $programKerja->frekuensi_kegiatan)
                                                <span class="badge bg-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M5 12l5 5l10 -10" />
                                                    </svg>
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M12 8v4" />
                                                        <path d="M12 16h.01" />
                                                    </svg>
                                                    Berlangsung
                                                </span>
                                            @endif
                                        </div>
                                        <div class="progress mb-2" style="height: 8px;">
                                            @php
                                                $progress = $programKerja->frekuensi_kegiatan > 0 ? ($programKerja->jumlah_pertemuan / $programKerja->frekuensi_kegiatan) * 100 : 0;
                                                $progressColor = $progress >= 100 ? 'bg-success' : ($progress >= 50 ? 'bg-warning' : 'bg-info');
                                            @endphp
                                            <div class="progress-bar {{ $progressColor }}" role="progressbar" style="width: {{ min($progress, 100) }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted">
                                            <strong>Progress:</strong> {{ $programKerja->jumlah_pertemuan }} / {{ $programKerja->frekuensi_kegiatan }} pertemuan
                                        </small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Periode Kepengurusan</label>
                                <div class="form-control-plaintext">
                                    @if($programKerja->periode)
                                        <span class="badge bg-secondary">{{ $programKerja->periode->nama_periode }}</span>
                                        @if($programKerja->periode->tanggal_mulai)
                                            <div class="text-muted small">{{ $programKerja->periode->tanggal_mulai->format('d M Y') }}</div>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-{{ $programKerja->status_badge_color }}">
                                        {{ $programKerja->status_label }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <div class="form-control-plaintext">
                                    {{ $programKerja->deskripsi ?: '-' }}
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Kader</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-info">{{ $programKerja->kader->count() }} Kader</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Absensi</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-green">{{ $programKerja->absensi->count() }} Absensi</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Dokumentasi</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-purple">{{ $programKerja->dokumentasi->count() }} Dokumentasi</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dibuat</label>
                                <div class="form-control-plaintext">{{ $programKerja->created_at->format('d M Y H:i') }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dibuat Oleh</label>
                                <div class="form-control-plaintext">
                                    @if($programKerja->creator)
                                        {{ $programKerja->creator->name }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="row">
                    <!-- Tabel Kader -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kader yang Mengikuti</h3>
                            </div>
                            <div class="card-body">
                                @if($programKerja->kader->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>NPM</th>
                                                    <th>Jurusan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($programKerja->kader as $kader)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2">
                                                                    <x-avatar :user="$kader" size="sm" />
                                                                </span>
                                                                <div>
                                                                    <strong>{{ $kader->name }}</strong>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $kader->email }}</td>
                                                        <td>{{ $kader->npm ?? '-' }}</td>
                                                        <td>{{ $kader->jurusan ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-info mb-0">
                                        <p class="mb-0">Belum ada kader yang mengikuti program kerja ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($programKerja->pertemuan->count() > 0)
                    <hr>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">Detail Pertemuan</h4>
                            <div>
                                @if($programKerja->frekuensi_kegiatan)
                                    <span class="badge bg-{{ $programKerja->jumlah_pertemuan >= $programKerja->frekuensi_kegiatan ? 'success' : 'info' }}">
                                        Pertemuan: {{ $programKerja->jumlah_pertemuan }} / {{ $programKerja->frekuensi_kegiatan }}
                                    </span>
                                @else
                                    <span class="badge bg-info">
                                        Total: {{ $programKerja->jumlah_pertemuan }} Pertemuan
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @foreach($programKerja->pertemuan as $pertemuan)
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Pertemuan Ke-{{ $pertemuan->pertemuan_ke }}</h3>
                                            <div class="card-actions">
                                                <span class="badge bg-blue">{{ $pertemuan->tanggal->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if($pertemuan->deskripsi)
                                                <p class="text-muted mb-3">{{ $pertemuan->deskripsi }}</p>
                                            @endif
                                            
                                            @if($pertemuan->lokasi_kegiatan)
                                                <div class="mb-2">
                                                    <span class="badge bg-info">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18l-2 -4l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5l-2.901 8.034a1 1 0 0 1 -1.464 .734l-7.635 -2.637l-7.636 2.637a1 1 0 0 1 -1.464 -.734l-2.899 -8.034l18 6.5a.55 .55 0 0 1 0 1l-7 3.5z" /></svg>
                                                        {{ $pertemuan->lokasi_kegiatan }}
                                                    </span>
                                                </div>
                                            @endif
                                            
                                            @if($pertemuan->total_peserta)
                                                <div class="mb-2">
                                                    <span class="badge bg-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                                        {{ $pertemuan->total_peserta }} Peserta
                                                    </span>
                                                </div>
                                            @endif
                                            
                                            @php
                                                $absensiPertemuan = $absensiByPertemuan->get($pertemuan->pertemuan_ke, collect());
                                                $dokumentasiPertemuan = $dokumentasiByPertemuan->get($pertemuan->pertemuan_ke, collect());
                                            @endphp
                                            
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <div class="text-muted">Absensi</div>
                                                    <div class="h3 mb-0">{{ $absensiPertemuan->count() }}</div>
                                                    <small class="text-muted">
                                                        Hadir: {{ $absensiPertemuan->where('status', 'hadir')->count() }} | 
                                                        Izin: {{ $absensiPertemuan->where('status', 'izin')->count() }} | 
                                                        Sakit: {{ $absensiPertemuan->where('status', 'sakit')->count() }} | 
                                                        Alpha: {{ $absensiPertemuan->where('status', 'alpha')->count() }}
                                                    </small>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-muted">Dokumentasi</div>
                                                    <div class="h3 mb-0">{{ $dokumentasiPertemuan->count() }}</div>
                                                    <small class="text-muted">Foto dokumentasi</small>
                                                </div>
                                            </div>
                                            
                                            @if($pertemuan->foto_kegiatan)
                                                <div class="mb-3">
                                                    <label class="form-label">Foto Kegiatan</label>
                                                    <div>
                                                        <a href="{{ asset('storage/' . $pertemuan->foto_kegiatan) }}" target="_blank" class="d-inline-block">
                                                            <img src="{{ asset('storage/' . $pertemuan->foto_kegiatan) }}" alt="Foto Kegiatan Pertemuan {{ $pertemuan->pertemuan_ke }}" class="img-thumbnail" style="max-height: 150px; cursor: pointer;">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($pertemuan->foto_absen)
                                                <div class="mb-3">
                                                    <label class="form-label">Foto Absen (PDF)</label>
                                                    <div>
                                                        <a href="{{ route('absenpdf.view', ['file_name' => basename($pertemuan->foto_absen)]) }}" target="_blank" class="btn btn-sm btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>
                                                            Buka PDF
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($absensiPertemuan->count() > 0)
                                                <div class="mb-3">
                                                    <label class="form-label">Detail Absensi</label>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama</th>
                                                                    <th>Status</th>
                                                                    <th>Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($absensiPertemuan as $absensi)
                                                                    <tr>
                                                                        <td>
                                                                            @if($absensi->kader)
                                                                                {{ $absensi->kader->name }}
                                                                            @else
                                                                                <span class="text-muted">-</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <span class="badge bg-{{ $absensi->status === 'hadir' ? 'success' : ($absensi->status === 'izin' ? 'warning' : ($absensi->status === 'sakit' ? 'info' : 'danger')) }}">
                                                                                {{ $absensi->status_label }}
                                                                            </span>
                                                                        </td>
                                                                        <td>{{ $absensi->keterangan ?: '-' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($dokumentasiPertemuan->count() > 0)
                                                <div class="mb-3">
                                                    <label class="form-label">Dokumentasi</label>
                                                    <div class="row g-2">
                                                        @foreach($dokumentasiPertemuan as $dokumentasi)
                                                            <div class="col-md-4">
                                                                @if($dokumentasi->foto_dokumentasi)
                                                                    <a href="{{ asset('storage/' . $dokumentasi->foto_dokumentasi) }}" target="_blank" class="d-inline-block">
                                                                        <img src="{{ asset('storage/' . $dokumentasi->foto_dokumentasi) }}" alt="Dokumentasi" class="img-thumbnail w-100" style="max-height: 100px; object-fit: cover; cursor: pointer;">
                                                                    </a>
                                                                    @if($dokumentasi->deskripsi)
                                                                        <small class="text-muted d-block mt-1">{{ $dokumentasi->deskripsi }}</small>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <hr>
                    <div class="alert alert-info">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 8v4" />
                                <path d="M12 16h.01" />
                            </svg>
                            <div>
                                <p class="mb-0"><strong>Belum ada pertemuan</strong> yang dilakukan untuk program kerja ini.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

