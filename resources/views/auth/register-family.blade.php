<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900">Create a Family Account</h1>
        <p class="text-gray-500 text-sm mt-1">Find and connect with trusted child healthcare providers</p>
    </div>

    <form method="POST" action="{{ route('register.family') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Your Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                placeholder="Jane Smith"
                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                placeholder="you@example.com"
                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password" required autocomplete="new-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
            </div>
        </div>

        <div class="bg-sky-50 border border-sky-200 rounded-xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-sky-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-sky-800 leading-relaxed"><strong>Always free for families.</strong> Save providers, request appointments, and message practitioners in one place.</p>
        </div>

        <button type="submit"
            class="w-full bg-sky-500 hover:bg-sky-600 active:bg-sky-700 text-white font-bold py-3 px-6 rounded-xl transition-colors text-sm shadow-sm shadow-sky-200">
            Create Family Account
        </button>
    </form>

    <div class="mt-6 pt-5 border-t border-gray-100 space-y-2.5">
        <p class="text-sm text-gray-600 text-center">
            Already have an account? <a href="{{ route('login') }}" class="text-sky-600 font-bold hover:underline">Sign in →</a>
        </p>
        <p class="text-sm text-gray-600 text-center">
            Are you a healthcare provider? <a href="{{ route('register') }}" class="text-emerald-600 font-bold hover:underline">List your practice →</a>
        </p>
    </div>
</x-guest-layout>
