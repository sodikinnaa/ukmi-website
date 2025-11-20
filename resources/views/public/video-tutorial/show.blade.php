@extends('layouts.public')

@section('title', $videoTutorial->judul)

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('public.video-tutorial.index') }}">Video Tutorial</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($videoTutorial->judul, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Video -->
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body p-4">
                    <h1 class="h3 fw-bold mb-3">{{ $videoTutorial->judul }}</h1>
                    
                    @if($videoTutorial->modul)
                        <span class="badge bg-primary mb-3">{{ $videoTutorial->modul }}</span>
                    @endif

                    @php
                        $videoType = $videoTutorial->getVideoSourceType();
                    @endphp

                    <!-- Video Player -->
                    <div class="mb-4">
                        @if($videoType === 'local')
                            <video controls class="w-100 rounded" style="max-height: 500px;">
                                <source src="{{ asset('storage/' . $videoTutorial->video_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        @elseif($videoType === 'google_drive')
                            @php
                                $embedUrl = $videoTutorial->getGoogleDriveEmbedUrl();
                            @endphp
                            @if($embedUrl)
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen style="width: 100%; height: 100%;" class="rounded"></iframe>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>Buka di Google Drive
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <p>Link Google Drive tidak valid.</p>
                                    <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-sm btn-primary">Buka Link</a>
                                </div>
                            @endif
                        @elseif($videoType === 'youtube')
                            <div class="ratio ratio-16x9">
                                @php
                                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $videoTutorial->video_url, $matches);
                                    $youtubeId = $matches[1] ?? null;
                                @endphp
                                @if($youtubeId)
                                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded"></iframe>
                                @else
                                    <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-primary">Buka Video</a>
                                @endif
                            </div>
                        @elseif($videoType === 'external')
                            <div class="ratio ratio-16x9">
                                <video controls class="w-100 rounded" style="max-height: 500px;">
                                    <source src="{{ $videoTutorial->video_url }}" type="video/mp4">
                                    <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-primary">Buka Video</a>
                                </video>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($videoTutorial->keterangan)
                        <div class="mb-3">
                            <h5 class="fw-bold">Deskripsi</h5>
                            <p class="text-muted">{{ $videoTutorial->keterangan }}</p>
                        </div>
                    @endif

                    @if($videoTutorial->keterangan_modul)
                        <div class="mb-3">
                            <h5 class="fw-bold">Keterangan Modul</h5>
                            <p class="text-muted">{{ $videoTutorial->keterangan_modul }}</p>
                        </div>
                    @endif

                    <!-- Video Info -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-clock me-2"></i>
                                <span>Durasi: {{ $videoTutorial->formatted_durasi }}</span>
                            </div>
                        </div>
                        @if($videoTutorial->creator)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center text-muted">
                                    <i class="bi bi-person me-2"></i>
                                    <span>Oleh: {{ $videoTutorial->creator->name }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-calendar me-2"></i>
                                <span>Dibuat: {{ $videoTutorial->created_at->format('d F Y') }}</span>
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
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-collection-play me-2"></i>Video Terkait
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($relatedVideos as $related)
                                <a href="{{ route('public.video-tutorial.show', $related) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 me-3" style="width: 80px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-play-circle-fill text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1" style="font-size: 0.9rem;">{{ Str::limit($related->judul, 50) }}</h6>
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
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <a href="{{ route('public.video-tutorial.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Video
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

