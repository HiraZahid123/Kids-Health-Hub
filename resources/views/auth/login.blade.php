<x-guest-layout>
    <div class="mb-7">
        <h1 class="text-2xl font-extrabold text-gray-900">Welcome back</h1>
        <p class="text-gray-500 text-sm mt-1">Sign in to your Kids Health Hub account</p>
    </div>

    <x-auth-session-status class="mb-5 text-sm rounded-xl px-4 py-3" style="color:#166534; background:#f0fdf4; border:1px solid #bbf7d0;" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-3 border rounded-xl text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white focus:outline-none transition text-sm"
                style="border-color:#e5d5cf; focus:ring:2px solid #de6148;"
                onfocus="this.style.borderColor='#de6148'; this.style.boxShadow='0 0 0 3px rgba(222,97,72,0.12)';"
                onblur="this.style.borderColor='#e5d5cf'; this.style.boxShadow='none';"
                placeholder="you@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold hover:underline" style="color:#de6148;">Forgot password?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-3 border rounded-xl text-gray-800 bg-gray-50 focus:bg-white focus:outline-none transition text-sm"
                style="border-color:#e5d5cf;"
                onfocus="this.style.borderColor='#de6148'; this.style.boxShadow='0 0 0 3px rgba(222,97,72,0.12)';"
                onblur="this.style.borderColor='#e5d5cf'; this.style.boxShadow='none';"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs" />
        </div>

        <div class="flex items-center gap-2.5">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 rounded cursor-pointer" style="accent-color:#de6148;">
            <label for="remember_me" class="text-sm text-gray-600 cursor-pointer">Keep me signed in</label>
        </div>

        <button type="submit"
            class="w-full text-white font-bold py-3 px-6 rounded-xl transition-all text-sm shadow-sm"
            style="background:#de6148;"
            onmouseover="this.style.background='#cc5038';"
            onmouseout="this.style.background='#de6148';">
            Sign In
        </button>
    </form>

    <div class="mt-7 pt-6 space-y-2.5" style="border-top:1px solid #f3e8e3;">
        <p class="text-sm text-gray-600 text-center">
            New provider? <a href="{{ route('register') }}" class="font-bold hover:underline" style="color:#de6148;">List your practice →</a>
        </p>
    </div>
</x-guest-layout>
