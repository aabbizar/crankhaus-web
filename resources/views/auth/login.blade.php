<x-guest-layout>
    {{-- Session Status --}}
    @if (session('status'))
        <div class="auth-alert" role="alert">{{ session('status') }}</div>
    @endif

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="auth-alert" role="alert">
            These credentials do not match our records.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form" id="loginForm">
        @csrf

        {{-- Email --}}
        <div class="auth-form__group">
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder=" "
                class="auth-form__input"
            />
            <label for="email" class="auth-form__label">Email Address</label>
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="auth-form__group">
            <div class="auth-form__pw-wrap">
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder=" "
                    class="auth-form__input"
                />
                <label for="password" class="auth-form__label">Password</label>
                <button
                    type="button"
                    class="auth-form__pw-toggle"
                    id="pwToggle"
                    aria-label="Toggle password visibility"
                >
                    {{-- Eye icon --}}
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{-- Eye-off icon (hidden by default) --}}
                    <svg id="eyeOff" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.592M6.228 6.228A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.43 5.272M3 3l18 18"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="auth-form__row">
            <label for="remember_me" class="auth-form__checkbox-label">
                <input id="remember_me" type="checkbox" name="remember" class="auth-form__checkbox">
                Remember me
            </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="auth-form__btn" id="loginBtn">
            Sign In →
        </button>
    </form>

    {{-- Or continue with --}}
    <div class="auth-divider">
        <span class="auth-divider__line"></span>
        <span class="auth-divider__text">Or continue with</span>
        <span class="auth-divider__line"></span>
    </div>

    {{-- Social (UI only – no backend) --}}
    <div class="auth-socials">
        <button type="button" class="auth-social-btn" onclick="alert('Social login not available.')">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Google
        </button>
        <button type="button" class="auth-social-btn" onclick="alert('Social login not available.')">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.7 9.05 7.42c1.38.07 2.33.74 3.13.8 1.18-.24 2.32-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.56-1.32 3.1-2.58 3.97zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
            </svg>
            Apple
        </button>
    </div>

    {{-- Back to Home --}}
    <div style="text-align:center;">
        <a href="{{ route('home') }}" class="auth-back">
            <svg class="auth-back__arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Home
        </a>
    </div>

    <script>
    (function () {
        // Password toggle
        var pwToggle  = document.getElementById('pwToggle');
        var pwInput   = document.getElementById('password');
        var eyeOpen   = document.getElementById('eyeOpen');
        var eyeOff    = document.getElementById('eyeOff');

        if (pwToggle && pwInput) {
            pwToggle.addEventListener('click', function () {
                var isHidden = pwInput.type === 'password';
                pwInput.type = isHidden ? 'text' : 'password';
                eyeOpen.style.display = isHidden ? 'none'  : '';
                eyeOff.style.display  = isHidden ? ''      : 'none';
            });
        }

        // Shimmer on submit
        var form = document.getElementById('loginForm');
        var btn  = document.getElementById('loginBtn');
        if (form && btn) {
            form.addEventListener('submit', function () {
                btn.textContent = 'Signing In…';
                btn.disabled = true;
                btn.style.opacity = '0.8';
            });
        }
    })();
    </script>
</x-guest-layout>
