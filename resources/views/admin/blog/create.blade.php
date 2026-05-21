@extends('layouts.dashboard')
@section('title', 'New Blog Post')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.blog.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-black text-gray-900">New Blog Post</h1>
        </div>
    </div>

    @include('admin.blog._form', ['post' => null, 'action' => route('admin.blog.store'), 'method' => 'POST'])
</div>
@endsection
