@extends('layouts.tabler')

@section('title', 'Edit Profile')

@section('pretitle', 'Profile')

@php
    $currentUser = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
                <div class="card-actions">
                    <a href="{{ route('profile.show') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Foto Profile</label>
                                <div class="mb-2">
                                    @if($user->foto_profile)
                                        <img src="{{ asset('storage/' . $user->foto_profile) }}" alt="{{ $user->name }}" class="avatar avatar-lg mb-2">
                                    @else
                                        <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $user->name }}" class="avatar avatar-lg mb-2">
                                    @endif
                                </div>
                                <input type="file" class="form-control @error('foto_profile') is-invalid @enderror" name="foto_profile" accept="image/*">
                                <small class="form-hint">Format: JPG, PNG, GIF (Max: 2MB). Jika tidak diisi, akan menggunakan gambar default.</small>
                                @error('foto_profile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-blue">{{ $user->roleModel?->label ?? '-' }}</span>
                                    <small class="text-muted d-block mt-1">Role tidak dapat diubah dari halaman ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor WA</label>
                                <input type="text" class="form-control @error('nomor_wa') is-invalid @enderror" name="nomor_wa" value="{{ old('nomor_wa', $user->nomor_wa) }}" placeholder="081234567890">
                                @error('nomor_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}">
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">NPM</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror" name="npm" value="{{ old('npm', $user->npm) }}">
                                @error('npm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hobi</label>
                                <input type="text" class="form-control @error('hobi') is-invalid @enderror" name="hobi" value="{{ old('hobi', $user->hobi) }}">
                                @error('hobi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    @if($user->roleModel && in_array($user->roleModel->name, ['kader', 'kabid', 'presidium']))
                        <div class="mb-3">
                            <label class="form-label">Periode Kepengurusan</label>
                            <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                @php
                                    $oldPeriodeIds = old('periode_ids', $selectedPeriodeIds);
                                    // Jika tidak ada yang dipilih dan ada periode aktif, set default (hanya untuk kader dan kabid)
                                    if (empty($oldPeriodeIds) && $periodeAktif && in_array($user->roleModel->name, ['kader', 'kabid'])) {
                                        $oldPeriodeIds = [$periodeAktif->id];
                                    }
                                @endphp
                                @foreach($periodeList as $periode)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input @error('periode_ids') is-invalid @enderror" 
                                               type="checkbox" 
                                               name="periode_ids[]" 
                                               value="{{ $periode->id }}" 
                                               id="periode_{{ $periode->id }}"
                                               {{ in_array($periode->id, $oldPeriodeIds) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="periode_{{ $periode->id }}">
                                            <strong>{{ $periode->nama_periode }}</strong>
                                            @if($periode->is_aktif)
                                                <span class="badge bg-success ms-2">Aktif</span>
                                            @endif
                                            @if($periode->tanggal_mulai)
                                                <small class="text-muted ms-2">
                                                    ({{ $periode->tanggal_mulai->format('Y') }}
                                                    @if($periode->tanggal_selesai)
                                                        - {{ $periode->tanggal_selesai->format('Y') }}
                                                    @endif
                                                    )
                                                </small>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <small class="form-hint">
                                @if($user->roleModel->name === 'presidium')
                                    Pilih periode kepengurusan untuk presidium ini. Presidium dapat mengelola lebih dari 1 periode.
                                @else
                                    Pilih periode kepengurusan untuk {{ $user->roleModel->name === 'kader' ? 'kader' : 'kabid' }} ini. {{ $user->roleModel->name === 'kader' ? 'Kader' : 'Kabid' }} dapat mengikuti lebih dari 1 periode. 
                                    @if($periodeAktif && empty($selectedPeriodeIds))
                                        <strong>Default: Periode Aktif ({{ $periodeAktif->nama_periode }})</strong> akan otomatis dipilih jika tidak ada yang dipilih.
                                    @endif
                                @endif
                            </small>
                            @error('periode_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('profile.show') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

