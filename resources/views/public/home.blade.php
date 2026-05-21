@extends('layouts.public')

@section('title', 'Kids Health Hub — Find Child Healthcare Providers Near You')

@section('content')

<!-- ═══════════════════════════════════════════════════
     HERO — asymmetric, warm, human
════════════════════════════════════════════════════ -->
<section style="background:#fef9f3;" class="relative overflow-hidden pt-14 pb-0 lg:pt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">

            {{-- LEFT: text + search --}}
            <div class="flex-1 pb-10 lg:pb-16">

                {{-- Handwritten label --}}
                <p class="font-hand text-2xl mb-3" style="color:#de6148;">Australia's child healthcare directory</p>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-gray-900 leading-tight mb-5 tracking-tight">
                    {{ $heroTitle }}
                </h1>
                <p class="text-lg text-gray-500 max-w-xl leading-relaxed mb-8">
                    {{ $heroSubtitle }}
                </p>

                {{-- Search bar --}}
                <form action="{{ route('providers.index') }}" method="GET" class="mb-7 max-w-xl">
                    <div class="flex flex-col sm:flex-row gap-0 bg-white border-2 rounded-2xl shadow-md overflow-hidden" style="border-color:#a8cf77;">
                        <div class="flex items-center gap-3 flex-1 px-5">
                            <svg class="w-5 h-5 flex-shrink-0" style="color:#a8cf77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="search"
                                placeholder="Suburb, postcode, or provider name..."
                                class="flex-1 py-4 text-gray-800 placeholder-gray-400 bg-transparent outline-none text-base font-medium border-0 focus:ring-0"
                                value="{{ request('search') }}">
                        </div>
                        <div class="hidden sm:block w-px my-3" style="background:#e3f0d8;"></div>
                        <div class="flex items-center px-4 sm:px-3">
                            <select name="category" class="py-4 text-sm text-gray-600 bg-transparent outline-none border-0 focus:ring-0 font-semibold pr-2 cursor-pointer">
                                <option value="">All Services</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="m-2 text-white font-bold px-7 py-3.5 rounded-xl transition-colors text-sm whitespace-nowrap khh-btn-primary">
                            Search
                        </button>
                    </div>
                </form>

                {{-- Quick links — 3 only --}}
                <div class="flex flex-wrap gap-2">
                    <button id="btn-near-me-home" class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-4 py-2 rounded-full shadow-sm transition-colors khh-btn-coral">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Near Me
                    </button>
                    <a href="{{ route('providers.index', ['available' => 1]) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-4 py-2 rounded-full shadow-sm transition-colors khh-btn-primary">
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                        Available Now
                    </a>
                    <a href="{{ route('telehealth') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-4 py-2 rounded-full shadow-sm khh-btn-blue">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14"/></svg>
                        Telehealth
                    </a>
                </div>
                <p id="geo-status-home" class="text-sm text-gray-400 mt-3 hidden"></p>
            </div>

            {{-- RIGHT: image panel --}}
            <div class="hidden lg:flex flex-col items-center flex-shrink-0 w-[380px] pb-0">
                {{-- Decorative blobs behind image --}}
                <div class="relative w-full">
                    {{-- Background blob --}}
                    <div class="absolute -top-8 -right-8 w-72 h-72 rounded-full opacity-20" style="background:#0dc066;"></div>
                    <div class="absolute -bottom-4 -left-4 w-48 h-48 rounded-full opacity-15" style="background:#fcc333;"></div>

                    @if(file_exists(public_path('images/hero.jpg')) || file_exists(public_path('images/hero.png')))
                        <img src="{{ asset('images/hero.'.( file_exists(public_path('images/hero.jpg')) ? 'jpg' : 'png')) }}"
                             alt="Kids healthcare" class="relative rounded-3xl w-full object-cover shadow-xl" style="height:380px;">
                    @else
                        {{-- Placeholder — drop an AI image here --}}
                        <div class="relative rounded-3xl w-full flex flex-col items-center justify-center shadow-lg overflow-hidden" style="height:380px; background:#fde8e3; border:2px dashed #e78572;">
                            <svg class="w-16 h-16 mb-4 opacity-30" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="font-hand text-2xl mb-1" style="color:#de6148;">image coming soon</p>
                            <p class="text-xs text-center px-8" style="color:#e78572; opacity:.7;">Save as <code>public/images/hero.jpg</code></p>
                            {{-- AI PROMPT: "warm watercolour illustration of an Australian mum and young child at a speech pathology session, bright cheerful clinic, pastel coral sage and sky blue tones, soft painted style, white background, no text --v 6 --ar 3:4" --}}
                        </div>
                    @endif

                    {{-- Floating accent dots --}}
                    <div class="absolute top-4 left-4 w-4 h-4 rounded-full shadow" style="background:#fcc333;"></div>
                    <div class="absolute bottom-8 right-4 w-5 h-5 rounded-full shadow" style="background:#79a2cc;"></div>
                    <div class="absolute top-1/2 -left-3 w-3 h-3 rounded-full" style="background:#de6148;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave bottom --}}
    <svg viewBox="0 0 1440 56" preserveAspectRatio="none" style="display:block;width:100%;height:48px;margin-top:-2px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,28 C240,56 480,0 720,28 C960,56 1200,0 1440,28 L1440,56 L0,56 Z" fill="#fffdf7"/>
    </svg>
</section>

<!-- ═══════════════════════════════════════════════════
     CATEGORY TILES — coloured sticky-note style
════════════════════════════════════════════════════ -->
<section style="background:#fffdf7;" class="pb-14 pt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <p class="font-hand text-2xl mb-1" style="color:#79a2cc;">find the right support</p>
            <h2 class="text-2xl font-black text-gray-900">Browse by Speciality</h2>
        </div>
        @php
        $catMeta = [
            'speech-pathology'     => ['icon'=>'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'bg'=>'#fde8e3','color'=>'#de6148'],
            'occupational-therapy' => ['icon'=>'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z', 'bg'=>'#deedf7','color'=>'#79a2cc'],
            'psychology'           => ['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'bg'=>'#fef9e3','color'=>'#c4920a'],
            'physiotherapy'        => ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'bg'=>'#fce8e5','color'=>'#e64738'],
            'paediatrician'        => ['icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'bg'=>'#e8f5e1','color'=>'#5a9e32'],
            'autism-assessment'    => ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'bg'=>'#e3f8ee','color'=>'#0dc066'],
            'dietetics-nutrition'  => ['icon'=>'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'bg'=>'#fef7e0','color'=>'#c4920a'],
            'pbs'                  => ['icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'bg'=>'#f5e3f7','color'=>'#a020b0'],
            'play-therapy'         => ['icon'=>'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'bg'=>'#fff0e3','color'=>'#de6148'],
        ];
        $defaultMeta = ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','bg'=>'#e3f8ee','color'=>'#0dc066'];
        $rotations = ['rotate-1','-rotate-1','rotate-0','-rotate-1','rotate-1','rotate-0','-rotate-1','rotate-1','rotate-0'];
        @endphp
        <div class="flex flex-wrap justify-center gap-3">
            @foreach($categories as $i => $cat)
            @php $meta = $catMeta[$cat->slug] ?? $defaultMeta; $rot = $rotations[$i % count($rotations)]; @endphp
            <a href="{{ route('providers.index', ['category' => $cat->slug]) }}"
               class="card-hover group {{ $rot }} hover:rotate-0 rounded-2xl p-5 text-center transition-all duration-200 shadow-sm"
               style="background:{{ $meta['bg'] }}; min-width:130px; max-width:160px; flex:1;">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3 bg-white bg-opacity-60">
                    <svg class="w-5 h-5" style="color:{{ $meta['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $meta['icon'] }}"/>
                    </svg>
                </div>
                <p class="text-sm font-bold text-gray-800 leading-tight">{{ $cat->name }}</p>
                <p class="text-xs mt-1 font-semibold opacity-60" style="color:{{ $meta['color'] }}">Find providers →</p>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Wave down into map --}}
    <svg viewBox="0 0 1440 48" preserveAspectRatio="none" style="display:block;width:100%;height:40px;margin-top:32px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,24 C360,48 1080,0 1440,24 L1440,48 L0,48 Z" fill="#f3f4f6"/>
    </svg>
</section>

<!-- ═══════════════════════════════════════════════════
     MAP SECTION
════════════════════════════════════════════════════ -->
<section class="bg-gray-100 pb-12 pt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <p class="font-hand text-xl mb-0.5" style="color:#0dc066;">explore the map</p>
                <h2 class="text-2xl font-black text-gray-900">Providers Near You</h2>
                <p class="text-gray-500 text-sm mt-1">Click any marker to see details and visit the provider's profile</p>
            </div>
            <a href="{{ route('providers.index') }}"
               class="inline-flex items-center gap-2 bg-white border-2 border-gray-200 hover:border-gray-300 text-gray-700 font-bold px-5 py-2.5 rounded-xl text-sm transition-colors flex-shrink-0 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                View all as list
            </a>
        </div>
        <div id="map" class="w-full h-[420px] lg:h-[480px] rounded-3xl overflow-hidden border-2 border-white bg-gray-200 flex items-center justify-center shadow-md">
            <div class="text-center text-gray-400">
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                <p class="text-sm font-medium">Loading map…</p>
            </div>
        </div>
    </div>

    {{-- Wave into featured --}}
    <svg viewBox="0 0 1440 48" preserveAspectRatio="none" style="display:block;width:100%;height:40px;margin-top:32px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 C480,48 960,0 1440,0 L1440,48 L0,48 Z" fill="white"/>
    </svg>
</section>

<!-- ═══════════════════════════════════════════════════
     FEATURED PROVIDERS
════════════════════════════════════════════════════ -->
@if($featuredProviders->isNotEmpty())
<section class="bg-white pt-4 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-8">
            <div>
                <p class="font-hand text-xl mb-0.5" style="color:#fcc333;">handpicked for you</p>
                <h2 class="text-2xl font-black text-gray-900">Featured Providers</h2>
            </div>
            <a href="{{ route('providers.index') }}" class="text-sm font-bold hover:underline" style="color:#0dc066;">View all →</a>
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
     TESTIMONIALS
════════════════════════════════════════════════════ -->
<section class="py-14 overflow-hidden" style="background:#fef9f3;">

    {{-- wave top --}}
    <svg viewBox="0 0 1440 40" preserveAspectRatio="none" style="display:block;width:100%;height:32px;margin-top:-32px;margin-bottom:32px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,20 C360,40 1080,0 1440,20 L1440,40 L0,40 Z" fill="white"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="font-hand text-center text-3xl mb-8" style="color:#de6148;">what families are saying</p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach([
                ['quote'=>'Finding a speech pathologist close to us used to take weeks. With Kids Health Hub I found three great options in one afternoon.','name'=>'Sarah M.','suburb'=>'Brisbane, QLD','color'=>'#de6148','bg'=>'#fde8e3'],
                ['quote'=>'We were able to filter by telehealth AND NDIS funding — that combination was impossible to search anywhere else.','name'=>'James T.','suburb'=>'Perth, WA','color'=>'#79a2cc','bg'=>'#deedf7'],
                ['quote'=>"The founder clearly gets it. This isn't just a list, it actually makes the whole process feel less overwhelming.",'name'=>'Priya K.','suburb'=>'Melbourne, VIC','color'=>'#0dc066','bg'=>'#e3f8ee'],
            ] as $t)
            <div class="rounded-3xl p-7 shadow-sm" style="background:{{ $t['bg'] }};">
                {{-- Stars --}}
                <div class="flex gap-1 mb-4">
                    @for($s=0;$s<5;$s++)
                    <svg class="w-4 h-4" style="color:#fcc333;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-700 leading-relaxed mb-5 text-sm">"{{ $t['quote'] }}"</p>
                <div class="flex items-center gap-3 pt-4 border-t border-white border-opacity-60">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-black text-sm" style="background:{{ $t['color'] }};">{{ substr($t['name'],0,1) }}</div>
                    <div>
                        <div class="font-hand text-lg leading-tight" style="color:{{ $t['color'] }};">{{ $t['name'] }}</div>
                        <div class="text-xs text-gray-500">{{ $t['suburb'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     RECENTLY LISTED
════════════════════════════════════════════════════ -->
<section class="py-12" style="background:#fffdf7;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-8">
            <div>
                <p class="font-hand text-xl mb-0.5" style="color:#a8cf77;">just joined</p>
                <h2 class="text-2xl font-black text-gray-900">Recently Listed Providers</h2>
            </div>
            <a href="{{ route('providers.index') }}" class="text-sm font-bold hover:underline" style="color:#0dc066;">View all →</a>
        </div>

        @if($recentProviders->isEmpty())
            <div class="bg-white rounded-3xl border-2 border-dashed border-gray-200 py-20 text-center">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:#e3f8ee;">
                    <svg class="w-8 h-8" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-700 mb-1">No providers listed yet</h3>
                <p class="text-gray-400 text-sm mb-6">Be the first healthcare provider to join the platform</p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-white px-7 py-3 rounded-xl font-bold text-sm khh-btn-primary">
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
     HOW IT WORKS — staggered, handcrafted
════════════════════════════════════════════════════ -->
<section class="py-14 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="font-hand text-2xl mb-1" style="color:#de6148;">three easy steps</p>
            <h2 class="text-2xl font-black text-gray-900">How Kids Health Hub Works</h2>
        </div>
        <div class="flex flex-col gap-5">
            @foreach([
                ['num'=>'1','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z','bg'=>'#fde8e3','color'=>'#de6148','border'=>'#de6148','rot'=>'rotate-1','title'=>'Search the directory','body'=>'Browse verified child healthcare providers by suburb, postcode, or specialty. Filter by telehealth, funding type, age group, and availability.'],
                ['num'=>'2','icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z','bg'=>'#deedf7','color'=>'#79a2cc','border'=>'#79a2cc','rot'=>'-rotate-1','title'=>'View provider profiles','body'=>'Read detailed profiles, reviews from other families, and contact information. Save your favourites to a personal shortlist.'],
                ['num'=>'3','icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z','bg'=>'#e3f8ee','color'=>'#0dc066','border'=>'#0dc066','rot'=>'rotate-0','title'=>'Request an appointment','body'=>'Send appointment requests directly through the platform and communicate with providers via our secure messaging system.'],
            ] as $step)
            <div class="flex items-start gap-5 p-6 rounded-2xl shadow-sm {{ $step['rot'] }} hover:rotate-0 transition-transform duration-200" style="background:{{ $step['bg'] }}; border-left:4px solid {{ $step['border'] }};">
                <div class="flex-shrink-0">
                    <div class="font-hand text-5xl leading-none" style="color:{{ $step['color'] }};">{{ $step['num'] }}</div>
                </div>
                <div>
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center mb-3 bg-white bg-opacity-70">
                        <svg class="w-5 h-5" style="color:{{ $step['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $step['icon'] }}"/></svg>
                    </div>
                    <h3 class="font-black text-gray-900 text-base mb-1">{{ $step['title'] }}</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $step['body'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Wave into CTA --}}
    <svg viewBox="0 0 1440 56" preserveAspectRatio="none" style="display:block;width:100%;height:48px;margin-top:48px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 C240,56 720,0 1440,28 L1440,56 L0,56 Z" fill="#de6148"/>
    </svg>
</section>

<!-- ═══════════════════════════════════════════════════
     PROVIDER CTA — flat coral, organic
════════════════════════════════════════════════════ -->
<section class="relative overflow-hidden py-14" style="background:#de6148;">
    {{-- Decorative blob --}}
    <svg class="absolute right-0 top-0 opacity-10 w-80 h-80 pointer-events-none" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path d="M44.7,-76.4C58.8,-69.2,71.8,-59.1,79.6,-45.8C87.4,-32.6,90,-16.3,87.9,-1.2C85.8,13.9,79.2,27.8,70.5,39.7C61.7,51.6,50.9,61.5,38.3,68.5C25.7,75.5,11,79.7,-2.4,83.3C-15.8,86.9,-31.6,90,-44.5,85.1C-57.4,80.1,-67.4,67.2,-75.2,53.1C-83,39,-88.6,23.7,-89.4,8.1C-90.3,-7.5,-86.4,-23.3,-78.8,-36.7C-71.1,-50,-59.7,-60.9,-46.5,-68.5C-33.3,-76.1,-18.5,-80.5,-1.9,-77.7C14.7,-74.9,30.6,-83.7,44.7,-76.4Z" fill="white"/>
    </svg>
    <svg class="absolute left-0 bottom-0 opacity-10 w-64 h-64 pointer-events-none" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path d="M30.2,-52.3C38.6,-45.4,44.5,-35.7,52.8,-25.1C61.2,-14.5,72.1,-2.9,71.4,8C70.8,18.9,58.6,29.1,47.4,37.5C36.3,46,26.2,52.7,14.6,57.6C3,62.5,-10.1,65.5,-21.5,62.3C-32.9,59.1,-42.6,49.8,-50.8,39.2C-58.9,28.6,-65.4,16.8,-67.5,3.8C-69.6,-9.2,-67.4,-23.4,-60.6,-34.8C-53.8,-46.3,-42.5,-55,-30.4,-61C-18.2,-67,-9.1,-70.2,1.3,-72C11.6,-73.8,21.8,-59.2,30.2,-52.3Z" fill="white"/>
    </svg>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="flex-1 text-center lg:text-left">
                <h2 class="text-3xl lg:text-4xl font-black text-white mb-4 leading-tight">
                    Are you a child healthcare provider?
                </h2>
                <p class="text-lg mb-8 max-w-xl leading-relaxed" style="color:rgba(255,255,255,0.88);">
                    Join Australian families using Kids Health Hub to find trusted practitioners. Start your free 3-month listing today.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 lg:justify-start justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 bg-white font-black px-8 py-4 rounded-xl transition-colors text-sm shadow-lg hover:bg-orange-50" style="color:#de6148;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        List Your Practice — It's Free
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center font-bold px-8 py-4 rounded-xl text-sm border-2 text-white transition-colors" style="background:rgba(255,255,255,0.15); border-color:rgba(255,255,255,0.4);" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        Sign In
                    </a>
                </div>
                <p class="text-xs mt-4" style="color:rgba(255,255,255,0.65);">No credit card &middot; 3-month free trial &middot; Cancel anytime</p>
            </div>

            {{-- Provider image placeholder (desktop) --}}
            <div class="hidden lg:block flex-shrink-0 w-56">
                @if(file_exists(public_path('images/provider.jpg')) || file_exists(public_path('images/provider.png')))
                    <img src="{{ asset('images/provider.'.( file_exists(public_path('images/provider.jpg')) ? 'jpg' : 'png')) }}"
                         alt="Healthcare provider" class="rounded-3xl w-full shadow-xl" style="height:260px;object-fit:cover;">
                @else
                    <div class="rounded-3xl w-full flex flex-col items-center justify-center" style="height:260px; background:rgba(255,255,255,0.15); border:2px dashed rgba(255,255,255,0.4);">
                        <svg class="w-10 h-10 mb-2 opacity-50 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="font-hand text-xl text-white opacity-70">photo here</p>
                        {{-- AI PROMPT: "friendly Australian allied health professional, warm smile, bright clinic background, candid photo, natural light, no text --v 6 --ar 3:4" --}}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Wave into Why KHH --}}
    <svg viewBox="0 0 1440 48" preserveAspectRatio="none" style="display:block;width:100%;height:40px;margin-top:48px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,24 C480,0 960,48 1440,24 L1440,48 L0,48 Z" fill="#fef9f3"/>
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
                    Kids Health Hub was created to make the process simpler — bringing together paediatric and
                    family-focused professionals in one easy-to-navigate space. Whether you're looking for
                    immediate availability, telehealth options, clinic-based services, or providers with
                    experience in specific areas, Kids Health Hub helps connect you with services that match
                    your child's needs.
                </p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach([['#0dc066','Immediate availability'],['#79a2cc','Telehealth options'],['#de6148','Specific expertise'],['#fcc333','Your local area']] as [$c,$t])
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
                    your areas of expertise, service delivery options, age groups supported, waitlist
                    timeframes, locations, and more — helping families make informed decisions faster.
                </p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach([['#de6148','Areas of expertise'],['#fcc333','Service delivery'],['#79a2cc','Age groups'],['#a8cf77','Waitlist info']] as [$c,$t])
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
}
</script>
@endpush
