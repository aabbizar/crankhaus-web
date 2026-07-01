<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <x-page-transitions />
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- ── FOOTER (Background Image - Fixed Perfect Size - Brighter Overlay) ── --}}
        <footer style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/footerfix.jpg') }}') center/cover no-repeat; padding: 16px 10px; width: 100%; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: center; align-items: center; position: relative; bottom: 0;">
            <div class="w-full max-w-screen-2xl mx-auto flex justify-center items-center px-4">
                <a href="/" style="text-decoration: none; color: white; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                    <div class="font-display font-black" style="line-height: 0.85; letter-spacing: 0.02em; text-align: center;">
                        <span style="display: block; font-size: clamp(22px, 4vw, 32px); margin: 0; padding: 0; opacity: 0.8;">CRANKHAUS</span>
                        <span style="display: block; font-size: clamp(14px, 1.8vw, 20px); margin: 0; padding: 0; opacity: 0.8;">2026</span>
                    </div>
                </a>
            </div>
        </footer>
    </body>
</html>
