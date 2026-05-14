@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-purple-50 text-purple-700 font-medium text-sm">
        📊 Dashboard
    </a>
    <a href="{{ route('admin.providers.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        👥 Providers
    </a>
    <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        💳 Subscriptions
    </a>
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-4">
        🌐 Public Site
    </a>
@endsection

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
        <div class="text-3xl font-extrabold text-amber-500">{{ $stats['pending'] }}</div>
        <div class="text-sm text-gray-500 font-medium mt-1">Pending Approval</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
        <div class="text-3xl font-extrabold text-emerald-500">{{ $stats['approved'] }}</div>
        <div class="text-sm text-gray-500 font-medium mt-1">Approved</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
        <div class="text-3xl font-extrabold text-blue-500">{{ $stats['trial'] }}</div>
        <div class="text-sm text-gray-500 font-medium mt-1">On Trial</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
        <div class="text-3xl font-extrabold text-purple-500">{{ $stats['featured'] }}</div>
        <div class="text-sm text-gray-500 font-medium mt-1">Featured</div>
    </div>
</div>

<!-- Pending providers -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-gray-800">Pending Approvals</h2>
        <a href="{{ route('admin.providers.index', ['status' => 'pending']) }}" class="text-sm text-purple-600 hover:underline">View all →</a>
    </div>

    @if($pendingProviders->isEmpty())
        <p class="text-gray-500 text-sm">No pending providers.</p>
    @else
        <div class="space-y-3">
            @foreach($pendingProviders as $provider)
                <div class="flex items-center justify-between p-4 bg-amber-50 border border-amber-100 rounded-xl">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $provider->business_name }}</p>
                        <p class="text-sm text-gray-500">{{ $provider->user->email }} • {{ $provider->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('admin.providers.approve', $provider) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">Approve</button>
                        </form>
                        <a href="{{ route('admin.providers.show', $provider) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-lg transition-colors">Review</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Platform Settings -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Platform Settings</h2>
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
        @csrf @method('PATCH')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Free Trial Duration (months)</label>
                <input type="number" name="trial_duration_months" value="{{ $trialDuration }}" min="1" max="24"
                    class="border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-purple-300 outline-none w-full">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Homepage Hero Title</label>
            <input type="text" name="homepage_hero_title" value="{{ \App\Models\PlatformSetting::get('homepage_hero_title') }}"
                class="border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-purple-300 outline-none w-full">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Homepage Hero Subtitle</label>
            <textarea name="homepage_hero_subtitle" rows="2"
                class="border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-purple-300 outline-none w-full">{{ \App\Models\PlatformSetting::get('homepage_hero_subtitle') }}</textarea>
        </div>
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded-lg transition-colors">Save Settings</button>
    </form>
</div>
@endsection
