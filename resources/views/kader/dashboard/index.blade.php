@extends('layouts.tabler')

@section('title', 'Dashboard Kader')

@section('pretitle', 'Kader')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Selamat Datang, Kader UKMI</h2>
                <p class="text-muted">Sebagai Kader, Anda dapat melihat program yang sedang Anda kerjakan.</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Program Aktif</div>
                </div>
                <div class="h1 mb-3">{{ $user->programKerja()->count() }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Absensi</div>
                </div>
                <div class="h1 mb-3">{{ $user->absensi()->count() }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Kehadiran</div>
                </div>
                <div class="h1 mb-3">{{ $user->absensi()->where('status', 'hadir')->count() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
