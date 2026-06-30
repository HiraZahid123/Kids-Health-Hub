@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')

<!-- Stats Grid -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['label' => 'Pending Approval', 'value' => $stats['pending'], 'color' => 'amber', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['label' => 'Approved', 'value' => $stats['approved'], 'color' => 'emerald', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['label' => 'On Trial', 'value' => $stats['trial'], 'color' => 'blue', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['label' => 'Featured', 'value' => $stats['featured'], 'color' => 'violet', 'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
    ] as $stat)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $stat['label'] }}</p>
            <div class="w-8 h-8 bg-{{ $stat['color'] }}-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-{{ $stat['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/></svg>
            </div>
        </div>
        <p class="text-3xl font-black text-gray-900">{{ $stat['value'] }}</p>
    </div>
    @endforeach
</div>

<!-- Two column layout -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- Pending providers -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-base font-extrabold text-gray-900">Pending Approvals</h2>
                <p class="text-xs text-gray-400 mt-0.5">Providers awaiting review</p>
            </div>
            <a href="{{ route('admin.providers.index', ['status' => 'pending']) }}" class="text-sm text-violet-600 font-bold hover:underline">View all →</a>
        </div>

        @if($pendingProviders->isEmpty())
            <div class="text-center py-8">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-sm font-semibold text-gray-700">All caught up!</p>
                <p class="text-xs text-gray-400 mt-0.5">No pending providers</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($pendingProviders as $provider)
                    <div class="flex items-center gap-3 p-3.5 bg-amber-50 border border-amber-100 rounded-xl">
                        <div class="w-9 h-9 bg-gradient-to-br from-amber-400 to-orange-400 rounded-xl flex items-center justify-center flex-shrink-0 text-white font-black text-sm">
                            {{ substr($provider->business_name, 0, 1) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-gray-800 text-sm truncate">{{ $provider->business_name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $provider->user->email }} &middot; {{ $provider->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <form action="{{ route('admin.providers.approve', $provider) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-colors">Approve</button>
                            </form>
                            <a href="{{ route('admin.providers.show', $provider) }}" class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-lg transition-colors">Review</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Top Viewed Providers -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="mb-5">
            <h2 class="text-base font-extrabold text-gray-900">Top Viewed Providers</h2>
            <p class="text-xs text-gray-400 mt-0.5">All-time profile view counts</p>
        </div>
        @if($topViewedProviders->isEmpty())
            <div class="text-center py-8">
                <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <p class="text-sm font-semibold text-gray-600">No views recorded yet</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($topViewedProviders as $i => $provider)
                <div class="flex items-center gap-3 py-2.5 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <span class="text-xs font-black text-gray-300 w-5 text-center flex-shrink-0">{{ $i + 1 }}</span>
                    <div class="w-8 h-8 bg-gradient-to-br from-violet-400 to-purple-500 rounded-lg flex items-center justify-center flex-shrink-0 text-white font-black text-xs">
                        {{ substr($provider->business_name, 0, 1) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="font-bold text-gray-800 text-sm truncate">{{ $provider->business_name }}</p>
                        <p class="text-xs text-gray-400">{{ $provider->suburb }}{{ $provider->state ? ', '.$provider->state : '' }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-black text-violet-600">{{ number_format($provider->views_count) }}</p>
                        <p class="text-xs text-gray-400">views</p>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>


<!-- Platform Settings -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 bg-violet-50 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div>
            <h2 class="text-base font-extrabold text-gray-900">Platform Settings</h2>
            <p class="text-xs text-gray-400">Configure global platform behaviour. To manage pricing, visit <a href="{{ route('admin.pricing.index') }}" class="text-violet-600 hover:underline font-bold">Pricing Settings →</a></p>
        </div>
    </div>
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5">
        @csrf @method('PATCH')
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Free Trial Duration (months)</label>
                <input type="number" name="trial_duration_months" value="{{ $trialDuration }}" min="1" max="24"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:ring-2 focus:ring-violet-300 focus:border-violet-300 outline-none bg-gray-50 focus:bg-white transition">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Homepage Hero Title</label>
                <input type="text" name="homepage_hero_title" value="{{ \App\Models\PlatformSetting::get('homepage_hero_title') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:ring-2 focus:ring-violet-300 focus:border-violet-300 outline-none bg-gray-50 focus:bg-white transition">
            </div>
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1.5">Homepage Hero Subtitle</label>
            <textarea name="homepage_hero_subtitle" rows="2"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:ring-2 focus:ring-violet-300 focus:border-violet-300 outline-none bg-gray-50 focus:bg-white transition resize-none">{{ \App\Models\PlatformSetting::get('homepage_hero_subtitle') }}</textarea>
        </div>
        {{-- Pricing fields passed as hidden so the shared validator does not strip them --}}
        <input type="hidden" name="price_sole"           value="{{ $priceSole }}">
        <input type="hidden" name="price_standard"       value="{{ $priceStandard }}">
        <input type="hidden" name="price_featured"       value="{{ $priceFeatured }}">
        <input type="hidden" name="price_addon_category" value="{{ $priceAddon }}">
        @foreach($soleFeatures as $i => $f)
            <input type="hidden" name="sole_features[{{ $i }}]" value="{{ $f }}">
        @endforeach
        @foreach($standardFeatures as $i => $f)
            <input type="hidden" name="standard_features[{{ $i }}]" value="{{ $f }}">
        @endforeach
        @foreach($featuredExtras as $i => $f)
            <input type="hidden" name="featured_extras[{{ $i }}]" value="{{ $f }}">
        @endforeach
        <div>
            <button type="submit" class="inline-flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-bold px-6 py-2.5 rounded-xl transition-colors text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Save Settings
            </button>
        </div>
    </form>
</div>

@endsection
