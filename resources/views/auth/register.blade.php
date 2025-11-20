<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registrasi - UKMI Ar-Rahman</title>

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="{{ asset('templates/dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/dist/css/tabler-flags.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/dist/css/tabler-payments.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/dist/css/tabler-social.min.css') }}">
</head>
<body>
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Logo_UKMI.png" width="110" height="32" alt="UKMI Ar-Rahman" style="object-fit: contain;">
            </a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Daftar Akun Baru</h2>
                
                @if($referralCode)
                    <div class="alert alert-info mb-3">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l0 4" /><path d="M12 16l.01 0" /></svg>
                            </div>
                            <div>
                                <strong>Referral Code:</strong> {{ $referralCode }}
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" autocomplete="off" novalidate>
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label required">Nama Lengkap</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" 
                               placeholder="Masukkan nama lengkap"
                               value="{{ old('name') }}"
                               required
                               autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               placeholder="Masukkan email"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Password</label>
                        <div class="input-group input-group-flat">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="Minimal 8 karakter"
                                   required
                                   autocomplete="new-password">
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                </a>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Konfirmasi Password</label>
                        <input type="password" 
                               class="form-control @error('password_confirmation') is-invalid @enderror" 
                               name="password_confirmation" 
                               placeholder="Ulangi password"
                               required
                               autocomplete="new-password">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NPM</label>
                        <input type="text" 
                               class="form-control @error('npm') is-invalid @enderror" 
                               name="npm" 
                               placeholder="Masukkan NPM (opsional)"
                               value="{{ old('npm') }}">
                        @error('npm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" 
                               class="form-control @error('jurusan') is-invalid @enderror" 
                               name="jurusan" 
                               placeholder="Masukkan jurusan (opsional)"
                               value="{{ old('jurusan') }}">
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" 
                               class="form-control @error('nomor_wa') is-invalid @enderror" 
                               name="nomor_wa" 
                               placeholder="Contoh: 081234567890 (opsional)"
                               value="{{ old('nomor_wa') }}">
                        @error('nomor_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="text-center text-muted">
                    Sudah punya akun? <a href="{{ route('login') }}" tabindex="-1">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(element) {
        const input = element.closest('.input-group').querySelector('input');
        const icon = element.querySelector('svg');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-bs-original-title', 'Hide password');
        } else {
            input.type = 'password';
            icon.setAttribute('data-bs-original-title', 'Show password');
        }
    }
</script>

<!-- Tabler JS -->
<script src="{{ asset('templates/dist/js/tabler.min.js') }}"></script>
<script src="{{ asset('templates/dist/js/demo-theme.min.js') }}"></script>
</body>
</html>

