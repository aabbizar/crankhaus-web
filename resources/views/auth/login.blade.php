<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-bold text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="block w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-black focus:ring-black px-4 py-3.5 text-base transition-colors shadow-sm" 
                   placeholder="admin@pbsahaja.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="block w-full rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-black focus:ring-black px-4 py-3.5 text-base transition-colors shadow-sm" 
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-2">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black shadow-sm focus:ring-black cursor-pointer w-5 h-5 transition-colors" name="remember">
                <span class="ms-3 text-sm font-medium text-gray-600 group-hover:text-black transition-colors">Remember for 30 days</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-black hover:underline" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-4 pt-2">
            <button type="submit" class="w-full flex justify-center items-center py-4 px-6 rounded-xl text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-200 font-bold text-base transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                Sign In
            </button>
        </div>
    </form>

    {{-- Bottom back link --}}
    <div class="mt-12 text-center">
        <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-black transition-colors inline-flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Explore
        </a>
    </div>
</x-guest-layout>
