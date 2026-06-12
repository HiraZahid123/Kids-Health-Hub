@extends('layouts.dashboard')

@section('title', 'Saved Providers')
@section('page-title', 'Saved Providers')



@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Saved Providers</h2>
        <p class="text-sm text-gray-500 mt-1">{{ $saved->count() }} provider{{ $saved->count() !== 1 ? 's' : '' }} saved</p>
    </div>
    <a href="{{ route('providers.index') }}" class="bg-sky-500 hover:bg-sky-600 text-white font-semibold px-4 py-2 rounded-lg text-sm transition-colors">
        Find More Providers
    </a>
</div>

@if($saved->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
        <div class="text-5xl mb-4">❤️</div>
        <h3 class="text-lg font-bold text-gray-700 mb-2">No saved providers yet</h3>
        <p class="text-gray-500 text-sm mb-6">Browse the directory and click the heart icon on any provider to save them here.</p>
        <a href="{{ route('providers.index') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors">
            Browse Providers
        </a>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($saved as $provider)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow group {{ $provider->is_featured ? 'ring-2 ring-amber-400' : '' }}">
                @if($provider->is_featured)
                    <div class="bg-amber-400 text-amber-900 text-xs font-bold px-3 py-1 text-center">⭐ Featured Provider</div>
                @endif

                <a href="{{ route('providers.show', $provider->slug) }}" class="block">
                    @if($provider->profile_image)
                        <img src="{{ asset('storage/' . $provider->profile_image) }}"
                             alt="{{ $provider->business_name }}"
                             class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-36 bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                            <span class="text-4xl font-bold text-emerald-400">{{ substr($provider->business_name, 0, 1) }}</span>
                        </div>
                    @endif
                </a>

                <div class="p-4">
                    <a href="{{ route('providers.show', $provider->slug) }}" class="block">
                        <h3 class="font-bold text-gray-800 text-base leading-tight group-hover:text-emerald-600 transition-colors">
                            {{ $provider->business_name }}
                        </h3>

                        @if($provider->categories->isNotEmpty())
                            <div class="flex flex-wrap gap-1 mt-2">
                                @foreach($provider->categories->take(2) as $cat)
                                    <span class="bg-emerald-50 text-emerald-700 text-xs px-2 py-0.5 rounded-full font-medium">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex items-center gap-1 mt-2 text-gray-500 text-sm">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            {{ $provider->suburb }}{{ $provider->state ? ', ' . $provider->state : '' }}
                        </div>
                    </a>

                    <form method="POST" action="{{ route('family.saved.toggle', $provider) }}" class="mt-3">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-100 font-medium px-3 py-2 rounded-lg text-sm transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            Remove from Saved
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
