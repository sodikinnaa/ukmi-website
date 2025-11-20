@extends('layouts.tabler')

@section('title', 'Detail Program Kerja')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    @if(session('error'))
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                    </div>
                    <div>
                        {{ session('error') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Program Kerja: {{ $programKerja->judul }}</h3>
                <div class="card-actions">
                    <a href="{{ route('presidium.program-kerja.index') }}" class="btn btn-secondary">Kembali</a>
                    @php
                        $jumlahPertemuan = $programKerja->jumlah_pertemuan;
                        $frekuensiKegiatan = $programKerja->frekuensi_kegiatan;
                        $bisaTambahPertemuan = !$frekuensiKegiatan || ($jumlahPertemuan < $frekuensiKegiatan);
                    @endphp
                    @if($bisaTambahPertemuan)
                        <a href="{{ route('presidium.program-kerja.pertemuan.create', $programKerja) }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Tambah Pertemuan
                        </a>
                    @else
                        <button type="button" class="btn btn-success" disabled title="Pertemuan sudah mencapai batas maksimal ({{ $frekuensiKegiatan }} pertemuan)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Pertemuan Penuh
                        </button>
                    @endif
                    <a href="{{ route('presidium.program-kerja.edit', $programKerja) }}" class="btn btn-primary">Edit</a>
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
                                            @if($programKerja->jumlah_pertemuan < $programKerja->frekuensi_kegiatan)
                                                (Sisa: {{ $programKerja->frekuensi_kegiatan - $programKerja->jumlah_pertemuan }} pertemuan)
                                            @endif
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
                                        <span class="badge bg-info">{{ $programKerja->periode->nama_periode }}</span>
                                        @if($programKerja->periode->is_aktif)
                                            <span class="badge bg-success">Aktif</span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-{{ $programKerja->status_badge_color }}">{{ $programKerja->status_label }}</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dibuat Oleh</label>
                                <div class="form-control-plaintext">{{ $programKerja->creator?->name ?? '-' }}</div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <div class="form-control-plaintext">{{ $programKerja->deskripsi ?? '-' }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jumlah Kader</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-green">{{ $programKerja->kader->count() }} Kader</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Absensi</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-blue">{{ $programKerja->absensi->count() }} Absensi</span>
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
                                <div class="card-actions">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddKader">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                        Tambah Kader
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-3">
                                    <p class="mb-0"><strong>Catatan:</strong> Semua user di periode ini (Presidium, Kabid, Kader) dapat ditambahkan ke program kerja ini. User dapat mengikuti lebih dari 1 program kerja.</p>
                                </div>
                                @if($programKerja->kader->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th class="w-1">Aksi</th>
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
                                                                    @if($kader->npm)
                                                                        <div class="text-muted">{{ $kader->npm }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $kader->email }}</td>
                                                        <td>
                                                            <form action="{{ route('presidium.program-kerja.kader.detach', [$programKerja, $kader]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kader ini?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-info mb-0">
                                        <p class="mb-0">Belum ada kader yang ditambahkan.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah User -->
                <div class="modal fade" id="modalAddKader" tabindex="-1" role="dialog" aria-labelledby="modalAddKaderLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('presidium.program-kerja.kader.attach', $programKerja) }}" method="POST" id="formAddKader">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAddKaderLabel">Tambah Peserta Program Kerja</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @php
                                        $availableUsers = $availableUsers ?? collect();
                                        $availableKaders = $availableKaders ?? $availableUsers;
                                    @endphp
                                    @if($availableUsers->count() > 0)
                                        <div class="alert alert-info mb-3">
                                            <p class="mb-0"><strong>Catatan:</strong> Anda dapat memilih semua user di periode ini (Presidium, Kabid, Kader). User dapat mengikuti lebih dari 1 program kerja.</p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <label class="form-label required">Pilih User</label>
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllBtn">Pilih Semua</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAllBtn">Batal Pilih</button>
                                                </div>
                                            </div>
                                            
                                            <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column" style="max-height: 400px; overflow-y: auto;">
                                                @foreach($availableUsers as $user)
                                                    @php
                                                        $roleName = $user->roleModel->name ?? 'unknown';
                                                        $roleBadgeColor = match($roleName) {
                                                            'presidium' => 'bg-purple',
                                                            'kabid' => 'bg-blue',
                                                            'kader' => 'bg-green',
                                                            'pembina' => 'bg-orange',
                                                            default => 'bg-secondary',
                                                        };
                                                        $roleLabel = match($roleName) {
                                                            'presidium' => 'Presidium',
                                                            'kabid' => 'Kabid',
                                                            'kader' => 'Kader',
                                                            'pembina' => 'Pembina',
                                                            default => ucfirst($roleName),
                                                        };
                                                    @endphp
                                                    <label class="form-selectgroup-item">
                                                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="form-selectgroup-input user-checkbox">
                                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                            <div class="me-3">
                                                                <x-avatar :user="$user" size="sm" />
                                                            </div>
                                                            <div class="flex-fill">
                                                                <div class="d-flex align-items-center gap-2 mb-1">
                                                                    <strong>{{ $user->name }}</strong>
                                                                    <span class="badge {{ $roleBadgeColor }}">{{ $roleLabel }}</span>
                                                                </div>
                                                                <div class="text-muted small">
                                                                    {{ $user->email }}
                                                                    @if($user->npm)
                                                                        | NPM: {{ $user->npm }}
                                                                    @endif
                                                                </div>
                                                                @if($user->programKerja->count() > 0)
                                                                    <div class="text-muted small mt-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                                        </svg>
                                                                        Sudah mengikuti {{ $user->programKerja->count() }} program kerja
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            
                                            <small class="form-hint">Pilih satu atau lebih user untuk ditambahkan ke program kerja ini.</small>
                                            @error('user_ids')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="alert alert-info mb-0">
                                            <p class="mb-0">Tidak ada user yang tersedia untuk ditambahkan. Semua user aktif di periode ini sudah ditambahkan ke program kerja ini.</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    @if($availableUsers->count() > 0)
                                        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Tambah User</button>
                                    @endif
                                </div>
                            </form>
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
                                            
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('presidium.program-kerja.pertemuan.show', [$programKerja, $pertemuan]) }}" class="btn btn-sm btn-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Detail
                                                </a>
                                                <a href="{{ route('presidium.program-kerja.pertemuan.edit', [$programKerja, $pertemuan]) }}" class="btn btn-sm btn-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('presidium.program-kerja.pertemuan.destroy', [$programKerja, $pertemuan]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertemuan ke-{{ $pertemuan->pertemuan_ke }}? Nomor pertemuan yang tersisa akan disesuaikan secara otomatis.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Pertemuan">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
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
                                @if($programKerja->frekuensi_kegiatan)
                                    <p class="mb-0 mt-1"><small>Rencana: {{ $programKerja->frekuensi_kegiatan }} pertemuan</small></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan modal bisa dibuka
        const modalAddKader = document.getElementById('modalAddKader');
        const btnAddKader = document.querySelector('[data-bs-target="#modalAddKader"]');
        
        if (btnAddKader && modalAddKader) {
            btnAddKader.addEventListener('click', function(e) {
                e.preventDefault();
                const modal = new bootstrap.Modal(modalAddKader);
                modal.show();
            });
        }
        
        // Handle checkbox selection
        const userCheckboxes = document.querySelectorAll('.user-checkbox');
        const submitBtn = document.getElementById('submitBtn');
        const selectAllBtn = document.getElementById('selectAllBtn');
        const deselectAllBtn = document.getElementById('deselectAllBtn');
        const formAddKader = document.getElementById('formAddKader');
        
        // Update submit button state
        function updateSubmitButton() {
            const checkedCount = document.querySelectorAll('.user-checkbox:checked').length;
            if (submitBtn) {
                submitBtn.disabled = checkedCount === 0;
                if (checkedCount > 0) {
                    submitBtn.textContent = `Tambah ${checkedCount} User`;
                } else {
                    submitBtn.textContent = 'Tambah User';
                }
            }
        }
        
        // Select all
        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', function() {
                userCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
                updateSubmitButton();
            });
        }
        
        // Deselect all
        if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', function() {
                userCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                updateSubmitButton();
            });
        }
        
        // Update button on checkbox change
        userCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSubmitButton);
        });
        
        // Form validation
        if (formAddKader) {
            formAddKader.addEventListener('submit', function(e) {
                const checkedCount = document.querySelectorAll('.user-checkbox:checked').length;
                if (checkedCount === 0) {
                    e.preventDefault();
                    alert('Pilih minimal satu user untuk ditambahkan.');
                    return false;
                }
            });
        }
        
        // Initial state
        updateSubmitButton();
    });
</script>
@endpush

