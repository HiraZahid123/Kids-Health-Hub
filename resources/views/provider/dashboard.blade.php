@extends('layouts.dashboard')

@section('title', 'Provider Dashboard')
@section('page-title', 'My Dashboard')



@section('content')
@if(!$provider)
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-8 text-center max-w-lg mx-auto mt-8">
        <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <h2 class="text-lg font-extrabold text-amber-900 mb-2">Complete Your Profile</h2>
        <p class="text-amber-700 text-sm mb-6">Set up your provider profile to get listed on Kids Health Hub.</p>
        <a href="{{ route('provider.profile.edit') }}" class="inline-flex items-center gap-2 bg-emerald-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-emerald-600 transition-colors text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Set Up Profile
        </a>
    </div>
@else

    @if($provider->approval_status === 'approved' && $provider->suburb && (!$provider->latitude || !$provider->longitude))
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-5 flex items-start gap-3">
        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div>
            <p class="font-bold text-amber-800 text-sm">Your listing is not showing on the map</p>
            <p class="text-amber-700 text-xs mt-0.5">We couldn't geocode your address. Please <a href="{{ route('provider.profile.edit') }}" class="underline font-semibold">update your profile</a> and ensure suburb and postcode are correct.</p>
        </div>
    </div>
    @endif

    <!-- View stats -->
    @if($viewStats)
    <div class="grid grid-cols-3 gap-4 mb-5">
        @foreach([
            ['label' => 'This week', 'value' => $viewStats['this_week'], 'color' => 'emerald', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
            ['label' => 'This month', 'value' => $viewStats['this_month'], 'color' => 'blue', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ['label' => 'All time', 'value' => $viewStats['all_time'], 'color' => 'violet', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
        ] as $stat)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ $stat['label'] }}</p>
                <div class="w-8 h-8 bg-{{ $stat['color'] }}-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-{{ $stat['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/></svg>
                </div>
            </div>
            <p class="text-3xl font-black text-gray-900">{{ number_format($stat['value']) }}</p>
            <p class="text-xs text-gray-400 mt-0.5">profile views</p>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Status cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">

        <!-- Approval status -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Listing Status</p>
            @if($provider->approval_status === 'approved')
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-emerald-700">Approved & Live</p>
                        <p class="text-xs text-gray-400">Visible to families</p>
                    </div>
                </div>
            @elseif($provider->approval_status === 'pending')
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-amber-700">Pending Review</p>
                        <p class="text-xs text-gray-400">Admin reviewing shortly</p>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-700">Not Approved</p>
                        @if($provider->admin_notes)
                            <p class="text-xs text-gray-400">{{ $provider->admin_notes }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Subscription status -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Subscription</p>
            @if($provider->subscription)
                @if($provider->subscription->status === 'trial')
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-blue-700">Free Trial</p>
                            <p class="text-xs text-gray-400">Ends {{ $provider->subscription->trial_ends_at?->format('d M Y') }}</p>
                        </div>
                    </div>
                @elseif($provider->subscription->status === 'active')
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-emerald-700">Active</p>
                            <p class="text-xs text-gray-400">Renews {{ $provider->subscription->ends_at?->format('d M Y') }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-red-700">Expired</p>
                            <p class="text-xs text-gray-400">Listing hidden. Renew below.</p>
                        </div>
                    </div>
                @endif
            @else
                <p class="text-sm text-gray-400">No subscription</p>
            @endif
        </div>

        <!-- Quick toggles -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Quick Actions</p>
            <div class="space-y-2">
                <form action="{{ route('provider.availability.toggle') }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ $provider->availability_status ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                        <span class="w-2.5 h-2.5 rounded-full flex-shrink-0 {{ $provider->availability_status ? 'bg-emerald-500 animate-pulse' : 'bg-gray-300' }}"></span>
                        {{ $provider->availability_status ? 'Available Now' : 'Mark Available' }}
                        <svg class="w-3.5 h-3.5 ml-auto text-current opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    </button>
                </form>
                <form action="{{ route('provider.telehealth.toggle') }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ $provider->telehealth_available ? 'bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        {{ $provider->telehealth_available ? 'Telehealth ON' : 'Enable Telehealth' }}
                        <svg class="w-3.5 h-3.5 ml-auto text-current opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if($provider->subscription && $provider->subscription->status === 'expired')
    <div class="bg-red-50 border border-red-200 rounded-2xl p-6 mb-5">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <div class="flex-1">
                <h3 class="font-extrabold text-red-800 text-base mb-1">Your subscription has expired</h3>
                <p class="text-red-700 text-sm mb-4">Your listing is currently hidden from families. Choose a plan to get back online.</p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <form action="{{ route('provider.checkout.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" value="monthly">
                        <button type="submit" class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-5 py-2.5 rounded-xl transition-colors text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Monthly - $49/month
                        </button>
                    </form>
                    <form action="{{ route('provider.checkout.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" value="annual">
                        <button type="submit" class="w-full sm:w-auto bg-violet-500 hover:bg-violet-600 text-white font-bold px-5 py-2.5 rounded-xl transition-colors text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Annual - $39/month <span class="font-normal opacity-80">(save 20%)</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Profile summary -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-extrabold text-gray-900">Your Profile</h2>
            <a href="{{ route('provider.profile.edit') }}" class="text-sm text-emerald-600 font-bold hover:underline flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        </div>
        <div class="flex items-start gap-4">
            @if($provider->profile_image)
                <img src="{{ asset('storage/' . $provider->profile_image) }}" class="w-16 h-16 rounded-2xl object-cover flex-shrink-0">
            @else
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-2xl font-black text-white flex-shrink-0">
                    {{ substr($provider->business_name, 0, 1) }}
                </div>
            @endif
            <div class="min-w-0">
                <h3 class="font-extrabold text-gray-900 text-base truncate">{{ $provider->business_name }}</h3>
                <p class="text-gray-500 text-sm flex items-center gap-1 mt-0.5">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    {{ $provider->suburb }}{{ $provider->state ? ', '.$provider->state : '' }}
                </p>
                @if($provider->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-1 mt-2">
                        @foreach($provider->categories as $cat)
                            <span class="bg-emerald-50 text-emerald-700 text-xs px-2.5 py-0.5 rounded-full font-semibold border border-emerald-100">{{ $cat->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if($provider->approval_status === 'approved')
            <div class="mt-5 pt-4 border-t border-gray-50">
                <a href="{{ route('providers.show', $provider->slug) }}" target="_blank"
                   class="inline-flex items-center gap-1.5 text-emerald-600 text-sm font-bold hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View My Public Profile
                </a>
            </div>
        @endif
    </div>
@endif
@endsection
