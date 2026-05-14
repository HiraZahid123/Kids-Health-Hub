@extends('layouts.public')

@section('title', $provider->business_name . ' — ' . ($provider->categories->first()->name ?? 'Provider'))
@section('meta_description', $provider->bio ? \Illuminate\Support\Str::limit($provider->bio, 160) : $provider->business_name . ' in ' . $provider->suburb . ', ' . $provider->state . '. Child healthcare provider.')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-emerald-600">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('providers.index') }}" class="hover:text-emerald-600">Providers</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800">{{ $provider->business_name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Main content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Header card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @if($provider->profile_image)
                    <img src="{{ asset('storage/' . $provider->profile_image) }}" alt="{{ $provider->business_name }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-40 bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                        <span class="text-7xl font-bold text-emerald-400">{{ substr($provider->business_name, 0, 1) }}</span>
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex flex-wrap items-start gap-3 mb-3">
                        <h1 class="text-2xl font-extrabold text-gray-800 flex-1">{{ $provider->business_name }}</h1>
                        @if($provider->is_featured)
                            <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">⭐ Featured</span>
                        @endif
                    </div>

                    <!-- Categories -->
                    @if($provider->categories->isNotEmpty())
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($provider->categories as $cat)
                                <span class="bg-emerald-50 text-emerald-700 font-medium px-3 py-1 rounded-full text-sm">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Status badges -->
                    <div class="flex flex-wrap gap-3">
                        @if($provider->availability_status)
                            <span class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 font-semibold px-4 py-2 rounded-full text-sm">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                Immediately Available
                            </span>
                        @endif
                        @if($provider->telehealth_available)
                            <span class="flex items-center gap-2 bg-blue-50 border border-blue-200 text-blue-700 font-semibold px-4 py-2 rounded-full text-sm">
                                📱 Telehealth Available
                            </span>
                        @endif
                        @if($provider->wait_time)
                            <span class="bg-gray-50 border border-gray-200 text-gray-600 px-4 py-2 rounded-full text-sm">
                                ⏱ Typical wait: {{ $provider->wait_time }}
                            </span>
                        @endif
                    </div>

                    <!-- Location -->
                    @if($provider->suburb)
                        <div class="flex items-center gap-2 mt-4 text-gray-600">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            {{ $provider->address ? $provider->address . ', ' : '' }}{{ $provider->suburb }}{{ $provider->state ? ', ' . $provider->state : '' }} {{ $provider->postcode }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- About -->
            @if($provider->bio)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-3">About</h2>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $provider->bio }}</p>
                </div>
            @endif

            <!-- Service details -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Service Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    @if(!empty($provider->age_groups))
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Age Groups</h3>
                            <div class="flex flex-wrap gap-1">
                                @foreach($provider->age_groups as $age)
                                    <span class="bg-purple-50 text-purple-700 text-xs px-2 py-0.5 rounded-full">{{ $age }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(!empty($provider->funding_types))
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Funding Types</h3>
                            <div class="flex flex-wrap gap-1">
                                @foreach($provider->funding_types as $funding)
                                    <span class="bg-orange-50 text-orange-700 text-xs px-2 py-0.5 rounded-full">{{ $funding }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(!empty($provider->service_delivery))
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Service Delivery</h3>
                            <div class="flex flex-wrap gap-1">
                                @foreach($provider->service_delivery as $mode)
                                    <span class="bg-teal-50 text-teal-700 text-xs px-2 py-0.5 rounded-full">{{ $mode }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Sidebar / Contact -->
        <div class="space-y-4">
            <!-- Contact card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Contact</h2>
                <div class="space-y-3">
                    @if($provider->phone)
                        <a href="tel:{{ $provider->phone }}"
                           class="flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-4 py-3 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $provider->phone }}
                        </a>
                    @endif

                    @if($provider->user && $provider->user->email)
                        <a href="mailto:{{ $provider->user->email }}"
                           class="flex items-center gap-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-3 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Send Email
                        </a>
                    @endif

                    @if($provider->website_url)
                        <a href="{{ $provider->website_url }}" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 border-2 border-gray-200 hover:border-emerald-300 text-gray-700 font-semibold px-4 py-3 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Visit Website
                        </a>
                    @endif
                </div>

                <p class="text-xs text-gray-400 mt-4 text-center">Contact is handled directly with the provider</p>
            </div>

            <!-- Map mini -->
            @if($provider->latitude && $provider->longitude)
                <div id="mini-map" class="w-full h-48 rounded-2xl overflow-hidden border border-gray-200 bg-gray-100"></div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if($provider->latitude && $provider->longitude)
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&callback=initMiniMap" async defer></script>
<script>
function initMiniMap() {
    const pos = { lat: {{ $provider->latitude }}, lng: {{ $provider->longitude }} };
    const map = new google.maps.Map(document.getElementById('mini-map'), {
        center: pos, zoom: 14,
        disableDefaultUI: true, zoomControl: true,
    });
    new google.maps.Marker({ position: pos, map, title: '{{ addslashes($provider->business_name) }}' });
}
</script>
@endif
@endpush
