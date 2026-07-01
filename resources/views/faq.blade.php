<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="CRANKHAUS cyclist café FAQ. Get answers about bike storage, reservations, events, and food options.">
    <title>FAQ — CRANKHAUS | Jakarta</title>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</head>
<body class="text-[#efe1d9] overflow-x-hidden min-h-screen" style="background-color: #235c47; background-image: radial-gradient(circle at center, #2c7258 0%, #1a4736 100%);">
    <div class="film-grain"></div>
    <canvas id="three-scroll-canvas" class="fixed inset-0 w-full h-full pointer-events-none z-0 opacity-40"></canvas>

    <!-- Fixed Header -->
    <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-8 md:px-20 lg:px-28 py-6 pointer-events-none" id="ch-header">
        <!-- Left balance div -->
        <div class="flex-1"></div>

        <!-- Center Logo (bigger) -->
        <div class="flex-1 flex justify-center pointer-events-auto items-center">
            <a href="/" class="hover:opacity-80 transition-opacity duration-300">
                <img src="{{ asset('images/CRANK (1).png') }}" alt="CRANKHAUS" class="h-20 md:h-24 lg:h-28 w-auto object-contain">
            </a>
        </div>

        <!-- Right Actions -->
        <div class="flex-1 flex justify-end items-center gap-4 pointer-events-auto" style="margin-right: 40px;">
            <a href="/reserve" class="btn-reserve hidden sm:inline-flex" aria-label="Reserve a Table">
                RESERVE
            </a>
            <div id="menu-toggle-btn" class="hamburger-wrap" aria-label="Open menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
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

    {{-- ── Vertical Rotation Text Markers (Gambar 1 style) ── --}}
    <div class="fixed left-6 top-8 select-none pointer-events-none z-40 hidden lg:block">
        <span class="font-mono text-[9px] uppercase tracking-[0.45em] text-[#efe1d9]/30 -rotate-90 inline-block origin-center whitespace-nowrap">CAT</span>
    </div>
    <div class="fixed left-6 bottom-8 select-none pointer-events-none z-40 hidden lg:block">
        <span class="font-mono text-[9px] uppercase tracking-[0.45em] text-[#efe1d9]/30 -rotate-90 inline-block origin-center whitespace-nowrap">FAQ</span>
    </div>
    <div class="fixed right-6 bottom-8 select-none pointer-events-none z-40 hidden lg:block">
        <span class="font-mono text-[9px] uppercase tracking-[0.45em] text-[#efe1d9]/30 -rotate-90 inline-block origin-center whitespace-nowrap">PLAY</span>
    </div>

    {{-- ── Rotating Scroll Circle (Gambar 2 style) ── --}}
    <div class="fixed right-10 top-1/2 -translate-y-1/2 z-40 hidden xl:flex items-center justify-center w-32 h-32 select-none pointer-events-none">
        <svg class="w-full h-full animate-spin-slow text-[#eba13d]/60" viewBox="0 0 100 100">
            <path id="circlePath" d="M 50, 50 m -38, 0 a 38,38 0 1,1 76,0 a 38,38 0 1,1 -76,0" fill="none" />
            <text font-family="'Abril Fatface', 'ITC Motter Corpus', serif" font-size="7.5" font-weight="normal" letter-spacing="1.8" fill="currentColor">
                <textPath href="#circlePath">scroll • scroll • scroll • scroll • </textPath>
            </text>
        </svg>
        <!-- Hand pointing down SVG -->
        <svg class="absolute w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 14V3a1.5 1.5 0 0 0-3 0v9a.5.5 0 0 1-1 0V8.5a1.5 1.5 0 0 0-3 0V14c0 3.86 3.14 7 7 7h1.5a5.5 5.5 0 0 0 5.5-5.5v-2a1.5 1.5 0 0 0-3 0v1.5a.5.5 0 0 1-1 0V12a1.5 1.5 0 0 0-3 0v2a.5.5 0 0 1-1 0z" />
        </svg>
    </div>

    {{-- ── MAIN CONTENT (FAQ List) ── --}}
    <main class="w-full flex flex-col items-center">
        <!-- FAQ Hero (Vertically and Horizontally Centered) -->
        <section class="w-full min-h-[90vh] flex flex-col items-center justify-center px-6 text-center">
            <div class="w-full max-w-4xl flex flex-col items-center justify-center">
                <!-- Title centered and slightly smaller -->
                <h1 class="font-display text-[#eba13d] uppercase leading-none select-none"
                    style="font-size: clamp(2.2rem, 7vw, 5.2rem); letter-spacing: 0.01em; font-weight: 900; margin: 0;">
                    ANY<br>QUESTIONS?
                </h1>
            </div>
        </section>

        <!-- Q&A List Section -->
        <section class="w-full pb-32 flex flex-col items-center">
            <div class="w-full max-w-4xl px-6 flex flex-col items-center">
                <div class="w-full flex flex-col items-center max-w-3xl">
                
                <!-- Q1 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        I booked a table for 7:30 PM but we're running late and will arrive around 8:30 PM; will you still hold our table?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        We will do our best to keep your table! Please do not hesitate to contact us by phone if you are unable to attend; you can reach us at the number displayed at the bottom of our website.
                    </p>
                </div>

                <!-- Q2 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        Do you have vegetarian, halal, or vegan food?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        We offer several vegetarian and vegan dishes on our menu (some tapas, and vegetarian dishes where we can remove the cheese, for example).
                    </p>
                </div>

                <!-- Q3 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        Can I bring my bicycle inside the café?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        Absolutely! We have a secure, dedicated indoor bike vault so you can enjoy your espresso and recovery meal without worrying about your ride.
                    </p>
                </div>

                <!-- Q4 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        Do you have tools or a pump for customer use?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        Yes, we provide a free mechanical assistance station equipped with track pumps, a repair stand, and essential tools for quick tune-ups.
                    </p>
                </div>

                <!-- Q5 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        Can we watch live cycling races at CRANKHAUS?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        Yes! We stream all major cycling events, from the Spring Classics to the Grand Tours, live on our big screens. Join the peloton on race days!
                    </p>
                </div>

                <!-- Q6 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        Do you accommodate large group rides?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        We love group rides! Whether you are starting, stopping, or planning a mid-ride recovery break, our spacious café and bike parking can accommodate large cycling clubs.
                    </p>
                </div>

                <!-- Q7 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        What is a 'Recovery Noodle'?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        It's our signature cyclist recovery bowl—high-carb, nutrient-dense noodles designed to restore glycogen stores and refuel your muscles after a long ride.
                    </p>
                </div>

                <!-- Q8 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        Do you charge for using the secure bike vault?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        Not at all. The indoor bike vault is free of charge for all CRANKHAUS diners and café visitors.
                    </p>
                </div>

                <!-- Q9 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        Can I book the venue for a private cycling event?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        Yes, CRANKHAUS is available for private events, brand launches, and community meetups. Please contact us via our reservation form.
                    </p>
                </div>

                <!-- Q10 -->
                <div class="faq-item flex flex-col items-center w-full text-center" style="margin-bottom: clamp(5rem, 10vw, 8rem);">
                    <h3 class="font-display text-[#eba13d] font-normal leading-tight mb-4 text-center" style="font-size: clamp(1.3rem, 3.2vw, 2.2rem);">
                        Where is CRANKHAUS located and is there car parking?
                    </h3>
                    <p class="font-serif text-[#efe1d9] leading-relaxed max-w-2xl font-normal text-center" style="font-size: clamp(0.95rem, 2vw, 1.15rem); opacity: 0.9;">
                        We are located in the heart of Jakarta, easily accessible by bike. While we focus heavily on bicycle parking, limited car parking is also available.
                    </p>
                </div>
        </div>
        </section>
    </main>

        {{-- ── RESERVATION CTA (Gambar 1 style) ── --}}
        <section class="w-full flex flex-col items-center justify-center min-h-screen"
                 style="background: #b42638; padding-top: 8vh; padding-bottom: 8vh;" id="reservations">
            <div class="w-full max-w-4xl mx-auto text-center flex flex-col items-center justify-center">

                <h2 class="font-display font-black uppercase leading-tight text-[#eba13d] select-none"
                    style="font-size: clamp(3rem, 7vw, 5.5rem); letter-spacing: 0.01em; margin-bottom: clamp(3rem, 6vh, 5rem);">
                    SO, SHALL<br>
                    WE RESERVE ?
                </h2>

                <a href="/reserve" class="inline-flex items-center justify-center font-sans font-black text-white hover:opacity-95 transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5"
                   style="background: #eba13d; border-radius: 8px; padding: 16px 48px; font-size: 1.1rem; letter-spacing: 0.05em; margin-bottom: clamp(3.5rem, 7vh, 6rem);">
                    RESERVE
                </a>

                <p class="font-sans font-bold text-[#eba13d] text-sm md:text-base leading-relaxed text-center"
                   style="margin-bottom: clamp(4rem, 8vh, 7rem);">
                    Open Tuesday to Sunday<br>
                    Lunch and dinner services
                </p>

            <a href="/?nobumper=1" class="home-transition-link font-display font-black text-white hover:text-white/80 uppercase tracking-widest text-[11px] md:text-[13px] border-b-2 border-white/40 hover:border-white transition-all pb-1 mb-16" style="letter-spacing: 0.05em;">
                GO BACK TO HOMEPAGE !
            </a>
        </div>
    </section>

    </main>

    {{-- ── FOOTER (Background Image - Fixed Perfect Size - Brighter Overlay) ── --}}
    <footer style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/footerfix.jpg') }}') center/cover no-repeat; padding: 16px 10px; width: 100%; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: center; align-items: center;">
        <a href="/" style="text-decoration: none; color: white; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
            <div class="font-display font-black" style="line-height: 0.85; letter-spacing: 0.02em; text-align: center;">
                <span style="display: block; font-size: clamp(22px, 4vw, 32px); margin: 0; padding: 0; opacity: 0.8;">CRANKHAUS</span>
                <span style="display: block; font-size: clamp(14px, 1.8vw, 20px); margin: 0; padding: 0; opacity: 0.8;">2026</span>
            </div>
        </a>
    </footer>

    <x-page-transitions />

    @livewireScripts

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.gsap && window.ScrollTrigger) gsap.registerPlugin(ScrollTrigger);

        // ── Navigation Drawer ──
        var overlay   = document.getElementById('menu-overlay');
        var panel     = document.getElementById('menu-panel');
        var toggleBtn = document.getElementById('menu-toggle-btn');
        var closeBtn  = document.getElementById('menu-close-btn');
        var backdrop  = document.getElementById('menu-backdrop');
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
                onComplete: function () {
                    overlay.classList.add('pointer-events-none');
                }
            });
        }

        if (toggleBtn && closeBtn && backdrop) {
            toggleBtn.addEventListener('click', function () {
                toggleBtn.classList.contains('menu-active') ? closeMenu() : openMenu();
            });
            closeBtn.addEventListener('click', closeMenu);
            backdrop.addEventListener('click', closeMenu);
        }
        if (eventsLink) eventsLink.addEventListener('click', closeMenu);



        // ── Three.js Scroll Parallax Scene ──
        if (window.THREE) {
            (function() {
                var canvas = document.getElementById('three-scroll-canvas');
                if (!canvas) return;
                
                var scene = new THREE.Scene();
                var camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 100);
                camera.position.z = 8;
                
                var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
                renderer.setSize(window.innerWidth, window.innerHeight);
                renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
                
                var shapesGroup = new THREE.Group();
                scene.add(shapesGroup);
                
                var geometries = [
                    new THREE.TorusGeometry(1.4, 0.08, 8, 24),
                    new THREE.TorusGeometry(0.7, 0.06, 6, 16),
                    new THREE.TorusGeometry(2.0, 0.04, 10, 32),
                    new THREE.TorusKnotGeometry(0.9, 0.12, 40, 6, 3, 5)
                ];
                
                var colors = [0xeba13d, 0xb42638];
                
                for (var i = 0; i < 20; i++) {
                    var geom = geometries[Math.floor(Math.random() * geometries.length)].clone();
                    var mat = new THREE.MeshBasicMaterial({
                        color: colors[Math.floor(Math.random() * colors.length)],
                        wireframe: true,
                        transparent: true,
                        opacity: 0.3
                    });
                    var mesh = new THREE.Mesh(geom, mat);
                    
                    mesh.position.set(
                        (Math.random() - 0.5) * 24,
                        (Math.random() - 0.5) * 18,
                        (Math.random() - 0.5) * 16 - 10
                    );
                    
                    mesh.rotation.set(
                        Math.random() * Math.PI,
                        Math.random() * Math.PI,
                        Math.random() * Math.PI
                    );
                    
                    mesh.userData = {
                        rotX: (Math.random() - 0.5) * 0.01,
                        rotY: (Math.random() - 0.5) * 0.01,
                        rotZ: (Math.random() - 0.5) * 0.01,
                        floatSpeed: Math.random() * 0.002 + 0.0008,
                        floatOffset: Math.random() * Math.PI * 2,
                        initialY: mesh.position.y
                    };
                    
                    shapesGroup.add(mesh);
                }
                
                var targetScrollY = window.scrollY;
                var currentScrollY = window.scrollY;
                
                window.addEventListener('scroll', function() {
                    targetScrollY = window.scrollY;
                }, { passive: true });
                
                var mouseX = 0;
                var mouseY = 0;
                window.addEventListener('mousemove', function(e) {
                    mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
                    mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
                }, { passive: true });
                
                function tick(time) {
                    requestAnimationFrame(tick);
                    
                    currentScrollY += (targetScrollY - currentScrollY) * 0.08;
                    
                    shapesGroup.children.forEach(function(mesh) {
                        mesh.rotation.x += mesh.userData.rotX;
                        mesh.rotation.y += mesh.userData.rotY;
                        mesh.rotation.z += mesh.userData.rotZ;
                        
                        mesh.position.y = mesh.userData.initialY + Math.sin(time * mesh.userData.floatSpeed + mesh.userData.floatOffset) * 0.4;
                    });
                    
                    var scrollOffset = currentScrollY * 0.006;
                    var targetCamX = mouseX * 2.5;
                    var targetCamY = -scrollOffset - (mouseY * 2.0);
                    
                    camera.position.x += (targetCamX - camera.position.x) * 0.05;
                    camera.position.y += (targetCamY - camera.position.y) * 0.05;
                    
                    camera.lookAt(new THREE.Vector3(0, -scrollOffset, -15));
                    
                    renderer.render(scene, camera);
                }
                
                requestAnimationFrame(tick);
                
                window.addEventListener('resize', function() {
                    camera.aspect = window.innerWidth / window.innerHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(window.innerWidth, window.innerHeight);
                });
            })();
        }

        // ── Scroll Trigger Reveal Animations ──
        if (window.gsap && window.ScrollTrigger) {
            // Apply 3D Scroll Reveal to elements with class .gsap-3d-reveal and .faq-item
            document.querySelectorAll('.gsap-3d-reveal, .faq-item').forEach(function (el) {
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

            // Reservations section container (Safe Single Reveal to prevent bottom-of-page freeze)
            gsap.from('#reservations .max-w-4xl', {
                scrollTrigger: {
                    trigger: '#reservations',
                    start: 'top 95%',
                    toggleActions: 'play none none none'
                },
                opacity: 0,
                y: 30,
                duration: 0.85,
                ease: 'power3.out'
            });
        }
    });
    </script>
</body>
</html>
