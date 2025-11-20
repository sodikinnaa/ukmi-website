@extends('layouts.tabler')

@section('title', 'Import User')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Import User dari CSV</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h4 class="alert-title">Panduan Import User</h4>
                    <div class="text-muted">
                        <ol class="mb-0">
                            <li>Download template CSV terlebih dahulu dengan mengklik tombol <strong>"Download Template"</strong></li>
                            <li>Isi data user sesuai dengan format template</li>
                            <li>Kolom yang wajib diisi: <strong>Nama, Email, Role</strong></li>
                            <li>Password akan otomatis menggunakan NPM jika NPM diisi</li>
                            <li>Jika NPM tidak diisi, password akan dibuat random (user harus reset password)</li>
                            <li>Role harus sesuai dengan role yang ada di sistem (presidium, kabid, kader, pembina)</li>
                            <li>Status Aktif: isi dengan "Ya" atau "Tidak"</li>
                            <li>Upload file CSV yang sudah diisi</li>
                        </ol>
                    </div>
                </div>
                
                <form action="{{ route('presidium.user.import.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label required">File CSV</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" accept=".csv,.txt" required>
                        <small class="form-hint">Format: CSV (Comma Separated Values). Maksimal 2MB</small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('presidium.user.download-template') }}" class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11v6" /><path d="M9 14l3 -3l3 3" /></svg>
                            Download Template
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11v6" /><path d="M9 14l3 3l3 -3" /></svg>
                            Upload & Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Format CSV</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Kolom</th>
                                <th>Wajib</th>
                                <th>Deskripsi</th>
                                <th>Contoh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td><span class="badge bg-red">Ya</span></td>
                                <td>Nama lengkap user</td>
                                <td>Ahmad Fauzi</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><span class="badge bg-red">Ya</span></td>
                                <td>Email user (harus unik)</td>
                                <td>ahmad@example.com</td>
                            </tr>
                            <tr>
                                <td><strong>Role</strong></td>
                                <td><span class="badge bg-red">Ya</span></td>
                                <td>Role user (presidium, kabid, kader, pembina)</td>
                                <td>kader</td>
                            </tr>
                            <tr>
                                <td><strong>NPM</strong></td>
                                <td><span class="badge bg-secondary">Tidak</span></td>
                                <td>NPM user (akan digunakan sebagai password default)</td>
                                <td>1234567890</td>
                            </tr>
                            <tr>
                                <td><strong>Jurusan</strong></td>
                                <td><span class="badge bg-secondary">Tidak</span></td>
                                <td>Jurusan user</td>
                                <td>Teknik Informatika</td>
                            </tr>
                            <tr>
                                <td><strong>Nomor WA</strong></td>
                                <td><span class="badge bg-secondary">Tidak</span></td>
                                <td>Nomor WhatsApp</td>
                                <td>081234567890</td>
                            </tr>
                            <tr>
                                <td><strong>Hobi</strong></td>
                                <td><span class="badge bg-secondary">Tidak</span></td>
                                <td>Hobi user</td>
                                <td>Membaca, Olahraga</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td><span class="badge bg-secondary">Tidak</span></td>
                                <td>Alamat user</td>
                                <td>Jl. Contoh No. 123</td>
                            </tr>
                            <tr>
                                <td><strong>Status Aktif</strong></td>
                                <td><span class="badge bg-secondary">Tidak</span></td>
                                <td>Status aktif user (Ya/Tidak)</td>
                                <td>Ya</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

