@extends('layouts.tabler')

@section('title', 'Edit User')

@section('pretitle', 'Presidium')

@php
    $currentUser = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit User: {{ $user->name }}</h3>
            </div>
            <form action="{{ route('presidium.user.update', $user) }}" method="POST" enctype="multipart/form-data">
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
                                <label class="form-label required">Role</label>
                                <select class="form-select @error('role_id') is-invalid @enderror" name="role_id" id="role_id" required>
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" data-role-name="{{ $role->name }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->label }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <select class="form-select @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan">
                                    <option value="">Pilih Jabatan</option>
                                </select>
                                <small class="form-hint">Pilih jabatan sesuai dengan role yang dipilih</small>
                                @error('jabatan')
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
                                        <img src="{{ asset('storage/' . $user->foto_profile) }}" alt="{{ $user->name }}" class="avatar avatar-lg">
                                    @else
                                        <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $user->name }}" class="avatar avatar-lg">
                                    @endif
                                </div>
                                <input type="file" class="form-control @error('foto_profile') is-invalid @enderror" name="foto_profile" accept="image/*">
                                <small class="form-hint">Format: JPG, PNG, GIF (Max: 2MB)</small>
                                @error('foto_profile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                    
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="status_aktif" value="1" {{ old('status_aktif', $user->status_aktif) ? 'checked' : '' }}>
                            <span class="form-check-label">Status Aktif</span>
                        </label>
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
                    <a href="{{ route('presidium.user.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role_id');
        const jabatanSelect = document.getElementById('jabatan');
        
        // Daftar jabatan berdasarkan role
        const jabatanList = {
            'presidium': [
                { value: 'Ketua', label: 'Ketua' },
                { value: 'Wakil', label: 'Wakil' },
                { value: 'Bendahara', label: 'Bendahara' },
                { value: 'Sekretaris', label: 'Sekretaris' }
            ],
            'kabid': [
                { value: 'Ketua', label: 'Ketua' },
                { value: 'Sekretaris', label: 'Sekretaris' },
                { value: 'Bendahara', label: 'Bendahara' }
            ],
            'kader': [],
            'pembina': []
        };
        
        // Update jabatan berdasarkan role yang dipilih
        function updateJabatan() {
            const selectedRole = roleSelect.options[roleSelect.selectedIndex];
            const roleName = selectedRole ? selectedRole.getAttribute('data-role-name') : null;
            const currentJabatan = '{{ old("jabatan", $user->jabatan) }}';
            
            // Clear existing options
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
            
            // Add options based on role
            if (roleName && jabatanList[roleName]) {
                jabatanList[roleName].forEach(function(jabatan) {
                    const option = document.createElement('option');
                    option.value = jabatan.value;
                    option.textContent = jabatan.label;
                    // Preserve current value if exists
                    if (currentJabatan === jabatan.value) {
                        option.selected = true;
                    }
                    jabatanSelect.appendChild(option);
                });
            }
        }
        
        // Initialize jabatan on page load
        updateJabatan();
        
        // Update jabatan when role changes
        roleSelect.addEventListener('change', updateJabatan);
    });
</script>
@endpush
@endsection

