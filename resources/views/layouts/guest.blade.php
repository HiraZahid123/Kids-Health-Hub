<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kids Health Hub') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Caveat:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">
    <style>
        .font-hand { font-family: 'Caveat', cursive; }
        .guest-left-panel {
            background: linear-gradient(145deg, #de6148 0%, #c94135 45%, #b03428 100%);
        }
        .guest-dot-texture {
            background-image: radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 22px 22px;
        }
    </style>
</head>
<body class="font-sans antialiased" style="font-family:'Nunito',sans-serif;">
<div class="min-h-screen flex">

    <!-- Brand panel (left) -->
    <div class="hidden lg:flex lg:w-5/12 xl:w-[42%] guest-left-panel flex-col justify-between p-12 relative overflow-hidden">

        <!-- Dot texture overlay -->
        <div class="guest-dot-texture absolute inset-0 pointer-events-none opacity-60"></div>

        <!-- Decorative blobs -->
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full pointer-events-none" style="background:rgba(255,255,255,0.06);"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full pointer-events-none" style="background:rgba(255,255,255,0.06);"></div>
        <div class="absolute top-1/2 right-0 w-56 h-56 rounded-full pointer-events-none" style="background:rgba(255,255,255,0.04); transform:translate(40%,-50%);"></div>

        <!-- Logo -->
        <a href="{{ route('home') }}" class="relative flex items-center gap-3">
            @if(file_exists(public_path('images/logo.svg')))
                <img src="{{ asset('images/logo.svg') }}" alt="Kids Health Hub" class="h-16 w-auto drop-shadow-md brightness-[10] opacity-90">
            @else
                <div class="w-11 h-11 flex items-center justify-center rounded-2xl" style="background:rgba(255,255,255,0.22);">
                    <svg class="w-7 h-7" viewBox="0 0 28 28" fill="none">
                        <path d="M14 25C14 25 3 18.5 3 11.5C3 7.91 5.91 5 9.5 5C11.43 5 13.17 5.87 14.35 7.26C14.62 7.57 15.38 7.57 15.65 7.26C16.83 5.87 18.57 5 20.5 5C24.09 5 27 7.91 27 11.5C27 18.5 14 25 14 25Z" fill="white" fill-opacity="0.95"/>
                        <path d="M11.5 11.5H16.5M14 9V14" stroke="#de6148" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            @endif
            <span class="text-white text-xl font-extrabold tracking-tight drop-shadow">Kids Health Hub</span>
        </a>

        <!-- Hero content -->
        <div class="relative">
            <div class="inline-flex items-center gap-2 text-xs font-bold px-3 py-1.5 rounded-full mb-6 tracking-wide" style="background:rgba(255,255,255,0.15); color:rgba(255,255,255,0.9);">
                <span class="w-1.5 h-1.5 rounded-full animate-pulse" style="background:#fcc333;"></span>
                Australia's Child Healthcare Directory
            </div>

            <h2 class="text-white text-4xl font-black leading-tight mb-4" style="letter-spacing:-0.02em;">
                Connecting families with trusted child healthcare professionals
            </h2>

            <p class="font-hand text-2xl mb-8" style="color:rgba(255,255,255,0.82);">
                "One clear place — built for families."
            </p>

            <!-- Trust points -->
            <div class="space-y-3.5">
                @foreach([
                    ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'text'=>'Free 3-month trial for providers'],
                    ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'text'=>'Verified and admin-approved listings only'],
                    ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'text'=>'Families search and connect for free'],
                ] as $point)
                <div class="flex items-center gap-3">
                    <div class="flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full" style="background:rgba(255,255,255,0.18);">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $point['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold" style="color:rgba(255,255,255,0.88);">{{ $point['text'] }}</span>
                </div>
                @endforeach
            </div>

            <!-- Mini stat pills -->
            <div class="mt-10 flex flex-wrap gap-2.5">
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-black" style="background:rgba(255,255,255,0.15); color:#fff;">
                    <span class="h-1.5 w-1.5 rounded-full" style="background:#fcc333;"></span>
                    Speech Pathology
                </span>
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-black" style="background:rgba(255,255,255,0.15); color:#fff;">
                    <span class="h-1.5 w-1.5 rounded-full" style="background:#0dc066;"></span>
                    Occupational Therapy
                </span>
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-black" style="background:rgba(255,255,255,0.15); color:#fff;">
                    <span class="h-1.5 w-1.5 rounded-full" style="background:#79a2cc;"></span>
                    Psychology & more
                </span>
            </div>
        </div>

        <!-- Bottom -->
        <p class="relative text-sm" style="color:rgba(255,255,255,0.50);">&copy; {{ date('Y') }} Kids Health Hub &middot; Supporting Australian families</p>
    </div>

    <!-- Form panel (right) -->
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 overflow-y-auto" style="background:#fffaf3;">

        <!-- Mobile logo -->
        <div class="lg:hidden mb-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 justify-center">
                @if(file_exists(public_path('images/logo.svg')))
                    <img src="{{ asset('images/logo.svg') }}" alt="Kids Health Hub" class="h-12 w-auto">
                @else
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#de6148;">
                        <svg class="w-6 h-6" viewBox="0 0 28 28" fill="none">
                            <path d="M14 25C14 25 3 18.5 3 11.5C3 7.91 5.91 5 9.5 5C11.43 5 13.17 5.87 14.35 7.26C14.62 7.57 15.38 7.57 15.65 7.26C16.83 5.87 18.57 5 20.5 5C24.09 5 27 7.91 27 11.5C27 18.5 14 25 14 25Z" fill="white"/>
                            <path d="M11.5 11.5H16.5M14 9V14" stroke="#de6148" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold text-gray-800">Kids Health Hub</span>
                @endif
            </a>
        </div>

        <div class="w-full max-w-md">
            <div class="bg-white rounded-[24px] shadow-sm px-8 py-8" style="border:2px solid #f3e8e3;">
                {{ $slot }}
            </div>

            <p class="text-center text-xs mt-5" style="color:#b5aca5;">
                <a href="{{ route('home') }}" class="hover:underline" style="color:#de6148;">← Back to Kids Health Hub</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
