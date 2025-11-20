@extends('layouts.tabler')

@section('title', 'Laporan')

@section('pretitle', 'Pembina')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Kegiatan Organisasi</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Laporan kegiatan organisasi akan ditampilkan di sini.</p>
            </div>
        </div>
    </div>
</div>
@endsection
