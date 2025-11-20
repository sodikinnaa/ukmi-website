@extends('layouts.tabler')

@section('title', 'Edit Absensi')

@section('pretitle', 'Absensi')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Absensi</h3>
                <div class="card-actions">
                    <a href="{{ route('absensi.history') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Info Program Kerja -->
                <div class="alert alert-info mb-4">
                    <div class="d-flex">
                        <div class="me-3">
                            @if($absensi->programKerja->foto_progja)
                                <img src="{{ asset('storage/' . $absensi->programKerja->foto_progja) }}" alt="{{ $absensi->programKerja->judul }}" class="avatar">
                            @else
                                <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $absensi->programKerja->judul }}" class="avatar">
                            @endif
                        </div>
                        <div class="flex-fill">
                            <h5 class="mb-1">{{ $absensi->programKerja->judul }}</h5>
                            <div class="text-muted small">
                                <span class="badge bg-blue">{{ $absensi->programKerja->kategoriBiro->nama ?? '-' }}</span>
                                <span class="badge bg-secondary ms-1">Pertemuan Ke-{{ $absensi->pertemuan_ke }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Edit Absensi -->
                <form action="{{ route('absensi.update', $absensi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pertemuan Ke</label>
                            <div class="form-control-plaintext">
                                <strong>Pertemuan Ke-{{ $absensi->pertemuan_ke }}</strong>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Absensi</label>
                            <div class="form-control-plaintext">
                                {{ $absensi->tanggal->format('d M Y') }}
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="hadir" {{ old('status', $absensi->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ old('status', $absensi->status) == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ old('status', $absensi->status) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alpha" {{ old('status', $absensi->status) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Keterangan (opsional)">{{ old('keterangan', $absensi->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Update Absensi</button>
                        <a href="{{ route('absensi.history') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

