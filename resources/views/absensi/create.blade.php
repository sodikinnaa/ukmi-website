@extends('layouts.tabler')

@section('title', 'Absensi - ' . $programKerja->judul)

@section('pretitle', 'Absensi')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Absensi: {{ $programKerja->judul }}</h3>
                <div class="card-actions">
                    <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Info Program Kerja -->
                <div class="alert alert-info mb-4">
                    <div class="d-flex">
                        <div class="me-3">
                            @if($programKerja->foto_progja)
                                <img src="{{ asset('storage/' . $programKerja->foto_progja) }}" alt="{{ $programKerja->judul }}" class="avatar">
                            @else
                                <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $programKerja->judul }}" class="avatar">
                            @endif
                        </div>
                        <div class="flex-fill">
                            <h5 class="mb-1">{{ $programKerja->judul }}</h5>
                            <div class="text-muted small">
                                <span class="badge bg-blue">{{ $programKerja->kategoriBiro->nama ?? '-' }}</span>
                                @if($programKerja->periode)
                                    <span class="badge bg-secondary ms-1">{{ $programKerja->periode->nama_periode }}</span>
                                @endif
                            </div>
                            @if($programKerja->deskripsi)
                                <p class="mb-0 mt-2">{{ $programKerja->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Form Absensi -->
                <form action="{{ route('absensi.store', $programKerja) }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Pertemuan Ke</label>
                            <select name="pertemuan_ke" id="pertemuan_ke" class="form-select @error('pertemuan_ke') is-invalid @enderror" required>
                                <option value="">Pilih Pertemuan</option>
                                @foreach($pertemuanList as $pertemuan)
                                    @php
                                        $userAbsensi = \App\Models\Absensi::where('program_kerja_id', $programKerja->id)
                                            ->where('kader_id', $user->id)
                                            ->where('pertemuan_ke', $pertemuan->pertemuan_ke)
                                            ->first();
                                    @endphp
                                    <option value="{{ $pertemuan->pertemuan_ke }}" 
                                        data-tanggal="{{ $pertemuan->tanggal->format('Y-m-d') }}"
                                        {{ old('pertemuan_ke') == $pertemuan->pertemuan_ke ? 'selected' : '' }}
                                        {{ $userAbsensi ? 'disabled' : '' }}>
                                        Pertemuan Ke-{{ $pertemuan->pertemuan_ke }} 
                                        ({{ $pertemuan->tanggal->format('d M Y') }})
                                        @if($userAbsensi)
                                            - Sudah Absen ({{ $userAbsensi->status_label }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('pertemuan_ke')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Pilih pertemuan yang ingin Anda absen</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Absensi</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" readonly>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Tanggal akan otomatis diisi sesuai tanggal pertemuan yang dipilih</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">Pilih Status</option>
                                <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alpha" {{ old('status') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Keterangan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Tambahkan keterangan jika diperlukan (misalnya alasan izin)</small>
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                        <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
                
                @if(session('existing_absensi_id'))
                    <div class="alert alert-warning">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 8v4" />
                                <path d="M12 16h.01" />
                            </svg>
                            <div class="flex-fill">
                                <p class="mb-0">Anda sudah memiliki absensi untuk pertemuan ini. <a href="{{ route('absensi.edit', session('existing_absensi_id')) }}" class="alert-link">Klik di sini untuk mengedit absensi yang sudah ada</a>.</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($absensiUser->count() > 0)
                    <hr class="my-4">
                    <h4 class="mb-3">Riwayat Absensi Saya</h4>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Pertemuan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th class="w-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absensiUser as $absensi)
                                    <tr>
                                        <td>
                                            <strong>Pertemuan Ke-{{ $absensi->pertemuan_ke }}</strong>
                                        </td>
                                        <td>{{ $absensi->tanggal->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $absensi->status === 'hadir' ? 'success' : ($absensi->status === 'izin' ? 'warning' : ($absensi->status === 'sakit' ? 'info' : 'danger')) }}">
                                                {{ $absensi->status_label }}
                                            </span>
                                        </td>
                                        <td>{{ $absensi->keterangan ?: '-' }}</td>
                                        <td>
                                            <a href="{{ route('absensi.edit', $absensi) }}" class="btn btn-sm btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pertemuanSelect = document.getElementById('pertemuan_ke');
        const tanggalInput = document.getElementById('tanggal');
        
        if (pertemuanSelect && tanggalInput) {
            // Function untuk update tanggal
            function updateTanggal() {
                const selectedOption = pertemuanSelect.options[pertemuanSelect.selectedIndex];
                const tanggalPertemuan = selectedOption ? selectedOption.getAttribute('data-tanggal') : null;
                
                if (tanggalPertemuan) {
                    tanggalInput.value = tanggalPertemuan;
                }
            }
            
            // Update tanggal saat pertemuan berubah
            pertemuanSelect.addEventListener('change', updateTanggal);
            
            // Update tanggal saat halaman pertama kali dimuat (jika ada pertemuan yang sudah dipilih)
            updateTanggal();
        }
    });
</script>
@endpush
@endsection

