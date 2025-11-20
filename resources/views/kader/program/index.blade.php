@extends('layouts.tabler')

@section('title', 'Program Saya')

@section('pretitle', 'Kader')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Program yang Saya Ikuti</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>PROGRAM</th>
                                <th>KATEGORI BIRO</th>
                                <th>FREKUENSI</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <p class="text-muted mb-0">Belum ada program yang Anda ikuti</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
