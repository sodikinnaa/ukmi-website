@extends('layouts.public')

@section('title', 'Struktur Organisasi - UKMI Ar-Rahman')

@section('content')
@if(!$periodeAktif)
    <div class="org-card">
        <div class="org-header">
            <h1><i class="bi bi-building"></i> Struktur Organisasi</h1>
            <p>UKMI Ar-Rahman</p>
        </div>
        <div class="p-5">
            <div class="empty-state">
                <i class="bi bi-exclamation-triangle"></i>
                <h3>Saat ini belum ada periode kepengurusan yang aktif</h3>
                <p class="text-muted">Silakan hubungi admin untuk mengaktifkan periode kepengurusan.</p>
            </div>
        </div>
    </div>
@else
    <!-- Header Section -->
    <div class="org-card mb-4">
        <div class="org-header">
            <h1><i class="bi bi-diagram-3-fill"></i> Struktur Organisasi</h1>
            <p class="mb-0">UKMI Ar-Rahman - {{ $periodeAktif->nama_periode }}</p>
            <div class="mt-3">
                <span class="badge-custom bg-light text-dark">
                    <i class="bi bi-calendar-event"></i> 
                    {{ $periodeAktif->tanggal_mulai->format('d M Y') }} - 
                    {{ $periodeAktif->tanggal_selesai ? $periodeAktif->tanggal_selesai->format('d M Y') : 'Sekarang' }}
                </span>
                <span class="badge-custom bg-success ms-2">
                    <i class="bi bi-check-circle"></i> Periode Aktif
                </span>
            </div>
            @if($periodeAktif->deskripsi)
                <p class="mt-3 mb-0" style="opacity: 0.9;">{{ $periodeAktif->deskripsi }}</p>
            @endif
        </div>
    </div>

    <!-- Presidium Section -->
    @if($periodeAktif->presidium->count() > 0)
    <div class="presidium-section">
        <div class="container">
            <h2 class="section-title">
                <i class="bi bi-star-fill"></i> Presidium
            </h2>
            <div class="row g-4">
                @foreach($periodeAktif->presidium as $presidium)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="presidium-card">
                        @if($presidium->foto_profile)
                            <img src="{{ asset('storage/' . $presidium->foto_profile) }}" alt="{{ $presidium->name }}" class="presidium-avatar">
                        @else
                            <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $presidium->name }}" class="presidium-avatar">
                        @endif
                        <h5 class="fw-bold mb-1">{{ $presidium->name }}</h5>
                        <p class="text-primary mb-2 fw-semibold">
                            <i class="bi bi-briefcase"></i> {{ $presidium->jabatan ?? 'Presidium' }}
                        </p>
                        @if($presidium->email)
                            <p class="text-muted small mb-0">
                                <i class="bi bi-envelope"></i> {{ $presidium->email }}
                            </p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Kategori Biro Section -->
    <div class="mt-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-white">
                <i class="bi bi-diagram-2"></i> Struktur Bidang & Kategori Biro
            </h2>
            <p class="text-white" style="opacity: 0.8;">Susunan pengurus di setiap bidang dan kategori biro</p>
        </div>

        @if($kategoriBiro->count() > 0)
            <div class="row">
                @foreach($kategoriBiro as $biro)
                <div class="col-lg-6 mb-4">
                    <div class="biro-card">
                        <div class="biro-header">
                            <div class="biro-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-1">{{ $biro->nama }}</h4>
                                <span class="badge bg-primary">{{ $biro->kode }}</span>
                                @if($biro->deskripsi)
                                    <p class="text-muted small mb-0 mt-2">{{ Str::limit($biro->deskripsi, 100) }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Kabid Section -->
                        @if($biro->kabid->count() > 0)
                            <div class="mb-3">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-person-badge"></i> Kepala Bidang
                                </h6>
                                @foreach($biro->kabid as $kabid)
                                    <div class="member-card">
                                        @if($kabid->foto_profile)
                                            <img src="{{ asset('storage/' . $kabid->foto_profile) }}" alt="{{ $kabid->name }}" class="member-avatar">
                                        @else
                                            <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $kabid->name }}" class="member-avatar">
                                        @endif
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">{{ $kabid->name }}</h6>
                                            <p class="text-muted small mb-0">
                                                <i class="bi bi-briefcase"></i> {{ $kabid->jabatan ?? 'Kepala Bidang' }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Kader Section -->
                        @if($biro->kader->count() > 0)
                            <div>
                                <h6 class="fw-bold text-success mb-3">
                                    <i class="bi bi-people"></i> Anggota Kader ({{ $biro->kader->count() }})
                                </h6>
                                <div class="row g-2">
                                    @foreach($biro->kader as $kader)
                                        <div class="col-12">
                                            <div class="member-card">
                                                @if($kader->foto_profile)
                                                    <img src="{{ asset('storage/' . $kader->foto_profile) }}" alt="{{ $kader->name }}" class="member-avatar">
                                                @else
                                                    <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $kader->name }}" class="member-avatar">
                                                @endif
                                                <div class="flex-grow-1">
                                                    <h6 class="fw-semibold mb-1">{{ $kader->name }}</h6>
                                                    @if($kader->npm)
                                                        <p class="text-muted small mb-0">
                                                            <i class="bi bi-person-badge"></i> NPM: {{ $kader->npm }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center py-3 text-muted">
                                <i class="bi bi-info-circle"></i> Belum ada kader yang ditambahkan pada kategori ini
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="org-card">
                <div class="p-5">
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h3>Belum ada kategori biro yang aktif</h3>
                        <p class="text-muted">Silakan hubungi admin untuk menambahkan kategori biro.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif

@php
    use Illuminate\Support\Str;
@endphp

@push('styles')
<style>
    .presidium-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 0;
        margin: 2rem 0;
        border-radius: 20px;
    }
    
    .section-title {
        font-weight: 700;
        font-size: 2rem;
        color: white;
        margin-bottom: 2rem;
        text-align: center;
    }
    
    @media (max-width: 768px) {
        .section-title {
            font-size: 1.5rem;
        }
    }
</style>
@endpush
@endsection
