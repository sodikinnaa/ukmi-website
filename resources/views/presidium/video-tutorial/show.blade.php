@extends('layouts.tabler')

@section('title', 'Detail Video Tutorial')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Video Tutorial</h3>
                <div class="card-actions">
                    <a href="{{ route('presidium.video-tutorial.edit', $videoTutorial) }}" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        Edit
                    </a>
                    <a href="{{ route('presidium.video-tutorial.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h4>{{ $videoTutorial->judul }}</h4>
                            @if($videoTutorial->modul)
                                <span class="badge bg-blue">{{ $videoTutorial->modul }}</span>
                            @endif
                            @if($videoTutorial->is_aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </div>

                        @if($videoTutorial->keterangan)
                            <div class="mb-4">
                                <h5>Keterangan</h5>
                                <p class="text-muted">{{ $videoTutorial->keterangan }}</p>
                            </div>
                        @endif

                        @if($videoTutorial->keterangan_modul)
                            <div class="mb-4">
                                <h5>Keterangan Modul</h5>
                                <p class="text-muted">{{ $videoTutorial->keterangan_modul }}</p>
                            </div>
                        @endif

                        <div class="mb-4">
                            <h5>Video</h5>
                            @php
                                $videoType = $videoTutorial->getVideoSourceType();
                            @endphp

                            @if($videoType === 'local')
                                <video controls class="w-100" style="max-height: 500px;">
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
                                    <div class="mt-2">
                                        <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6l0 12" /><path d="M11 6l6 6l-6 6" /></svg>
                                            Buka di Google Drive
                                        </a>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <p>Link Google Drive tidak valid. Pastikan link dalam format:</p>
                                        <ul class="mb-0">
                                            <li>https://drive.google.com/file/d/FILE_ID/view</li>
                                            <li>https://drive.google.com/open?id=FILE_ID</li>
                                        </ul>
                                        <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-sm btn-primary mt-2">Buka Link</a>
                                    </div>
                                @endif
                            @elseif($videoType === 'youtube')
                                <div class="ratio ratio-16x9">
                                    @php
                                        // Extract YouTube video ID
                                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $videoTutorial->video_url, $matches);
                                        $youtubeId = $matches[1] ?? null;
                                    @endphp
                                    @if($youtubeId)
                                        <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @else
                                        <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-primary">Buka Video</a>
                                    @endif
                                </div>
                            @elseif($videoType === 'external')
                                <div class="ratio ratio-16x9">
                                    <video controls class="w-100" style="max-height: 500px;">
                                        <source src="{{ $videoTutorial->video_url }}" type="video/mp4">
                                        <a href="{{ $videoTutorial->video_url }}" target="_blank" class="btn btn-primary">Buka Video</a>
                                    </video>
                                </div>
                            @else
                                <div class="alert alert-warning">Video belum tersedia</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Informasi</h4>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-5">Durasi:</dt>
                                    <dd class="col-7">{{ $videoTutorial->formatted_durasi }}</dd>

                                    <dt class="col-5">Urutan:</dt>
                                    <dd class="col-7">{{ $videoTutorial->urutan }}</dd>

                                    <dt class="col-5">Status:</dt>
                                    <dd class="col-7">
                                        @if($videoTutorial->is_aktif)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </dd>

                                    @if($videoTutorial->creator)
                                        <dt class="col-5">Dibuat Oleh:</dt>
                                        <dd class="col-7">{{ $videoTutorial->creator->name }}</dd>

                                        <dt class="col-5">Tanggal Dibuat:</dt>
                                        <dd class="col-7">{{ $videoTutorial->created_at->format('d/m/Y H:i') }}</dd>
                                    @endif

                                    @if($videoTutorial->updated_at)
                                        <dt class="col-5">Terakhir Diupdate:</dt>
                                        <dd class="col-7">{{ $videoTutorial->updated_at->format('d/m/Y H:i') }}</dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

