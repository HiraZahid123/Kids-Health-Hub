<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Kids Health Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">
</head>
<body class="font-sans antialiased bg-slate-50" x-data="{ sidebarOpen: false }">
<div class="min-h-screen flex">

    <!-- Sidebar overlay (mobile) -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-20 md:hidden" style="display:none"></div>

    <!-- Sidebar -->
    <aside class="fixed md:static inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-100 flex flex-col transition-transform duration-300"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

        <!-- Logo -->
        <div class="h-16 flex items-center px-5 border-b border-gray-100 flex-shrink-0">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center group-hover:bg-emerald-600 transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 28 28" fill="none">
                        <path d="M14 25C14 25 3 18.5 3 11.5C3 7.91 5.91 5 9.5 5C11.43 5 13.17 5.87 14.35 7.26C14.62 7.57 15.38 7.57 15.65 7.26C16.83 5.87 18.57 5 20.5 5C24.09 5 27 7.91 27 11.5C27 18.5 14 25 14 25Z" fill="white" fill-opacity="0.95"/>
                        <path d="M11.5 11.5H16.5M14 9V14" stroke="#059669" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-gray-900 font-extrabold text-base tracking-tight">Kids Health Hub</span>
            </a>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
            @section('sidebar-nav')
                <a href="{{ route('admin.dashboard') }}" @class(['flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors', 'bg-violet-50 text-violet-700' => request()->routeIs('admin.dashboard'), 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('admin.dashboard')])>
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.providers.index') }}" @class(['flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors', 'bg-violet-50 text-violet-700' => request()->routeIs('admin.providers.*'), 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('admin.providers.*')])>
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Providers
                </a>
                <a href="{{ route('admin.subscriptions.index') }}" @class(['flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors', 'bg-violet-50 text-violet-700' => request()->routeIs('admin.subscriptions.*'), 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('admin.subscriptions.*')])>
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    Subscriptions
                </a>
                <a href="{{ route('admin.reviews.index') }}" @class(['flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors', 'bg-violet-50 text-violet-700' => request()->routeIs('admin.reviews.*'), 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('admin.reviews.*')])>
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Reviews
                </a>
                <a href="{{ route('admin.blog.index') }}" @class(['flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors', 'bg-violet-50 text-violet-700' => request()->routeIs('admin.blog.*'), 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('admin.blog.*')])>
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Blog
                </a>
                <a href="{{ route('admin.guide') }}" @class(['flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors', 'bg-violet-50 text-violet-700' => request()->routeIs('admin.guide'), 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('admin.guide')])>
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Admin Guide
                </a>
                <div class="border-t border-gray-100 my-2"></div>
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    Public Site
                </a>
            @show
        </nav>

        <!-- User info & logout -->
        <div class="px-3 py-4 border-t border-gray-100">
            <div class="flex items-center gap-3 px-3 py-2 mb-1">
                <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold text-xs">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-semibold text-gray-500 hover:text-red-600 hover:bg-red-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main area -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top bar -->
        <header class="h-16 bg-white border-b border-gray-100 px-4 sm:px-6 flex items-center justify-between flex-shrink-0 sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <!-- Mobile menu toggle -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-lg font-extrabold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="hidden sm:flex items-center gap-1.5 text-xs text-gray-500 hover:text-emerald-600 font-semibold transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Public Site
                </a>
                <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-xs">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
            </div>
        </header>

        <!-- Flash messages -->
        @if(session('success') || session('error') || $errors->any())
        <div class="px-4 sm:px-6 pt-4">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-3 flex items-center gap-2.5 text-sm">
                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-3 flex items-center gap-2.5 text-sm">
                    <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-3 text-sm">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @endif

        <!-- Content -->
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
