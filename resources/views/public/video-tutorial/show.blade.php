@extends('layouts.public')

@section('title', $videoTutorial->judul)

@section('content')
<style>
    .video-detail-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .detail-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.5);
        overflow: hidden;
    }
    
    .detail-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-bottom: none;
    }
    
    .modul-badge-detail {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.85rem;
        box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
        display: inline-block;
    }
    
    .video-info-item {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        padding: 0.75rem 1rem;
        border-radius: 10px;
        border-left: 4px solid #667eea;
    }
    
    .video-info-item i {
        color: #667eea;
        font-size: 1.1rem;
    }
    
    .related-video-item {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .related-video-item:hover {
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.1) 0%, transparent 100%);
        border-left-color: #667eea;
        transform: translateX(5px);
    }
    
    .related-thumbnail {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 8px;
    }
    
    .btn-back {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .breadcrumb-custom {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 2rem;
    }
    
    .breadcrumb-custom .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }
    
    .breadcrumb-custom .breadcrumb-item a:hover {
        color: #764ba2;
    }
</style>

<div class="video-detail-page">
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-custom mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.video-tutorial.index') }}">Video Tutorial</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($videoTutorial->judul, 50) }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Main Video -->
            <div class="col-lg-8">
                <div class="detail-card mb-4">
                    <div class="card-body p-4">
                        <h1 class="h3 fw-bold mb-3" style="color: #2d3748;">{{ $videoTutorial->judul }}</h1>
                        
                        @if($videoTutorial->modul)
                            <span class="modul-badge-detail mb-3">{{ $videoTutorial->modul }}</span>
                        @endif

                    @php
                        $videoType = $videoTutorial->getVideoSourceType();
                    @endphp

                        <!-- Video Player -->
                        <div class="mb-4" style="border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                            @if($videoType === 'local')
                                <video controls class="w-100" style="max-height: 500px; display: block;">
                                    <source src="{{ asset('storage/' . $videoTutorial->video_path) }}" type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            @elseif($videoType === 'google_drive')
                            @php
                                $embedUrl = $videoTutorial->getGoogleDriveEmbedUrl();
                            @endphp
                            @if($embedUrl)
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen style="width: 100%; height: 100%;"></iframe>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; font-weight: 600;">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>Buka di Google Drive
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning border-0" style="background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%); border-left: 4px solid #f59f00 !important;">
                                    <p class="mb-2"><strong>Link Google Drive tidak valid.</strong></p>
                                    <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; font-weight: 600;">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>Buka Link
                                    </a>
                                </div>
                            @endif
                            @elseif($videoType === 'youtube')
                                <div class="ratio ratio-16x9">
                                    @php
                                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $videoTutorial->video_url, $matches);
                                        $youtubeId = $matches[1] ?? null;
                                    @endphp
                                    @if($youtubeId)
                                        <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @else
                                        <div class="d-flex align-items-center justify-content-center" style="height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-light btn-lg">
                                                <i class="bi bi-play-circle me-2"></i>Buka Video
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @elseif($videoType === 'external')
                                <video controls class="w-100" style="max-height: 500px; display: block;">
                                    <source src="{{ $videoTutorial->video_url }}" type="video/mp4">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-light btn-lg">
                                            <i class="bi bi-play-circle me-2"></i>Buka Video
                                        </a>
                                    </div>
                                </video>
                            @endif
                        </div>

                        <!-- Description -->
                        @if($videoTutorial->keterangan)
                            <div class="mb-4 mt-4">
                                <h5 class="fw-bold mb-3" style="color: #2d3748;">
                                    <i class="bi bi-info-circle me-2 text-primary"></i>Deskripsi
                                </h5>
                                <p class="text-muted" style="line-height: 1.8;">{{ $videoTutorial->keterangan }}</p>
                            </div>
                        @endif

                        @if($videoTutorial->keterangan_modul)
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3" style="color: #2d3748;">
                                    <i class="bi bi-book me-2 text-primary"></i>Keterangan Modul
                                </h5>
                                <p class="text-muted" style="line-height: 1.8;">{{ $videoTutorial->keterangan_modul }}</p>
                            </div>
                        @endif

                        <!-- Video Info -->
                        <div class="row g-3 mt-4">
                            <div class="col-md-6">
                                <div class="video-info-item">
                                    <i class="bi bi-clock me-2"></i>
                                    <strong>Durasi:</strong> {{ $videoTutorial->formatted_durasi }}
                                </div>
                            </div>
                            @if($videoTutorial->creator)
                                <div class="col-md-6">
                                    <div class="video-info-item">
                                        <i class="bi bi-person me-2"></i>
                                        <strong>Oleh:</strong> {{ $videoTutorial->creator->name }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="video-info-item">
                                    <i class="bi bi-calendar me-2"></i>
                                    <strong>Dibuat:</strong> {{ $videoTutorial->created_at->format('d F Y') }}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related Videos -->
                @if($relatedVideos->count() > 0)
                    <div class="detail-card mb-4">
                        <div class="detail-card-header">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-collection-play me-2"></i>Video Terkait
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach($relatedVideos as $related)
                                    <a href="{{ route('public.video-tutorial.show', $related) }}" class="list-group-item list-group-item-action related-video-item border-0" style="padding: 1rem;">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-shrink-0 me-3 related-thumbnail" style="width: 80px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-play-circle-fill text-white" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-semibold" style="font-size: 0.9rem; color: #2d3748;">{{ Str::limit($related->judul, 50) }}</h6>
                                                <small class="text-muted">
                                                    <i class="bi bi-clock me-1"></i>{{ $related->formatted_durasi }}
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Back to List -->
                <div class="detail-card">
                    <div class="card-body text-center p-4">
                        <a href="{{ route('public.video-tutorial.index') }}" class="btn btn-back w-100">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Video
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

