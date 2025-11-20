<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'presidium.user') ? 'active' : '' }}" href="{{ route('presidium.user.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
        </span>
        <span class="nav-link-title">Manajemen User</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'presidium.kategori-biro') ? 'active' : '' }}" href="{{ route('presidium.kategori-biro.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
        </span>
        <span class="nav-link-title">Kategori Biro</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'presidium.program-kerja') ? 'active' : '' }}" href="{{ route('presidium.program-kerja.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>
        </span>
        <span class="nav-link-title">Program Kerja</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'presidium.laporan') ? 'active' : '' }}" href="{{ route('presidium.laporan.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>
        </span>
        <span class="nav-link-title">Laporan</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'presidium.rekap') ? 'active' : '' }}" href="{{ route('presidium.rekap.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>
        </span>
        <span class="nav-link-title">Rekap Kehadiran</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'presidium.periode') ? 'active' : '' }}" href="{{ route('presidium.periode.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h.01" /><path d="M12 15h.01" /><path d="M16 15h.01" /></svg>
        </span>
        <span class="nav-link-title">Periode Kepengurusan</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'presidium.role') || str_starts_with($currentRoute ?? '', 'presidium.menu') ? 'active' : '' }}" href="{{ route('presidium.role.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
        </span>
        <span class="nav-link-title">Pengaturan Role</span>
    </a>
</li>
