@extends('layouts.tabler')

@section('title', 'Rekap Kehadiran')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="empty">
                    <div class="empty-img">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                            <path d="M9 12l2 2l4 -4" />
                        </svg>
                    </div>
                    <p class="empty-title">Coming Soon</p>
                    <p class="empty-subtitle text-muted">
                        Fitur Rekap Kehadiran sedang dalam pengembangan. 
                        <br>
                        Halaman ini akan segera hadir dengan fitur lengkap untuk melihat rekap kehadiran per program kerja.
                    </p>
                    <div class="empty-action">
                        <a href="{{ route('presidium.dashboard') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .empty {
        padding: 3rem 1rem;
        text-align: center;
    }
    
    .empty-img {
        margin-bottom: 2rem;
        opacity: 0.6;
    }
    
    .empty-img svg {
        width: 128px;
        height: 128px;
        color: var(--tblr-primary);
    }
    
    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--tblr-body-color);
    }
    
    .empty-subtitle {
        font-size: 1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .empty-action {
        margin-top: 2rem;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    .empty-img svg {
        animation: pulse 2s ease-in-out infinite;
    }
</style>
@endsection
