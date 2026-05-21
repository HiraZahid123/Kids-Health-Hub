@extends('layouts.public')

@section('title', 'Kids Health Hub — Find Child Healthcare Providers Near You')

@section('content')

<!-- ═══════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════ -->
<section class="hero-pattern py-16 lg:py-24 border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 text-white text-xs font-bold px-4 py-2 rounded-full mb-6 uppercase tracking-widest shadow-sm" style="background:linear-gradient(90deg,#de6148,#fcc333);">
            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
            Australia's Child Healthcare Directory
        </div>

        <!-- Heading -->
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-gray-900 leading-tight mb-5 tracking-tight">
            {{ $heroTitle }}
        </h1>
        <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed mb-10">
            {{ $heroSubtitle }}
        </p>

        <!-- Search bar -->
        <form action="{{ route('providers.index') }}" method="GET" class="max-w-2xl mx-auto mb-8">
            <div class="flex flex-col sm:flex-row gap-0 bg-white border-2 rounded-2xl shadow-lg overflow-hidden transition-colors" style="border-color:#a8cf77;" onfocusin="this.style.borderColor='#0dc066'" onfocusout="this.style.borderColor='#a8cf77'">
                <div class="flex items-center gap-3 flex-1 px-5">
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search"
                        placeholder="Suburb, postcode, or provider name..."
                        class="flex-1 py-4 text-gray-800 placeholder-gray-400 bg-transparent outline-none text-base font-medium border-0 focus:ring-0"
                        value="{{ request('search') }}">
                </div>
                <div class="hidden sm:block w-px my-3" style="background:#d1fae5;"></div>
                <div class="flex items-center px-4 sm:px-3">
                    <select name="category" class="py-4 text-sm text-gray-600 bg-transparent outline-none border-0 focus:ring-0 font-semibold pr-2 cursor-pointer">
                        <option value="">All Services</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="m-2 text-white font-bold px-8 py-3.5 rounded-xl transition-colors text-sm whitespace-nowrap khh-btn-primary">
                    Search
                </button>
            </div>
        </form>

        <!-- Quick links -->
        <div class="flex flex-wrap items-center justify-center gap-2">
            <span class="text-xs text-gray-400 font-semibold uppercase tracking-wide mr-1">Quick search:</span>
            <button id="btn-near-me-home"
                class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-3.5 py-2 rounded-full transition-colors shadow-sm" style="background:#de6148;">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Near Me
            </button>
            <a href="{{ route('providers.index', ['available' => 1]) }}"
               class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-3.5 py-2 rounded-full transition-colors shadow-sm" style="background:#0dc066;">
                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                Available Now
            </a>
            <a href="{{ route('telehealth') }}"
               class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-3.5 py-2 rounded-full transition-colors shadow-sm" style="background:#79a2cc;">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14"/></svg>
                Telehealth
            </a>
            @foreach($categories->take(3) as $cat)
                <a href="{{ route('providers.index', ['category' => $cat->slug]) }}"
                   class="text-xs font-bold bg-white text-gray-700 border border-gray-200 hover:border-gray-300 px-3.5 py-2 rounded-full transition-colors">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
        <p id="geo-status-home" class="text-sm text-gray-500 mt-3 hidden"></p>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     CATEGORY TILES
════════════════════════════════════════════════════ -->
<section class="py-12 border-b border-gray-100" style="background:#fffdf7;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-black text-gray-900">Browse by Speciality</h2>
            <p class="text-gray-500 text-sm mt-1">Find exactly the right type of care for your child</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @php
            $catMeta = [
                'speech-pathology'     => ['icon'=>'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'bg'=>'#fde8e3','color'=>'#de6148','hover_border'=>'#de6148'],
                'occupational-therapy' => ['icon'=>'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z', 'bg'=>'#deedf7','color'=>'#79a2cc','hover_border'=>'#79a2cc'],
                'psychology'           => ['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'bg'=>'#fef9e3','color'=>'#d4a017','hover_border'=>'#fcc333'],
                'physiotherapy'        => ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'bg'=>'#fce8e5','color'=>'#e64738','hover_border'=>'#e64738'],
                'paediatrician'        => ['icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'bg'=>'#e8f5e1','color'=>'#5a9e32','hover_border'=>'#98e762'],
                'autism-assessment'    => ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'bg'=>'#e3f8ee','color'=>'#0dc066','hover_border'=>'#0dc066'],
                'dietetics-nutrition'  => ['icon'=>'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'bg'=>'#fef7e0','color'=>'#c4920a','hover_border'=>'#fcc333'],
                'pbs'                  => ['icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'bg'=>'#fde8f7','color'=>'#c026a0','hover_border'=>'#e879c4'],
                'play-therapy'         => ['icon'=>'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'bg'=>'#fff0e3','color'=>'#de6148','hover_border'=>'#e78572'],
            ];
            $defaultMeta = ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','bg'=>'#e3f8ee','color'=>'#0dc066','hover_border'=>'#0dc066'];
            @endphp
            @foreach($categories as $cat)
            @php $meta = $catMeta[$cat->slug] ?? $defaultMeta; @endphp
            <a href="{{ route('providers.index', ['category' => $cat->slug]) }}"
               class="card-hover group bg-white border-2 border-gray-100 rounded-2xl p-5 text-center transition-all"
               style="--hover-border: {{ $meta['hover_border'] }}"
               onmouseenter="this.style.borderColor='{{ $meta['hover_border'] }}'"
               onmouseleave="this.style.borderColor=''">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3"
                     style="background-color: {{ $meta['bg'] }}">
                    <svg class="w-6 h-6" style="color: {{ $meta['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $meta['icon'] }}"/>
                    </svg>
                </div>
                <p class="text-sm font-bold text-gray-800 leading-tight transition-colors" style="transition:color .2s" onmouseenter="this.style.color='{{ $meta['color'] }}'" onmouseleave="this.style.color=''">{{ $cat->name }}</p>
                <p class="text-xs text-gray-400 mt-1 font-medium">Find providers →</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     MAP SECTION
════════════════════════════════════════════════════ -->
<section class="bg-gray-50 py-12 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-black text-gray-900">Providers Near You</h2>
                <p class="text-gray-500 text-sm mt-1">Click any marker to see details and visit the provider's profile</p>
            </div>
            <a href="{{ route('providers.index') }}"
               class="inline-flex items-center gap-2 bg-white border-2 border-gray-200 hover:border-emerald-300 text-gray-700 hover:text-emerald-700 font-bold px-5 py-2.5 rounded-xl text-sm transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                View all as list
            </a>
        </div>
        <div id="map" class="w-full h-[420px] lg:h-[500px] rounded-2xl overflow-hidden border-2 border-gray-200 bg-gray-100 flex items-center justify-center shadow-sm">
            <div class="text-center text-gray-400">
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                <p class="text-sm font-medium">Loading map…</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     FEATURED PROVIDERS
════════════════════════════════════════════════════ -->
@if($featuredProviders->isNotEmpty())
<section class="bg-white py-12 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-8">
            <div>
                <span class="inline-block bg-amber-100 text-amber-700 text-xs font-black uppercase tracking-widest px-3 py-1 rounded-full mb-2">Featured</span>
                <h2 class="text-2xl font-black text-gray-900">Featured Providers</h2>
            </div>
            <a href="{{ route('providers.index') }}" class="text-sm font-bold text-emerald-600 hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredProviders as $provider)
                @include('public.partials.provider-card', ['provider' => $provider])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ═══════════════════════════════════════════════════
     RECENTLY LISTED
════════════════════════════════════════════════════ -->
<section class="bg-gray-50 py-12 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-8">
            <div>
                <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-black uppercase tracking-widest px-3 py-1 rounded-full mb-2">New listings</span>
                <h2 class="text-2xl font-black text-gray-900">Recently Listed Providers</h2>
            </div>
            <a href="{{ route('providers.index') }}" class="text-sm font-bold text-emerald-600 hover:underline">View all →</a>
        </div>

        @if($recentProviders->isEmpty())
            <div class="bg-white rounded-2xl border-2 border-dashed border-gray-200 py-20 text-center">
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-700 mb-1">No providers listed yet</h3>
                <p class="text-gray-400 text-sm mb-6">Be the first healthcare provider to join the platform</p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-7 py-3 rounded-xl font-bold hover:bg-emerald-700 transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    List Your Practice Free
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($recentProviders as $provider)
                    @include('public.partials.provider-card', ['provider' => $provider])
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     TRUST / HOW IT WORKS
════════════════════════════════════════════════════ -->
<section class="py-14 border-b border-gray-100" style="background:#fffdf7;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-black text-gray-900 mb-2">How Kids Health Hub Works</h2>
            <p class="text-gray-500 text-sm max-w-xl mx-auto">Finding the right healthcare provider for your child has never been easier</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['step'=>'1','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z','bg'=>'#fde8e3','color'=>'#de6148','title'=>'Search the directory','body'=>'Browse verified child healthcare providers by suburb, postcode, or specialty. Filter by telehealth, funding type, age group, and availability.'],
                ['step'=>'2','icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z','bg'=>'#deedf7','color'=>'#79a2cc','title'=>'View provider profiles','body'=>'Read detailed profiles, reviews from other families, and contact information. Save your favourites to a personal shortlist.'],
                ['step'=>'3','icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z','bg'=>'#e3f8ee','color'=>'#0dc066','title'=>'Request an appointment','body'=>'Send appointment requests directly through the platform and communicate with providers via our secure messaging system.'],
            ] as $step)
            <div class="bg-white rounded-2xl border border-gray-100 p-6 card-hover">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0" style="background:{{ $step['bg'] }};">
                        <svg class="w-6 h-6" style="color:{{ $step['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $step['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-black text-sm" style="background:{{ $step['color'] }};">{{ $step['step'] }}</div>
                </div>
                <h3 class="text-base font-black text-gray-900 mb-2">{{ $step['title'] }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $step['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     PROVIDER CTA
════════════════════════════════════════════════════ -->
<section class="py-16" style="background:linear-gradient(135deg,#de6148 0%,#e64738 40%,#fcc333 100%);">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 text-xs font-bold px-4 py-2 rounded-full mb-6 uppercase tracking-widest border" style="background:rgba(255,255,255,0.15); color:white; border-color:rgba(255,255,255,0.3);">
            For Healthcare Professionals
        </div>
        <h2 class="text-3xl lg:text-4xl font-black text-white mb-4 leading-tight">
            Are you a child healthcare provider?
        </h2>
        <p class="text-lg mb-8 max-w-xl mx-auto leading-relaxed" style="color:rgba(255,255,255,0.88);">
            Join Australian families using Kids Health Hub to find trusted practitioners. Start your free 3-month listing today.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('register') }}"
               class="inline-flex items-center justify-center gap-2 bg-white font-black px-8 py-4 rounded-xl transition-colors text-sm shadow-lg hover:bg-orange-50" style="color:#de6148;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                List Your Practice — It's Free
            </a>
            <a href="{{ route('login') }}"
               class="inline-flex items-center justify-center gap-2 font-bold px-8 py-4 rounded-xl transition-colors text-sm border-2 text-white" style="background:rgba(255,255,255,0.15); border-color:rgba(255,255,255,0.4);" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                Sign In
            </a>
        </div>
        <p class="text-xs mt-5" style="color:rgba(255,255,255,0.7);">No credit card &middot; 3-month free trial &middot; Cancel anytime</p>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     WHY KIDS HEALTH HUB (Mission section)
════════════════════════════════════════════════════ -->
<section class="py-16 border-t border-gray-100" style="background:linear-gradient(160deg,#fffdf7 0%,#f0fdf4 40%,#eff6ff 100%);">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 mb-4">
                <span class="w-2 h-2 rounded-full" style="background:#de6148;"></span>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#de6148;">Why Kids Health Hub</span>
                <span class="w-2 h-2 rounded-full" style="background:#de6148;"></span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 leading-tight max-w-2xl mx-auto">
                Families shouldn't have to spend hours searching for the right support
            </h2>
        </div>

        {{-- Two-column layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

            {{-- For Families --}}
            <div class="bg-white rounded-3xl p-8 border-2 shadow-sm" style="border-color:#a8cf77;">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background:#e3f8ee;">
                        <svg class="w-6 h-6" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900">For Families</h3>
                </div>
                <p class="text-gray-600 leading-relaxed mb-5">
                    Kids Health Hub was created to make the process simpler — bringing together paediatric and
                    family-focused professionals in one easy-to-navigate space. Whether you're looking for
                    immediate availability, telehealth options, clinic-based services, or providers with
                    experience in specific areas, Kids Health Hub helps connect you with services that match
                    your child's needs.
                </p>
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        ['#0dc066','Immediate availability'],
                        ['#79a2cc','Telehealth options'],
                        ['#de6148','Specific expertise'],
                        ['#fcc333','Your local area'],
                    ] as [$c,$t])
                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-700">
                        <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $c }};"></span>
                        {{ $t }}
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- For Providers --}}
            <div class="bg-white rounded-3xl p-8 border-2 shadow-sm" style="border-color:#e78572;">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background:#fde8e3;">
                        <svg class="w-6 h-6" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900">For Providers</h3>
                </div>
                <p class="text-gray-600 leading-relaxed mb-5">
                    Kids Health Hub offers a practical way to increase visibility, highlight key service
                    information, and connect with families actively seeking support. Listings can showcase
                    your areas of expertise, service delivery options, age groups supported, waitlist
                    timeframes, locations, and more — helping families make informed decisions faster.
                </p>
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        ['#de6148','Areas of expertise'],
                        ['#fcc333','Service delivery'],
                        ['#79a2cc','Age groups'],
                        ['#a8cf77','Waitlist info'],
                    ] as [$c,$t])
                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-700">
                        <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $c }};"></span>
                        {{ $t }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bottom mission strip --}}
        <div class="rounded-3xl p-8 text-center" style="background:linear-gradient(135deg,#fde8e3,#fef9e3,#e3f8ee,#deedf7);">
            <div class="max-w-3xl mx-auto">
                <div class="text-4xl mb-4">💚</div>
                <p class="text-lg sm:text-xl font-black text-gray-800 leading-relaxed mb-2">
                    Kids Health Hub is more than a directory.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    It's a platform focused on improving access, supporting informed choices, and helping
                    families feel <strong>less alone</strong> while navigating their child's health and developmental journey.
                    Built by a Speech Pathologist and mum who understands firsthand how exhausting and overwhelming
                    the search for suitable support can feel.
                </p>
                <div class="flex justify-center gap-3 mt-6 flex-wrap">
                    <a href="{{ route('about') }}" class="text-white font-bold px-6 py-3 rounded-xl text-sm transition-colors khh-btn-coral">Read Annika's Story</a>
                    <a href="{{ route('providers.index') }}" class="font-bold px-6 py-3 rounded-xl text-sm transition-colors border-2" style="color:#0dc066; border-color:#0dc066; background:white;" onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='white'">Find a Provider</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&callback=initMap" async defer></script>
<script>
document.getElementById('btn-near-me-home').addEventListener('click', () => {
    const status = document.getElementById('geo-status-home');
    if (!navigator.geolocation) { status.textContent = 'Geolocation not supported.'; status.classList.remove('hidden'); return; }
    status.textContent = 'Detecting your location…'; status.classList.remove('hidden');
    navigator.geolocation.getCurrentPosition(
        (pos) => {
            const url = new URL('{{ route("providers.index") }}');
            url.searchParams.set('lat', pos.coords.latitude);
            url.searchParams.set('lng', pos.coords.longitude);
            url.searchParams.set('radius', 25);
            window.location.href = url.toString();
        },
        () => { status.textContent = 'Location access denied. Please allow location in your browser settings.'; }
    );
});

async function initMap() {
    const mapEl = document.getElementById('map');
    if (!mapEl) return;
    mapEl.innerHTML = '';
    const map = new google.maps.Map(mapEl, {
        center: { lat: -25.2744, lng: 133.7751 },
        zoom: 5,
        styles: [
            { featureType: 'poi', elementType: 'labels', stylers: [{ visibility: 'off' }] },
            { featureType: 'transit', stylers: [{ visibility: 'off' }] },
            { featureType: 'road.arterial', elementType: 'labels.icon', stylers: [{ visibility: 'off' }] },
        ],
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: true,
    });
    try {
        const res = await fetch('{{ route("api.providers") }}');
        const providers = await res.json();
        const bounds = new google.maps.LatLngBounds();
        let hasMarkers = false;
        providers.forEach(p => {
            if (!p.latitude || !p.longitude) return;
            hasMarkers = true;
            const pos = { lat: p.latitude, lng: p.longitude };
            bounds.extend(pos);
            const marker = new google.maps.Marker({
                position: pos, map,
                title: p.business_name,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 10,
                    fillColor: p.availability_status ? '#10b981' : '#3b82f6',
                    fillOpacity: 1,
                    strokeColor: '#ffffff',
                    strokeWeight: 2.5,
                },
            });
            const info = new google.maps.InfoWindow({
                content: `<div style="font-family:'Nunito',sans-serif;max-width:210px;padding:4px 0">
                    <strong style="font-size:13px;color:#111827;display:block;margin-bottom:2px">${p.business_name}</strong>
                    <span style="font-size:11px;color:#6b7280">${p.categories.join(', ')}</span><br>
                    <span style="font-size:11px;color:#374151">${p.suburb || ''}${p.state ? ', '+p.state : ''}</span><br>
                    <div style="margin-top:6px;display:flex;gap:6px;align-items:center">
                        ${p.availability_status ? '<span style="color:#10b981;font-size:11px;font-weight:700">● Available</span>' : ''}
                        ${p.telehealth_available ? '<span style="color:#3b82f6;font-size:11px">📱 Telehealth</span>' : ''}
                    </div>
                    <a href="${p.url}" style="display:inline-block;margin-top:8px;color:#059669;font-size:12px;font-weight:700;text-decoration:none">View Profile →</a>
                </div>`
            });
            marker.addListener('click', () => info.open(map, marker));
        });
        if (hasMarkers) map.fitBounds(bounds);
    } catch(e) { console.error('Map error:', e); }
}
</script>
@endpush
