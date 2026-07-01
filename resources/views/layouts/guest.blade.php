<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login — {{ config('app.name', 'Crankhaus') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@700;900&display=swap" rel="stylesheet">
    </head>
    <body class="antialiased bg-[#f8f9fa] text-gray-900 min-h-screen flex" style="font-family: 'Inter', sans-serif;">
        
        {{-- Left Side: Image/Branding (Hidden on mobile) --}}
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#1a1a1a] items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-black/60 to-black/20 z-10"></div>
            <img src="{{ asset('images/cinematic_cafe_hero.png') }}" alt="Crankhaus Vibe" class="absolute inset-0 w-full h-full object-cover opacity-90 scale-105 hover:scale-100 transition-transform duration-[10s] ease-out" />
            
            <div class="relative z-20 text-center px-12 transform translate-y-[-20px]">
                <a href="/">
                    <img src="{{ asset('images/CRANK (1).png') }}" alt="CRANKHAUS" class="h-32 w-auto mx-auto mb-8 drop-shadow-2xl transition-transform hover:scale-105 duration-300">
                </a>
                <h2 class="font-black text-white text-5xl tracking-tight mb-4 drop-shadow-lg" style="font-family: 'Space Grotesk', sans-serif;">EAT. DRINK. RIDE.</h2>
                <p class="text-white/90 text-lg font-medium tracking-wide drop-shadow">The ultimate destination for cyclists and coffee lovers.</p>
            </div>
        </div>

        {{-- Right Side: Form Container --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 bg-white relative shadow-[-20px_0_40px_rgba(0,0,0,0.05)] z-20">
            {{-- Mobile Logo --}}
            <div class="absolute top-8 left-8 lg:hidden">
                 <a href="/">
                     <img src="{{ asset('images/CRANK (1).png') }}" alt="CRANKHAUS" class="h-10 w-auto filter invert brightness-0">
                 </a>
            </div>

            <div class="w-full max-w-md mx-auto space-y-10 mt-12 lg:mt-0">
                <div class="space-y-3">
                    <h1 class="text-4xl font-black text-gray-900 tracking-tight" style="font-family: 'Space Grotesk', sans-serif;">Welcome Back</h1>
                    <p class="text-gray-500 font-medium text-base">Please enter your details to sign in.</p>
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
