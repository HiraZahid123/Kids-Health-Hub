@extends('layouts.dashboard')

@section('title', 'Manage Providers')
@section('page-title', 'Providers')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        📊 Dashboard
    </a>
    <a href="{{ route('admin.providers.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-purple-50 text-purple-700 font-medium text-sm">
        👥 Providers
    </a>
    <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        💳 Subscriptions
    </a>
    <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        ⭐ Reviews
    </a>
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-4">
        🌐 Public Site
    </a>
@endsection

@section('content')
<!-- Status tabs -->
<div class="flex gap-2 mb-6 border-b border-gray-200">
    @foreach(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'all' => 'All'] as $val => $label)
        <a href="{{ route('admin.providers.index', ['status' => $val]) }}"
           class="px-4 py-2 text-sm font-medium border-b-2 transition-colors {{ $status === $val ? 'border-purple-600 text-purple-700' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

@if($providers->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
        <p class="text-gray-500">No providers found with status: {{ $status }}</p>
    </div>
@else
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Provider</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600 hidden sm:table-cell">Status</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600 hidden md:table-cell">Subscription</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600 hidden lg:table-cell">Registered</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($providers as $provider)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3">
                            <p class="font-semibold text-gray-800">{{ $provider->business_name }}</p>
                            <p class="text-gray-500 text-xs">{{ $provider->user->email }}</p>
                            @if($provider->is_featured)
                                <span class="text-amber-500 text-xs font-medium">⭐ Featured</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 hidden sm:table-cell">
                            @if($provider->approval_status === 'approved')
                                <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full text-xs font-semibold">Approved</span>
                            @elseif($provider->approval_status === 'pending')
                                <span class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full text-xs font-semibold">Pending</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-semibold">Rejected</span>
                            @endif
                            @if(!$provider->is_active)
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full text-xs font-semibold ml-1">Suspended</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 hidden md:table-cell">
                            @if($provider->subscription)
                                <span class="text-xs text-gray-600 capitalize">{{ $provider->subscription->status }}</span>
                            @else
                                <span class="text-xs text-gray-400">No sub</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-500 text-xs hidden lg:table-cell">{{ $provider->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-1">
                                <a href="{{ route('admin.providers.show', $provider) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">View</a>

                                @if($provider->approval_status !== 'approved')
                                    <form action="{{ route('admin.providers.approve', $provider) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">Approve</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.providers.feature', $provider) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-amber-100 hover:bg-amber-200 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors" title="{{ $provider->is_featured ? 'Unfeature' : 'Feature' }}">
                                        ⭐
                                    </button>
                                </form>

                                <form action="{{ route('admin.providers.suspend', $provider) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">
                                        {{ $provider->is_active ? 'Suspend' : 'Reactivate' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $providers->links() }}</div>
@endif
@endsection
