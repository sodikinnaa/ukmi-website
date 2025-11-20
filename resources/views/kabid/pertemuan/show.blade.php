@extends('layouts.tabler')

@section('title', 'Detail Pertemuan Ke-' . $pertemuan->pertemuan_ke)

@section('pretitle', 'Kepala Bidang/Biro')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pertemuan Ke-{{ $pertemuan->pertemuan_ke }}: {{ $programKerja->judul }}</h3>
                <div class="card-actions">
                    <a href="{{ route('kabid.program-kerja.show', $programKerja) }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('kabid.program-kerja.pertemuan.edit', [$programKerja, $pertemuan]) }}" class="btn btn-primary">Edit</a>
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
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Pertemuan Ke</label>
                        <div class="form-control-plaintext">
                            <span class="badge bg-blue">Pertemuan Ke-{{ $pertemuan->pertemuan_ke }}</span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Pertemuan</label>
                        <div class="form-control-plaintext">{{ $pertemuan->tanggal->format('d M Y') }}</div>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <div class="form-control-plaintext">{{ $pertemuan->deskripsi ?? '-' }}</div>
                    </div>
                </div>
                
                <hr>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Lokasi Kegiatan</label>
                        <div class="form-control-plaintext">
                            @if($pertemuan->lokasi_kegiatan)
                                <span class="badge bg-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                        <path d="M15 11a3 3 0 1 1 -6 0a3 3 0 0 1 6 0z" />
                                    </svg>
                                    {{ $pertemuan->lokasi_kegiatan }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Total Peserta</label>
                        <div class="form-control-plaintext">
                            @if($pertemuan->total_peserta)
                                <span class="badge bg-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    {{ $pertemuan->total_peserta }} Peserta
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($pertemuan->foto_kegiatan || $pertemuan->foto_absen)
                    <hr>
                    
                    <div class="row mb-4">
                        @if($pertemuan->foto_kegiatan)
                            <div class="col-md-6">
                                <label class="form-label">Foto Kegiatan</label>
                                <div class="mb-3">
                                    <a href="{{ asset('storage/' . $pertemuan->foto_kegiatan) }}" target="_blank" class="d-block">
                                        <img src="{{ asset('storage/' . $pertemuan->foto_kegiatan) }}" alt="Foto Kegiatan" class="img-fluid rounded shadow-sm" style="max-height: 400px; width: 100%; object-fit: cover; cursor: pointer;">
                                    </a>
                                    <small class="text-muted mt-2 d-block">Klik gambar untuk melihat ukuran penuh</small>
                                </div>
                            </div>
                        @endif
                        
                        @if($pertemuan->foto_absen)
                            <div class="col-md-6">
                                <label class="form-label">Foto Absen (PDF)</label>
                                <div class="mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg text-danger mb-3" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            </svg>
                                            <h4 class="card-title">Dokumen Absen</h4>
                                            <p class="text-muted mb-3">File PDF absensi pertemuan</p>
                                            <a href="{{ asset('storage/' . $pertemuan->foto_absen) }}" target="_blank" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                    <path d="M9 9l1 0" />
                                                    <path d="M9 13l6 0" />
                                                    <path d="M9 17l6 0" />
                                                </svg>
                                                Buka PDF
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="mb-3">Absensi Pertemuan Ini</h4>
                        @if($absensi->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>KADER</th>
                                            <th>STATUS</th>
                                            <th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($absensi as $absensiItem)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-2">
                                                            <x-avatar :user="$absensiItem->kader" size="sm" />
                                                        </span>
                                                        <div>
                                                            <strong>{{ $absensiItem->kader->name }}</strong>
                                                            <div class="text-muted">{{ $absensiItem->kader->npm ?? '-' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($absensiItem->status === 'hadir')
                                                        <span class="badge bg-green">{{ $absensiItem->status_label }}</span>
                                                    @elseif($absensiItem->status === 'izin')
                                                        <span class="badge bg-yellow">{{ $absensiItem->status_label }}</span>
                                                    @elseif($absensiItem->status === 'sakit')
                                                        <span class="badge bg-orange">{{ $absensiItem->status_label }}</span>
                                                    @else
                                                        <span class="badge bg-red">{{ $absensiItem->status_label }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $absensiItem->keterangan ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p class="mb-0">Belum ada absensi untuk pertemuan ini.</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <h4 class="mb-3">Dokumentasi Pertemuan Ini</h4>
                        @if($dokumentasi->count() > 0)
                            <div class="row">
                                @foreach($dokumentasi as $dokumentasiItem)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $dokumentasiItem->foto_dokumentasi) }}" alt="Dokumentasi" class="card-img-top" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                @if($dokumentasiItem->deskripsi)
                                                    <p class="text-muted mb-2">{{ $dokumentasiItem->deskripsi }}</p>
                                                @endif
                                                <small class="text-muted">Upload: {{ $dokumentasiItem->uploader->name ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p class="mb-0">Belum ada dokumentasi untuk pertemuan ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

