<x-guest-layout>

    {{-- Session status (e.g. password reset confirmation) --}}
    @if (session('status'))
        <div class="ck-alert" role="alert">{{ session('status') }}</div>
    @endif

    {{-- Credential mismatch error --}}
    @if ($errors->any())
        <div class="ck-alert" role="alert">
            ⚠ These credentials do not match our records.
        </div>
    @endif

    {{-- ── Main Login Form ── --}}
    <form method="POST" action="{{ route('login') }}" class="ck-form" id="loginForm" novalidate>
        @csrf

        {{-- Email --}}
        <div class="ck-field">
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Enter email"
                class="ck-input"
                aria-describedby="emailError"
            >
            @error('email')
                <p class="ck-error" id="emailError">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="ck-field">
            <div class="ck-pw-wrap">
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter password"
                    class="ck-input"
                    aria-describedby="passwordError"
                >
                {{-- Eye toggle --}}
                <button
                    type="button"
                    class="ck-pw-toggle"
                    id="pwToggle"
                    aria-label="Toggle password visibility"
                    tabindex="-1"
                >
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <svg id="eyeOff" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="display:none;" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.592M6.228 6.228A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.43 5.272M3 3l18 18"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="ck-error" id="passwordError">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="ck-row">
            <label for="remember_me" class="ck-checkbox-label">
                <input id="remember_me" type="checkbox" name="remember" class="ck-checkbox">
                Remember me
            </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="ck-btn" id="loginBtn">
            Sign In →
        </button>

    </form>

    <script>
    (function () {
        'use strict';

        // Password visibility toggle
        var toggle  = document.getElementById('pwToggle');
        var pwInput = document.getElementById('password');
        var eyeOpen = document.getElementById('eyeOpen');
        var eyeOff  = document.getElementById('eyeOff');

        if (toggle && pwInput) {
            toggle.addEventListener('click', function () {
                var hidden = pwInput.type === 'password';
                pwInput.type          = hidden ? 'text'     : 'password';
                eyeOpen.style.display = hidden ? 'none'     : '';
                eyeOff.style.display  = hidden ? ''         : 'none';
            });
        }

        // Submit loading feedback
        var form = document.getElementById('loginForm');
        var btn  = document.getElementById('loginBtn');
        if (form && btn) {
            form.addEventListener('submit', function () {
                btn.textContent = 'Signing in…';
                btn.disabled    = true;
            });
        }

        // Input micro-interactions via focus/blur
        document.querySelectorAll('.ck-input').forEach(function (input) {
            input.addEventListener('focus', function () {
                if (window.gsap) {
                    gsap.to(this, { scale: 1.008, duration: 0.25, ease: 'power2.out' });
                }
            });
            input.addEventListener('blur', function () {
                if (window.gsap) {
                    gsap.to(this, { scale: 1, duration: 0.25, ease: 'power2.out' });
                }
            });
        });
    })();
    </script>

</x-guest-layout>
