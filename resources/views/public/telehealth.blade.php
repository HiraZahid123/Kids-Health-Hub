@extends('layouts.public')

@section('title', 'Telehealth Child Healthcare Providers')

@section('content')
<div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold mb-3">📱 Telehealth Providers</h1>
        <p class="text-blue-100 text-lg max-w-xl mx-auto">Access child healthcare from the comfort of your home. Browse providers offering telehealth services across Australia.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Category filters -->
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('telehealth') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-blue-500 text-white' : 'bg-white border border-gray-200 text-gray-700 hover:border-blue-300' }}">
            All Telehealth
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('telehealth', ['category' => $cat->slug]) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') == $cat->slug ? 'bg-blue-500 text-white' : 'bg-white border border-gray-200 text-gray-700 hover:border-blue-300' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    @if($providers->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
            <div class="text-5xl mb-3">📱</div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">No telehealth providers found</h3>
            <p class="text-gray-500">Check back soon or try a different category.</p>
        </div>
    @else
        <p class="text-gray-600 text-sm mb-4"><strong>{{ $providers->total() }}</strong> telehealth provider{{ $providers->total() !== 1 ? 's' : '' }}</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($providers as $provider)
                @include('public.partials.provider-card', ['provider' => $provider])
            @endforeach
        </div>
        <div class="mt-6">{{ $providers->links() }}</div>
    @endif
</div>
@endsection
