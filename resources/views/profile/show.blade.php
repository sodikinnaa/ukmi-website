@extends('layouts.tabler')

@section('title', 'Profile Saya')

@section('pretitle', 'Profile')

@php
    $currentUser = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile Saya</h3>
                <div class="card-actions">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        Edit Profile
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                            </div>
                            <div>
                                {{ session('success') }}
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        @if($user->foto_profile)
                            <img src="{{ asset('storage/' . $user->foto_profile) }}" alt="{{ $user->name }}" class="avatar avatar-xl mb-3" style="border: 3px solid #dee2e6;">
                        @else
                            <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $user->name }}" class="avatar avatar-xl mb-3" style="border: 3px solid #dee2e6;">
                        @endif
                        <h3>{{ $user->name }}</h3>
                        <p class="text-muted">{{ $user->email }}</p>
                        <div>
                            <span class="badge bg-blue">{{ $user->roleModel?->label ?? '-' }}</span>
                            @if($user->status_aktif)
                                <span class="badge bg-green">Aktif</span>
                            @else
                                <span class="badge bg-red">Tidak Aktif</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NPM</label>
                                <div class="form-control-plaintext">
                                    <strong>{{ $user->npm ?? '-' }}</strong>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan</label>
                                <div class="form-control-plaintext">
                                    <strong>{{ $user->jurusan ?? '-' }}</strong>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="form-control-plaintext">
                                    @if($user->jenis_kelamin)
                                        <span class="badge bg-{{ $user->jenis_kelamin == 'L' ? 'blue' : 'pink' }}">
                                            {{ $user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor WhatsApp</label>
                                <div class="form-control-plaintext">
                                    @if($user->nomor_wa)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->nomor_wa) }}" target="_blank" class="text-decoration-none">
                                            <strong>{{ $user->nomor_wa }}</strong>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm ms-1 text-success" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                                <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                            </svg>
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hobi</label>
                                <div class="form-control-plaintext">
                                    <strong>{{ $user->hobi ?? '-' }}</strong>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Bergabung</label>
                                <div class="form-control-plaintext">
                                    <strong>{{ $user->created_at->format('d M Y') }}</strong>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat</label>
                                <div class="form-control-plaintext">
                                    <strong>{{ $user->alamat ?? '-' }}</strong>
                                </div>
                            </div>
                            
                            @if($user->roleModel && in_array($user->roleModel->name, ['kader', 'kabid', 'presidium']))
                                <div class="col-12 mb-3">
                                    <label class="form-label">Periode Kepengurusan</label>
                                    <div class="form-control-plaintext">
                                        @php
                                            $periodeList = collect();
                                            if ($user->roleModel->name === 'kader') {
                                                $periodeList = $user->periodeKader;
                                            } elseif ($user->roleModel->name === 'kabid') {
                                                $periodeList = $user->periodeKabid;
                                            } elseif ($user->roleModel->name === 'presidium') {
                                                $user->load('periodePresidium');
                                                $periodeList = $user->periodePresidium;
                                            }
                                        @endphp
                                        @if($periodeList->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($periodeList as $periode)
                                                    <span class="badge bg-info">
                                                        {{ $periode->nama_periode }}
                                                        @if($periode->is_aktif)
                                                            <span class="badge bg-success ms-1">Aktif</span>
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            @if($user->roleModel && $user->roleModel->name === 'kader' && $user->kategoriBiro->count() > 0)
                                <div class="col-12 mb-3">
                                    <label class="form-label">Kategori Biro</label>
                                    <div class="form-control-plaintext">
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($user->kategoriBiro as $biro)
                                                <span class="badge bg-blue">{{ $biro->nama }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

