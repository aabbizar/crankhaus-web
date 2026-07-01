<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login — {{ config('app.name', 'Crankhaus') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://unpkg.com/split-type"></script>
    </head>
    <body class="antialiased overflow-x-hidden"
          style="background: #235c47; background-image: radial-gradient(circle at center, #2c7258 0%, #1a4736 100%); color: #efe1d9; font-family: 'Inter', sans-serif; min-height: 100vh;">
        <x-page-transitions />

        {{-- ── Background: subtle animated gradient ── --}}
        <div class="fixed inset-0 z-0 pointer-events-none" aria-hidden="true">
            <div class="absolute inset-0" style="background: radial-gradient(ellipse 80% 70% at 50% 0%, rgba(180,38,56,0.15) 0%, transparent 70%);"></div>
            <div class="absolute inset-0" style="background: radial-gradient(ellipse 60% 60% at 80% 80%, rgba(235,161,61,0.08) 0%, transparent 65%);"></div>
        </div>

        {{-- ── Page wrapper — properly centered ── --}}
        <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">

            {{-- Card — max-width capped, not stretching on ultrawide ── --}}
            <div id="loginCard"
                 class="w-full shadow-2xl"
                 style="max-width: 460px; background: #b42638; border-radius: 24px; padding: 48px 44px; border: 1px solid rgba(235,161,61,0.25);">

                {{-- Logo ── --}}
                <div class="text-center mb-8">
                    <a href="/" class="inline-flex flex-col items-center gap-2 group no-underline">
                        <img src="{{ asset('images/CRANK (1).png') }}" alt="CRANKHAUS" class="h-20 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    </a>
                </div>

                {{-- Title ── --}}
                <div class="text-center mb-8">
                    <h1 id="loginTitle"
                        class="font-display font-black text-[#eba13d] uppercase mb-2 select-none"
                        style="font-size: 1.85rem; letter-spacing: 0.02em;">
                        Welcome Back
                    </h1>
                    <p class="font-mono text-xs uppercase tracking-[0.2em] text-[#efe1d9]/70">Sign in to continue</p>
                </div>

                {{-- Slot content (email, password, buttons from login.blade.php) --}}
                {{ $slot }}

            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Card entrance
            var card = document.getElementById('loginCard');
            if (card && window.gsap) {
                gsap.fromTo(card,
                    { y: 40, opacity: 0, scale: 0.96 },
                    { y: 0, opacity: 1, scale: 1, duration: 0.8, ease: 'power4.out', delay: 0.1 }
                );
            }

            // Title char reveal
            if (window.SplitType && window.gsap) {
                try {
                    var split = new SplitType('#loginTitle', { types: 'chars' });
                    gsap.from(split.chars, {
                        y: 30, opacity: 0, rotationX: -70,
                        stagger: 0.04, duration: 0.6, ease: 'back.out(2)', delay: 0.25
                    });
                } catch(e) {}
            }

        });
        </script>

    </body>
</html>
