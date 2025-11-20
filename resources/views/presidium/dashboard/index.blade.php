@extends('layouts.tabler')

@section('title', 'Dashboard Presidium')

@section('pretitle', 'Presidium')

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Selamat Datang, {{ $user->name }}</h2>
                <p class="text-muted">Sebagai Presidium, Anda memiliki akses untuk mengelola data kader, kabid, program kerja, dan laporan untuk periode yang menjadi tanggung jawab Anda.</p>
                
                @if($periodeList->count() > 0)
                    <div class="mt-3">
                        <h4 class="mb-2">Periode Kepengurusan Anda:</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($periodeList as $periode)
                                <span class="badge bg-info">
                                    {{ $periode->nama_periode }}
                                    @if($periode->is_aktif)
                                        <span class="badge bg-success ms-1">Aktif</span>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning mt-3">
                        <h4 class="alert-title">Belum Ditugaskan ke Periode</h4>
                        <p class="mb-0">Anda belum ditugaskan ke periode kepengurusan. Silakan hubungi Pembina untuk ditugaskan ke periode tertentu.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($periodeList->count() > 0)
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Kader</div>
                    </div>
                    <div class="h1 mb-3">{{ $totalKader }}</div>
                    <div class="d-flex mb-2">
                        <div>Kader yang terdaftar di periode kepengurusan Anda</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Kabid</div>
                    </div>
                    <div class="h1 mb-3">{{ $totalKabid }}</div>
                    <div class="d-flex mb-2">
                        <div>Kabid yang terdaftar di periode kepengurusan Anda</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Program Kerja</div>
                    </div>
                    <div class="h1 mb-3">{{ $totalProgramKerja }}</div>
                    <div class="d-flex mb-2">
                        <div>
                            <span class="badge bg-success">{{ $programKerjaAktif }} Aktif</span>
                            <span class="badge bg-info ms-1">{{ $programKerjaSelesai }} Selesai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Dokumentasi</div>
                    </div>
                    <div class="h1 mb-3">{{ $totalDokumentasi }}</div>
                    <div class="d-flex mb-2">
                        <div>Dokumentasi dari program kerja di periode Anda</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Absensi</div>
                    </div>
                    <div class="h1 mb-3">{{ $totalAbsensi }}</div>
                    <div class="d-flex mb-2">
                        <div>Absensi dari program kerja di periode Anda</div>
                    </div>
                </div>
            </div>
        </div>

        @if($hasPertemuanTable)
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Pertemuan</div>
                    </div>
                    <div class="h1 mb-3">{{ $totalPertemuan }}</div>
                    <div class="d-flex mb-2">
                        <div>Pertemuan yang telah dilakukan di periode Anda</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Program Kerja Terbaru -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Program Kerja Terbaru</h3>
                    <div class="card-actions">
                        <a href="{{ route('presidium.program-kerja.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body">
                    @if($recentProgramKerja->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Periode</th>
                                        <th>Status</th>
                                        <th>Kader</th>
                                        <th>Pertemuan</th>
                                        <th>Dibuat Oleh</th>
                                        <th class="w-1">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentProgramKerja as $progja)
                                        <tr>
                                            <td>
                                                <strong>{{ $progja->judul }}</strong>
                                                @if($progja->deskripsi)
                                                    <br><small class="text-muted">{{ Str::limit($progja->deskripsi, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($progja->periode)
                                                    <span class="badge bg-info">{{ $progja->periode->nama_periode }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $progja->status_badge_color }}">{{ $progja->status_label }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-green">{{ $progja->kader_count }} Kader</span>
                                            </td>
                                            <td>
                                                @if($hasPertemuanTable)
                                                    @if($progja->frekuensi_kegiatan)
                                                        <span class="badge bg-info">{{ $progja->pertemuan_count ?? 0 }} / {{ $progja->frekuensi_kegiatan }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $progja->pertemuan_count ?? 0 }}</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $progja->creator?->name ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('presidium.program-kerja.show', $progja) }}" class="btn btn-sm btn-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <p class="mb-0">Belum ada program kerja untuk periode Anda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="col-12">
            <div class="alert alert-warning">
                <h4 class="alert-title">Tidak Ada Data</h4>
                <p class="mb-0">Anda belum ditugaskan ke periode kepengurusan. Silakan hubungi Pembina untuk ditugaskan ke periode tertentu agar dapat melihat data dan statistik.</p>
            </div>
        </div>
    @endif
</div>
@endsection
