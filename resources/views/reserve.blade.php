<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reserve a Table — Crankhaus</title>
    <meta name="description" content="Book your table at Crankhaus — Jakarta's premier cyclist café. Confirmed within 2 hours.">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>
<body class="text-[#efe1d9] overflow-x-hidden min-h-screen" style="background-color: #235c47; background-image: radial-gradient(circle at center, #2c7258 0%, #1a4736 100%);">
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
    <div id="menu-overlay" class="fixed inset-0 z-[100] flex justify-end opacity-0 pointer-events-none" style="transition: opacity 0.5s ease;">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" id="menu-backdrop"></div>

        <!-- Green Drawer Panel (Half Screen) -->
        <div class="relative w-full md:w-1/2 lg:w-[50vw] h-full flex flex-col justify-between z-10"
             style="background: #235c47; transform: translateX(100%); transition: transform 0.7s cubic-bezier(0.16,1,0.3,1); padding: clamp(1.5rem, 4vw, 3.5rem) clamp(1.5rem, 4vw, 3.5rem);"
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


    <main class="w-full relative overflow-hidden">

        {{-- ── BACKGROUND DECORATIVE ROTATING COGS, TOPOGRAPHY, & FLOATING STENCILS ── --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
            <!-- Topography Layer 1 (Top Right elevation lines) -->
            <svg class="topo-layer absolute pointer-events-none text-[#eba13d]/[0.025] select-none" style="width: 700px; height: 400px; right: -50px; top: 12%;" viewBox="0 0 500 300" fill="none" stroke="currentColor" stroke-width="1">
                <path d="M 50,50 Q 150,120 250,60 T 450,150" />
                <path d="M 50,70 Q 150,140 250,80 T 450,170" />
                <path d="M 50,90 Q 150,160 250,100 T 450,190" />
                <path d="M 50,110 Q 150,180 250,120 T 450,210" />
                <path d="M 50,130 Q 150,200 250,140 T 450,230" />
            </svg>

            <!-- Topography Layer 2 (Middle Left elevation lines) -->
            <svg class="topo-layer absolute pointer-events-none text-[#eba13d]/[0.025] select-none" style="width: 800px; height: 500px; left: -100px; top: 45%;" viewBox="0 0 500 300" fill="none" stroke="currentColor" stroke-width="1">
                <path d="M 20,250 Q 180,150 300,200 T 480,50" />
                <path d="M 20,230 Q 180,130 300,180 T 480,30" />
                <path d="M 20,210 Q 180,110 300,160 T 480,10" />
                <path d="M 20,190 Q 180,90 300,140 T 480,-10" />
            </svg>

            <!-- Cog 1 (Top Left) -->
            <svg class="bg-cog bg-cog-1 absolute pointer-events-none text-[#eba13d]/5" style="width: 380px; height: 380px; left: -100px; top: 5%;" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.2">
                <circle cx="100" cy="100" r="90" stroke-dasharray="4, 4" stroke-width="3" />
                <circle cx="100" cy="100" r="85" />
                <line x1="100" y1="15" x2="100" y2="185" />
                <line x1="15" y1="100" x2="185" y2="100" />
                <line x1="40" y1="40" x2="160" y2="160" />
                <line x1="40" y1="160" x2="160" y2="40" />
                <circle cx="100" cy="100" r="60" />
                <circle cx="100" cy="100" r="40" />
                <circle cx="100" cy="100" r="20" />
                <circle cx="100" cy="100" r="8" fill="#eba13d" />
            </svg>

            <!-- Cog 2 (Middle Right) -->
            <svg class="bg-cog bg-cog-2 absolute pointer-events-none text-[#eba13d]/5" style="width: 480px; height: 480px; right: -150px; top: 35%;" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.2">
                <circle cx="100" cy="100" r="90" stroke-dasharray="4, 4" stroke-width="3" />
                <circle cx="100" cy="100" r="85" />
                <line x1="100" y1="15" x2="100" y2="185" />
                <line x1="15" y1="100" x2="185" y2="100" />
                <line x1="40" y1="40" x2="160" y2="160" />
                <line x1="40" y1="160" x2="160" y2="40" />
                <circle cx="100" cy="100" r="60" />
                <circle cx="100" cy="100" r="40" />
                <circle cx="100" cy="100" r="20" />
                <circle cx="100" cy="100" r="8" fill="#eba13d" />
            </svg>

            <!-- Cog 3 (Bottom Left) -->
            <svg class="bg-cog bg-cog-3 absolute pointer-events-none text-[#eba13d]/5" style="width: 420px; height: 420px; left: -120px; bottom: 12%;" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.2">
                <circle cx="100" cy="100" r="90" stroke-dasharray="4, 4" stroke-width="3" />
                <circle cx="100" cy="100" r="85" />
                <line x1="100" y1="15" x2="100" y2="185" />
                <line x1="15" y1="100" x2="185" y2="100" />
                <line x1="40" y1="40" x2="160" y2="160" />
                <line x1="40" y1="160" x2="160" y2="40" />
                <circle cx="100" cy="100" r="60" />
                <circle cx="100" cy="100" r="40" />
                <circle cx="100" cy="100" r="20" />
                <circle cx="100" cy="100" r="8" fill="#eba13d" />
            </svg>

            <!-- Floating Stencil 1: Coffee Cup -->
            <svg class="floating-stencil absolute text-[#eba13d]/10 pointer-events-none" style="width: 80px; height: 80px; left: 10%; top: 25%;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M18 8h1a4 4 0 0 1 0 8h-1" />
                <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
                <line x1="6" y1="2" x2="6" y2="4" stroke-linecap="round" />
                <line x1="10" y1="2" x2="10" y2="4" stroke-linecap="round" />
                <line x1="14" y1="2" x2="14" y2="4" stroke-linecap="round" />
            </svg>

            <!-- Floating Stencil 2: Bicycle -->
            <svg class="floating-stencil absolute text-[#eba13d]/10 pointer-events-none" style="width: 110px; height: 110px; right: 12%; top: 55%;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="5.5" cy="17.5" r="3.5" />
                <circle cx="18.5" cy="17.5" r="3.5" />
                <path d="M15 17.5L12 9l-4 6.5h7" />
                <path d="M8 12h8" />
                <path d="M18.5 14L15 9h-4.5" />
                <path d="M7 6h3.5l1.5 3" />
            </svg>

            <!-- Floating Stencil 3: Recovery Noodle Bowl -->
            <svg class="floating-stencil absolute text-[#eba13d]/10 pointer-events-none" style="width: 90px; height: 90px; left: 8%; bottom: 20%;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M22 12c0 5.5-4.5 10-10 10S2 17.5 2 12h20z" />
                <path d="M12 2v10M8 2v10M16 2v10" />
                <path d="M6 14h12" />
            </svg>
        </div>

        <!-- Winding Marching Cyclist Route Path (Dashed) -->
        <svg class="absolute right-[6%] md:right-[8%] top-[15%] bottom-[15%] w-[80px] pointer-events-none opacity-25 z-10 hidden sm:block" preserveAspectRatio="none" viewBox="0 0 80 1200">
            <path id="route-path" d="M 40,0 Q 10,150 40,300 T 70,600 T 40,900 T 10,1050 T 40,1200" fill="none" stroke="#eba13d" stroke-width="2" stroke-dasharray="6, 8" />
        </svg>

        <!-- Cyclist Rider Follower -->
        <div id="cyclist-rider" class="absolute right-[6%] md:right-[8%] z-15 pointer-events-none hidden sm:flex items-center justify-center w-10 h-10" style="top: 15%;">
            <svg class="w-8 h-8 text-[#eba13d]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="5.5" cy="17.5" r="3" />
                <circle cx="18.5" cy="17.5" r="3" />
                <path d="M15 17.5L12 9l-4 6.5h7" />
                <path d="M8 12h8" />
                <path d="M18.5 14L15 9h-4.5" />
                <path d="M7 6h3.5l1.5 3" />
            </svg>
        </div>

        <!-- Interactive Rotating Gold Booking Badge (Decal) -->
        <div id="booking-badge" class="absolute hidden md:block z-20 cursor-pointer pointer-events-auto select-none" style="right: 18%; top: 220px; width: 130px; height: 130px;">
            <svg class="w-full h-full" viewBox="0 0 100 100">
                <path id="badgeTextPath" d="M 12 50 A 38 38 0 1 1 88 50 A 38 38 0 1 1 12 50" fill="none" />
                <circle cx="50" cy="50" r="45" fill="none" stroke="#eba13d" stroke-width="1.2" stroke-dasharray="2 3" />
                <circle cx="50" cy="50" r="32" fill="#b42638" stroke="#eba13d" stroke-width="1.5" />
                <text font-family="monospace" font-size="6.3" font-weight="bold" fill="#eba13d">
                    <textPath href="#badgeTextPath" startOffset="0%" spacing="auto">
                        • CRANKHAUS • SECURE RESERVATION • JAKARTA
                    </textPath>
                </text>
                <text x="50" y="56" font-family="sans-serif" font-weight="900" font-size="18" fill="#eba13d" text-anchor="middle" style="font-family: 'Cooper Black', sans-serif;">CH</text>
            </svg>
        </div>

        {{-- ── TITLE / HERO SECTION (Centered, Tall, Airy, Premium) ── --}}
        <section class="w-full min-h-screen flex flex-col items-center justify-center px-6 text-center relative z-10 bg-[#235c47]">
            <div class="w-full max-w-screen-xl mx-auto flex flex-col items-center justify-center">
                <!-- Decorative Badge -->
                <div class="mb-6 font-mono text-xs uppercase tracking-[0.35em] text-[#eba13d] font-bold border border-[#eba13d]/30 px-4 py-1.5 rounded-full bg-[#eba13d]/5">
                    Crankhaus Jakarta
                </div>
                <h1 class="font-display font-black text-[#eba13d] uppercase leading-[0.9] select-none"
                    id="reserve-title"
                    style="font-size: clamp(3.2rem, 7vw, 6.8rem); letter-spacing: -0.01em;">
                    RESERVE<br>YOUR SEAT
                </h1>
                <!-- Go back link directly in the hero for convenience and navigation context -->
                <a href="/?nobumper=1" class="mt-10 font-mono text-xs uppercase tracking-[0.2em] text-[#efe1d9]/50 hover:text-[#eba13d] transition-colors border-b border-[#efe1d9]/20 hover:border-[#eba13d] pb-1">
                    ← Back to Homepage
                </a>
            </div>
        </section>

        {{-- ── HOW IT WORKS SECTION (Airy Spacing & Connectors) ── --}}
        <section class="w-full min-h-screen flex flex-col items-center justify-center py-20 px-6 text-center gsap-3d-reveal bg-[#b42638] relative z-10">
            <div class="w-full max-w-screen-xl mx-auto flex flex-col items-center text-center">
                <span class="font-mono text-xs uppercase tracking-[0.25em] text-[#eba13d] font-bold block mb-4">How it works</span>
                <h2 class="font-display font-black text-[#eba13d] uppercase leading-none mb-20"
                    style="font-size: clamp(2.2rem, 4.5vw, 3.8rem); text-align: center; letter-spacing: 0.02em;">
                    YOUR TABLE AWAITS
                </h2>
                
                {{-- Steps Container with wide spacing --}}
                <div class="flex flex-col md:flex-row gap-12 md:gap-4 items-stretch justify-center w-full max-w-3xl">
                    @foreach(['Fill in the form', 'Confirmed within 2 hours', 'Arrive & reload'] as $i => $step)
                    <div class="flex flex-col items-center text-center flex-1 relative px-4">
                        {{-- Numeric badge with double outline retro style --}}
                        <div class="w-16 h-16 rounded-full flex items-center justify-center font-display font-black text-xl mb-6 shadow-[4px_4px_0px_0px_#020b0a] border-[3px] border-[#020b0a] transition-transform hover:scale-110 duration-200"
                             style="background: {{ ['#eba13d', '#ffffff', '#020b0a'][$i] }}; color: {{ ['#020b0a', '#b42638', '#eba13d'][$i] }};">
                            {{ $i + 1 }}
                        </div>
                        <span class="font-display text-sm text-[#efe1d9] uppercase tracking-wider font-extrabold max-w-[200px] leading-snug">{{ $step }}</span>
                        
                        {{-- Desktop connector line/arrow --}}
                        @if($i < 2)
                        <div class="hidden md:block absolute top-8 left-[calc(50%+45px)] w-[calc(100%-90px)] h-[2px] border-t-2 border-dashed border-[#eba13d]/40 pointer-events-none"></div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ── FORM CONTAINER (Centered, Max-Width, Milk-white layer) ── --}}
        <section class="w-full min-h-screen flex flex-col items-center justify-center py-24 px-6 gsap-3d-reveal bg-[#fbf9f6] text-[#020b0a] bg-milk-white-form relative z-10">
            <div class="w-full max-w-3xl mx-auto">
                @livewire('reservation-form')
            </div>
        </section>

        {{-- ── SELECT YOUR EXPERIENCE / PACKS (Minimalist Redesign, Bottom) ── --}}
        <section class="w-full min-h-screen flex flex-col items-center justify-center py-20 px-6 text-center gsap-3d-reveal bg-[#235c47] relative z-10">
            <div class="w-full max-w-screen-xl mx-auto flex flex-col items-center text-center">
                <!-- Center Loop Icon -->
                <div class="mb-5 text-[#eba13d] opacity-50">
                    <svg class="w-10 h-10 mx-auto animate-spin-slow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" stroke-dasharray="3,3" />
                        <circle cx="12" cy="12" r="6" />
                        <path d="M12 2v20M2 12h20" />
                    </svg>
                </div>
                <h3 class="font-display font-black text-[#efe1d9] uppercase leading-tight mb-16"
                    style="font-size: clamp(2rem, 4.2vw, 3.4rem); text-align: center; letter-spacing: 0.02em;">
                    A pack for every team<br>and every occasion.
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full justify-center items-stretch mt-4 max-w-4xl">
                    <!-- Pack 1: Solo Breakaway -->
                    <div class="peloton-pack-card cursor-pointer flex flex-col justify-between text-center p-8 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-md text-white shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group"
                         data-guests="2">
                        
                        <div class="flex flex-col items-center">
                            <span class="font-mono text-[9px] uppercase tracking-[0.2em] text-[#efe1d9]/40 mb-3 block">1 - 2 RIDERS</span>
                            <h4 class="font-display font-black uppercase text-[#eba13d] leading-none mb-2" style="font-size: 1.6rem; letter-spacing: 0.02em;">
                                Solo Breakaway
                            </h4>
                            <p class="font-mono text-[10px] text-[#efe1d9]/60 uppercase tracking-widest mb-6">
                                Refuel &amp; Recharge
                            </p>
                            <p class="font-mono text-[11px] text-white/50 leading-relaxed max-w-[200px] mb-4">
                                For single riders and duos.
                            </p>
                        </div>

                        <div class="mt-4">
                            <div class="select-pack-btn w-full py-2.5 px-4 rounded-xl border border-white/20 bg-transparent text-center font-display font-black text-xs uppercase tracking-wider text-[#eba13d] group-hover:bg-[#eba13d] group-hover:text-[#020b0a] group-hover:border-transparent transition-all duration-200">
                                Select Pack
                            </div>
                        </div>
                    </div>

                    <!-- Pack 2: Peloton Crew -->
                    <div class="peloton-pack-card cursor-pointer flex flex-col justify-between text-center p-8 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-md text-white shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group"
                         data-guests="4">
                        
                        <div class="flex flex-col items-center">
                            <span class="font-mono text-[9px] uppercase tracking-[0.2em] text-[#efe1d9]/40 mb-3 block">3 - 6 RIDERS</span>
                            <h4 class="font-display font-black uppercase text-[#eba13d] leading-none mb-2" style="font-size: 1.6rem; letter-spacing: 0.02em;">
                                Peloton Crew
                            </h4>
                            <p class="font-mono text-[10px] text-[#efe1d9]/60 uppercase tracking-widest mb-6">
                                Group Debriefs
                            </p>
                            <p class="font-mono text-[11px] text-white/50 leading-relaxed max-w-[200px] mb-4">
                                For teams of 3 to 6.
                            </p>
                        </div>

                        <div class="mt-4">
                            <div class="select-pack-btn w-full py-2.5 px-4 rounded-xl border border-white/20 bg-transparent text-center font-display font-black text-xs uppercase tracking-wider text-[#eba13d] group-hover:bg-[#eba13d] group-hover:text-[#020b0a] group-hover:border-transparent transition-all duration-200">
                                Select Pack
                            </div>
                        </div>
                    </div>

                    <!-- Pack 3: The Grand Tour -->
                    <div class="peloton-pack-card cursor-pointer flex flex-col justify-between text-center p-8 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-md text-white shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group"
                         data-guests="15">
                        
                        <div class="flex flex-col items-center">
                            <span class="font-mono text-[9px] uppercase tracking-[0.2em] text-[#efe1d9]/40 mb-3 block">7+ RIDERS</span>
                            <h4 class="font-display font-black uppercase text-[#eba13d] leading-none mb-2" style="font-size: 1.6rem; letter-spacing: 0.02em;">
                                The Grand Tour
                            </h4>
                            <p class="font-mono text-[10px] text-[#efe1d9]/60 uppercase tracking-widest mb-6">
                                VIP Lounge &amp; Events
                            </p>
                            <p class="font-mono text-[11px] text-white/50 leading-relaxed max-w-[200px] mb-4">
                                For clubs of 7 or more.
                            </p>
                        </div>

                        <div class="mt-4">
                            <div class="select-pack-btn w-full py-2.5 px-4 rounded-xl border border-white/20 bg-transparent text-center font-display font-black text-xs uppercase tracking-wider text-[#eba13d] group-hover:bg-[#eba13d] group-hover:text-[#020b0a] group-hover:border-transparent transition-all duration-200">
                                Select Pack
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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



        // Hero title line reveal
        var titleEl = document.getElementById('reserve-title');
        if (titleEl && window.gsap) {
            var lines = titleEl.innerHTML.split('<br>');
            titleEl.innerHTML = '';
            lines.forEach(function (line, i) {
                var wrap = document.createElement('div');
                wrap.style.cssText = 'overflow:hidden; display:block;';
                var inner = document.createElement('span');
                inner.style.cssText = 'display:block; opacity:0; transform:translateY(110%);';
                inner.innerHTML = line;
                wrap.appendChild(inner);
                titleEl.appendChild(wrap);
                gsap.to(inner, { opacity: 1, y: 0, duration: 1.0, ease: 'power4.out', delay: 0.2 + i * 0.15 });
            });
        }

        // ── Scroll Trigger 3D reveals ──
        if (window.gsap && window.ScrollTrigger) {
            // Apply 3D Scroll Reveal to elements with class .gsap-3d-reveal
            document.querySelectorAll('.gsap-3d-reveal').forEach(function (el) {
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

        // ── Background Cog Rotation & Parallax Float animations ──
        if (window.gsap && window.ScrollTrigger) {
            // Rotate Cogs on Scroll
            gsap.to('.bg-cog-1', {
                rotation: 360,
                ease: 'none',
                scrollTrigger: {
                    trigger: 'body',
                    start: 'top top',
                    end: 'bottom bottom',
                    scrub: 0.8
                }
            });
            gsap.to('.bg-cog-2', {
                rotation: -360,
                ease: 'none',
                scrollTrigger: {
                    trigger: 'body',
                    start: 'top top',
                    end: 'bottom bottom',
                    scrub: 1.2
                }
            });
            gsap.to('.bg-cog-3', {
                rotation: 270,
                ease: 'none',
                scrollTrigger: {
                    trigger: 'body',
                    start: 'top top',
                    end: 'bottom bottom',
                    scrub: 1.0
                }
            });

            // Parallax shift for floating stencils on scroll
            document.querySelectorAll('.floating-stencil').forEach(function (el, i) {
                var speed = 60 + i * 30;
                gsap.to(el, {
                    y: -speed,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: 'body',
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: true
                    }
                });
            });

            // Gentle continuous floating motion
            if (window.initContinuousFloat) {
                window.initContinuousFloat('.floating-stencil', { y: 20, duration: 4.0 });
            }
        }

        // ── Interactive Gold Stamp Badge ──
        var badge = document.getElementById('booking-badge');
        if (badge && window.gsap) {
            // Continuous slow rotation
            gsap.to("#booking-badge svg", {
                rotation: 360,
                repeat: -1,
                duration: 20,
                ease: "none"
            });

            // Scroll rotation speed-up
            gsap.to(badge, {
                rotation: 360,
                ease: "none",
                scrollTrigger: {
                    trigger: "body",
                    start: "top top",
                    end: "bottom bottom",
                    scrub: 0.5
                }
            });

            // Magnetic 3D tilt
            badge.addEventListener('mousemove', function (e) {
                var rect = badge.getBoundingClientRect();
                var x = e.clientX - rect.left - rect.width / 2;
                var y = e.clientY - rect.top - rect.height / 2;
                gsap.to(badge, {
                    x: x * 0.35,
                    y: y * 0.35,
                    rotationX: -y * 0.25,
                    rotationY: x * 0.25,
                    transformPerspective: 800,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            badge.addEventListener('mouseleave', function () {
                gsap.to(badge, {
                    x: 0,
                    y: 0,
                    rotationX: 0,
                    rotationY: 0,
                    duration: 0.75,
                    ease: 'elastic.out(1.1, 0.4)'
                });
            });
        }

        // ── Topography Parallax Shifting ──
        if (window.gsap && window.ScrollTrigger) {
            gsap.fromTo('.topo-layer', 
                { y: 30 },
                {
                    y: -80,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: 'body',
                        start: 'top top',
                        end: 'bottom bottom',
                        scrub: 0.6
                    }
                }
            );
        }

        // ── Winding Cyclist Path Follower (GSAP MotionPath) ──
        if (window.gsap && window.ScrollTrigger && document.getElementById('route-path') && document.getElementById('cyclist-rider')) {
            gsap.to("#cyclist-rider", {
                scrollTrigger: {
                    trigger: "main",
                    start: "top top",
                    end: "bottom bottom",
                    scrub: 0.8
                },
                motionPath: {
                    path: "#route-path",
                    align: "#route-path",
                    alignOrigin: [0.5, 0.5],
                    autoRotate: 90
                },
                ease: "none"
            });
        }

        // ── Peloton Experience Cards Logic ──
        if (window.initDecayHover) {
            window.initDecayHover('.peloton-pack-card', 8);
        }
        
        document.querySelectorAll('.peloton-pack-card').forEach(function(card) {
            card.addEventListener('click', function() {
                var targetSize = card.getAttribute('data-guests');
                var buttons = document.querySelectorAll('.party-btn');
                var targetButton = null;
                
                buttons.forEach(function(btn) {
                    var btnText = btn.textContent.trim();
                    if (targetSize === '15' && btnText.includes('10+')) {
                        targetButton = btn;
                    } else if (btnText === targetSize) {
                        targetButton = btn;
                    }
                });
                
                if (targetButton) {
                    // Click target button to trigger Livewire update
                    targetButton.click();
                    
                    // Active outline card update
                    document.querySelectorAll('.peloton-pack-card').forEach(function(c) {
                        c.classList.remove('selected-pack-active');
                        c.style.borderColor = '';
                        c.style.boxShadow = '';
                    });
                    
                    card.classList.add('selected-pack-active');
                    
                    // Staggered scroll down to the rest of the inputs
                    var formRoot = document.getElementById('reservation-form-root');
                    if (formRoot) {
                        var headerOffset = 140;
                        var elementPosition = formRoot.getBoundingClientRect().top;
                        var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

    });
    </script>

</body>
</html>
