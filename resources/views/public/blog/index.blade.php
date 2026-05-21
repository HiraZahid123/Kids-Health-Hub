@extends('layouts.public')
@section('title', 'Blog — Kids Health Hub')
@section('meta_description', 'News, guides, and insights about child healthcare from the Kids Health Hub team.')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-4 py-2 rounded-full mb-4 uppercase tracking-widest">Official Blog</span>
            <h1 class="text-4xl font-black text-gray-900 mb-3">Kids Health Hub Blog</h1>
            <p class="text-gray-500 max-w-xl mx-auto">News, guides, and insights about child healthcare from our team.</p>
        </div>

        @if($posts->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <h3 class="font-black text-gray-700 text-lg mb-1">No posts yet</h3>
                <p class="text-gray-400 text-sm">Check back soon for news and guides.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden block group">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-48 bg-emerald-600 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-2.5 py-0.5 rounded-full uppercase">{{ $post->template }}</span>
                            <span class="text-gray-400 text-xs">{{ $post->reading_time }} min read</span>
                        </div>
                        <h2 class="font-black text-gray-900 text-base leading-snug mb-2 group-hover:text-emerald-700 transition-colors">{{ $post->title }}</h2>
                        @if($post->excerpt)
                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-4">{{ $post->excerpt }}</p>
                        @endif
                        <div class="flex items-center gap-2 text-xs text-gray-400 border-t border-gray-50 pt-3">
                            <span>{{ $post->author->name ?? 'Kids Health Hub' }}</span>
                            <span>·</span>
                            <span>{{ $post->published_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-8">{{ $posts->links() }}</div>
        @endif
    </div>
</div>
@endsection
