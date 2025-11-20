@extends('layouts.tabler')

@section('title', 'Tambah Pertemuan')

@section('pretitle', 'Kepala Bidang/Biro')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Pertemuan untuk: {{ $programKerja->judul }}</h3>
            </div>
            <form action="{{ route('kabid.program-kerja.pertemuan.store', $programKerja) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Pertemuan Ke</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('pertemuan_ke') is-invalid @enderror" name="pertemuan_ke" id="pertemuan_ke" value="{{ old('pertemuan_ke', $pertemuanBerikutnya) }}" min="1" max="{{ $programKerja->frekuensi_kegiatan ?? '' }}" required readonly style="background-color: #f8f9fa; cursor: not-allowed;">
                                    <span class="input-group-text bg-success text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                        Auto
                                    </span>
                                </div>
                                <small class="form-hint text-success">
                                    <strong>Otomatis:</strong> Pertemuan ke-<strong>{{ $pertemuanBerikutnya }}</strong>
                                    @php
                                        $existingPertemuan = $programKerja->pertemuan()->orderBy('pertemuan_ke')->pluck('pertemuan_ke')->toArray();
                                        $maxPertemuan = !empty($existingPertemuan) ? max($existingPertemuan) : 0;
                                        $isGap = $pertemuanBerikutnya <= $maxPertemuan;
                                    @endphp
                                    @if($programKerja->jumlah_pertemuan > 0)
                                        @if($isGap)
                                            <br><span class="text-warning">⚠ Mengisi gap: Pertemuan yang sudah ada: {{ implode(', ', $existingPertemuan) }}</span>
                                        @else
                                            <br>Pertemuan yang sudah ada: {{ implode(', ', $existingPertemuan) }}
                                        @endif
                                    @else
                                        <br>Ini adalah pertemuan pertama
                                    @endif
                                </small>
                                @error('pertemuan_ke')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Tanggal Pertemuan</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Pertemuan</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4" placeholder="Deskripsi atau agenda pertemuan">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lokasi Kegiatan</label>
                                <input type="text" class="form-control @error('lokasi_kegiatan') is-invalid @enderror" name="lokasi_kegiatan" value="{{ old('lokasi_kegiatan') }}" placeholder="Contoh: Ruang Aula, Lab Komputer, dll">
                                @error('lokasi_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Total Peserta</label>
                                <input type="number" class="form-control @error('total_peserta') is-invalid @enderror" name="total_peserta" value="{{ old('total_peserta') }}" min="0" placeholder="Jumlah peserta yang hadir">
                                @error('total_peserta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Foto Kegiatan</label>
                                <input type="file" class="form-control @error('foto_kegiatan') is-invalid @enderror" name="foto_kegiatan" accept="image/*">
                                <small class="form-hint">Format: JPG, PNG, GIF (Max: 5MB)</small>
                                @error('foto_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Foto Absen (PDF)</label>
                                <input type="file" class="form-control @error('foto_absen') is-invalid @enderror" name="foto_absen" accept="application/pdf">
                                <small class="form-hint">Format: PDF (Max: 10MB)</small>
                                @error('foto_absen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    @if($programKerja->frekuensi_kegiatan)
                        <div class="alert alert-info">
                            <strong>Info:</strong> Program kerja ini direncanakan untuk {{ $programKerja->frekuensi_kegiatan }} pertemuan. 
                            Pertemuan yang sudah dilakukan: {{ $programKerja->jumlah_pertemuan }} / {{ $programKerja->frekuensi_kegiatan }}
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('kabid.program-kerja.show', $programKerja) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

