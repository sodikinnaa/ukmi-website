@extends('layouts.tabler')

@section('title', 'Detail Kategori Biro')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Kategori Biro: {{ $kategoriBiro->nama }}</h3>
                <div class="card-actions">
                    <a href="{{ route('presidium.kategori-biro.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('presidium.kategori-biro.edit', $kategoriBiro) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
            <div class="card-body">
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

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l0 4" /><path d="M12 16l.01 0" /></svg>
                            </div>
                            <div>
                                {{ session('error') }}
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kode</label>
                            <div class="form-control-plaintext">
                                <strong>{{ $kategoriBiro->kode }}</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <div class="form-control-plaintext">
                                <strong>{{ $kategoriBiro->nama }}</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <div class="form-control-plaintext">
                                {{ $kategoriBiro->deskripsi ?: '-' }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-control-plaintext">
                                @if($kategoriBiro->is_aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-red">Tidak Aktif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Program Kerja</label>
                            <div class="form-control-plaintext">
                                <span class="badge bg-info">{{ $kategoriBiro->programKerja->count() }} Program</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- Tabel Kabid -->
                <div class="mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kepala Bidang (Kabid)</h3>
                            <div class="card-actions">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddKabid">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah Kabid
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($kategoriBiro->kabid->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Periode</th>
                                                <th class="w-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($kategoriBiro->kabid as $kabid)
                                                @php
                                                    $periodeId = $kabid->pivot->periode_id ?? null;
                                                    $periode = $periodeId ? \App\Models\PeriodeKepengurusan::find($periodeId) : null;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">
                                                                <x-avatar :user="$kabid" size="sm" />
                                                            </span>
                                                            <div>
                                                                <strong>{{ $kabid->name }}</strong>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $kabid->email }}</td>
                                                    <td>
                                                        @if($periode)
                                                            <span class="badge bg-info">{{ $periode->nama_periode }}</span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('presidium.kategori-biro.kabid.detach', [$kategoriBiro, $kabid]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kabid ini dari kategori biro?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="periode_id" value="{{ $periodeId }}">
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
                                    <p class="mb-0">Belum ada kabid yang ditambahkan ke kategori biro ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Tabel Kader -->
                <div class="mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kader di Kategori Biro Ini</h3>
                            <div class="card-actions">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddKader">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah Kader
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($kategoriBiro->kader->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>NPM</th>
                                                <th>Periode</th>
                                                <th class="w-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($kategoriBiro->kader as $kader)
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
                                                    <td>
                                                        @if($kader->periodeKader->count() > 0)
                                                            @foreach($kader->periodeKader as $periode)
                                                                <span class="badge bg-info me-1">{{ $periode->nama_periode }}</span>
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('presidium.kategori-biro.kader.detach', [$kategoriBiro, $kader]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kader ini dari kategori biro?');">
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
                                    <p class="mb-0">Belum ada kader yang ditambahkan ke kategori biro ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kader -->
<div class="modal fade" id="modalAddKader" tabindex="-1" role="dialog" aria-labelledby="modalAddKaderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('presidium.kategori-biro.kader.attach', $kategoriBiro) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddKaderLabel">Tambah Kader ke Kategori Biro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($availableKaders->count() > 0)
                        <div class="alert alert-info mb-3">
                            <p class="mb-0">
                                <strong>Catatan:</strong> Hanya kader yang memiliki periode yang sama dengan presidium yang login yang dapat ditambahkan. 
                                Kader dapat mengikuti lebih dari 1 kategori biro.
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Pilih Kader</label>
                            <select class="form-select @error('kader_id') is-invalid @enderror" name="kader_id" id="kader_id_select" required>
                                <option value="">Pilih Kader</option>
                                @foreach($availableKaders as $kader)
                                    <option value="{{ $kader->id }}">
                                        {{ $kader->name }} ({{ $kader->email }})
                                        @if($kader->periodeKader->count() > 0)
                                            - Periode: {{ $kader->periodeKader->pluck('nama_periode')->join(', ') }}
                                        @endif
                                        @if($kader->kategoriBiro->count() > 0)
                                            - Sudah di {{ $kader->kategoriBiro->count() }} biro
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-hint">Hanya kader dengan periode yang sama dengan presidium yang dapat ditambahkan.</small>
                            @error('kader_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <p class="mb-0">
                                Tidak ada kader yang tersedia untuk ditambahkan. 
                                Pastikan ada kader aktif yang memiliki periode yang sama dengan presidium yang login.
                            </p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    @if($availableKaders->count() > 0)
                        <button type="submit" class="btn btn-primary">Tambah Kader</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Kabid -->
<div class="modal fade" id="modalAddKabid" tabindex="-1" role="dialog" aria-labelledby="modalAddKabidLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('presidium.kategori-biro.kabid.attach', $kategoriBiro) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddKabidLabel">Tambah Kabid ke Kategori Biro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($availableKabids->count() > 0 && !empty($presidiumPeriodeIds))
                        <div class="alert alert-info mb-3">
                            <p class="mb-0">
                                <strong>Catatan:</strong> Hanya kabid yang memiliki periode yang sama dengan presidium yang login yang dapat ditambahkan. 
                                Setiap kabid harus dipilih untuk periode tertentu.
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Pilih Periode</label>
                            <select class="form-select @error('periode_id') is-invalid @enderror" name="periode_id" id="periode_id_select" required>
                                <option value="">Pilih Periode</option>
                                @php
                                    $periodeList = \App\Models\PeriodeKepengurusan::whereIn('id', $presidiumPeriodeIds)->orderBy('tanggal_mulai', 'desc')->get();
                                @endphp
                                @foreach($periodeList as $periode)
                                    <option value="{{ $periode->id }}">{{ $periode->nama_periode }}</option>
                                @endforeach
                            </select>
                            @error('periode_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Pilih Kabid</label>
                            <select class="form-select @error('kabid_id') is-invalid @enderror" name="kabid_id" id="kabid_id_select" required>
                                <option value="">Pilih Kabid</option>
                                @foreach($availableKabids as $kabid)
                                    <option value="{{ $kabid->id }}">
                                        {{ $kabid->name }} ({{ $kabid->email }})
                                        @if($kabid->periodeKabid->count() > 0)
                                            - Periode: {{ $kabid->periodeKabid->pluck('nama_periode')->join(', ') }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-hint">Hanya kabid dengan periode yang sama dengan presidium yang dapat ditambahkan.</small>
                            @error('kabid_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <p class="mb-0">
                                @if(empty($presidiumPeriodeIds))
                                    Presidium belum memiliki periode kepengurusan. Silakan hubungi pembina untuk menambahkan periode.
                                @else
                                    Tidak ada kabid yang tersedia untuk ditambahkan. Semua kabid aktif sudah ditambahkan ke kategori biro ini untuk periode presidium yang login.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    @if($availableKabids->count() > 0 && !empty($presidiumPeriodeIds))
                        <button type="submit" class="btn btn-primary">Tambah Kabid</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan modal bisa dibuka
        const modalAddKader = document.getElementById('modalAddKader');
        const modalAddKabid = document.getElementById('modalAddKabid');
        const btnAddKader = document.querySelector('[data-bs-target="#modalAddKader"]');
        const btnAddKabid = document.querySelector('[data-bs-target="#modalAddKabid"]');
        
        if (btnAddKader && modalAddKader) {
            btnAddKader.addEventListener('click', function(e) {
                e.preventDefault();
                const modal = new bootstrap.Modal(modalAddKader);
                modal.show();
            });
        }
        
        if (btnAddKabid && modalAddKabid) {
            btnAddKabid.addEventListener('click', function(e) {
                e.preventDefault();
                const modal = new bootstrap.Modal(modalAddKabid);
                modal.show();
            });
        }
    });
</script>
@endpush
@endsection

