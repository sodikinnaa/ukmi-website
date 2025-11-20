@extends('layouts.tabler')

@section('title', 'Edit Program Kerja')

@section('pretitle', 'Kepala Bidang/Biro')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Program Kerja: {{ $programKerja->judul }}</h3>
            </div>
            <form action="{{ route('kabid.program-kerja.update', $programKerja) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                            </div>
                            <div>
                                <strong>Catatan:</strong> Sebagai Kepala Bidang/Biro, Anda hanya dapat mengedit judul, deskripsi, frekuensi kegiatan, status, dan foto program kerja. Kategori biro dan periode tidak dapat diubah.
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kategori Biro</label>
                                <input type="text" class="form-control" value="{{ $programKerja->kategoriBiro->nama ?? $programKerja->kategori_biro_label }}" readonly style="background-color: #f8f9fa; cursor: not-allowed;">
                                <small class="form-hint text-muted">Kategori biro tidak dapat diubah</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Periode Kepengurusan</label>
                                <input type="text" class="form-control" value="{{ $programKerja->periode->nama_periode ?? '-' }}@if($programKerja->periode && $programKerja->periode->is_aktif) (Aktif) @endif" readonly style="background-color: #f8f9fa; cursor: not-allowed;">
                                <small class="form-hint text-muted">Periode tidak dapat diubah</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Judul Program Kerja</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $programKerja->judul) }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi', $programKerja->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Frekuensi Kegiatan (Jumlah Pertemuan)</label>
                                <input type="number" class="form-control @error('frekuensi_kegiatan') is-invalid @enderror" name="frekuensi_kegiatan" value="{{ old('frekuensi_kegiatan', $programKerja->frekuensi_kegiatan) }}" min="1">
                                <small class="form-hint">Jumlah pertemuan yang direncanakan untuk program kerja ini</small>
                                @error('frekuensi_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                    <option value="draft" {{ old('status', $programKerja->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="aktif" {{ old('status', $programKerja->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="selesai" {{ old('status', $programKerja->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ old('status', $programKerja->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
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
                                <div class="mb-2">
                                    @if($programKerja->foto_progja)
                                        <img src="{{ asset('storage/' . $programKerja->foto_progja) }}" alt="{{ $programKerja->judul }}" class="img-fluid rounded" style="max-height: 200px;">
                                    @else
                                        <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $programKerja->judul }}" class="img-fluid rounded" style="max-height: 200px;">
                                    @endif
                                </div>
                                <input type="file" class="form-control @error('foto_progja') is-invalid @enderror" name="foto_progja" accept="image/*">
                                <small class="form-hint">Format: JPG, PNG, GIF (Max: 2MB). Kosongkan jika tidak ingin mengubah foto.</small>
                                @error('foto_progja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('kabid.program-kerja.show', $programKerja) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

