@extends('layouts.public')

@section('title', 'Kids Health Hub — Find Child Healthcare Providers')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-emerald-500 to-teal-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">{{ $heroTitle }}</h1>
            <p class="text-xl text-emerald-100 max-w-2xl mx-auto">{{ $heroSubtitle }}</p>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('providers.index') }}" method="GET" class="max-w-3xl mx-auto">
            <div class="flex flex-col sm:flex-row gap-3 bg-white rounded-2xl p-3 shadow-xl">
                <input
                    type="text"
                    name="search"
                    placeholder="Suburb, postcode, or provider name..."
                    class="flex-1 px-4 py-3 text-gray-800 placeholder-gray-400 bg-transparent outline-none text-lg"
                    value="{{ request('search') }}"
                >
                <select name="category" class="px-4 py-3 text-gray-700 bg-gray-50 rounded-xl border-0 outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-8 py-3 rounded-xl transition-colors whitespace-nowrap">
                    Search
                </button>
            </div>
        </form>

        <!-- Quick filters -->
        <div class="flex flex-wrap justify-center gap-3 mt-6">
            <a href="{{ route('providers.index', ['available' => 1]) }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors flex items-center gap-2">
                <span class="w-2 h-2 bg-green-300 rounded-full"></span> Immediate Availability
            </a>
            <a href="{{ route('telehealth') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors">
                📱 Telehealth Providers
            </a>
            @foreach($categories->take(4) as $cat)
                <a href="{{ route('providers.index', ['category' => $cat->slug]) }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Interactive Map -->
<section class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Providers Near You</h2>
        <div id="map" class="w-full h-96 md:h-[500px] rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 flex items-center justify-center">
            <p class="text-gray-400">Loading map...</p>
        </div>
    </div>
</section>

<!-- Featured Providers -->
@if($featuredProviders->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Featured Providers</h2>
        <a href="{{ route('providers.index') }}" class="text-emerald-600 font-medium hover:underline">View all →</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($featuredProviders as $provider)
            @include('public.partials.provider-card', ['provider' => $provider])
        @endforeach
    </div>
</section>
@endif

<!-- Provider List -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">All Providers</h2>
        <a href="{{ route('providers.index') }}" class="text-emerald-600 font-medium hover:underline">View all →</a>
    </div>
    @if($recentProviders->isEmpty())
        <div class="text-center py-16 text-gray-500">
            <p class="text-lg">No providers listed yet.</p>
            <a href="{{ route('register') }}" class="mt-4 inline-block bg-emerald-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-emerald-600 transition-colors">Be the first to list</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($recentProviders as $provider)
                @include('public.partials.provider-card', ['provider' => $provider])
            @endforeach
        </div>
    @endif
</section>

<!-- CTA for providers -->
<section class="bg-emerald-50 border-t border-emerald-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">Are you a healthcare provider?</h2>
        <p class="text-gray-600 text-lg mb-6">Join Kids Health Hub and connect with families seeking your services. Start with a free 3-month trial.</p>
        <a href="{{ route('register') }}" class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-8 py-4 rounded-xl text-lg transition-colors">
            List Your Practice — Free Trial
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script>
window.GOOGLE_MAP_API_KEY = '{{ env("GOOGLE_MAP_API_KEY") }}';
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&callback=initMap" async defer></script>
<script>
async function initMap() {
    const mapEl = document.getElementById('map');
    mapEl.innerHTML = '';

    const map = new google.maps.Map(mapEl, {
        center: { lat: -25.2744, lng: 133.7751 },
        zoom: 5,
        styles: [{ featureType: 'poi', elementType: 'labels', stylers: [{ visibility: 'off' }] }],
    });

    try {
        const res = await fetch('{{ route("api.providers") }}');
        const providers = await res.json();
        const bounds = new google.maps.LatLngBounds();
        let hasMarkers = false;

        providers.forEach(p => {
            if (!p.latitude || !p.longitude) return;
            hasMarkers = true;
            const pos = { lat: p.latitude, lng: p.longitude };
            bounds.extend(pos);

            const marker = new google.maps.Marker({
                position: pos,
                map,
                title: p.business_name,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 10,
                    fillColor: p.availability_status ? '#10b981' : '#3b82f6',
                    fillOpacity: 1,
                    strokeColor: '#fff',
                    strokeWeight: 2,
                },
            });

            const info = new google.maps.InfoWindow({
                content: `
                    <div style="max-width:220px;font-family:sans-serif;">
                        <strong style="font-size:14px;">${p.business_name}</strong><br>
                        <span style="color:#666;font-size:12px;">${p.categories.join(', ')}</span><br>
                        <span style="font-size:12px;">${p.suburb || ''} ${p.state || ''}</span><br>
                        ${p.availability_status ? '<span style="color:#10b981;font-size:12px;font-weight:600;">● Available Now</span><br>' : ''}
                        ${p.telehealth_available ? '<span style="font-size:12px;">📱 Telehealth</span><br>' : ''}
                        <a href="${p.url}" style="color:#10b981;font-size:13px;font-weight:600;text-decoration:none;">View Profile →</a>
                    </div>`
            });

            marker.addListener('click', () => info.open(map, marker));
        });

        if (hasMarkers) map.fitBounds(bounds);
    } catch (e) {
        console.error('Map error:', e);
    }
}
</script>
@endpush
