@extends('layouts.public')

@section('title', 'Video Tutorial')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center mb-4">
                <h1 class="display-4 fw-bold mb-3" style="color: #333;">
                    <i class="bi bi-play-circle-fill me-2 text-primary"></i>Video Tutorial
                </h1>
                <p class="lead text-muted">Panduan lengkap penggunaan sistem UKMI Ar-Rahman</p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-0">
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
                                <button type="button" class="btn btn-outline-secondary w-100" onclick="resetFilter()">
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
                    <div class="card h-100 shadow-sm border-0 video-card" style="transition: transform 0.3s, box-shadow 0.3s;">
                        <a href="{{ route('public.video-tutorial.show', $video) }}" class="text-decoration-none text-dark">
                            <div class="card-img-top position-relative" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-play-circle-fill text-white" style="font-size: 4rem; opacity: 0.8;"></i>
                                @if($video->modul)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-primary">{{ $video->modul }}</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-2" style="font-size: 0.95rem; line-height: 1.3;">
                                    {{ Str::limit($video->judul, 60) }}
                                </h5>
                                @if($video->keterangan)
                                    <p class="card-text text-muted small mb-2" style="font-size: 0.85rem;">
                                        {{ Str::limit($video->keterangan, 80) }}
                                    </p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>{{ $video->formatted_durasi }}
                                    </small>
                                    @if($video->creator)
                                        <small class="text-muted">
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
            <div class="col-12 d-flex justify-content-center">
                {{ $videoTutorials->links() }}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak ada video tutorial</h4>
                        <p class="text-muted">Belum ada video tutorial yang tersedia saat ini.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
</style>

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

