@extends('layouts.public')
@section('title', 'About Kids Health Hub - Annika\'s Story')
@section('meta_description', 'Kids Health Hub was founded by Annika, a Speech Pathologist and mum of three, to help Australian families find the right child healthcare support faster and easier.')

@section('content')

<section class="relative overflow-hidden" style="background:#fff8f0;">
    <div class="absolute inset-x-0 top-0 h-2 grid grid-cols-5">
        <span style="background:#de6148;"></span>
        <span style="background:#fcc333;"></span>
        <span style="background:#79a2cc;"></span>
        <span style="background:#0dc066;"></span>
        <span style="background:#a8cf77;"></span>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-10 lg:pt-16 lg:pb-12">
        <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
            <div class="relative z-10 max-w-2xl lg:pr-4">
                <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:#de6148;">About Kids Health Hub</p>
                <h1 class="mt-4 text-4xl font-black leading-[0.98] text-gray-900 sm:text-5xl lg:text-[4.6rem]">
                    Hi, I'm <span style="color:#0dc066;">Annika</span>
                </h1>
                <p class="mt-5 max-w-xl text-lg leading-8 text-gray-700">
                    Founder of Kids Health Hub, Speech Pathologist, and a mum of three.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    @foreach([
                        ['text' => 'Speech Pathologist', 'color' => '#0dc066', 'bg' => '#e9fbf2'],
                        ['text' => 'Mum of three', 'color' => '#de6148', 'bg' => '#fff0ea'],
                        ['text' => 'KHH Founder', 'color' => '#79a2cc', 'bg' => '#edf5ff'],
                    ] as $badge)
                        <span class="inline-flex items-center px-4 py-2 text-sm font-black shadow-sm" style="background:{{ $badge['bg'] }}; color:{{ $badge['color'] }};">
                            {{ $badge['text'] }}
                        </span>
                    @endforeach
                </div>

                <div class="mt-10 max-w-xl border-l-4 bg-white px-6 py-6 shadow-sm" style="border-color:#fcc333;">
                    <p class="text-xl font-extrabold leading-8 text-gray-900">
                        Built to make finding support feel less overwhelming, more accessible and much faster for families across Australia.
                    </p>
                </div>

                <div class="mt-8 grid max-w-xl gap-3 sm:grid-cols-3">
                    <div class="bg-white px-4 py-4 shadow-sm">
                        <p class="text-xs font-black uppercase tracking-[0.16em]" style="color:#de6148;">Families</p>
                        <p class="mt-2 text-sm font-bold leading-6 text-gray-700">Searching with less stress and more clarity.</p>
                    </div>
                    <div class="bg-white px-4 py-4 shadow-sm">
                        <p class="text-xs font-black uppercase tracking-[0.16em]" style="color:#79a2cc;">Care</p>
                        <p class="mt-2 text-sm font-bold leading-6 text-gray-700">Finding support by fit, place and availability.</p>
                    </div>
                    <div class="bg-white px-4 py-4 shadow-sm">
                        <p class="text-xs font-black uppercase tracking-[0.16em]" style="color:#0dc066;">Australia</p>
                        <p class="mt-2 text-sm font-bold leading-6 text-gray-700">Built for families across the country.</p>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow-[0_24px_60px_rgba(31,41,55,0.12)]">
                <div class="grid h-3 grid-cols-5">
                    <span style="background:#de6148;"></span>
                    <span style="background:#fcc333;"></span>
                    <span style="background:#79a2cc;"></span>
                    <span style="background:#0dc066;"></span>
                    <span style="background:#a8cf77;"></span>
                </div>

                <div class="p-6 sm:p-8" style="background:linear-gradient(135deg,#fff0ea 0%,#fff8f0 42%,#edf5ff 100%);">
                    <div class="grid gap-4 sm:grid-cols-[minmax(0,1fr)_170px] sm:items-start">
                        <div class="bg-white px-5 py-5 shadow-sm">
                            <p class="text-xs font-black uppercase tracking-[0.16em]" style="color:#de6148;">Founder note</p>
                            <p class="mt-3 text-lg font-black leading-tight text-gray-900 sm:text-xl">Built from real appointments, real searching, and real family pressure.</p>
                        </div>

                        <div class="hidden bg-white/92 px-4 py-4 shadow-sm sm:block">
                            <p class="text-xs font-black uppercase tracking-[0.16em]" style="color:#79a2cc;">Kids Health Hub</p>
                            <p class="mt-2 text-sm font-bold leading-6 text-gray-700">A calmer, clearer way for families to find support.</p>
                        </div>
                    </div>

                    <div class="relative mt-6 overflow-hidden" style="background:linear-gradient(180deg,rgba(255,255,255,0.2),rgba(255,255,255,0.55));">
                        <div class="absolute inset-y-0 right-0 w-[72%]" style="background:linear-gradient(180deg,rgba(243,206,102,0.18) 0%,rgba(121,162,204,0.10) 52%,rgba(13,192,102,0.08) 100%);"></div>
                        <div class="relative z-10 flex h-[320px] items-end justify-center px-5 pt-5 sm:h-[380px] lg:h-[430px]">
                            @if(file_exists(public_path('images/annika.svg')))
                                <img src="{{ asset('images/annika.svg') }}" alt="Annika" class="h-full w-full object-contain object-bottom">
                            @elseif(file_exists(public_path('images/logo.svg')))
                                <img src="{{ asset('images/logo.svg') }}" alt="Kids Health Hub" class="h-auto w-64 object-contain">
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 grid gap-0 sm:grid-cols-[minmax(0,1fr)_128px] sm:items-stretch">
                        <div class="bg-white/92 px-6 py-5">
                            <p class="text-xs font-black uppercase tracking-[0.16em]" style="color:#0dc066;">Annika</p>
                            <p class="mt-2 text-base font-semibold leading-7 text-gray-700">
                                Speech Pathologist, founder, and parent perspective shaping a more useful way for families to find support.
                            </p>
                        </div>
                        <div class="hidden sm:grid sm:grid-cols-2">
                            <span class="h-16 w-16" style="background:#de6148;"></span>
                            <span class="h-16 w-16" style="background:#fcc333;"></span>
                            <span class="h-16 w-16" style="background:#79a2cc;"></span>
                            <span class="h-16 w-16" style="background:#0dc066;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-14 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[320px_minmax(0,1fr)]">
            <div class="lg:pt-2">
                <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:#0dc066;">Why this platform exists</p>
                <h2 class="mt-3 text-3xl font-black leading-tight text-gray-900">Families needed a clearer way to find the right support.</h2>
                <div class="mt-7 space-y-3">
                    <div class="flex items-start gap-3 bg-[#fff8f0] px-4 py-4">
                        <span class="mt-1 h-3 w-3 flex-shrink-0 rounded-full" style="background:#de6148;"></span>
                        <p class="text-sm font-bold leading-6 text-gray-700">Too much searching, too little clarity.</p>
                    </div>
                    <div class="flex items-start gap-3 bg-[#edf5ff] px-4 py-4">
                        <span class="mt-1 h-3 w-3 flex-shrink-0 rounded-full" style="background:#79a2cc;"></span>
                        <p class="text-sm font-bold leading-6 text-gray-700">Families needed confidence, not another list of names.</p>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden shadow-sm" style="background:#fffdf8;">
                <div class="grid gap-0 lg:grid-cols-[minmax(0,1fr)_240px]">
                    <div class="p-6 sm:p-8 lg:p-10">
                        <p class="text-lg leading-8 text-gray-700">
                            Over the years, I've worked with countless families navigating the overwhelming process of
                            trying to find the right therapist for their child. One of the biggest challenges parents
                            consistently shared was not just finding a provider, but finding someone who:
                        </p>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2">
                            @foreach([
                                ['color'=>'#0dc066','bg'=>'#e9fbf2','text'=>'Has availability'],
                                ['color'=>'#79a2cc','bg'=>'#edf5ff','text'=>'Services their area'],
                                ['color'=>'#de6148','bg'=>'#fff0ea','text'=>'Has experience in their child\'s specific needs'],
                                ['color'=>'#fcc333','bg'=>'#fff7d9','text'=>'Can support them in a way that feels like the right fit'],
                            ] as $item)
                                <div class="min-h-[164px] border border-white bg-white p-5 shadow-sm">
                                    <div class="flex h-10 w-10 items-center justify-center text-white" style="background:{{ $item['color'] }};">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <p class="mt-6 text-base font-black leading-7 text-gray-900">{{ $item['text'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="relative overflow-hidden px-6 py-8" style="background:linear-gradient(180deg,#fff0ea 0%,#fff8f0 100%);">
                        <div class="absolute inset-x-0 top-0 h-2" style="background:linear-gradient(90deg,#de6148,#fcc333,#79a2cc,#0dc066);"></div>
                        <div class="relative z-10">
                            <p class="text-xs font-black uppercase tracking-[0.16em]" style="color:#de6148;">What families needed</p>
                            <p class="mt-4 text-2xl font-black leading-tight text-gray-900">One clear place to search with confidence.</p>
                            <p class="mt-4 text-sm font-semibold leading-6 text-gray-700">A better system starts with making the search feel easier, more transparent and less exhausting.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-14 lg:py-16" style="background:#fffdf8;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_380px]">
            <div class="overflow-hidden bg-white shadow-sm">
                <div class="grid h-2 grid-cols-4">
                    <span style="background:#de6148;"></span>
                    <span style="background:#fcc333;"></span>
                    <span style="background:#79a2cc;"></span>
                    <span style="background:#0dc066;"></span>
                </div>
                <div class="p-7 sm:p-9">
                    <div class="space-y-6 text-base leading-8 text-gray-700">
                        <p>
                            As both a clinician and a parent attending appointments myself, I saw firsthand how
                            <strong>stressful and time-consuming</strong> this process can be. Families were spending hours
                            searching websites, joining Facebook groups, calling clinics, and sitting on waitlists without
                            clear answers.
                        </p>

                        <div class="border-l-4 px-6 py-5" style="border-color:#0dc066; background:#eefcf4;">
                            <p class="text-2xl font-black leading-tight text-gray-900">
                                That's why I created Kids Health Hub
                            </p>
                        </div>

                        <p>
                            Kids Health Hub was designed to help close the gap between families and suitable health
                            professionals by creating <strong>one easy-to-use space</strong> where parents can search for
                            providers based on location, profession, availability and areas of experience.
                        </p>

                        <p>
                            Our vision is simple - to make finding support for your child feel
                            <strong>less overwhelming, more accessible and much faster</strong> for families across Australia.
                        </p>

                        <p>
                            I am so excited to continue building a platform that supports both families and incredible
                            allied health professionals around the country.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="grid content-start gap-4">
                <div class="relative overflow-hidden p-6 text-white shadow-sm" style="background:#de6148;">
                    <div class="absolute right-0 top-0 h-24 w-24 opacity-35" style="background:#fcc333;"></div>
                    <p class="relative text-xs font-black uppercase tracking-[0.18em] text-white/80">Mission</p>
                    <p class="relative mt-4 text-2xl font-black leading-tight">Make support easier to find, compare and contact.</p>
                </div>

                <div class="bg-white p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:#0dc066;">From Annika</p>
                    <div class="mt-5 flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center text-xl font-black text-white" style="background:linear-gradient(135deg,#de6148,#fcc333);">A</div>
                        <div>
                            <div class="text-lg font-black text-gray-900">Annika</div>
                            <div class="text-sm text-gray-500">Founder, Kids Health Hub</div>
                            <div class="text-sm text-gray-500">Speech Pathologist &amp; Mum of three</div>
                        </div>
                    </div>
                </div>

                @if(file_exists(public_path('images/annika.svg')))
                    <div class="relative min-h-[360px] overflow-hidden shadow-sm" style="background:linear-gradient(180deg,#edf5ff 0%,#fff8f0 100%);">
                        <div class="absolute inset-x-0 top-0 h-2" style="background:#79a2cc;"></div>
                        <div class="absolute left-5 top-5 z-10 max-w-[190px] bg-white/92 px-4 py-3 backdrop-blur">
                            <p class="text-xs font-black uppercase tracking-[0.16em]" style="color:#79a2cc;">Parent perspective</p>
                            <p class="mt-2 text-sm font-bold leading-6 text-gray-700">Built around what families actually need when they are under pressure and short on time.</p>
                        </div>
                        <img src="{{ asset('images/annika.svg') }}" alt="Annika" class="absolute bottom-0 right-0 h-[90%] w-full object-contain object-bottom">
                    </div>
                @endif
            </aside>
        </div>
    </div>
</section>

<section class="bg-white py-14 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p class="font-hand mb-1 text-2xl" style="color:#de6148;">what we stand for</p>
                <h2 class="text-3xl font-black leading-tight text-gray-900 sm:text-4xl">The values behind every decision we make at Kids Health Hub.</h2>
            </div>
            <div class="inline-flex w-fit px-4 py-2 text-xs font-black uppercase tracking-[0.16em] text-gray-700" style="background:#fff0ea;">
                Built with families in mind
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach([
                ['icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z','color'=>'#de6148','bg'=>'#fff0ea','title'=>'Family first','desc'=>'Every feature is built around making life easier for families.'],
                ['icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z','color'=>'#0dc066','bg'=>'#e9fbf2','title'=>'Easy to find','desc'=>'No more hours of searching - the right provider, fast.'],
                ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','color'=>'#79a2cc','bg'=>'#edf5ff','title'=>'Trusted & verified','desc'=>'All providers reviewed before going live on the platform.'],
                ['icon'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064','color'=>'#fcc333','bg'=>'#fff7d9','title'=>'Across Australia','desc'=>'Supporting families in every state and territory.'],
            ] as $value)
                <div class="border border-gray-100 bg-white p-6 shadow-sm transition-transform duration-200 hover:-translate-y-1">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center" style="background:{{ $value['bg'] }};">
                        <svg class="h-6 w-6" style="color:{{ $value['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $value['icon'] }}"/></svg>
                    </div>
                    <h3 class="mb-2 font-black text-gray-900">{{ $value['title'] }}</h3>
                    <p class="text-sm leading-7 text-gray-500">{{ $value['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="border-t border-gray-100 py-14 lg:py-16" style="background:#fff8f0;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm">
            <div class="grid h-2 grid-cols-4">
                <span style="background:#de6148;"></span>
                <span style="background:#fcc333;"></span>
                <span style="background:#79a2cc;"></span>
                <span style="background:#0dc066;"></span>
            </div>
            <div class="grid gap-0 lg:grid-cols-[minmax(0,1fr)_220px]">
                <div class="p-8 sm:p-10">
                    <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:#de6148;">Start searching</p>
                    <h2 class="mt-3 text-3xl font-black text-gray-900">Ready to find the right support?</h2>
                    <p class="mt-3 max-w-2xl text-gray-600">Search thousands of child healthcare providers across Australia - free for families.</p>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="{{ route('providers.index') }}" class="khh-btn-primary px-7 py-3 text-white font-bold shadow-sm">Find Providers</a>
                        <a href="{{ route('register') }}" class="border-2 px-7 py-3 font-bold transition-colors" style="color:#de6148; border-color:#de6148;" onmouseover="this.style.background='#fff7ed'" onmouseout="this.style.background='transparent'">List Your Practice</a>
                    </div>
                </div>
                <div class="grid grid-rows-4">
                    <span style="background:#de6148;"></span>
                    <span style="background:#fcc333;"></span>
                    <span style="background:#79a2cc;"></span>
                    <span style="background:#0dc066;"></span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
