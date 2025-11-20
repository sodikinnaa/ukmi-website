@extends('layouts.tabler')

@section('title', 'Tambah Program Kerja')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Program Kerja Baru</h3>
            </div>
            <form action="{{ route('presidium.program-kerja.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label required">Judul Program Kerja</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Kajian Islami" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label required">Kategori Biro</label>
                                <select class="form-select @error('kategori_biro_id') is-invalid @enderror" name="kategori_biro_id" id="kategori_biro_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoriBiroList as $biro)
                                        <option value="{{ $biro->id }}" {{ old('kategori_biro_id', '') == $biro->id ? 'selected' : '' }}>{{ $biro->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_biro_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4" placeholder="Deskripsi program kerja">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Frekuensi Kegiatan (Jumlah Pertemuan)</label>
                                <input type="number" class="form-control @error('frekuensi_kegiatan') is-invalid @enderror" name="frekuensi_kegiatan" value="{{ old('frekuensi_kegiatan') }}" placeholder="Contoh: 12 (untuk 12 pertemuan)" min="1">
                                <small class="form-hint">Jumlah pertemuan yang direncanakan untuk program kerja ini</small>
                                @error('frekuensi_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Periode Kepengurusan</label>
                                <select class="form-select @error('periode_id') is-invalid @enderror" name="periode_id" id="periode_id">
                                    <option value="">Pilih Periode</option>
                                    @foreach($periodeList as $periode)
                                        <option value="{{ $periode->id }}" {{ old('periode_id', $periodeAktif?->id ?? '') == $periode->id ? 'selected' : '' }}>
                                            {{ $periode->nama_periode }}
                                            @if($periode->is_aktif) (Aktif) @endif
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-hint">Pilih periode kepengurusan untuk program kerja ini</small>
                                @error('periode_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label required">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" required>
                                    <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="aktif" {{ old('status', '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="selesai" {{ old('status', '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ old('status', '') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Foto Pamflet</label>
                                <input type="file" class="form-control @error('foto_progja') is-invalid @enderror" name="foto_progja" accept="image/*">
                                <small class="form-hint">Format: JPG, PNG, GIF (Max: 2MB)</small>
                                @error('foto_progja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Kader yang Mengikuti</label>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                            @forelse($kaders as $kader)
                                <label class="form-selectgroup-item">
                                    <input type="checkbox" name="kader_ids[]" value="{{ $kader->id }}" class="form-selectgroup-input" {{ in_array($kader->id, old('kader_ids', [])) ? 'checked' : '' }}>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="me-3">
                                            <x-avatar :user="$kader" size="sm" />
                                        </div>
                                        <div class="flex-fill">
                                            <strong>{{ $kader->name }}</strong>
                                            <div class="text-muted">{{ $kader->npm ?? '-' }}</div>
                                        </div>
                                    </span>
                                </label>
                            @empty
                                <p class="text-muted">Belum ada kader aktif</p>
                            @endforelse
                        </div>
                        <small class="form-hint">Pilih kader yang akan mengikuti program kerja ini</small>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('presidium.program-kerja.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-select dropdown jika belum ada nilai yang dipilih
        const kategoriBiro = document.getElementById('kategori_biro_id');
        const periodeId = document.getElementById('periode_id');
        const status = document.getElementById('status');
        
        // Auto-select kategori biro pertama jika belum dipilih
        if (kategoriBiro && !kategoriBiro.value && kategoriBiro.options.length > 1) {
            // Skip option pertama (Pilih Kategori) dan pilih yang kedua
            if (kategoriBiro.options[1]) {
                kategoriBiro.selectedIndex = 1;
            }
        }
        
        // Auto-select periode aktif jika ada dan belum dipilih
        if (periodeId && !periodeId.value) {
            // Cari option yang mengandung "(Aktif)"
            for (let i = 0; i < periodeId.options.length; i++) {
                if (periodeId.options[i].text.includes('(Aktif)')) {
                    periodeId.selectedIndex = i;
                    break;
                }
            }
        }
        
        // Status sudah default ke draft, tidak perlu diubah
    });
</script>
@endpush

