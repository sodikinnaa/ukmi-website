@extends('layouts.tabler')

@section('title', 'Tambah User')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah User Baru</h3>
            </div>
            <form action="{{ route('presidium.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Kosongkan untuk menggunakan NPM">
                                <small class="form-hint">Kosongkan untuk menggunakan NPM sebagai password default. Jika diisi, minimal 6 karakter.</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Kosongkan jika menggunakan NPM">
                                <small class="form-hint">Diperlukan jika password diisi manual</small>
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
                                        <option value="{{ $role->id }}" data-role-name="{{ $role->name }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->label }}</option>
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
                                <input type="text" class="form-control @error('nomor_wa') is-invalid @enderror" name="nomor_wa" value="{{ old('nomor_wa') }}" placeholder="081234567890">
                                @error('nomor_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" value="{{ old('jurusan') }}">
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
                                <input type="text" class="form-control @error('npm') is-invalid @enderror" name="npm" value="{{ old('npm') }}" id="npm">
                                <small class="form-hint">Akan digunakan sebagai password default jika password tidak diisi</small>
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
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                <input type="text" class="form-control @error('hobi') is-invalid @enderror" name="hobi" value="{{ old('hobi') }}">
                                @error('hobi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="status_aktif" value="1" {{ old('status_aktif', true) ? 'checked' : '' }}>
                            <span class="form-check-label">Status Aktif</span>
                        </label>
                    </div>
                    
                    <!-- Periode Selection (muncul berdasarkan role) -->
                    <div class="mb-3" id="periode-section" style="display: none;">
                        <label class="form-label">Periode Kepengurusan</label>
                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                            @php
                                $oldPeriodeIds = old('periode_ids', []);
                                $periodeAktifId = $periodeAktif ? $periodeAktif->id : null;
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
                        <small class="form-hint" id="periode-hint"></small>
                        @error('periode_ids')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('presidium.user.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const npmField = document.getElementById('npm');
        const passwordField = document.getElementById('password');
        const passwordConfirmationField = document.getElementById('password_confirmation');
        const roleSelect = document.getElementById('role_id');
        const jabatanSelect = document.getElementById('jabatan');
        const periodeSection = document.getElementById('periode-section');
        const periodeHint = document.getElementById('periode-hint');
        
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
            
            // Clear existing options
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
            
            // Add options based on role
            if (roleName && jabatanList[roleName]) {
                jabatanList[roleName].forEach(function(jabatan) {
                    const option = document.createElement('option');
                    option.value = jabatan.value;
                    option.textContent = jabatan.label;
                    // Preserve old value if exists
                    if ('{{ old("jabatan") }}' === jabatan.value) {
                        option.selected = true;
                    }
                    jabatanSelect.appendChild(option);
                });
            }
        }
        
        // Initialize jabatan on page load
        updateJabatan();
        
        // Track if periode section was hidden before
        let wasHidden = true;
        
        // Update jabatan and periode section when role changes
        function updatePeriodeSection() {
            const selectedRole = roleSelect.options[roleSelect.selectedIndex];
            const roleName = selectedRole ? selectedRole.getAttribute('data-role-name') : null;
            const isNowVisible = roleName && ['kader', 'kabid', 'presidium'].includes(roleName);
            
            if (isNowVisible) {
                const isFirstTime = wasHidden;
                periodeSection.style.display = 'block';
                
                // Set hint message based on role
                if (roleName === 'presidium') {
                    periodeHint.textContent = 'Pilih periode kepengurusan untuk presidium ini. Presidium dapat mengelola lebih dari 1 periode.';
                } else {
                    const roleLabel = roleName === 'kader' ? 'kader' : 'kabid';
                    periodeHint.textContent = `Pilih periode kepengurusan untuk ${roleLabel} ini. ${roleLabel.charAt(0).toUpperCase() + roleLabel.slice(1)} dapat mengikuti lebih dari 1 periode. Default: Periode Aktif akan otomatis dipilih jika tidak ada yang dipilih.`;
                    
                    // Auto-check periode aktif hanya jika section baru muncul dan tidak ada yang dipilih
                    @if($periodeAktif)
                        if (isFirstTime) {
                            const periodeAktifCheckbox = document.getElementById('periode_{{ $periodeAktif->id }}');
                            const checkedPeriodes = document.querySelectorAll('input[name="periode_ids[]"]:checked');
                            if (checkedPeriodes.length === 0 && periodeAktifCheckbox && !periodeAktifCheckbox.checked) {
                                periodeAktifCheckbox.checked = true;
                            }
                        }
                    @endif
                }
                wasHidden = false;
            } else {
                periodeSection.style.display = 'none';
                wasHidden = true;
                // Uncheck all periode checkboxes
                document.querySelectorAll('input[name="periode_ids[]"]').forEach(cb => cb.checked = false);
            }
        }
        
        // Initialize periode section on page load (check if role is already selected from old input)
        const currentRoleId = '{{ old("role_id") }}';
        if (currentRoleId) {
            const selectedOption = roleSelect.querySelector(`option[value="${currentRoleId}"]`);
            if (selectedOption) {
                const roleName = selectedOption.getAttribute('data-role-name');
                if (roleName && ['kader', 'kabid', 'presidium'].includes(roleName)) {
                    wasHidden = false; // Section will be visible, so it's not hidden
                    updatePeriodeSection();
                }
            }
        } else {
            updatePeriodeSection();
        }
        
        // Update jabatan and periode section when role changes
        roleSelect.addEventListener('change', function() {
            updateJabatan();
            updatePeriodeSection();
        });
        
        // Auto-fill password dengan NPM jika password kosong
        npmField.addEventListener('input', function() {
            // Jika password kosong, isi dengan NPM
            if (!passwordField.value && this.value) {
                passwordField.value = this.value;
                passwordConfirmationField.value = this.value;
            }
        });
        
        // Jika password diisi manual, sync dengan confirmation
        passwordField.addEventListener('input', function() {
            if (this.value) {
                passwordConfirmationField.value = this.value;
            } else {
                // Jika password dikosongkan, isi dengan NPM jika ada
                if (npmField.value) {
                    passwordField.value = npmField.value;
                    passwordConfirmationField.value = npmField.value;
                } else {
                    passwordConfirmationField.value = '';
                }
            }
        });
        
        // Sync confirmation saat diketik
        passwordConfirmationField.addEventListener('input', function() {
            // Biarkan user mengetik manual
        });
    });
</script>
@endpush
@endsection

