<a href="{{ route('providers.show', $provider->slug) }}"
   class="block bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 overflow-hidden group {{ $provider->is_featured ? 'ring-2 ring-amber-400' : '' }}">

    @if($provider->is_featured)
        <div class="bg-amber-400 text-amber-900 text-xs font-bold px-3 py-1 text-center">⭐ Featured Provider</div>
    @endif

    <!-- Image -->
    <div class="relative">
        @if($provider->profile_image)
            <img src="{{ asset('storage/' . $provider->profile_image) }}"
                 alt="{{ $provider->business_name }}"
                 class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-40 bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                <span class="text-5xl font-bold text-emerald-400">{{ substr($provider->business_name, 0, 1) }}</span>
            </div>
        @endif

        <!-- Availability indicator -->
        @if($provider->availability_status)
            <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Available
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-4">
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
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            {{ $provider->suburb }}{{ $provider->state ? ', ' . $provider->state : '' }}
        </div>

        @if($provider->bio)
            <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $provider->bio }}</p>
        @endif

        <!-- Badges -->
        <div class="flex flex-wrap gap-2 mt-3">
            @if($provider->telehealth_available)
                <span class="bg-blue-50 text-blue-700 text-xs px-2 py-0.5 rounded-full font-medium flex items-center gap-1">
                    📱 Telehealth
                </span>
            @endif
            @if($provider->wait_time)
                <span class="bg-gray-50 text-gray-600 text-xs px-2 py-0.5 rounded-full">
                    Wait: {{ $provider->wait_time }}
                </span>
            @endif
        </div>
    </div>
</a>
