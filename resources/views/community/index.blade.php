@extends('layouts.public')
@section('title', 'Community — Kids Health Hub')
@section('meta_description', 'Connect with other families and healthcare providers. Share experiences, ask questions, and get support.')

@section('content')
<div class="bg-gray-50 min-h-screen">

    {{-- Header --}}
    <div class="bg-white border-b border-gray-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-gray-900">Community</h1>
                <p class="text-gray-500 text-sm mt-1">Connect with families and providers. Share questions, tips, and experiences.</p>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    @if($unreadCount > 0)
                    <a href="{{ route('community.notifications') }}" class="relative text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center">{{ $unreadCount }}</span>
                    </a>
                    @endif
                    <a href="{{ route('community.create') }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-700 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        New Post
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-700 transition-colors">Sign in to post</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Main feed --}}
            <div class="flex-1">

                {{-- Search + filter bar --}}
                <form method="GET" class="flex gap-3 mb-6 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search posts…"
                           class="flex-1 min-w-0 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-white">
                    @if($categories->isNotEmpty())
                    <select name="category" class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-white focus:ring-2 focus:ring-emerald-400">
                        <option value="">All categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @endif
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-700 transition-colors">Search</button>
                    @if(request()->hasAny(['search','category']))
                    <a href="{{ route('community.index') }}" class="px-4 py-2.5 border border-gray-200 text-gray-500 rounded-xl text-sm hover:bg-gray-50 transition-colors">Clear</a>
                    @endif
                </form>

                {{-- Posts --}}
                @if($posts->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="font-black text-gray-600 text-lg mb-1">No posts yet</h3>
                    <p class="text-gray-400 text-sm mb-4">Be the first to start a discussion!</p>
                    @auth
                    <a href="{{ route('community.create') }}" class="inline-block bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-700 transition-colors">Create First Post</a>
                    @else
                    <a href="{{ route('login') }}" class="inline-block bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-700 transition-colors">Sign in to post</a>
                    @endauth
                </div>
                @else
                <div class="space-y-3">
                    @foreach($posts as $post)
                    <div class="bg-white rounded-2xl border border-gray-100 p-5 @if($post->is_pinned) border-amber-200 @endif">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-black text-sm flex-shrink-0">
                                {{ substr($post->author->name ?? '?', 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    @if($post->is_pinned)
                                    <span class="bg-amber-100 text-amber-700 text-xs font-bold px-2 py-0.5 rounded-full flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5v4a2 2 0 01-2 2H9a2 2 0 01-2-2v-4H4a2 2 0 010-4h1.17A3 3 0 015 5z"/></svg>
                                        Pinned
                                    </span>
                                    @endif
                                    @if($post->is_locked)
                                    <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-0.5 rounded-full">Locked</span>
                                    @endif
                                    @if($post->category)
                                    <span class="bg-emerald-50 text-emerald-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $post->category }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('community.show', $post) }}" class="block">
                                    <h2 class="font-black text-gray-900 text-base leading-snug hover:text-emerald-700 transition-colors mb-1">{{ $post->title }}</h2>
                                </a>
                                <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ Str::limit(strip_tags($post->content), 160) }}</p>
                                <div class="flex items-center gap-4 text-xs text-gray-400">
                                    <span class="font-semibold text-gray-600">{{ $post->author->name ?? 'Unknown' }}</span>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        {{ $post->comments_count }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        {{ $post->likes_count }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">{{ $posts->links() }}</div>
                @endif

            </div>

            {{-- Sidebar --}}
            <div class="lg:w-72 space-y-5">
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-black text-gray-900 text-sm mb-3">Community Guidelines</h3>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold mt-0.5">✓</span> Be respectful and supportive</li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold mt-0.5">✓</span> Share experiences, ask questions</li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold mt-0.5">✓</span> Respect privacy — don't share personal info</li>
                        <li class="flex items-start gap-2"><span class="text-red-400 font-bold mt-0.5">✗</span> No spam or self-promotion</li>
                        <li class="flex items-start gap-2"><span class="text-red-400 font-bold mt-0.5">✗</span> No medical advice without credentials</li>
                    </ul>
                </div>
                @if($categories->isNotEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-black text-gray-900 text-sm mb-3">Topics</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $cat)
                        <a href="{{ route('community.index', ['category' => $cat]) }}"
                           class="bg-emerald-50 text-emerald-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-emerald-100 transition-colors">{{ $cat }}</a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
