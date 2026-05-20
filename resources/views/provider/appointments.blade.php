@extends('layouts.dashboard')

@section('title', 'Appointment Requests')
@section('page-title', 'Appointment Requests')

@section('sidebar-nav')
    <a href="{{ route('provider.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        📊 Dashboard
    </a>
    <a href="{{ route('provider.profile.edit') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        ✏️ Edit Profile
    </a>
    <a href="{{ route('provider.appointments.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-50 text-emerald-700 font-medium text-sm mt-1">
        📅 Appointments
        @if($pending->count() > 0)
            <span class="ml-auto bg-rose-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $pending->count() }}</span>
        @endif
    </a>
    <a href="{{ route('provider.messages.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        💬 Messages
    </a>
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-4">
        🌐 Public Site
    </a>
@endsection

@section('content')

{{-- Pending requests --}}
<div class="mb-8">
    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        Pending Requests
        @if($pending->count() > 0)
            <span class="bg-rose-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pending->count() }}</span>
        @endif
    </h2>

    @if($pending->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center text-gray-400 text-sm">
            No pending appointment requests.
        </div>
    @else
        <div class="space-y-4">
            @foreach($pending as $appt)
                <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-5"
                     x-data="{ open: false }">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <span class="font-bold text-gray-800">{{ $appt->family->name }}</span>
                                <span class="text-xs text-gray-400">{{ $appt->family->email }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Preferred: <strong class="ml-1">{{ $appt->preferred_date->format('l, d F Y') }}</strong>
                            </div>
                            @if($appt->notes)
                                <p class="text-sm text-gray-500 mt-2 italic">"{{ $appt->notes }}"</p>
                            @endif
                            <p class="text-xs text-gray-400 mt-1">Received {{ $appt->created_at->diffForHumans() }}</p>
                        </div>

                        <button @click="open = !open"
                                class="flex-shrink-0 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                            Respond
                        </button>
                    </div>

                    {{-- Respond form --}}
                    <div x-show="open" x-transition class="mt-4 border-t border-gray-100 pt-4">
                        <form method="POST" action="{{ route('provider.appointments.respond', $appt) }}">
                            @csrf @method('PATCH')
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Message to family <span class="text-gray-400 font-normal">(optional)</span>
                                </label>
                                <textarea name="provider_message" rows="2"
                                          placeholder="e.g. Confirmed! Please call us to finalise the time."
                                          class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none"
                                          maxlength="500"></textarea>
                            </div>
                            <div class="flex gap-3">
                                <button type="submit" name="action" value="accepted"
                                        class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-2 rounded-xl text-sm transition-colors">
                                    Accept
                                </button>
                                <button type="submit" name="action" value="declined"
                                        class="bg-red-100 hover:bg-red-200 text-red-700 font-semibold px-5 py-2 rounded-xl text-sm transition-colors">
                                    Decline
                                </button>
                                <button type="button" @click="open = false"
                                        class="text-gray-500 hover:text-gray-700 text-sm font-medium px-3">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Past responses --}}
@if($responded->isNotEmpty())
<div>
    <h2 class="text-lg font-bold text-gray-800 mb-4">Previous Requests <span class="text-sm font-normal text-gray-400">(recent 50)</span></h2>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">Family</th>
                    <th class="px-4 py-3 text-left">Preferred Date</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Received</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($responded as $appt)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800">{{ $appt->family->name }}</p>
                            @if($appt->notes)
                                <p class="text-xs text-gray-400 truncate max-w-xs">{{ Str::limit($appt->notes, 50) }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $appt->preferred_date->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            @if($appt->isAccepted())
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold px-2.5 py-0.5 rounded-full">Accepted</span>
                            @else
                                <span class="bg-red-50 text-red-700 border border-red-200 text-xs font-semibold px-2.5 py-0.5 rounded-full">Declined</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $appt->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
