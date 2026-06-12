@extends('layouts.dashboard')

@section('title', 'My Appointments')
@section('page-title', 'My Appointments')



@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">My Appointments</h2>
        <p class="text-sm text-gray-500 mt-1">{{ $appointments->count() }} request{{ $appointments->count() !== 1 ? 's' : '' }} total</p>
    </div>
    <a href="{{ route('providers.index') }}" class="bg-sky-500 hover:bg-sky-600 text-white font-semibold px-4 py-2 rounded-lg text-sm transition-colors">
        Find Providers
    </a>
</div>

@if($appointments->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
        <div class="text-5xl mb-4">📅</div>
        <h3 class="text-lg font-bold text-gray-700 mb-2">No appointment requests yet</h3>
        <p class="text-gray-500 text-sm mb-6">Browse the directory and send an appointment request to a provider you'd like to see.</p>
        <a href="{{ route('providers.index') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors">
            Browse Providers
        </a>
    </div>
@else
    <div class="space-y-4">
        @foreach($appointments as $appt)
            @php
                $statusColor = match($appt->status) {
                    'accepted' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
                    'declined' => 'bg-red-50 border-red-200 text-red-700',
                    default    => 'bg-amber-50 border-amber-200 text-amber-700',
                };
                $statusLabel = match($appt->status) {
                    'accepted' => 'Accepted',
                    'declined' => 'Declined',
                    default    => 'Pending',
                };
            @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <a href="{{ route('providers.show', $appt->provider->slug) }}"
                               class="font-bold text-gray-800 hover:text-emerald-600 transition-colors">
                                {{ $appt->provider->business_name }}
                            </a>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full border {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Requested: {{ $appt->preferred_date->format('l, d F Y') }}
                            </span>
                            <span class="flex items-center gap-1 text-gray-400">
                                Submitted {{ $appt->created_at->diffForHumans() }}
                            </span>
                        </div>

                        @if($appt->notes)
                            <p class="text-sm text-gray-500 mt-2 italic">"{{ $appt->notes }}"</p>
                        @endif

                        @if($appt->provider_message)
                            <div class="mt-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700">
                                <span class="font-medium text-gray-500 text-xs uppercase tracking-wide">Provider response:</span>
                                <p class="mt-1">{{ $appt->provider_message }}</p>
                            </div>
                        @endif

                        @if($appt->isAccepted() && $appt->provider->phone)
                            <p class="text-sm text-emerald-700 mt-2">
                                Contact the provider to confirm: <a href="tel:{{ $appt->provider->phone }}" class="font-semibold hover:underline">{{ $appt->provider->phone }}</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
