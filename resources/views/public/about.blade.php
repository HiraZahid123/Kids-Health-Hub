@extends('layouts.public')
@section('title', 'About Kids Health Hub — Annika\'s Story')
@section('meta_description', 'Kids Health Hub was founded by Annika, a Speech Pathologist and mum of three, to help Australian families find the right child healthcare support faster and easier.')

@section('content')

{{-- Hero --}}
<div style="background: linear-gradient(135deg, #fef9ec 0%, #f0fdf4 60%, #eff6ff 100%);" class="py-16 border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">

            {{-- Left: text --}}
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 mb-5">
                    <span class="w-2 h-2 rounded-full" style="background:#de6148;"></span>
                    <span class="text-xs font-black uppercase tracking-widest" style="color:#de6148;">About Kids Health Hub</span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-black text-gray-900 leading-tight mb-5">
                    Hi, I'm <span style="color:#0dc066;">Annika</span> 👋
                </h1>
                <p class="text-xl text-gray-600 leading-relaxed mb-6">
                    Founder of Kids Health Hub, Speech Pathologist, and a mum of three.
                </p>
                <div class="flex flex-wrap gap-3">
                    <span class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-full" style="background:#f0fdf4; color:#0dc066; border:1.5px solid #bbf7d0;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Speech Pathologist
                    </span>
                    <span class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-full" style="background:#fff7ed; color:#de6148; border:1.5px solid #fed7aa;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Mum of three
                    </span>
                    <span class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-full" style="background:#eff6ff; color:#79a2cc; border:1.5px solid #bfdbfe;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                        KHH Founder
                    </span>
                </div>
            </div>

            {{-- Right: logo / kite --}}
            <div class="flex-shrink-0 flex flex-col items-center">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Kids Health Hub" class="w-56 h-auto drop-shadow-md">
                @else
                    <div class="w-48 h-48 rounded-3xl flex items-center justify-center shadow-lg" style="background:linear-gradient(135deg,#98e762 0%,#0dc066 100%);">
                        <span class="text-8xl">🪁</span>
                    </div>
                @endif
                {{-- brand colour dots --}}
                <div class="flex gap-2 mt-5">
                    @foreach(['#de6148','#fcc333','#0dc066','#79a2cc','#a8cf77','#e78572'] as $c)
                    <span class="w-4 h-4 rounded-full shadow-sm" style="background:{{ $c }};"></span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Main story --}}
<div class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Intro paragraph --}}
        <div class="prose prose-lg max-w-none mb-12">
            <p class="text-gray-700 leading-relaxed text-lg">
                Over the years, I've worked with countless families navigating the overwhelming process of
                trying to find the right therapist for their child. One of the biggest challenges parents
                consistently shared was not just finding a provider, but finding someone who:
            </p>
        </div>

        {{-- 4 checkmarks --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-12">
            @foreach([
                ['color'=>'#0dc066','bg'=>'#f0fdf4','border'=>'#bbf7d0','text'=>'Has availability'],
                ['color'=>'#79a2cc','bg'=>'#eff6ff','border'=>'#bfdbfe','text'=>'Services their area'],
                ['color'=>'#de6148','bg'=>'#fff7ed','border'=>'#fed7aa','text'=>'Has experience in their child\'s specific needs'],
                ['color'=>'#fcc333','bg'=>'#fffbeb','border'=>'#fde68a','text'=>'Can support them in a way that feels like the right fit'],
            ] as $item)
            <div class="flex items-start gap-3 p-4 rounded-2xl border" style="background:{{ $item['bg'] }}; border-color:{{ $item['border'] }};">
                <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5" style="background:{{ $item['color'] }};">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="font-semibold text-gray-800 text-sm leading-snug">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Story section --}}
        <div class="space-y-6 text-gray-700 leading-relaxed">
            <p>
                As both a clinician and a parent attending appointments myself, I saw firsthand how
                <strong>stressful and time-consuming</strong> this process can be. Families were spending hours
                searching websites, joining Facebook groups, calling clinics, and sitting on waitlists without
                clear answers.
            </p>

            {{-- Highlight quote --}}
            <div class="rounded-2xl p-6 my-8" style="background:linear-gradient(135deg,#f0fdf4,#eff6ff); border-left: 4px solid #0dc066;">
                <p class="text-xl font-black text-gray-900 leading-snug">
                    That's why I created Kids Health Hub 💚
                </p>
            </div>

            <p>
                Kids Health Hub was designed to help close the gap between families and suitable health
                professionals by creating <strong>one easy-to-use space</strong> where parents can search for
                providers based on location, profession, availability and areas of experience.
            </p>

            <p>
                Our vision is simple — to make finding support for your child feel
                <strong>less overwhelming, more accessible and much faster</strong> for families across Australia.
            </p>

            <p>
                I am so excited to continue building a platform that supports both families and incredible
                allied health professionals around the country.
            </p>
        </div>

        {{-- Signature --}}
        <div class="mt-10 flex items-center gap-4 pt-8 border-t border-gray-100">
            <div class="w-14 h-14 rounded-full flex items-center justify-center text-white font-black text-xl flex-shrink-0 shadow-md" style="background:linear-gradient(135deg,#de6148,#fcc333);">A</div>
            <div>
                <div class="font-black text-gray-900 text-lg">Annika</div>
                <div class="text-sm text-gray-500">Founder, Kids Health Hub</div>
                <div class="text-sm text-gray-500">Speech Pathologist &amp; Mum of three</div>
            </div>
        </div>
    </div>
</div>

{{-- Values strip --}}
<div class="py-14" style="background-color:#f9fef5;">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-black text-gray-900 mb-2">What we stand for</h2>
            <p class="text-gray-500 text-sm">The values behind every decision we make at Kids Health Hub.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach([
                ['icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z','color'=>'#de6148','bg'=>'#fff7ed','title'=>'Family first','desc'=>'Every feature is built around making life easier for families.'],
                ['icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z','color'=>'#0dc066','bg'=>'#f0fdf4','title'=>'Easy to find','desc'=>'No more hours of searching — the right provider, fast.'],
                ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','color'=>'#79a2cc','bg'=>'#eff6ff','title'=>'Trusted & verified','desc'=>'All providers reviewed before going live on the platform.'],
                ['icon'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064','color'=>'#fcc333','bg'=>'#fffbeb','title'=>'Across Australia','desc'=>'Supporting families in every state and territory.'],
            ] as $v)
            <div class="bg-white rounded-2xl p-6 border border-gray-100 card-hover">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:{{ $v['bg'] }};">
                    <svg class="w-6 h-6" style="color:{{ $v['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $v['icon'] }}"/></svg>
                </div>
                <h3 class="font-black text-gray-900 mb-1">{{ $v['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $v['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="py-14 bg-white border-t border-gray-100">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-black text-gray-900 mb-3">Ready to find the right support?</h2>
        <p class="text-gray-500 mb-7">Search thousands of child healthcare providers across Australia — free for families.</p>
        <div class="flex justify-center gap-3 flex-wrap">
            <a href="{{ route('providers.index') }}" class="text-white font-bold px-7 py-3 rounded-xl transition-colors shadow-sm khh-btn-primary">Find Providers</a>
            <a href="{{ route('register') }}" class="font-bold px-7 py-3 rounded-xl transition-colors border-2" style="color:#de6148; border-color:#de6148;" onmouseover="this.style.background='#fff7ed'" onmouseout="this.style.background='transparent'">List Your Practice</a>
        </div>
    </div>
</div>

@endsection
