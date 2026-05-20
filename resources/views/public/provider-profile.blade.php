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

            <!-- Reviews -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-800">Reviews</h2>
                    @if($reviewCount > 0)
                        <div class="flex items-center gap-2">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= round($avgRating) ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm font-semibold text-gray-700">{{ number_format($avgRating, 1) }}</span>
                            <span class="text-sm text-gray-400">({{ $reviewCount }} {{ $reviewCount === 1 ? 'review' : 'reviews' }})</span>
                        </div>
                    @endif
                </div>

                {{-- Review list --}}
                @forelse($reviews as $review)
                    <div class="border-b border-gray-100 last:border-0 pb-4 mb-4 last:mb-0 last:pb-0">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-gray-800 text-sm">{{ $review->user->name }}</span>
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $review->body }}</p>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">No reviews yet. Be the first to leave a review!</p>
                @endforelse

                {{-- Submit review form (family users, one per provider) --}}
                @auth
                    @if(auth()->user()->isFamily())
                        @if($userReview)
                            <div class="mt-4 bg-sky-50 border border-sky-200 rounded-xl p-4 text-sm text-sky-700">
                                @if($userReview->isApproved())
                                    Your review has been published.
                                @elseif($userReview->isPending())
                                    Your review is awaiting moderation.
                                @else
                                    Your review was not approved.
                                @endif
                            </div>
                        @else
                            <div class="mt-6 border-t border-gray-100 pt-6">
                                <h3 class="font-semibold text-gray-800 mb-3 text-sm">Leave a Review</h3>
                                <form method="POST" action="{{ route('family.reviews.store', $provider) }}">
                                    @csrf
                                    {{-- Star rating picker --}}
                                    <div class="flex items-center gap-1 mb-3" x-data="{ rating: 0, hover: 0 }">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button"
                                                    @click="rating = {{ $i }}"
                                                    @mouseenter="hover = {{ $i }}"
                                                    @mouseleave="hover = 0"
                                                    class="focus:outline-none">
                                                <svg class="w-7 h-7 transition-colors"
                                                     :class="(hover || rating) >= {{ $i }} ? 'text-amber-400' : 'text-gray-200'"
                                                     fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </button>
                                        @endfor
                                        <input type="hidden" name="rating" :value="rating">
                                    </div>
                                    @error('rating')
                                        <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                                    @enderror
                                    <textarea name="body" rows="3"
                                              placeholder="Share your experience with this provider..."
                                              class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none"
                                              maxlength="1000">{{ old('body') }}</textarea>
                                    @error('body')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <button type="submit"
                                            class="mt-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-2 rounded-xl text-sm transition-colors">
                                        Submit Review
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endif
                @else
                    <p class="mt-4 text-xs text-gray-400 text-center">
                        <a href="{{ route('login') }}" class="text-sky-600 hover:underline">Sign in</a> as a family to leave a review.
                    </p>
                @endauth
            </div>
        </div>

        <!-- Sidebar / Contact -->
        <div class="space-y-4">
            <!-- Contact card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Contact</h2>

                @auth
                    @if(auth()->user()->isFamily())
                        @php $isSaved = in_array($provider->id, $savedProviderIds ?? []); @endphp
                        <form method="POST" action="{{ route('family.saved.toggle', $provider) }}" class="mb-4">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 font-semibold px-4 py-3 rounded-xl transition-colors
                                           {{ $isSaved ? 'bg-rose-50 border-2 border-rose-300 text-rose-600 hover:bg-rose-100' : 'border-2 border-gray-200 text-gray-600 hover:border-rose-300 hover:text-rose-500' }}">
                                @if($isSaved)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                    Saved
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    Save Provider
                                @endif
                            </button>
                        </form>
                    @endif
                @endauth

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

            <!-- Request Appointment (family users only) -->
            @auth
                @if(auth()->user()->isFamily())
                    @php
                        $pendingAppointment = \App\Models\AppointmentRequest::where('family_user_id', auth()->id())
                            ->where('provider_id', $provider->id)
                            ->where('status', 'pending')
                            ->first();
                    @endphp
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Request Appointment</h2>

                        @if($pendingAppointment)
                            <div class="bg-sky-50 border border-sky-200 rounded-xl p-4 text-sm text-sky-700">
                                You have a pending appointment request for
                                <strong>{{ $pendingAppointment->preferred_date->format('d M Y') }}</strong>.
                                <a href="{{ route('family.appointments.index') }}" class="underline ml-1">View status</a>
                            </div>
                        @else
                            <form method="POST" action="{{ route('family.appointments.store', $provider) }}" x-data>
                                @csrf
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Date</label>
                                    <input type="date" name="preferred_date"
                                           min="{{ now()->addDay()->format('Y-m-d') }}"
                                           value="{{ old('preferred_date') }}"
                                           class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-300"
                                           required>
                                    @error('preferred_date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes <span class="text-gray-400 font-normal">(optional)</span></label>
                                    <textarea name="notes" rows="3"
                                              placeholder="e.g. child's age, reason for visit, any specific requirements..."
                                              class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none"
                                              maxlength="500">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                        class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold px-4 py-3 rounded-xl transition-colors">
                                    Send Request
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                    <p class="text-sm text-gray-500 mb-3">Want to request an appointment?</p>
                    <a href="{{ route('register.family') }}" class="block bg-sky-500 hover:bg-sky-600 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition-colors mb-2">
                        Create Family Account
                    </a>
                    <a href="{{ route('login') }}" class="block border border-gray-200 text-gray-600 hover:border-gray-300 font-medium px-4 py-2.5 rounded-xl text-sm transition-colors">
                        Sign In
                    </a>
                </div>
            @endauth

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
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&callback=initMiniMap" async defer></script>
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
