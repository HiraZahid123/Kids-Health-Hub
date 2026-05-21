@extends('layouts.public')
@section('title', 'Notifications — Community')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('community.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-2xl font-black text-gray-900">Notifications</h1>
        </div>

        @if($notifications->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <h3 class="font-black text-gray-600 text-lg mb-1">No notifications</h3>
            <p class="text-gray-400 text-sm">You're all caught up!</p>
        </div>
        @else
        <div class="space-y-2">
            @foreach($notifications as $notif)
            @php
                $postId   = $notif->data['post_id'] ?? null;
                $postTitle = $notif->data['post_title'] ?? 'a post';
                $typeLabel = match($notif->type) {
                    'post_liked'     => 'liked your post',
                    'post_commented' => 'commented on your post',
                    'comment_replied'=> 'replied to your comment',
                    default          => 'interacted with your content',
                };
            @endphp
            <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-black text-sm flex-shrink-0">
                    {{ substr($notif->actor->name ?? '?', 0, 1) }}
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-700">
                        <span class="font-bold">{{ $notif->actor->name ?? 'Someone' }}</span>
                        {{ $typeLabel }}
                        @if($postId)
                        "<a href="{{ route('community.show', $postId) }}" class="text-emerald-600 hover:underline font-semibold">{{ Str::limit($postTitle, 60) }}</a>"
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $notif->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $notifications->links() }}</div>
        @endif
    </div>
</div>
@endsection
