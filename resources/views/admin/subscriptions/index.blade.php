@extends('layouts.dashboard')

@section('title', 'Subscriptions')
@section('page-title', 'Subscription Management')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        📊 Dashboard
    </a>
    <a href="{{ route('admin.providers.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        👥 Providers
    </a>
    <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-purple-50 text-purple-700 font-medium text-sm">
        💳 Subscriptions
    </a>
@endsection

@section('content')
<!-- Tabs -->
<div class="flex gap-2 mb-6 border-b border-gray-200">
    @foreach(['all' => 'All', 'trial' => 'Trial', 'active' => 'Active', 'expired' => 'Expired'] as $val => $label)
        <a href="{{ route('admin.subscriptions.index', ['status' => $val]) }}"
           class="px-4 py-2 text-sm font-medium border-b-2 transition-colors {{ $status === $val ? 'border-purple-600 text-purple-700' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Provider</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Plan</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Expiry</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($subscriptions as $sub)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <p class="font-semibold text-gray-800">{{ $sub->provider->business_name ?? '—' }}</p>
                        <p class="text-xs text-gray-500">{{ $sub->provider->user->email ?? '—' }}</p>
                    </td>
                    <td class="px-4 py-3 capitalize text-gray-600">{{ $sub->plan_type }}</td>
                    <td class="px-4 py-3">
                        @if($sub->status === 'trial')
                            <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs font-semibold">Trial</span>
                        @elseif($sub->status === 'active')
                            <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full text-xs font-semibold">Active</span>
                        @elseif($sub->status === 'expired')
                            <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-semibold">Expired</span>
                        @else
                            <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full text-xs font-semibold">{{ $sub->status }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ $sub->trial_ends_at?->format('d M Y') ?? $sub->ends_at?->format('d M Y') ?? '—' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">No subscriptions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $subscriptions->links() }}</div>
@endsection
