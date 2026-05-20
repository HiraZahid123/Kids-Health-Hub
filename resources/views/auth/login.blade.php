<x-guest-layout>
    <div class="mb-7">
        <h1 class="text-2xl font-extrabold text-gray-900">Welcome back</h1>
        <p class="text-gray-500 text-sm mt-1">Sign in to your Kids Health Hub account</p>
    </div>

    <x-auth-session-status class="mb-5 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition text-sm"
                placeholder="you@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold">Forgot password?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition text-sm"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs" />
        </div>

        <div class="flex items-center gap-2.5">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-400 cursor-pointer">
            <label for="remember_me" class="text-sm text-gray-600 cursor-pointer">Keep me signed in</label>
        </div>

        <button type="submit"
            class="w-full bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl transition-colors text-sm shadow-sm shadow-emerald-200">
            Sign In
        </button>
    </form>

    <div class="mt-7 pt-6 border-t border-gray-100 space-y-2.5">
        <p class="text-sm text-gray-600 text-center">
            New provider? <a href="{{ route('register') }}" class="text-emerald-600 font-bold hover:underline">List your practice →</a>
        </p>
        <p class="text-sm text-gray-600 text-center">
            Family member? <a href="{{ route('register.family') }}" class="text-sky-600 font-bold hover:underline">Join as a family →</a>
        </p>
    </div>
</x-guest-layout>
