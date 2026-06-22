@extends('layouts.public')

@section('title', 'Find Child Healthcare Providers')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Search & Filter Bar -->
    <form method="GET" action="{{ route('providers.index') }}" id="search-form" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
        {{-- Hidden radius search fields populated by geolocation --}}
        <input type="hidden" name="lat"    id="input-lat"    value="{{ request('lat') }}">
        <input type="hidden" name="lng"    id="input-lng"    value="{{ request('lng') }}">
        <input type="hidden" name="radius" id="input-radius" value="{{ request('radius', 25) }}">

        <div class="flex flex-col sm:flex-row gap-3 mb-3">
            <input
                type="text"
                name="search"
                placeholder="Search by name, suburb or postcode..."
                class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none"
                value="{{ request('search') }}"
            >
            <select name="category" class="border border-gray-200 rounded-xl px-4 py-2.5 text-gray-700 focus:ring-2 focus:ring-emerald-300 outline-none">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-6 py-2.5 rounded-xl transition-colors">Search</button>
        </div>

        <!-- Filters row -->
        <div class="flex flex-wrap gap-3 items-center">
            <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700 font-medium">
                <input type="checkbox" name="available" value="1" {{ request('available') ? 'checked' : '' }} class="rounded text-emerald-500">
                <span class="flex items-center gap-1"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Available Now</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700 font-medium">
                <input type="checkbox" name="telehealth" value="1" {{ request('telehealth') ? 'checked' : '' }} class="rounded text-emerald-500">
                📱 Telehealth Only
            </label>
            <select name="age_group" class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm text-gray-700 outline-none">
                <option value="">Any Age Group</option>
                <option value="0-2 years"   {{ request('age_group') == '0-2 years'   ? 'selected' : '' }}>0–2 years</option>
                <option value="3-5 years"   {{ request('age_group') == '3-5 years'   ? 'selected' : '' }}>3–5 years</option>
                <option value="6-12 years"  {{ request('age_group') == '6-12 years'  ? 'selected' : '' }}>6–12 years</option>
                <option value="13-18 years" {{ request('age_group') == '13-18 years' ? 'selected' : '' }}>13–18 years</option>
            </select>
            <select name="service_delivery" class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm text-gray-700 outline-none">
                <option value="">Any Delivery Mode</option>
                <option value="in-clinic"  {{ request('service_delivery') == 'in-clinic'  ? 'selected' : '' }}>In-Clinic</option>
                <option value="mobile"     {{ request('service_delivery') == 'mobile'     ? 'selected' : '' }}>Mobile / Home Visits</option>
                <option value="telehealth" {{ request('service_delivery') == 'telehealth' ? 'selected' : '' }}>Telehealth</option>
            </select>

            <!-- Near me button -->
            <button type="button" id="btn-near-me"
                class="flex items-center gap-1.5 border border-emerald-300 text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Near me
            </button>

            <!-- Radius selector — shown when location is active -->
            <div id="radius-group" class="{{ request('lat') ? 'flex' : 'hidden' }} items-center gap-2">
                <select id="select-radius" class="border border-emerald-300 rounded-lg px-3 py-1.5 text-sm text-emerald-700 outline-none bg-emerald-50">
                    @foreach([5, 10, 25, 50] as $km)
                        <option value="{{ $km }}" {{ request('radius', 25) == $km ? 'selected' : '' }}>{{ $km }} km</option>
                    @endforeach
                </select>
                <button type="button" id="btn-clear-location" class="text-xs text-red-500 hover:underline">✕ Clear location</button>
            </div>

            @if(request()->hasAny(['search','category','available','telehealth','age_group','service_delivery','funding_type','lat']))
                <a href="{{ route('providers.index') }}" class="text-sm text-red-500 hover:underline flex items-center">Clear all filters</a>
            @endif
        </div>

        <p id="geo-status" class="mt-2 text-xs text-gray-500 hidden"></p>
    </form>

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Map -->
        <div class="w-full lg:w-1/2 xl:w-2/5">
            <div id="map" class="w-full h-96 lg:h-[600px] rounded-2xl border border-gray-200 bg-gray-100 flex items-center justify-center sticky top-20">
                <p class="text-gray-400 text-sm">Loading map...</p>
            </div>
        </div>

        <!-- Provider list -->
        <div class="flex-1">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-600 text-sm">
                    @if(request('lat'))
                        <strong class="text-gray-800">{{ $providers->total() }}</strong> provider{{ $providers->total() !== 1 ? 's' : '' }} within {{ request('radius', 25) }} km
                    @else
                        <strong class="text-gray-800">{{ $providers->total() }}</strong> provider{{ $providers->total() !== 1 ? 's' : '' }} found
                    @endif
                </p>
            </div>

            @if($providers->isEmpty())
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                    <div class="text-5xl mb-3">🔍</div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">No providers found</h3>
                    <p class="text-gray-500">Try adjusting your search, filters, or increasing the radius.</p>
                    <a href="{{ route('providers.index') }}" class="mt-4 inline-block text-emerald-600 font-medium hover:underline">Clear all filters</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($providers as $provider)
                        @include('public.partials.provider-card', ['provider' => $provider])
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $providers->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&callback=initMap&loading=async" async defer></script>
<script>
const urlParams  = new URLSearchParams(window.location.search);
const activeLat  = parseFloat(urlParams.get('lat'))    || null;
const activeLng  = parseFloat(urlParams.get('lng'))    || null;
const activeRadius = parseInt(urlParams.get('radius')) || 25;

// ── Geolocation button ────────────────────────────────────────────────────────
document.getElementById('btn-near-me').addEventListener('click', () => {
    const status = document.getElementById('geo-status');
    if (!navigator.geolocation) {
        status.textContent = 'Geolocation is not supported by your browser.';
        status.classList.remove('hidden');
        return;
    }
    status.textContent = 'Detecting your location…';
    status.classList.remove('hidden');

    navigator.geolocation.getCurrentPosition(
        (pos) => {
            document.getElementById('input-lat').value    = pos.coords.latitude;
            document.getElementById('input-lng').value    = pos.coords.longitude;
            document.getElementById('input-radius').value = document.getElementById('select-radius').value;
            document.getElementById('radius-group').classList.remove('hidden');
            document.getElementById('radius-group').classList.add('flex');
            status.textContent = 'Location found - submitting…';
            document.getElementById('search-form').submit();
        },
        () => {
            status.textContent = 'Location access denied. Please allow location in your browser settings.';
        }
    );
});

// Radius change re-submits immediately
document.getElementById('select-radius').addEventListener('change', (e) => {
    document.getElementById('input-radius').value = e.target.value;
    document.getElementById('search-form').submit();
});

// Clear location
document.getElementById('btn-clear-location').addEventListener('click', () => {
    document.getElementById('input-lat').value    = '';
    document.getElementById('input-lng').value    = '';
    document.getElementById('input-radius').value = '';
    document.getElementById('search-form').submit();
});

// ── Map ───────────────────────────────────────────────────────────────────────
async function initMap() {
    const mapEl = document.getElementById('map');
    mapEl.innerHTML = '';

    const defaultCenter = activeLat
        ? { lat: activeLat, lng: activeLng }
        : { lat: -25.2744, lng: 133.7751 };

    const map = new google.maps.Map(mapEl, {
        center: defaultCenter,
        zoom: activeLat ? (activeRadius <= 10 ? 11 : activeRadius <= 25 ? 10 : 8) : 5,
        styles: [{ featureType: 'poi', elementType: 'labels', stylers: [{ visibility: 'off' }] }],
    });

    // Draw radius circle if location is active
    if (activeLat && activeLng) {
        new google.maps.Circle({
            strokeColor:   '#10b981',
            strokeOpacity: 0.6,
            strokeWeight:  2,
            fillColor:     '#10b981',
            fillOpacity:   0.08,
            map,
            center: { lat: activeLat, lng: activeLng },
            radius: activeRadius * 1000,
        });

        // User location marker
        new google.maps.Marker({
            position: { lat: activeLat, lng: activeLng },
            map,
            title: 'Your location',
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 8,
                fillColor: '#6366f1',
                fillOpacity: 1,
                strokeColor: '#fff',
                strokeWeight: 2,
            },
            zIndex: 999,
        });
    }

    const apiUrl = '{{ route("api.providers") }}?' + urlParams.toString();

    try {
        const res       = await fetch(apiUrl);
        const providers = await res.json();
        const bounds    = new google.maps.LatLngBounds();
        let hasMarkers  = false;

        providers.forEach(p => {
            if (!p.latitude || !p.longitude) return;
            hasMarkers = true;
            bounds.extend({ lat: p.latitude, lng: p.longitude });

            const marker = new google.maps.Marker({
                position: { lat: p.latitude, lng: p.longitude },
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
                        <strong>${p.business_name}</strong><br>
                        <span style="color:#666;font-size:12px;">${p.categories.join(', ')}</span><br>
                        <span style="font-size:12px;">${p.suburb || ''} ${p.state || ''}</span><br>
                        ${p.availability_status ? '<span style="color:#10b981;font-size:12px;font-weight:600;">● Available Now</span><br>' : ''}
                        <a href="${p.url}" style="color:#10b981;font-size:13px;font-weight:600;">View Profile →</a>
                    </div>`
            });

            marker.addListener('click', () => info.open(map, marker));
        });

        // Only auto-fit bounds when no radius search is active
        if (hasMarkers && !activeLat) map.fitBounds(bounds);
    } catch (e) {
        console.error(e);
    }
}
</script>
@endpush
