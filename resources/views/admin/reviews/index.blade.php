@extends('layouts.dashboard')

@section('title', 'Review Moderation')
@section('page-title', 'Review Moderation')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        📊 Dashboard
    </a>
    <a href="{{ route('admin.providers.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        🏥 Providers
    </a>
    <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        💳 Subscriptions
    </a>
    <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-purple-50 text-purple-700 font-medium text-sm mt-1">
        ⭐ Reviews
        @if($pending->count() > 0)
            <span class="ml-auto bg-rose-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $pending->count() }}</span>
        @endif
    </a>
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-4">
        🌐 Public Site
    </a>
@endsection

@section('content')

{{-- Pending --}}
<div class="mb-8">
    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        Pending Reviews
        @if($pending->count() > 0)
            <span class="bg-rose-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pending->count() }}</span>
        @endif
    </h2>

    @if($pending->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center text-gray-400 text-sm">
            No reviews awaiting moderation.
        </div>
    @else
        <div class="space-y-3">
            @foreach($pending as $review)
                <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-5">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <span class="font-semibold text-gray-800 text-sm">{{ $review->user->name }}</span>
                                <span class="text-gray-400 text-xs">→</span>
                                <a href="{{ route('providers.show', $review->provider->slug) }}" target="_blank"
                                   class="text-emerald-600 hover:underline text-sm font-medium">{{ $review->provider->business_name }}</a>
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $review->body }}</p>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors">
                                    Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.reviews.reject', $review) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 text-sm font-semibold px-4 py-2 rounded-xl transition-colors">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Approved (recent 50) --}}
@if($approved->isNotEmpty())
<div class="mb-8">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Approved Reviews <span class="text-sm font-normal text-gray-400">(recent 50)</span></h2>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">Reviewer</th>
                    <th class="px-4 py-3 text-left">Provider</th>
                    <th class="px-4 py-3 text-left">Rating</th>
                    <th class="px-4 py-3 text-left">Review</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($approved as $review)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $review->user->name }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('providers.show', $review->provider->slug) }}" target="_blank" class="text-emerald-600 hover:underline">
                                {{ Str::limit($review->provider->business_name, 25) }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ Str::limit($review->body, 60) }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $review->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.reviews.reject', $review) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Rejected (recent 50) --}}
@if($rejected->isNotEmpty())
<div>
    <h2 class="text-lg font-bold text-gray-800 mb-4">Rejected Reviews <span class="text-sm font-normal text-gray-400">(recent 50)</span></h2>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">Reviewer</th>
                    <th class="px-4 py-3 text-left">Provider</th>
                    <th class="px-4 py-3 text-left">Rating</th>
                    <th class="px-4 py-3 text-left">Review</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($rejected as $review)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $review->user->name }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('providers.show', $review->provider->slug) }}" target="_blank" class="text-emerald-600 hover:underline">
                                {{ Str::limit($review->provider->business_name, 25) }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ Str::limit($review->body, 60) }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $review->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="text-emerald-600 hover:text-emerald-800 text-xs font-medium">Re-approve</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
