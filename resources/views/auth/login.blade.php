@extends('layouts.app')

@section('title', 'Login - UKMI Ar-Rahman')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo & Title -->
            <div class="text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Logo_UKMI.png" alt="UKMI Ar-Rahman" class="mx-auto mb-4" style="max-width: 150px; height: auto;">
                <h1 class="text-4xl font-bold text-green-600 mb-2">UKMI Ar-Rahman</h1>
                <h2 class="text-2xl font-semibold text-gray-900 mb-2">Masuk ke Akun</h2>
                <p class="text-gray-600">Silakan login untuk mengakses sistem</p>
            </div>

            <!-- Login Form -->
            <div class="bg-white rounded-lg shadow-xl p-8">
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            placeholder="nama@email.com"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required 
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                            >
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Ingat saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-green-600 hover:text-green-500">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition"
                        >
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-green-500 group-hover:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Masuk
                        </button>
                    </div>
                </form>

                <!-- Back to Home -->
                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-green-600 transition">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
