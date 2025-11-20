@extends('layouts.tabler')

@section('title', 'Referensi Program Kerja')

@section('pretitle', 'Referensi')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Referensi Program Kerja</h3>
                <div class="card-subtitle text-muted">
                    Daftar program kerja dari semua periode kepengurusan
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('referensi-progja.index') }}" class="mb-4" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Filter Periode</label>
                            <select name="periode_id" class="form-select" id="periode_id">
                                <option value="">Semua Periode</option>
                                @foreach($periodeList as $periode)
                                    <option value="{{ $periode->id }}" {{ request('periode_id') == $periode->id ? 'selected' : '' }}>
                                        {{ $periode->nama_periode }}
                                        @if($periode->tanggal_mulai)
                                            ({{ $periode->tanggal_mulai->format('Y') }})
                                        @endif
                                        @if($periode->is_aktif)
                                            - Aktif
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter Status</label>
                            <select name="status" class="form-select" id="status">
                                <option value="">Semua Status</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter Kategori Biro</label>
                            <select name="kategori_biro_id" class="form-select" id="kategori_biro_id">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoriBiroList as $biro)
                                    <option value="{{ $biro->id }}" {{ request('kategori_biro_id') == $biro->id ? 'selected' : '' }}>{{ $biro->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cari Program Kerja</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" id="search" placeholder="Cari judul atau deskripsi..." value="{{ request('search') }}">
                                @if(request('search'))
                                    <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('search').value=''; document.getElementById('filterForm').submit();" title="Hapus pencarian">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(request('periode_id') || request('status') || request('kategori_biro_id') || request('search'))
                        <div class="row g-3 mt-2">
                            <div class="col-md-12">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <span class="text-muted small">Filter aktif:</span>
                                    @if(request('periode_id'))
                                        <span class="badge bg-blue">
                                            Periode: {{ $periodeList->firstWhere('id', request('periode_id'))->nama_periode ?? 'Dipilih' }}
                                            <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6em;" onclick="document.getElementById('periode_id').value=''; document.getElementById('filterForm').submit();" title="Hapus filter periode"></button>
                                        </span>
                                    @endif
                                    @if(request('status'))
                                        <span class="badge bg-blue">
                                            Status: {{ ucfirst(request('status')) }}
                                            <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6em;" onclick="document.getElementById('status').value=''; document.getElementById('filterForm').submit();" title="Hapus filter status"></button>
                                        </span>
                                    @endif
                                    @if(request('kategori_biro_id'))
                                        <span class="badge bg-blue">
                                            Kategori: {{ $kategoriBiroList->firstWhere('id', request('kategori_biro_id'))->nama ?? 'Dipilih' }}
                                            <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6em;" onclick="document.getElementById('kategori_biro_id').value=''; document.getElementById('filterForm').submit();" title="Hapus filter kategori"></button>
                                        </span>
                                    @endif
                                    @if(request('search'))
                                        <span class="badge bg-blue">
                                            Pencarian: {{ request('search') }}
                                            <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6em;" onclick="document.getElementById('search').value=''; document.getElementById('filterForm').submit();" title="Hapus pencarian"></button>
                                        </span>
                                    @endif
                                    <a href="{{ route('referensi-progja.index') }}" class="btn btn-sm btn-outline-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                        </svg>
                                        Reset Semua
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
                
                @if($programKerja->count() == 0)
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                            </div>
                            <div>
                                Belum ada program kerja dari periode sebelumnya.
                            </div>
                        </div>
                    </div>
                @else
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
                                    <th>PERTEMUAN</th>
                                    <th class="w-1">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($programKerja as $progja)
                                    <tr>
                                        <td>
                                            @if($progja->foto_progja)
                                                <img src="{{ asset('storage/' . $progja->foto_progja) }}" alt="{{ $progja->judul }}" class="avatar avatar-sm">
                                            @else
                                                <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $progja->judul }}" class="avatar avatar-sm">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $progja->judul }}</div>
                                            @if($progja->deskripsi)
                                                <div class="text-muted small">{{ Str::limit($progja->deskripsi, 80) }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($progja->periode)
                                                <span class="badge {{ $progja->periode->is_aktif ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $progja->periode->nama_periode }}
                                                    @if($progja->periode->is_aktif)
                                                        <span class="badge bg-white text-success ms-1">Aktif</span>
                                                    @endif
                                                </span>
                                                @if($progja->periode->tanggal_mulai)
                                                    <div class="text-muted small">{{ $progja->periode->tanggal_mulai->format('Y') }}</div>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $progja->status_badge_color }}">
                                                {{ $progja->status_label }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($progja->kategoriBiro)
                                                <span class="badge bg-blue">{{ $progja->kategoriBiro->nama }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-muted">{{ $progja->frekuensi_kegiatan ?? '-' }}</div>
                                        </td>
                                        <td>
                                            @if($progja->creator)
                                                <div class="text-muted">{{ $progja->creator->name }}</div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $progja->kader_count ?? 0 }} Kader</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $progja->pertemuan_count ?? 0 }} Pertemuan</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('referensi-progja.show', $progja) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($programKerja->hasPages())
                        <div class="card-footer d-flex align-items-center">
                            <div class="ms-auto">
                                {{ $programKerja->links('vendor.pagination.tabler') }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const periodeSelect = document.getElementById('periode_id');
        const statusSelect = document.getElementById('status');
        const kategoriBiroSelect = document.getElementById('kategori_biro_id');
        const searchInput = document.getElementById('search');
        
        // Auto-submit ketika dropdown dipilih
        if (periodeSelect) {
            periodeSelect.addEventListener('change', function() {
                filterForm.submit();
            });
        }
        
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                filterForm.submit();
            });
        }
        
        if (kategoriBiroSelect) {
            kategoriBiroSelect.addEventListener('change', function() {
                filterForm.submit();
            });
        }
        
        // Debounce untuk search input (submit setelah 500ms tidak ada input)
        let searchTimeout;
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    filterForm.submit();
                }, 500);
            });
            
            // Submit langsung saat Enter ditekan
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    filterForm.submit();
                }
            });
        }
    });
</script>
@endpush

