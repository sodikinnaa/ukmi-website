<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'kader.program') ? 'active' : '' }}" href="{{ route('kader.program.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>
        </span>
        <span class="nav-link-title">Program Saya</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link d-flex align-items-center {{ str_starts_with($currentRoute ?? '', 'kader.absensi') ? 'active' : '' }}" href="{{ route('kader.absensi.index') }}">
        <span class="nav-link-icon me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>
        </span>
        <span class="nav-link-title">Absensi Saya</span>
    </a>
</li>
