<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900">List Your Practice</h1>
        <p class="text-gray-500 text-sm mt-1">Start your free 3-month trial - no credit card required</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Practice / Business Name</label>
            <input type="text" name="business_name" value="{{ old('business_name') }}" required autofocus
                placeholder="e.g. Bright Start Therapy"
                class="w-full px-4 py-3 border rounded-xl text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white focus:outline-none transition text-sm"
                style="border-color:#e5d5cf;"
                onfocus="this.style.borderColor='#de6148'; this.style.boxShadow='0 0 0 3px rgba(222,97,72,0.12)';"
                onblur="this.style.borderColor='#e5d5cf'; this.style.boxShadow='none';">
            <x-input-error :messages="$errors->get('business_name')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Your Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                placeholder="Dr. Jane Smith"
                class="w-full px-4 py-3 border rounded-xl text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white focus:outline-none transition text-sm"
                style="border-color:#e5d5cf;"
                onfocus="this.style.borderColor='#de6148'; this.style.boxShadow='0 0 0 3px rgba(222,97,72,0.12)';"
                onblur="this.style.borderColor='#e5d5cf'; this.style.boxShadow='none';">
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                placeholder="you@practice.com.au"
                class="w-full px-4 py-3 border rounded-xl text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white focus:outline-none transition text-sm"
                style="border-color:#e5d5cf;"
                onfocus="this.style.borderColor='#de6148'; this.style.boxShadow='0 0 0 3px rgba(222,97,72,0.12)';"
                onblur="this.style.borderColor='#e5d5cf'; this.style.boxShadow='none';">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password" required autocomplete="new-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border rounded-xl text-gray-800 bg-gray-50 focus:bg-white focus:outline-none transition text-sm"
                    style="border-color:#e5d5cf;"
                    onfocus="this.style.borderColor='#de6148'; this.style.boxShadow='0 0 0 3px rgba(222,97,72,0.12)';"
                    onblur="this.style.borderColor='#e5d5cf'; this.style.boxShadow='none';">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border rounded-xl text-gray-800 bg-gray-50 focus:bg-white focus:outline-none transition text-sm"
                    style="border-color:#e5d5cf;"
                    onfocus="this.style.borderColor='#de6148'; this.style.boxShadow='0 0 0 3px rgba(222,97,72,0.12)';"
                    onblur="this.style.borderColor='#e5d5cf'; this.style.boxShadow='none';">
            </div>
        </div>

        <div class="rounded-xl p-4 flex items-start gap-3" style="background:#fff5f3; border:1px solid #f5c5bb;">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm leading-relaxed" style="color:#7a3025;"><strong>Free 3-month trial included.</strong> Your listing is reviewed by our team and goes live once approved.</p>
        </div>

        <button type="submit"
            class="w-full text-white font-bold py-3 px-6 rounded-xl transition-all text-sm shadow-sm"
            style="background:#de6148;"
            onmouseover="this.style.background='#cc5038';"
            onmouseout="this.style.background='#de6148';">
            Create Provider Account
        </button>
    </form>

    <div class="mt-6 pt-5 space-y-2.5" style="border-top:1px solid #f3e8e3;">
        <p class="text-sm text-gray-600 text-center">
            Already registered? <a href="{{ route('login') }}" class="font-bold hover:underline" style="color:#de6148;">Sign in →</a>
        </p>
    </div>
</x-guest-layout>
