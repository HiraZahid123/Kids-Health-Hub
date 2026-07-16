@extends('layouts.public')
@section('title', 'About Kids Health Hub — Annika\'s Story')
@section('meta_description', 'Kids Health Hub was founded by Annika, a Speech Pathologist and mum of three, to help Australian families find the right child healthcare support faster and easier.')

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO  —  text left · image right
════════════════════════════════════════════════════════════ --}}
@php
    $annikaFile = collect(['jpg','jpeg','png','webp'])
        ->map(fn($e) => ['ext'=>$e,'path'=>public_path("images/annika-family.$e")])
        ->first(fn($f) => file_exists($f['path']));
@endphp
<section class="khh-hero-shell pt-6 pb-0 lg:pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="khh-hero-stage hero-pattern" style="min-height:clamp(560px,68vh,700px);">

            {{-- === Decorative background layer === --}}
            {{-- warm radial blobs --}}
            <div class="pointer-events-none absolute inset-0" style="z-index:0;
                background:
                    radial-gradient(ellipse 55% 70% at 82% 55%, rgba(243,206,102,0.22) 0%, transparent 70%),
                    radial-gradient(ellipse 40% 50% at 90% 20%, rgba(121,162,204,0.14) 0%, transparent 65%),
                    radial-gradient(ellipse 35% 45% at 75% 90%, rgba(13,192,102,0.10) 0%, transparent 60%),
                    radial-gradient(ellipse 30% 40% at 60% 10%, rgba(222,97,72,0.08) 0%, transparent 55%);
            "></div>

            {{-- scattered decorative dots --}}
            <div class="pointer-events-none absolute hidden lg:block" style="z-index:0; top:14%; right:30%; width:10px; height:10px; border-radius:50%; background:var(--khh-coral); opacity:0.35;"></div>
            <div class="pointer-events-none absolute hidden lg:block" style="z-index:0; top:22%; right:24%; width:7px; height:7px; border-radius:50%; background:var(--khh-gold); opacity:0.45;"></div>
            <div class="pointer-events-none absolute hidden lg:block" style="z-index:0; top:70%; right:48%; width:8px; height:8px; border-radius:50%; background:var(--khh-green); opacity:0.35;"></div>
            <div class="pointer-events-none absolute hidden lg:block" style="z-index:0; top:55%; right:27%; width:6px; height:6px; border-radius:50%; background:var(--khh-sky); opacity:0.40;"></div>
            <div class="pointer-events-none absolute hidden lg:block" style="z-index:0; top:82%; right:35%; width:9px; height:9px; border-radius:50%; background:var(--khh-coral); opacity:0.25;"></div>
            {{-- doodle ring accents --}}
            <div class="pointer-events-none absolute hidden lg:block" style="z-index:0; top:8%; right:22%; width:44px; height:44px; border-radius:50%; border:2.5px solid rgba(222,97,72,0.18);"></div>
            <div class="pointer-events-none absolute hidden lg:block" style="z-index:0; top:72%; right:52%; width:32px; height:32px; border-radius:50%; border:2px solid rgba(13,192,102,0.20);"></div>
            <div class="pointer-events-none absolute hidden lg:block" style="z-index:0; bottom:18%; right:20%; width:56px; height:56px; border-radius:50%; border:2px solid rgba(121,162,204,0.18);"></div>

            {{-- left-side text overlay keeps text sharp --}}
            <div class="pointer-events-none absolute inset-0" style="z-index:1; background:linear-gradient(90deg,rgba(255,250,243,0.96) 0%,rgba(255,250,243,0.92) 35%,rgba(255,250,243,0.45) 52%,transparent 65%);"></div>

            {{-- === Main content === --}}
            <div class="relative flex min-h-[inherit] items-center justify-between gap-6 px-6 py-8 sm:px-8 lg:px-12 lg:py-10" style="z-index:2;">

                {{-- LEFT: text --}}
                <div class="flex-1 min-w-0">

                    <div class="mb-5 inline-flex w-fit items-center gap-2.5 rounded-full border border-white/70 bg-white/82 px-4 py-2 text-xs font-extrabold text-gray-700 shadow-sm backdrop-blur">
                        <span class="h-2 w-2 rounded-full" style="background:var(--khh-coral);"></span>
                        About Kids Health Hub
                    </div>

                    <span class="block font-hand leading-none" style="font-size:2.4rem; color:var(--khh-coral);">Hi, I'm</span>
                    <h1 class="font-black leading-[0.93] text-gray-900" style="font-size:clamp(3.6rem,6.5vw,5.8rem);">
                        Annika<span style="color:var(--khh-green);">.</span>
                    </h1>

                    <p class="mt-5 max-w-[420px] text-[1.02rem] leading-7 text-gray-600 sm:leading-8">
                        Paediatric Speech Pathologist, mum of 3, and founder of Kids Health Hub - I created this platform because I navigated the challenges of finding the right health professionals firsthand, and I wanted to make that journey easier for other families.
                    </p>

                    {{-- credential pills --}}
                    <div class="mt-7 flex flex-wrap gap-2.5">
                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-black shadow-sm" style="background:#e9fbf2; color:#0aad5a;">
                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>Paediatric Speech Pathologist
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-black shadow-sm" style="background:#fff0ea; color:var(--khh-coral);">
                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>Mum of 3
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-black shadow-sm" style="background:#edf5ff; color:var(--khh-sky);">
                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>KHH Founder
                        </span>
                    </div>

                    {{-- handwritten thought note --}}
                    <div class="mt-8 hidden sm:inline-flex items-start gap-2">
                        <svg class="mt-1 h-5 w-5 flex-shrink-0 opacity-50" style="color:var(--khh-coral);" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                        <span class="font-hand text-xl leading-snug text-gray-500">"One clear place - built for families."</span>
                    </div>
                </div>

                {{-- RIGHT: image, no card bg — just the photo floating with glow + decorative chips --}}
                @if($annikaFile)
                <div class="relative hidden flex-shrink-0 lg:block" style="width:370px; height:460px;">

                    {{-- soft radial glow behind the photo --}}
                    <div class="absolute inset-0 rounded-[28px]" style="background:radial-gradient(ellipse 80% 90% at 50% 50%, rgba(243,206,102,0.28) 0%, rgba(222,97,72,0.10) 45%, transparent 72%); filter:blur(18px);"></div>

                    {{-- the photo — clean, no overlays --}}
                    <div class="absolute inset-0" style="background-image:url('{{ asset('images/annika-family.'.$annikaFile['ext']) }}'); background-size:cover; background-position:top center; background-repeat:no-repeat; border-radius:24px;"></div>
                </div>
                @endif

            </div>

            <div class="khh-hero-stripes" style="z-index:3;"><span></span><span></span><span></span><span></span><span></span></div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     OUR STORY
════════════════════════════════════════════════════════════ --}}
<section class="py-14 lg:py-20" style="background:var(--khh-paper);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="mb-12 text-center">
            <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-black uppercase tracking-[0.18em] shadow-sm" style="background:#fff0ea; color:var(--khh-coral);">Our Story</span>
            <h2 class="mt-4 font-black leading-tight text-gray-900" style="font-size:clamp(2rem,4vw,3rem);">
                Built from real appointments,<br>
                <span class="font-hand" style="color:var(--khh-green); font-size:1.15em;">real families.</span>
            </h2>
        </div>

        {{-- Story + sidebar --}}
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px] lg:gap-14">

            {{-- Story text --}}
            <div class="space-y-5 text-[1.02rem] leading-8 text-gray-600">
                <p>I built Kids Health Hub to reduce the overwhelming number of steps families often face when trying to find appropriate clinicians in their area with suitable availability. As both a Speech Pathologist and a parent, I experienced firsthand how exhausting and time-consuming it can be to search for the right support - calling multiple clinics, sitting on waitlists, repeating the same information over and over, and still not knowing who has availability, who works with your child's needs or where to even begin.</p>

                <div class="rounded-2xl px-6 py-5" style="background:linear-gradient(135deg,#e9fbf2,#f0fdf9); border-left:4px solid var(--khh-green);">
                    <p class="font-hand text-2xl sm:text-3xl leading-snug text-gray-900">"That's why I created Kids Health Hub."</p>
                    <p class="mt-2 text-sm font-bold text-gray-400">- Annika</p>
                </div>

                <p>Kids Health Hub was created to help bridge that gap. The goal is to make the process simpler, faster and less stressful for families by bringing together trusted paediatric professionals in one easy-to-navigate space. Families can search based on location, profession, areas of experience, telehealth options, mobile services and current availability, helping them connect with the right supports sooner rather than endless time trying to navigate the system alone.</p>

                <p>At its core, Kids Health Hub was built from real lived experience - with the hope of making access to children's health supports more transparent, accessible and family-friendly.</p>
            </div>

            {{-- What families needed --}}
            <div>
                <p class="mb-4 text-xs font-black uppercase tracking-[0.2em]" style="color:var(--khh-coral);">What families needed</p>
                <ul class="space-y-2.5">
                    @foreach([
                        ['c'=>'var(--khh-green)', 'bg'=>'#e9fbf2', 'n'=>'01', 't'=>'A provider with real availability'],
                        ['c'=>'var(--khh-sky)',   'bg'=>'#edf5ff', 'n'=>'02', 't'=>'Someone who services their area'],
                        ['c'=>'var(--khh-coral)', 'bg'=>'#fff0ea', 'n'=>'03', 't'=>'Experience in their child\'s specific needs'],
                        ['c'=>'var(--khh-gold)',  'bg'=>'#fff7d9', 'n'=>'04', 't'=>'A provider that feels like the right fit'],
                    ] as $i)
                    <li class="flex items-center gap-3.5 rounded-2xl px-4 py-3.5" style="background:{{ $i['bg'] }};">
                        <span class="flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full text-[10px] font-black text-white" style="background:{{ $i['c'] }};">{{ $i['n'] }}</span>
                        <p class="text-sm font-bold text-gray-800">{{ $i['t'] }}</p>
                    </li>
                    @endforeach
                </ul>
                <div class="mt-4 rounded-2xl px-4 py-3.5 text-center" style="background:linear-gradient(135deg,#fff0ea,#fff7d9);">
                    <p class="font-hand text-xl" style="color:var(--khh-coral);">One platform. One search.</p>
                    <p class="mt-0.5 text-xs font-bold text-gray-500">Free for Australian families.</p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     MISSION
════════════════════════════════════════════════════════════ --}}
<section class="pb-14 lg:pb-16" style="background:var(--khh-paper);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[28px] shadow-[0_16px_48px_rgba(222,97,72,0.18)]" style="background:linear-gradient(115deg,#de6148 0%,#e9744e 45%,#fcc333 100%);">
            <div class="pointer-events-none absolute inset-0 opacity-[0.05]" style="background-image:radial-gradient(circle,rgba(255,255,255,0.9) 1px,transparent 1px); background-size:20px 20px;"></div>
            <div class="pointer-events-none absolute -right-10 -top-10 h-48 w-48 rounded-full opacity-[0.18]" style="background:#fff;"></div>
            <div class="pointer-events-none absolute -bottom-8 left-1/4 h-32 w-32 rounded-full opacity-[0.12]" style="background:#fcc333;"></div>
            <div class="relative px-8 py-12 sm:px-12 lg:px-16 lg:py-14">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <p class="font-hand mb-2 text-xl text-white/70">our mission</p>
                        <h2 class="font-black text-white leading-[1.08]" style="font-size:clamp(1.8rem,3.2vw,2.6rem);">
                            Make finding support for your child feel less overwhelming, more accessible and much faster for every family in Australia.
                        </h2>
                    </div>
                    <div class="flex-shrink-0 text-center">
                        <div class="inline-block rounded-2xl border border-white/25 bg-white/18 px-6 py-5 backdrop-blur-sm">
                            <img src="{{ asset('images/annika-family.jpg') }}" alt="Annika" class="mx-auto mb-2 h-36 w-auto object-cover rounded-xl drop-shadow-lg">
                            <p class="font-hand text-3xl text-white">Annika</p>
                            <p class="mt-1 text-[11px] font-black uppercase tracking-[0.18em] text-white/65">Founder, KHH</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     VALUES
════════════════════════════════════════════════════════════ --}}
<section class="py-14 lg:py-20" style="background:var(--khh-paper);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-12 text-center">
            <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-black uppercase tracking-[0.18em] shadow-sm" style="background:#e9fbf2; color:var(--khh-green);">What we stand for</span>
            <h2 class="mt-4 font-black leading-tight text-gray-900 sm:text-4xl" style="font-size:clamp(1.9rem,3.5vw,2.8rem);">The values behind every decision<br class="hidden sm:block"> at Kids Health Hub.</h2>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @foreach([
                ['bg'=>'linear-gradient(145deg,#fff0ea,#fde8e3)','ic'=>'var(--khh-coral)','icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z','title'=>'Family First','desc'=>'Every feature is built around making life easier for families - not more complicated.'],
                ['bg'=>'linear-gradient(145deg,#e3f8ee,#e9fbf2)','ic'=>'var(--khh-green)','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z','title'=>'Easy to Find','desc'=>'No more hours searching. The right provider found by fit, location and availability.'],
                ['bg'=>'linear-gradient(145deg,#deedf7,#edf5ff)','ic'=>'var(--khh-sky)','icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','title'=>'Trusted & Verified','desc'=>'All providers are reviewed before going live. Families can search with confidence.'],
                ['bg'=>'linear-gradient(145deg,#fef9e3,#fff7d9)','ic'=>'var(--khh-gold)','icon'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064','title'=>'Across Australia','desc'=>'Supporting families in every state and territory - geography shouldn\'t be a barrier.'],
            ] as $v)
            <div class="khh-speciality-card rounded-[22px] p-6" style="background:{{ $v['bg'] }};">
                <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl bg-white/75 shadow-sm" style="color:{{ $v['ic'] }};">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="{{ $v['icon'] }}"/></svg>
                </div>
                <h3 class="mb-2 font-black text-gray-900">{{ $v['title'] }}</h3>
                <p class="text-sm leading-7 text-gray-600">{{ $v['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     FROM THE FOUNDER
════════════════════════════════════════════════════════════ --}}
<section class="pb-14 lg:pb-16" style="background:var(--khh-paper);">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-[28px] shadow-[0_20px_50px_rgba(31,41,55,0.07)]" style="background:linear-gradient(130deg,#fff8f0 0%,#fffdf9 55%,#eef6ff 100%);">
            <div class="h-1" style="background:linear-gradient(90deg,var(--khh-coral),var(--khh-gold),var(--khh-sky),var(--khh-green),var(--khh-sage));"></div>
            <div class="flex flex-col lg:flex-row lg:items-center">
                <div class="flex-1 px-8 py-10 sm:px-10 lg:px-14 lg:py-12">
                    <p class="font-hand mb-2 text-2xl" style="color:var(--khh-green);">from the founder</p>
                    <h3 class="mb-5 text-2xl font-black leading-snug text-gray-900 sm:text-3xl">Proud of what this<br>platform is becoming.</h3>
                    <p class="max-w-xl text-base leading-8 text-gray-600">
                        I am so excited to continue building a platform that supports both families and incredible allied health professionals around the country - making finding support feel less overwhelming and much faster.
                    </p>
                    <div class="mt-8 flex items-center gap-4">
                        <div class="flex h-13 w-13 flex-shrink-0 items-center justify-center rounded-full text-xl font-black text-white shadow" style="background:linear-gradient(135deg,var(--khh-coral),var(--khh-gold)); height:3.25rem; width:3.25rem;">A</div>
                        <div>
                            <p class="font-black text-gray-900">Annika</p>
                            <p class="text-sm text-gray-500">Founder · Speech Pathologist · Mum of three</p>
                        </div>
                    </div>
                </div>
                <div class="hidden flex-shrink-0 items-center justify-center border-l border-gray-100 px-12 lg:flex" style="min-height:200px;">
                    <div class="text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full" style="background:linear-gradient(135deg,#e9fbf2,#edf5ff);">
                            <svg class="h-8 w-8" style="color:var(--khh-green);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        <p class="mt-3 text-xs font-black uppercase tracking-[0.16em]" style="color:var(--khh-green);">Built with love</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     CTA
════════════════════════════════════════════════════════════ --}}
<section class="pb-16 lg:pb-20" style="background:var(--khh-paper);">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[28px]" style="background:linear-gradient(125deg,#de6148 0%,#c94e37 55%,#b8412b 100%); box-shadow:0 24px 60px rgba(222,97,72,0.30);">

            {{-- Dot texture --}}
            <div class="pointer-events-none absolute inset-0 opacity-[0.06]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px); background-size:22px 22px;"></div>

            {{-- Glow accents (no overflow into content) --}}
            <div class="pointer-events-none absolute -top-20 -right-20 h-72 w-72 rounded-full" style="background:radial-gradient(circle,rgba(252,195,51,0.30),transparent 70%);"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-10 h-60 w-60 rounded-full" style="background:radial-gradient(circle,rgba(255,255,255,0.12),transparent 70%);"></div>

            <div class="relative z-10 flex flex-col gap-10 px-8 py-12 sm:px-12 sm:py-14 lg:flex-row lg:items-center lg:gap-16 lg:px-16">

                {{-- Left: heading + trust pills --}}
                <div class="flex-1">
                    <span class="font-hand text-xl block mb-2" style="color:rgba(255,255,255,0.65);">for families &amp; providers</span>
                    <h2 class="font-black text-white leading-tight" style="font-size:clamp(2rem,3.4vw,2.8rem); letter-spacing:-0.02em;">
                        Ready to find<br>the right support?
                    </h2>
                    <p class="mt-4 max-w-md text-base text-white/75 leading-relaxed">
                        Search child healthcare providers across Australia - completely free for families.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black" style="background:rgba(255,255,255,0.15); color:#fff;">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Free for families
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black" style="background:rgba(255,255,255,0.15); color:#fff;">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            No account needed
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-black" style="background:rgba(255,255,255,0.15); color:#fff;">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Australia-wide
                        </span>
                    </div>
                </div>

                {{-- Right: two CTA cards --}}
                <div class="flex flex-shrink-0 flex-col gap-4 sm:flex-row lg:flex-col lg:w-60">
                    <a href="{{ route('providers.index') }}" class="flex items-center gap-3 rounded-2xl px-5 py-4 font-black text-sm transition-all hover:scale-[1.02]" style="background:#fff; color:var(--khh-coral); box-shadow:0 8px 24px rgba(0,0,0,0.12);">
                        <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl" style="background:#fff0ea;">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <span>
                            <span class="block">Find Providers</span>
                            <span class="block text-xs font-medium mt-0.5" style="color:#aaa;">Browse the directory</span>
                        </span>
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center gap-3 rounded-2xl border-2 px-5 py-4 font-black text-sm text-white transition-all hover:bg-white/10" style="border-color:rgba(255,255,255,0.35);">
                        <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl" style="background:rgba(255,255,255,0.15);">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </span>
                        <span>
                            <span class="block">List Your Practice</span>
                            <span class="block text-xs font-medium mt-0.5 text-white/60">3-month free trial</span>
                        </span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
