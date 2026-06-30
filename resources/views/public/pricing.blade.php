@extends('layouts.public')
@section('title', 'Pricing — Kids Health Hub')
@section('meta_description', 'Simple, transparent pricing for healthcare providers. Start with a free ' . $trialMonths . '-month trial. Then choose monthly or annual — no hidden fees.')

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════════ --}}
<section class="py-16 lg:py-20" style="background:var(--khh-paper);">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-black uppercase tracking-[0.18em] shadow-sm mb-5" style="background:#fff0ea; color:var(--khh-coral);">Pricing</span>
        <h1 class="font-black text-gray-900 leading-tight mb-4" style="font-size:clamp(2.2rem,5vw,3.6rem);">
            Simple, transparent<br>
            <span class="font-hand" style="color:var(--khh-green); font-size:1.1em;">pricing.</span>
        </h1>
        <p class="text-lg text-gray-500 leading-relaxed max-w-xl mx-auto">
            Start with a free {{ $trialMonths }}-month trial — no credit card required. After your trial, choose the plan that works best for your practice.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     FREE TRIAL BANNER
════════════════════════════════════════════════════════════ --}}
<section class="pb-4" style="background:var(--khh-paper);">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-2xl px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4" style="background:linear-gradient(115deg,#e9fbf2,#d4f5e5); border:2px solid #0dc066;">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center" style="background:#0dc066;">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                </div>
                <div>
                    <p class="font-black text-gray-900 text-lg">{{ $trialMonths }}-Month Free Trial</p>
                    <p class="text-sm text-gray-600">Every new provider listing starts with a full {{ $trialMonths }}-month free trial. No credit card required to get started.</p>
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
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid gap-6 lg:grid-cols-2">

            {{-- MONTHLY --}}
            <div class="relative rounded-3xl bg-white border-2 border-gray-100 p-8 flex flex-col shadow-sm hover:shadow-md transition-shadow">
                <p class="text-xs font-black uppercase tracking-[0.18em] mb-3" style="color:var(--khh-coral);">Monthly</p>
                <div class="flex items-end gap-2 mb-1">
                    <span class="font-black text-gray-900" style="font-size:3rem; line-height:1;">${{ number_format($priceMonthly) }}</span>
                    <span class="text-gray-400 font-semibold mb-2">AUD / month</span>
                </div>
                <p class="text-sm text-gray-500 mb-8">Billed monthly. Cancel anytime.</p>

                <ul class="space-y-3 mb-8 flex-1">
                    @foreach($monthlyFeatures as $feature)
                    <li class="flex items-start gap-3 text-sm text-gray-700">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>

                <a href="{{ route('register') }}" class="w-full text-center font-black py-3.5 rounded-xl text-sm transition-all border-2" style="color:var(--khh-coral); border-color:var(--khh-coral);" onmouseover="this.style.background='var(--khh-coral)'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='var(--khh-coral)';">
                    Get Started — Monthly
                </a>
            </div>

            {{-- ANNUAL — highlighted --}}
            <div class="relative rounded-3xl p-8 flex flex-col shadow-lg" style="background:linear-gradient(145deg,#de6148,#e9744e,#fcc333);">

                @if($annualSavings > 0)
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                    <span class="inline-block rounded-full px-4 py-1 text-xs font-black text-white shadow-md whitespace-nowrap" style="background:#1f2937;">⭐ Best Value — Save ${{ number_format($annualSavings) }}</span>
                </div>
                @endif

                <p class="text-xs font-black uppercase tracking-[0.18em] mb-3 text-white/80">Annual</p>
                <div class="flex items-end gap-2 mb-1">
                    <span class="font-black text-white" style="font-size:3rem; line-height:1;">${{ number_format($priceAnnual) }}</span>
                    <span class="text-white/70 font-semibold mb-2">AUD / year</span>
                </div>
                <p class="text-sm text-white/75 mb-1">That's just <strong class="text-white">${{ number_format($annualPerMonth) }}/month</strong> — billed annually.</p>
                @if($annualSavings > 0)
                <p class="text-xs text-white/60 mb-8">Save ${{ number_format($annualSavings) }} compared to monthly billing.</p>
                @else
                <p class="text-xs text-white/60 mb-8">&nbsp;</p>
                @endif

                <ul class="space-y-3 mb-8 flex-1">
                    @foreach($annualFeatures as $feature)
                    <li class="flex items-start gap-3 text-sm text-white">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>

                <a href="{{ route('register') }}" class="w-full text-center font-black py-3.5 rounded-xl text-sm transition-all bg-white hover:bg-gray-50" style="color:var(--khh-coral);">
                    Get Started — Annual
                </a>
            </div>
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">All prices in AUD. GST may apply. Subscriptions renew automatically and can be cancelled at any time from your provider dashboard.</p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     COMPARISON TABLE
════════════════════════════════════════════════════════════ --}}
@if(!empty($comparisonRows))
<section class="py-12 lg:py-16" style="background:#fff;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center font-black text-gray-900 mb-10" style="font-size:clamp(1.6rem,3vw,2.2rem);">What's included in every plan</h2>

        <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background:var(--khh-paper);">
                        <th class="text-left px-6 py-4 font-black text-gray-700 w-1/2">Feature</th>
                        <th class="text-center px-4 py-4 font-black" style="color:var(--khh-coral);">Monthly<br><span class="font-semibold text-gray-500 text-xs">${{ number_format($priceMonthly) }}/mo</span></th>
                        <th class="text-center px-4 py-4 font-black" style="color:var(--khh-gold);">Annual<br><span class="font-semibold text-gray-500 text-xs">${{ number_format($priceAnnual) }}/yr</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($comparisonRows as $i => $row)
                    <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50/50' }}">
                        <td class="px-6 py-3.5 font-semibold text-gray-700">{{ $row['label'] }}</td>
                        <td class="text-center px-4 py-3.5">
                            @if($row['monthly'])
                                <svg class="w-5 h-5 mx-auto" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            @else
                                <svg class="w-4 h-4 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            @endif
                        </td>
                        <td class="text-center px-4 py-3.5">
                            @if($row['annual'])
                                <svg class="w-5 h-5 mx-auto" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            @else
                                <svg class="w-4 h-4 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     FAQ
════════════════════════════════════════════════════════════ --}}
<section class="py-12 lg:py-16" style="background:var(--khh-paper);">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center font-black text-gray-900 mb-10" style="font-size:clamp(1.6rem,3vw,2.2rem);">Frequently asked questions</h2>

        <div class="space-y-4" x-data="{ open: null }">
            @php
            $faqs = [
                ['q' => 'Do I need a credit card to start the free trial?', 'a' => 'No. Your free ' . $trialMonths . '-month trial starts automatically when you register — no payment details required. You\'ll only be asked for payment when your trial period ends.'],
                ['q' => 'How do I pay after the trial ends?', 'a' => 'When your trial ends, you\'ll be prompted to upgrade from your provider dashboard. Payment is handled securely via Stripe — you can pay with any major credit or debit card. You\'ll receive a receipt by email.'],
                ['q' => 'Can I cancel at any time?', 'a' => 'Yes. Monthly plans can be cancelled at any time with no penalty — your listing stays active until the end of the billing period. Annual plans can also be cancelled, with the listing active until the year expires.'],
                ['q' => 'Will my listing be removed if I don\'t upgrade?', 'a' => 'Yes — once your trial or paid subscription expires, your listing will be hidden from families until you renew. Your profile and data are kept safe and will reappear as soon as you reactivate.'],
                ['q' => 'Is there a GST invoice available?', 'a' => 'Yes. Annual subscribers receive a full tax invoice. Monthly subscribers receive a receipt after each payment. Contact us if you need a specific invoice format.'],
                ['q' => 'Can I switch from monthly to annual?', 'a' => 'Yes — you can upgrade to an annual plan at any time from your provider dashboard to take advantage of the savings.'],
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
