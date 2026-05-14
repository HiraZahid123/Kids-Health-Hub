@extends('layouts.public')

@section('title', 'Find Child Healthcare Providers')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Search & Filter Bar -->
    <form method="GET" action="{{ route('providers.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
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
        <div class="flex flex-wrap gap-3">
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
                <option value="0-2" {{ request('age_group') == '0-2' ? 'selected' : '' }}>0–2 years</option>
                <option value="3-5" {{ request('age_group') == '3-5' ? 'selected' : '' }}>3–5 years</option>
                <option value="6-12" {{ request('age_group') == '6-12' ? 'selected' : '' }}>6–12 years</option>
                <option value="13-18" {{ request('age_group') == '13-18' ? 'selected' : '' }}>13–18 years</option>
            </select>
            <select name="service_delivery" class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm text-gray-700 outline-none">
                <option value="">Any Delivery Mode</option>
                <option value="in-clinic" {{ request('service_delivery') == 'in-clinic' ? 'selected' : '' }}>In-Clinic</option>
                <option value="mobile" {{ request('service_delivery') == 'mobile' ? 'selected' : '' }}>Mobile / Home Visits</option>
                <option value="telehealth" {{ request('service_delivery') == 'telehealth' ? 'selected' : '' }}>Telehealth</option>
            </select>
            @if(request()->hasAny(['search','category','available','telehealth','age_group','service_delivery','funding_type']))
                <a href="{{ route('providers.index') }}" class="text-sm text-red-500 hover:underline flex items-center">Clear filters</a>
            @endif
        </div>
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
                    <strong class="text-gray-800">{{ $providers->total() }}</strong> provider{{ $providers->total() !== 1 ? 's' : '' }} found
                </p>
            </div>

            @if($providers->isEmpty())
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                    <div class="text-5xl mb-3">🔍</div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">No providers found</h3>
                    <p class="text-gray-500">Try adjusting your search or filters.</p>
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
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&callback=initMap" async defer></script>
<script>
async function initMap() {
    const mapEl = document.getElementById('map');
    mapEl.innerHTML = '';

    const map = new google.maps.Map(mapEl, {
        center: { lat: -25.2744, lng: 133.7751 },
        zoom: 5,
    });

    const params = new URLSearchParams(window.location.search);
    const apiUrl = '{{ route("api.providers") }}?' + params.toString();

    try {
        const res = await fetch(apiUrl);
        const providers = await res.json();
        const bounds = new google.maps.LatLngBounds();
        let hasMarkers = false;

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

        if (hasMarkers) map.fitBounds(bounds);
    } catch (e) {
        console.error(e);
    }
}
</script>
@endpush
