@extends('layouts.dashboard')

@section('title', 'Message Thread')
@section('page-title', 'Messages')

@section('sidebar-nav')
    <a href="{{ route('provider.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm">
        📊 Dashboard
    </a>
    <a href="{{ route('provider.profile.edit') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        ✏️ Edit Profile
    </a>
    <a href="{{ route('provider.appointments.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-1">
        📅 Appointments
    </a>
    <a href="{{ route('provider.messages.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-50 text-emerald-700 font-medium text-sm mt-1">
        💬 Messages
    </a>
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 font-medium text-sm mt-4">
        🌐 Public Site
    </a>
@endsection

@section('content')

{{-- Thread header --}}
<div class="mb-4">
    <a href="{{ route('provider.messages.index') }}"
       class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 mb-3">
        ← Back to inbox
    </a>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex flex-wrap items-center gap-3">
            <div class="flex-1 min-w-0">
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Appointment with</p>
                <h2 class="font-bold text-gray-800 text-lg">{{ $appointment->provider->business_name }}</h2>
                <p class="text-sm text-gray-500">
                    Requested date: {{ $appointment->preferred_date->format('d F Y') }} ·
                    <span class="@if($appointment->isAccepted()) text-emerald-600 @elseif($appointment->isDeclined()) text-red-600 @else text-amber-600 @endif font-medium">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </p>
            </div>
            <a href="{{ route('providers.show', $appointment->provider->slug) }}"
               class="text-sm text-emerald-600 hover:underline flex-shrink-0">
                View profile →
            </a>
        </div>
    </div>
</div>

{{-- Messages --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4 space-y-4 min-h-48" id="messages-container">
    @forelse($messages as $msg)
        @php $isMine = $msg->sender_id === auth()->id(); @endphp
        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
            <div class="max-w-lg {{ $isMine ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-800' }} rounded-2xl px-4 py-3">
                @if(! $isMine)
                    <p class="text-xs font-semibold mb-1 opacity-70">{{ $msg->sender->name }}</p>
                @endif
                <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ $msg->body }}</p>
                <p class="text-xs mt-1 {{ $isMine ? 'text-emerald-100' : 'text-gray-400' }} text-right">
                    {{ $msg->created_at->format('d M, g:i a') }}
                    @if($isMine && $msg->read_at)
                        · Read
                    @endif
                </p>
            </div>
        </div>
    @empty
        <p class="text-center text-gray-400 text-sm py-8">No messages yet. Send the first one below.</p>
    @endforelse
</div>

{{-- Send form --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
    <form method="POST"
          action="{{ route('provider.messages.store', $appointment) }}">
        @csrf
        <div class="flex gap-3 items-end">
            <textarea name="body" rows="3"
                      placeholder="Write a message..."
                      class="flex-1 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-300 resize-none"
                      maxlength="2000" required>{{ old('body') }}</textarea>
            <button type="submit"
                    class="flex-shrink-0 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors">
                Send
            </button>
        </div>
        @error('body')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </form>
</div>

@endsection

@push('scripts')
<script>
    // Scroll to bottom of messages on load
    const container = document.getElementById('messages-container');
    if (container) container.scrollTop = container.scrollHeight;
</script>
@endpush
