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

            // Subtle card tilt on mouse
            var loginCard = document.getElementById('loginCard');
            if (loginCard && window.gsap) {
                gsap.set(loginCard, { transformPerspective: 1000 });
                document.addEventListener('mousemove', function (e) {
                    var rect = loginCard.getBoundingClientRect();
                    var cx = e.clientX - rect.left - rect.width  / 2;
                    var cy = e.clientY - rect.top  - rect.height / 2;
                    var dist = Math.sqrt(cx * cx + cy * cy);
                    if (dist < 500) {
                        gsap.to(loginCard, {
                            rotationY: cx * 0.04, rotationX: -cy * 0.04,
                            duration: 0.5, ease: 'power2.out'
                        });
                    }
                });
                loginCard.addEventListener('mouseleave', function () {
                    gsap.to(loginCard, { rotationY: 0, rotationX: 0, duration: 1, ease: 'elastic.out(1, 0.3)' });
                });
            }
        });
        </script>

        {{-- ── FOOTER (Background Image - Fixed Perfect Size - Brighter Overlay) ── --}}
        <footer style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/footerfix.jpg') }}') center/cover no-repeat; padding: 16px 10px; width: 100%; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: center; align-items: center; position: absolute; bottom: 0;">
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
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transform: scale(1.05);
                transition: transform 12s ease-out;
                filter: brightness(0.75) saturate(1.1);
            }
            .auth-left:hover .auth-left__img { transform: scale(1); }

            /* Gradient overlay — dark-green veil */
            .auth-left__overlay {
                position: absolute;
                inset: 0;
                background:
                    linear-gradient(to right, rgba(2,11,10,0.7) 0%, transparent 60%),
                    linear-gradient(to top, rgba(35,92,71,0.65) 0%, transparent 50%);
                z-index: 1;
            }

            /* Brand copy on left */
            .auth-left__content {
                position: absolute;
                bottom: 60px;
                left: 48px;
                z-index: 2;
                max-width: 440px;
            }

            .auth-left__logo {
                height: 72px;
                width: auto;
                margin-bottom: 28px;
                filter: drop-shadow(0 4px 16px rgba(0,0,0,0.5));
                transition: transform 0.3s ease;
            }
            .auth-left__logo:hover { transform: scale(1.04); }

            .auth-left__tagline {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 900;
                font-size: clamp(2rem, 3.5vw, 3.25rem);
                letter-spacing: 3.6px;
                text-transform: uppercase;
                color: var(--clr-accent);
                line-height: 1.05;
                margin: 0 0 12px 0;
                text-shadow: 0 2px 16px rgba(0,0,0,0.5);
            }

            .auth-left__sub {
                font-family: 'Space Mono', monospace;
                font-size: 0.85rem;
                color: rgba(239,225,217,0.75);
                letter-spacing: 0.08em;
                text-transform: uppercase;
                margin: 0;
            }

            /* Pills row */
            .auth-left__pills {
                display: flex;
                gap: 10px;
                margin-top: 24px;
                flex-wrap: wrap;
            }
            .auth-left__pill {
                font-family: 'Space Mono', monospace;
                font-size: 0.65rem;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: var(--clr-accent);
                border: 1px solid rgba(235,161,61,0.35);
                padding: 5px 14px;
                border-radius: 24px;
                background: rgba(235,161,61,0.06);
                backdrop-filter: blur(4px);
            }

            /* ── RIGHT PANEL: Auth form ── */
            .auth-right {
                width: 100%;
                max-width: 520px;
                min-height: 100vh;
                background: var(--clr-dark);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 60px 48px;
                position: relative;
                z-index: 2;
                border-left: 1px solid rgba(239,225,217,0.08);
            }
            @media (max-width: 1023px) { .auth-right { max-width: 100%; } }
            @media (max-width: 640px) { .auth-right { padding: 48px 24px; } }

            /* Mobile logo */
            .auth-right__mobile-logo {
                display: flex;
                justify-content: center;
                margin-bottom: 48px;
            }
            @media (min-width: 1024px) { .auth-right__mobile-logo { display: none; } }

            .auth-right__mobile-logo img {
                height: 52px;
                width: auto;
            }

            /* Heading */
            .auth-heading {
                width: 100%;
                margin-bottom: 40px;
            }

            .auth-heading__eyebrow {
                font-family: 'Space Mono', monospace;
                font-size: 0.7rem;
                letter-spacing: 0.25em;
                text-transform: uppercase;
                color: var(--clr-accent);
                margin: 0 0 14px 0;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .auth-heading__eyebrow::after {
                content: '';
                flex: 1;
                height: 1px;
                background: rgba(235,161,61,0.3);
            }

            .auth-heading__title {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 900;
                font-size: clamp(1.9rem, 3vw, 2.6rem);
                letter-spacing: -0.01em;
                color: var(--clr-border);
                margin: 0 0 10px 0;
                line-height: 1.1;
            }

            .auth-heading__sub {
                font-family: 'Space Mono', monospace;
                font-size: 0.78rem;
                color: var(--clr-text-muted);
                letter-spacing: 0.04em;
                margin: 0;
            }

            /* ── FORM ── */
            .auth-form {
                width: 100%;
            }

            .auth-form__group {
                position: relative;
                margin-bottom: 20px;
            }

            /* Floating label */
            .auth-form__label {
                position: absolute;
                top: 50%;
                left: 18px;
                transform: translateY(-50%);
                font-family: 'Space Mono', monospace;
                font-size: 0.72rem;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--clr-text-muted);
                pointer-events: none;
                transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
                background: transparent;
                padding: 0 4px;
            }

            .auth-form__input {
                width: 100%;
                background: rgba(239,225,217,0.04);
                border: 1px solid rgba(239,225,217,0.15);
                border-radius: 10px;
                padding: 20px 18px 8px;
                font-family: 'Space Mono', monospace;
                font-size: 0.92rem;
                color: var(--clr-border);
                outline: none;
                transition: border-color 0.3s, box-shadow 0.3s, background 0.3s;
                -webkit-appearance: none;
            }

            .auth-form__input:focus,
            .auth-form__input:not(:placeholder-shown) {
                background: rgba(239,225,217,0.06);
            }

            .auth-form__input:focus {
                border-color: var(--clr-accent);
                box-shadow: 0 0 0 3px rgba(235,161,61,0.15), 0 0 16px rgba(235,161,61,0.08);
            }

            .auth-form__input:focus ~ .auth-form__label,
            .auth-form__input:not(:placeholder-shown) ~ .auth-form__label {
                top: 10px;
                transform: translateY(0);
                font-size: 0.6rem;
                color: var(--clr-accent);
                letter-spacing: 0.18em;
            }

            /* Password wrapper */
            .auth-form__pw-wrap {
                position: relative;
            }

            .auth-form__pw-wrap .auth-form__input {
                padding-right: 52px;
            }

            .auth-form__pw-toggle {
                position: absolute;
                right: 16px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                cursor: pointer;
                padding: 4px;
                color: var(--clr-text-muted);
                transition: color 0.2s;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .auth-form__pw-toggle:hover { color: var(--clr-accent); }

            /* Remember row */
            .auth-form__row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin: 4px 0 28px;
            }

            .auth-form__checkbox-label {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                cursor: pointer;
                font-family: 'Space Mono', monospace;
                font-size: 0.72rem;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: var(--clr-text-muted);
                user-select: none;
                transition: color 0.2s;
            }
            .auth-form__checkbox-label:hover { color: var(--clr-border); }

            .auth-form__checkbox {
                width: 18px;
                height: 18px;
                accent-color: var(--clr-accent);
                border-radius: 4px;
                flex-shrink: 0;
                cursor: pointer;
            }

            /* CTA button */
            .auth-form__btn {
                width: 100%;
                background: var(--clr-accent);
                color: var(--clr-dark);
                border: none;
                border-radius: 10px;
                padding: 16px;
                font-family: 'Space Grotesk', sans-serif;
                font-size: 0.92rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                cursor: pointer;
                transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
                box-shadow: 0 4px 20px rgba(235,161,61,0.25);
                position: relative;
                overflow: hidden;
            }

            .auth-form__btn::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,0.15) 50%, transparent 70%);
                transform: translateX(-100%);
                transition: transform 0.5s ease;
            }

            .auth-form__btn:hover {
                background: #f0ac48;
                transform: translateY(-2px);
                box-shadow: 0 8px 28px rgba(235,161,61,0.4);
            }
            .auth-form__btn:hover::before { transform: translateX(100%); }
            .auth-form__btn:active { transform: translateY(0); }

            /* Divider */
            .auth-divider {
                display: flex;
                align-items: center;
                gap: 14px;
                margin: 24px 0;
            }
            .auth-divider__line {
                flex: 1;
                height: 1px;
                background: rgba(239,225,217,0.12);
            }
            .auth-divider__text {
                font-family: 'Space Mono', monospace;
                font-size: 0.65rem;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--clr-text-muted);
            }

            /* Social buttons */
            .auth-socials {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .auth-social-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 13px;
                border-radius: 10px;
                border: 1px solid rgba(239,225,217,0.15);
                background: rgba(239,225,217,0.03);
                color: var(--clr-border);
                font-family: 'Space Grotesk', sans-serif;
                font-size: 0.82rem;
                font-weight: 600;
                cursor: pointer;
                transition: border-color 0.3s, background 0.3s, transform 0.2s;
                text-decoration: none;
            }
            .auth-social-btn:hover {
                border-color: rgba(239,225,217,0.35);
                background: rgba(239,225,217,0.08);
                transform: translateY(-1px);
                color: var(--clr-border);
            }

            .auth-social-btn svg {
                flex-shrink: 0;
                width: 18px;
                height: 18px;
            }

            /* Back link */
            .auth-back {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-top: 36px;
                font-family: 'Space Mono', monospace;
                font-size: 0.7rem;
                letter-spacing: 0.14em;
                text-transform: uppercase;
                color: var(--clr-text-muted);
                text-decoration: none;
                transition: color 0.25s, gap 0.25s;
            }
            .auth-back:hover {
                color: var(--clr-accent);
                gap: 12px;
            }

            .auth-back__arrow {
                transition: transform 0.25s;
            }
            .auth-back:hover .auth-back__arrow { transform: translateX(-3px); }

            /* Error messages */
            .auth-error {
                font-family: 'Space Mono', monospace;
                font-size: 0.7rem;
                color: #f87171;
                margin-top: 6px;
                padding-left: 2px;
                letter-spacing: 0.04em;
            }

            /* Alert styling */
            .auth-alert {
                background: rgba(180,38,56,0.15);
                border: 1px solid rgba(180,38,56,0.35);
                border-radius: 10px;
                padding: 14px 16px;
                font-family: 'Space Mono', monospace;
                font-size: 0.72rem;
                color: #fca5a5;
                letter-spacing: 0.04em;
                margin-bottom: 20px;
            }

            /* Card 3D tilt effect */
            .auth-right { perspective: 1000px; }
            .auth-card-inner {
                width: 100%;
                transition: transform 0.1s linear;
                transform-style: preserve-3d;
            }
        </style>
    </head>
    <body>
        <div class="auth-page">

            {{-- ── LEFT: Cinematic Image Panel ── --}}
            <div class="auth-left">
                <img
                    src="{{ asset('images/cinematic_cafe_hero.png') }}"
                    alt="Crankhaus Cafe"
                    class="auth-left__img"
                />
                <div class="auth-left__overlay"></div>
                <div class="auth-left__content">
                    <a href="/">
                        <img
                            src="{{ asset('images/CRANK (1).png') }}"
                            alt="CRANKHAUS"
                            class="auth-left__logo"
                        >
                    </a>
                    <h2 class="auth-left__tagline">Eat. Drink.<br>Ride.</h2>
                    <p class="auth-left__sub">The ultimate destination for cyclists.</p>
                    <div class="auth-left__pills">
                        <span class="auth-left__pill">Specialty Coffee</span>
                        <span class="auth-left__pill">Noodles & Dimsum</span>
                        <span class="auth-left__pill">Bike Culture</span>
                    </div>
                </div>
            </div>

            {{-- ── RIGHT: Auth Form ── --}}
            <div class="auth-right" id="authCard">
                <div class="auth-card-inner" id="authCardInner">

                    {{-- Mobile logo --}}
                    <div class="auth-right__mobile-logo">
                        <a href="/"><img src="{{ asset('images/CRANK (1).png') }}" alt="CRANKHAUS"></a>
                    </div>

                    {{-- Heading --}}
                    <div class="auth-heading">
                        <p class="auth-heading__eyebrow">Members Only</p>
                        <h1 class="auth-heading__title">Welcome<br>Back.</h1>
                        <p class="auth-heading__sub">Sign in to access your account.</p>
                    </div>

                    {{-- Form Slot --}}
                    {{ $slot }}

                </div>
            </div>
        </div>

        <script>
        (function () {
            'use strict';

            // 3D tilt on auth card
            var card = document.getElementById('authCard');
            var inner = document.getElementById('authCardInner');
            if (card && inner) {
                card.addEventListener('mousemove', function (e) {
                    var rect = card.getBoundingClientRect();
                    var x = (e.clientX - rect.left) / rect.width  - 0.5;
                    var y = (e.clientY - rect.top)  / rect.height - 0.5;
                    inner.style.transform =
                        'rotateY(' + (x * 4) + 'deg) rotateX(' + (-y * 4) + 'deg)';
                });
                card.addEventListener('mouseleave', function () {
                    inner.style.transform = 'rotateY(0deg) rotateX(0deg)';
                });
            }

            // Fade-in from right on load
            if (inner) {
                inner.style.opacity = '0';
                inner.style.transform = 'translateX(20px)';
                inner.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                setTimeout(function () {
                    inner.style.opacity = '1';
                    inner.style.transform = 'translateX(0)';
                }, 80);
            }
        })();
        </script>
    </body>
</html>
