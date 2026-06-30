@extends('layouts.public')
@section('title', 'Pricing — Kids Health Hub')
@section('meta_description', 'Flexible annual membership packages for child healthcare providers. Sole practitioner, standard and featured listings — all with a free trial included.')

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════════ --}}
<section class="py-16 lg:py-20" style="background:var(--khh-paper);">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-black uppercase tracking-[0.18em] shadow-sm mb-5" style="background:#fff0ea; color:var(--khh-coral);">Pricing</span>
        <h1 class="font-black text-gray-900 leading-tight mb-4" style="font-size:clamp(2.2rem,5vw,3.6rem);">
            Flexible packages for<br>
            <span class="font-hand" style="color:var(--khh-green); font-size:1.1em;">every practice.</span>
        </h1>
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto">
            Kids Health Hub offers flexible advertising packages to help you connect with local families.
            All memberships are billed annually — start with a free {{ $trialMonths }}-month trial, no credit card required.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     FREE TRIAL BANNER
════════════════════════════════════════════════════════════ --}}
<section class="pb-6" style="background:var(--khh-paper);">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-2xl px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-4" style="background:linear-gradient(115deg,#e9fbf2,#d4f5e5); border:2px solid #0dc066;">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-11 h-11 rounded-2xl flex items-center justify-center" style="background:#0dc066;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                </div>
                <div>
                    <p class="font-black text-gray-900">{{ $trialMonths }}-Month Free Trial on Every Plan</p>
                    <p class="text-sm text-gray-600">Every new provider listing starts with a full {{ $trialMonths }}-month free trial. No credit card required.</p>
                </div>
            </div>
            <a href="{{ route('register') }}" class="flex-shrink-0 font-black text-white px-6 py-3 rounded-xl text-sm transition-all shadow-md hover:shadow-lg whitespace-nowrap" style="background:#0dc066;" onmouseover="this.style.background='#0aad5a'" onmouseout="this.style.background='#0dc066'">
                Start Free Trial →
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     PLAN CARDS
════════════════════════════════════════════════════════════ --}}
<section class="py-10 lg:py-14" style="background:var(--khh-paper);">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-3 mt-4">

            {{-- ── SOLE PRACTITIONER ── --}}
            <div class="relative rounded-3xl bg-white border-2 border-gray-100 p-8 flex flex-col shadow-sm hover:shadow-md transition-shadow">
                <div class="mb-5">
                    <p class="text-xs font-black uppercase tracking-[0.18em] mb-2" style="color:#0dc066;">Sole Practitioners Only</p>
                    <h2 class="text-xl font-black text-gray-900 leading-tight mb-3">Sole Practitioner</h2>
                    <p class="text-sm text-gray-500 leading-relaxed">Perfect for sole practitioners wanting an affordable and professional presence within the Kids Health Hub directory.</p>
                </div>

                <div class="flex items-end gap-2 mb-6 pb-6 border-b border-gray-100">
                    <span class="font-black text-gray-900" style="font-size:2.8rem; line-height:1;">${{ number_format($priceSole) }}</span>
                    <span class="text-gray-400 font-semibold mb-1.5">AUD / year</span>
                </div>

                <ul class="space-y-3 mb-8 flex-1">
                    @foreach($soleFeatures as $feature)
                    <li class="flex items-start gap-3 text-sm text-gray-700">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>

                @if($priceAddon > 0)
                <div class="rounded-xl px-4 py-3 mb-6 text-xs text-gray-500" style="background:#f9fafb; border:1px solid #e5e7eb;">
                    <strong class="text-gray-700">Additional profession categories:</strong> ${{ number_format($priceAddon) }} per category, per year.
                </div>
                @endif

                <a href="{{ route('register') }}" class="w-full text-center font-black py-3.5 rounded-xl text-sm transition-all border-2" style="color:#0dc066; border-color:#0dc066;" onmouseover="this.style.background='#0dc066'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='#0dc066';">
                    Get Started →
                </a>
            </div>

            {{-- ── STANDARD LISTING ── --}}
            <div class="relative rounded-3xl bg-white border-2 p-8 flex flex-col shadow-sm hover:shadow-md transition-shadow" style="border-color:#6d28d9; padding-top:2.5rem;">
                <div class="absolute top-0 left-0 right-0 flex justify-center -translate-y-1/2">
                    <span class="inline-block rounded-full px-4 py-1 text-xs font-black text-white shadow-sm whitespace-nowrap" style="background:#6d28d9;">Most Popular</span>
                </div>

                <div class="mb-5">
                    <p class="text-xs font-black uppercase tracking-[0.18em] mb-2" style="color:#6d28d9;">Companies &amp; Multi-Disciplinary</p>
                    <h2 class="text-xl font-black text-gray-900 leading-tight mb-3">Standard Listing</h2>
                    <p class="text-sm text-gray-500 leading-relaxed">Perfect for companies and multidisciplinary practices wanting to advertise across up to two service categories.</p>
                </div>

                <div class="flex items-end gap-2 mb-6 pb-6 border-b border-gray-100">
                    <span class="font-black text-gray-900" style="font-size:2.8rem; line-height:1;">${{ number_format($priceStandard) }}</span>
                    <span class="text-gray-400 font-semibold mb-1.5">AUD / year</span>
                </div>

                <ul class="space-y-3 mb-8 flex-1">
                    @foreach($standardFeatures as $feature)
                    <li class="flex items-start gap-3 text-sm text-gray-700">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color:#6d28d9;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>

                @if($priceAddon > 0)
                <div class="rounded-xl px-4 py-3 mb-6 text-xs" style="background:#f5f3ff; border:1px solid #e0d9ff; color:#6d28d9;">
                    <strong>Additional profession categories:</strong> ${{ number_format($priceAddon) }} per category, per year.
                </div>
                @endif

                <a href="{{ route('register') }}" class="w-full text-center font-black py-3.5 rounded-xl text-sm transition-all text-white" style="background:#6d28d9;" onmouseover="this.style.background='#5b21b6'" onmouseout="this.style.background='#6d28d9'">
                    Get Started →
                </a>
            </div>

            {{-- ── FEATURED LISTING ── --}}
            <div class="relative rounded-3xl p-8 flex flex-col shadow-lg" style="background:linear-gradient(145deg,#de6148,#e9744e,#fcc333); padding-top:2.5rem;">
                <div class="absolute top-0 left-0 right-0 flex justify-center -translate-y-1/2">
                    <span class="inline-block rounded-full px-4 py-1 text-xs font-black text-white shadow-md whitespace-nowrap" style="background:#1f2937;">⭐ Highest Visibility</span>
                </div>

                <div class="mb-5">
                    <p class="text-xs font-black uppercase tracking-[0.18em] mb-2 text-white/80">Priority Placement</p>
                    <h2 class="text-xl font-black text-white leading-tight mb-3">Featured Listing</h2>
                    <p class="text-sm text-white/80 leading-relaxed">Our highest-level membership package for businesses wanting enhanced promotion and priority visibility throughout the Kids Health Hub community.</p>
                </div>

                <div class="flex items-end gap-2 mb-6 pb-6 border-b border-white/20">
                    <span class="font-black text-white" style="font-size:2.8rem; line-height:1;">${{ number_format($priceFeatured) }}</span>
                    <span class="text-white/70 font-semibold mb-1.5">AUD / year</span>
                </div>

                <ul class="space-y-3 mb-8 flex-1">
                    @foreach($featuredExtras as $extra)
                    <li class="flex items-start gap-3 text-sm text-white">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        {{ $extra }}
                    </li>
                    @endforeach
                </ul>

                @if($priceAddon > 0)
                <div class="rounded-xl px-4 py-3 mb-6 text-xs text-white/90" style="background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.25);">
                    <strong class="text-white">Additional profession categories:</strong> ${{ number_format($priceAddon) }} per category, per year.
                </div>
                @endif

                <a href="{{ route('register') }}" class="w-full text-center font-black py-3.5 rounded-xl text-sm transition-all bg-white hover:bg-gray-50" style="color:var(--khh-coral);">
                    Get Started →
                </a>
            </div>
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">All prices in AUD. GST may apply. Annual memberships renew automatically and can be cancelled from your provider dashboard.</p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     ADD-ON CALLOUT
════════════════════════════════════════════════════════════ --}}
@if($priceAddon > 0)
<section class="py-8" style="background:#fff;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-2xl px-8 py-7 flex flex-col sm:flex-row items-center gap-6" style="background:var(--khh-paper); border:2px dashed #e5e7eb;">
            <div class="flex-shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center" style="background:#fff0ea;">
                <svg class="w-6 h-6" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </div>
            <div class="flex-1 text-center sm:text-left">
                <p class="font-black text-gray-900 text-lg mb-1">Need more than two service categories?</p>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Any plan can be extended with additional profession categories for just
                    <strong class="text-gray-800">${{ number_format($priceAddon) }} per category, per year</strong>.
                    For example, a practice covering Speech Pathology, Occupational Therapy, and Psychology would pay ${{ number_format($priceStandard) }} + ${{ number_format($priceAddon) }} = <strong class="text-gray-800">${{ number_format($priceStandard + $priceAddon) }}/year</strong>.
                </p>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     WHAT'S INCLUDED IN ALL PLANS
════════════════════════════════════════════════════════════ --}}
<section class="py-12 lg:py-16" style="background:#fff;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center font-black text-gray-900 mb-3" style="font-size:clamp(1.6rem,3vw,2.2rem);">Every listing includes</h2>
        <p class="text-center text-gray-500 text-sm mb-10">Regardless of which plan you choose, all Kids Health Hub members receive:</p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach([
                ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'title'=>'Public directory listing', 'desc'=>'Families can find your profile on Kids Health Hub and browse your services.'],
                ['icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title'=>'Unlimited enquiries', 'desc'=>'Families can contact you directly — no limits on how many enquiries you receive.'],
                ['icon'=>'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z', 'title'=>'DIY profile updates', 'desc'=>'Update your bio, services, photos and contact details yourself at any time.'],
                ['icon'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064', 'title'=>'Website & contact links', 'desc'=>'Your phone number, email, and website are displayed prominently on your profile.'],
                ['icon'=>'M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z', 'title'=>'Social media welcome post', 'desc'=>'A welcome post about your practice on the Kids Health Hub social media profile.'],
                ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title'=>'12 months membership', 'desc'=>'Full-year listing — your profile stays live for the entire membership period.'],
            ] as $item)
            <div class="rounded-2xl bg-white border border-gray-100 p-5 shadow-sm">
                <div class="w-9 h-9 rounded-xl bg-gray-50 flex items-center justify-center mb-3">
                    <svg class="w-4.5 h-4.5" style="color:var(--khh-coral);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
                </div>
                <p class="font-black text-gray-800 text-sm mb-1">{{ $item['title'] }}</p>
                <p class="text-xs text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     FAQ
════════════════════════════════════════════════════════════ --}}
<section class="py-12 lg:py-16" style="background:var(--khh-paper);">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center font-black text-gray-900 mb-10" style="font-size:clamp(1.6rem,3vw,2.2rem);">Frequently asked questions</h2>
        <div class="space-y-4" x-data="{ open: null }">
            @php
            $faqs = [
                ['q' => 'Do I need a credit card to start the free trial?',
                 'a' => 'No. Your free ' . $trialMonths . '-month trial starts automatically when you register — no payment details required. You\'ll only be asked for payment when your trial ends.'],
                ['q' => 'Which plan is right for my practice?',
                 'a' => 'If you are a sole practitioner working in one discipline, the Sole Practitioner plan ($' . number_format($priceSole) . '/yr) is the best value. If you operate as a company or across two disciplines, go with the Standard Listing ($' . number_format($priceStandard) . '/yr). If you want maximum visibility — top of search results, social media features, and homepage placement — choose the Featured Listing ($' . number_format($priceFeatured) . '/yr).'],
                ['q' => 'What if I offer more than two service categories?',
                 'a' => 'No problem. Any plan supports additional profession categories for $' . number_format($priceAddon) . ' per extra category per year. So if you offer three disciplines (e.g. Speech, OT, and Psychology), you\'d pay your plan price plus $' . number_format($priceAddon) . '.'],
                ['q' => 'Can I upgrade my plan later?',
                 'a' => 'Yes — you can upgrade from Sole or Standard to Featured at any time from your provider dashboard. Contact us and we will sort it out.'],
                ['q' => 'Can I cancel at any time?',
                 'a' => 'Yes. Annual memberships can be cancelled from your provider dashboard. Your listing stays active until the membership year expires — there are no refunds for unused months.'],
                ['q' => 'Will my listing be removed if I don\'t renew?',
                 'a' => 'Yes — once your trial or membership expires your listing is hidden from families until you renew. Your profile and data are kept safe and reappear as soon as you reactivate.'],
                ['q' => 'How does the Featured badge and homepage placement work?',
                 'a' => 'Featured Listing members get a "Featured Provider" badge on their profile and are placed in the Featured Providers section on the Kids Health Hub homepage. They also appear at the top of search results ahead of Standard and Sole listings.'],
            ];
            @endphp
            @foreach($faqs as $idx => $faq)
            <div class="rounded-2xl bg-white border border-gray-100 overflow-hidden shadow-sm">
                <button class="w-full flex items-center justify-between px-6 py-4 text-left" @click="open = open === {{ $idx }} ? null : {{ $idx }}">
                    <span class="font-bold text-gray-900 text-sm pr-4">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 flex-shrink-0 transition-transform" :class="open === {{ $idx }} ? 'rotate-180' : ''" style="color:var(--khh-coral);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === {{ $idx }}" x-collapse style="display:none;">
                    <p class="px-6 pb-5 text-sm text-gray-600 leading-relaxed">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     CTA
════════════════════════════════════════════════════════════ --}}
<section class="py-14 lg:py-16" style="background:#fff;">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <h2 class="font-black text-gray-900 mb-3" style="font-size:clamp(1.8rem,3.5vw,2.6rem);">Ready to get started?</h2>
        <p class="text-gray-500 mb-8 leading-relaxed">Join Australia's growing directory of trusted child healthcare providers. Your first {{ $trialMonths }} months are completely free.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('register') }}" class="font-black text-white px-8 py-4 rounded-xl text-sm transition-all shadow-md hover:shadow-lg" style="background:var(--khh-coral);" onmouseover="this.style.background='#c94135'" onmouseout="this.style.background='var(--khh-coral)'">
                Start Free {{ $trialMonths }}-Month Trial
            </a>
            <a href="{{ route('about') }}" class="font-black px-8 py-4 rounded-xl text-sm border-2 transition-all" style="color:var(--khh-coral); border-color:var(--khh-coral);" onmouseover="this.style.background='var(--khh-coral)'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='var(--khh-coral)';">
                Learn About KHH
            </a>
        </div>
    </div>
</section>

@endsection
