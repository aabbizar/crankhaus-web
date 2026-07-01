{{-- Shared Footer Component: Mondrian Grid, English-only, all real routes --}}
<footer style="border-top: 2px solid #000; background: #000; color: #fff; margin-top: 0;">
    <div style="max-width: 1440px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; border-bottom: 2px solid #333;">

        {{-- Brand Column --}}
        <div style="padding: 48px 40px; border-right: 1px solid #333;">
            <a href="/" style="display: flex; align-items: center; gap: 10px; text-decoration: none; margin-bottom: 20px;">
                <div style="width: 40px; height: 40px; background: #E53935; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 20px; border: 2px solid #fff; flex-shrink: 0;">C</div>
                <span style="font-size: 18px; font-weight: 900; color: #fff; letter-spacing: -0.04em; text-transform: uppercase;">Crankhaus</span>
            </a>
            <p style="font-size: 13px; line-height: 1.7; color: #999; max-width: 260px; margin-bottom: 24px;">
                Where urban cycling culture meets bold, uncompromised flavor. Jakarta's premier cyclist café & pitstop.
            </p>
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <a href="tel:+6281200000000" style="font-size: 13px; font-weight: 700; color: #E53935; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    +62 812 0000 0000
                </a>
                <a href="mailto:hello@crankhaus.id" style="font-size: 13px; color: #777; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    hello@crankhaus.id
                </a>
            </div>
        </div>

        {{-- Explore Column --}}
        <div style="padding: 48px 32px; border-right: 1px solid #333;">
            <h4 style="font-size: 10px; font-weight: 900; letter-spacing: 0.12em; text-transform: uppercase; color: #fff; margin-bottom: 20px;">Explore</h4>
            <nav style="display: flex; flex-direction: column; gap: 12px;">
                <a href="/" style="font-size: 14px; color: #999; text-decoration: none; transition: color 0.15s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#999'">Home</a>
                <a href="/menu" style="font-size: 14px; color: #999; text-decoration: none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#999'">Menu</a>
                <a href="/reserve" style="font-size: 14px; color: #999; text-decoration: none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#999'">Reserve a Table</a>
                <a href="/events" style="font-size: 14px; color: #999; text-decoration: none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#999'">Events</a>
            </nav>
        </div>

        {{-- Visit Column --}}
        <div style="padding: 48px 32px; border-right: 1px solid #333;">
            <h4 style="font-size: 10px; font-weight: 900; letter-spacing: 0.12em; text-transform: uppercase; color: #fff; margin-bottom: 20px;">Visit Us</h4>
            <address style="font-style: normal; font-size: 13px; line-height: 1.8; color: #999; margin-bottom: 16px;">
                Jl. Pemuda No. 01<br>
                Rawamangun, Jakarta Timur<br>
                DKI Jakarta, 13220
            </address>
            <p style="font-size: 12px; color: #555; line-height: 1.6;">
                Mon – Fri: 07:00 – 22:00<br>
                Sat – Sun: 06:00 – 23:00
            </p>
        </div>

        {{-- Account Column --}}
        <div style="padding: 48px 32px;">
            <h4 style="font-size: 10px; font-weight: 900; letter-spacing: 0.12em; text-transform: uppercase; color: #fff; margin-bottom: 20px;">Account</h4>
            <nav style="display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('login') }}" style="font-size: 14px; color: #999; text-decoration: none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#999'">Log In</a>
                <a href="{{ route('register') }}" style="font-size: 14px; color: #999; text-decoration: none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#999'">Register</a>
                <a href="/admin" style="font-size: 14px; color: #999; text-decoration: none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#999'">Admin Panel</a>
            </nav>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div style="max-width: 1440px; margin: 0 auto; padding: 24px 40px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
        <p style="font-size: 12px; color: #555;">
            &copy; {{ date('Y') }} Crankhaus — Pedal & Spice. All rights reserved.
        </p>
        <div style="display: flex; gap: 24px;">
            <a href="#" style="font-size: 12px; color: #555; text-decoration: none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#555'">Privacy Policy</a>
            <a href="#" style="font-size: 12px; color: #555; text-decoration: none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#555'">Terms of Service</a>
        </div>
    </div>
</footer>
