@extends('layouts.public')
@section('title', $post->meta_title ?? $post->title.' — Kids Health Hub')
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('content')
<div class="bg-white min-h-screen">

    {{-- Hero --}}
    @if($post->featured_image)
        <div class="w-full h-72 sm:h-96 overflow-hidden">
            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
    @endif

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Meta --}}
        <div class="flex items-center gap-3 mb-6 text-sm">
            <a href="{{ route('blog.index') }}" class="text-emerald-600 hover:underline font-semibold">Blog</a>
            <span class="text-gray-300">/</span>
            <span class="text-gray-500 truncate">{{ $post->title }}</span>
        </div>

        <div class="mb-3 flex items-center gap-2">
            <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full uppercase">{{ $post->template }}</span>
            <span class="text-gray-400 text-xs">{{ $post->reading_time }} min read · {{ number_format($post->views) }} views</span>
        </div>

        <h1 class="text-3xl sm:text-4xl font-black text-gray-900 leading-tight mb-4">{{ $post->title }}</h1>

        @if($post->excerpt)
            <p class="text-lg text-gray-500 leading-relaxed mb-6 border-l-4 border-emerald-400 pl-4">{{ $post->excerpt }}</p>
        @endif

        <div class="flex items-center gap-3 mb-8 pb-8 border-b border-gray-100">
            <div class="w-9 h-9 rounded-full bg-emerald-500 flex items-center justify-center text-white font-black text-sm">
                {{ substr($post->author->name ?? 'K', 0, 1) }}
            </div>
            <div>
                <p class="text-sm font-bold text-gray-800">{{ $post->author->name ?? 'Kids Health Hub' }}</p>
                <p class="text-xs text-gray-400">Published {{ $post->published_at->format('d F Y') }}</p>
            </div>
        </div>

        {{-- Content --}}
        <div class="prose prose-emerald max-w-none text-gray-700 leading-relaxed">
            {!! nl2br(e($post->content)) !!}
        </div>

        {{-- Related --}}
        @if($related->isNotEmpty())
        <div class="mt-14 pt-8 border-t border-gray-100">
            <h3 class="text-lg font-black text-gray-900 mb-6">More from the blog</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach($related as $rel)
                <a href="{{ route('blog.show', $rel->slug) }}" class="card-hover bg-gray-50 rounded-xl p-4 block group">
                    <h4 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-emerald-700 transition-colors mb-1">{{ $rel->title }}</h4>
                    <p class="text-gray-400 text-xs">{{ $rel->published_at->format('d M Y') }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
