@extends('layouts.tabler')

@section('title', 'Tambah Video Tutorial')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Video Tutorial Baru</h3>
            </div>
            <form action="{{ route('presidium.video-tutorial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">Judul Video Tutorial</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Cara Menambahkan User Baru" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" placeholder="Keterangan umum tentang video tutorial ini">{{ old('keterangan') }}</textarea>
                        <small class="form-hint">Deskripsi singkat tentang video tutorial ini</small>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Modul</label>
                                <input type="text" class="form-control @error('modul') is-invalid @enderror" name="modul" value="{{ old('modul') }}" placeholder="Contoh: Manajemen User, Program Kerja, dll">
                                <small class="form-hint">Modul atau fitur yang dijelaskan dalam video</small>
                                @error('modul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Urutan Tampilan</label>
                                <input type="number" class="form-control @error('urutan') is-invalid @enderror" name="urutan" value="{{ old('urutan', 0) }}" min="0" placeholder="0">
                                <small class="form-hint">Urutan tampilan video (semakin kecil, semakin awal ditampilkan)</small>
                                @error('urutan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan Modul</label>
                        <textarea class="form-control @error('keterangan_modul') is-invalid @enderror" name="keterangan_modul" rows="3" placeholder="Keterangan detail tentang modul yang dijelaskan">{{ old('keterangan_modul') }}</textarea>
                        <small class="form-hint">Penjelasan detail tentang modul atau fitur yang dijelaskan dalam video</small>
                        @error('keterangan_modul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Video atau URL Video</label>
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#upload-tab" class="nav-link active" data-bs-toggle="tab">Upload Video</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#url-tab" class="nav-link" data-bs-toggle="tab">URL Video</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="upload-tab">
                                        <div class="mt-3">
                                            <input type="file" class="form-control @error('video') is-invalid @enderror" name="video" id="video" accept="video/*">
                                            <small class="form-hint">Format: MP4, AVI, MOV, WMV, FLV, WEBM. Maksimal 200MB</small>
                                            @error('video')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="url-tab">
                                        <div class="mt-3">
                                            <input type="url" class="form-control @error('video_url') is-invalid @enderror" name="video_url" id="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=... atau https://drive.google.com/file/d/...">
                                            <small class="form-hint">
                                                <strong>Format URL yang didukung:</strong><br>
                                                • YouTube: https://www.youtube.com/watch?v=VIDEO_ID atau https://youtu.be/VIDEO_ID<br>
                                                • Google Drive: https://drive.google.com/file/d/FILE_ID/view<br>
                                                • Google Drive (alternatif): https://drive.google.com/open?id=FILE_ID<br>
                                                • URL video lainnya (MP4, dll)<br><br>
                                                <strong>Catatan untuk Google Drive:</strong><br>
                                                Pastikan file video di Google Drive sudah di-share dengan setting "Anyone with the link can view" agar bisa diputar langsung di website.
                                            </small>
                                            @error('video_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Durasi (detik)</label>
                                <input type="number" class="form-control @error('durasi') is-invalid @enderror" name="durasi" value="{{ old('durasi') }}" min="0" placeholder="Contoh: 300 (untuk 5 menit)">
                                <small class="form-hint">Durasi video dalam detik (opsional)</small>
                                @error('durasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="is_aktif" value="1" {{ old('is_aktif', true) ? 'checked' : '' }}>
                                        <span class="form-check-label">Aktif</span>
                                    </label>
                                </div>
                                <small class="form-hint">Video yang aktif akan ditampilkan di daftar video tutorial</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('presidium.video-tutorial.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

