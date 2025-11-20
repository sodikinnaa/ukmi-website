@extends('layouts.tabler')

@section('title', 'Detail Periode: ' . $periode->nama_periode)

@section('pretitle', 'Pembina')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Periode: {{ $periode->nama_periode }}</h3>
                <div class="card-actions">
                    <a href="{{ route('pembina.periode.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('pembina.periode.edit', $periode) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Periode</label>
                        <div class="form-control-plaintext"><strong>{{ $periode->nama_periode }}</strong></div>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <div class="form-control-plaintext">{{ $periode->tanggal_mulai->format('d M Y') }}</div>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <div class="form-control-plaintext">
                            {{ $periode->tanggal_selesai ? $periode->tanggal_selesai->format('d M Y') : 'Masih Berjalan' }}
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <div class="form-control-plaintext">
                            @if($periode->is_aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Program Kerja</label>
                        <div class="form-control-plaintext">
                            <span class="badge bg-info">{{ $periode->programKerja->count() }} Program</span>
                        </div>
                    </div>
                    
                    @if($periode->deskripsi)
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <div class="form-control-plaintext">{{ $periode->deskripsi }}</div>
                        </div>
                    @endif
                </div>
                
                <hr>
                
                <div class="mb-3">
                    <h4 class="mb-3">Presidium Periode Ini</h4>
                    @if($periode->presidium->count() > 0)
                        <div class="row">
                            @foreach($periode->presidium as $presidium)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                        <x-avatar :user="$presidium" size="lg" />
                                                </div>
                                                <div>
                                                    <strong>{{ $presidium->name }}</strong>
                                                    <div class="text-muted">{{ $presidium->email }}</div>
                                                    @if($presidium->npm)
                                                        <div class="text-muted">NPM: {{ $presidium->npm }}</div>
                                                    @endif
                                                    @if($presidium->nomor_wa)
                                                        <div class="text-muted">WA: {{ $presidium->nomor_wa }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="mb-0">Belum ada presidium yang ditetapkan untuk periode ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

