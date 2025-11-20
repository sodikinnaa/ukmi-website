<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'pembina.dashboard') ? 'active' : '' }}" href="{{ route('pembina.dashboard') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
        </span>
        <span class="nav-link-title">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'pembina.laporan') ? 'active' : '' }}" href="{{ route('pembina.laporan.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>
        </span>
        <span class="nav-link-title">Laporan</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'referensi-progja') ? 'active' : '' }}" href="{{ route('referensi-progja.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>
        </span>
        <span class="nav-link-title">Referensi Progja</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'absensi') ? 'active' : '' }}" href="{{ route('absensi.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>
        </span>
        <span class="nav-link-title">Absensi</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'pembina.periode') ? 'active' : '' }}" href="{{ route('pembina.periode.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h.01" /><path d="M12 15h.01" /><path d="M16 15h.01" /></svg>
        </span>
        <span class="nav-link-title">Pengaturan Periode</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center" href="https://uni.teknokrat.ac.id" target="_blank" rel="noopener noreferrer">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /><path d="M16 21v-2a4 4 0 0 0 -4 -4h-2" /><path d="M8 7v-2a4 4 0 0 1 4 -4h2" /></svg>
        </span>
        <span class="nav-link-title">UNI</span>
        <span class="ms-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" /><path d="M10 14l10 -10" /><path d="M15 4l5 0l0 5" /></svg>
        </span>
    </a>
</li>
