<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kids Health Hub') — Find Child Healthcare Providers</title>
    <meta name="description" content="@yield('meta_description', 'Find trusted child healthcare providers and therapists near you. Kids Health Hub connects families with speech pathologists, occupational therapists, psychologists and more.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @stack('head')
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .hero-pattern {
            background-color: #f0fdf4;
            background-image: radial-gradient(circle at 20% 80%, rgba(16,185,129,0.08) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(20,184,166,0.08) 0%, transparent 50%),
                              radial-gradient(circle at 50% 50%, rgba(6,182,212,0.04) 0%, transparent 70%);
        }
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0,0,0,0.10); }
    </style>
</head>
<body class="antialiased bg-white text-gray-800">

<!-- Top announcement bar -->
<div class="bg-emerald-600 text-white text-center text-xs py-2 px-4 font-semibold tracking-wide">
    Australia's trusted child healthcare directory &mdash; <a href="{{ route('register') }}" class="underline hover:no-underline ml-1">List your practice free →</a>
</div>

<!-- Navigation -->
<header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
                <div class="relative w-9 h-9">
                    <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="18" cy="18" r="18" fill="#10b981"/>
                        <path d="M18 28C18 28 8 22 8 14.5C8 11.46 10.46 9 13.5 9C15.17 9 16.67 9.76 17.69 10.96C17.85 11.15 18.15 11.15 18.31 10.96C19.33 9.76 20.83 9 22.5 9C25.54 9 28 11.46 28 14.5C28 22 18 28 18 28Z" fill="white"/>
                        <path d="M15.5 14.5H20.5M18 12V17" stroke="#10b981" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </div>
                <div>
                    <div class="font-black text-gray-900 text-base leading-tight tracking-tight">Kids Health Hub</div>
                    <div class="text-emerald-600 text-xs font-semibold leading-none">Child Healthcare Directory</div>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ route('providers.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition-colors">Find Providers</a>
                <a href="{{ route('telehealth') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition-colors">Telehealth</a>
                <a href="{{ route('providers.index', ['available' => 1]) }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition-colors">Available Now</a>
                <a href="{{ route('guide') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition-colors">User Guide</a>
            </nav>

            <!-- Desktop CTAs -->
            <div class="hidden lg:flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 px-3 py-2 transition-colors">Sign in</a>
                    {{-- <a href="{{ route('register.family') }}" class="text-sm font-semibold text-emerald-700 border-2 border-emerald-200 hover:bg-emerald-50 px-4 py-2 rounded-xl transition-colors">Join as Family</a> --}}
                    <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 px-5 py-2.5 rounded-xl transition-colors shadow-sm">List Your Practice</a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-white bg-violet-600 hover:bg-violet-700 px-5 py-2.5 rounded-xl transition-colors">Admin Panel</a>
                    {{-- @elseif(auth()->user()->isFamily())
                        <a href="{{ route('family.dashboard') }}" class="text-sm font-bold text-white bg-sky-600 hover:bg-sky-700 px-5 py-2.5 rounded-xl transition-colors">My Account</a> --}}
                    @else
                        <a href="{{ route('provider.dashboard') }}" class="text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 px-5 py-2.5 rounded-xl transition-colors">My Dashboard</a>
                    @endif
                @endguest
            </div>

            <!-- Mobile toggle -->
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileOpen" x-transition class="lg:hidden border-t border-gray-100 bg-white" style="display:none">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('providers.index') }}" class="flex items-center gap-3 py-3 px-3 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 text-sm">Find Providers</a>
            <a href="{{ route('telehealth') }}" class="flex items-center gap-3 py-3 px-3 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 text-sm">Telehealth</a>
            <a href="{{ route('providers.index', ['available' => 1]) }}" class="flex items-center gap-3 py-3 px-3 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 text-sm">Available Now</a>
            <a href="{{ route('guide') }}" class="flex items-center gap-3 py-3 px-3 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 text-sm">User Guide</a>
            <div class="border-t border-gray-100 pt-2 mt-2 space-y-1">
                @guest
                    <a href="{{ route('login') }}" class="block py-3 px-3 text-gray-700 font-semibold text-sm">Sign In</a>
                    {{-- <a href="{{ route('register.family') }}" class="block py-3 px-3 text-emerald-700 font-bold text-sm">Join as a Family</a> --}}
                    <a href="{{ route('register') }}" class="block py-3 px-3 text-emerald-700 font-bold text-sm">List Your Practice</a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-3 px-3 text-violet-700 font-bold text-sm">Admin Panel</a>
                    {{-- @elseif(auth()->user()->isFamily())
                        <a href="{{ route('family.dashboard') }}" class="block py-3 px-3 text-sky-700 font-bold text-sm">My Account</a> --}}
                    @else
                        <a href="{{ route('provider.dashboard') }}" class="block py-3 px-3 text-emerald-700 font-bold text-sm">My Dashboard</a>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</header>

<!-- Flash Messages -->
@if(session('success'))
    <div class="bg-emerald-50 border-b border-emerald-200 px-4 py-3">
        <div class="max-w-7xl mx-auto flex items-center gap-2.5 text-sm text-emerald-800 font-medium">
            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    </div>
@endif
@if(session('error'))
    <div class="bg-red-50 border-b border-red-200 px-4 py-3">
        <div class="max-w-7xl mx-auto flex items-center gap-2.5 text-sm text-red-800 font-medium">
            <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    </div>
@endif

@yield('content')

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 mt-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-9 h-9 bg-emerald-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" viewBox="0 0 28 28" fill="none">
                            <path d="M14 25C14 25 3 18.5 3 11.5C3 7.91 5.91 5 9.5 5C11.43 5 13.17 5.87 14.35 7.26C14.62 7.57 15.38 7.57 15.65 7.26C16.83 5.87 18.57 5 20.5 5C24.09 5 27 7.91 27 11.5C27 18.5 14 25 14 25Z" fill="white"/>
                            <path d="M11.5 11.5H16.5M14 9V14" stroke="#059669" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-white font-black text-lg tracking-tight">Kids Health Hub</span>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed max-w-xs mb-5">
                    Australia's dedicated directory for paediatric healthcare. Connecting families with trusted speech pathologists, occupational therapists, psychologists and more.
                </p>
                <div class="flex gap-2">
                    <span class="inline-flex items-center gap-1.5 bg-gray-800 text-xs text-gray-400 px-3 py-1.5 rounded-full">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span> Verified providers
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-gray-800 text-xs text-gray-400 px-3 py-1.5 rounded-full">
                        <span class="w-1.5 h-1.5 bg-sky-400 rounded-full"></span> Free for families
                    </span>
                </div>
            </div>
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4">For Families</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('providers.index') }}" class="hover:text-white transition-colors">Find Providers</a></li>
                    <li><a href="{{ route('telehealth') }}" class="hover:text-white transition-colors">Telehealth Services</a></li>
                    <li><a href="{{ route('guide') }}" class="hover:text-white transition-colors">User Guide</a></li>
                    {{-- <li><a href="{{ route('register.family') }}" class="hover:text-white transition-colors">Create Free Account</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Sign In</a></li> --}}
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4">For Providers</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">List Your Practice</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Provider Login</a></li>
                    <li>
                        <span class="text-emerald-400 font-semibold text-xs">3-month free trial</span>
                        <div class="text-gray-500 text-xs mt-0.5">No credit card required</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 pt-6 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-gray-600">
            <span>&copy; {{ date('Y') }} Kids Health Hub. All rights reserved.</span>
            <span>Made for Australian families</span>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
