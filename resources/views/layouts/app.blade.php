<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Aplikasi -->
    <title>{{ config('app.name', 'SkyGuardLearn') }}</title>

    <!-- ====================== -->
    <!-- Favicon (Icon Tab) -->
    <!-- ====================== -->
    <link rel="icon" type="image/png" href="{{ asset('assets/icons/Arhanud.png') }}">


    <!-- ====================== -->
    <!-- Fonts -->
    <!-- ====================== -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- ====================== -->
    <!-- Styles & Scripts -->
    <!-- ====================== -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <div class="min-h-screen">
        <!-- Navbar Utama -->
        @include('layouts.navigation')

        <!-- Page Heading (Opsional) -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Konten Utama -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>

</html>
