@extends('layouts.tabler')

@section('title', 'Dashboard Pembina')

@section('pretitle', 'Pembina')

@php
    $user = Auth::user();
    
    // Statistik untuk pembina
    $totalKader = \App\Models\User::whereHas('roleModel', function($q) { $q->where('name', 'kader'); })->where('status_aktif', true)->count();
    
    // Cek apakah kolom status ada di tabel program_kerja
    $hasStatusColumn = \Schema::hasColumn('program_kerja', 'status');
    if ($hasStatusColumn) {
        $totalProgramKerja = \App\Models\ProgramKerja::where('status', 'aktif')->count();
    } else {
        $totalProgramKerja = \App\Models\ProgramKerja::count();
    }
    
    $totalDokumentasi = \App\Models\Dokumentasi::count();
    
    // Cek apakah tabel pertemuan ada
    $hasPertemuanTable = \Schema::hasTable('pertemuan');
    $totalPertemuan = $hasPertemuanTable ? \App\Models\Pertemuan::count() : 0;
    
    $totalAbsensi = \App\Models\Absensi::count();
    
    // Cek apakah tabel periode_kepengurusan ada
    $hasPeriodeTable = \Schema::hasTable('periode_kepengurusan');
    $periodeAktif = $hasPeriodeTable ? \App\Models\PeriodeKepengurusan::where('is_aktif', true)->first() : null;
    
    // Kegiatan bulan ini
    $kegiatanBulanIni = $hasPertemuanTable ? \App\Models\Pertemuan::whereMonth('tanggal', now()->month)
        ->whereYear('tanggal', now()->year)
        ->count() : 0;
    
    // Dokumentasi bulan ini
    $dokumentasiBulanIni = \App\Models\Dokumentasi::whereMonth('tanggal_kegiatan', now()->month)
        ->whereYear('tanggal_kegiatan', now()->year)
        ->count();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Selamat Datang, {{ $user->name }}</h2>
                <p class="text-muted">Sebagai Pembina/Dewan Pembina, Anda memiliki akses untuk melihat laporan dan monitoring kegiatan organisasi UKMI Ar-Rahman.</p>
                @if($periodeAktif)
                    <div class="mt-3">
                        <span class="badge bg-info">Periode Aktif: {{ $periodeAktif->nama_periode }}</span>
                        <span class="text-muted ms-2">{{ $periodeAktif->tanggal_mulai->format('d M Y') }} - {{ $periodeAktif->tanggal_selesai ? $periodeAktif->tanggal_selesai->format('d M Y') : 'Sekarang' }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Kader Aktif</div>
                </div>
                <div class="h1 mb-3">{{ $totalKader }}</div>
                <div class="d-flex mb-2">
                    <div>Kader yang aktif dalam organisasi</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Program Kerja Aktif</div>
                </div>
                <div class="h1 mb-3">{{ $totalProgramKerja }}</div>
                <div class="d-flex mb-2">
                    <div>Program yang sedang berjalan</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Pertemuan</div>
                </div>
                <div class="h1 mb-3">{{ $totalPertemuan }}</div>
                <div class="d-flex mb-2">
                    <div>Pertemuan yang telah dilakukan</div>
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
                    <div>Foto dokumentasi kegiatan</div>
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
                    <div>Data absensi kader</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Kegiatan Bulan Ini</div>
                </div>
                <div class="h1 mb-3">{{ $kegiatanBulanIni }}</div>
                <div class="d-flex mb-2">
                    <div>Pertemuan di {{ now()->format('F Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Dokumentasi Bulan Ini</div>
                </div>
                <div class="h1 mb-3">{{ $dokumentasiBulanIni }}</div>
                <div class="d-flex mb-2">
                    <div>Foto di {{ now()->format('F Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Tingkat Kehadiran</div>
                </div>
                @php
                    $hadir = \App\Models\Absensi::where('status', 'hadir')->count();
                    $totalAbsensiData = $totalAbsensi > 0 ? $totalAbsensi : 1;
                    $persentaseHadir = round(($hadir / $totalAbsensiData) * 100, 1);
                @endphp
                <div class="h1 mb-3">{{ $persentaseHadir }}%</div>
                <div class="d-flex mb-2">
                    <div>Rata-rata kehadiran kader</div>
                </div>
            </div>
        </div>
    </div>

    @if($periodeAktif)
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Program Kerja Periode {{ $periodeAktif->nama_periode }}</h3>
                    <div class="card-actions">
                        <a href="{{ route('pembina.laporan.index') }}" class="btn btn-primary">Lihat Laporan Lengkap</a>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $hasPeriodeIdColumn = \Schema::hasColumn('program_kerja', 'periode_id');
                        
                        if ($hasPeriodeIdColumn && $periodeAktif) {
                            $query = \App\Models\ProgramKerja::where('periode_id', $periodeAktif->id);
                        } else {
                            $query = \App\Models\ProgramKerja::query();
                        }
                        
                        $query->with(['kader'])
                            ->withCount(['kader']);
                        
                        if ($hasPertemuanTable) {
                            $query->with(['pertemuan'])->withCount(['pertemuan']);
                        }
                        
                        $programKerjaPeriode = $query->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @if($programKerjaPeriode->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Program Kerja</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Kader</th>
                                        <th>Pertemuan</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programKerjaPeriode as $progja)
                                        <tr>
                                            <td>
                                                <strong>{{ $progja->judul }}</strong>
                                                @if($progja->deskripsi)
                                                    <br><small class="text-muted">{{ Str::limit($progja->deskripsi, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-blue">{{ $progja->kategori_biro_label }}</span>
                                            </td>
                                            <td>
                                                @if($hasStatusColumn)
                                                    <span class="badge bg-{{ $progja->status_badge_color }}">{{ $progja->status_label }}</span>
                                                @else
                                                    <span class="badge bg-secondary">-</span>
                                                @endif
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
                                            <td>
                                                @if($hasPertemuanTable && $progja->frekuensi_kegiatan)
                                                    @php
                                                        $pertemuanCount = $progja->pertemuan_count ?? 0;
                                                        $progress = round(($pertemuanCount / $progja->frekuensi_kegiatan) * 100, 0);
                                                    @endphp
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar" style="width: {{ $progress }}%">{{ $progress }}%</div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="mb-0">Belum ada program kerja untuk periode ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
