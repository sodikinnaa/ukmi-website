@extends('layouts.public')

@section('title', 'Video Tutorial')

@section('content')
<style>
    .video-tutorial-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .page-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 3rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .page-header h1 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
    }
    
    .filter-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        border: 1px solid rgba(255,255,255,0.5);
    }
    
    .video-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        border: none;
        transition: all 0.3s ease;
    }
    
    .video-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4) !important;
    }
    
    .video-thumbnail {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }
    
    .video-thumbnail::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);
    }
    
    .video-thumbnail .play-icon {
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
    }
    
    .video-card:hover .play-icon {
        transform: scale(1.2);
    }
    
    .modul-badge {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        font-weight: 600;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
    }
    
    .video-card-body {
        padding: 1.25rem;
    }
    
    .video-card-title {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    
    .video-card-title:hover {
        color: #667eea;
    }
    
    .video-meta {
        color: #718096;
        font-size: 0.85rem;
    }
    
    .video-meta i {
        color: #667eea;
    }
    
    .btn-filter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .form-select:focus, .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .pagination .page-link {
        color: #667eea;
        border-color: #e2e8f0;
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        color: white;
    }
    
    .pagination .page-link:hover {
        background: rgba(102, 126, 234, 0.1);
        border-color: #667eea;
        color: #667eea;
    }
</style>

<div class="video-tutorial-page">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header text-center">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="bi bi-play-circle-fill me-2"></i>Video Tutorial
                    </h1>
                    <p class="lead text-muted mb-0">Panduan lengkap penggunaan sistem UKMI Ar-Rahman</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="filter-card">
                    <div class="card-body p-4">
                    <form method="GET" action="{{ route('public.video-tutorial.index') }}" id="filterForm">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Filter Modul</label>
                                <select name="modul" class="form-select" id="modul">
                                    <option value="">Semua Modul</option>
                                    @foreach($modules as $module)
                                        <option value="{{ $module }}" {{ request('modul') == $module ? 'selected' : '' }}>
                                            {{ $module }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Pencarian</label>
                                <input type="text" name="search" class="form-control" placeholder="Cari judul, keterangan, atau modul..." value="{{ request('search') }}" id="searchInput">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-filter w-100" onclick="resetFilter()">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Grid -->
    @if($videoTutorials->count() > 0)
        <div class="row g-4">
            @foreach($videoTutorials as $video)
                <div class="col-md-4 col-lg-3">
                    <div class="video-card h-100 shadow-lg">
                        <a href="{{ route('public.video-tutorial.show', $video) }}" class="text-decoration-none">
                            <div class="video-thumbnail position-relative" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-play-circle-fill text-white play-icon" style="font-size: 4.5rem; opacity: 0.95; text-shadow: 0 4px 15px rgba(0,0,0,0.3);"></i>
                                @if($video->modul)
                                    <span class="position-absolute top-0 end-0 m-2 modul-badge">{{ $video->modul }}</span>
                                @endif
                            </div>
                            <div class="video-card-body">
                                <h5 class="video-card-title" style="font-size: 0.95rem; line-height: 1.3;">
                                    {{ Str::limit($video->judul, 60) }}
                                </h5>
                                @if($video->keterangan)
                                    <p class="text-muted small mb-3" style="font-size: 0.85rem; line-height: 1.5;">
                                        {{ Str::limit($video->keterangan, 80) }}
                                    </p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center video-meta">
                                    <small>
                                        <i class="bi bi-clock me-1"></i>{{ $video->formatted_durasi }}
                                    </small>
                                    @if($video->creator)
                                        <small>
                                            <i class="bi bi-person me-1"></i>{{ Str::limit($video->creator->name, 15) }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="filter-card">
                    <div class="card-body py-3">
                        <div class="d-flex justify-content-center">
                            {{ $videoTutorials->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="filter-card">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-inbox" style="font-size: 5rem; color: #cbd5e0;"></i>
                        </div>
                        <h4 class="text-muted mb-2">Tidak ada video tutorial</h4>
                        <p class="text-muted mb-0">Belum ada video tutorial yang tersedia saat ini.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>

@push('scripts')
<script>
    // Auto submit form ketika dropdown berubah
    document.getElementById('modul').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });

    // Debounce untuk search input
    let searchTimeout;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            document.getElementById('filterForm').submit();
        }, 500);
    });

    function resetFilter() {
        document.getElementById('modul').value = '';
        document.getElementById('searchInput').value = '';
        document.getElementById('filterForm').submit();
    }
</script>
@endpush
@endsection

