@extends('layouts.dashboard')

@section('title', 'Provider Dashboard')
@section('page-title', 'My Dashboard')

@section('sidebar-nav')
    <a href="{{ route('provider.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-50 text-emerald-700 font-medium text-sm">
        🏠 Dashboard
    </a>
    <a href="{{ route('provider.profile.edit') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        ✏️ Edit Profile
    </a>
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-4">
        🌐 View Public Site
    </a>
@endsection

@section('content')
@if(!$provider)
    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6">
        <h2 class="text-lg font-bold text-yellow-800 mb-2">Complete Your Profile</h2>
        <p class="text-yellow-700 mb-4">You need to set up your provider profile before it can go live.</p>
        <a href="{{ route('provider.profile.edit') }}" class="bg-emerald-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-emerald-600 transition-colors">
            Set Up Profile
        </a>
    </div>
@else

    <!-- Status cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

        <!-- Approval status -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Listing Status</p>
            @if($provider->approval_status === 'approved')
                <p class="text-emerald-600 font-bold text-lg">✅ Approved & Live</p>
            @elseif($provider->approval_status === 'pending')
                <p class="text-amber-600 font-bold text-lg">⏳ Pending Review</p>
                <p class="text-sm text-gray-500 mt-1">Admin will review your profile shortly.</p>
            @else
                <p class="text-red-600 font-bold text-lg">❌ Rejected</p>
                @if($provider->admin_notes)
                    <p class="text-sm text-gray-500 mt-1">{{ $provider->admin_notes }}</p>
                @endif
            @endif
        </div>

        <!-- Subscription status -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Subscription</p>
            @if($provider->subscription)
                @if($provider->subscription->status === 'trial')
                    <p class="text-blue-600 font-bold text-lg">🎁 Free Trial</p>
                    <p class="text-sm text-gray-500 mt-1">Ends {{ $provider->subscription->trial_ends_at?->format('d M Y') }}</p>
                @elseif($provider->subscription->status === 'active')
                    <p class="text-emerald-600 font-bold text-lg">✅ Active</p>
                    <p class="text-sm text-gray-500 mt-1">Renews {{ $provider->subscription->ends_at?->format('d M Y') }}</p>
                @else
                    <p class="text-red-600 font-bold text-lg">⚠️ Expired</p>
                    <p class="text-sm text-gray-500 mt-1">Your listing is hidden. Contact admin to renew.</p>
                @endif
            @else
                <p class="text-gray-500">No subscription</p>
            @endif
        </div>

        <!-- Quick toggles -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Quick Actions</p>
            <div class="space-y-2">
                <form action="{{ route('provider.availability.toggle') }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ $provider->availability_status ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-gray-50 text-gray-600 hover:bg-gray-100' }}">
                        <span class="w-2.5 h-2.5 rounded-full {{ $provider->availability_status ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                        {{ $provider->availability_status ? 'Available — Click to remove' : 'Mark as Available' }}
                    </button>
                </form>
                <form action="{{ route('provider.telehealth.toggle') }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ $provider->telehealth_available ? 'bg-blue-50 text-blue-700 hover:bg-blue-100' : 'bg-gray-50 text-gray-600 hover:bg-gray-100' }}">
                        📱 {{ $provider->telehealth_available ? 'Telehealth ON — Click to disable' : 'Enable Telehealth' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Profile summary -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-800">Your Profile</h2>
            <a href="{{ route('provider.profile.edit') }}" class="text-sm text-emerald-600 font-medium hover:underline">Edit Profile →</a>
        </div>
        <div class="flex items-start gap-4">
            @if($provider->profile_image)
                <img src="{{ asset('storage/' . $provider->profile_image) }}" class="w-16 h-16 rounded-xl object-cover">
            @else
                <div class="w-16 h-16 rounded-xl bg-emerald-100 flex items-center justify-center text-2xl font-bold text-emerald-500">
                    {{ substr($provider->business_name, 0, 1) }}
                </div>
            @endif
            <div>
                <h3 class="font-bold text-gray-800">{{ $provider->business_name }}</h3>
                <p class="text-gray-600 text-sm">{{ $provider->suburb }}{{ $provider->state ? ', '.$provider->state : '' }}</p>
                @if($provider->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-1 mt-1">
                        @foreach($provider->categories as $cat)
                            <span class="bg-emerald-50 text-emerald-700 text-xs px-2 py-0.5 rounded-full">{{ $cat->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if($provider->approval_status === 'approved')
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('providers.show', $provider->slug) }}" target="_blank" class="text-emerald-600 text-sm font-medium hover:underline flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View My Public Profile
                </a>
            </div>
        @endif
    </div>
@endif
@endsection
