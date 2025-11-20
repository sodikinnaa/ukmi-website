@extends('layouts.tabler')

@section('title', 'Preview Import User')

@section('pretitle', 'Presidium')

@php
    $user = Auth::user();
    
    $validCount = collect($previewData)->where('is_valid', true)->count();
    $invalidCount = collect($previewData)->where('is_valid', false)->count();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Preview Import User</h3>
                <div class="card-actions">
                    <a href="{{ route('presidium.user.import') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <h4 class="alert-title">Ringkasan Preview</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Total Data:</strong> {{ count($previewData) }}
                        </div>
                        <div class="col-md-4">
                            <strong class="text-success">Valid:</strong> {{ $validCount }}
                        </div>
                        <div class="col-md-4">
                            <strong class="text-danger">Tidak Valid:</strong> {{ $invalidCount }}
                        </div>
                    </div>
                    @if($invalidCount > 0)
                        <div class="mt-2">
                            <small class="text-muted">Data yang tidak valid tidak akan diimport. Silakan perbaiki file CSV dan upload ulang jika diperlukan.</small>
                        </div>
                    @endif
                </div>
                
                @if($validCount > 0)
                    <form action="{{ route('presidium.user.import.process') }}" method="POST" id="importForm">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>NPM</th>
                                        <th>Jurusan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($previewData as $data)
                                        <tr class="{{ $data['is_valid'] ? '' : 'table-danger' }}">
                                            <td>{{ $data['row_number'] }}</td>
                                            <td><strong>{{ $data['name'] ?: '-' }}</strong></td>
                                            <td>{{ $data['email'] ?: '-' }}</td>
                                            <td>
                                                @if($data['role'])
                                                    @php
                                                        $role = $roles->firstWhere('name', $data['role']);
                                                    @endphp
                                                    @if($role)
                                                        <span class="badge bg-blue">{{ $role->label }}</span>
                                                    @else
                                                        <span class="badge bg-red">{{ $data['role'] }}</span>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $data['npm'] ?: '-' }}</td>
                                            <td>{{ $data['jurusan'] ?: '-' }}</td>
                                            <td>
                                                @if($data['jenis_kelamin'])
                                                    <span class="badge bg-{{ $data['jenis_kelamin'] == 'L' ? 'blue' : 'pink' }}">
                                                        {{ $data['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data['is_valid'])
                                                    <span class="badge bg-success">Valid</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Valid</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($data['errors']))
                                                    <div class="text-danger">
                                                        @foreach($data['errors'] as $error)
                                                            <div><small>{{ $error }}</small></div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                @if(!empty($data['warnings']))
                                                    <div class="text-warning">
                                                        @foreach($data['warnings'] as $warning)
                                                            <div><small>{{ $warning }}</small></div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            <div class="alert alert-warning">
                                <h4 class="alert-title">Perhatian!</h4>
                                <p class="mb-0">
                                    Hanya data yang <strong>Valid</strong> yang akan diimport ke database. 
                                    Data yang tidak valid akan dilewati.
                                </p>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <a href="{{ route('presidium.user.import') }}" class="btn btn-secondary">Batal</a>
                                @if($validCount > 0)
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengimport {{ $validCount }} data user yang valid?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11v6" /><path d="M9 14l3 3l3 -3" /></svg>
                                        Import {{ $validCount }} Data Valid
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary" disabled>
                                        Tidak Ada Data Valid untuk Diimport
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                @else
                    <div class="alert alert-danger">
                        <h4 class="alert-title">Tidak Ada Data Valid</h4>
                        <p class="mb-0">Semua data yang diupload memiliki error. Silakan perbaiki file CSV dan upload ulang.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('presidium.user.import') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('presidium.user.download-template') }}" class="btn btn-info">Download Template</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

