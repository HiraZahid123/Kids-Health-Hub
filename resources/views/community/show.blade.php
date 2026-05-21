@extends('layouts.public')
@section('title', $post->title.' — Community')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('community.index') }}" class="hover:text-emerald-600 font-medium">Community</a>
            <span>/</span>
            <span class="text-gray-800 truncate">{{ Str::limit($post->title, 50) }}</span>
        </nav>

        {{-- Post --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-8 mb-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <div class="flex items-center gap-3 flex-wrap">
                    @if($post->is_pinned)<span class="bg-amber-100 text-amber-700 text-xs font-bold px-2.5 py-1 rounded-full">Pinned</span>@endif
                    @if($post->is_locked)<span class="bg-gray-100 text-gray-600 text-xs font-bold px-2.5 py-1 rounded-full">Locked</span>@endif
                    @if($post->category)<span class="bg-emerald-50 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $post->category }}</span>@endif
                </div>
                @if(auth()->check() && (auth()->id() === $post->user_id || auth()->user()->isAdmin()))
                <div class="flex items-center gap-2">
                    <a href="{{ route('community.edit', $post) }}" class="text-gray-400 hover:text-blue-600 text-xs font-semibold">Edit</a>
                    <form method="POST" action="{{ route('community.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500 text-xs font-semibold">Delete</button>
                    </form>
                    @if(auth()->user()->isAdmin())
                    <form method="POST" action="{{ route('community.pin', $post) }}">@csrf @method('PATCH')
                        <button type="submit" class="text-gray-400 hover:text-amber-600 text-xs font-semibold">{{ $post->is_pinned ? 'Unpin' : 'Pin' }}</button>
                    </form>
                    <form method="POST" action="{{ route('community.lock', $post) }}">@csrf @method('PATCH')
                        <button type="submit" class="text-gray-400 hover:text-gray-600 text-xs font-semibold">{{ $post->is_locked ? 'Unlock' : 'Lock' }}</button>
                    </form>
                    @endif
                </div>
                @endif
            </div>

            <h1 class="text-2xl font-black text-gray-900 mb-4 leading-tight">{{ $post->title }}</h1>

            @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="" class="w-full rounded-xl mb-5 max-h-80 object-cover">
            @endif

            <div class="text-gray-700 leading-relaxed whitespace-pre-wrap text-sm mb-6">{{ $post->content }}</div>

            <div class="flex items-center justify-between border-t border-gray-50 pt-4">
                <div class="flex items-center gap-3 text-xs text-gray-400">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-black text-xs">
                        {{ substr($post->author->name ?? '?', 0, 1) }}
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700">{{ $post->author->name ?? 'Unknown' }}</span>
                        <span class="ml-2">{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                {{-- Like button --}}
                @auth
                <button
                    x-data="{ liked: {{ in_array($post->id, $likedPostIds) ? 'true' : 'false' }}, count: {{ $post->likes_count }} }"
                    @click="
                        fetch('{{ route('community.like', $post) }}', {method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'}})
                        .then(r=>r.json()).then(d=>{ liked=d.liked; count=d.count; })
                    "
                    class="flex items-center gap-1.5 text-sm font-bold transition-colors"
                    :class="liked ? 'text-rose-500' : 'text-gray-400 hover:text-rose-400'">
                    <svg class="w-5 h-5" :fill="liked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span x-text="count"></span>
                </button>
                @else
                <div class="flex items-center gap-1.5 text-sm text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    {{ $post->likes_count }}
                </div>
                @endauth
            </div>
        </div>

        {{-- Comments --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-8">
            <h2 class="font-black text-gray-900 mb-6">{{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}</h2>

            {{-- Add comment --}}
            @if(!$post->is_locked || (auth()->check() && auth()->user()->isAdmin()))
            @auth
            <form method="POST" action="{{ route('community.comments.store', $post) }}" class="mb-8" x-data="{ replyTo: null }">
                @csrf
                <input type="hidden" name="parent_id" :value="replyTo">
                <div class="flex gap-3">
                    <div class="w-9 h-9 rounded-full bg-emerald-500 flex items-center justify-center text-white font-black text-xs flex-shrink-0">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <textarea name="content" rows="3"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white resize-none"
                                  placeholder="Share your thoughts…" required>{{ old('content') }}</textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" class="bg-emerald-600 text-white px-5 py-2 rounded-xl font-bold text-sm hover:bg-emerald-700 transition-colors">Post Comment</button>
                        </div>
                    </div>
                </div>
            </form>
            @else
            <div class="bg-gray-50 rounded-xl p-4 mb-8 text-center">
                <p class="text-gray-500 text-sm"><a href="{{ route('login') }}" class="text-emerald-600 font-bold hover:underline">Sign in</a> to leave a comment.</p>
            </div>
            @endauth
            @else
            <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 mb-8 text-center">
                <p class="text-amber-700 text-sm font-semibold">This discussion is locked.</p>
            </div>
            @endif

            {{-- Comment list --}}
            <div class="space-y-6">
                @forelse($post->comments as $comment)
                <div class="flex gap-3" id="comment-{{ $comment->id }}">
                    <div class="w-9 h-9 rounded-full bg-gray-400 flex items-center justify-center text-white font-black text-xs flex-shrink-0">
                        {{ substr($comment->author->name ?? '?', 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-bold text-gray-800">{{ $comment->author->name ?? 'Unknown' }}</span>
                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $comment->content }}</p>
                        </div>

                        <div class="flex items-center gap-3 mt-1.5 ml-2">
                            @auth
                            @if(!$post->is_locked || auth()->user()->isAdmin())
                            <button
                                x-data="{ show: false }"
                                @click="show = !show"
                                class="text-xs text-gray-400 hover:text-emerald-600 font-semibold">Reply</button>
                            @endif
                            @if(auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                            <form method="POST" action="{{ route('community.comments.destroy', $comment) }}" onsubmit="return confirm('Delete comment?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-gray-400 hover:text-red-500 font-semibold">Delete</button>
                            </form>
                            @endif
                            @endauth
                        </div>

                        {{-- Reply form --}}
                        @auth
                        <div x-data="{ show: false }">
                            <button @click="show = !show" class="hidden"></button>
                            <div x-show="show" x-transition class="mt-3 ml-2">
                                <form method="POST" action="{{ route('community.comments.store', $post) }}">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="content" rows="2"
                                              class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white resize-none"
                                              placeholder="Reply to {{ $comment->author->name ?? 'this comment' }}…" required></textarea>
                                    <div class="flex gap-2 mt-2">
                                        <button type="submit" class="bg-emerald-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors">Reply</button>
                                        <button type="button" @click="show = false" class="px-3 py-1.5 text-gray-400 text-xs hover:text-gray-600">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endauth

                        {{-- Replies --}}
                        @if($comment->replies->isNotEmpty())
                        <div class="mt-3 space-y-3 ml-4 pl-4 border-l-2 border-gray-100">
                            @foreach($comment->replies as $reply)
                            <div class="flex gap-2">
                                <div class="w-7 h-7 rounded-full bg-gray-300 flex items-center justify-center text-white font-black text-xs flex-shrink-0">
                                    {{ substr($reply->author->name ?? '?', 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="bg-gray-50 rounded-xl p-3">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs font-bold text-gray-800">{{ $reply->author->name ?? 'Unknown' }}</span>
                                            <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $reply->content }}</p>
                                    </div>
                                    @auth
                                    @if(auth()->id() === $reply->user_id || auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('community.comments.destroy', $reply) }}" onsubmit="return confirm('Delete?')" class="mt-1 ml-2">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs text-gray-400 hover:text-red-500 font-semibold">Delete</button>
                                    </form>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <p class="text-gray-400 text-sm text-center py-6">No comments yet. Be the first to reply!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
