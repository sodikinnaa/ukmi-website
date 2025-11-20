@extends('layouts.tabler')

@section('title', 'Edit Kategori Biro')

@section('pretitle', 'Presidium')

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Kategori Biro: {{ $kategoriBiro->nama }}</h3>
            </div>
            <form action="{{ route('presidium.kategori-biro.update', $kategoriBiro) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Kode</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ old('kode', $kategoriBiro->kode) }}" required>
                                <small class="form-hint">Kode unik untuk kategori biro (huruf kecil, tanpa spasi)</small>
                                @error('kode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $kategoriBiro->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi', $kategoriBiro->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_aktif" value="1" {{ old('is_aktif', $kategoriBiro->is_aktif) ? 'checked' : '' }}>
                            <span class="form-check-label">Status Aktif</span>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('presidium.kategori-biro.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

