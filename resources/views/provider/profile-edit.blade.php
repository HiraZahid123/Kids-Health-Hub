@extends('layouts.dashboard')

@section('title', 'Edit Profile')
@section('page-title', 'Edit My Profile')



@section('content')
<div class="max-w-3xl space-y-6">

    <!-- Profile Image -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Profile Image</h2>
        <div class="flex items-center gap-4">
            @if($provider && $provider->profile_image)
                <img src="{{ asset('storage/' . $provider->profile_image) }}" class="w-20 h-20 rounded-xl object-cover">
            @else
                <div class="w-20 h-20 rounded-xl bg-emerald-100 flex items-center justify-center text-3xl font-bold text-emerald-500">
                    {{ $provider ? substr($provider->business_name, 0, 1) : '?' }}
                </div>
            @endif
            <form action="{{ route('provider.profile.image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_image" accept="image/*" class="block text-sm text-gray-600 mb-2">
                <button type="submit" class="bg-emerald-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-emerald-600 transition-colors">Upload Image</button>
            </form>
        </div>
    </div>

    <!-- Profile Form -->
    <form action="{{ route('provider.profile.update') }}" method="POST" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        @csrf @method('PUT')

        <h2 class="text-lg font-bold text-gray-800 mb-4">Business Information</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Business Name *</label>
                <input type="text" name="business_name" value="{{ old('business_name', $provider?->business_name) }}" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Provider / Practitioner Name *</label>
                <input type="text" name="provider_name" value="{{ old('provider_name', $provider?->provider_name) }}" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="tel" name="phone" value="{{ old('phone', $provider?->phone) }}"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Website URL</label>
                <input type="url" name="website_url" value="{{ old('website_url', $provider?->website_url) }}" placeholder="https://"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">
            </div>
        </div>

        <h3 class="text-base font-semibold text-gray-700 mb-3 pt-2 border-t border-gray-100">Location</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                <input type="text" name="address" value="{{ old('address', $provider?->address) }}"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Suburb</label>
                <input type="text" name="suburb" value="{{ old('suburb', $provider?->suburb) }}"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                <select name="state" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-700 focus:ring-2 focus:ring-emerald-300 outline-none">
                    <option value="">Select State</option>
                    @foreach(['NSW','VIC','QLD','WA','SA','TAS','ACT','NT'] as $s)
                        <option value="{{ $s }}" {{ old('state', $provider?->state) == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Postcode</label>
                <input type="text" name="postcode" value="{{ old('postcode', $provider?->postcode) }}" maxlength="4"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">
            </div>
        </div>

        <h3 class="text-base font-semibold text-gray-700 mb-3 pt-2 border-t border-gray-100">About</h3>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Bio / Description</label>
            <textarea name="bio" rows="5" placeholder="Tell families about your practice, specialties, and approach..."
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">{{ old('bio', $provider?->bio) }}</textarea>
        </div>

        <h3 class="text-base font-semibold text-gray-700 mb-3 pt-2 border-t border-gray-100">Service Categories</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mb-6">
            @foreach($categories as $cat)
                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700">
                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                        {{ in_array($cat->id, $provider?->categories->pluck('id')->toArray() ?? []) ? 'checked' : '' }}
                        class="rounded text-emerald-500">
                    {{ $cat->name }}
                </label>
            @endforeach
        </div>

        <h3 class="text-base font-semibold text-gray-700 mb-3 pt-2 border-t border-gray-100">Age Groups Served</h3>
        <div class="flex flex-wrap gap-3 mb-6">
            @foreach(['0-2 years','3-5 years','6-12 years','13-18 years','All ages'] as $age)
                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700">
                    <input type="checkbox" name="age_groups[]" value="{{ $age }}"
                        {{ in_array($age, $provider?->age_groups ?? []) ? 'checked' : '' }}
                        class="rounded text-emerald-500">
                    {{ $age }}
                </label>
            @endforeach
        </div>

        <h3 class="text-base font-semibold text-gray-700 mb-3 pt-2 border-t border-gray-100">Funding Types Accepted</h3>
        <div class="flex flex-wrap gap-3 mb-6">
            @foreach(['NDIS','Medicare','Private Health','Private Pay','DVA'] as $fund)
                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700">
                    <input type="checkbox" name="funding_types[]" value="{{ $fund }}"
                        {{ in_array($fund, $provider?->funding_types ?? []) ? 'checked' : '' }}
                        class="rounded text-emerald-500">
                    {{ $fund }}
                </label>
            @endforeach
        </div>

        <h3 class="text-base font-semibold text-gray-700 mb-3 pt-2 border-t border-gray-100">Service Delivery</h3>
        <div class="flex flex-wrap gap-3 mb-6">
            @foreach(['in-clinic' => 'In-Clinic', 'mobile' => 'Mobile / Home Visits', 'telehealth' => 'Telehealth'] as $val => $label)
                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700">
                    <input type="checkbox" name="service_delivery[]" value="{{ $val }}"
                        {{ in_array($val, $provider?->service_delivery ?? []) ? 'checked' : '' }}
                        class="rounded text-emerald-500">
                    {{ $label }}
                </label>
            @endforeach
        </div>

        <div class="mb-6 pt-2 border-t border-gray-100">
            <label class="block text-sm font-medium text-gray-700 mb-1">Typical Wait Time</label>
            <input type="text" name="wait_time" value="{{ old('wait_time', $provider?->wait_time) }}" placeholder="e.g. 2–4 weeks"
                class="w-full sm:w-64 border border-gray-200 rounded-lg px-3 py-2 text-gray-800 focus:ring-2 focus:ring-emerald-300 outline-none">
        </div>

        <div class="pt-4 border-t border-gray-100">
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-8 py-3 rounded-xl transition-colors">
                Save Profile
            </button>
        </div>
    </form>
</div>
@endsection
