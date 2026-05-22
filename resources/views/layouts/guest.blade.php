<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kids Health Hub') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">
</head>
<body class="font-sans antialiased">
<div class="min-h-screen flex">

    <!-- Brand panel (left) -->
    <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700 flex-col justify-between p-12 relative overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-white/5 rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-white/5 rounded-full pointer-events-none"></div>
        <div class="absolute top-1/2 right-0 w-72 h-72 bg-white/5 rounded-full translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

        <!-- Logo -->
        <a href="{{ route('home') }}" class="relative flex items-center gap-3 group">
            <div class="w-11 h-11 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7" viewBox="0 0 28 28" fill="none">
                    <path d="M14 25C14 25 3 18.5 3 11.5C3 7.91 5.91 5 9.5 5C11.43 5 13.17 5.87 14.35 7.26C14.62 7.57 15.38 7.57 15.65 7.26C16.83 5.87 18.57 5 20.5 5C24.09 5 27 7.91 27 11.5C27 18.5 14 25 14 25Z" fill="white" fill-opacity="0.95"/>
                    <path d="M11.5 11.5H16.5M14 9V14" stroke="#059669" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="text-white text-xl font-extrabold tracking-tight">Kids Health Hub</span>
        </a>

        <!-- Hero text -->
        <div class="relative">
            <div class="inline-flex items-center gap-2 bg-white/15 text-emerald-50 text-xs font-semibold px-3 py-1.5 rounded-full mb-6 tracking-wide">
                <span class="w-1.5 h-1.5 bg-emerald-300 rounded-full animate-pulse"></span>
                Australia's Child Healthcare Directory
            </div>
            <h2 class="text-white text-4xl font-extrabold leading-tight mb-5">
                Connecting families with trusted child healthcare professionals
            </h2>
            <p class="text-emerald-100 text-lg leading-relaxed mb-10">
                Speech pathologists, occupational therapists, psychologists, and more — all in one trusted place.
            </p>

            <!-- Trust points -->
            <div class="space-y-4">
                @foreach([
                    'Free 3-month trial for providers',
                    'Verified & admin-approved listings only',
                    'Families search and connect for free',
                ] as $point)
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-emerald-50 font-medium text-sm">{{ $point }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Bottom -->
        <p class="relative text-emerald-300 text-sm">&copy; {{ date('Y') }} Kids Health Hub &middot; Supporting Australian families</p>
    </div>

    <!-- Form panel (right) -->
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-slate-50 overflow-y-auto">
        <!-- Mobile logo -->
        <div class="lg:hidden mb-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 justify-center">
                <div class="w-9 h-9 bg-emerald-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 28 28" fill="none">
                        <path d="M14 25C14 25 3 18.5 3 11.5C3 7.91 5.91 5 9.5 5C11.43 5 13.17 5.87 14.35 7.26C14.62 7.57 15.38 7.57 15.65 7.26C16.83 5.87 18.57 5 20.5 5C24.09 5 27 7.91 27 11.5C27 18.5 14 25 14 25Z" fill="white"/>
                        <path d="M11.5 11.5H16.5M14 9V14" stroke="#059669" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-xl font-extrabold text-gray-800">Kids Health Hub</span>
            </a>
        </div>

        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-8 py-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
</body>
</html>
