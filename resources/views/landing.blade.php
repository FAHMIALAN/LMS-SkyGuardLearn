<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SkyGuardLearn') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/Arhanud.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="min-h-screen flex flex-col">
        
        @include('layouts.navigation')

        <main class="flex-grow">
            {{-- BAGIAN HERO --}}
            <div class="relative bg-gray-800 overflow-hidden">
                <div class="absolute inset-0">
                    {{-- ================================================== --}}
                    {{-- === PERBAIKAN: Mengganti gambar latar belakang === --}}
                    {{-- ================================================== --}}
                    <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1666925996162-b12f3b82c146?q=80&w=1932&auto=format&fit=crop" alt="Sistem pertahanan udara">
                    <div class="absolute inset-0 bg-gray-900 bg-opacity-60"></div>
                </div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                        Selamat Datang di <span class="text-indigo-400">SkyGuardLearn</span>
                    </h1>
                    <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-300">
                        Platform pembelajaran modern yang menghubungkan pengajar dan siswa secara interaktif dan efisien.
                    </p>
                    <div class="mt-8 flex justify-center space-x-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Mulai Belajar
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                            Login
                        </a>
                    </div>
                </div>
            </div>

            {{-- BAGIAN FITUR UNGGULAN --}}
            <div class="bg-white dark:bg-gray-800 py-16 sm:py-24">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-base font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Fitur Kami</h2>
                        <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight sm:text-4xl">
                            Dirancang untuk Pembelajaran Efektif
                        </p>
                    </div>
                    <div class="mt-12 grid gap-10 sm:grid-cols-1 md:grid-cols-3">
                        <!-- Fitur 1: Materi Video -->
                        <div class="p-6 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Materi Video Interaktif</h3>
                            <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                                Tonton video pembelajaran langsung di platform tanpa perlu beralih aplikasi.
                            </p>
                        </div>
                        <!-- Fitur 2: Manajemen Tugas -->
                        <div class="p-6 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Manajemen Tugas Mudah</h3>
                            <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                                Pengajar dapat mengunggah tugas, dan siswa mengumpulkan jawaban dengan mudah.
                            </p>
                        </div>
                        <!-- Fitur 3: Diskusi Real-time -->
                        <div class="p-6 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Forum Diskusi Real-time</h3>
                            <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                                Berdiskusi langsung dengan pengajar dan siswa lain di setiap materi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        {{-- FOOTER --}}
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} SkyGuardLearn. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
