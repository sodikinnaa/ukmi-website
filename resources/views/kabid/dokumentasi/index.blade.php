@extends('layouts.tabler')

@section('title', 'Dokumentasi')

@section('pretitle', 'Kabid')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload Dokumentasi</h3>
                <div class="card-actions">
                    <a href="#" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Upload Dokumentasi
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted">Form untuk upload dokumentasi kegiatan akan ditampilkan di sini.</p>
            </div>
        </div>
    </div>
</div>
@endsection
