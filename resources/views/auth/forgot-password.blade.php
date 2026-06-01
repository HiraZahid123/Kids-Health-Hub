<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900">Reset your password</h1>
        <p class="text-gray-500 text-sm mt-1 leading-relaxed">Enter your email address and we will send you a link to choose a new password.</p>
    </div>

    <x-auth-session-status class="mb-5 text-sm rounded-xl px-4 py-3" style="color:#166534; background:#f0fdf4; border:1px solid #bbf7d0;" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="you@example.com"
                class="w-full px-4 py-3 border rounded-xl text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white focus:outline-none transition text-sm"
                style="border-color:#e5d5cf;"
                onfocus="this.style.borderColor='#de6148'; this.style.boxShadow='0 0 0 3px rgba(222,97,72,0.12)';"
                onblur="this.style.borderColor='#e5d5cf'; this.style.boxShadow='none';">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs" />
        </div>

        <button type="submit"
            class="w-full text-white font-bold py-3 px-6 rounded-xl transition-all text-sm shadow-sm"
            style="background:#de6148;"
            onmouseover="this.style.background='#cc5038';"
            onmouseout="this.style.background='#de6148';">
            Send Reset Link
        </button>
    </form>

    <div class="mt-6 pt-5 text-center" style="border-top:1px solid #f3e8e3;">
        <a href="{{ route('login') }}" class="text-sm font-bold hover:underline" style="color:#de6148;">← Back to Sign In</a>
    </div>
</x-guest-layout>
