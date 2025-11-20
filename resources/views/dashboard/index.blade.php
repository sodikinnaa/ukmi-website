@extends('layouts.tabler')

@section('title', 'Dashboard')

@section('pretitle', 'Halaman Utama')

@php
    $user = Auth::user();
@endphp

@section('content')
    @if($user->isPresidium())
        @include('presidium.dashboard.index')
    @elseif($user->isKabid())
        @include('kabid.dashboard.index')
    @elseif($user->isKader())
        @include('kader.dashboard.index')
    @elseif($user->isPembina())
        @include('pembina.dashboard.index')
    @endif
@endsection
