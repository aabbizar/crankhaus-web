<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Crankhaus is Jakarta's premier cyclist café — recovery noodles, bold espresso, and a secure indoor bike vault. Book your table online.">
    <title>CRANKHAUS — Eat. Drink. Ride. Jakarta</title>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>
<body class="bg-[#020b0a] text-[#efe1d9] overflow-x-hidden">
    @include('components.smooth-site')
    <x-global-engine />
    <div class="film-grain"></div>

    {{-- ── FIXED HEADER ── --}}
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
                        <a href="/#events" class="font-display font-black text-[#eba13d] uppercase leading-none hover:text-white transition-colors"
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

    {{-- ─────────────────────────────────────────────
         HERO — VIDEO BACKGROUND (Lucky Folks style)
    ───────────────────────────────────────────── --}}
    <section class="relative w-full overflow-hidden" id="hero-section"
             style="height: 100vh; min-height: 600px;">

        {{-- Background Video Loop --}}
        <div class="absolute inset-0 z-0 overflow-hidden" style="background: #020b0a;">
            <video src="{{ asset('images/202004-916894674_small.mp4') }}" class="w-full h-full object-cover" id="hero-bg-video" autoplay loop muted playsinline style="opacity: 0.85; transform: scale(1.05); will-change: transform;"></video>
            {{-- Dark overlay --}}
            <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.3));"></div>
        </div>

        {{-- Hero Content — Centered --}}
        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-6">
            <div class="w-full max-w-5xl mx-auto flex flex-col items-center justify-center">

                {{-- EAT. DRINK. RIDE. — Bold Barlow Condensed --}}
                <h1 class="font-display font-black text-[#eba13d] uppercase flex flex-col items-center justify-center select-none"
                    id="hero-main-title"
                    style="font-size: clamp(3.15rem, 9.1vw, 7.7rem); line-height: 0.88; letter-spacing: 0.01em; margin-bottom: 1.5rem;">
                    <span class="block">EAT.</span>
                    <span class="block">DRINK.</span>
                    <span class="block">RIDE.</span>
                </h1>

                <p class="font-mono font-bold uppercase text-[#eba13d]/70"
                   style="font-size: clamp(0.6rem, 1.4vw, 0.85rem); letter-spacing: 0.2em;">
                    The Cyclist Café &nbsp;·&nbsp; Jakarta
                </p>
            </div>
        </div>
    </section>

    <main class="w-full">

        {{-- ── RED TYPOGRAPHY SECTION ── --}}
        <section class="w-full relative flex justify-center min-h-screen items-center" style="background: #b42638;" id="about-section">
            <div class="w-full max-w-[1600px] flex flex-col lg:flex-row items-center">

                {{-- Left: Massive Typography --}}
                <div class="lg:w-[55%] gsap-3d-reveal" style="padding: clamp(4rem, 8vw, 8rem); padding-right: clamp(1.5rem, 3vw, 3rem);">
                    <h2 class="font-display font-black text-[#eba13d] uppercase leading-[0.95]"
                        style="font-size: clamp(2.5rem, 5.5vw, 5.5rem); letter-spacing: 0.01em;">
                        CRANKHAUS IS A<br>
                        PREMIUM CYCLIST CAFÉ,<br>
                        DESIGNED TO FUEL<br>
                        YOUR NEXT RIDE.
                    </h2>
                </div>

                {{-- Right: Text Description — ALL YELLOW (as requested) --}}
                <div class="lg:w-[45%] flex flex-col justify-center gsap-3d-reveal" style="padding: clamp(4rem, 8vw, 8rem); padding-left: clamp(1.5rem, 3vw, 3rem); padding-top: clamp(2rem, 8vw, 8rem);">
                    <p class="font-sans text-[#eba13d] leading-relaxed text-sm md:text-base lg:text-lg mb-6 font-bold tracking-wide">
                        CRANKHAUS is a cycling hub inspired by the spirit of the peloton!
                    </p>
                    <p class="font-sans text-[#eba13d] leading-relaxed text-sm md:text-base lg:text-lg mb-6 font-bold tracking-wide">
                        Located in the heart of Jakarta, this original living space blends homemade Asian cuisine, a warm atmosphere, and a dedicated indoor vault to secure your bike.
                    </p>
                    <p class="font-sans text-[#eba13d] leading-relaxed text-sm md:text-base lg:text-lg mb-6 font-bold tracking-wide">
                        Recovery noodles, bold espresso, mechanical aid, or just a quiet place to analyze your Strava data... there is something for every rider!
                    </p>
                    <p class="font-sans text-[#eba13d] leading-relaxed text-sm md:text-base lg:text-lg font-bold tracking-wide">
                        On the kitchen side, generosity is key: homemade dishes, fresh ingredients, and a gourmet menu prepared by our passionate team.
                    </p>
                </div>
            </div>
        </section>

        {{-- ── LIFESTYLE IMAGE SECTION WITH MARQUEE ── --}}
        <section class="w-full relative flex justify-center items-center overflow-hidden h-[80vh] md:h-[100vh]" style="background: #b42638;" id="marquee-section">
            <!-- Added padding to prevent the image from being "full banget" (edge-to-edge) -->
            <div class="absolute inset-0 z-0 w-full h-full p-4 md:p-8 lg:p-12">
                <img src="{{ asset('images/fred-moon-0yqa0rMCsYk-unsplash.jpg') }}" alt="Crankhaus Life" class="w-full h-full object-cover rounded-[14px]">
                <!-- Subtle dark gradient overlay inside the image frame -->
                <div class="absolute inset-4 md:inset-8 lg:inset-12 bg-black/20 rounded-[14px]"></div>
            </div>
            
            {{-- Scroll-driven marquee: rows move horizontally as you scroll --}}
            <div class="relative z-10 w-full flex flex-col justify-center pointer-events-none" style="transform: rotate(-2deg) scale(1.12);">
                {{-- Row 1: scrolls LEFT --}}
                <div class="whitespace-nowrap overflow-hidden">
                    <h2 id="mq-row-1" class="font-display font-black uppercase text-[#eba13d] leading-[0.85] inline-block will-change-transform"
                        style="font-size: clamp(5rem, 14vw, 16rem); letter-spacing: -0.02em; transform: translateX(0);">
                        EAT DRINK AND SHARE &nbsp;·&nbsp; EAT DRINK AND SHARE &nbsp;·&nbsp; EAT DRINK AND SHARE &nbsp;·&nbsp; EAT DRINK AND SHARE &nbsp;·&nbsp;
                    </h2>
                </div>
                {{-- Row 2: scrolls RIGHT --}}
                <div class="whitespace-nowrap overflow-hidden -ml-[15vw]">
                    <h2 id="mq-row-2" class="font-display font-black uppercase text-[#eba13d] leading-[0.85] inline-block will-change-transform"
                        style="font-size: clamp(5rem, 14vw, 16rem); letter-spacing: -0.02em; transform: translateX(-120px);">
                        FUEL YOUR NEXT RIDE &nbsp;·&nbsp; FUEL YOUR NEXT RIDE &nbsp;·&nbsp; FUEL YOUR NEXT RIDE &nbsp;·&nbsp; FUEL YOUR NEXT RIDE &nbsp;·&nbsp;
                    </h2>
                </div>
                {{-- Row 3: scrolls LEFT --}}
                <div class="whitespace-nowrap overflow-hidden -ml-[5vw]">
                    <h2 id="mq-row-3" class="font-display font-black uppercase text-[#eba13d] leading-[0.85] inline-block will-change-transform"
                        style="font-size: clamp(5rem, 14vw, 16rem); letter-spacing: -0.02em; transform: translateX(-60px);">
                        PREMIUM CYCLIST CAFE &nbsp;·&nbsp; PREMIUM CYCLIST CAFE &nbsp;·&nbsp; PREMIUM CYCLIST CAFE &nbsp;·&nbsp; PREMIUM CYCLIST CAFE &nbsp;·&nbsp;
                    </h2>
                </div>
            </div>
        </section>

        {{-- ── SIGNATURE HOVER REVEAL SECTION ── --}}
        <section class="relative w-full min-h-[125vh] px-6 flex flex-col items-center justify-center py-28 md:py-36 lg:py-44 overflow-hidden"
                 style="background: #efe1d9;" id="signature-reveal-section">
            
            {{-- Floating Images Containers (Absolute at top-0 left-0 to allow GSAP mouse follow) ── --}}
            <div class="absolute inset-0 pointer-events-none z-0">
                <!-- Noodle Image -->
                <div id="hover-img-noodle" class="absolute top-0 left-0 w-[180px] md:w-[230px] lg:w-[280px] aspect-[3/4] rounded-none opacity-0 scale-95 pointer-events-none z-0" style="will-change: transform, opacity;">
                    <img src="{{ asset('images/mie_fixie_gear.png') }}" alt="Mie Fixie Gear" class="w-full h-full object-cover shadow-lg">
                </div>
                <!-- Espresso Image -->
                <div id="hover-img-espresso" class="absolute top-0 left-0 w-[180px] md:w-[230px] lg:w-[280px] aspect-[3/4] rounded-none opacity-0 scale-95 pointer-events-none z-0" style="will-change: transform, opacity;">
                    <img src="{{ asset('images/cadence_booster.png') }}" alt="Cadence Booster" class="w-full h-full object-cover shadow-lg">
                </div>
                <!-- Dimsum Image -->
                <div id="hover-img-dimsum" class="absolute top-0 left-0 w-[180px] md:w-[230px] lg:w-[280px] aspect-[3/4] rounded-none opacity-0 scale-95 pointer-events-none z-0" style="will-change: transform, opacity;">
                    <img src="{{ asset('images/signature_dimsum.png') }}" alt="Signature Dimsum" class="w-full h-full object-cover shadow-lg">
                </div>
            </div>

            <!-- Top Logo Icon (Swapped: ATAS CRANK, enlarged) -->
            <div class="relative z-10 gsap-3d-reveal flex justify-center mb-8 md:mb-10 lg:mb-12">
                <img src="{{ asset('images/BAWAH CRANK.png') }}" alt="Crank Top" class="h-15 md:h-18 lg:h-22 w-auto object-contain">
            </div>

            {{-- Centered Text Block --}}
            <div class="relative z-10 w-full max-w-screen-2xl mx-auto px-4 md:px-8 text-center flex flex-col items-center justify-center gsap-3d-reveal">
                <h2 class="font-display font-black text-[#eba13d] uppercase leading-[1.1] select-none text-center max-w-4xl"
                    style="font-size: clamp(2.2rem, 5vw, 4.8rem); letter-spacing: 0.01em;">
                    A PREMIUM CYCLIST SPACE TO 
                    <span class="hover-word cursor-pointer text-[#eba13d] hover:text-white transition-colors duration-300 underline decoration-[#eba13d] hover:decoration-white underline-offset-[8px]" data-target="noodle">EAT</span>, 
                    <span class="hover-word cursor-pointer text-[#eba13d] hover:text-white transition-colors duration-300 underline decoration-[#eba13d] hover:decoration-white underline-offset-[8px]" data-target="espresso">DRINK</span>, 
                    AND 
                    <span class="hover-word cursor-pointer text-[#eba13d] hover:text-white transition-colors duration-300 underline decoration-[#eba13d] hover:decoration-white underline-offset-[8px]" data-target="dimsum">RECOVER</span>. <br>
                    FUEL YOUR RIDE.
                </h2>
            </div>

            <!-- Bottom Logo Icon (Swapped: BAWAH CRANK, enlarged) -->
            <div class="relative z-10 gsap-3d-reveal flex justify-center mt-8 md:mt-10 lg:mt-12">
                <img src="{{ asset('images/ATAS CRANK.png') }}" alt="Crank Bottom" class="h-15 md:h-18 lg:h-22 w-auto object-contain">
            </div>
        </section>

        {{-- ── SPLIT-SCREEN INTERACTIVE SECTION (Lucky Folks Gambar 5 Style) ── --}}
        <div class="w-full" style="background: #efe1d9;">
            <section class="split-panel-section max-w-screen-2xl mx-auto w-full" id="split-section">

            {{-- Left Panel: MENU --}}
            <a href="/menu" class="sp-panel sp-left relative overflow-hidden" id="sp-left">
                <div class="sp-bg-img absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('/images/split_menu.png'); opacity: 0; transform: scale(1.05); pointer-events: none;"></div>
                <span class="sp-number z-10" style="color: #b42638;">I</span>
                <div class="sp-content relative z-10">
                    <p class="sp-script-reveal" style="color: #b42638;">The perfect spot for</p>
                    <span class="sp-title" style="color: #b42638;">MENU.</span>
                    <p class="sp-desc" style="color: #b42638;">Asian cuisine &nbsp;·&nbsp; Bold espresso &nbsp;·&nbsp; Recovery noodles</p>
                </div>
                <div class="sp-arrow z-10" style="background: #b42638; color: #eba13d;">→</div>
            </a>

            {{-- Right Panel: RESERVE --}}
            <a href="/reserve" class="sp-panel sp-right relative overflow-hidden" id="sp-right">
                <div class="sp-bg-img absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('/images/split_reserve.png'); opacity: 0; transform: scale(1.05); pointer-events: none;"></div>
                <span class="sp-number z-10" style="color: #235c47;">II</span>
                <div class="sp-content relative z-10">
                    <p class="sp-script-reveal" style="color: #235c47;">Reserve your seat</p>
                    <span class="sp-title" style="color: #235c47;">RESERVE.</span>
                    <p class="sp-desc" style="color: #235c47;">Secure bike vault &nbsp;·&nbsp; Indoor dining &nbsp;·&nbsp; Jakarta</p>
                </div>
                <div class="sp-arrow z-10" style="background: #235c47; color: #d4cdcdff;">→</div>
            </a>
            </section>
        </div>

        {{-- ── EVENTS LIST ── --}}
        @if(isset($events) && $events->count() > 0)
        <section class="w-full min-h-screen flex flex-col justify-center py-12 md:py-24" style="background: #235c47; border-top: 2px solid #eba13d;" id="events">
            <div class="max-w-screen-2xl mx-auto w-full grid grid-cols-1 lg:grid-cols-12 gap-0 px-4 md:px-8">

                {{-- Left Header (1/3 Width) --}}
                <div class="lg:col-span-4 flex flex-col justify-center" style="padding: clamp(2rem, 4vw, 4rem); border-right: 2px solid rgba(235,161,61,0.4);">
                    <span class="font-sans text-[10px] uppercase tracking-widest text-[#eba13d] font-bold block mb-2">Upcoming</span>
                    <h2 class="font-display font-black uppercase leading-[0.9] text-[#eba13d]"
                        style="font-size: clamp(3rem, 6vw, 4.5rem);">
                        RIDES &amp;<br>EVENTS
                    </h2>
                </div>

                {{-- Right List (2/3 Width) --}}
                <div class="lg:col-span-8 flex flex-col">
                    @foreach($events as $event)
                    <div class="w-full flex flex-col md:flex-row gap-8 hover:bg-[#eba13d]/5 transition-colors duration-300"
                         style="border-bottom: 1px solid rgba(235,161,61,0.25); padding: clamp(2rem, 4vw, 4rem);">

                        <div class="md:w-1/4 pt-1">
                            <div class="font-sans text-[12px] uppercase tracking-widest text-[#eba13d] font-bold">
                                {{ isset($event->date) ? \Carbon\Carbon::parse($event->date)->format('d M Y') : 'Upcoming' }}
                            </div>
                        </div>

                        <div class="md:w-3/4">
                            <h3 class="font-display font-black text-2xl md:text-3xl uppercase text-white mb-3 leading-none">
                                {{ $event->name ?? $event->title ?? 'Event' }}
                            </h3>
                            @if($event->description ?? false)
                            <p class="font-sans text-[13px] text-white/90 leading-relaxed font-bold max-w-2xl">
                                {{ $event->description }}
                            </p>
                            @endif
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ── RESERVATION CTA (Gambar 1 style) ── --}}
        <section class="w-full flex flex-col items-center justify-center min-h-screen"
                 style="background: #b42638; padding-top: 8vh; padding-bottom: 8vh;" id="reservations">
            <div class="w-full max-w-screen-2xl mx-auto px-4 md:px-8 text-center flex flex-col items-center justify-center">

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

                <a href="/faq" class="faq-transition-link font-display font-black text-white hover:text-white/80 uppercase tracking-widest text-[11px] md:text-[13px] border-b-2 border-white/40 hover:border-white transition-all pb-1" style="letter-spacing: 0.05em;">
                    A QUESTION ? CONSULT THE FAQ !
                </a>
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
        var welcomeInitId = setInterval(function() {
            if (window.gsap && window.ScrollTrigger) {
                clearInterval(welcomeInitId);
                initWelcomePage();
            }
        }, 50);

        function initWelcomePage() {
            gsap.registerPlugin(ScrollTrigger);

            var overlay = document.getElementById('menu-overlay');
            var panel = document.getElementById('menu-panel');
            var toggleBtn = document.getElementById('menu-toggle-btn');
            var closeBtn = document.getElementById('menu-close-btn');
            var backdrop = document.getElementById('menu-backdrop');
            var eventsLink = document.getElementById('menu-events-link');

            function openMenu() {
                overlay.classList.remove('pointer-events-none');
                toggleBtn.classList.add('menu-active');
                gsap.to(overlay, {
                    opacity: 1,
                    duration: 0.35,
                    ease: 'power2.out'
                });
                gsap.to(panel, {
                    x: '0%',
                    duration: 0.55,
                    ease: 'power3.out'
                });
            }

            function closeMenu() {
                toggleBtn.classList.remove('menu-active');
                gsap.to(panel, {
                    x: '100%',
                    duration: 0.45,
                    ease: 'power3.in'
                });
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

            // No bumper here, just play hero animations
            playHeroAnimations();
            function playHeroAnimations() {
                var titleEl = document.getElementById('hero-main-title');
                if (titleEl) {
                    var spans = titleEl.querySelectorAll('span');
                    gsap.fromTo(spans,
                        { opacity: 0, y: 70 },
                        { opacity: 1, y: 0, duration: 1.1, ease: 'power4.out', stagger: 0.18, delay: 0.1 }
                    );
                }
                // Hero Cinematic Image Ken Burns effect
                if (document.getElementById('hero-bg-img')) {
                    gsap.to('#hero-bg-img', {
                        scale: 1.15,
                        duration: 25,
                        ease: 'none',
                        repeat: -1,
                        yoyo: true
                    });
                }
            }

            // ── Signature Hover Menu Interactions ──
            var activeImg = null;
            var hoverWords = document.querySelectorAll('.hover-word');
            var signatureSection = document.getElementById('signature-reveal-section');
            var quickToMap = {};
            
            // Get fixed offset from document top to avoid getBoundingClientRect during mousemove
            var sectionOffsetX = 0;
            var sectionOffsetY = 0;

            function updateSectionOffset() {
                if (signatureSection) {
                    var rect = signatureSection.getBoundingClientRect();
                    sectionOffsetX = rect.left + window.scrollX;
                    sectionOffsetY = rect.top + window.scrollY;
                }
            }
            // Update once and on resize
            updateSectionOffset();
            window.addEventListener('resize', updateSectionOffset, { passive: true });
            
            hoverWords.forEach(function(word) {
                var targetId = 'hover-img-' + word.getAttribute('data-target');
                var targetImg = document.getElementById(targetId);
                
                if (targetImg) {
                    quickToMap[targetId] = {
                        x: gsap.quickTo(targetImg, "x", { duration: 0.08, ease: "power1.out" }),
                        y: gsap.quickTo(targetImg, "y", { duration: 0.08, ease: "power1.out" })
                    };
                }
                
                word.addEventListener('mouseenter', function(e) {
                    activeImg = targetImg;
                    gsap.to(word, { color: '#b42638', duration: 0.2, ease: 'power2.out' });
                    
                    if (targetImg) {
                        var x = e.pageX - sectionOffsetX;
                        var y = e.pageY - sectionOffsetY;
                        
                        targetImg.style.willChange = 'transform, opacity, clip-path';
                        
                        var w = targetImg.offsetWidth || 280;
                        var h = targetImg.offsetHeight || 370;
                        
                        gsap.set(targetImg, {
                            x: x - (w / 2),
                            y: y - (h / 2),
                            scale: 0.95
                        });
                        
                        if (quickToMap[targetId]) {
                            quickToMap[targetId].x(x - (w / 2));
                            quickToMap[targetId].y(y - (h / 2));
                        }
                        
                        gsap.fromTo(targetImg,
                            { opacity: 0, scale: 0.8 },
                            { opacity: 0.85, scale: 1.0, duration: 0.5, ease: 'back.out(1.5)', overwrite: 'auto' }
                        );
                    }
                });
                
                word.addEventListener('mouseleave', function() {
                    gsap.to(word, { color: '#eba13d', duration: 0.2, ease: 'power2.out' });
                    if (targetImg) {
                        gsap.to(targetImg, { 
                            opacity: 0, 
                            scale: 0.85, 
                            duration: 0.35, 
                            ease: 'power3.inOut', 
                            overwrite: 'auto',
                            onComplete: function() {
                                targetImg.style.willChange = 'auto';
                            }
                        });
                    }
                    activeImg = null;
                });
            });
            
            if (signatureSection) {
                signatureSection.addEventListener('mousemove', function(e) {
                    if (activeImg) {
                        // Use e.pageX / e.pageY to get document-relative coordinates
                        // This avoids any DOM layout thrashing (getBoundingClientRect)
                        var x = e.pageX - sectionOffsetX;
                        var y = e.pageY - sectionOffsetY;
                        
                        var w = activeImg.offsetWidth || 280;
                        var h = activeImg.offsetHeight || 370;
                        
                        var handlers = quickToMap[activeImg.id];
                        if (handlers) {
                            handlers.x(x - (w / 2));
                            handlers.y(y - (h / 2));
                        }
                    }
                }, { passive: true });
            }
        }

        // ── Split Panel Hover Zoom & Color Interactions ──
        var spLeft = document.getElementById('sp-left');
        var spRight = document.getElementById('sp-right');
        if (spLeft && spRight) {
            [spLeft, spRight].forEach(function(panel) {
                var bgImg = panel.querySelector('.sp-bg-img');
                var isLeft = panel.classList.contains('sp-left');
                var textElements = panel.querySelectorAll('.sp-script-reveal, .sp-title, .sp-desc, .sp-number');
                var arrow = panel.querySelector('.sp-arrow');
                
                if (bgImg) {
                    bgImg.style.willChange = 'transform, opacity';
                    
                    var shiftX = isLeft ? -15 : 15;
                    var baseTextColor = isLeft ? '#b42638' : '#235c47';
                    var arrowBg = isLeft ? '#b42638' : '#235c47';
                    var arrowColor = isLeft ? '#eba13d' : '#ffffff';
                    
                    panel.addEventListener('mouseenter', function() {
                        gsap.to(bgImg, { opacity: 1.0, scale: 1.4, xPercent: shiftX, duration: 0.9, ease: 'power2.out' });
                        gsap.to(textElements, { color: '#ffffff', duration: 0.5, ease: 'power2.out' });
                        if (arrow) {
                            gsap.to(arrow, { backgroundColor: '#ffffff', color: baseTextColor, duration: 0.5, ease: 'power2.out' });
                        }
                    });
                    
                    panel.addEventListener('mouseleave', function() {
                        gsap.to(bgImg, { opacity: 0, scale: 1.05, xPercent: 0, duration: 0.9, ease: 'power2.out' });
                        gsap.to(textElements, { color: baseTextColor, duration: 0.5, ease: 'power2.out' });
                        if (arrow) {
                            gsap.to(arrow, { backgroundColor: arrowBg, color: arrowColor, duration: 0.5, ease: 'power2.out' });
                        }
                    });
                }
            });
        }



        // ── Scroll Trigger 2D reveals (Sticky, No-Zoom Issues) ──
        if (window.gsap && window.ScrollTrigger) {
            document.querySelectorAll('.gsap-3d-reveal').forEach(function(el) {
                gsap.fromTo(el,
                    { 
                        opacity: 0, 
                        y: 40,
                    },
                    {
                        scrollTrigger: {
                            trigger: el,
                            start: 'top 88%',
                            toggleActions: 'play none none none'
                        },
                        opacity: 1,
                        y: 0,
                        duration: 1.0,
                        ease: 'power3.out'
                    }
                );
            });

            gsap.from('#split-section .sp-panel', {
                scrollTrigger: {
                    trigger: '#split-section',
                    start: 'top 75%',
                    toggleActions: 'play none none none'
                },
                opacity: 0,
                y: 50,
                duration: 0.85,
                stagger: 0.2,
                ease: 'power3.out'
            });

            if (document.getElementById('events')) {
                gsap.from('#events .lg\\:w-1\\/3, #events .lg\\:w-2\\/3 > div', {
                    scrollTrigger: {
                        trigger: '#events',
                        start: 'top 80%',
                        toggleActions: 'play none none none'
                    },
                    opacity: 0,
                    y: 40,
                    duration: 0.8,
                    stagger: 0.1,
                    ease: 'power3.out'
                });
            }

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

            // MARQUEE SCROLLTRIGGER — scroll-driven horizontal parallax
            if (document.getElementById('marquee-section')) {
                gsap.to('#mq-row-1', {
                    xPercent: -25,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: '#marquee-section',
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1.2
                    }
                });
                gsap.to('#mq-row-2', {
                    xPercent: 20,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: '#marquee-section',
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1.2
                    }
                });
                gsap.to('#mq-row-3', {
                    xPercent: -18,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: '#marquee-section',
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1.2
                    }
                });
            }
            }
    });
    </script>
</body>
</html>
