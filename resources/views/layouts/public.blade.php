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
            background-color: #f9fef5;
            background-image:
                radial-gradient(circle at 15% 85%, rgba(13,192,102,0.10) 0%, transparent 45%),
                radial-gradient(circle at 85% 15%, rgba(121,162,204,0.10) 0%, transparent 45%),
                radial-gradient(circle at 50% 50%, rgba(252,195,51,0.06) 0%, transparent 60%),
                radial-gradient(circle at 70% 80%, rgba(222,97,72,0.06) 0%, transparent 40%);
        }
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0,0,0,0.10); }
        .khh-btn-primary { background-color: #0dc066; }
        .khh-btn-primary:hover { background-color: #0aad5a; }
        .khh-btn-coral { background-color: #de6148; }
        .khh-btn-coral:hover { background-color: #cc5038; }
        .khh-btn-blue { background-color: #79a2cc; }
        .khh-btn-blue:hover { background-color: #6490bb; }
    </style>
</head>
<body class="antialiased bg-white text-gray-800">

<!-- Top announcement bar -->
<div style="background-color:#0dc066;" class="text-white text-center text-xs py-2 px-4 font-semibold tracking-wide">
    Australia's trusted child healthcare directory &mdash; <a href="{{ route('register') }}" class="underline hover:no-underline ml-1">List your practice free →</a>
</div>

<!-- Navigation -->
<header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Kids Health Hub" class="h-11 w-auto">
                @else
                    <div class="relative w-10 h-10 flex-shrink-0">
                        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="20" fill="#0dc066"/>
                            <path d="M20 30C20 30 9 23 9 15.5C9 12.46 11.46 10 14.5 10C16.17 10 17.67 10.76 18.69 11.96C18.85 12.15 19.15 12.15 19.31 11.96C20.33 10.76 21.83 10 23.5 10C26.54 10 29 12.46 29 15.5C29 23 20 30 20 30Z" fill="white"/>
                            <path d="M17 15.5H23M20 13V18" stroke="#0dc066" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-black text-gray-900 text-base leading-tight tracking-tight">Kids Health Hub</div>
                        <div class="text-xs font-semibold leading-none" style="color:#0dc066;">Child Healthcare Directory</div>
                    </div>
                @endif
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-0.5">
                <a href="{{ route('providers.index') }}" class="px-3 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">Find Providers</a>
                <a href="{{ route('telehealth') }}" class="px-3 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">Telehealth</a>
                <a href="{{ route('providers.index', ['available' => 1]) }}" class="px-3 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">Available Now</a>
                <a href="{{ route('blog.index') }}" class="px-3 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">Blog</a>
                <a href="{{ route('community.index') }}" class="px-3 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">Community</a>
                <a href="{{ route('about') }}" class="px-3 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">About</a>
                <a href="{{ route('guide') }}" class="px-3 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">Help</a>
            </nav>

            <!-- Desktop CTAs -->
            <div class="hidden lg:flex items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 px-3 py-2 transition-colors">Sign in</a>
                    <a href="{{ route('register.family') }}" class="text-sm font-semibold border-2 px-4 py-2 rounded-xl transition-colors" style="color:#79a2cc; border-color:#79a2cc;" onmouseover="this.style.backgroundColor='#f0f6ff'" onmouseout="this.style.backgroundColor='transparent'">Join as Family</a>
                    <a href="{{ route('register') }}" class="text-sm font-bold text-white khh-btn-coral px-5 py-2.5 rounded-xl transition-colors shadow-sm">List Your Practice</a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-white bg-violet-600 hover:bg-violet-700 px-5 py-2.5 rounded-xl transition-colors">Admin Panel</a>
                    @elseif(auth()->user()->isFamily())
                        <a href="{{ route('family.dashboard') }}" class="text-sm font-bold text-white khh-btn-blue px-5 py-2.5 rounded-xl transition-colors">My Account</a>
                    @else
                        <a href="{{ route('provider.dashboard') }}" class="text-sm font-bold text-white khh-btn-primary px-5 py-2.5 rounded-xl transition-colors">My Dashboard</a>
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
            <a href="{{ route('blog.index') }}" class="flex items-center gap-3 py-3 px-3 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 text-sm">Blog</a>
            <a href="{{ route('community.index') }}" class="flex items-center gap-3 py-3 px-3 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 text-sm">Community</a>
            <a href="{{ route('about') }}" class="flex items-center gap-3 py-3 px-3 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 text-sm">About</a>
            <a href="{{ route('guide') }}" class="flex items-center gap-3 py-3 px-3 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 text-sm">Help</a>
            <div class="border-t border-gray-100 pt-2 mt-2 space-y-1">
                @guest
                    <a href="{{ route('login') }}" class="block py-3 px-3 text-gray-700 font-semibold text-sm">Sign In</a>
                    <a href="{{ route('register.family') }}" class="block py-3 px-3 font-bold text-sm" style="color:#79a2cc;">Join as a Family</a>
                    <a href="{{ route('register') }}" class="block py-3 px-3 font-bold text-sm" style="color:#de6148;">List Your Practice</a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-3 px-3 text-violet-700 font-bold text-sm">Admin Panel</a>
                    @elseif(auth()->user()->isFamily())
                        <a href="{{ route('family.dashboard') }}" class="block py-3 px-3 font-bold text-sm" style="color:#79a2cc;">My Account</a>
                    @else
                        <a href="{{ route('provider.dashboard') }}" class="block py-3 px-3 font-bold text-sm" style="color:#0dc066;">My Dashboard</a>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</header>

<!-- Flash Messages -->
@if(session('success'))
    <div class="border-b px-4 py-3" style="background-color:#f0fdf4; border-color:#bbf7d0;">
        <div class="max-w-7xl mx-auto flex items-center gap-2.5 text-sm font-medium" style="color:#166534;">
            <svg class="w-4 h-4 flex-shrink-0" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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

<!-- Founder Story Strip (above footer) -->
<div style="background: linear-gradient(135deg, #fef9ec 0%, #f0fdf4 50%, #eff6ff 100%);" class="border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="flex flex-col lg:flex-row items-center gap-10">

            {{-- Kite / brand illustration --}}
            <div class="flex-shrink-0 flex flex-col items-center">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Kids Health Hub" class="w-40 h-auto drop-shadow-sm">
                @else
                    <div class="w-28 h-28 rounded-full flex items-center justify-center" style="background:linear-gradient(135deg,#98e762,#0dc066);">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                @endif
                <div class="mt-4 flex gap-2">
                    <span class="w-3 h-3 rounded-full" style="background:#de6148;"></span>
                    <span class="w-3 h-3 rounded-full" style="background:#fcc333;"></span>
                    <span class="w-3 h-3 rounded-full" style="background:#0dc066;"></span>
                    <span class="w-3 h-3 rounded-full" style="background:#79a2cc;"></span>
                    <span class="w-3 h-3 rounded-full" style="background:#a8cf77;"></span>
                </div>
            </div>

            {{-- Quote --}}
            <div class="flex-1 max-w-2xl">
                <div class="inline-flex items-center gap-2 mb-4">
                    <span class="text-xs font-black uppercase tracking-widest" style="color:#de6148;">Our Story</span>
                    <span class="flex-1 h-px w-12" style="background:#de6148; opacity:0.3;"></span>
                </div>
                <blockquote class="text-lg sm:text-xl font-semibold text-gray-700 leading-relaxed mb-5">
                    "Kids Health Hub was created by a Speech Pathologist and mum who has experienced
                    firsthand the challenges of attending multiple appointments and navigating the process
                    of finding the right support. My goal is to help close the gap between families and
                    suitable providers by making access to services
                    <span class="font-black" style="color:#0dc066;">simpler, faster, and easier to navigate.</span>"
                </blockquote>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-black text-sm" style="background:linear-gradient(135deg,#de6148,#fcc333);">A</div>
                    <div>
                        <div class="font-black text-gray-900 text-sm">Annika</div>
                        <div class="text-xs text-gray-500">Founder · Speech Pathologist · Mum of three</div>
                    </div>
                    <a href="{{ route('about') }}" class="ml-auto text-sm font-bold hover:underline" style="color:#de6148;">Read our story →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-gray-300" style="background-color:#1a1a2e;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">

        {{-- Top row: logo + tagline + badges --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">

            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="Kids Health Hub" class="h-12 w-auto">
                    @else
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#0dc066;">
                            <svg class="w-5 h-5" viewBox="0 0 28 28" fill="none">
                                <path d="M14 25C14 25 3 18.5 3 11.5C3 7.91 5.91 5 9.5 5C11.43 5 13.17 5.87 14.35 7.26C14.62 7.57 15.38 7.57 15.65 7.26C16.83 5.87 18.57 5 20.5 5C24.09 5 27 7.91 27 11.5C27 18.5 14 25 14 25Z" fill="white"/>
                                <path d="M11.5 11.5H16.5M14 9V14" stroke="#0dc066" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    @endif
                    <span class="text-white font-black text-lg tracking-tight">Kids Health Hub</span>
                </div>
                <p class="text-sm leading-relaxed max-w-xs mb-5" style="color:#9ca3af;">
                    Australia's dedicated directory for paediatric healthcare — connecting families with
                    trusted speech pathologists, occupational therapists, psychologists and more.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-full" style="background:#252540; color:#9ca3af;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background:#0dc066;"></span> Verified providers
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-full" style="background:#252540; color:#9ca3af;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background:#79a2cc;"></span> Free for families
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-full" style="background:#252540; color:#9ca3af;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background:#fcc333;"></span> Made in Australia
                    </span>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4">For Families</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('providers.index') }}" class="hover:text-white transition-colors">Find Providers</a></li>
                    <li><a href="{{ route('telehealth') }}" class="hover:text-white transition-colors">Telehealth Services</a></li>
                    <li><a href="{{ route('community.index') }}" class="hover:text-white transition-colors">Community</a></li>
                    <li><a href="{{ route('guide') }}" class="hover:text-white transition-colors">Help Centre</a></li>
                    <li><a href="{{ route('register.family') }}" class="hover:text-white transition-colors">Create Free Account</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4">For Providers</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">List Your Practice</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Provider Login</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About Us</a></li>
                    <li>
                        <span class="font-semibold text-xs" style="color:#0dc066;">3-month free trial</span>
                        <div class="text-xs mt-0.5" style="color:#6b7280;">No credit card required</div>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Colour bar --}}
        <div class="flex rounded-full overflow-hidden h-1.5 mb-6">
            <div class="flex-1" style="background:#de6148;"></div>
            <div class="flex-1" style="background:#fcc333;"></div>
            <div class="flex-1" style="background:#0dc066;"></div>
            <div class="flex-1" style="background:#79a2cc;"></div>
            <div class="flex-1" style="background:#98e762;"></div>
            <div class="flex-1" style="background:#e78572;"></div>
            <div class="flex-1" style="background:#a8cf77;"></div>
            <div class="flex-1" style="background:#f3ce66;"></div>
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-xs" style="color:#4b5563;">
            <span>&copy; {{ date('Y') }} Kids Health Hub. All rights reserved.</span>
            <span>Made with 💚 for Australian families</span>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
