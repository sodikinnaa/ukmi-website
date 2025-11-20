@extends('layouts.tabler')

@section('title', 'Dashboard Kabid')

@section('pretitle', 'Kepala Bidang/Biro')

@php
    $user = Auth::user();
    $programKerjaIds = $user->programKerjaDibuat()->pluck('id');
    $totalAbsensi = \App\Models\Absensi::whereIn('program_kerja_id', $programKerjaIds)->count();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Selamat Datang, Kepala Bidang/Biro UKMI</h2>
                <p class="text-muted">Sebagai Kepala Bidang/Biro, Anda bertanggung jawab untuk mengisi absensi dan dokumentasi yang diperlukan.</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Program Kerja Saya</div>
                </div>
                <div class="h1 mb-3">{{ $user->programKerjaDibuat()->count() }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Absensi</div>
                </div>
                <div class="h1 mb-3">{{ $totalAbsensi }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Dokumentasi</div>
                </div>
                <div class="h1 mb-3">{{ $user->dokumentasi()->count() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
