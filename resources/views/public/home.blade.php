@extends('layouts.public')

@section('title', 'Kids Health Hub — Find Child Healthcare Providers Near You')

@section('content')

<!-- ═══════════════════════════════════════════════════
     HERO — asymmetric, warm, human
════════════════════════════════════════════════════ -->
<section class="khh-hero-shell pt-6 pb-0 lg:pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="khh-hero-stage">
            @if(file_exists(public_path('images/hero.jpg')) || file_exists(public_path('images/hero.png')))
                <img
                    src="{{ asset('images/hero.'.(file_exists(public_path('images/hero.jpg')) ? 'jpg' : 'png')) }}"
                    alt="Children playing outside Kids Health Hub"
                    class="khh-hero-image"
                >
            @endif

            <div class="khh-hero-overlay"></div>

            <div class="relative z-10 flex h-full min-h-[inherit] flex-col justify-between p-4 sm:p-6 lg:p-8">
                <div class="grid gap-6 lg:grid-cols-[minmax(0,1.04fr)_300px] lg:items-start">
                    <div class="max-w-2xl pt-1 lg:pt-4">
<div class="mb-3 flex items-center gap-4">
                            @if(file_exists(public_path('images/logo.svg')))
                                <img src="{{ asset('images/logo.svg') }}" alt="Kids Health Hub logo" class="h-14 w-auto sm:h-16">
                            @endif
                            <div class="hidden h-12 w-px bg-white/70 sm:block"></div>
                            <p class="hidden max-w-[15rem] text-sm font-bold uppercase tracking-[0.16em] text-gray-700 sm:block">
                                Australian wide family health care directory
                            </p>
                        </div>

                        <h1 class="max-w-3xl text-4xl font-black leading-[1.02] text-gray-900 sm:text-5xl lg:text-[3.45rem]">
                            {{ $heroTitle }}
                        </h1>
                        <p class="mt-4 max-w-xl text-sm leading-6 text-gray-700 sm:text-base sm:leading-7">
                            {{ $heroSubtitle }}
                        </p>

                        <div class="mt-5 flex flex-wrap gap-3">
                            <button id="btn-near-me-home" class="inline-flex items-center gap-2 rounded-full px-4 py-2.5 text-sm font-black text-white shadow-md transition-colors khh-btn-coral">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Search Near Me
                            </button>
                            <a href="{{ route('providers.index', ['available' => 1]) }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2.5 text-sm font-black text-white shadow-sm transition-colors" style="background:#0dc066;">
                                <span class="h-2 w-2 rounded-full bg-white"></span>
                                Available Now
                            </a>
                            <a href="{{ route('telehealth') }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2.5 text-sm font-black text-white shadow-sm transition-colors khh-btn-blue">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14"/></svg>
                                Telehealth
                            </a>
                        </div>
                        <p id="geo-status-home" class="mt-3 hidden text-sm text-gray-600"></p>
                    </div>

                    <div class="self-start lg:justify-self-end">
                        <div class="khh-hero-panel max-w-sm rounded-[26px] p-4 shadow-lg">
                            <div class="mb-3 flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:var(--khh-coral);">Why Families Start Here</p>
                                    <h2 class="mt-2 text-xl font-black text-gray-900">Clear options, less overwhelm</h2>
                                </div>
                                <div class="hidden h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl sm:flex" style="background:rgba(121,162,204,0.14); color:var(--khh-sky);">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                            </div>

                            <div class="space-y-2.5">
                                <div class="flex items-start gap-3 rounded-2xl px-4 py-3" style="background:rgba(255,255,255,0.72);">
                                    <span class="mt-1 h-2.5 w-2.5 flex-shrink-0 rounded-full" style="background:var(--khh-green);"></span>
                                    <div>
                                        <p class="text-sm font-black text-gray-900">Verified local providers</p>
                                        <p class="mt-1 text-xs sm:text-sm leading-5 text-gray-600">Speech, OT, psychology, paediatrics and more in one place.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 rounded-2xl px-4 py-3" style="background:rgba(255,255,255,0.72);">
                                    <span class="mt-1 h-2.5 w-2.5 flex-shrink-0 rounded-full" style="background:var(--khh-gold);"></span>
                                    <div>
                                        <p class="text-sm font-black text-gray-900">Filters that reflect real needs</p>
                                        <p class="mt-1 text-xs sm:text-sm leading-5 text-gray-600">Search by area, telehealth, availability and service type without guesswork.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 rounded-2xl px-4 py-3" style="background:rgba(255,255,255,0.72);">
                                    <span class="mt-1 h-2.5 w-2.5 flex-shrink-0 rounded-full" style="background:var(--khh-coral);"></span>
                                    <div>
                                        <p class="text-sm font-black text-gray-900">Built for families, not just listings</p>
                                        <p class="mt-1 text-xs sm:text-sm leading-5 text-gray-600">Our goal is to reduce the time and effort spent searching for health services.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative z-20 mt-6 lg:mt-7">
                    <form action="{{ route('providers.index') }}" method="GET" class="khh-hero-search rounded-[26px] border border-white/80 p-2.5 sm:p-3">
                        <div class="grid gap-3 lg:grid-cols-[minmax(0,1.5fr)_240px_200px]">
                            <label class="flex items-center gap-3 rounded-2xl bg-white px-4 py-3">
                                <svg class="h-5 w-5 flex-shrink-0" style="color:var(--khh-sage);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Suburb, postcode, or provider name"
                                    class="w-full border-0 bg-transparent p-0 text-base font-semibold text-gray-800 placeholder:text-gray-400 focus:ring-0"
                                    value="{{ request('search') }}"
                                >
                            </label>

                            <label class="flex items-center gap-3 rounded-2xl bg-white px-4 py-3">
                                <svg class="h-5 w-5 flex-shrink-0" style="color:var(--khh-sky);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <select name="category" class="w-full cursor-pointer border-0 bg-transparent p-0 text-sm font-bold text-gray-700 focus:ring-0">
                                    <option value="">All Services</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <button type="submit" class="inline-flex items-center justify-center rounded-2xl px-6 py-3 text-sm font-black text-white shadow-md transition-colors khh-btn-primary">
                                Find a Provider
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="khh-hero-stripes" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <svg viewBox="0 0 1440 56" preserveAspectRatio="none" style="display:block;width:100%;height:48px;margin-top:24px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,28 C240,56 480,0 720,28 C960,56 1200,0 1440,28 L1440,56 L0,56 Z" fill="#fffdf7"/>
    </svg>
</section>
<section class="khh-speciality-shell pb-12 pt-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="khh-speciality-board">
            <div class="mb-6 grid gap-4 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
                <div class="max-w-2xl">
                    <p class="font-hand text-2xl mb-1.5" style="color:#79a2cc;">find the right support</p>
                    <h2 class="text-3xl sm:text-[2.6rem] font-black text-gray-900 leading-tight">Browse by Speciality</h2>
                    <p class="mt-2 max-w-xl text-sm sm:text-base leading-6 text-gray-600">
                        A quicker way to spot the kind of care you need without scrolling through a generic grid.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-black text-gray-700" style="background:rgba(243,206,102,0.26);">
                        <span class="h-2 w-2 rounded-full" style="background:#fcc333;"></span>
                        Practical filters
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-black text-gray-700" style="background:rgba(13,192,102,0.16);">
                        <span class="h-2 w-2 rounded-full" style="background:#0dc066;"></span>
                        Family-focused care
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-black text-gray-700" style="background:rgba(121,162,204,0.16);">
                        <span class="h-2 w-2 rounded-full" style="background:#79a2cc;"></span>
                        Local and telehealth
                    </span>
                </div>
            </div>
        @php
        $catMeta = [
            'speech-pathology'     => ['icon'=>'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'bg'=>'#fde8e3','color'=>'#de6148', 'note'=>'Supporting children to communicate with confidence through speech, language, literacy, stuttering, voice and feeding services.'],
            'occupational-therapy' => ['icon'=>'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z', 'bg'=>'#deedf7','color'=>'#79a2cc', 'note'=>'Helping children participate, learn and thrive through support with sensory needs, emotional regulation, fine motor skills, self-care and everyday activities.'],
            'psychology'           => ['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'bg'=>'#fef9e3','color'=>'#c4920a', 'note'=>'Supporting children and families with emotional wellbeing, behaviour, anxiety, confidence, friendships and life challenges.'],
            'physiotherapy'        => ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'bg'=>'#fce8e5','color'=>'#e64738', 'note'=>'Helping children build strength, coordination, balance and movement skills to support participation in everyday activities, play and sport.'],
            'paediatrician'        => ['icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'bg'=>'#e8f5e1','color'=>'#5a9e32', 'note'=>'Providing medical care and developmental support for children, including assessments, diagnoses, treatment planning and ongoing health management.'],
            'autism-assessment'    => ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'bg'=>'#e3f8ee','color'=>'#0dc066', 'note'=>'Assessment pathways and next steps'],
            'dietetics-nutrition'  => ['icon'=>'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'bg'=>'#fef7e0','color'=>'#c4920a', 'note'=>'Supporting children with nutrition, feeding challenges, growth and healthy eating to help them thrive.'],
            'pbs-providers'        => ['icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'bg'=>'#f5e3f7','color'=>'#a020b0', 'note'=>'Supporting children and families to understand behaviours, build new skills and create positive outcomes at home, school and in the community.'],
            'play-therapy'         => ['icon'=>'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'bg'=>'#fff0e3','color'=>'#de6148', 'note'=>'Helping children navigate big emotions, life changes, anxiety, trauma and social challenges in a safe and supportive environment.'],
            'support-workers'      => ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'bg'=>'#edf5ff','color'=>'#4a7fb5', 'note'=>'Helping children build confidence, independence and life skills while supporting participation at home, school and in the community.'],
        ];
        $defaultMeta = ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','bg'=>'#e3f8ee','color'=>'#0dc066', 'note'=>'Trusted family-centred support'];
        $categories = $categories->sortBy(fn($c) => $c->slug === 'support-workers' ? 1 : 0)->values();
        $featureCat = $categories->first();
        $remainingCategories = $categories->slice(1);
        @endphp
        <div class="grid gap-4 lg:grid-cols-[minmax(0,1.02fr)_minmax(0,1.48fr)]">
            @if($featureCat)
                @php $featureMeta = $catMeta[$featureCat->slug] ?? $defaultMeta; @endphp
                <a href="{{ route('providers.index', ['category' => $featureCat->slug]) }}"
                   class="khh-speciality-feature flex flex-col justify-between overflow-hidden p-6 text-left"
                   style="background:linear-gradient(135deg, {{ $featureMeta['color'] }} 0%, {{ $featureMeta['bg'] }} 100%);">
                    <div class="khh-speciality-card-spotlight relative -m-1 rounded-[24px] p-5">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white/80">
                            <svg class="w-7 h-7" style="color:{{ $featureMeta['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $featureMeta['icon'] }}"/>
                            </svg>
                        </div>
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-white/90">Featured speciality</p>
                        <h3 class="mt-3 text-3xl font-black leading-tight text-white">{{ $featureCat->name }}</h3>
                        <p class="mt-3 max-w-sm text-sm leading-6 text-white/88">
                            {{ $featureMeta['note'] }} with provider profiles families can actually compare.
                        </p>
                        <div class="mt-5 space-y-2 text-sm font-semibold text-white/88">
                            <div class="flex items-center gap-2">
                                <span class="h-2.5 w-2.5 rounded-full bg-white"></span>
                                Local listings and telehealth options
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-2.5 w-2.5 rounded-full bg-white"></span>
                                Filters built for real family needs
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 flex items-end justify-between gap-4">
                        <span class="inline-flex items-center rounded-full bg-white px-4 py-2 text-sm font-black" style="color:{{ $featureMeta['color'] }};">
                            Explore
                        </span>
                        <div class="hidden text-right lg:block">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-white/75">Start Here</p>
                            <p class="mt-1 text-sm text-white/82">Best first stop for focused searching</p>
                        </div>
                    </div>
                </a>
            @endif

            <div class="khh-speciality-grid grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($remainingCategories as $cat)
                    @php $meta = $catMeta[$cat->slug] ?? $defaultMeta; @endphp
                    <a href="{{ route('providers.index', ['category' => $cat->slug]) }}"
                       class="khh-speciality-card group flex min-h-[172px] flex-col justify-between p-5"
                       style="background:{{ $meta['bg'] }};">
                        <div class="relative z-10">
                            <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-2xl bg-white/80">
                                <svg class="w-5 h-5" style="color:{{ $meta['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $meta['icon'] }}"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-black leading-tight text-gray-900">{{ $cat->name }}</h3>
                            <p class="mt-2 text-sm leading-5 text-gray-600">{{ $meta['note'] }}</p>
                        </div>
                        <div class="relative z-10 mt-4 inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.14em]" style="color:{{ $meta['color'] }}">
                                View providers
                                <span aria-hidden="true">&rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        </div>
    </div>

    {{-- Wave down into map --}}
    <svg viewBox="0 0 1440 48" preserveAspectRatio="none" style="display:block;width:100%;height:40px;margin-top:32px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,24 C360,48 1080,0 1440,24 L1440,48 L0,48 Z" fill="#fffaf3"/>
    </svg>
</section>
<!-- ═══════════════════════════════════════════════════
     MAP SECTION
════════════════════════════════════════════════════ -->
<section style="background:var(--khh-paper); padding-bottom:56px; padding-top:8px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black mb-2" style="background:#e8faf1; color:#0a9e52;">
                    <span class="h-1.5 w-1.5 rounded-full" style="background:#0dc066;"></span>
                    Explore the map
                </span>
                <h2 class="text-3xl font-black text-gray-900">Providers Near You</h2>
                <p class="text-gray-500 text-sm mt-1">Click any marker to see details and visit the provider's profile</p>
            </div>
            <a href="{{ route('providers.index') }}" class="inline-flex items-center gap-2 font-bold px-5 py-2.5 rounded-xl text-sm transition-colors flex-shrink-0" style="background:#fff; border:2px solid #e5e7eb; color:#374151; box-shadow:0 1px 6px rgba(0,0,0,0.06);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                View all as list
            </a>
        </div>
        <div id="map" class="w-full h-[420px] lg:h-[480px] overflow-hidden bg-gray-100 flex items-center justify-center" style="border-radius:28px; border:3px solid #fff; box-shadow:0 8px 36px rgba(0,0,0,0.09);">
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
<section style="background:var(--khh-paper); padding-top:48px; padding-bottom:48px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-8">
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black mb-2" style="background:#fef9e7; color:#c49a00;">
                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Handpicked for you
                </span>
                <h2 class="text-3xl font-black text-gray-900">Featured Providers</h2>
                <p class="mt-1 text-sm text-gray-500">Trusted practitioners recommended by our team</p>
            </div>
            <a href="{{ route('providers.index') }}" class="inline-flex items-center gap-1.5 text-sm font-black rounded-full px-4 py-2 transition-colors" style="background:#e8faf1; color:#0a9e52;">
                View all
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
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
<section style="background:var(--khh-paper); padding:56px 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-8">
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black mb-2" style="background:#edf6e0; color:#5a8a1a;">
                    <span class="h-1.5 w-1.5 rounded-full" style="background:#a8cf77;"></span>
                    Just joined
                </span>
                <h2 class="text-3xl font-black text-gray-900">Recently Listed Providers</h2>
                <p class="mt-1 text-sm text-gray-500">Fresh additions to the Kids Health Hub directory</p>
            </div>
            <a href="{{ route('providers.index') }}" class="inline-flex items-center gap-1.5 text-sm font-black rounded-full px-4 py-2 transition-colors" style="background:#e8faf1; color:#0a9e52;">
                View all
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        @if($recentProviders->isEmpty())
            <div class="rounded-[28px] py-20 text-center" style="background:#fff; border:2px dashed #e0d9d0;">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:#e3f8ee;">
                    <svg class="w-8 h-8" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-black text-gray-700 mb-1">No providers listed yet</h3>
                <p class="text-gray-400 text-sm mb-6">Be the first healthcare provider to join the platform</p>
                <a href="{{ route('register') }}" class="khh-btn-primary inline-flex items-center gap-2 text-white px-7 py-3 rounded-xl font-bold text-sm">
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
     HOW IT WORKS
════════════════════════════════════════════════════ -->
<section style="background:var(--khh-paper); padding:64px 0 0;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black mb-3" style="background:#fff0ea; color:#de6148;">
                Three easy steps
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900">How Kids Health Hub Works</h2>
            <p class="mt-3 text-base text-gray-500 max-w-md mx-auto">From search to support - simple, fast, and free for families</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['num'=>'1','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z','bg'=>'#fde8e3','color'=>'#de6148','title'=>'Search the directory','body'=>'Browse verified providers by suburb, postcode, or specialty. Filter by telehealth, funding type, age group, and availability in seconds.'],
                ['num'=>'2','icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z','bg'=>'#deedf7','color'=>'#79a2cc','title'=>'View provider profiles','body'=>'Read detailed profiles with service info, age groups, wait times, and delivery options - everything you need to compare confidently.'],
                ['num'=>'3','icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z','bg'=>'#e3f8ee','color'=>'#0dc066','title'=>'Connect with a provider','body'=>'Use the provider\'s contact details to get in touch directly. No middleman - just a clear path to the support your child needs.'],
            ] as $step)
            <div class="relative overflow-hidden rounded-[24px] p-8 flex flex-col" style="background:{{ $step['bg'] }};">
                {{-- Ghost number --}}
                <span class="font-hand absolute -right-1 -top-3 text-9xl font-black leading-none select-none pointer-events-none" style="color:{{ $step['color'] }}; opacity:0.10;">{{ $step['num'] }}</span>
                {{-- Icon --}}
                <div class="relative z-10 mb-5 flex h-12 w-12 items-center justify-center rounded-2xl" style="background:rgba(255,255,255,0.75);">
                    <svg class="w-6 h-6" style="color:{{ $step['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $step['icon'] }}"/></svg>
                </div>
                <div class="relative z-10 flex-1">
                    <h3 class="font-black text-gray-900 text-lg mb-2">{{ $step['title'] }}</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $step['body'] }}</p>
                </div>
                <div class="relative z-10 mt-6">
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black text-white" style="background:{{ $step['color'] }};">
                        Step {{ $step['num'] }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Wave into CTA --}}
    <svg viewBox="0 0 1440 56" preserveAspectRatio="none" style="display:block;width:100%;height:48px;margin-top:56px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 C240,56 720,0 1440,28 L1440,56 L0,56 Z" fill="#de6148"/>
    </svg>
</section>

<!-- ═══════════════════════════════════════════════════
     PROVIDER CTA
════════════════════════════════════════════════════ -->
<section class="relative overflow-hidden" style="background:linear-gradient(130deg,#de6148 0%,#c94135 60%,#b83a2e 100%); min-height:500px;">

    {{-- Dot texture --}}
    <div class="pointer-events-none absolute inset-0 opacity-[0.05]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px); background-size:20px 20px;"></div>

    <div class="relative z-10 max-w-7xl mx-auto lg:grid lg:grid-cols-[minmax(0,1.15fr)_minmax(0,0.85fr)]" style="min-height:500px;">

        {{-- LEFT — text content --}}
        <div class="flex flex-col justify-center px-8 py-16 sm:px-12 lg:px-16 lg:py-20">

            <span class="mb-4 inline-flex w-fit items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black" style="background:rgba(255,255,255,0.18); color:#fff;">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                For Providers
            </span>

            <h2 class="font-black text-white leading-tight mb-4" style="font-size:clamp(2rem,3.5vw,2.9rem); letter-spacing:-0.02em;">
                Are you a child<br>healthcare provider?
            </h2>
            <p class="mb-8 max-w-lg text-base leading-relaxed" style="color:rgba(255,255,255,0.82);">
                Join Australian families already using Kids Health Hub to find trusted practitioners. List your practice today and start connecting with families who need your expertise.
            </p>

            {{-- Feature rows --}}
            <div class="mb-8 flex flex-col gap-3">
                @foreach([
                    ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'text'=>'3-month free trial - no credit card required'],
                    ['icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'text'=>'Full profile: services, availability & telehealth'],
                    ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'text'=>'Be found by families actively searching near you'],
                ] as $feat)
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full" style="background:rgba(255,255,255,0.18);">
                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feat['icon'] }}"/></svg>
                    </div>
                    <span class="text-sm font-semibold" style="color:rgba(255,255,255,0.88);">{{ $feat['text'] }}</span>
                </div>
                @endforeach
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-7 py-3.5 text-sm font-black shadow-lg transition-all hover:scale-[1.02]" style="color:#de6148;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    List Your Practice - It's Free
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl border-2 px-7 py-3.5 text-sm font-black text-white transition-all hover:bg-white/10" style="border-color:rgba(255,255,255,0.40);">
                    Sign In
                </a>
            </div>
            <p class="mt-4 text-xs" style="color:rgba(255,255,255,0.55);">No credit card &middot; 3-month free trial &middot; Cancel anytime</p>
        </div>

        {{-- RIGHT — image panel --}}
        <div class="relative hidden lg:block overflow-hidden">
            {{-- Gradient bleed from left to blend into coral --}}
            <div class="absolute inset-y-0 left-0 z-10 w-20" style="background:linear-gradient(to right, #c94135, transparent);"></div>

            @if(file_exists(public_path('images/provider.jpg')) || file_exists(public_path('images/provider.png')))
                <div class="absolute inset-0" style="background-image:url('{{ asset('images/provider.'.(file_exists(public_path('images/provider.jpg')) ? 'jpg' : 'png')) }}'); background-size:cover; background-position:center;"></div>
            @else
                <div class="absolute inset-0" style="background-image:url('https://source.unsplash.com/featured/800x600/?pediatrician,children,clinic'); background-size:cover; background-position:center;"></div>
            @endif

            {{-- Bottom dark fade --}}
            <div class="absolute inset-x-0 bottom-0 h-40" style="background:linear-gradient(to top, rgba(180,55,35,0.70), transparent);"></div>

            {{-- Floating trial badge --}}
            <div class="absolute top-8 right-8 z-20 rounded-[20px] px-5 py-4 text-center" style="background:rgba(255,255,255,0.92); backdrop-filter:blur(12px); box-shadow:0 8px 24px rgba(0,0,0,0.12);">
                <p class="font-hand text-3xl leading-none" style="color:#de6148;">Free</p>
                <p class="mt-0.5 text-xs font-black text-gray-700">3-month trial</p>
            </div>

            {{-- Floating families badge --}}
            <div class="absolute bottom-8 right-8 z-20 flex items-center gap-3 rounded-2xl px-4 py-3" style="background:rgba(255,255,255,0.92); backdrop-filter:blur(12px); box-shadow:0 8px 24px rgba(0,0,0,0.10);">
                <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl" style="background:#e3f8ee;">
                    <svg class="h-5 w-5" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-900">Families searching</p>
                    <p class="text-xs text-gray-500">Australia-wide, every day</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Wave into Why KHH --}}
    <svg viewBox="0 0 1440 48" preserveAspectRatio="none" style="display:block;width:100%;height:40px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,24 C480,0 960,48 1440,24 L1440,48 L0,48 Z" fill="var(--khh-paper)"/>
    </svg>
</section>

<!-- ═══════════════════════════════════════════════════
     WHY KIDS HEALTH HUB
════════════════════════════════════════════════════ -->
<section class="pt-6 pb-16" style="background:#fef9f3;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <p class="font-hand text-2xl mb-1" style="color:#de6148;">why we exist</p>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 leading-tight max-w-2xl mx-auto">
                Families shouldn't have to spend hours searching for the right support
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-7 mb-10">

            <div class="bg-white rounded-3xl p-8 shadow-sm" style="border-left:4px solid #0dc066;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center" style="background:#e3f8ee;">
                        <svg class="w-6 h-6" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-gray-900">For Families</h3>
                </div>
                <p class="text-gray-600 leading-relaxed mb-5 text-sm">
                    Kids Health Hub was created to make the process simpler - bringing together paediatric and
                    family-focused professionals in one easy-to-navigate space. Whether you're looking for
                    immediate availability, telehealth options, clinic-based services, or providers with
                    experience in specific areas, Kids Health Hub helps connect you with services that match
                    your child's needs.
                </p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach([['#0dc066','Immediate availability'],['#79a2cc','Telehealth options'],['#de6148','Areas of special interest'],['#fcc333','Your local area']] as [$c,$t])
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <span class="w-2 h-2 rounded-full flex-shrink-0" style="background:{{ $c }};"></span>{{ $t }}
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm" style="border-left:4px solid #de6148;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center" style="background:#fde8e3;">
                        <svg class="w-6 h-6" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-gray-900">For Providers</h3>
                </div>
                <p class="text-gray-600 leading-relaxed mb-5 text-sm">
                    Kids Health Hub offers a practical way to increase visibility, highlight key service
                    information, and connect with families actively seeking support. Listings can showcase
                    your areas of special interest, service delivery options, age groups supported, waitlist
                    timeframes, locations, and more - helping families make informed decisions faster.
                </p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach([['#de6148','Areas of special interest'],['#fcc333','Service delivery'],['#79a2cc','Age groups'],['#a8cf77','Waitlist info']] as [$c,$t])
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <span class="w-2 h-2 rounded-full flex-shrink-0" style="background:{{ $c }};"></span>{{ $t }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Mission pull-quote --}}
        <div class="rounded-3xl p-10 text-center bg-white shadow-sm">
            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full mb-4" style="background:#e3f8ee;">
                <svg class="w-5 h-5" style="color:#0dc066;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>
            <p class="font-hand text-2xl sm:text-3xl text-gray-800 leading-relaxed max-w-2xl mx-auto mb-2" style="line-height:1.4;">
                "Kids Health Hub is more than a directory."
            </p>
            <p class="text-gray-500 text-sm leading-relaxed max-w-xl mx-auto mb-6">
                It's a platform focused on improving access, supporting informed choices, and helping
                families feel <strong>less alone</strong> while navigating their child's health and developmental journey.
                Built by a Speech Pathologist and mum who understands firsthand how exhausting and overwhelming
                the search for suitable support can feel.
            </p>
            <div class="flex justify-center gap-3 flex-wrap">
                <a href="{{ route('about') }}" class="text-white font-bold px-6 py-3 rounded-xl text-sm khh-btn-coral transition-colors">Read Annika's Story</a>
                <a href="{{ route('providers.index') }}" class="font-bold px-6 py-3 rounded-xl text-sm transition-colors border-2" style="color:#0dc066; border-color:#0dc066;" onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='transparent'">Find a Provider</a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
window.initMap = async function() {
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
                    fillColor: p.availability_status ? '#0dc066' : '#79a2cc',
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
                        ${p.availability_status ? '<span style="color:#0dc066;font-size:11px;font-weight:700">● Available</span>' : ''}
                        ${p.telehealth_available ? '<span style="color:#79a2cc;font-size:11px">📱 Telehealth</span>' : ''}
                    </div>
                    <a href="${p.url}" style="display:inline-block;margin-top:8px;color:#de6148;font-size:12px;font-weight:700;text-decoration:none">View Profile →</a>
                </div>`
            });
            marker.addListener('click', () => info.open(map, marker));
        });
        if (hasMarkers) map.fitBounds(bounds);
    } catch(e) { console.error('Map error:', e); }
};

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

const script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key={{ config("services.google.maps_key") }}&loading=async';
script.async = true;
script.defer = true;
script.onload = () => window.initMap();
document.head.appendChild(script);
</script>
@endpush
