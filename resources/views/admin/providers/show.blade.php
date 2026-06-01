@extends('layouts.dashboard')

@section('title', $provider->business_name)
@section('page-title', $provider->business_name)


@section('content')
<div class="max-w-3xl space-y-6">

    <a href="{{ route('admin.providers.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to providers</a>

    <!-- Provider overview -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-start gap-4 mb-4">
            @if($provider->profile_image)
                <img src="{{ asset('storage/' . $provider->profile_image) }}" class="w-16 h-16 rounded-xl object-cover">
            @else
                <div class="w-16 h-16 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl font-bold text-emerald-500">
                    {{ substr($provider->business_name, 0, 1) }}
                </div>
            @endif
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-800">{{ $provider->business_name }}</h2>
                <p class="text-gray-500">{{ $provider->provider_name }}</p>
                <p class="text-gray-500 text-sm">{{ $provider->user->email }}</p>
            </div>
            <div class="flex flex-col gap-2 items-end">
                @if($provider->approval_status === 'approved')
                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-semibold">Approved</span>
                @elseif($provider->approval_status === 'pending')
                    <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-semibold">Pending Review</span>
                @else
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Rejected</span>
                @endif
                @if($provider->is_featured)
                    <span class="bg-amber-50 text-amber-600 px-3 py-1 rounded-full text-sm font-semibold">⭐ Featured</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
            <div><span class="text-gray-400">Phone:</span> {{ $provider->phone ?? '—' }}</div>
            <div><span class="text-gray-400">Website:</span> {{ $provider->website_url ?? '—' }}</div>
            <div><span class="text-gray-400">Location:</span> {{ $provider->suburb }}{{ $provider->state ? ', '.$provider->state : '' }}</div>
            <div><span class="text-gray-400">Telehealth:</span> {{ $provider->telehealth_available ? 'Yes' : 'No' }}</div>
            <div><span class="text-gray-400">Available:</span> {{ $provider->availability_status ? 'Yes' : 'No' }}</div>
            <div><span class="text-gray-400">Wait Time:</span> {{ $provider->wait_time ?? '—' }}</div>
        </div>

        @if($provider->bio)
            <div class="border-t border-gray-100 pt-3 text-sm text-gray-600">{{ $provider->bio }}</div>
        @endif

        @if($provider->categories->isNotEmpty())
            <div class="flex flex-wrap gap-1 mt-3">
                @foreach($provider->categories as $cat)
                    <span class="bg-emerald-50 text-emerald-700 text-xs px-2 py-0.5 rounded-full">{{ $cat->name }}</span>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Admin actions -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Admin Actions</h2>
        <div class="flex flex-wrap gap-3">

            @if($provider->approval_status !== 'approved')
                <form action="{{ route('admin.providers.approve', $provider) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-2 rounded-lg transition-colors">✅ Approve</button>
                </form>
            @endif

            <form action="{{ route('admin.providers.feature', $provider) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-white font-semibold px-5 py-2 rounded-lg transition-colors">
                    {{ $provider->is_featured ? 'Unfeature' : '⭐ Feature' }}
                </button>
            </form>

            <form action="{{ route('admin.providers.suspend', $provider) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded-lg transition-colors">
                    {{ $provider->is_active ? 'Suspend' : 'Reactivate' }}
                </button>
            </form>
        </div>

        <!-- Reject with notes -->
        @if($provider->approval_status !== 'rejected')
            <form action="{{ route('admin.providers.reject', $provider) }}" method="POST" class="mt-4 border-t border-gray-100 pt-4">
                @csrf @method('PATCH')
                <label class="block text-sm font-medium text-gray-700 mb-1">Rejection Notes (optional)</label>
                <textarea name="admin_notes" rows="2" placeholder="Reason for rejection..."
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-red-300 outline-none mb-2">{{ $provider->admin_notes }}</textarea>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-2 rounded-lg transition-colors text-sm">❌ Reject</button>
            </form>
        @endif
    </div>

    <!-- Subscription details -->
    @if($provider->subscription)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-3">Subscription</h2>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div><span class="text-gray-400">Status:</span> <span class="capitalize font-medium">{{ $provider->subscription->status }}</span></div>
                <div><span class="text-gray-400">Plan:</span> <span class="capitalize">{{ $provider->subscription->plan_type }}</span></div>
                @if($provider->subscription->trial_ends_at)
                    <div><span class="text-gray-400">Trial ends:</span> {{ $provider->subscription->trial_ends_at->format('d M Y') }}</div>
                @endif
                @if($provider->subscription->ends_at)
                    <div><span class="text-gray-400">Expires:</span> {{ $provider->subscription->ends_at->format('d M Y') }}</div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
