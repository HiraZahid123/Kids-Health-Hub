@extends('layouts.dashboard')
@section('title', 'Edit Blog Post')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.blog.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-black text-gray-900">Edit Post</h1>
            <p class="text-gray-500 text-sm">{{ $post->title }}</p>
        </div>
    </div>

    @include('admin.blog._form', ['post' => $post, 'action' => route('admin.blog.update', $post), 'method' => 'PUT'])
</div>
@endsection
