@extends('layouts.dashboard')
@section('title', 'Pricing Settings')
@section('page-title', 'Pricing Settings')

@section('content')

{{-- Page header --}}
<div class="mb-6 flex items-center justify-between">
    <div>
        <p class="text-sm text-gray-500 mt-0.5">Control what appears on the public <a href="{{ route('pricing') }}" target="_blank" class="underline hover:text-violet-600">pricing page ↗</a></p>
    </div>
    <a href="{{ route('pricing') }}" target="_blank"
        class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-bold transition-colors border-2"
        style="color:#de6148; border-color:#de6148;"
        onmouseover="this.style.background='#de6148'; this.style.color='#fff';"
        onmouseout="this.style.background='transparent'; this.style.color='#de6148';">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        Preview Public Page
    </a>
</div>

@if(session('success'))
<div class="mb-6 rounded-2xl px-5 py-4 flex items-center gap-3" style="background:#f0fdf4; border:1px solid #bbf7d0;">
    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
</div>
@endif

<form action="{{ route('admin.pricing.update') }}" method="POST" class="space-y-6">
    @csrf @method('PATCH')

    {{-- ── PRICES ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:#fff0ea;">
                <svg class="w-4 h-4" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h2 class="text-base font-extrabold text-gray-900">Plan Prices</h2>
                <p class="text-xs text-gray-400">All plans are billed annually (AUD). Changes reflect on the public pricing page instantly.</p>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['name'=>'price_sole',           'label'=>'Sole Practitioner', 'sub'=>'1 discipline', 'value'=>$priceSole,     'color'=>'#0dc066'],
                ['name'=>'price_standard',       'label'=>'Standard Listing',  'sub'=>'Up to 2 disciplines', 'value'=>$priceStandard, 'color'=>'#6d28d9'],
                ['name'=>'price_featured',       'label'=>'Featured Listing',  'sub'=>'Priority placement', 'value'=>$priceFeatured, 'color'=>'#de6148'],
                ['name'=>'price_addon_category', 'label'=>'Add-on Category',   'sub'=>'Per extra discipline', 'value'=>$priceAddon,   'color'=>'#c4920a'],
            ] as $p)
            <div class="rounded-xl p-4" style="background:#f9fafb; border:1px solid #e5e7eb;">
                <p class="text-xs font-black mb-0.5" style="color:{{ $p['color'] }};">{{ $p['label'] }}</p>
                <p class="text-[11px] text-gray-400 mb-3">{{ $p['sub'] }}</p>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm">$</span>
                    <input type="number" name="{{ $p['name'] }}" value="{{ $p['value'] }}" min="0"
                        class="w-full border border-gray-200 rounded-xl pl-7 pr-3 py-2.5 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-violet-300 focus:border-violet-300 outline-none bg-white transition">
                </div>
                <p class="text-[11px] text-gray-400 mt-1.5">AUD / year</p>
            </div>
            @endforeach
        </div>

        <div class="mt-4 rounded-xl p-4 flex items-start gap-3" style="background:#eff6ff; border:1px solid #bfdbfe;">
            <svg class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-xs text-blue-700 leading-relaxed">These prices are display-only — they appear on the public pricing page but do not automatically update Stripe. If you change prices, update your Stripe products separately and let your developer know.</p>
        </div>
    </div>

    {{-- ── SOLE FEATURES ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="{ items: {{ json_encode($soleFeatures) }} }">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:#e9fbf2;">
                    <svg class="w-4 h-4" style="color:#0dc066;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-gray-900">Sole Practitioner — Feature List</h2>
                    <p class="text-xs text-gray-400">Bullet points shown on the Sole Practitioner plan card (${{ number_format($priceSole) }}/yr)</p>
                </div>
            </div>
            <button type="button" @click="items.push('')"
                class="flex-shrink-0 text-xs font-bold px-3 py-1.5 rounded-lg border-2 transition-colors"
                style="color:#0dc066; border-color:#0dc066;"
                onmouseover="this.style.background='#0dc066'; this.style.color='#fff';"
                onmouseout="this.style.background='transparent'; this.style.color='#0dc066';">
                + Add Item
            </button>
        </div>
        <div class="space-y-2">
            <template x-for="(item, index) in items" :key="index">
                <div class="flex items-center gap-2">
                    <div class="flex-shrink-0 w-5 h-5 rounded-full flex items-center justify-center mt-0.5" style="background:#0dc066;">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <input type="text" :name="'sole_features[' + index + ']'" x-model="items[index]"
                        class="flex-1 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none bg-gray-50 focus:bg-white transition"
                        placeholder="Feature bullet point">
                    <button type="button" @click="items.splice(index, 1)"
                        class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </template>
            <p x-show="items.length === 0" class="text-xs text-gray-400 py-2 text-center">No items yet — click "+ Add Item".</p>
        </div>
    </div>

    {{-- ── STANDARD FEATURES ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="{ items: {{ json_encode($standardFeatures) }} }">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center bg-violet-50">
                    <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-gray-900">Standard Listing — Feature List</h2>
                    <p class="text-xs text-gray-400">Bullet points shown on the Standard plan card (${{ number_format($priceStandard) }}/yr)</p>
                </div>
            </div>
            <button type="button" @click="items.push('')"
                class="flex-shrink-0 text-xs font-bold px-3 py-1.5 rounded-lg border-2 transition-colors"
                style="color:#6d28d9; border-color:#6d28d9;"
                onmouseover="this.style.background='#6d28d9'; this.style.color='#fff';"
                onmouseout="this.style.background='transparent'; this.style.color='#6d28d9';">
                + Add Item
            </button>
        </div>
        <div class="space-y-2">
            <template x-for="(item, index) in items" :key="index">
                <div class="flex items-center gap-2">
                    <div class="flex-shrink-0 w-5 h-5 rounded-full flex items-center justify-center mt-0.5 bg-violet-600">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <input type="text" :name="'standard_features[' + index + ']'" x-model="items[index]"
                        class="flex-1 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-violet-300 outline-none bg-gray-50 focus:bg-white transition"
                        placeholder="Feature bullet point">
                    <button type="button" @click="items.splice(index, 1)"
                        class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </template>
            <p x-show="items.length === 0" class="text-xs text-gray-400 py-2 text-center">No items yet — click "+ Add Item".</p>
        </div>
    </div>

    {{-- ── FEATURED EXTRAS ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="{ items: {{ json_encode($featuredExtras) }} }">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:#fff0ea;">
                    <svg class="w-4 h-4" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-gray-900">Featured Listing — Extra Features</h2>
                    <p class="text-xs text-gray-400">What Featured adds on top of Standard — shown separately on the Featured plan card (${{ number_format($priceFeatured) }}/yr)</p>
                </div>
            </div>
            <button type="button" @click="items.push('')"
                class="flex-shrink-0 text-xs font-bold px-3 py-1.5 rounded-lg border-2 transition-colors"
                style="color:#de6148; border-color:#de6148;"
                onmouseover="this.style.background='#de6148'; this.style.color='#fff';"
                onmouseout="this.style.background='transparent'; this.style.color='#de6148';">
                + Add Item
            </button>
        </div>
        <div class="space-y-2">
            <template x-for="(item, index) in items" :key="index">
                <div class="flex items-center gap-2">
                    <div class="flex-shrink-0 w-5 h-5 rounded-full flex items-center justify-center mt-0.5" style="background:#de6148;">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <input type="text" :name="'featured_extras[' + index + ']'" x-model="items[index]"
                        class="flex-1 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-violet-300 outline-none bg-gray-50 focus:bg-white transition"
                        placeholder="Feature bullet point">
                    <button type="button" @click="items.splice(index, 1)"
                        class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </template>
            <p x-show="items.length === 0" class="text-xs text-gray-400 py-2 text-center">No items yet — click "+ Add Item".</p>
        </div>
    </div>

    {{-- Save --}}
    <div class="flex items-center gap-4">
        <button type="submit" class="inline-flex items-center gap-2 text-white font-bold px-7 py-3 rounded-xl transition-colors text-sm shadow-sm" style="background:#de6148;" onmouseover="this.style.background='#c94135'" onmouseout="this.style.background='#de6148'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Save Pricing Settings
        </button>
        <a href="{{ route('pricing') }}" target="_blank" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
            Preview public page ↗
        </a>
    </div>

</form>

@endsection
