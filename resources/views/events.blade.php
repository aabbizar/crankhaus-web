<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cycling Events — Crankhaus Pedal & Spice</title>
    <meta name="description" content="Upcoming cycling events, night rides, track days, and alleycat races hosted by or in partnership with Crankhaus Jakarta.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        body { padding-top: 72px; background: #fff; }

        .events-hero {
            background: #000;
            color: #fff;
            border-bottom: 2px solid #000;
            padding: 80px 32px;
            position: relative;
            overflow: hidden;
            min-height: 360px;
            display: flex;
            align-items: center;
        }
        .events-hero__bg {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1608245449230-4ac19066d2d0?w=1400&auto=format&fit=crop') center/cover no-repeat;
            opacity: 0.2;
        }
        .events-hero__content {
            position: relative;
            z-index: 1;
            max-width: 1536px;
            margin: 0 auto;
            width: 100%;
        }

        .event-card {
            border: 2px solid #000;
            background: #fff;
            display: grid;
            grid-template-columns: 140px 1fr auto;
            align-items: stretch;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .event-card:hover {
            box-shadow: 8px 8px 0 #E53935;
            transform: translate(-4px, -4px);
        }
        .event-card__date {
            background: #E53935;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            border-right: 2px solid #000;
            text-align: center;
        }
        .event-card__date-day {
            font-size: 48px;
            font-weight: 900;
            line-height: 1;
        }
        .event-card__date-month {
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 4px;
        }
        .event-card__date-time {
            font-size: 11px;
            font-weight: 700;
            margin-top: 8px;
            opacity: 0.85;
        }
        .event-card__body {
            padding: 28px 32px;
        }
        .event-card__label {
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #E53935;
            margin-bottom: 6px;
        }
        .event-card__title {
            font-size: 22px;
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.03em;
            color: #000;
            margin-bottom: 10px;
        }
        .event-card__desc {
            font-size: 14px;
            line-height: 1.6;
            color: #555;
            max-width: 540px;
        }
        .event-card__location {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            color: #000;
            margin-top: 12px;
        }
        .event-card__action {
            border-left: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            min-width: 120px;
        }

        @media (max-width: 768px) {
            .event-card {
                grid-template-columns: 1fr;
            }
            .event-card__date {
                border-right: none;
                border-bottom: 2px solid #000;
                flex-direction: row;
                gap: 16px;
                padding: 20px 24px;
                justify-content: flex-start;
            }
            .event-card__date-day { font-size: 36px; }
            .event-card__action {
                border-left: none;
                border-top: 2px solid #000;
                justify-content: flex-start;
                padding: 20px 24px;
            }
        }
    </style>
</head>
<body>
    {{-- Navigation --}}
    <nav class="ck-nav">
        <a href="/" class="ck-nav__logo">
            <div class="ck-nav__logo-mark">C</div>
            Crankhaus
        </a>
        <div class="ck-nav__links">
            <a href="/menu" class="ck-nav__link">Menu</a>
            <a href="/reserve" class="ck-nav__link">Reserve</a>
            <a href="/events" class="ck-nav__link" style="color:#E53935;">Events</a>
            @auth
                <a href="/admin" class="ck-nav__link">Admin</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="ck-btn-ghost">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="ck-nav__link">Log In</a>
            @endauth
            <a href="/menu" class="ck-nav__link ck-nav__link--cta">Order Now</a>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="events-hero">
        <div class="events-hero__bg"></div>
        <div class="events-hero__content">
            <p class="text-xs font-black uppercase tracking-widest text-[#E53935] mb-4">Jakarta Cycling Community</p>
            <h1 class="text-6xl md:text-8xl font-black uppercase leading-none text-white" id="eventsTitle">
                Upcoming<br>Events.
            </h1>
            <p class="text-base text-white/70 mt-6 max-w-lg leading-relaxed">
                Track days, night rides, and alleycat races — curated for Jakarta's cycling community.
                Fuel up at Crankhaus before every ride.
            </p>
        </div>
    </section>

    {{-- Events Grid --}}
    <main class="ck-section max-w-screen-2xl mx-auto px-4 md:px-8 w-full" style="padding-top: 64px;">
        @if($events->isEmpty())
            <div class="text-center py-24" style="border: 2px solid #000;">
                <p class="text-2xl font-black uppercase mb-2">No Upcoming Events</p>
                <p class="text-sm text-[#555]">Check back soon — we're always planning the next ride.</p>
            </div>
        @else
            <div class="flex flex-col gap-0" id="eventsGrid">
                @foreach($events as $event)
                    <div class="event-card" style="{{ !$loop->last ? 'border-bottom: none;' : '' }}">
                        {{-- Date Column --}}
                        <div class="event-card__date">
                            <span class="event-card__date-day">{{ $event->date->format('d') }}</span>
                            <span class="event-card__date-month">{{ $event->date->format('M Y') }}</span>
                            <span class="event-card__date-time">{{ $event->date->format('H:i') }}</span>
                        </div>

                        {{-- Body --}}
                        <div class="event-card__body">
                            <p class="event-card__label">
                                {{ $event->date->isToday() ? 'Today' : ($event->date->isTomorrow() ? 'Tomorrow' : $event->date->format('l')) }}
                            </p>
                            <h2 class="event-card__title">{{ $event->title }}</h2>
                            <p class="event-card__desc">{{ $event->description }}</p>
                            @if($event->location)
                                <div class="event-card__location">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $event->location }}
                                </div>
                            @endif
                        </div>

                        {{-- Action --}}
                        <div class="event-card__action">
                            <a href="/reserve" class="ck-btn ck-btn-primary" style="font-size: 11px; padding: 12px 20px; white-space: nowrap;">
                                Reserve Table
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- CTA below events --}}
        <div style="border: 2px solid #000; margin-top: 64px; padding: 48px; text-align: center; background: #F5F5F7;">
            <p class="text-xs font-black uppercase tracking-widest text-[#E53935] mb-4">Join The Community</p>
            <h2 class="text-4xl font-black uppercase leading-none mb-4">Got An Event In Mind?</h2>
            <p class="text-base text-[#555] max-w-md mx-auto mb-8">
                Organize a group ride, track day, or club meetup with Crankhaus as your base camp.
                We'll handle the food.
            </p>
            <a href="mailto:events@crankhaus.id" class="ck-btn ck-btn-secondary">
                Contact Us About Events
            </a>
        </div>
    </main>

    {{-- Footer --}}
    @include('components.footer')

    <script>
        gsap.registerPlugin(ScrollTrigger);

        window.addEventListener('load', () => {
            gsap.set('#eventsTitle', { transformPerspective: 800 });
            gsap.from('#eventsTitle', {
                duration: 1.0,
                rotationX: -50,
                y: 40,
                opacity: 0,
                ease: 'power4.out'
            });

            gsap.utils.toArray('.event-card').forEach((card, i) => {
                gsap.from(card, {
                    x: i % 2 === 0 ? -40 : 40,
                    opacity: 0,
                    duration: 0.7,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: card,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    }
                });
            });
        });
    </script>
</body>
</html>
