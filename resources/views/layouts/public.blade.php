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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Caveat:wght@600;700&display=swap" rel="stylesheet">
    @stack('head')
    <style>
        :root {
            --khh-coral: #de6148;
            --khh-soft-gold: #f3ce66;
            --khh-sky: #79a2cc;
            --khh-green: #0dc066;
            --khh-red: #e64738;
            --khh-lime: #98e762;
            --khh-gold: #fcc333;
            --khh-peach: #e78572;
            --khh-sage: #a8cf77;
            --khh-ink: #1f2937;
            --khh-paper: #fffaf3;
        }
        body { font-family: 'Nunito', sans-serif; }
        .font-hand { font-family: 'Caveat', cursive; }
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
        .khh-hero-shell {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(180deg, rgba(255,250,243,0.95) 0%, rgba(255,250,243,1) 100%);
        }
        .khh-hero-stage {
            position: relative;
            min-height: clamp(520px, 66vh, 700px);
            border-radius: 28px;
            overflow: hidden;
            background-color: #f7efe4;
            box-shadow: 0 24px 70px rgba(31, 41, 55, 0.12);
        }
        .khh-hero-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .khh-hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(255,250,243,0.98) 0%, rgba(255,250,243,0.92) 34%, rgba(255,250,243,0.54) 58%, rgba(255,250,243,0.12) 78%, rgba(255,250,243,0.04) 100%);
        }
        .khh-hero-stripes {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            display: grid;
            grid-template-columns: 1.15fr 0.9fr 0.7fr 1fr 0.8fr;
            height: 12px;
        }
        .khh-hero-stripes span:nth-child(1) { background: var(--khh-coral); }
        .khh-hero-stripes span:nth-child(2) { background: var(--khh-gold); }
        .khh-hero-stripes span:nth-child(3) { background: var(--khh-sky); }
        .khh-hero-stripes span:nth-child(4) { background: var(--khh-green); }
        .khh-hero-stripes span:nth-child(5) { background: var(--khh-sage); }
        .khh-hero-panel {
            background: rgba(255, 250, 243, 0.88);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.55);
        }
        .khh-hero-search {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            box-shadow: 0 18px 45px rgba(31, 41, 55, 0.12);
        }
        .khh-speciality-shell {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(180deg, rgba(255,253,247,1) 0%, rgba(255,249,240,1) 100%);
        }
        .khh-speciality-board {
            position: relative;
            border-radius: 30px;
            padding: 1.5rem;
            background:
                linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,250,243,0.98) 100%);
            box-shadow: 0 22px 55px rgba(31, 41, 55, 0.08);
        }
        .khh-speciality-card {
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            box-shadow: 0 14px 30px rgba(31, 41, 55, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .khh-speciality-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 38px rgba(31, 41, 55, 0.12);
        }
        .khh-speciality-card::after {
            content: "";
            position: absolute;
            right: -18px;
            bottom: -18px;
            width: 88px;
            height: 88px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.24);
        }
        .khh-speciality-feature {
            min-height: 100%;
            border-radius: 26px;
            box-shadow: 0 18px 36px rgba(31, 41, 55, 0.08);
        }
        .khh-speciality-grid {
            grid-auto-rows: minmax(0, 1fr);
        }
        .khh-speciality-card-spotlight {
            background:
                linear-gradient(135deg, rgba(255,255,255,0.18) 0%, rgba(255,255,255,0.08) 100%);
            border: 1px solid rgba(255,255,255,0.24);
        }
        @media (max-width: 1023px) {
            .khh-hero-stage {
                min-height: 560px;
                border-radius: 24px;
            }
            .khh-hero-overlay {
                background:
                    linear-gradient(180deg, rgba(255,250,243,0.94) 0%, rgba(255,250,243,0.82) 38%, rgba(255,250,243,0.32) 65%, rgba(255,250,243,0.1) 100%);
            }
            .khh-speciality-board {
                border-radius: 24px;
                padding: 1.1rem;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">
</head>
<body class="antialiased bg-white text-gray-800">

<!-- Top announcement bar -->
<div style="background: linear-gradient(90deg, #de6148, #f3ce66, #0dc066, #79a2cc);" class="text-white text-center text-sm py-2.5 px-4 font-bold tracking-wide shadow-sm">
    Australia's trusted child healthcare directory &mdash; <a href="{{ route('register') }}" class="underline hover:no-underline ml-1">List your practice free →</a>
</div>

<!-- Navigation -->
<header class="bg-white border-b-2 sticky top-0 z-50 shadow-md transition-all duration-300" style="border-bottom-color: #f3ce66;" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-3">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0 transition-transform hover:scale-105">
                @if(file_exists(public_path('images/logo.svg')))
                    <img src="{{ asset('images/logo.svg') }}" alt="Kids Health Hub" class="h-28 w-auto drop-shadow-sm">
                @else
                    <div class="relative w-12 h-12 flex-shrink-0">
                        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="20" fill="#0dc066"/>
                            <path d="M20 30C20 30 9 23 9 15.5C9 12.46 11.46 10 14.5 10C16.17 10 17.67 10.76 18.69 11.96C18.85 12.15 19.15 12.15 19.31 11.96C20.33 10.76 21.83 10 23.5 10C26.54 10 29 12.46 29 15.5C29 23 20 30 20 30Z" fill="white"/>
                            <path d="M17 15.5H23M20 13V18" stroke="#0dc066" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-black text-gray-900 text-lg leading-tight tracking-tight">Kids Health Hub</div>
                        <div class="text-sm font-semibold leading-none" style="color:#de6148;">Child Healthcare Directory</div>
                    </div>
                @endif
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-0.5 xl:gap-2">
                <a href="{{ route('providers.index') }}" class="px-3 py-2 text-sm font-bold text-gray-700 hover:text-white rounded-md transition-all whitespace-nowrap" onmouseover="this.style.backgroundColor='#f3ce66'; this.style.color='#1f2937';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#374151';">Find Providers</a>
                <a href="{{ route('telehealth') }}" class="px-3 py-2 text-sm font-bold text-gray-700 hover:text-white rounded-md transition-all whitespace-nowrap" onmouseover="this.style.backgroundColor='#79a2cc'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#374151';">Telehealth</a>
                <a href="{{ route('providers.index', ['available' => 1]) }}" class="px-3 py-2 text-sm font-bold text-gray-700 hover:text-white rounded-md transition-all whitespace-nowrap" onmouseover="this.style.backgroundColor='#0dc066'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#374151';">Available Now</a>
                <a href="{{ route('community.index') }}" class="px-3 py-2 text-sm font-bold text-gray-700 hover:text-white rounded-md transition-all whitespace-nowrap" onmouseover="this.style.backgroundColor='#a8cf77'; this.style.color='#1f2937';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#374151';">Community</a>
                <a href="{{ route('blog.index') }}" class="px-3 py-2 text-sm font-bold text-gray-700 hover:text-white rounded-md transition-all whitespace-nowrap" onmouseover="this.style.backgroundColor='#e64738'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#374151';">Blog</a>
                <a href="{{ route('about') }}" class="px-3 py-2 text-sm font-bold text-gray-700 hover:text-white rounded-md transition-all whitespace-nowrap" onmouseover="this.style.backgroundColor='#e78572'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#374151';">About</a>
            </nav>

            <!-- Desktop CTAs -->
            <div class="hidden lg:flex items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900 px-3 py-2 transition-colors rounded-full hover:bg-gray-100 whitespace-nowrap">Log In</a>
                    <a href="{{ route('register.family') }}" class="text-sm font-bold border-2 px-4 py-2 rounded-full transition-all whitespace-nowrap" style="color:#79a2cc; border-color:#79a2cc;" onmouseover="this.style.backgroundColor='#79a2cc'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#79a2cc';">Save Providers</a>
                    <a href="{{ route('register') }}" class="text-sm font-bold text-white px-5 py-2.5 rounded-full transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 whitespace-nowrap" style="background-color:#de6148;" onmouseover="this.style.backgroundColor='#e64738';" onmouseout="this.style.backgroundColor='#de6148';">List Your Practice</a>
                @else
                    <div class="relative" x-data="{ userMenuOpen: false }">
                        <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false" class="flex items-center gap-2 text-sm font-bold text-white px-5 py-2.5 rounded-sm transition-all shadow-sm" style="background-color:#1f2937;">
                            <span>{{ auth()->user()->name ?? 'My Account' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="userMenuOpen" x-transition class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-sm shadow-lg py-1 z-50" style="display: none;">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Admin Panel</a>
                            @elseif(auth()->user()->isFamily())
                                <a href="{{ route('family.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                            @else
                                <a href="{{ route('provider.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                            @endif
                            
                            @if(Route::has('profile.edit'))
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile Settings</a>
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 font-bold">Log Out</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile toggle -->
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-sm">
                <svg x-show="!mobileOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileOpen" x-transition class="lg:hidden border-t-2 bg-white" style="border-color:#f3ce66; display:none">
        <div class="px-4 py-4 space-y-2">
            <a href="{{ route('providers.index') }}" class="flex items-center gap-2 py-3 px-4 rounded-sm font-bold text-gray-800" style="background-color:#fffdf7; border-left: 4px solid #f3ce66;">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Find Providers
            </a>
            <a href="{{ route('telehealth') }}" class="flex items-center gap-2 py-3 px-4 rounded-sm font-bold text-gray-800" style="background-color:#f4f8fb; border-left: 4px solid #79a2cc;">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                Telehealth
            </a>
            <a href="{{ route('providers.index', ['available' => 1]) }}" class="flex items-center gap-2 py-3 px-4 rounded-sm font-bold text-gray-800" style="background-color:#f0fcf5; border-left: 4px solid #0dc066;">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Available Now
            </a>
            <a href="{{ route('community.index') }}" class="flex items-center gap-2 py-3 px-4 rounded-sm font-bold text-gray-800" style="background-color:#f8fcf3; border-left: 4px solid #a8cf77;">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Community
            </a>
            <a href="{{ route('blog.index') }}" class="flex items-center gap-2 py-3 px-4 rounded-sm font-bold text-gray-800" style="background-color:#fdf2f1; border-left: 4px solid #e64738;">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Blog
            </a>
            <a href="{{ route('about') }}" class="flex items-center gap-2 py-3 px-4 rounded-sm font-bold text-gray-800" style="background-color:#fdf5f3; border-left: 4px solid #e78572;">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                About
            </a>
            <div class="border-t border-gray-200 pt-4 mt-4 space-y-3">
                @guest
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 py-3 px-4 text-gray-700 font-bold bg-gray-50 hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Log In
                    </a>
                    <a href="{{ route('register.family') }}" class="flex items-center justify-center gap-2 py-3 px-4 font-bold text-white rounded-full text-center shadow-sm transition-colors" style="background-color:#79a2cc;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Save Providers
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 py-3 px-4 font-bold text-white rounded-full text-center shadow-sm transition-colors" style="background-color:#de6148;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        List Your Practice
                    </a>
                @else
                    <div class="mb-2 px-4 text-xs font-black uppercase tracking-widest text-gray-500">Welcome, {{ auth()->user()->name ?? 'User' }}</div>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-3 px-4 text-white font-bold bg-gray-800 rounded-sm text-center">Admin Panel</a>
                    @elseif(auth()->user()->isFamily())
                        <a href="{{ route('family.dashboard') }}" class="block py-3 px-4 font-bold text-white rounded-sm text-center" style="background-color:#79a2cc;">Dashboard</a>
                    @else
                        <a href="{{ route('provider.dashboard') }}" class="block py-3 px-4 font-bold text-white rounded-sm text-center" style="background-color:#0dc066;">Dashboard</a>
                    @endif
                    
                    @if(Route::has('profile.edit'))
                        <a href="{{ route('profile.edit') }}" class="block py-3 px-4 text-gray-700 font-bold bg-gray-50 rounded-sm text-center border">Profile Settings</a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full py-3 px-4 text-red-600 font-bold bg-red-50 rounded-sm text-center border border-red-100 mt-2">Log Out</button>
                    </form>
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
<section style="background:var(--khh-paper); padding:56px 0 64px;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-14" style="background:#fff; border-radius:28px; padding:40px 48px; box-shadow:0 4px 32px rgba(222,97,72,0.07);">

            {{-- Annika photo --}}
            <div class="flex-shrink-0 relative" style="width:200px; height:240px;">
                <div class="absolute inset-0" style="border-radius:20px; background:radial-gradient(ellipse 80% 90% at 50% 50%, rgba(243,206,102,0.32) 0%, rgba(222,97,72,0.12) 50%, transparent 78%); filter:blur(14px);"></div>
                @if(file_exists(public_path('images/annika.png')) || file_exists(public_path('images/annika.jpg')))
                    <div class="absolute inset-0" style="border-radius:20px; background-image:url('{{ asset('images/annika.' . (file_exists(public_path('images/annika.png')) ? 'png' : 'jpg')) }}'); background-size:cover; background-position:top center;"></div>
                @else
                    <div class="absolute inset-0 flex items-center justify-center" style="border-radius:20px; background:linear-gradient(135deg,#fff0ea,#fde9c4);">
                        <span class="font-hand text-3xl" style="color:#de6148;">A</span>
                    </div>
                @endif
            </div>

            {{-- Text content --}}
            <div class="flex-1 min-w-0">
                <p class="text-xs font-black uppercase tracking-[0.18em] mb-2" style="color:#de6148;">Our Story</p>
                <h3 class="text-2xl font-black leading-snug text-gray-900 sm:text-3xl mb-4" style="letter-spacing:-0.01em;">
                    Created from lived clinical<br class="hidden sm:block"> and parent experience.
                </h3>
                <p class="text-base text-gray-600 leading-relaxed mb-6 max-w-xl">
                    Annika Nilsson - paediatric OT and mum - built Kids Health Hub because finding the right support for kids shouldn't feel like a second job. We make access to services
                    <span class="font-bold" style="color:#0dc066;">simpler, faster, and easier to navigate.</span>
                </p>

                {{-- Credential pills --}}
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black" style="background:#fff0ea; color:#de6148;">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Paediatric OT
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black" style="background:#fef9e7; color:#c49a00;">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                        Mum of 2
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black" style="background:#eaf4ff; color:#4a7fb5;">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        10+ Yrs Clinical
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black" style="background:#e8faf1; color:#0a9e52;">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                        Family Advocate
                    </span>
                </div>

                <a href="{{ route('about') }}" class="khh-btn-coral inline-flex items-center gap-2 rounded-full px-6 py-2.5 text-sm font-black text-white shadow-sm">
                    Read Annika's Story
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- Right accent quote --}}
            <div class="hidden xl:flex flex-col items-center justify-center flex-shrink-0" style="width:180px;">
                <div style="background:linear-gradient(135deg,#fff0ea,#fde9c4); border-radius:20px; padding:24px 20px; text-align:center;">
                    <span class="font-hand text-4xl leading-none block mb-2" style="color:#de6148;">"</span>
                    <p class="font-hand text-lg leading-snug" style="color:#8a5a3a;">Every child deserves the right support.</p>
                    <div class="mt-3 flex justify-center gap-1">
                        <span class="inline-block w-2 h-2 rounded-full" style="background:#de6148;"></span>
                        <span class="inline-block w-2 h-2 rounded-full" style="background:#fcc333;"></span>
                        <span class="inline-block w-2 h-2 rounded-full" style="background:#0dc066;"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-gray-300" style="background-color:#1a1a2e;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">

        {{-- Top row: logo + tagline + badges --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">

            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    @if(file_exists(public_path('images/logo.svg')))
                        <img src="{{ asset('images/logo.svg') }}" alt="Kids Health Hub" class="h-12 w-auto">
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
                    Australia's dedicated directory for paediatric healthcare - connecting families with
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
