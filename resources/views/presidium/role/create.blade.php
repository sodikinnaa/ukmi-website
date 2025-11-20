@extends('layouts.tabler')

@section('title', 'Tambah Role')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Role Baru</h3>
            </div>
            <form action="{{ route('presidium.role.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">Nama Role</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="contoh: sekretaris" required>
                        <small class="form-hint">Nama role dalam format lowercase, tanpa spasi (contoh: sekretaris, koordinator)</small>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label required">Label</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" value="{{ old('label') }}" placeholder="contoh: Sekretaris" required>
                        <small class="form-hint">Label yang akan ditampilkan di sistem</small>
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Deskripsi role dan tanggung jawabnya">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('presidium.role.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

