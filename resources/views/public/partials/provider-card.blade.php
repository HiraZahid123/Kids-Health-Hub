<article class="card-hover bg-white rounded-2xl border-2 border-gray-100 overflow-hidden group {{ $provider->is_featured ? 'border-amber-300 ring-1 ring-amber-200' : '' }}">

    {{-- Featured ribbon --}}
    @if($provider->is_featured)
    <div class="bg-amber-400 px-4 py-1.5 flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-amber-900" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
        <span class="text-amber-900 text-xs font-black uppercase tracking-wide">Featured Provider</span>
    </div>
    @endif

    {{-- Image / Initials --}}
    <div class="relative overflow-hidden">
        <a href="{{ route('providers.show', $provider->slug) }}" class="block">
            @if($provider->profile_image)
                <img src="{{ asset('storage/' . $provider->profile_image) }}"
                     alt="{{ $provider->business_name }}"
                     class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                @php
                    $palettes = [
                        ['bg'=>'bg-emerald-500','text'=>'text-white'],
                        ['bg'=>'bg-blue-500','text'=>'text-white'],
                        ['bg'=>'bg-violet-500','text'=>'text-white'],
                        ['bg'=>'bg-teal-500','text'=>'text-white'],
                        ['bg'=>'bg-orange-500','text'=>'text-white'],
                    ];
                    $p = $palettes[$provider->id % count($palettes)];
                @endphp
                <div class="w-full h-44 {{ $p['bg'] }} flex flex-col items-center justify-center group-hover:brightness-110 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-4 right-4 w-24 h-24 bg-white rounded-full"></div>
                        <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-white rounded-full"></div>
                    </div>
                    <span class="relative text-5xl font-black {{ $p['text'] }} opacity-90">{{ substr($provider->business_name, 0, 1) }}</span>
                </div>
            @endif
        </a>

        {{-- Availability badge --}}
        @if($provider->availability_status)
            <div class="absolute top-3 right-3 bg-emerald-500 text-white text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1.5 shadow-md">
                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                Available
            </div>
        @endif

    </div>

    {{-- Card body --}}
    <a href="{{ route('providers.show', $provider->slug) }}" class="block p-5">

        {{-- Name --}}
        <h3 class="font-black text-gray-900 text-base leading-snug group-hover:text-emerald-700 transition-colors mb-1.5">
            {{ $provider->business_name }}
        </h3>

        {{-- Location --}}
        <div class="flex items-center gap-1.5 text-gray-500 text-xs mb-3 font-medium">
            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            {{ $provider->suburb }}{{ $provider->state ? ', '.$provider->state : '' }}
        </div>

        {{-- Categories --}}
        @if($provider->categories->isNotEmpty())
            <div class="flex flex-wrap gap-1.5 mb-3">
                @foreach($provider->categories->take(2) as $cat)
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs px-2.5 py-0.5 rounded-full font-bold">{{ $cat->name }}</span>
                @endforeach
                @if($provider->categories->count() > 2)
                    <span class="bg-gray-50 text-gray-500 border border-gray-100 text-xs px-2 py-0.5 rounded-full font-semibold">+{{ $provider->categories->count() - 2 }} more</span>
                @endif
            </div>
        @endif

        {{-- Bio preview --}}
        @if($provider->bio)
            <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-3">{{ $provider->bio }}</p>
        @endif

        {{-- Footer badges --}}
        <div class="flex flex-wrap items-center gap-2 pt-3 border-t border-gray-50">
            @if(($provider->review_count ?? 0) > 0)
                <span class="inline-flex items-center gap-1 bg-amber-50 border border-amber-100 text-amber-700 text-xs px-2.5 py-1 rounded-lg font-bold">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    {{ number_format($provider->avg_rating, 1) }}
                    <span class="font-normal text-amber-600">({{ $provider->review_count }})</span>
                </span>
            @endif
            @if($provider->telehealth_available)
                <span class="inline-flex items-center gap-1.5 bg-blue-50 border border-blue-100 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-bold">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Telehealth
                </span>
            @endif
            @if($provider->wait_time)
                <span class="bg-gray-50 border border-gray-100 text-gray-500 text-xs px-2.5 py-1 rounded-lg font-semibold">
                    {{ $provider->wait_time }} wait
                </span>
            @endif
            <span class="ml-auto text-emerald-600 text-xs font-black group-hover:underline">View →</span>
        </div>
    </a>
</article>
