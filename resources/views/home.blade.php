@extends('layouts.app')

@section('title', 'UKMI Ar-Rahman - Organisasi Mahasiswa Islam')

@section('content')
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-green-600">UKMI Ar-Rahman</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#tentang" class="text-gray-700 hover:text-green-600 transition">Tentang</a>
                    <a href="#struktur" class="text-gray-700 hover:text-green-600 transition">Struktur</a>
                    <a href="#bidang" class="text-gray-700 hover:text-green-600 transition">Bidang</a>
                    <a href="{{ route('login') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-green-50 to-emerald-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl font-bold text-gray-900 mb-4">UKMI Ar-Rahman</h2>
            <p class="text-xl text-gray-600 mb-8">Unit Kegiatan Mahasiswa Islam - Wadah Pembinaan dan Pengembangan Mahasiswa Muslim</p>
            <div class="flex justify-center space-x-4">
                <a href="#struktur" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition">
                    Lihat Struktur
                </a>
                <a href="#bidang" class="bg-white text-green-600 px-8 py-3 rounded-lg border-2 border-green-600 hover:bg-green-50 transition">
                    Bidang Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Tentang Kami</h3>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    UKMI Ar-Rahman adalah organisasi mahasiswa Islam yang berkomitmen untuk membina dan mengembangkan 
                    potensi mahasiswa muslim dalam berbagai aspek kehidupan, baik spiritual, intelektual, maupun sosial.
                </p>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi Section -->
    <section id="struktur" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Struktur Organisasi</h3>
                <p class="text-lg text-gray-600">Kepengurusan UKMI Ar-Rahman</p>
            </div>

            <!-- Pengurus Inti -->
            <div class="mb-12">
                <h4 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Pengurus Inti</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Ketua -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
                        <div class="w-24 h-24 bg-green-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">Ketua</h5>
                        <p class="text-gray-600">Pemimpin Organisasi</p>
                    </div>

                    <!-- Wakil Ketua -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
                        <div class="w-24 h-24 bg-green-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">Wakil Ketua</h5>
                        <p class="text-gray-600">Wakil Pemimpin</p>
                    </div>

                    <!-- Sekretaris -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
                        <div class="w-24 h-24 bg-green-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">Sekretaris</h5>
                        <p class="text-gray-600">Administrasi & Dokumentasi</p>
                    </div>

                    <!-- Bendahara -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
                        <div class="w-24 h-24 bg-green-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">Bendahara</h5>
                        <p class="text-gray-600">Keuangan & Anggaran</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bidang/Biro Section -->
    <section id="bidang" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Bidang & Biro</h3>
                <p class="text-lg text-gray-600">Divisi-divisi dalam UKMI Ar-Rahman</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- KSI - Kajian dan Syiar Islam -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-green-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">KSI</h4>
                    <p class="text-gray-700 font-medium mb-2">Kajian dan Syiar Islam</p>
                    <p class="text-gray-600 text-sm">
                        Bidang yang mengelola kegiatan kajian keislaman dan penyebaran dakwah di lingkungan kampus.
                    </p>
                </div>

                <!-- BBQ - Bimbingan Baca Quran -->
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">BBQ</h4>
                    <p class="text-gray-700 font-medium mb-2">Bimbingan Baca Quran</p>
                    <p class="text-gray-600 text-sm">
                        Bidang yang fokus pada pembelajaran dan pembinaan membaca Al-Quran dengan baik dan benar.
                    </p>
                </div>

                <!-- HMD - Humas dan Dokumentasi -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-purple-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">HMD</h4>
                    <p class="text-gray-700 font-medium mb-2">Humas dan Dokumentasi</p>
                    <p class="text-gray-600 text-sm">
                        Bidang yang menangani hubungan eksternal, komunikasi, dan dokumentasi kegiatan organisasi.
                    </p>
                </div>

                <!-- Kaderisasi -->
                <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-orange-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Kaderisasi</h4>
                    <p class="text-gray-700 font-medium mb-2">Pembinaan Kader</p>
                    <p class="text-gray-600 text-sm">
                        Bidang yang mengelola program pembinaan dan pengembangan kader organisasi.
                    </p>
                </div>

                <!-- Danus - Dana dan Usaha -->
                <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-red-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Danus</h4>
                    <p class="text-gray-700 font-medium mb-2">Dana dan Usaha</p>
                    <p class="text-gray-600 text-sm">
                        Bidang yang mengelola keuangan organisasi dan mengembangkan unit usaha untuk kemandirian organisasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h4 class="text-xl font-bold mb-2">UKMI Ar-Rahman</h4>
                <p class="text-gray-400">© {{ date('Y') }} UKMI Ar-Rahman. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endsection
