<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu — Crankhaus | Eat. Drink. Ride.</title>
    <meta name="description" content="Explore Crankhaus's full menu — recovery noodles, bold espresso, dimsum, and refreshing drinks engineered for cyclists in Jakarta.">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <style>
        /* Cinematic background overlay: sits under everything, managed by GSAP */
        #ch-cinematic-bg {
            z-index: 0;
            pointer-events: none;
            transition: none; /* GSAP handles opacity, no CSS transition needed */
        }
        /* Ensure all menu content is above the fixed cinematic layer */
        .ch-menu-list-section {
            isolation: isolate;
        }
        /* Animate modal with a smooth scale+fade pop */
        @keyframes modal-pop {
            from { opacity: 0; transform: scale(0.94) translateY(20px); }
            to   { opacity: 1; transform: scale(1)   translateY(0); }
        }
        .animate-modal-pop {
            animation: modal-pop 0.42s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body class="bg-[#020b0a] text-[#efe1d9] overflow-x-hidden">
    @include('components.smooth-site')
    <x-global-engine />
    <div class="film-grain"></div>

    <!-- Fixed Header -->
    <header class="fixed top-0 left-0 w-full z-50 pointer-events-none" id="ch-header">
        <div class="max-w-screen-2xl mx-auto w-full flex justify-between items-center px-4 md:px-8 lg:px-12 py-6">
            <!-- Left balance div -->
            <div class="flex-1"></div>

            <!-- Center Logo (bigger) -->
            <div class="flex-1 flex justify-center pointer-events-auto items-center">
                <a href="/" class="hover:opacity-80 transition-opacity duration-300">
                    <img src="{{ asset('images/CRANK (1).png') }}" alt="CRANKHAUS" class="h-20 md:h-24 lg:h-28 w-auto object-contain">
                </a>
            </div>

            <!-- Right Actions -->
            <div class="flex-1 flex justify-end items-center gap-4 pointer-events-auto" style="margin-right: 10px;">
                <a href="/reserve" class="btn-reserve hidden sm:inline-flex" aria-label="Reserve a Table">
                    RESERVE
                </a>
                <div id="menu-toggle-btn" class="hamburger-wrap" aria-label="Open menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </div>
            </div>
        </div>
    </header>

    {{-- ── FULLSCREEN OVERLAY MENU ── --}}
    <div id="menu-overlay" class="fixed inset-0 z-[100] flex justify-end opacity-0 pointer-events-none" style="transition: opacity 0.35s ease;">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" id="menu-backdrop"></div>

        <!-- Green Drawer Panel (Half Screen) -->
        <div class="relative w-full md:w-1/2 lg:w-[50vw] h-full flex flex-col justify-between z-10"
             style="background: #235c47; transform: translateX(100%); transition: transform 0.55s cubic-bezier(0.16,1,0.3,1); padding: clamp(1.5rem, 4vw, 3.5rem) clamp(1.5rem, 4vw, 3.5rem);"
             id="menu-panel">

            <!-- Top Logo & Close Button (Lucky Folks style) -->
            <div class="w-full flex justify-between items-center" style="padding-bottom: clamp(1rem, 2vh, 1.5rem);">
                <a href="/" class="hover:opacity-80 transition-opacity">
                    <img src="{{ asset('images/CRANK (1).png') }}" alt="CRANKHAUS" class="w-auto object-contain" style="height: clamp(2.5rem, 5vw, 4rem);">
                </a>
                <button id="menu-close-btn"
                        class="flex items-center justify-center font-bold text-lg cursor-pointer transition-transform hover:scale-105 active:scale-95"
                        style="background: #eba13d; border-radius: 6px; width: 44px; height: 44px; color: #020b0a; font-size: 1.2rem;"
                        aria-label="Close menu">
                    ✕
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col my-auto items-center justify-center" style="gap: clamp(1.2rem, 3.5vh, 2.5rem);">
                <div class="flex flex-col items-start" style="gap: clamp(1rem, 2.8vh, 2rem); min-width: max-content;">
                    <!-- I -->
                    <div class="flex items-baseline" style="gap: clamp(1.2rem, 2.5vw, 2.2rem);">
                        <span class="font-mono text-[#eba13d] text-right" style="font-size: clamp(0.75rem, 1.8vw, 1.1rem); font-weight: 700; width: clamp(1.5rem, 3.2vw, 2.8rem); letter-spacing: 0.1em; display: inline-block;">I</span>
                        <a href="/" class="font-display font-black text-[#eba13d] uppercase leading-none hover:text-white transition-colors"
                           style="font-size: clamp(1.8rem, 4.5vw, 3.4rem);">CRANKHAUS</a>
                    </div>
                    <!-- II -->
                    <div class="flex items-baseline" style="gap: clamp(1.2rem, 2.5vw, 2.2rem);">
                        <span class="font-mono text-[#eba13d] text-right" style="font-size: clamp(0.75rem, 1.8vw, 1.1rem); font-weight: 700; width: clamp(1.5rem, 3.2vw, 2.8rem); letter-spacing: 0.1em; display: inline-block;">II</span>
                        <a href="/menu" class="font-display font-black text-[#eba13d] uppercase leading-none hover:text-white transition-colors"
                           style="font-size: clamp(1.8rem, 4.5vw, 3.4rem);">THE MENU</a>
                    </div>
                    <!-- III -->
                    <div class="flex items-baseline" style="gap: clamp(1.2rem, 2.5vw, 2.2rem);">
                        <span class="font-mono text-[#eba13d] text-right" style="font-size: clamp(0.75rem, 1.8vw, 1.1rem); font-weight: 700; width: clamp(1.5rem, 3.2vw, 2.8rem); letter-spacing: 0.1em; display: inline-block;">III</span>
                        <a href="/reserve" class="font-display font-black text-[#eba13d] uppercase leading-none hover:text-white transition-colors"
                           style="font-size: clamp(1.8rem, 4.5vw, 3.4rem);">BOOK A TABLE</a>
                    </div>
                    <!-- IV -->
                    <div class="flex items-baseline" style="gap: clamp(1.2rem, 2.5vw, 2.2rem);">
                        <span class="font-mono text-[#eba13d] text-right" style="font-size: clamp(0.75rem, 1.8vw, 1.1rem); font-weight: 700; width: clamp(1.5rem, 3.2vw, 2.8rem); letter-spacing: 0.1em; display: inline-block;">IV</span>
                        <a href="/#events" id="menu-events-link" class="font-display font-black text-[#eba13d] uppercase leading-none hover:text-white transition-colors"
                           style="font-size: clamp(1.8rem, 4.5vw, 3.4rem);">RIDES &amp; EVENTS</a>
                    </div>
                    <!-- V -->
                    <div class="flex items-baseline" style="gap: clamp(1.2rem, 2.5vw, 2.2rem);">
                        <span class="font-mono text-[#eba13d] text-right" style="font-size: clamp(0.75rem, 1.8vw, 1.1rem); font-weight: 700; width: clamp(1.5rem, 3.2vw, 2.8rem); letter-spacing: 0.1em; display: inline-block;">V</span>
                        @auth
                            <a href="/admin" class="font-display font-black text-[#eba13d] uppercase leading-none hover:text-white transition-colors"
                               style="font-size: clamp(1.8rem, 4.5vw, 3.4rem);">PORTAL</a>
                        @else
                            <a href="/login" class="font-display font-black text-[#eba13d] uppercase leading-none hover:text-white transition-colors"
                               style="font-size: clamp(1.8rem, 4.5vw, 3.4rem);">LOGIN</a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Bottom: Reserve Button + Socials -->
            <div class="flex flex-col items-center text-center w-full" style="gap: clamp(1rem, 2vh, 1.8rem);">
                <a href="/reserve"
                   class="font-script text-white hover:opacity-90 transition-all shadow-md inline-flex items-center justify-center"
                   style="background: #b42638; border-radius: 999px; padding: 12px 40px; font-size: clamp(1.1rem, 2vw, 1.3rem); width: fit-content; margin-left: auto; margin-right: auto;">
                    Réserver
                </a>

                <!-- Socials & Info -->
                <div class="flex flex-col items-center justify-center pt-4 border-t border-white/10 w-full" style="gap: 0.8rem;">
                    <div class="flex gap-8 justify-center">
                        <a href="https://instagram.com" target="_blank" class="text-white hover:text-[#eba13d] transition-colors font-bold uppercase tracking-widest" style="font-size: 0.7rem;">Instagram</a>
                        <a href="https://facebook.com" target="_blank" class="text-white hover:text-[#eba13d] transition-colors font-bold uppercase tracking-widest" style="font-size: 0.7rem;">Facebook</a>
                    </div>
                    <span class="font-mono text-white/40" style="font-size: 0.65rem;">Jakarta, ID</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Vertical Rotation Text Markers ── --}}
    <div class="fixed left-4 top-1/2 -translate-y-1/2 select-none pointer-events-none z-40 hidden lg:block">
        <span class="font-mono text-[9px] uppercase tracking-[0.45em] text-[#efe1d9]/25 rotate-90 inline-block origin-center whitespace-nowrap">EAT</span>
    </div>
    <div class="fixed left-4 bottom-20 select-none pointer-events-none z-40 hidden lg:block">
        <span class="font-mono text-[9px] uppercase tracking-[0.45em] text-[#efe1d9]/25 rotate-90 inline-block origin-center whitespace-nowrap">DRINK</span>
    </div>
    <div class="fixed right-4 top-1/2 -translate-y-1/2 select-none pointer-events-none z-40 hidden lg:block">
        <span class="font-mono text-[9px] uppercase tracking-[0.45em] text-[#efe1d9]/25 -rotate-90 inline-block origin-center whitespace-nowrap">RIDE</span>
    </div>


    {{-- ── Menu Hero (Minimalist & Centered) ── --}}
    <section class="pt-[88px] relative overflow-hidden w-full bg-[#b42638]">
        <div class="relative flex flex-col items-center justify-center overflow-hidden max-w-screen-2xl mx-auto w-full px-4 md:px-8 text-center"
             style="padding-top: clamp(4rem, 10vw, 8rem); padding-bottom: clamp(3rem, 8vw, 6rem);">

            {{-- Background glow --}}
            <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                <div class="absolute rounded-full blur-[120px] animate-float"
                     style="width: 500px; height: 500px; background: rgba(235,161,61,0.12); top: 50%; left: 50%; transform: translate(-50%,-50%);"></div>
            </div>

            {{-- Title --}}
            <div class="relative z-10 flex flex-col items-center">
                <h1 class="font-display font-black text-white uppercase leading-none mb-4 will-change-transform"
                    id="menu-title"
                    style="font-size: clamp(4.5rem, 14vw, 12rem); letter-spacing: -0.02em;">
                    THE MENU
                </h1>
                <h2 class="font-display font-black uppercase tracking-[0.2em] text-[#eba13d] block"
                    style="font-size: clamp(1.2rem, 3vw, 2.2rem);">
                    FOODS & DRINKS
                </h2>
            </div>
        </div>
    </section>

    {{-- ── Menu Catalog (Livewire) ── --}}
    <main class="min-h-screen" id="menu-catalog-wrap">
        @livewire('menu-catalog')
    </main>

    {{-- ── FOOTER (Background Image - Fixed Perfect Size - Brighter Overlay) ── --}}
    <footer style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/footerfix.jpg') }}') center/cover no-repeat; padding: 16px 10px; width: 100%; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: center; align-items: center;">
        <div class="w-full max-w-screen-2xl mx-auto flex justify-center items-center px-4">
            <a href="/" style="text-decoration: none; color: white; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                <div class="font-display font-black" style="line-height: 0.85; letter-spacing: 0.02em; text-align: center;">
                    <span style="display: block; font-size: clamp(22px, 4vw, 32px); margin: 0; padding: 0; opacity: 0.8;">CRANKHAUS</span>
                    <span style="display: block; font-size: clamp(14px, 1.8vw, 20px); margin: 0; padding: 0; opacity: 0.8;">2026</span>
                </div>
            </a>
        </div>
    </footer>

    <x-page-transitions />

    @livewireScripts

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.gsap && window.ScrollTrigger) gsap.registerPlugin(ScrollTrigger);

        // ── Navigation Drawer Overlay Animations ──
        var overlay = document.getElementById('menu-overlay');
        var panel = document.getElementById('menu-panel');
        var toggleBtn = document.getElementById('menu-toggle-btn');
        var closeBtn = document.getElementById('menu-close-btn');
        var backdrop = document.getElementById('menu-backdrop');
        var eventsLink = document.getElementById('menu-events-link');

        function openMenu() {
            overlay.classList.remove('pointer-events-none');
            toggleBtn.classList.add('menu-active');
            gsap.to(overlay, { opacity: 1, duration: 0.35, ease: 'power2.out' });
            gsap.to(panel, { x: '0%', duration: 0.55, ease: 'power3.out' });
        }

        function closeMenu() {
            toggleBtn.classList.remove('menu-active');
            gsap.to(panel, { x: '100%', duration: 0.45, ease: 'power3.in' });
            gsap.to(overlay, { 
                opacity: 0, 
                duration: 0.35, 
                ease: 'power2.in',
                onComplete: function() {
                    overlay.classList.add('pointer-events-none');
                }
            });
        }

        if (toggleBtn && closeBtn && backdrop) {
            toggleBtn.addEventListener('click', function() {
                if (toggleBtn.classList.contains('menu-active')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });
            closeBtn.addEventListener('click', closeMenu);
            backdrop.addEventListener('click', closeMenu);
        }
        if (eventsLink) eventsLink.addEventListener('click', closeMenu);



        // ── 3D SplitText hero title reveal ──
        var titleEl = document.getElementById('menu-title');
        if (titleEl && window.gsap) {
            var rawText = titleEl.textContent.trim();
            titleEl.innerHTML = '';
            rawText.split('').forEach(function (char) {
                var span = document.createElement('span');
                span.textContent = char === ' ' ? '\u00a0' : char;
                span.style.cssText = 'display:inline-block;opacity:0;transform:rotateX(-90deg) translateY(55px);transform-origin:top center;perspective:1000px;';
                titleEl.appendChild(span);
            });
            titleEl.querySelectorAll('span').forEach(function (span, i) {
                gsap.to(span, {
                    opacity: 1, rotationX: 0, y: 0,
                    duration: 0.95, ease: 'power4.out',
                    delay: 0.12 + i * 0.06, transformPerspective: 1000,
                });
            });
        }

        // ── Scroll Trigger 3D reveals ──
        if (window.gsap && window.ScrollTrigger) {
            // Apply 3D Scroll Reveal to any element with class .gsap-3d-reveal or key menu sections
            document.querySelectorAll('.gsap-3d-reveal, #menu-title-wrap').forEach(function (el) {
                gsap.set(el, { transformPerspective: 1200, transformStyle: 'preserve-3d' });
                gsap.fromTo(el,
                    {
                        opacity: 0,
                        rotationX: -15,
                        y: 60,
                        z: -80,
                        scale: 0.96
                    },
                    {
                        scrollTrigger: {
                            trigger: el,
                            start: 'top 88%',
                            toggleActions: 'play none none none'
                        },
                        opacity: 1,
                        rotationX: 0,
                        y: 0,
                        z: 0,
                        scale: 1,
                        duration: 1.2,
                        ease: 'power3.out'
                    }
                );
            });
        }


    });
    </script>

</body>
</html>
