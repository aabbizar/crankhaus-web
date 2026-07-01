<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="block w-full !rounded-[8px] !border-[rgba(235,161,61,0.3)] !bg-[rgba(2,11,10,0.45)] !text-[#efe1d9] focus:!border-[#eba13d] focus:!ring-[#eba13d] px-6 py-5 text-sm transition-all duration-300 shadow-none font-inter placeholder:text-[#efe1d9]/40" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-text-input id="password" class="block w-full !rounded-[8px] !border-[rgba(235,161,61,0.3)] !bg-[rgba(2,11,10,0.45)] !text-[#efe1d9] focus:!border-[#eba13d] focus:!ring-[#eba13d] px-6 py-5 text-sm transition-all duration-300 shadow-none font-inter placeholder:text-[#efe1d9]/40" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pl-2">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-[4px] w-5 h-5 border-[rgba(235,161,61,0.3)] bg-[rgba(2,11,10,0.45)] text-[#eba13d] shadow-sm focus:ring-[#eba13d] cursor-pointer" name="remember">
                <span class="ms-3 text-sm text-[#efe1d9]/80 group-hover:text-[#eba13d] transition-colors font-bold font-mono uppercase tracking-wider text-[11px]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" id="loginSubmitBtn" class="w-full flex justify-center items-center py-4 px-6 rounded-[8px] text-[#020b0a] bg-[#eba13d] hover:bg-[#fffce1] hover:text-[#b42638] focus:outline-none focus:ring-4 focus:ring-[#eba13d]/50 font-sans font-black text-base uppercase tracking-widest transition-all duration-300 shadow-[0_4px_12px_rgba(235,161,61,0.2)] hover:shadow-[0_8px_24px_rgba(235,161,61,0.4)] hover:-translate-y-1">
                Log in
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('form > div');
            const form = document.querySelector('form');
            const btn = document.getElementById('loginSubmitBtn');

            if (window.gsap) {
                gsap.fromTo(inputs,
                    { y: 20, opacity: 0 },
                    { y: 0, opacity: 1, duration: 0.6, stagger: 0.1, ease: "power3.out", delay: 0.4 }
                );

                if(form) {
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        gsap.to(btn, { width: 60, padding: 0, color: "transparent", duration: 0.3, ease: "power2.inOut" });
                        gsap.to(form, { opacity: 0, y: -20, duration: 0.4, ease: "power3.in", delay: 0.1, onComplete: () => form.submit() });
                    });
                }
            }
        });
    </script>

    {{-- Bottom back link --}}
    <div class="mt-10 text-center border-t border-[#eba13d]/20 pt-6">
        <a href="{{ route('home') }}" class="text-xs font-mono font-bold text-[#efe1d9]/60 hover:text-[#eba13d] transition-colors tracking-widest uppercase no-underline">← BACK TO EXPLORE</a>
    </div>
</x-guest-layout>
