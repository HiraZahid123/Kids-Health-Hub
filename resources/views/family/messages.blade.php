@extends('layouts.dashboard')

@section('title', 'Messages')
@section('page-title', 'Messages')

@section('sidebar-nav')
    <a href="{{ route('family.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        🏠 Dashboard
    </a>
    <a href="{{ route('providers.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        🔍 Find Providers
    </a>
    <a href="{{ route('family.saved') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        ❤️ Saved Providers
    </a>
    <a href="{{ route('family.appointments.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        📅 My Appointments
    </a>
    <a href="{{ route('family.messages.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-sky-50 text-sky-700 font-medium text-sm mt-1">
        💬 Messages
    </a>
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-4">
        🌐 Public Site
    </a>
@endsection

@section('content')

<div class="mb-6">
    <h2 class="text-xl font-bold text-gray-800">Inbox</h2>
    <p class="text-sm text-gray-500 mt-1">Messages with providers, linked to your appointment requests.</p>
</div>

@if($threads->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
        <div class="text-5xl mb-4">💬</div>
        <h3 class="text-lg font-bold text-gray-700 mb-2">No messages yet</h3>
        <p class="text-gray-500 text-sm mb-6">Messages appear here once you've sent an appointment request and a conversation has started.</p>
        <a href="{{ route('providers.index') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors">
            Find Providers
        </a>
    </div>
@else
    <div class="space-y-3">
        @foreach($threads as $thread)
            @php $lastMsg = $thread->messages->first(); @endphp
            <a href="{{ route('family.messages.show', $thread) }}"
               class="block bg-white rounded-2xl border {{ $thread->unread_count > 0 ? 'border-sky-300 shadow-md' : 'border-gray-100 shadow-sm' }} p-5 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <p class="font-bold text-gray-800">{{ $thread->provider->business_name }}</p>
                            @if($thread->unread_count > 0)
                                <span class="bg-sky-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $thread->unread_count }} new</span>
                            @endif
                        </div>
                        @if($lastMsg)
                            <p class="text-sm text-gray-500 truncate">
                                {{ $lastMsg->sender_id === auth()->id() ? 'You: ' : '' }}{{ Str::limit($lastMsg->body, 80) }}
                            </p>
                        @endif
                    </div>
                    @if($lastMsg)
                        <span class="text-xs text-gray-400 flex-shrink-0">{{ $lastMsg->created_at->diffForHumans() }}</span>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
@endif

@endsection
