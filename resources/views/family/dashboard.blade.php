@extends('layouts.dashboard')

@section('title', 'My Family Dashboard')
@section('page-title', 'My Dashboard')

@section('sidebar-nav')
    <a href="{{ route('family.dashboard') }}" @class([
        'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors',
        'bg-sky-50 text-sky-700' => request()->routeIs('family.dashboard'),
        'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('family.dashboard'),
    ])>
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>

    <a href="{{ route('providers.index') }}" @class([
        'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors',
        'text-gray-600 hover:bg-gray-50 hover:text-gray-800',
    ])>
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        Find Providers
    </a>

    <a href="{{ route('family.saved') }}" @class([
        'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors',
        'bg-sky-50 text-sky-700' => request()->routeIs('family.saved'),
        'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('family.saved'),
    ])>
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        Saved Providers
    </a>

    <a href="{{ route('family.appointments.index') }}" @class([
        'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors',
        'bg-sky-50 text-sky-700' => request()->routeIs('family.appointments.*'),
        'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('family.appointments.*'),
    ])>
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        My Appointments
    </a>

    <a href="{{ route('family.messages.index') }}" @class([
        'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors',
        'bg-sky-50 text-sky-700' => request()->routeIs('family.messages.*'),
        'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !request()->routeIs('family.messages.*'),
    ])>
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Messages
        @if($unreadMessageCount > 0)
            <span class="ml-auto bg-sky-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full min-w-[20px] text-center">{{ $unreadMessageCount }}</span>
        @endif
    </a>

    <div class="border-t border-gray-100 my-2"></div>

    <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
        Public Site
    </a>
@endsection

@section('content')

<!-- Welcome banner -->
<div class="bg-gradient-to-r from-sky-500 via-sky-500 to-teal-500 rounded-2xl p-7 mb-6 text-white relative overflow-hidden">
    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full pointer-events-none"></div>
    <div class="absolute -right-5 bottom-0 w-24 h-24 bg-white/5 rounded-full pointer-events-none"></div>
    <div class="relative">
        <p class="text-sky-100 text-sm font-semibold mb-1">Welcome back</p>
        <h2 class="text-2xl font-black mb-1">{{ $user->name }}</h2>
        <p class="text-sky-100 text-sm leading-relaxed max-w-lg">Find trusted child healthcare providers near you, save your favourites, and manage appointments — all in one place.</p>
    </div>
</div>

<!-- Quick action cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <a href="{{ route('providers.index') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all group">
        <div class="w-10 h-10 bg-sky-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-sky-100 transition-colors">
            <svg class="w-5 h-5 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <p class="font-extrabold text-gray-800 text-sm group-hover:text-sky-600 transition-colors">Find Providers</p>
        <p class="text-xs text-gray-400 mt-0.5">Search the directory</p>
    </a>

    <a href="{{ route('family.saved') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all group">
        <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-rose-100 transition-colors">
            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        </div>
        <p class="font-extrabold text-gray-800 text-sm group-hover:text-sky-600 transition-colors">Saved Providers</p>
        <p class="text-xs text-gray-400 mt-0.5">{{ $savedCount > 0 ? $savedCount . ' saved' : 'Your shortlist' }}</p>
    </a>

    <a href="{{ route('family.appointments.index') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all group">
        <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-100 transition-colors">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <p class="font-extrabold text-gray-800 text-sm group-hover:text-sky-600 transition-colors">Appointments</p>
        <p class="text-xs text-gray-400 mt-0.5">{{ $appointmentCount > 0 ? $appointmentCount . ' request' . ($appointmentCount !== 1 ? 's' : '') : 'Requests & bookings' }}</p>
    </a>

    <a href="{{ route('family.messages.index') }}" class="bg-white rounded-2xl border {{ $unreadMessageCount > 0 ? 'border-sky-200 shadow-md' : 'border-gray-100 shadow-sm' }} p-5 hover:shadow-md hover:-translate-y-0.5 transition-all group relative">
        <div class="w-10 h-10 bg-violet-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-violet-100 transition-colors">
            <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
        @if($unreadMessageCount > 0)
            <span class="absolute top-4 right-4 bg-sky-500 text-white text-xs font-black px-1.5 py-0.5 rounded-full">{{ $unreadMessageCount }}</span>
        @endif
        <p class="font-extrabold text-gray-800 text-sm group-hover:text-sky-600 transition-colors">Messages</p>
        <p class="text-xs text-gray-400 mt-0.5">{{ $unreadMessageCount > 0 ? $unreadMessageCount . ' unread' : 'Chat with providers' }}</p>
    </a>
</div>

<!-- Getting started guide -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
    <h3 class="font-extrabold text-gray-900 text-base mb-5">Getting started</h3>
    <div class="space-y-4">
        @foreach([
            ['step' => '1', 'title' => 'Search for providers', 'desc' => 'Use the <a href="' . route('providers.index') . '" class="text-sky-600 font-semibold hover:underline">provider directory</a> to find speech pathologists, OTs, psychologists and more near you.'],
            ['step' => '2', 'title' => 'Save your favourites', 'desc' => 'Click the heart icon on any provider card or profile to save them to your shortlist.'],
            ['step' => '3', 'title' => 'Request an appointment', 'desc' => 'Send an appointment request directly to any provider from their profile page and track its status here.'],
        ] as $item)
        <div class="flex items-start gap-4">
            <div class="w-7 h-7 bg-sky-500 text-white rounded-full flex items-center justify-center text-xs font-black flex-shrink-0 mt-0.5">{{ $item['step'] }}</div>
            <div>
                <p class="text-sm font-bold text-gray-800">{{ $item['title'] }}</p>
                <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">{!! $item['desc'] !!}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
