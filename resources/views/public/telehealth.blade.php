@extends('layouts.public')

@section('title', 'Telehealth Child Healthcare Providers - Kids Health Hub')

@section('content')

<!-- ═══════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════ -->
<section class="khh-hero-shell pt-6 pb-0 lg:pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="khh-hero-stage" style="min-height:340px;">
            <div class="khh-hero-overlay" style="background:linear-gradient(135deg,rgba(121,162,204,0.18) 0%,rgba(255,250,243,0.60) 100%);"></div>

            <div class="relative z-10 flex h-full min-h-[inherit] flex-col justify-between p-4 sm:p-6 lg:p-8">
                <div class="grid gap-6 lg:grid-cols-[minmax(0,1.1fr)_320px] lg:items-center">

                    {{-- Left copy --}}
                    <div class="max-w-2xl pt-1 lg:pt-4">
                        <div class="mb-4 inline-flex items-center gap-3 rounded-full border border-white/70 bg-white/78 px-4 py-2 text-xs sm:text-sm font-extrabold text-gray-700 shadow-sm backdrop-blur">
                            <span class="inline-flex h-2.5 w-2.5 rounded-full" style="background:var(--khh-sky);"></span>
                            Healthcare from the comfort of home
                        </div>

                        <h1 class="max-w-2xl text-4xl font-black leading-[1.02] text-gray-900 sm:text-5xl lg:text-[3.2rem]">
                            Telehealth Child Healthcare Providers
                        </h1>
                        <p class="mt-4 max-w-xl text-sm leading-6 text-gray-700 sm:text-base sm:leading-7">
                            Browse verified practitioners offering online consultations across Australia - no travel needed.
                        </p>

                        <div class="mt-5 flex flex-wrap gap-3">
                            <a href="#providers" class="inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-black text-white shadow-md transition-colors khh-btn-blue">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                Browse Telehealth
                            </a>
                            <a href="{{ route('providers.index') }}" class="inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-black text-gray-900 shadow-sm transition-colors" style="background:rgba(243,206,102,0.92);">
                                View All Providers
                            </a>
                        </div>
                    </div>

                    {{-- Right info panel --}}
                    <div class="self-start lg:justify-self-end">
                        <div class="khh-hero-panel max-w-sm rounded-[26px] p-4 shadow-lg">
                            <div class="mb-3">
                                <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:var(--khh-sky);">Why telehealth?</p>
                                <h2 class="mt-2 text-lg font-black text-gray-900">Same great care, anywhere</h2>
                            </div>
                            <div class="space-y-2.5">
                                <div class="flex items-start gap-3 rounded-2xl px-4 py-3" style="background:rgba(255,255,255,0.72);">
                                    <span class="mt-1 h-2.5 w-2.5 flex-shrink-0 rounded-full" style="background:var(--khh-sky);"></span>
                                    <div>
                                        <p class="text-sm font-black text-gray-900">No travel required</p>
                                        <p class="mt-0.5 text-xs leading-5 text-gray-600">Connect with specialists from anywhere in Australia.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 rounded-2xl px-4 py-3" style="background:rgba(255,255,255,0.72);">
                                    <span class="mt-1 h-2.5 w-2.5 flex-shrink-0 rounded-full" style="background:var(--khh-green);"></span>
                                    <div>
                                        <p class="text-sm font-black text-gray-900">Shorter wait times</p>
                                        <p class="mt-0.5 text-xs leading-5 text-gray-600">Online providers often have faster availability.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 rounded-2xl px-4 py-3" style="background:rgba(255,255,255,0.72);">
                                    <span class="mt-1 h-2.5 w-2.5 flex-shrink-0 rounded-full" style="background:var(--khh-coral);"></span>
                                    <div>
                                        <p class="text-sm font-black text-gray-900">NDIS & Medicare eligible</p>
                                        <p class="mt-0.5 text-xs leading-5 text-gray-600">Many providers accept funding for online sessions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="khh-hero-stripes" aria-hidden="true">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <svg viewBox="0 0 1440 56" preserveAspectRatio="none" style="display:block;width:100%;height:48px;margin-top:24px;" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,28 C240,56 480,0 720,28 C960,56 1200,0 1440,28 L1440,56 L0,56 Z" fill="#fffdf7"/>
    </svg>
</section>

<!-- ═══════════════════════════════════════════════════
     BENEFITS BAND
════════════════════════════════════════════════════ -->
<section style="background:#fffdf7; padding:48px 0 40px;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach([
                ['icon'=>'M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z', 'bg'=>'#deedf7','color'=>'#79a2cc','title'=>'Live video sessions','body'=>'Real-time appointments with your provider via secure video - just like being in the room.'],
                ['icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'bg'=>'#e3f8ee','color'=>'#0dc066','title'=>'From your own home','body'=>'Attend appointments in a familiar, comfortable environment - great for anxious children.'],
                ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'bg'=>'#fde8e3','color'=>'#de6148','title'=>'Access Australia-wide','body'=>'Find specialists in metro, regional, or rural areas - telehealth removes the distance barrier.'],
            ] as $b)
            <div class="flex items-start gap-4 rounded-[24px] p-6" style="background:{{ $b['bg'] }};">
                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-2xl bg-white/70">
                    <svg class="w-6 h-6" style="color:{{ $b['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $b['icon'] }}"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-black text-gray-900 text-sm mb-1">{{ $b['title'] }}</h3>
                    <p class="text-xs leading-5 text-gray-600">{{ $b['body'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     PROVIDERS
════════════════════════════════════════════════════ -->
<section id="providers" style="background:var(--khh-paper); padding:48px 0 72px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black mb-2" style="background:#deedf7; color:#4a7fb5;">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Online consultations
                </span>
                <h2 class="text-3xl font-black text-gray-900">Telehealth Providers</h2>
                <p class="text-gray-500 text-sm mt-1">
                    @if($providers->isNotEmpty())
                        <strong class="text-gray-700">{{ $providers->total() }}</strong> provider{{ $providers->total() !== 1 ? 's' : '' }} offering online appointments
                    @else
                        Browse providers offering online consultations
                    @endif
                </p>
            </div>
            <a href="{{ route('providers.index') }}" class="inline-flex items-center gap-2 font-bold px-5 py-2.5 rounded-xl text-sm transition-colors flex-shrink-0" style="background:#fff; border:2px solid #e5e7eb; color:#374151; box-shadow:0 1px 6px rgba(0,0,0,0.06);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                All providers
            </a>
        </div>

        {{-- Category filter pills --}}
        <div class="flex flex-wrap gap-2 mb-7">
            <a href="{{ route('telehealth') }}"
               class="inline-flex items-center gap-1.5 rounded-full px-4 py-2 text-xs font-black transition-colors"
               style="{{ !request('category') ? 'background:#79a2cc; color:#fff;' : 'background:#fff; color:#374151; border:2px solid #e5e7eb;' }}">
                All Telehealth
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('telehealth', ['category' => $cat->slug]) }}"
                   class="inline-flex items-center gap-1.5 rounded-full px-4 py-2 text-xs font-black transition-colors"
                   style="{{ request('category') == $cat->slug ? 'background:#79a2cc; color:#fff;' : 'background:#fff; color:#374151; border:2px solid #e5e7eb;' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        {{-- Grid or empty state --}}
        @if($providers->isEmpty())
            <div class="rounded-[28px] py-20 text-center" style="background:#fff; border:2px dashed #e0d9d0;">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:#deedf7;">
                    <svg class="w-8 h-8" style="color:#79a2cc;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-gray-700 mb-1">No telehealth providers found</h3>
                <p class="text-gray-400 text-sm mb-6">Try a different category or check back soon as more providers join.</p>
                <a href="{{ route('telehealth') }}" class="khh-btn-blue inline-flex items-center gap-2 text-white px-7 py-3 rounded-xl font-bold text-sm">
                    View all telehealth
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($providers as $provider)
                    @include('public.partials.provider-card', ['provider' => $provider])
                @endforeach
            </div>
            <div class="mt-8">{{ $providers->links() }}</div>
        @endif
    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     PROVIDER CTA BAND
════════════════════════════════════════════════════ -->
<section style="background:#deedf7; padding:48px 0;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black mb-4" style="background:rgba(255,255,255,0.70); color:#4a7fb5;">
            For providers
        </span>
        <h2 class="text-2xl sm:text-3xl font-black text-gray-900 mb-3">Do you offer telehealth services?</h2>
        <p class="text-gray-600 text-sm leading-relaxed max-w-xl mx-auto mb-6">
            List your practice on Kids Health Hub and let families across Australia find your online services. Free 3-month trial, no credit card required.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl px-7 py-3.5 text-sm font-black text-white shadow-md khh-btn-blue transition-all hover:scale-[1.02]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                List Your Practice Free
            </a>
            <a href="{{ route('providers.index') }}" class="inline-flex items-center justify-center rounded-2xl border-2 px-7 py-3.5 text-sm font-black transition-all" style="color:#4a7fb5; border-color:#79a2cc;">
                Browse All Providers
            </a>
        </div>
    </div>
</section>

@endsection
