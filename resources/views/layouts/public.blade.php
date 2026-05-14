<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kids Health Hub') — Find Child Healthcare Providers</title>
    <meta name="description" content="@yield('meta_description', 'Find trusted child healthcare providers and therapists near you. Kids Health Hub connects families with speech pathologists, occupational therapists, psychologists and more.')">>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('head')
</head>
<body class="font-sans antialiased bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">K</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Kids Health Hub</span>
                </a>

                <!-- Desktop nav -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('providers.index') }}" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors">Find Providers</a>
                    <a href="{{ route('telehealth') }}" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors">Telehealth</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors">Provider Login</a>
                        <a href="{{ route('register') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-4 py-2 rounded-lg transition-colors">List Your Practice</a>
                    @else
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors">Admin Panel</a>
                        @else
                            <a href="{{ route('provider.dashboard') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-4 py-2 rounded-lg transition-colors">My Dashboard</a>
                        @endif
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <button x-data @click="$dispatch('toggle-menu')" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-data="{ open: false }" @toggle-menu.window="open = !open" x-show="open" class="md:hidden border-t border-gray-100 bg-white px-4 py-3 space-y-2">
            <a href="{{ route('providers.index') }}" class="block py-2 text-gray-700 font-medium">Find Providers</a>
            <a href="{{ route('telehealth') }}" class="block py-2 text-gray-700 font-medium">Telehealth</a>
            @guest
                <a href="{{ route('login') }}" class="block py-2 text-gray-700 font-medium">Provider Login</a>
                <a href="{{ route('register') }}" class="block py-2 text-emerald-600 font-semibold">List Your Practice</a>
            @else
                <a href="{{ route('provider.dashboard') }}" class="block py-2 text-emerald-600 font-semibold">My Dashboard</a>
            @endguest
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4 max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8 rounded-lg">
            <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8 rounded-lg">
            <p class="text-red-800 font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xs">K</span>
                        </div>
                        <span class="text-white font-bold text-lg">Kids Health Hub</span>
                    </div>
                    <p class="text-sm text-gray-400">Connecting Australian families with trusted child healthcare professionals.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">For Families</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('providers.index') }}" class="hover:text-white transition-colors">Find Providers</a></li>
                        <li><a href="{{ route('telehealth') }}" class="hover:text-white transition-colors">Telehealth Providers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">For Providers</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">List Your Practice</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Provider Login</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-sm text-gray-500 text-center">
                &copy; {{ date('Y') }} Kids Health Hub. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
