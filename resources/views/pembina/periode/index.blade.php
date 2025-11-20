@extends('layouts.tabler')

@section('title', 'Pengaturan Periode Kepengurusan')

@section('pretitle', 'Pembina')

@php
    $user = Auth::user();
@endphp

@section('header-actions')
    <a href="{{ route('pembina.periode.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
        Tambah Periode
    </a>
@endsection

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Periode Kepengurusan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>NAMA PERIODE</th>
                                <th>PERIODE</th>
                                <th>PRESIDIUM</th>
                                <th>STATUS</th>
                                <th>PROGRAM KERJA</th>
                                <th class="w-1">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($periode as $p)
                                <tr>
                                    <td><strong>{{ $p->nama_periode }}</strong></td>
                                    <td>
                                        {{ $p->tanggal_mulai->format('d M Y') }}
                                        @if($p->tanggal_selesai)
                                            - {{ $p->tanggal_selesai->format('d M Y') }}
                                        @else
                                            - Sekarang
                                        @endif
                                    </td>
                                    <td>
                                        @if($p->presidium->count() > 0)
                                            @foreach($p->presidium as $presidium)
                                                <span class="badge bg-blue mb-1">{{ $presidium->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Belum ada presidium</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($p->is_aktif)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $p->programKerja()->count() }} Program</span>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('pembina.periode.show', $p) }}" class="btn btn-sm btn-info" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                            </a>
                                            <a href="{{ route('pembina.periode.edit', $p) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                            @if(!$p->is_aktif)
                                                <form action="{{ route('pembina.periode.activate', $p) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success" title="Aktifkan" onclick="return confirm('Aktifkan periode {{ $p->nama_periode }}? Periode aktif lainnya akan dinonaktifkan.');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('pembina.periode.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus periode ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada periode kepengurusan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($periode->hasPages())
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">
                            Menampilkan {{ $periode->firstItem() }} sampai {{ $periode->lastItem() }} dari {{ $periode->total() }} data
                        </p>
                        <ul class="pagination m-0 ms-auto">
                            {{ $periode->links() }}
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

