@extends('layouts.tabler')

@section('title', 'Tambah Menu')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Menu Baru</h3>
            </div>
            <form action="{{ route('presidium.menu.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">Nama Menu</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="contoh: presidium.user" required>
                        <small class="form-hint">Nama menu dalam format lowercase dengan titik (contoh: presidium.user, kabid.absensi)</small>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label required">Label</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" value="{{ old('label') }}" placeholder="contoh: Manajemen User" required>
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Route</label>
                        <input type="text" class="form-control @error('route') is-invalid @enderror" name="route" value="{{ old('route') }}" placeholder="contoh: presidium.user.index">
                        <small class="form-hint">Nama route yang akan digunakan (opsional)</small>
                        @error('route')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Icon (SVG)</label>
                        <textarea class="form-control @error('icon') is-invalid @enderror" name="icon" rows="3" placeholder="Paste SVG code di sini">{{ old('icon') }}</textarea>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Parent Menu</label>
                        <select class="form-select @error('parent_id') is-invalid @enderror" name="parent_id">
                            <option value="">Tidak ada (Menu Utama)</option>
                            @foreach($parentMenus as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->label }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ old('order', 0) }}" min="0">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <span class="form-check-label">Aktif</span>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('presidium.menu.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

