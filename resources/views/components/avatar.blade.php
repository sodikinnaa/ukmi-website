@props(['user', 'size' => 'sm'])

@php
    $sizeClass = match($size) {
        'xs' => 'avatar-xs',
        'sm' => 'avatar-sm',
        'md' => 'avatar',
        'lg' => 'avatar-lg',
        'xl' => 'avatar-xl',
        default => 'avatar-sm'
    };
    
    $fontSize = match($size) {
        'xs' => '0.7rem',
        'sm' => '0.875rem',
        'md' => '1rem',
        'lg' => '1.5rem',
        'xl' => '2rem',
        default => '0.875rem'
    };
@endphp

@if($user->foto_profile)
    <span class="avatar {{ $sizeClass }}" style="background-image: url({{ asset('storage/' . $user->foto_profile) }})"></span>
@else
    <span class="avatar {{ $sizeClass }}" style="background-image: url('https://cdn-icons-png.freepik.com/512/4264/4264711.png')"></span>
@endif

