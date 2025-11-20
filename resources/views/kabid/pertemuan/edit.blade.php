@extends('layouts.tabler')

@section('title', 'Edit Pertemuan')

@section('pretitle', 'Kepala Bidang/Biro')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Pertemuan Ke-{{ $pertemuan->pertemuan_ke }}: {{ $programKerja->judul }}</h3>
            </div>
            <form action="{{ route('kabid.program-kerja.pertemuan.update', [$programKerja, $pertemuan]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Pertemuan Ke</label>
                                <input type="number" class="form-control @error('pertemuan_ke') is-invalid @enderror" name="pertemuan_ke" value="{{ old('pertemuan_ke', $pertemuan->pertemuan_ke) }}" min="1" max="{{ $programKerja->frekuensi_kegiatan }}" required>
                                @error('pertemuan_ke')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Tanggal Pertemuan</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', $pertemuan->tanggal->format('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Pertemuan</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi', $pertemuan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lokasi Kegiatan</label>
                                <input type="text" class="form-control @error('lokasi_kegiatan') is-invalid @enderror" name="lokasi_kegiatan" value="{{ old('lokasi_kegiatan', $pertemuan->lokasi_kegiatan) }}" placeholder="Contoh: Ruang Aula, Lab Komputer, dll">
                                @error('lokasi_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Total Peserta</label>
                                <input type="number" class="form-control @error('total_peserta') is-invalid @enderror" name="total_peserta" value="{{ old('total_peserta', $pertemuan->total_peserta) }}" min="0" placeholder="Jumlah peserta yang hadir">
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
                                @if($pertemuan->foto_kegiatan)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $pertemuan->foto_kegiatan) }}" alt="Foto Kegiatan" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        <div class="mt-1">
                                            <small class="text-muted">Foto saat ini</small>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('foto_kegiatan') is-invalid @enderror" name="foto_kegiatan" accept="image/*">
                                <small class="form-hint">Format: JPG, PNG, GIF (Max: 5MB). Kosongkan jika tidak ingin mengubah.</small>
                                @error('foto_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Foto Absen (PDF)</label>
                                @if($pertemuan->foto_absen)
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $pertemuan->foto_absen) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            </svg>
                                            Lihat PDF Saat Ini
                                        </a>
                                        <div class="mt-1">
                                            <small class="text-muted">File saat ini</small>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('foto_absen') is-invalid @enderror" name="foto_absen" accept="application/pdf">
                                <small class="form-hint">Format: PDF (Max: 10MB). Kosongkan jika tidak ingin mengubah.</small>
                                @error('foto_absen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('kabid.program-kerja.show', $programKerja) }}" class="btn btn-secondary">Batal</a>
                    <form action="{{ route('kabid.program-kerja.pertemuan.destroy', [$programKerja, $pertemuan]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertemuan ini? Nomor pertemuan yang tersisa akan disesuaikan secara otomatis.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 7l16 0" />
                                <path d="M10 11l0 6" />
                                <path d="M14 11l0 6" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                            Hapus Pertemuan
                        </button>
                    </form>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

