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
    
    /* Video Player Styles - Mobile Friendly */
    .video-player-container {
        position: relative;
        width: 100%;
        background: #000;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    
    .video-player-container video {
        width: 100%;
        height: auto;
        display: block;
        min-height: 400px;
    }
    
    .video-player-container iframe {
        width: 100%;
        height: 100%;
        display: block;
    }
    
    .video-player-container .ratio {
        position: relative;
        width: 100%;
        min-height: 400px;
    }
    
    .video-player-container .ratio-16x9 {
        --bs-aspect-ratio: 56.25%;
    }
    
    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .video-detail-page {
            padding: 0.5rem 0;
        }
        
        .container {
            padding-left: 0;
            padding-right: 0;
        }
        
        .video-player-container {
            margin: 0;
            width: 100%;
            border-radius: 0;
            position: relative;
        }
        
        .video-player-container video {
            max-height: none !important;
            height: auto;
            min-height: 50vh;
            width: 100%;
        }
        
        .video-player-container .ratio {
            min-height: 50vh;
            height: 50vh;
        }
        
        .video-player-container .ratio-16x9 {
            --bs-aspect-ratio: 56.25%;
            min-height: 50vh;
        }
        
        .video-player-container iframe {
            min-height: 50vh;
        }
        
        /* Make video full width on mobile */
        .col-lg-8 {
            padding: 0;
        }
        
        .detail-card {
            border-radius: 0;
            margin: 0;
            width: 100%;
        }
        
        .detail-card .card-body {
            padding: 1rem;
        }
        
        /* Fullscreen button larger on mobile */
        .fullscreen-btn {
            width: 50px;
            height: 50px;
            bottom: 10px;
            right: 10px;
        }
        
        .fullscreen-btn i {
            font-size: 1.4rem;
        }
        
        /* Hide sidebar on mobile, show below */
        .col-lg-4 {
            margin-top: 1rem;
            padding: 0 15px;
        }
        
        /* Breadcrumb smaller on mobile */
        .breadcrumb-custom {
            margin: 0 15px 1rem 15px;
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }
    }
    
    /* Extra small devices */
    @media (max-width: 576px) {
        .video-player-container video {
            min-height: 40vh;
        }
        
        .video-player-container .ratio {
            min-height: 40vh;
            height: 40vh;
        }
        
        .video-player-container .ratio-16x9 {
            min-height: 40vh;
        }
    }
    
    /* Fullscreen Button */
    .fullscreen-btn {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: 2px solid white;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .fullscreen-btn:hover {
        background: rgba(102, 126, 234, 0.9);
        border-color: #667eea;
        transform: scale(1.1);
    }
    
    .fullscreen-btn i {
        font-size: 1.2rem;
    }
    
    /* Fullscreen mode */
    .video-fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        background: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        margin: 0;
    }
    
    .video-fullscreen video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        max-width: 100vw;
        max-height: 100vh;
    }
    
    .video-fullscreen iframe {
        width: 100%;
        height: 100%;
        max-width: 100vw;
        max-height: 100vh;
        border: none;
    }
    
    .video-fullscreen .ratio {
        width: 100%;
        height: 100%;
        max-width: 100vw;
        max-height: 100vh;
    }
    
    .video-fullscreen .ratio-16x9 {
        --bs-aspect-ratio: 56.25%;
        height: 100vh;
    }
    
    .close-fullscreen {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.9);
        color: #333;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10000;
        font-size: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    
    .close-fullscreen:hover {
        background: white;
        transform: scale(1.1);
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
                        <div class="video-player-container mb-4" id="videoPlayerContainer">
                            @if($videoType === 'local')
                                <video controls class="w-100" id="videoPlayer" playsinline webkit-playsinline>
                                    <source src="{{ asset('storage/' . $videoTutorial->video_path) }}" type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                                <button class="fullscreen-btn" onclick="toggleFullscreen('videoPlayer', 'video')" title="Fullscreen">
                                    <i class="bi bi-fullscreen"></i>
                                </button>
                            @elseif($videoType === 'google_drive')
                            @php
                                $embedUrl = $videoTutorial->getGoogleDriveEmbedUrl();
                            @endphp
                            @if($embedUrl)
                                <div class="ratio ratio-16x9" id="googleDrivePlayer">
                                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen style="width: 100%; height: 100%;"></iframe>
                                </div>
                                <button class="fullscreen-btn" onclick="toggleFullscreen('googleDrivePlayer', 'iframe')" title="Fullscreen">
                                    <i class="bi bi-fullscreen"></i>
                                </button>
                                <div class="mt-3 px-2">
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
                                <div class="ratio ratio-16x9" id="youtubePlayer">
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
                                <button class="fullscreen-btn" onclick="toggleFullscreen('youtubePlayer', 'iframe')" title="Fullscreen">
                                    <i class="bi bi-fullscreen"></i>
                                </button>
                            @elseif($videoType === 'external')
                                <video controls class="w-100" id="externalVideoPlayer" playsinline webkit-playsinline>
                                    <source src="{{ $videoTutorial->video_url }}" type="video/mp4">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-light btn-lg">
                                            <i class="bi bi-play-circle me-2"></i>Buka Video
                                        </a>
                                    </div>
                                </video>
                                <button class="fullscreen-btn" onclick="toggleFullscreen('externalVideoPlayer', 'video')" title="Fullscreen">
                                    <i class="bi bi-fullscreen"></i>
                                </button>
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

@push('scripts')
<script>
    let isFullscreen = false;
    let fullscreenContainer = null;
    let originalElement = null;
    
    function toggleFullscreen(elementId, type = 'video') {
        const element = document.getElementById(elementId);
        if (!element) return;
        
        if (!isFullscreen) {
            enterFullscreen(element, type);
        } else {
            exitFullscreen();
        }
    }
    
    function enterFullscreen(element, type) {
        // Try native fullscreen API first (better for mobile)
        if (type === 'video' && element.tagName === 'VIDEO') {
            if (element.requestFullscreen) {
                element.requestFullscreen().catch(() => {
                    // Fallback to custom fullscreen
                    createCustomFullscreen(element, type);
                });
                return;
            } else if (element.webkitEnterFullscreen) {
                // iOS Safari
                element.webkitEnterFullscreen();
                return;
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
                return;
            }
        }
        
        // Use custom fullscreen for iframes and fallback
        createCustomFullscreen(element, type);
    }
    
    function createCustomFullscreen(element, type) {
        // Store original
        originalElement = element;
        
        // Create fullscreen container
        fullscreenContainer = document.createElement('div');
        fullscreenContainer.className = 'video-fullscreen';
        fullscreenContainer.id = 'fullscreenContainer';
        
        // Clone element
        const clonedElement = element.cloneNode(true);
        
        // For video elements
        if (type === 'video' && clonedElement.tagName === 'VIDEO') {
            clonedElement.controls = true;
            clonedElement.setAttribute('playsinline', '');
            clonedElement.setAttribute('webkit-playsinline', '');
            clonedElement.style.width = '100%';
            clonedElement.style.height = '100%';
            clonedElement.style.objectFit = 'contain';
        }
        
        // For iframe elements
        if (clonedElement.tagName === 'IFRAME' || clonedElement.classList.contains('ratio')) {
            if (clonedElement.tagName === 'IFRAME') {
                clonedElement.style.width = '100%';
                clonedElement.style.height = '100%';
            } else {
                clonedElement.style.width = '100%';
                clonedElement.style.height = '100%';
            }
        }
        
        // Add close button
        const closeBtn = document.createElement('button');
        closeBtn.className = 'close-fullscreen';
        closeBtn.innerHTML = '<i class="bi bi-x-lg"></i>';
        closeBtn.onclick = exitFullscreen;
        closeBtn.setAttribute('aria-label', 'Tutup Fullscreen');
        closeBtn.title = 'Tutup Fullscreen (ESC)';
        
        // Append to container
        fullscreenContainer.appendChild(clonedElement);
        fullscreenContainer.appendChild(closeBtn);
        
        // Add to body
        document.body.appendChild(fullscreenContainer);
        document.body.style.overflow = 'hidden';
        
        // Play video if it's a video element
        if (type === 'video' && clonedElement.tagName === 'VIDEO') {
            setTimeout(() => {
                clonedElement.play().catch(e => {
                    console.log('Autoplay prevented:', e);
                });
            }, 200);
        }
        
        isFullscreen = true;
        
        // Event listeners
        document.addEventListener('keydown', handleEscapeKey);
        window.addEventListener('orientationchange', handleOrientationChange);
    }
    
    function exitFullscreen() {
        if (fullscreenContainer) {
            fullscreenContainer.remove();
            fullscreenContainer = null;
        }
        
        document.body.style.overflow = '';
        isFullscreen = false;
        originalElement = null;
        
        // Remove event listeners
        document.removeEventListener('keydown', handleEscapeKey);
        window.removeEventListener('orientationchange', handleOrientationChange);
        
        // Exit native fullscreen if active
        if (document.fullscreenElement) {
            document.exitFullscreen();
        } else if (document.webkitFullscreenElement) {
            document.webkitExitFullscreen();
        } else if (document.mozFullScreenElement) {
            document.mozCancelFullScreen();
        } else if (document.msFullscreenElement) {
            document.msExitFullscreen();
        }
    }
    
    function handleEscapeKey(e) {
        if (e.key === 'Escape' && isFullscreen) {
            exitFullscreen();
        }
    }
    
    function handleOrientationChange() {
        // Recalculate dimensions on orientation change
        if (isFullscreen && fullscreenContainer) {
            setTimeout(() => {
                const video = fullscreenContainer.querySelector('video, iframe');
                if (video) {
                    video.style.width = '100%';
                    video.style.height = '100%';
                }
            }, 100);
        }
    }
    
    // Handle native fullscreen changes
    document.addEventListener('fullscreenchange', function() {
        if (!document.fullscreenElement && isFullscreen) {
            exitFullscreen();
        }
    });
    
    document.addEventListener('webkitfullscreenchange', function() {
        if (!document.webkitFullscreenElement && isFullscreen) {
            exitFullscreen();
        }
    });
    
    document.addEventListener('mozfullscreenchange', function() {
        if (!document.mozFullScreenElement && isFullscreen) {
            exitFullscreen();
        }
    });
    
    document.addEventListener('MSFullscreenChange', function() {
        if (!document.msFullscreenElement && isFullscreen) {
            exitFullscreen();
        }
    });
</script>
@endpush
@endsection

