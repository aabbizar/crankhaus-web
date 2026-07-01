<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5 mt-2">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-[#eba13d] mb-2">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="block w-full rounded-xl border border-white/20 bg-black/20 text-white placeholder-white/30 focus:border-[#eba13d] focus:ring-1 focus:ring-[#eba13d] px-5 py-4 text-sm transition-all shadow-inner" 
                   placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-widest text-[#eba13d] mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="block w-full rounded-xl border border-white/20 bg-black/20 text-white placeholder-white/30 focus:border-[#eba13d] focus:ring-1 focus:ring-[#eba13d] px-5 py-4 text-sm transition-all shadow-inner" 
                   placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-white/20 bg-black/20 text-[#eba13d] shadow-sm focus:ring-[#eba13d] cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-white/70 group-hover:text-white transition-colors">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-white/70 hover:text-[#eba13d] transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center items-center py-4 px-6 rounded-xl text-black bg-[#eba13d] hover:bg-white hover:text-black focus:outline-none focus:ring-4 focus:ring-[#eba13d]/30 font-bold text-sm uppercase tracking-widest transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                Sign In
            </button>
        </div>
    </form>

    {{-- Bottom back link --}}
    <div class="mt-8 text-center pt-6 border-t border-white/10">
        <a href="{{ route('home') }}" class="text-xs font-semibold text-white/50 hover:text-white transition-colors tracking-wider uppercase no-underline inline-flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Explore
        </a>
    </div>
</x-guest-layout>
