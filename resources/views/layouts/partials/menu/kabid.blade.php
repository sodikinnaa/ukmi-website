<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'kabid.absensi') ? 'active' : '' }}" href="{{ route('kabid.absensi.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>
        </span>
        <span class="nav-link-title">Absensi</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'kabid.dokumentasi') ? 'active' : '' }}" href="{{ route('kabid.dokumentasi.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" /><path d="M3.5 15.5l4.5 -4.5c.928 -.893 2.072 -.893 3 0l5 5" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l2.5 2.5" /></svg>
        </span>
        <span class="nav-link-title">Dokumentasi</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'kabid.kader') ? 'active' : '' }}" href="{{ route('kabid.kader.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
        </span>
        <span class="nav-link-title">Daftar Kader</span>
    </a>
</li>
