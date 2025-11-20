@extends('layouts.tabler')

@section('title', 'Detail User')

@section('pretitle', 'Presidium')

@php
    $currentUser = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail User: {{ $user->name }}</h3>
                <div class="card-actions">
                    <a href="{{ route('presidium.user.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('presidium.user.edit', $user) }}?redirect_back={{ urlencode(route('presidium.user.show', $user)) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        @if($user->foto_profile)
                            <img src="{{ asset('storage/' . $user->foto_profile) }}" alt="{{ $user->name }}" class="avatar avatar-xl mb-3">
                        @else
                            <img src="https://cdn-icons-png.freepik.com/512/4264/4264711.png" alt="{{ $user->name }}" class="avatar avatar-xl mb-3">
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
                                <label class="form-label">Nama Lengkap</label>
                                <div class="form-control-plaintext">{{ $user->name }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <div class="form-control-plaintext">{{ $user->email }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role</label>
                                <div class="form-control-plaintext">
                                    <span class="badge bg-blue">{{ $user->roleModel?->label ?? '-' }}</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-control-plaintext">
                                    @if($user->status_aktif)
                                        <span class="badge bg-green">Aktif</span>
                                    @else
                                        <span class="badge bg-red">Tidak Aktif</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor WA</label>
                                <div class="form-control-plaintext">{{ $user->nomor_wa ?? '-' }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan</label>
                                <div class="form-control-plaintext">{{ $user->jurusan ?? '-' }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NPM</label>
                                <div class="form-control-plaintext">{{ $user->npm ?? '-' }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hobi</label>
                                <div class="form-control-plaintext">{{ $user->hobi ?? '-' }}</div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat</label>
                                <div class="form-control-plaintext">{{ $user->alamat ?? '-' }}</div>
                            </div>
                            
                            @if($user->roleModel && $user->roleModel->name === 'kader' && $user->periodeKader->count() > 0)
                                <div class="col-12 mb-3">
                                    <label class="form-label">Periode Kepengurusan</label>
                                    <div class="form-control-plaintext">
                                        @foreach($user->periodeKader as $periode)
                                            <span class="badge bg-info me-1">
                                                {{ $periode->nama_periode }}
                                                @if($periode->tanggal_mulai)
                                                    ({{ $periode->tanggal_mulai->format('Y') }})
                                                @endif
                                                @if($periode->is_aktif)
                                                    <span class="badge bg-success ms-1">Aktif</span>
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dibuat</label>
                                <div class="form-control-plaintext">{{ $user->created_at->format('d M Y H:i') }}</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Diperbarui</label>
                                <div class="form-control-plaintext">{{ $user->updated_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

