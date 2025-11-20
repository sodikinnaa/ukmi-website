<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'pembina.periode') ? 'active' : '' }}" href="{{ route('pembina.periode.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h.01" /><path d="M12 15h.01" /><path d="M16 15h.01" /></svg>
        </span>
        <span class="nav-link-title">Pengaturan Periode</span>
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
