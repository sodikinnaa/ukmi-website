@extends('layouts.tabler')

@section('title', 'Tambah Periode Kepengurusan')

@section('pretitle', 'Pembina')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Periode Kepengurusan Baru</h3>
            </div>
            <form action="{{ route('pembina.periode.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Nama Periode</label>
                                <input type="text" class="form-control @error('nama_periode') is-invalid @enderror" name="nama_periode" value="{{ old('nama_periode') }}" placeholder="Contoh: Periode 2024-2025" required>
                                @error('nama_periode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Tanggal Mulai</label>
                                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                                <small class="form-hint">Kosongkan jika periode masih berjalan</small>
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" placeholder="Deskripsi periode kepengurusan">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_aktif" value="1" {{ old('is_aktif') ? 'checked' : '' }}>
                            <span class="form-check-label">Aktifkan periode ini</span>
                        </label>
                        <small class="form-hint">Jika diaktifkan, periode aktif lainnya akan otomatis dinonaktifkan</small>
                    </div>
                    
                    <hr>
                    
                    <div class="mb-3">
                        <label class="form-label required">Presidium Periode Ini</label>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                            @forelse($presidiumList as $presidium)
                                <label class="form-selectgroup-item">
                                    <input type="checkbox" name="presidium_ids[]" value="{{ $presidium->id }}" class="form-selectgroup-input" {{ in_array($presidium->id, old('presidium_ids', [])) ? 'checked' : '' }}>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="me-3">
                                            <x-avatar :user="$presidium" size="sm" />
                                        </div>
                                        <div class="flex-fill">
                                            <strong>{{ $presidium->name }}</strong>
                                            <div class="text-muted">{{ $presidium->email }}</div>
                                            @if($presidium->npm)
                                                <div class="text-muted">NPM: {{ $presidium->npm }}</div>
                                            @endif
                                        </div>
                                    </span>
                                </label>
                            @empty
                                <div class="alert alert-warning">
                                    <p class="mb-0">Belum ada user dengan role Presidium. Silakan tambahkan user Presidium terlebih dahulu.</p>
                                </div>
                            @endforelse
                        </div>
                        <small class="form-hint">Pilih presidium yang akan menjabat di periode ini (minimal 1 presidium)</small>
                        @error('presidium_ids')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('pembina.periode.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

