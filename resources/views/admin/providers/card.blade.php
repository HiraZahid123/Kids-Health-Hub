@extends('layouts.dashboard')

@section('title', 'Cover Card — ' . $provider->business_name)
@section('page-title', 'Generate Cover Card')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Pacifico&family=Caveat:wght@700&display=swap" rel="stylesheet">

<div class="max-w-6xl">
    <a href="{{ route('admin.providers.show', $provider) }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to {{ $provider->business_name }}</a>

    <div
        x-data="providerCoverCard({
            businessName: {{ Js::from($provider->business_name) }},
            suburb: {{ Js::from($provider->suburb) }},
            state: {{ Js::from($provider->state) }},
            category: {{ Js::from($provider->categories->first()->name ?? '') }},
            telehealth: {{ Js::from((bool) $provider->telehealth_available) }},
            available: {{ Js::from((bool) $provider->availability_status) }},
            waitTime: {{ Js::from($provider->wait_time) }},
            bio: {{ Js::from($provider->bio) }},
            profileImageUrl: {{ Js::from($provider->profile_image ? asset('storage/' . $provider->profile_image) : null) }},
            slug: {{ Js::from($provider->slug) }},
        })"
        x-init="init()"
        class="mt-4 grid grid-cols-1 lg:grid-cols-[380px_1fr] gap-6 items-start"
    >
        <!-- Controls -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-5">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Heading</label>
                <input type="text" x-model="heading" @input="draw()" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-violet-300 outline-none">
                <div class="flex gap-2 mt-2">
                    <select x-model="headingFont" @change="draw()" class="flex-1 border border-gray-200 rounded-lg px-2 py-1.5 text-sm">
                        <option value="'Dancing Script', cursive">Dancing Script</option>
                        <option value="'Pacifico', cursive">Pacifico</option>
                        <option value="'Caveat', cursive">Caveat</option>
                    </select>
                    <input type="color" x-model="headingColor" @input="draw()" class="w-10 h-9 rounded-lg border border-gray-200">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Body Text</label>
                <textarea x-model="body" @input="draw()" rows="6" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-violet-300 outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Background Colour</label>
                <input type="color" x-model="backgroundColor" @input="draw()" class="w-10 h-9 rounded-lg border border-gray-200">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Details Shown</label>
                <div class="flex flex-wrap gap-x-4 gap-y-1.5 text-sm">
                    <label class="flex items-center gap-1.5"><input type="checkbox" x-model="showCategory" @change="draw()"> Specialty</label>
                    <label class="flex items-center gap-1.5"><input type="checkbox" x-model="showLocation" @change="draw()"> Location</label>
                    <label class="flex items-center gap-1.5"><input type="checkbox" x-model="showTelehealth" @change="draw()"> Telehealth</label>
                    <label class="flex items-center gap-1.5"><input type="checkbox" x-model="showWaitTime" @change="draw()"> Wait time</label>
                </div>
            </div>

            <button type="button" @click="download()" class="w-full bg-violet-500 hover:bg-violet-600 text-white font-bold px-5 py-3 rounded-xl transition-colors">
                Download PNG
            </button>
        </div>

        <!-- Preview -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center justify-center overflow-auto">
            <canvas x-ref="canvas" class="max-w-full h-auto border border-gray-100 rounded-lg" style="max-height: 75vh;"></canvas>
        </div>
    </div>
</div>
@endsection

