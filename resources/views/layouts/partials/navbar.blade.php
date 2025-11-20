@php
    $user = Auth::user();
    // Ensure roleModel is loaded
    if (!$user->relationLoaded('roleModel')) {
        $user->load('roleModel');
    }
@endphp

<header class="navbar navbar-expand-md d-print-none" style="display: flex !important;">
    <div class="container-xl" style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-md-none me-2" type="button" id="sidebarToggle" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark pe-0 pe-md-3 mb-0">
                <a href="{{ route('dashboard') }}">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Logo_UKMI.png" width="110" height="32" alt="UKMI Ar-Rahman" class="navbar-brand-image" style="object-fit: contain;">
                </a>
            </h1>
        </div>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <a href="{{ route('home') }}" class="btn" target="_blank" rel="noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                        Landing Page
                    </a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    @if($user->foto_profile)
                        <span class="avatar avatar-sm" style="background-image: url({{ asset('storage/' . $user->foto_profile) }})"></span>
                    @else
                        <span class="avatar avatar-sm" style="background-image: url('https://cdn-icons-png.freepik.com/512/4264/4264711.png')"></span>
                    @endif
                    <div class="d-none d-md-block ps-2">
                        <div>{{ $user->name }}</div>
                        <div class="mt-1 small text-muted">{{ $user->role_label }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">Profile</a>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
