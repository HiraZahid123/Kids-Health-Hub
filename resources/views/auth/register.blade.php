<x-guest-layout>
    <div class="mb-6 text-center">
        <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 mb-2">
            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-sm">K</span>
            </div>
            <span class="text-lg font-bold text-gray-800">Kids Health Hub</span>
        </a>
        <h1 class="text-xl font-bold text-gray-800">Create Provider Account</h1>
        <p class="text-gray-500 text-sm mt-1">Start your free 3-month trial today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Business Name -->
        <div>
            <x-input-label for="business_name" :value="__('Practice / Business Name *')" />
            <x-text-input id="business_name" class="block mt-1 w-full" type="text" name="business_name"
                :value="old('business_name')" required autofocus placeholder="e.g. Bright Start Therapy" />
            <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Your Full Name *')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address *')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password *')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password *')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-3 mt-4 text-sm text-emerald-700">
            🎁 <strong>Free 3-month trial</strong> — No credit card required.
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
