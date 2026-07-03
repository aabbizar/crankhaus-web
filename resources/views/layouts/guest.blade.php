<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sign in to your Crankhaus account — Eat. Drink. Ride.">
    <title>Login — {{ config('app.name', 'Crankhaus') }}</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- GSAP (required for page-transitions component) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        /* ═══════════════════════════════════════════════
           AUTH PAGE — SPLIT CARD DESIGN
           Background: Crankhaus Red (#b42638) matching home
        ═══════════════════════════════════════════════ */

        :root {
            --ck-bg:          #b42638;   /* Crankhaus Red — same as home --lf-red */
            --ck-accent:      #ff385c;   /* Rausch CTA */
            --ck-accent-dk:   #e0274a;
            --ck-text:        #1a1a1a;
            --ck-muted:       #6b7280;
            --ck-input-bg:    #f3f4f6;
            --ck-radius-card: 26px;
            --ck-ease:        cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        /* ── Page body ── */
        body.auth-page-body {
            min-height: 100vh;
            background-color: var(--ck-bg);
            background-image:
                radial-gradient(ellipse 80% 55% at 15% 0%,   rgba(255,255,255,0.07) 0%, transparent 55%),
                radial-gradient(ellipse 60% 50% at 85% 100%, rgba(0,0,0,0.3)        0%, transparent 60%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Split card wrapper ── */
        .ck-login-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 960px;
            min-height: 600px;
            /* FIX: border-radius + overflow:hidden must be co-located;
               isolation prevents stacking context leaks that show white edges */
            border-radius: var(--ck-radius-card);
            overflow: hidden;
            isolation: isolate;
            box-shadow:
                0 0 0 1px rgba(0,0,0,0.12),
                0 28px 80px rgba(0,0,0,0.55),
                0 8px 24px  rgba(180,38,56,0.3);
            /* start hidden — JS animates in */
            opacity: 0;
            transform: translateY(40px) scale(0.96);
        }

        @media (max-width: 767px) {
            .ck-login-card {
                grid-template-columns: 1fr;
                max-width: 420px;
                min-height: auto;
            }
            .ck-left { display: none; }
        }

        /* ═══════════════════════════════════════════════
           LEFT PANEL — Full-bleed image, no white edge
        ═══════════════════════════════════════════════ */
        .ck-left {
            position: relative;
            /* NO border-radius here — the card's overflow:hidden handles clipping */
            overflow: hidden;
            min-height: 600px;
        }

        .ck-left__img {
            /* Absolute fill — prevents any gap at corners */
            position: absolute;
            top: -1px;          /* -1px overshoot prevents sub-pixel white lines */
            left: -1px;
            right: -1px;
            bottom: -1px;
            width: calc(100% + 2px);
            height: calc(100% + 2px);
            object-fit: cover;
            object-position: center 30%;
            transform: scale(1.04);
            transition: transform 10s ease-out;
            filter: brightness(0.68) saturate(1.1);
            display: block;
        }

        .ck-left:hover .ck-left__img {
            transform: scale(1);
        }

        /* Dark gradient veil — bottom to top + left edge */
        .ck-left__overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to top,  rgba(26,2,5,0.92) 0%,  rgba(26,2,5,0.25) 50%, transparent 100%),
                linear-gradient(to right, rgba(0,0,0,0.25) 0%, transparent 55%);
            z-index: 1;
        }

        /* Brand badge — bottom left */
        .ck-left__badge {
            position: absolute;
            bottom: 36px;
            left: 32px;
            z-index: 2;
        }

        .ck-left__label {
            font-family: 'Inter', sans-serif;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            margin-bottom: 5px;
        }

        .ck-left__tagline {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.88);
        }

        /* ═══════════════════════════════════════════════
           RIGHT PANEL — Form area
        ═══════════════════════════════════════════════ */
        .ck-right {
            background: #ffffff;
            display: flex;
            flex-direction: column;
            padding: 48px 52px 44px;
            position: relative;
            /* ensure white bg clips at card's border-radius */
            overflow: hidden;
        }

        @media (max-width: 900px)  { .ck-right { padding: 44px 40px; } }
        @media (max-width: 767px)  { .ck-right { padding: 40px 28px; } }
        @media (max-width: 480px)  { .ck-right { padding: 32px 20px; } }

        /* Back link */
        .ck-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ck-muted);
            text-decoration: none;
            letter-spacing: 0.01em;
            transition: color 0.3s var(--ck-ease), gap 0.3s var(--ck-ease);
            margin-bottom: 40px;
            width: fit-content;
        }
        .ck-back svg { transition: transform 0.3s var(--ck-ease); }
        .ck-back:hover { color: var(--ck-accent); gap: 11px; }
        .ck-back:hover svg { transform: translateX(-3px); }

        /* Heading block */
        .ck-heading { margin-bottom: 32px; }

        .ck-heading__eyebrow {
            font-family: 'Inter', sans-serif;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--ck-muted);
            margin-bottom: 4px;
            letter-spacing: 0.01em;
        }

        .ck-heading__title {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 900;
            font-size: clamp(2.1rem, 4vw, 2.85rem);
            line-height: 1.08;
            color: var(--ck-text);
            letter-spacing: -0.01em;
            margin-bottom: 10px;
        }

        .ck-heading__sub {
            font-family: 'Inter', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ck-muted);
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        /* ── Form ── */
        .ck-form {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ck-field { position: relative; margin-bottom: 14px; }

        /* Pill-shaped input */
        .ck-input {
            width: 100%;
            background: var(--ck-input-bg);
            border: 1.5px solid transparent;
            border-radius: 999px;
            padding: 14px 22px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--ck-text);
            outline: none;
            -webkit-appearance: none;
            transition:
                border-color  0.3s ease,
                box-shadow    0.3s ease,
                background    0.3s ease,
                transform     0.25s var(--ck-ease);
        }
        .ck-input::placeholder { color: #aab0b8; font-weight: 400; }
        .ck-input:hover        { background: #ebebeb; }
        .ck-input:focus {
            background: #fff;
            border-color: var(--ck-accent);
            box-shadow: 0 0 0 4px rgba(255,56,92,0.12);
            transform: translateY(-1px);
        }

        /* Password wrapper */
        .ck-pw-wrap               { position: relative; }
        .ck-pw-wrap .ck-input     { padding-right: 54px; }
        .ck-pw-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: #aab0b8;
            display: flex;
            align-items: center;
            transition: color 0.3s ease, transform 0.25s var(--ck-ease);
        }
        .ck-pw-toggle:hover { color: var(--ck-accent); transform: translateY(-50%) scale(1.15); }

        /* Validation error */
        .ck-error {
            font-size: 0.72rem;
            color: #ef4444;
            margin-top: 6px;
            padding-left: 14px;
            letter-spacing: 0.02em;
        }

        /* Session / credential alert */
        .ck-alert {
            background: rgba(255,56,92,0.07);
            border: 1px solid rgba(255,56,92,0.22);
            border-radius: 14px;
            padding: 12px 18px;
            font-size: 0.78rem;
            color: #c0182e;
            margin-bottom: 20px;
            letter-spacing: 0.01em;
        }

        /* Remember row */
        .ck-row {
            display: flex;
            align-items: center;
            margin: 10px 0 26px;
            padding-left: 6px;
        }
        .ck-checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--ck-muted);
            cursor: pointer;
            user-select: none;
            transition: color 0.2s ease;
        }
        .ck-checkbox-label:hover { color: var(--ck-text); }
        .ck-checkbox {
            width: 17px; height: 17px;
            accent-color: var(--ck-accent);
            cursor: pointer; flex-shrink: 0;
        }

        /* Submit CTA — pill, Rausch red */
        .ck-btn {
            width: 100%;
            background: var(--ck-accent);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 15px 28px;
            font-family: 'Inter', sans-serif;
            font-size: 0.92rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition:
                background  0.3s ease,
                transform   0.25s var(--ck-ease),
                box-shadow  0.3s ease;
            box-shadow: 0 4px 20px rgba(255,56,92,0.32);
        }
        /* Shimmer sweep on hover */
        .ck-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent 25%, rgba(255,255,255,0.22) 50%, transparent 75%);
            transform: translateX(-130%);
            transition: transform 0.55s ease;
        }
        .ck-btn:hover {
            background: var(--ck-accent-dk);
            transform: translateY(-2px);
            box-shadow: 0 10px 36px rgba(255,56,92,0.48);
        }
        .ck-btn:hover::after { transform: translateX(130%); }
        .ck-btn:active       { transform: translateY(0); box-shadow: 0 4px 16px rgba(255,56,92,0.3); }
        .ck-btn:disabled     { opacity: 0.65; cursor: not-allowed; transform: none; }
    </style>
</head>
<body class="auth-page-body">

    {{-- Page-transition overlay (handles Back button wipe + entrance animation) --}}
    <x-page-transitions />

    {{-- ══════════════════════════════════════════════
         SPLIT CARD
    ══════════════════════════════════════════════ --}}
    <div class="ck-login-card" id="ckCard">

        {{-- LEFT: Full-bleed image panel --}}
        <div class="ck-left" aria-hidden="true">
            <img
                src="{{ asset('images/login_hero_cafe.png') }}"
                alt="Crankhaus café &amp; cycling vibe"
                class="ck-left__img"
                loading="eager"
                decoding="async"
            >
            <div class="ck-left__overlay"></div>
            <div class="ck-left__badge">
                <p class="ck-left__label">Crankhaus</p>
                <p class="ck-left__tagline">Eat. Drink. Ride.</p>
            </div>
        </div>

        {{-- RIGHT: Form panel --}}
        <div class="ck-right" id="ckRight">

            {{-- ← Back --}}
            <a href="{{ route('home') }}" class="ck-back" id="ckBack" aria-label="Back to homepage">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>

            {{-- Heading --}}
            <div class="ck-heading" id="ckHeading">
                <p class="ck-heading__eyebrow">Login to</p>
                <h1 class="ck-heading__title">Crankhaus</h1>
                <p class="ck-heading__sub">Eat. Drink. Ride.</p>
            </div>

            {{-- Form slot (login.blade.php) --}}
            {{ $slot }}

        </div>
    </div>

    <script>
    (function () {
        'use strict';

        var card    = document.getElementById('ckCard');
        var right   = document.getElementById('ckRight');
        var back    = document.getElementById('ckBack');
        var heading = document.getElementById('ckHeading');

        // ── Card entrance animation ──────────────────────────────────────────
        function runEntrance() {
            if (window.gsap) {
                // 1. Card slides up + fades in
                gsap.to(card, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.9,
                    ease: 'power4.out',
                    delay: 0.15,
                    clearProps: 'transform'
                });

                // 2. Right-panel children stagger in
                var children = [back, heading].concat(
                    Array.from(right.querySelectorAll('.ck-alert, .ck-form'))
                );
                gsap.from(children, {
                    opacity: 0,
                    y: 22,
                    stagger: 0.1,
                    duration: 0.65,
                    ease: 'power3.out',
                    delay: 0.4
                });
            } else {
                // CSS fallback
                card.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                setTimeout(function () {
                    card.style.opacity   = '1';
                    card.style.transform = 'translateY(0) scale(1)';
                }, 80);
            }
        }

        // Run after page-transitions overlay wipes away
        // page-transitions fires its onComplete, then we animate.
        // We delay by 700ms to let the wipe panels clear.
        setTimeout(runEntrance, 700);

        // ── Image parallax on mouse move ─────────────────────────────────────
        var img = document.querySelector('.ck-left__img');
        if (card && img) {
            card.addEventListener('mousemove', function (e) {
                var rect = card.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width  - 0.5) * 8;
                var y = ((e.clientY - rect.top)  / rect.height - 0.5) * 8;
                img.style.transform = 'scale(1.04) translate(' + x + 'px,' + y + 'px)';
            });
            card.addEventListener('mouseleave', function () {
                img.style.transform = 'scale(1.04)';
            });
        }

        // ── Input micro-interactions ─────────────────────────────────────────
        document.querySelectorAll('.ck-input').forEach(function (input) {
            if (!window.gsap) return;
            input.addEventListener('focus', function () {
                gsap.to(this, { scale: 1.01, duration: 0.25, ease: 'power2.out' });
            });
            input.addEventListener('blur', function () {
                gsap.to(this, { scale: 1, duration: 0.25, ease: 'power2.out' });
            });
        });

    })();
    </script>

</body>
</html>
